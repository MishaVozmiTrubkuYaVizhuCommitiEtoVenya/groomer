<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonDeleteRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonGetRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonPatchRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonPostRequest;
use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Master;
use App\Models\Swagger\v1\WorkingDiapason;
use App\Services\ResponseService;
use App\Services\WorkingDiapasonService;

class WorkingDiapasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param WorkingDiapasonGetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(WorkingDiapasonGetRequest $request, Client $client, Master $master)
    {

        $returnData = WorkingDiapasonService::getList($request, $master);

        return ResponseService::jsonResponse($returnData, 200);
    }

    /**
     * WorkingDiapason a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WorkingDiapasonPostRequest $request)
    {
        $workingDiapason = WorkingDiapason::create(
            $request->only(
                [
                    "type",
                    "name",
                    "image",
                    "settings",
                    "master_id",
                ]
            )
        );
        return ResponseService::jsonResponse($workingDiapason, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\WorkingDiapason $diapason
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingDiapasonGetRequest $request, Client $client, Master $master, WorkingDiapason $diapason)
    {
        return response($diapason->makeHidden(['master_id']), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\WorkingDiapason $diapason
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WorkingDiapasonPatchRequest $request, WorkingDiapason $diapason)
    {
        $diapason->update(
            $request->only(
                [
                    "time_start",
                    "size",
                    "state",
                ]
            )
        );

        return ResponseService::jsonResponse($diapason, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\WorkingDiapason $diapason
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(WorkingDiapasonDeleteRequest $request, WorkingDiapason $diapason)
    {
        return ResponseService::jsonResponse($diapason->delete(), 204);
    }
}
