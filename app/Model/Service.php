<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\MyFunctions\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Service extends Model
{
    protected $fillable = ['link', 'libelle', 'logo', 'description', 'active'];

    // protected $primaryKey = 'link';
    // protected $keyType    = 'string';

    /**
     * Get an array of data.
     *
     * @param  array $data
     * @return array
     */
    public static function _fillWithAutomatic(Request $request, array $data) {
        $data['link'] = Functions::Code_($data['libelle']);
        $data['description'] = Functions::Code_($data['libelle']);
    	$data['active'] = $data['active'] == 'on' ? 1:0;
        if($request->logo and $request->logo->isValid()):
            $logo = $request->logo;
            $data['logo'] = 'media/logos/' . $data['link'] . rand(222, 56576) . date('isHymd') . '.' . $logo->guessClientExtension();
            $data['logo_'] = $logo;
        endif;
    	return $data;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validate(array $data)
    {
        return Validator::make($data, [
            'libelle' => 'required|string|min:3|max:120',
            'description' => 'required|min:120',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
