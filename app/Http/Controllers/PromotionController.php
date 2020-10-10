<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Promotion\PromotionGetRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionPatchRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionPostRequest;
use App\Models\Swagger\v1\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PromotionGetRequest $request)
    {
        $requestParams = $request->only(['limit','offset','client_id', "date_start", "date_end"]);

        $itemQuery = Promotion::query();
        $itemQuery->when(isset($requestParams['date_start']), function($q) use ($requestParams) {
            $q->where('time_start','>=', $requestParams['date_start']);
        });
        $itemQuery->when(isset($requestParams['date_end']), function($q) use ($requestParams) {
            $q->where('time_start','<=', $requestParams['date_end']);
        });
        $itemQuery->where('client_id', $requestParams['client_id']);
        $itemQuery->limit($requestParams['limit'] ?? 25);
        $itemQuery->skip($requestParams['offset'] ?? 0);
        $promotion = $itemQuery->get();

        return response($promotion, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionPostRequest $request)
    {
        $promotion = Promotion::create(
            $request->only(
                [
                    "title",
                    "text",
                    "image",
                    "url", 'client_id'
                ]
            )
        );
        return response($promotion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return response($promotion, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionPatchRequest $request, Promotion $promotion)
    {
        $promotion->update(
            $request->only(
                [
                    "title",
                    "text",
                    "image",
                    "url", 'client_id'
                ]
            )
        );

        return response($promotion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        return response($promotion->delete(), 204);
    }
}
