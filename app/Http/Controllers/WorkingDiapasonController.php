<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonGetRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonPatchRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonPostRequest;
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
    public function index(WorkingDiapasonGetRequest $request)
    {

        $returnData = WorkingDiapasonService::getList($request);

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
     * @param \App\Models\Swagger\v1\WorkingDiapason $workingDiapason
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingDiapason $workingDiapason)
    {
        return response($workingDiapason, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\WorkingDiapason $workingDiapason
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WorkingDiapasonPatchRequest $request, WorkingDiapason $workingDiapason)
    {
        $workingDiapason->update(
            $request->only(
                [
                    "time_start",
                    "size",
                    "state",
                ]
            )
        );

        return ResponseService::jsonResponse($workingDiapason, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\WorkingDiapason $workingDiapason
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(WorkingDiapason $workingDiapason)
    {
        return ResponseService::jsonResponse($workingDiapason->delete(), 204);
    }
}
