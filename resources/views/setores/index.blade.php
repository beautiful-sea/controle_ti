@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Setores</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Setores</li>
@endsection

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('setores.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Setor</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="setor-list">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($setor as $u)

                    <tr class="">
                        <td>{{ $u->name }}</td>
                        <td>
                            <div class="table-actions">
                                @can('edit', $u)
                                <a href="{{ route('setores.edit', ['setor' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('destroy', $u)
                                {{ Html::deleteLink('Excluir', route('setores.destroy', ['setor' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
    $('#setor-list').DataTable();
</script>
@stop
