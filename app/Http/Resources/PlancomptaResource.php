<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PlancomptaResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'       => (string)$this->id,
            'attr'     => [
                'classe' => $this->classe,
                'cptegen' => $this->cptegen,
                'souscpte' => $this->souscpte,
                'compte' => $this->compte,
                'intitule' => $this->intitule
            ],
        ];
    }
}
