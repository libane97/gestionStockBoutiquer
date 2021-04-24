<?php

namespace App\Http\Controllers\Api;

use App\Model\Fournisseur;
use App\Http\Resources\FournisseurResource;
use App\Http\Resources\FournisseursResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FournisseursResource(Fournisseur::paginate(50));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        return new FournisseurResource($fournisseur);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
    	$data = $request->all();
    	//$f = Fournisseur::whereId($fournisseur->id);
        //return;
        return $fournisseur->update($data)
                ? new FournisseurResource(Fournisseur::whereId($fournisseur->id)->first())
                : response()->json(['error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        //
    }
}
