@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Ordem de Serviços</h4>
</div>
@stop

@section('content')
<div class="my-2">

    <a href="{{ route('ordem_servicos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Ordem de Serviço</a>
    
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="ordem_servicos-list">
                <thead>
                    <tr>
                        <th>Equipamento</th>
                        <th>Usuário</th>
                        <th>Setor</th>
                        <th>Resolução</th>
                        <th>Status</th>
                        <th>Imagem</th>
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
                    <td>{{ \App\Equipamento::find($u->equipamento_id)->etiqueta }}</td>
                    <td>{{ \App\User::find($u->usuario_id)->name }}</td>
                    <td>{{ \App\Setor::find($u->setor_id)->name }}</td>
                    <td>{{ ($u->resolucao)?date("d/m/Y H:m:i",strtotime($u->resolucao)):''}}</td>
                    <td>{!! html_entity_decode(\App\OrdemServico::getStatusFormated($u->status)) !!}</td>
                    <td>@if($u->img_extension)<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="setImageModal({!!$u->id!!} , '{!!$u->img_extension!!}')">Ver</button>@endif</td>
                    <td>
                        <div class="table-actions row">
                            @can('edit', $u)
                            <div class="btn-group" style="margin-right: 5px">
                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-sync-alt"></i>
                                Atualizar
                            </button>
                            <div class="dropdown-menu" style="z-index: 10">
                                @php
                                $u->status = 0 
                                @endphp
                                <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  0]) }}" class="dropdown-item"> {!! html_entity_decode(\App\OrdemServico::getStatusInText(0)) !!}</a>
                                @php
                                $u->status = 1 
                                @endphp
                                <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  1]) }}" class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(1)) !!}</a>
                                @php
                                $u->status = 2 
                                @endphp
                                <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  2]) }}" class="dropdown-item"> {!! html_entity_decode(\App\OrdemServico::getStatusInText(2)) !!}</a>
                                @php
                                $u->status = 3 
                                @endphp
                                <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  3]) }}" class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(3)) !!}</a>

                                @php
                                $u->status = 4 
                                @endphp
                                <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  4]) }}" class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(4)) !!}</a>
                            </div>
                        </div>

                        @endcan
                        <a href="{{ route('ordem_servicos.edit', ['ordem_servico' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>

                        @can('destroy', $u)
                        {{ Html::deleteLink('Excluir', route('ordem_servicos.destroy', ['user' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img style="width: 100%" src="public/files/ordem_servico/1.jpg" id="img_modal" class="img-responsive">
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@stop

@section('js')
<script>
    $('#ordem_servicos-list').DataTable();

    function setImageModal(id,extension){
        $('#img_modal').attr("src", "/files/ordem_servico/"+id+"."+extension);;
    }
</script>
@stop
