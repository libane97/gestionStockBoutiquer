<?php

namespace App\Http\Controllers;

use App\Model\Transaction;
use App\Model\Operation;
use App\Model\Typeoperation;
use App\Model\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
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
        $data = $request->all();
        $data['operation']['is_client'] = 1;
        $data['operation']['user_id'] = $data['user_id'] = Auth::user()->id;
        $data['operation']['typeoperation_id'] = ($type = Typeoperation::find($data['operation']['type']))->id;
        $data['operation']['service_id'] = $data['operation']['service'];
        $data['operation']['montant'] = $data['montant'];
        $data['operation'] = Operation::_fillWithAutomatic($request, $data['operation']);
        $data['compte_id'] = ($compte = Compte::whereNumero($data['compte'])->firstOrFail())->id;
        $data = Transaction::_fillWithAutomatic($request, $data);
        $operation = Operation::make($data['operation']);
        $transaction = Transaction::make($data);
        $compte->solde += (int)$type->signe * $transaction->montant;
        try {
            DB::transaction(function () use ($operation, $transaction, $compte, $request) {
                $operation->save();
                $transaction->operation()->associate($operation);
                $transaction->compte()->associate($compte);
                $transaction->save();
                $compte->save();
            });
        } catch (Exception $e) {
            return redirect($request->header('referer'))->with('error', 'Une erreur est survenue lors de l\'enregistrement');
        }
        return redirect($request->header('referer'))->with('success', 'L\'Operation a été enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
