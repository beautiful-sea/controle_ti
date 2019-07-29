<?php

namespace App\Http\Controllers;

use App\Armario;
use App\User;
use Illuminate\Http\Request;

class ArmariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('armarios.index',[
            'armarios'  =>  Armario::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('armarios.create',[
            'armario'  =>  new Armario,
            'usuarios' =>  User::all()
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
        $armario = new Armario;

        $armario->fill($request->all());

        $armario->save();

        return redirect()->route('armarios.index')->with('flash.success','Armário cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Armario  $armario
     * @return \Illuminate\Http\Response
     */
    public function show(Armario $armario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Armario  $armario
     * @return \Illuminate\Http\Response
     */
    public function edit(Armario $armario)
    {
        return view('armarios.edit',[
            'armario'  => $armario,
            'usuarios' =>  User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Armario  $armario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Armario $armario)
    {

        $armario->fill($request->all());

        $armario->save();

        return redirect()->route('armarios.index')->with('flash.success','Armário cadastrado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Armario  $armario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Armario $armario)
    {

        $armario->delete();

        return redirect()->route('armarios.index')->with('flash.success','Armário deletado com sucesso.');
    }
}
