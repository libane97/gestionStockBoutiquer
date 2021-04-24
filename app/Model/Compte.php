<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Compte extends Model
{
    protected $fillable = ['numero', 'depart', 'old', 'solde', 'active', 'user_id', 'client_id'];

    public function client()
    {
        return $this->belongsTo('App\Model\Client');
    }

 //    public function getSoldeAttribute($value)
	// {
	//     return number_format($value, 0, ' ', ' ');
	// }

    /**
     * Get an array of data.
     *
     * @param  array $data
     * @return array
     */
    public static function _fillWithAutomatic(Request $request, array $data) {
        $data['numero'] = 'C-' . date('dmyHis');
        return $data;
    }

    public function transactions()
    {
        return $this->hasMany('App\Model\Transaction');
        // return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
