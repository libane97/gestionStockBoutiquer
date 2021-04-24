<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Client extends Model
{
    protected $fillable = ['matricule', 'nom', 'prenom', 'telephone', 'email', 'sexe', 'active', 'compte_id'];

    // protected $primaryKey = 'matricule';
    // protected $keyType    = 'string';

    // public function compte()
    // {
    //     return $this->belongsTo('App\Model\Compte', 'compte_id');
    // }

    public function getTelephoneAttribute($value)
    {
        return substr($value, 0, 2) . ' ' . substr($value, 2, 3) . ' ' . substr($value, 5, 2) . ' ' . substr($value, 7, 3);
    }

    /**
     * Get an array of data.
     *
     * @param  array $data
     * @return array
     */
    public static function _fillWithAutomatic(Request $request, array $data) {
        $data['matricule'] = substr($data['prenom'], 0, 1) . substr($data['nom'], 0, 1). '-' . date('dmy');
        return $data;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
    	return Validator::make($data, [
    		'nom' => 'required|string|max:120',
    		'prenom' => 'required|string|max:120',
    		'telephone' => 'required|string|min:9|max:50',
    		'email' => 'string|email|max:255'
    	]);
    }
}
