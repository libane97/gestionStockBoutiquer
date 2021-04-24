<?php

namespace App\Http\Controllers;

use App\Model\Plancompta;
use Illuminate\Http\Request;

class PlancomptaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plancompta::paginate();
        return view('plancompta.index', compact('plans'));
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
     * @param  \App\Model\Plancompta  $plancompta
     * @return \Illuminate\Http\Response
     */
    public function show(Plancompta $plancompta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Plancompta  $plancompta
     * @return \Illuminate\Http\Response
     */
    public function edit(Plancompta $plancompta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Plancompta  $plancompta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plancompta $plancompta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Plancompta  $plancompta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plancompta $plancompta)
    {
        //
    }
}
