@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Relatórios</h4>
</div>
@stop


@section('content')

<form method="post" action="/relatorio">
    @csrf
    <div class="card">
        <div class="card-header">
            Controle de Suporte a Equipamentos
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Inicial</label>
                        <input class="form-control" type="date" name="params[data_inicio]">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Final</label>
                        <input class="form-control" type="date" name="params[data_fim]">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="pull-right">
                <button class="btn btn-success" type="submit">Gerar Relatório</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('js')
<script>
    $('#equipamentos-list').DataTable();
</script>
@stop
