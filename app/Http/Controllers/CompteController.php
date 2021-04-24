<?php

namespace App\Http\Controllers;

use App\Model\Compte;
use App\Model\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = Compte::_fillWithAutomatic($request, $request->all());
        $data['client'] = Client::_fillWithAutomatic($request, $data['client']);
        $data['user_id'] = Auth::user()->id;
        $data['depart'] = $data['old'] = $data['solde'];
        $client = Client::make($data['client']);
        if($client->save()) {
            $compte = Compte::make($data);
            $compte->client()->associate($client);
            $compte->save();
            return redirect($request->header('referer'))->with('success', 'Le client a été enregistré avec succès');
        } else {
            return redirect($request->header('referer'))->with('error', 'Une erreur est survenue lors de l\'enregistrement');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function show(Compte $compte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(Compte $compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compte $compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compte $compte)
    {
        //
    }
}
