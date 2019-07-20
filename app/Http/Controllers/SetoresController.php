<?php

namespace App\Http\Controllers;

use App\Setor;
use Illuminate\Http\Request;

class SetoresController extends Controller
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
        $setor = Setor::all();
        return view('setores.index',[
            'setor'  =>  $setor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setores.create',[
            'setor'  =>  new Setor
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
        $setor = new Setor;

        $request['name'] = strtoupper($request->name);

        $setor->fill($request->all());

        $setor->save();

        return redirect()->route('setores.index')->with('flash.success', 'Setor salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function show(Setor $setor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function edit(Setor $setor,$id)
    {
        $setor = Setor::find($id);
        return view('setores.edit',[
            'setor'  =>  $setor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setor $setor,$id)
    {
        $setor = Setor::find($id);

        $setor->fill($request->all());

        $setor->save();

        return redirect()->route('setores.index')->with('flash.success', 'Setor salvo com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setor $setor,$id)
    {
        $setor = Setor::find($id);

        $setor->delete();

        return redirect()->route('setores.index')->with('flash.success', 'Setor deletado com sucesso');

    }
}
