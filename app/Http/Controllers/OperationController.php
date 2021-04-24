<?php

namespace App\Http\Controllers;

use App\Model\Operation;
use App\Model\Transaction;
use App\Model\Service;
use App\Model\Compte;
use App\Model\Typeoperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query();
        //dd($query);
        $services = Service::get();
        $types = Typeoperation::get();
        $operations = Operation::orderBy('created_at', 'desc')->paginate();
        return view('operations.index', compact('operations', 'types', 'services'));
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
        // dd($data);
        $data['user_id'] = $data['operation']['user_id'] = Auth::user()->id;
        $data['typeoperation_id'] = ($type = Typeoperation::find($data['type']))->id;
        $data['service_id'] = $data['operation']['service'] = $data['service'];
        $data['montant'] = $data['montant'];
        $data['client_id'] = $data['is_client'] == 1 ? ($compte = Compte::whereNumero($data['compte'])->firstOrFail())->client_id : null;
        if (isset($data['withaccount'])) {
            $data['transaction']['compte_id'] = $compte->id;
            $data['transaction']['montant'] = $data['montant'];
            $data['transaction']['user_id'] = $data['operation']['user_id'];
            $data['transaction'] = Transaction::_fillWithAutomatic($request, $data);
            $transaction = Transaction::make($data['transaction']);
            $compte->solde += (int)$type->signe * $transaction->montant;
        }
        $data = Operation::_fillWithAutomatic($request, $data);
        $operation = Operation::make($data);
        DB::beginTransaction();
        if(!$operation->save())
            return redirect($request->header('referer'))->with('error', 'Une erreur est survenue lors de l\'enregistrement');
        if (isset($data['withaccount'])) {
            $transaction->operation()->associate($operation);
            $transaction->compte()->associate($compte);
            $trans = $transaction->save();
            if($trans) $trans = $compte->save();
            if(!$trans) {
               DB::rollBack();
               return redirect($request->header('referer'))->with('error', 'Une erreur est survenue lors de l\'enregistrement');
           }
       }
       DB::commit();
       return redirect($request->header('referer'))->with('success', 'L\'Operation a été enregistré avec succès');
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        return view('operations.show', compact('operation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        //
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bilan(Request $request)
    {
        $services = Service::whereActive(1)->get();
        $types = Typeoperation::get();
        return view('operations.bilan', compact('services', 'types'));
    }
}
