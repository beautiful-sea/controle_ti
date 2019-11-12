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

// ROTAS CONFIGURADAS MANUALMENTE
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faq','FaqController@index')->name('faq');
Route::post('/users/verifyPersonalAcessToken','UsersController@verifyPersonalAcessToken');
Route::get('/ordem_servicos/{id}/change_status/{status}', 'OrdemServicosController@changeStatus')->name('ordem_servicos.change_status');



Route::get('/ordem_servicos/nao_confirmadas',function(){

	// Se o usuario for do TI
	if(auth()->user()->role == 0){
		$nao_confirmadas = auth()->user()->ordemServicos()->where('resolvido_confirmado',null)->where('para_setor_ti',0)->where('status',3)->get();
	}elseif(auth()->user()->role == 4){//Se o usuario for da manutencao
		$nao_confirmadas = auth()->user()->ordemServicos()->where('resolvido_confirmado',null)->where('para_setor_ti',1)->where('status',3)->get();
	}else{
		$nao_confirmadas = auth()->user()->ordemServicos()->where('resolvido_confirmado',null)->where('status',3)->get();
	}

	return response()->json($nao_confirmadas);
});


//ROTAS DE RELATORIOS
Route::post('/relatorio', 'ReportController@index')->middleware('can:ADMIN');//Rota para gerar relatorio a partir dos parametros


//ROTAS GERADAS COM RESOURCES
Route::resource('equipamentos', 'EquipamentosController')->middleware('can:TI_MANUTENCAO');
Route::resource('licencas', 'LicencasController')->middleware('can:index');
Route::resource('produtos', 'ProdutosController')->middleware('can:index');
Route::resource('setores', 'SetoresController')->middleware('can:index');
Route::resource('ramais_valenca', 'RamaisValencaController');
Route::resource('ramais_rj', 'RamaisRJController');
Route::resource('ordem_servicos', 'OrdemServicosController');
Route::resource('armarios', 'ArmariosController')->middleware('can:RECEPCAO');
Route::resource('avisos', 'AvisosController');
Route::resource('relatorios', 'RelatoriosController');
Route::resource('folha_pagamentos', 'FolhaPagamentosController')->middleware('can:RH');

\BeautifulSea\LaravelRamodnil\LaravelRamodnilServiceProvider::routes();