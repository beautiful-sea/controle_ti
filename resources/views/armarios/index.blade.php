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
            <table class="table table-hover table-striped" id="armarios-list">
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
                    <td>{!! (count($u->usuario) > 0 )?$u->usuario->name:'<div class="badge badge-danger">Vazio</div>' !!}</td>
                    <td>{!! ($u->local == 1)?'<div class="badge badge-default">'.$u->local_string.'</div>':
                        '<div class="badge badge-secondary">'.$u->local_string.'</div>' !!}</td>

                        <td>
                            <div class="table-actions">
                                @can('RECEPCAO', $u)
                                <a href="{{ route('armarios.edit', ['armario' => $u]) }}" class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('RECEPCAO', $u)
                                {{ Html::deleteLink('Excluir', route('armarios.destroy', ['user' => $u]), ['button_class' => 'btn btn-outline-danger btn-sm confirmable', 'icon' => 'trash']) }}
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


<h3>Armários Vazios</h3>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="internos_vazios-list">
                    <thead>
                        <tr>
                            <th>Número do Armário</th>
                            <th>Local do Armário</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($armarios_vazios as $tipo => $armarios)
                        @foreach($armarios_vazios[$tipo] as $numero_armario => $array)
                        <tr class="text-center">   
                                <td>{!! '<div class="badge badge-info">'.($numero_armario+1).'</div>' !!}</td>      
                                <td> <div class="badge badge-{!!(($tipo == 'internos')?'secondary':'default')!!}">{!!(($tipo == 'internos')?'Armário Interno':'Armário Externo Masculino')!!}</div></td>      
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $('#armarios-list').DataTable();
    $('#internos_vazios-list').DataTable();
</script>
@stop
