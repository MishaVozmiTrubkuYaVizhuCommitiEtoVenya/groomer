<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\v1\Pet\PetGetRequest;
use App\Http\Requests\Swagger\v1\Pet\PetPatchRequest;
use App\Http\Requests\Swagger\v1\Pet\PetPostRequest;
use App\Models\Swagger\v1\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PetGetRequest $request)
    {
        $requestParams = $request->only(['limit', 'offset']);

        if ($requestParams) {
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
     * @param Request $request
     * @return Response
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
     * @param Pet $pet
     * @return Response
     */
    public function show(Pet $pet)
    {
        return response($pet, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pet $pet
     * @return Response
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
     * @param Pet $pet
     * @return Response
     */
    public function destroy(Pet $pet)
    {
        return response($pet->delete(), 204);
    }
}
