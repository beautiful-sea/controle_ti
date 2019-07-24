@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Avisos</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Avisos</li>
@endsection

@section('content')
<div class="my-2">
    @can('avisar', \App\User::class)
    <a href="{{ route('avisos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Aviso</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="avisos-list">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Data de Início</th>
                        <th>Data de Término</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avisos as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->titulo }}</td>
                    <td>{{ Str::limit($u->descricao,20,'...') }}</td>
                    <td>{{ date('d/m/Y',strtotime($u->data_inicio)) }}</td>
                    <td>{{ date('d/m/Y',strtotime($u->data_fim)) }}</td>
                    <td>
                        <div class="table-actions">
                            @can('avisar',\App\User::class)
                            <a href="{{ route('avisos.edit', ['aviso' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('avisar',\App\User::class)
                            {{ Html::deleteLink('Excluir', route('avisos.destroy', ['user' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@stop

@section('js')
<script>
    $('#avisos-list').DataTable();
</script>
@stop
