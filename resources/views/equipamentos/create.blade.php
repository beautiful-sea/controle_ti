@extends('ramodnil.page')

@section('header-title')
    <h1>
        Equipamentos
        <small>Criar</small>
    </h1>
@stop

@section('content')
    @include('equipamentos.form')
@stop