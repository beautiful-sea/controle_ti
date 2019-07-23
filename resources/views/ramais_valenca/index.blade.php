@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Ramais</h4> <small> Valença</small>
</div>
@stop

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('ramais_valenca.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Ramal</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="ramal-list">
                <thead>
                    <tr>
                        <th>Ramal</th>
                        <th>Setor</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ramais as $u)

                    <tr class="">
                        <td>{!! '<div class="badge badge-primary">'.$u->ramal.'</div>'  !!}</td>
                        <td>{!! '<div class="badge badge-primary">'.App\Setor::find($u->setor_id)->name.'</div>'  !!}</td>
                        <td>
                            <div class="table-actions">
                                @can('edit', $u)
                                <a href="{{ route('ramais_valenca.edit', ['ramal' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('destroy', $u)
                                {{ Html::deleteLink('Excluir', route('ramais_valenca.destroy', ['ramal' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
    $('#ramal-list').DataTable();
</script>
@stop
