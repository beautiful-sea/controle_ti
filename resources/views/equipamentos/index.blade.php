@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Equipamentos</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Equipamentos</li>
@endsection

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('equipamentos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Equipamento</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="equipamentos-list">
                <thead>
                    <tr>
                        <th>Etiqueta</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipamentos as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->etiqueta }}</td>
                    <td>
                        <div class="table-actions">
                            @can('edit', $u)
                            <a href="{{ route('equipamentos.edit', ['equipamento' => $u]) }}" class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('destroy', $u)
                            {{ Html::deleteLink('Excluir', route('equipamentos.destroy', ['user' => $u]), ['button_class' => 'btn btn-outline-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
    $('#equipamentos-list').DataTable();
</script>
@stop
