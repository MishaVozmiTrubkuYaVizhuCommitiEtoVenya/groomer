<?php


namespace App\Services;


use App\Models\Swagger\v1\Order;
use Illuminate\Support\Facades\Request;

class OrderService
{
    private static function notifyGroomer()
    {

    }

    private static function storeOrder($data)
    {
        Order::create($data);
    }

    private static function notifyAdmin()
    {
    }

    private static function changeWorkingDiapasonState(Request $data)
    {

    }

    private static function schedulePushNotification($data)
    {
    }

    private static function getFullOrderData(Request $request): Request
    {
        return $request;
    }

    public function createOrder(Request $request){

        $data = OrderService::getFullOrderData($request);
        OrderService::schedulePushNotification($data);
        OrderService::changeWorkingDiapasonState($data);
        OrderService::notifyAdmin();
        OrderService::notifyGroomer();
        OrderService::storeOrder($data);

        return response('',201);
    }

}
