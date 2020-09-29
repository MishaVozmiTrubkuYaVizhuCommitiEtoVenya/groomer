<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Push\PushGetRequest;
use App\Http\Requests\Swagger\v1\Push\PushPatchRequest;
use App\Http\Requests\Swagger\v1\Push\PushPostRequest;
use App\Models\Swagger\v1\Push;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PushGetRequest $request)
    {
        $requestParams = $request->only(['limit','offset']);

        if($requestParams){
            $itemQuery = Push::query();
            $itemQuery->limit(request()->limit ?? 25);
            $itemQuery->skip(request()->offset ?? 0);
            $push = $itemQuery->get();
        } else {
            $push = Push::limit(25)->get();
        }
        return response($push, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PushPostRequest $request)
    {
        $push = Push::create(
            $request->only(
                [
                    "type",
                    "name",
                    "image",
                    "settings",
                ]
            )
        );
        return response($push, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Push $push
     * @return \Illuminate\Http\Response
     */
    public function show(Push $push)
    {
        return response($push, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Push $push
     * @return \Illuminate\Http\Response
     */
    public function update(PushPatchRequest $request, Push $push)
    {
        $push->update(
            $request->only(
                [
                    "type",
                    "name",
                    "image",
                    "settings",
                ]
            )
        );

        return response($push, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Push $push
     * @return \Illuminate\Http\Response
     */
    public function destroy(Push $push)
    {
        return response($push->delete(), 204);
    }
}
