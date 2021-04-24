<?php

namespace App\Http\Controllers\Api;

use App\Model\Client;
use App\Model\Compte;
use App\Model\Service;
use App\Model\Transaction;
use App\Model\Typeoperation;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate();
        return view('clients.index', compact('clients'));
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
        $data = Client::_fillWithAutomatic($request, $request->all());
        Client::validator($data);
        $client = Client::make($data);
        if($client->save($data)) {
            return redirect($request->header('referer'))->with('success', 'Le client a été enregistré avec succès');
        } else {
            return redirect($request->header('referer'))->with('error', 'Une erreur est survenue lors de l\'enregistrement');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $client->compte = Compte::whereClient_id($client->id)->first();
        $services = Service::get();
        $types = Typeoperation::get();
        $transactions = Transaction::whereCompte_id($client->compte->id)->paginate();
        // dd($transactions);
        return view('clients.show', compact('client', 'transactions', 'types', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $client = Client::whereEmail($request->get('key'))->orWhere(['telephone' => $request->get('key')])->first();
        if ($client) {
            $compte = Compte::whereClient_id($client->id)->first();
            $compte->client = $client;
        } else {
            $compte = Compte::whereNumero($request->get('key'))->with('Client')->first();
        }
        return $compte;
    }
}
