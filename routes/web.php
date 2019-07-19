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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ordem_servicos/{id}/change_status/{status}', 'OrdemServicosController@changeStatus')->name('ordem_servicos.change_status');

Route::resource('equipamentos', 'EquipamentosController');
Route::resource('licencas', 'LicencasController');
Route::resource('produtos', 'ProdutosController');
Route::resource('setores', 'SetoresController');
Route::resource('ramais_valenca', 'RamaisValencaController');
Route::resource('ramais_rj', 'RamaisRJController');
Route::resource('ordem_servicos', 'OrdemServicosController');

\BeautifulSea\LaravelRamodnil\LaravelRamodnilServiceProvider::routes();