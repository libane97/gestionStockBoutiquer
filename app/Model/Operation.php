<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Operation extends Model
{
    protected $fillable = ['code', 'montant', 'client_id', 'user_id', 'typeoperation_id', 'service_id', 'compte_id'];

    /**
     * Get an array of data.
     *
     * @param  array $data
     * @return array
     */
    public static function _fillWithAutomatic(Request $request, array $data) {
        $data['code'] = 'OP-' . $data['service'] . $data['type'] . date('mydisH');
        return $data;
    }

    public function service()
    {
        return $this->belongsTo('App\Model\Service');
    }

    public function typeoperation()
    {
        return $this->belongsTo('App\Model\Typeoperation');
    }

    public function client()
    {
        return $this->belongsTo('App\Model\Client', 'client_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
