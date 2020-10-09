<?php


namespace App\Services;


use App\Mail\NewOrder;
use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Master;
use App\Models\Swagger\v1\Order;
use App\Models\Swagger\v1\WorkingDiapason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    private static function notifyGroomer($data)
    {
        //email notify
        Mail::to($data['master']['email'])->send(new NewOrder($data));

        //sms notify
        if (isset($data['master']['phone'])) {
            $client = new \GuzzleHttp\Client();
            $client->get(
                'https://sms.ru/sms/send?api_id='
                . config('smsru.key')
                . '&to='
                . $data['master']['phone']
                . '&msg='
                . view('mail.smsru', compact('data'))
                .'&json=1'
            );
        }
    }

    private static function storeOrder($data)
    {
        Order::create($data);
    }

    private static function notifyAdmin($data)
    {
        Mail::to($data['client']['email'])->send(new NewOrder($data));
    }

    private static function changeWorkingDiapasonState(Request $data): bool
    {
        if (WorkingDiapasonService::isStateFree($data['working_diapason_start_id'])) {
            WorkingDiapasonService::changeState(
                $data['working_diapason_start_id'],
                WorkingDiapasonService::BOOKED_STATE
            );
        } else {
            return false;
        }
        return true;
    }

    private static function schedulePushNotification($data)
    {
    }

    private static function getFullOrderData(Request $request): array
    {
        $data = $request->all();
        $data['working_diapason'] = WorkingDiapason::find($data['working_diapason_start_id'])->toArray();
        $data['master'] = Master::find($data['working_diapason']['master_id'])
            ->makeVisible(['client_id', 'email', 'phone'])->toArray();
        $data['client'] = Client::find($data['master']['client_id'])->toArray();

        return $data;
    }

    public static function createOrder(Request $request)
    {
        $data = OrderService::getFullOrderData($request);
        if (!OrderService::changeWorkingDiapasonState($request)) {
            //TODO: Описать ошибку занятого времени
            return response(["message" => __("Время занято")], 422);
        }

        OrderService::schedulePushNotification($data);
        OrderService::notifyAdmin($data);
        OrderService::notifyGroomer($data);
        OrderService::storeOrder($data);

        return response('', 201);
    }

}
