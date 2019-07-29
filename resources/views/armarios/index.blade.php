@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Armários</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Armários</li>
@endsection

@section('content')
<div class="my-2">
    @can('RECEPCAO', \App\User::class)
    <a href="{{ route('armarios.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Armário</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="armarios-list">
                <thead>
                    <tr>
                        <th>Número do Armário</th>
                        <th>Colaborador</th>
                        <th>Local Do Armário</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($armarios as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp
        
                <tr class="{{ $class }}">
                    <td>{!! '<div class="badge badge-info">'.$u->numero.'</div>' !!}</td>
                    <td>{!! (count($u->usuario) > 0 )?'<div class="badge badge-primary">'.$u->usuario->name.'</div>':'<div class="badge badge-danger">Vazio</div>' !!}</td>
                    <td>{!! '<div class="badge badge-default">'.$u->local_string.'</div>' !!}</td>

                    <td>
                        <div class="table-actions">
                            @can('RECEPCAO', $u)
                            <a href="{{ route('armarios.edit', ['armario' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('RECEPCAO', $u)
                            {{ Html::deleteLink('Excluir', route('armarios.destroy', ['user' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
    $('#armarios-list').DataTable();
</script>
@stop
