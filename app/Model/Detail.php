<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Detail extends Model
{
    protected $fillable = ['nombre', 'caisse_id', 'monnaie_id'];

    public function monnaie()
    {
        return $this->belongsTo('App\Model\Monnaie', 'monnaie_id');
    }
}
