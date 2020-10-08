<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Master\MasterGetRequest;
use App\Http\Requests\Swagger\v1\Master\MasterPatchRequest;
use App\Http\Requests\Swagger\v1\Master\MasterPostRequest;
use App\Models\Swagger\v1\Master;
use App\Services\MasterService;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MasterGetRequest $request): \Illuminate\Http\Response
    {
        $returnData = MasterService::getItemsList($request);
        return response($returnData->jsonContent, $returnData->statusCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterPostRequest $request): \Illuminate\Http\Response
    {
        $masterData = MasterService::createDataFromRequest($request);
        $master = Master::create($masterData);
        return response($master, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Master $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master): \Illuminate\Http\Response
    {
        $masterData = MasterService::getItem($master);
        return response($masterData->jsonContent, $masterData->statusCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Master $master
     * @return \Illuminate\Http\Response
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

        return response($master, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Master $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        return response($master->delete(), 204);
    }
}
