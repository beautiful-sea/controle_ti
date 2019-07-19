@extends('ramodnil.page')

@section('header-title')
    <h1>
        Produtos
        <small>Criar</small>
    </h1>
@stop

@section('content')
    @include('produtos.form')
@stop