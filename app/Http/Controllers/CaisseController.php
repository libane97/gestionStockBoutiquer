<?php

namespace App\Http\Controllers;

use App\Model\Caisse;
use App\Model\Service;
use App\Model\Mouvement;
use App\Model\Monnaie;
use App\Model\Detail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $request->query();
        $caisses = $user->profil ?
                    Caisse::orderBy('created_at', 'desc')->paginate() :
                    Caisse::orderBy('created_at', 'desc')->whereUser_id($user->id)->paginate();
        return view('caisse.index', compact('caisses'));
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
        $data['user_id'] = $data['user_id'] = Auth::user()->id;
        $data['date'] = date('Y-m-d');
        $data['statut'] = 0;
        $caisse = Caisse::make($data);
        if($caisse->save())
            return redirect($request->header('referer'))->with('success', 'La caisse a été enregistrée avec succès');
        else
            return redirect($request->header('referer'))->with('error', 'Une erreur interne est survenue');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function arreter(Request $request, Caisse $caisse)
    {
        if(!$user->profil and $user->id != $caisse->user_id)
            return redirect(route('l-caisse'))->with('error', 'Vous n\'etes pas autorisé à solder cette caisse');
        $data = $request->all();
        Detail::insert($data['details']);
        Mouvement::insert($data['mouvements']);
        if($caisse->update(['fermeture' => date('Y-m-d H:i:s'), 'appro' => $data['caisse']['appro'], 'creance' => $data['caisse']['creance'], 'statut' => 1]))
            return redirect(route('s-caisse', $caisse->id))->with('success', 'La caisse a été arretée avec succès');
        else
            return redirect($request->header('referer'))->with('error', 'Une erreur interne est survenue');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function solder(Caisse $caisse)
    {
        $user = Auth::user();
        if(!$user->profil and $user->id != $caisse->user_id)
            return redirect(route('l-caisse'))->with('error', 'Vous n\'etes pas autorisé à solder cette caisse');
        $services = Service::get();
        $monnaies = Monnaie::get();
        $mouvements = Mouvement::whereCaisse_id($caisse->id)->get();
        return view('caisse.solder', compact('caisse', 'services', 'monnaies', 'mouvements'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function show(Caisse $caisse)
    {
        $user = Auth::user();
        if(!$user->profil and $user->id != $caisse->user_id)
            return redirect(route('l-caisse'))->with('error', 'Vous n\'etes pas autorisé à visualiser cette caisse');
        $services = Service::get();
        $monnaies = Monnaie::get();
        $details = Detail::whereCaisse_id($caisse->id)->orderBy('id')->get();
        $mouvements = Mouvement::whereCaisse_id($caisse->id)->get();
        return view('caisse.show', compact('caisse', 'services', 'monnaies', 'details', 'mouvements'));
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
        $sg = $request->segments();
        $dt = substr(str_replace('/', '-', $request->path()), 6);
        $caisses = Caisse::where(['date' => $dt])->with(['Details', 'Mouvements'])->get();
        $services = Service::whereActive(1)->get();
        return view('caisse.bilan', compact('services', 'caisses'));
    }
}