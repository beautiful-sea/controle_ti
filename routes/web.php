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

Route::get('/','HomeController@index')->name('home') ;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faq','FaqController@index')->name('faq');
Route::post('/users/verifyPersonalAcessToken','UsersController@verifyPersonalAcessToken');
Route::get('/ordem_servicos/{id}/change_status/{status}', 'OrdemServicosController@changeStatus')->name('ordem_servicos.change_status');

Route::resource('equipamentos', 'EquipamentosController')->middleware('can:index');
Route::resource('licencas', 'LicencasController')->middleware('can:index');
Route::resource('produtos', 'ProdutosController')->middleware('can:index');
Route::resource('setores', 'SetoresController')->middleware('can:index');
Route::resource('ramais_valenca', 'RamaisValencaController');
Route::resource('ramais_rj', 'RamaisRJController');
Route::resource('ordem_servicos', 'OrdemServicosController');
Route::resource('avisos', 'AvisosController');
Route::resource('folha_pagamentos', 'FolhaPagamentosController')->middleware('can:RH');

\BeautifulSea\LaravelRamodnil\LaravelRamodnilServiceProvider::routes();