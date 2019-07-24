<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setor;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $avisos = DB::table('avisos')->whereRaw('(NOW() BETWEEN data_inicio AND data_fim) AND (setor_id = '.auth()->user()->setor_id.' || setor_id is null)')->get();

        
        $avisos = $this->buscaESubstituiComandosNoAviso($avisos);

        return view('home',[
            "avisos"    =>  $avisos
        ]);
    }

    public function buscaESubstituiComandosNoAviso($avisos){
        foreach ($avisos as $key => $aviso) {
            $avisos[$key]->titulo = str_replace('{SETOR}', Setor::find(auth()->user()->setor_id)->name, $aviso->titulo);
        }

        foreach ($avisos as $key => $aviso) {
            $avisos[$key]->descricao = str_replace('{SETOR}', Setor::find(auth()->user()->setor_id)->name, $aviso->descricao);
        }

        foreach ($avisos as $key => $aviso) {
            $nome_usuario = explode(' ',auth()->user()->name);
            $avisos[$key]->titulo = str_replace('{COLABORADOR}', $nome_usuario[0], $aviso->titulo);
        }

        foreach ($avisos as $key => $aviso) {
            $nome_usuario = explode(' ',auth()->user()->name);
            $avisos[$key]->descricao = str_replace('{COLABORADOR}', $nome_usuario[0], $aviso->descricao);
        }

        return $avisos;
    }
}
