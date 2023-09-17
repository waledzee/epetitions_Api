<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\PetitionResource;
use App\Models\petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return PetitionResource::collection(petition::all());

        return response()->json(new petitionCollection(petition::all()) ,204);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $petition =petition::create($request->only(
            [
                'title','description','category','author','signees'
            ]
            ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function show(petition $petition)
    {
        //
        return new PetitionResource($petition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, petition $petition)
    {
        $petition->update($request->only(
            [
                'title','description','category','author','signees',''
            ]
            ));
            return new PetitionResource($petition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(petition $petition)
    {
        $petition->delete();

        return response()->json(null ,204);
    }
}
