@extends('ramodnil.page')

@section('header-title')
    <h1>
        Ordem de Serviço
        <small>Editar</small>
    </h1>
@stop

@section('content')
    @include('ordem_servicos.form')
@stop