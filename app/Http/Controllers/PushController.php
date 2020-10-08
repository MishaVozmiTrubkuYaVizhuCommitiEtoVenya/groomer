<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Push\PushGetRequest;
use App\Http\Requests\Swagger\v1\Push\PushPatchRequest;
use App\Http\Requests\Swagger\v1\Push\PushPostRequest;
use App\Models\Swagger\v1\Push;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PushGetRequest $request)
    {
        $requestParams = $request->only(['limit', 'offset']);

        if ($requestParams) {
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
     * @param Request $request
     * @return Response
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
     * @param Push $push
     * @return Response
     */
    public function show(Push $push)
    {
        return response($push, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Push $push
     * @return Response
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
     * @param Push $push
     * @return Response
     */
    public function destroy(Push $push)
    {
        return response($push->delete(), 204);
    }
}
