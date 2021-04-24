<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Mouvement extends Model
{
    protected $fillable = ['encaissement', 'decaissement', 'service_id', 'caisse_id'];

    public function service()
    {
        return $this->belongsTo('App\Model\Service');
    }
}
