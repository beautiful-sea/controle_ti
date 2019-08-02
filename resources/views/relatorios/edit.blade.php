@extends('ramodnil.page')

@section('header-title')
    <h1>
        Equipamento
        <small>Editar</small>
    </h1>
@stop

@section('content')
    @include('equipamentos.form')
@stop