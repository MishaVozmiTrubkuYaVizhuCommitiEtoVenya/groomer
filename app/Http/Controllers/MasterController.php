<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Master\MasterDeleteRequest;
use App\Http\Requests\Swagger\v1\Master\MasterGetRequest;
use App\Http\Requests\Swagger\v1\Master\MasterPatchRequest;
use App\Http\Requests\Swagger\v1\Master\MasterPostRequest;
use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Master;
use App\Services\MasterService;
use App\Services\ResponseService;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MasterGetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(MasterGetRequest $request, Client $client): \Illuminate\Http\JsonResponse
    {
        $returnData = MasterService::getItemsList($request, $client);
        return ResponseService::jsonResponse($returnData->jsonContent, $returnData->statusCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MasterPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $masterData = MasterService::createDataFromRequest($request);
        $master = Master::create($masterData);
        return ResponseService::jsonResponse($master, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param MasterGetRequest $request
     * @param \App\Models\Swagger\v1\Master $master
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(MasterGetRequest $request, Client $client, Master $master): \Illuminate\Http\JsonResponse
    {
        $masterData = MasterService::getItem($master);
        return ResponseService::jsonResponse($masterData->jsonContent, $masterData->statusCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Master $master
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MasterPatchRequest $request, Master $master)
    {
        $master->update(
            $request->only(
                [
                    "image",
                    "name",
                    "description",

                ]
            )
        );

        return ResponseService::jsonResponse($master, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Master $master
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MasterDeleteRequest $request, Master $master)
    {
        return ResponseService::jsonResponse($master->delete(), 204);
    }
}
