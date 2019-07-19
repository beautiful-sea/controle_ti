<?php

namespace App\Http\Controllers;

use App\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicosController extends Controller
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
        $ordem_servicos = OrdemServico::all();
        return view('ordem_servicos.index',[
            'ordem_servicos'  =>  $ordem_servicos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ordem_servicos.create',[
            'ordem_servico'  =>  new OrdemServico
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
        $dados = $request->all();

        $dados['status'] = 0;

        $ordem_servico = new OrdemServico;

        $ordem_servico->fill($dados);

        if ($request->hasFile('arquivo')) {
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            $ordem_servico->img_extension = $extension;
        }

        $ordem_servico->save();


        if ($request->hasFile('arquivo')) {
            $request->file('arquivo')->move(base_path('/public/files/ordem_servico'), sprintf('%s.%s', $ordem_servico->id, $extension));
        }

        return redirect()->route('ordem_servicos.index')->with('flash.success', 'Ordem de Serviço salva com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemServico  $ordem_servico
     * @return \Illuminate\Http\Response
     */
    public function show(OrdemServico $ordem_servico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdemServico  $ordem_servico
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdemServico $ordem_servico)
    {
        return view('ordem_servicos.edit',[
            'ordem_servico'  =>  $ordem_servico
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemServico  $ordem_servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemServico $ordem_servico)
    {
        $ordem_servico->fill($request->all());

        if ($request->hasFile('arquivo')) {
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            $ordem_servico->img_extension = $extension;
        }

        $ordem_servico->save();

        if ($request->hasFile('arquivo')) {
            $extension = $request->file('arquivo')->getClientOriginalExtension();

            $request->file('arquivo')->move(base_path('/public/files/ordem_servico'), sprintf('%s.%s', $ordem_servico->id, $extension));
        }

        return redirect()->route('ordem_servicos.index')->with('flash.success', 'Ordem de Serviço salva com sucesso');
    }

    public function changeStatus(Request $request, OrdemServico $ordem_servico,$id,$status)
    {
        $ordem_servico = OrdemServico::find($id);

        $ordem_servico->status = $status;

        $ordem_servico->save();

        return redirect()->route('ordem_servicos.index')->with('flash.success', 'Ordem de Serviço atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdemServico  $ordem_servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdemServico $ordem_servico)
    {
        $ordem_servico->delete();

        return redirect()->route('ordem_servicos.index')->with('flash.success', 'Ordem de Serviço deletada com sucesso');

    }


}
