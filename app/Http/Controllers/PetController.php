<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Pet\PetGetRequest;
use App\Http\Requests\Swagger\v1\Pet\PetPatchRequest;
use App\Http\Requests\Swagger\v1\Pet\PetPostRequest;
use App\Models\Swagger\v1\Pet;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PetGetRequest $request)
    {
        $requestParams = $request->only(['limit','offset']);

        if($requestParams){
            $itemQuery = Pet::query();
            $itemQuery->limit(request()->limit ?? 25);
            $itemQuery->skip(request()->offset ?? 0);
            $pet = $itemQuery->get();
        } else {
            $pet = Pet::limit(25)->get();
        }
        return response($pet, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetPostRequest $request)
    {
        $pet = Pet::create(
            $request->only(
                [
                    "name",
                    "average_time_work",
                ]
            )
        );
        return response($pet, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Swagger\v1\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return response($pet, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Swagger\v1\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function update(PetPatchRequest $request, Pet $pet)
    {
        $pet->update(
            $request->only(
                [
                    "name",
                    "average_time_work",
                ]
            )
        );

        return response($pet, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Swagger\v1\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        return response($pet->delete(), 204);
    }
}
