<?php

namespace App\Http\Controllers;

use App\RamaisValenca;
use Illuminate\Http\Request;
use App\Setor;
use App\User;

class RamaisValencaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ramais = RamaisValenca::all();
        return view('ramais_valenca.index',[
            'ramais'  =>  $ramais
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setores = Setor::all();
        $usuarios = User::all();
        return view('ramais_valenca.create',[
            'ramal'  =>  new RamaisValenca,
            'setores'=> $setores,
            'usuarios'  =>  $usuarios
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ramal = new RamaisValenca;

        $ramal->fill($request->all());

        $ramal->save();

        return redirect()->route('ramais_valenca.index')->with('flash.success', 'Ramal salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RamaisValenca  $ramal
     * @return \Illuminate\Http\Response
     */
    public function show(RamaisValenca $ramal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RamaisValenca  $ramal
     * @return \Illuminate\Http\Response
     */
    public function edit(RamaisValenca $ramal,$id)
    {
        $setores = Setor::all();
        $usuarios = User::all();
        $ramal = RamaisValenca::find($id);
        return view('ramais_valenca.edit',[
            'ramal'  =>  $ramal,
            'setores'=>  $setores,
            'usuarios'  =>  $usuarios
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RamaisValenca  $ramal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RamaisValenca $ramal,$id)
    {
        $ramal = RamaisValenca::find($id);

        $ramal->fill($request->all());

        $ramal->save();

        return redirect()->route('ramais_valenca.index')->with('flash.success', 'Ramal salvo com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RamaisValenca  $ramal
     * @return \Illuminate\Http\Response
     */
    public function destroy(RamaisValenca $ramal,$id)
    {
        $ramal = RamaisValenca::find($id);

        $ramal->delete();

        return redirect()->route('ramais_valenca.index')->with('flash.success', 'Ramal deletado com sucesso');

    }
}
