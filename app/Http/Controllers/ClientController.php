<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Client\ClientGetListRequest;
use App\Http\Requests\Swagger\v1\Client\ClientGetRequest;
use App\Http\Requests\Swagger\v1\Client\ClientPatchRequest;
use App\Http\Requests\Swagger\v1\Client\ClientPostRequest;
use App\Models\Swagger\v1\Client;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ClientGetListRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ClientGetListRequest $request): \Illuminate\Http\JsonResponse
    {
        $requestParams = $request->only(['limit', 'offset']);

        if ($requestParams) {
            $clientQuery = Client::query();
            $clientQuery->limit(request()->limit ?? 25);
            $clientQuery->skip(request()->offset ?? 0);
            $client = $clientQuery->get();
        } else {
            $client = Client::limit(25)->get();
        }

        return ResponseService::jsonResponse($client, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClientPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $client = Client::create(
            $request->only(
                [
                    "type",
                    "name",
                    "image",
                    "settings",
                ]
            )
        );
        return ResponseService::jsonResponse($client, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client): \Illuminate\Http\JsonResponse
    {
        return ResponseService::jsonResponse($client, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ClientPatchRequest $request, Client $client): \Illuminate\Http\JsonResponse
    {
        $client->update(
            $request->only(
                [
                    "type",
                    "name",
                    "image",
                    "settings",
                ]
            )
        );

        return ResponseService::jsonResponse($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Response
     */
    public function destroy(Client $client): Response
    {
        $client->delete();
        return  ResponseService::noContent();
    }
}
