<?php

namespace App\Http\Controllers;

use App\FolhaPagamento;
use App\User;
use Illuminate\Http\Request;

class FolhaPagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folha_pagamentos = 
        (auth()->user()->role == 0 ||  auth()->user()->role == 2 )
        ?FolhaPagamento::all()
        :FolhaPagamento::where('usuarios_id',auth()->user()->id)->get();

        return view('folha_pagamentos.index',[
            'folha_pagamentos'  =>  $folha_pagamentos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('folha_pagamentos.create',[
            'folha_pagamentos'  =>  new FolhaPagamento,
            'usuarios'          =>  User::all()
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
        $folha_pagamento = new FolhaPagamento;

        $folha_pagamento->fill($request->all());

        if ($request->hasFile('arquivo')) {
            $extensao = $request->file('arquivo')->getClientOriginalExtension();

            $folha_pagamento->extensao = $extensao;
        }

        //Converte a data para obter o nome do diretorio no timpo ano/mes
        $diretorio = date("Y/m",strtotime($folha_pagamento->periodo));
        $folha_pagamento->save();

        if ($request->hasFile('arquivo')) {
            $request->file('arquivo')->move(base_path('/public/files/folha_pagamentos/'.$diretorio), sprintf('%s.%s', $folha_pagamento->usuarios_id, $extensao));
        }

        return redirect()->route('folha_pagamentos.index')->with('flash.success', 'Folha de pagamento cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FolhaPagamento  $folhaPagamento
     * @return \Illuminate\Http\Response
     */
    public function show(FolhaPagamento $folhaPagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FolhaPagamento  $folhaPagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(FolhaPagamento $folhaPagamento)
    {
        return view('folha_pagamentos.edit',[
            'folha_pagamentos'  =>  $folhaPagamento,
            'usuarios'          =>  User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FolhaPagamento  $folhaPagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FolhaPagamento $folhaPagamento)
    {
        $folha_pagamento = $folhaPagamento;

        $folha_pagamento->fill($request->all());

        if ($request->hasFile('arquivo')) {
            $extensao = $request->file('arquivo')->getClientOriginalExtension();

            $folha_pagamento->extensao = $extensao;
        }

        //Converte a data para obter o nome do diretorio no timpo ano/mes
        $diretorio = date("Y/m",strtotime($folha_pagamento->periodo));
        $folha_pagamento->save();

        if ($request->hasFile('arquivo')) {
            $request->file('arquivo')->move(base_path('/public/files/folha_pagamentos/'.$diretorio), sprintf('%s.%s', $folha_pagamento->usuarios_id, $extensao));
        }

        return redirect()->route('folha_pagamentos.index')->with('flash.success', 'Folha de pagamento editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FolhaPagamento  $folhaPagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(FolhaPagamento $folhaPagamento)
    {
        $folhaPagamento->delete();

        return redirect()->route('folha_pagamentos.index')->with('flash.success', 'Folha de pagamento apagada com sucesso');
    }
}
