<?php

namespace App\Http\Controllers;

use App\Aviso;
use App\Setor;
use Illuminate\Http\Request;

class AvisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('avisos.index',[
            'avisos'    =>  Aviso::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avisos.create',[
            'aviso'    =>  new Aviso,
            'setores'    =>  Setor::all()
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
        $aviso = new Aviso;

        $aviso->fill($request->all());

        $aviso->save();

        return redirect()->route('avisos.index')->with('flash.success', 'Aviso criado com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Aviso $aviso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function edit(Aviso $aviso)
    {
        return view('avisos.edit',[
            'aviso'    =>  $aviso,
            'setores'    =>  Setor::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviso $aviso)
    {
        $aviso->fill($request->all());

        $aviso->save();

        return redirect()->route('avisos.index')->with('flash.success', 'Aviso editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aviso $aviso)
    {
        $aviso->delete();

        return redirect()->route('avisos.index')->with('flash.success', 'Aviso deletado com sucesso');

    }
}
