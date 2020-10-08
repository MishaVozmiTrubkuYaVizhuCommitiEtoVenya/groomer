<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Service\ServiceGetRequest;
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
    public function index(ServiceGetRequest $request)
    {
        $requestParams = $request->only(['limit','offset','client_id']);

        if($requestParams){
            $itemQuery = Service::query();
            $itemQuery->where('client_id', request()->client_id);
            $itemQuery->limit(request()->limit ?? 25);
            $itemQuery->skip(request()->offset ?? 0);
            $service = $itemQuery->get();
        } else {
            $service = Service::limit(25)->get();
        }
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
        return($request->all());
        $service = Service::create(
            $request->only(
                [
                    "name",
                    "image",
                    "text", 'client_id'
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
                    "text", 'client_id'
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
