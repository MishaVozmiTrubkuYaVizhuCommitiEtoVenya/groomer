<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Promotion\PromotionDeleteRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionGetRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionPatchRequest;
use App\Http\Requests\Swagger\v1\Promotion\PromotionPostRequest;
use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Promotion;
use App\Services\PromotionService;
use App\Services\ResponseService;
use Illuminate\Http\Response;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PromotionGetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PromotionGetRequest $request, Client $client): \Illuminate\Http\JsonResponse
    {
        $promotion = PromotionService::getItemsList($request, $client);
        return ResponseService::jsonResponse($promotion, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PromotionPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PromotionPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $promotion = PromotionService::createItem($request);
        return ResponseService::jsonResponse($promotion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Promotion $promotion
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(PromotionGetRequest $request, Client $client, Promotion $promotion): \Illuminate\Http\JsonResponse
    {
        return ResponseService::jsonResponse($promotion, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Promotion $promotion
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PromotionPatchRequest $request, Promotion $promotion): \Illuminate\Http\JsonResponse
    {
        PromotionService::updateItem($request, $promotion);
        return ResponseService::jsonResponse($promotion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Promotion $promotion
     * @return Response
     */
    public function destroy(PromotionDeleteRequest $request, Promotion $promotion): Response
    {
        PromotionService::deleteItem($promotion);
        return ResponseService::noContent();
    }
}
