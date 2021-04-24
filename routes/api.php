<?php

use Illuminate\Http\Request;
use App\Model\Plancompta;
use App\Model\Fournisseur;
use App\Http\Resources\PlancomptaRessource;
use App\Http\Resources\PlancomptasRessource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/plancompta', 'Api\PlancomptaController@index');

Route::get('e', function(Request $request) {
	//return new PlancomptasRessource(Plancompta::paginate());
	return response()->json(Fournisseur::paginate());
});

Route::group(['middleware' => 'cors'], function () {
	Route::prefix('plancompta')->group(function ($route) {
		$route->get('/', 'Api\PlancomptaController@index');
	    $route->get('/{plancompta}', 'Api\PlancomptaController@show');
	    $route->get('/classe/{classe}', 'Api\PlancomptaController@classes');
	    $route->get('/comptegeneral/{cptegen}', 'Api\PlancomptaController@classes');
	});

	Route::prefix('fournisseurs')->group(function ($route) {
		$route->get('/', 'Api\FournisseurController@index');
	    $route->get('/{fournisseur}', 'Api\FournisseurController@show');
	    $route->put('/{fournisseur}', 'Api\FournisseurController@update');
	});

	Route::prefix('participants')->group(function ($route) {
		$route->get('/', 'Api\ParticipantController@index');
	    $route->get('/{participant}', 'Api\ParticipantController@show');
	    $route->put('/{participant}', 'Api\ParticipantController@update');
	});
});

Route::prefix('client')->group(function ($route) {
    $route->get('/', 'Api\ClientController@index');
    $route->get('/{matricule}', 'Api\ClientController@show');
    $route->get('/{matricule}/operations', 'Api\ClientController@operations');
    $route->get('/{matricule}/transactions', 'Api\ClientController@transactions');

    $route->post('/search', 'Api\ClientController@search')->name('s-client');
});

Route::get('/', 'Api\ClientController@index');
Route::get('/{matricule}', 'Api\ClientController@show');
Route::get('/{matricule}/operations', 'Api\ClientController@operations');
Route::get('/{matricule}/transactions', 'Api\ClientController@transactions');

//Route::middleware('auth:api')
//	->get('/user', function (Request $request) {
//		return $request->user();
//});