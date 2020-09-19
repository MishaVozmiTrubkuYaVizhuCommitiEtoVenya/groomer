<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Order\OrderPatchRequest;
use App\Http\Requests\Swagger\v1\Order\OrderPostRequest;
use App\Models\Swagger\v1\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        return response($order, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderPostRequest $request)
    {
        $order = Order::create(
            $request->only(
                [
                    "working_diapazon_start_id",
                    "working_diapazon_end_id",
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
     * @param \App\Models\Swagger\v1\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response($order, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderPatchRequest $request, Order $order)
    {
        $order->update(
            $request->only(
                [
                    "working_diapazon_start_id",
                    "working_diapazon_end_id",
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
     * @param \App\Models\Swagger\v1\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        return response($order->delete(), 204);
    }
}
