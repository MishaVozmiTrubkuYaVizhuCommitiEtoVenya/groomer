<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Service\ServiceDeleteRequest;
use App\Http\Requests\Swagger\v1\Service\ServiceGetRequest;
use App\Http\Requests\Swagger\v1\Service\ServicePatchRequest;
use App\Http\Requests\Swagger\v1\Service\ServicePostRequest;
use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Service;
use App\Services\ResponseService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ServiceGetRequest $request, Client $client)
    {
        $requestParams = $request->only(['limit','offset']);

        $itemQuery = $client->services();
        $itemQuery->limit(request()->limit ?? 25);
        $itemQuery->skip(request()->offset ?? 0);
        $service = $itemQuery->get()->makeHidden(['client_id']);
        return ResponseService::jsonResponse($service, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
        return ResponseService::jsonResponse($service, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Service $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ServiceGetRequest $request, Client $client, Service $service)
    {
        return ResponseService::jsonResponse($service, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Service $service
     * @return \Illuminate\Http\JsonResponse
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

        return ResponseService::jsonResponse($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Service $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ServiceDeleteRequest $request, Service $service)
    {
        return ResponseService::jsonResponse($service->delete(), 204);
    }
}
