@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Ordem de Serviços</h4>
</div>
@stop

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('ordem_servicos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Ordem de Serviço</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="ordem_servicos-list">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordem_servicos as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->nome }}</td>
                    <td>
                        <div class="table-actions">
                            @can('edit', $u)
                            <a href="{{ route('ordem_servicos.edit', ['ordem_servico' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('destroy', $u)
                            {{ Html::deleteLink('Excluir', route('ordem_servicos.destroy', ['user' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
    $('#ordem_servicos-list').DataTable();
</script>
@stop
