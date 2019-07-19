<?php

namespace App\Http\Controllers;

use App\Licenca;
use Illuminate\Http\Request;
use App\Produto;
class LicencasController extends Controller
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
        $licencas = Licenca::all();
        return view('licencas.index',[
            'licencas'  =>  $licencas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        return view('licencas.create',[
            'licenca'  =>  new Licenca,
            'produtos'  =>  $produtos
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
        $licenca = new Licenca;

        $licenca->fill($request->all());

        $licenca->save();

        return redirect()->route('licencas.index')->with('flash.success', 'Licenca salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Licenca  $licenca
     * @return \Illuminate\Http\Response
     */
    public function show(Licenca $licenca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Licenca  $licenca
     * @return \Illuminate\Http\Response
     */
    public function edit(Licenca $licenca)
    {
        return view('licencas.edit',[
            'licenca'  =>  $licenca
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licenca  $licenca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licenca $licenca)
    {
        $licenca->fill($request->all());

        $licenca->save();

        return redirect()->route('licencas.index')->with('flash.success', 'Licenca salvo com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licenca  $licenca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licenca $licenca)
    {
        $licenca->delete();

        return redirect()->route('licencas.index')->with('flash.success', 'Licenca deletado com sucesso');

    }
}
