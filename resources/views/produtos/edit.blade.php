@extends('ramodnil.page')

@section('header-title')
    <h1>
        Produto
        <small>Editar</small>
    </h1>
@stop

@section('content')
    @include('produtos.form')
@stop