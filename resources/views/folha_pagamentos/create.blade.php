@extends('ramodnil.page')

@section('header-title')
    <h1>
        Folha de Pagamento
        <small>Cadastrar</small>
    </h1>
@stop

@section('content')
    @include('folha_pagamentos.form')
@stop