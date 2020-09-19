<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Service\ServicePatchRequest;
use App\Http\Requests\Swagger\v1\Service\ServicePostRequest;
use App\Models\Swagger\v1\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::all();
        return response($service, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicePostRequest $request)
    {
        $service = Service::create(
            $request->only(
                [
                    "name",
                    "image",
                    "text",
                ]
            )
        );
        return response($service, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Service $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response($service, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServicePatchRequest $request, Service $service)
    {
        $service->update(
            $request->only(
                [
                    "name",
                    "image",
                    "text",
                ]
            )
        );

        return response($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        return response($service->delete(), 204);
    }
}
