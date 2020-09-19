<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Client\ClientPatchRequest;
use App\Http\Requests\Swagger\v1\Client\ClientPostRequest;
use App\Models\Swagger\v1\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        return response($client, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientPostRequest $request)
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
        return response($client, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response($client, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientPatchRequest $request, Client $client)
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

        return response($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        return response($client->delete(), 204);
    }
}
