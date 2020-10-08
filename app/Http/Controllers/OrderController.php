<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Order\OrderGetRequest;
use App\Http\Requests\Swagger\v1\Order\OrderPatchRequest;
use App\Http\Requests\Swagger\v1\Order\OrderPostRequest;
use App\Models\Swagger\v1\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(OrderGetRequest $request)
    {
        $requestParams = $request->only(['limit', 'offset', 'client_id']);

        if ($requestParams) {
            $itemQuery = Order::query();
            $itemQuery->where('client_id', request()->client_id);
            $itemQuery->limit(request()->limit ?? 25);
            $itemQuery->skip(request()->offset ?? 0);
            $order = $itemQuery->get();
        } else {
            $order = Order::limit(25)->get();
        }
        return response($order, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(OrderPostRequest $request)
    {
        $order = Order::create(
            $request->only(
                [
                    "working_diapason_start_id",
                    "working_diapason_end_id",
                    "pet_id",
                    "phone",
                    "pet_name",
                    "owner_name",
                ]
            )
        );
        return response($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        return response($order, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(OrderPatchRequest $request, Order $order)
    {
        $order->update(
            $request->only(
                [
                    "working_diapason_start_id",
                    "working_diapason_end_id",
                    "pet_id",
                    "phone",
                    "pet_name",
                    "owner_name",
                ]
            )
        );

        return response($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        return response($order->delete(), 204);
    }
}
