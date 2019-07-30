@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Licenças</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Licenças</li>
@endsection

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('licencas.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Licença</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="licencas-list">
                <thead>
                    <tr>
                        <th>Chave</th>
                        <th>Produto</th>
                        <th>Computador</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licencas as $u)

                <tr>
                    <td>{!! $u->chave !!}</td>
                    <td>{!! '<div class="badge badge-secondary">'.App\Produto::find($u->produto_id)->nome.'</div>' !!}</td>
                    <td>{!! ($u->equipamento_id)?('<div class="badge badge-primary">'.App\Equipamento::find($u->equipamento_id)->etiqueta.'</div>'):'<div class="badge badge-danger">Nenhum</div>'!!}</td>
                    <td>
                        <div class="table-actions">
                            @can('add', $u)
                            <a onclick="setLicenca({{$u}})" class="btn btn-default btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Computador</a>
                            @endcan

                            @can('edit', $u)
                            <a href="{{ route('licencas.edit', ['licenca' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('destroy', $u)
                            {{ Html::deleteLink('Excluir', route('licencas.destroy', ['user' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    {{ Form::open(['id' => 'licenca-form']) }}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Atribuir liçenca a um computador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Liçenca</label>
            <input type="text" class="form-control" id="licenca-modal" disabled="" name="licenca" value="">
            <input type="hidden" class="form-control" id="licenca-id" disabled="" name="licencas_id" value="">

        </div>
        
        <div class="form-group">
            <label>Equipamento</label>
            <select name="equipamento_id" class="form-control select-2">
                <option value=""></option>
                @foreach(App\Equipamento::all() as $p)
                <option value="{{$p->id}}">{{$p->etiqueta}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        {{ Form::bsSubmit('Salvar') }}
    </div>
</div>
</div>
</div>
{{ Form::close() }}


</div>
</div>
@stop

@section('js')
<script>
    $('#licencas-list').DataTable();

    function setLicenca(licenca){
        console.log(licenca);
        $('#licenca-modal').val(licenca.chave);
        $('#licenca-id').val(licenca.id);
    }
</script>
@stop
