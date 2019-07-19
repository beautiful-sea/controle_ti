<?php

namespace App\Http\Controllers;

use App\RamaisRJ;
use Illuminate\Http\Request;
use App\Setor;

class RamaisRJController extends Controller
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
        $ramais = RamaisRJ::all();
        return view('ramais_rj.index',[
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
        return view('ramais_rj.create',[
            'ramal'  =>  new RamaisRJ,
            'setores'=> $setores
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
        $ramal = new RamaisRJ;

        $ramal->fill($request->all());

        $ramal->save();

        return redirect()->route('ramais_rj.index')->with('flash.success', 'Ramal salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RamaisRJ  $ramal
     * @return \Illuminate\Http\Response
     */
    public function show(RamaisRJ $ramal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RamaisRJ  $ramal
     * @return \Illuminate\Http\Response
     */
    public function edit(RamaisRJ $ramal,$id)
    {
        $setores = Setor::all();
        $ramal = RamaisRJ::find($id);
        return view('ramais_rj.edit',[
            'ramal'  =>  $ramal,
            'setores'=>  $setores
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RamaisRJ  $ramal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RamaisRJ $ramal,$id)
    {
        $ramal = RamaisRJ::find($id);

        $ramal->fill($request->all());

        $ramal->save();

        return redirect()->route('ramais_rj.index')->with('flash.success', 'Ramal salvo com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RamaisRJ  $ramal
     * @return \Illuminate\Http\Response
     */
    public function destroy(RamaisRJ $ramal,$id)
    {
        $ramal = RamaisRJ::find($id);

        $ramal->delete();

        return redirect()->route('ramais_rj.index')->with('flash.success', 'Ramal deletado com sucesso');

    }
}
