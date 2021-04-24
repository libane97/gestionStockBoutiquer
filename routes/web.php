<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/plancompta', 'PlancomptaController@index');

Auth::routes();

// Auth::logout();

Route::middleware('auth')->group(function ($route) {
	$route->get('/', function () { return view('welcome'); });
	$route->get('/home', 'HomeController@index')->name('home');
	$route->get('/services', 'ServiceController@index')->name('l-services');
	$route->get('/service/{service}', 'ServiceController@show')->name('s-service');
	$route->get('/service/{service}/modifier', 'ServiceController@edit')->name('e-service');
	$route->get('/clients', 'ClientController@index')->name('l-clients');
	$route->get('/client/{client}', 'ClientController@show')->name('s-client');
	$route->get('/comptes', 'CompteController@index')->name('l-comptes');
	$route->get('/operations', 'OperationController@index')->name('l-operations');
	$route->get('/caisse', 'CaisseController@index')->name('l-caisse');
	$route->get('/voir-caisse/{caisse}', 'CaisseController@show')->name('s-caisse');
	$route->get('/solder-caisse/{caisse}', 'CaisseController@solder')->name('d-caisse');
	$route->get('/operation/{operation}', 'OperationController@show')->name('s-operation');
	//$route->get('/bilan/{y1?}/{m1?}/{d1?}', 'OperationController@bilan')->name('d-bilan')
	//	->where(['y1' =>'[0-9]{4}', 'm1' =>'0[1-9]|1[0-2]', 'd1' =>'0[1-9]|[12]\d|3[01]']);
	$route->get('/bilan/{y}/{m}/{d}', 'CaisseController@bilan')->name('d-bilan')
		->where(['y' =>'[0-9]{4}', 'm' =>'0[1-9]|1[0-2]', 'd' =>'0[1-9]|[12]\d|3[01]']);


	$route->post('/compte', 'CompteController@store')->name('a-compte');
	$route->post('/client', 'ClientController@store')->name('a-client');
	$route->post('/service', 'ServiceController@store')->name('a-service');
	$route->post('/operation', 'OperationController@store')->name('a-operation');
	$route->post('/caisse', 'CaisseController@store')->name('a-caisse');
	$route->post('/caisse/{caisse}', 'CaisseController@arreter')->name('a-solde');
	$route->post('/transaction', 'TransactionController@store')->name('a-transaction');

	$route->put('/service/{service}', 'ServiceController@update')->name('u-service');
});