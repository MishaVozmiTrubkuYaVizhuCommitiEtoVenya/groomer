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
        Mail::to($data['master']['email'])->send(new NewOrder($data));

    }

    private static function storeOrder($data)
    {
        Order::create($data);
    }

    private static function notifyAdmin($data)
    {
        Mail::to($data['client']['email'])->send(new NewOrder($data));
    }

    private static function changeWorkingDiapasonState(Request $data)
    {

        if (WorkingDiapasonService::isStateFree($data['working_diapason_start_id'])){
            WorkingDiapasonService::changeState($data['working_diapason_start_id'], WorkingDiapasonService::BOOKED_STATE);
        } else {
            //TODO: Описать ошибку занятого времени
            return response("", 422);
        }
        return null;
    }

    private static function schedulePushNotification($data)
    {
    }

    private static function getFullOrderData(Request $request): array
    {
        $data = $request->all();
        $data['working_diapason'] = WorkingDiapason::find($data['working_diapason_start_id'])->toArray();
        $data['master'] = Master::find($data['working_diapason']['master_id'])->makeVisible('client_id')->toArray();
        $data['client'] = Client::find($data['master']['client_id'])->toArray();

        return $data;
    }

    public static function createOrder(Request $request){

        $data = OrderService::getFullOrderData($request);
        OrderService::changeWorkingDiapasonState($request);
        OrderService::schedulePushNotification($data);
        OrderService::notifyAdmin($data);
        OrderService::notifyGroomer($data);
        OrderService::storeOrder($data);

        return response('',201);
    }

}
