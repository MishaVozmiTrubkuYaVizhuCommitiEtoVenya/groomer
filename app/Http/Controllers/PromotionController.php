<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Promotion\PromotionGetRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionPatchRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionPostRequest;
use App\Models\Swagger\v1\Promotion;
use App\Services\PromotionService;
use Illuminate\Http\Response;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PromotionGetRequest $request
     * @return Response
     */
    public function index(PromotionGetRequest $request): Response
    {
        $promotion = PromotionService::getItemsList($request);
        return response($promotion, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PromotionPostRequest $request
     * @return Response
     */
    public function store(PromotionPostRequest $request): Response
    {
        $promotion = PromotionService::createItem($request);
        return response($promotion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Promotion $promotion
     * @return Response
     */
    public function show(Promotion $promotion): Response
    {
        return response($promotion, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Promotion $promotion
     * @return Response
     */
    public function update(PromotionPatchRequest $request, Promotion $promotion): Response
    {
        PromotionService::updateItem($request, $promotion);
        return response($promotion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Promotion $promotion
     * @return Response
     */
    public function destroy(Promotion $promotion): Response
    {
        PromotionService::deleteItem($promotion);
        return response('', 204);
    }
}
