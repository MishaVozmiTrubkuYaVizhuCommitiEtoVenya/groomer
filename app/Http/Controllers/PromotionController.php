<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $promotion = Promotion::all();
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
                    "url",
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
                    "url",
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
