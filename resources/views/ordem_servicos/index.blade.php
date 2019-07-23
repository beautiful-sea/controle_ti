@extends('ramodnil.page')



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
                        <th>Status</th>
                        <th>Imagem</th>
                        <th>Criado em</th>
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
                    <td>{!! html_entity_decode(\App\OrdemServico::getStatusFormated($u->status)) !!}</td>
                    <td>@if($u->img_extension)<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="setImageModal({!!$u->id!!} , '{!!$u->img_extension!!}')">Ver</button>@endif</td>
                    <td>{!!date("d/m/Y",strtotime($u->created_at))!!}</td>

                    <td>
                        <div class="table-actions row">
                            @php
                            $u['statusFormated'] = \App\OrdemServico::getStatusFormated($u->status);
                            @endphp
                            <button onclick="setDetalhes({{$u}})" style="margin-right: 5px" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Detalhes</button>
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
                                <!-- <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  3]) }}" class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(3)) !!}</a> -->
                                <a data-toggle="modal" data-target="#modalServicoExecutado"  class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(3)) !!}</a>

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
    <!-- modal IMAGEM -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img style="width: 100%" src="public/files/ordem_servico/1.jpg" id="img_modal" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<!-- modal RESOLVIDO -->
<div id="modalServicoExecutado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa fa-check"></i> Finalizar Ordem de serviço</h3> 
        </div>
        <div class="modal-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label><h4>Serviço Executado:</h4></label>
                        <textarea name="servico_executado" id="servico_executado-modal" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal DETALHES-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ORDEM DE SERVIÇO  <span id="id-modal"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Equipamento:</label>
                <input type="text" class="form-control" id="equipamento-modal" disabled>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>OS cadastrada por:</label>
                <input type="text" class="form-control" id="cadastrante-modal" disabled>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Usuário do equipamento:</label>
                <input type="text" class="form-control" id="usuario-modal" disabled>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Setor do equipamento:</label>
                <input type="text" class="form-control" id="setor-modal" disabled>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Criado em:</label>
                <input type="text" class="form-control" id="criado-modal" disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Resolvido em:</label>
                <input type="text" class="form-control" id="resolucao-modal" disabled>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Status atual:</label>
                <div id="status-modal"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Descrição:</label>
                <textarea disabled name="descricao" id="descricao-modal" rows="5" class="form-control"></textarea>
            </div>
        </div>

        
    </div>


    

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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

    function setDetalhes(os){
        moment.locale('pt-BR');
        $('#equipamento-modal').val(os.equipamento.etiqueta);
        $('#id-modal').html('#'+os.id);
        $('#cadastrante-modal').val(os.cadastrante.name);
        $('#usuario-modal').val(os.usuario.name);
        $('#setor-modal').val(os.setor.name);
        $('#descricao-modal').val(os.descricao);
        $('#status-modal').html(os.statusFormated);
        $('#criado-modal').val(moment(os.created_at).format('DD/MM/Y H:m:ss',true));
        $('#resolucao-modal').val(moment(os.resolucao).format('DD/MM/Y H:m:ss',true));
    }

</script>
@stop
