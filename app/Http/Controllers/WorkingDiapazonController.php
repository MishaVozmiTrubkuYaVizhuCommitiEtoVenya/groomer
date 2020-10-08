<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonGetRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonPatchRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapason\WorkingDiapasonPostRequest;
use App\Models\Swagger\v1\WorkingDiapason;

class WorkingDiapasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param WorkingDiapasonGetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(WorkingDiapasonGetRequest $request)
    {
        $requestParams = $request->only(['limit','offset', 'master_id']);

        if($requestParams){
            $itemQuery = WorkingDiapason::query();
            $itemQuery->where('master_id', request()->master_id);
            $itemQuery->limit(request()->limit ?? 25);
            $itemQuery->skip(request()->offset ?? 0);
            $workingDiapason = $itemQuery->get();
        } else {
            $workingDiapason = WorkingDiapason::limit(25)->get();
        }
        return response($workingDiapason, 200);
    }

    /**
     * WorkingDiapason a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
        return response($workingDiapason, 201);
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
     * @return \Illuminate\Http\Response
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

        return response($workingDiapason, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\WorkingDiapason $workingDiapason
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingDiapason $workingDiapason)
    {
        return response($workingDiapason->delete(), 204);
    }
}
