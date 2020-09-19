<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\WorkingDiapazon\WorkingDiapazonPatchRequest;
use App\Http\Requests\Swagger\v1\WorkingDiapazon\WorkingDiapazonPostRequest;
use App\Models\Swagger\v1\WorkingDiapazon;

class WorkingDiapazonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workingDiapazon = WorkingDiapazon::all();
        return response($workingDiapazon, 200);
    }

    /**
     * WorkingDiapazon a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkingDiapazonPostRequest $request)
    {
        $workingDiapazon = WorkingDiapazon::create(
            $request->only(
                [
                    "type",
                    "name",
                    "image",
                    "settings",
                ]
            )
        );
        return response($workingDiapazon, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\WorkingDiapazon $workingDiapazon
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingDiapazon $workingDiapazon)
    {
        return response($workingDiapazon, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\WorkingDiapazon $workingDiapazon
     * @return \Illuminate\Http\Response
     */
    public function update(WorkingDiapazonPatchRequest $request, WorkingDiapazon $workingDiapazon)
    {
        $workingDiapazon->update(
            $request->only(
                [
                    "time_start",
                    "size",
                    "state",
                ]
            )
        );

        return response($workingDiapazon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\WorkingDiapazon $workingDiapazon
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingDiapazon $workingDiapazon)
    {
        return response($workingDiapazon->delete(), 204);
    }
}
