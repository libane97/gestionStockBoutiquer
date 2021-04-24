<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Transaction extends Model
{
    protected $fillable = ['numero', 'montant', 'user_id', 'operation_id', 'compte_id'];

    public function operation()
    {
        return $this->belongsTo('App\Model\Operation');
    }

    public function compte()
    {
        return $this->belongsTo('App\Model\Compte');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get an array of data.
     *
     * @param  array $data
     * @return array
     */
    public static function _fillWithAutomatic(Request $request, array $data) {
        $data['numero'] = 'TR-' . $data['operation']['service'] . $data['operation']['user_id'] . date('mydisH');
        return $data;
    }
}
