<?php

namespace App\Http\Controllers\Api;

use App\Model\Participant;
use App\Http\Resources\ParticipantResource;
use App\Http\Resources\ParticipantsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ParticipantsResource(Participant::paginate(100));
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
     * @param  \App\Model\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        return new ParticipantResource($participant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $data = $request->all();
        return $participant->update($data)
                ? new ParticipantResource(Participant::whereId($participant->id)->first())
                : response()->json(['error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
