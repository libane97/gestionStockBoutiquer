<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Caisse extends Model
{
    protected $fillable = ['veille', 'appro', 'solde', 'creance', 'date', 'fermeture', 'statut', 'user_id'];

    protected $dates = ['date', 'fermeture'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function details()
    {
        return $this->hasMany('App\Model\Detail');
    }

    public function mouvements()
    {
        return $this->hasMany('App\Model\Mouvement');
    }
}
