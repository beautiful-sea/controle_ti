@extends('ramodnil.page')


@section('content')
<div class="my-2">

    <a href="{{ route('ordem_servicos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Ordem de Serviço</a>
    
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="ordem_servicos-list">
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
                    <td>{!! 
                        ($u->status != 3)
                            ?\App\OrdemServico::getStatusFormated($u->status):
                            
                            (($u->resolvido_confirmado == 0)
                                ?'<div class="badge badge-danger">Não Confirmado</div>'
                                :\App\OrdemServico::getStatusFormated($u->status)) !!}

                    </td>
                    <td>@if($u->img_extension)<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="setImageModal({!!$u->id!!} , '{!!$u->img_extension!!}')">Ver</button>@endif</td>
                    <td>{!!date("d/m/Y",strtotime($u->created_at))!!}</td>

                    <td>
                        <div class="table-actions  d-flex align-items-stretch">
                            @php
                            $u['statusFormated'] = \App\OrdemServico::getStatusFormated($u->status);
                            $u['tipo_manutencao'] = (isset($u['tipo_manutencao']))?\App\OrdemServico::tipos()[$u['tipo_manutencao']]:'Não Cadastrado';
                            @endphp
                            <button onclick="setDetalhes({{$u->id}})" style="margin-right: 5px" class="btn btn-outline-primary btn-sm h-100" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-list"></i></button>

                            @can('edit', $u)
                            <div class="btn-group h-100" style="margin-right: 5px">
                              <button type="button" class="btn btn-outline-info btn-sm " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-sync-alt"></i>
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
                                <a data-toggle="modal" onclick="setServicoExecutado({{$u}})" data-target="#modalServicoExecutado" style="cursor:pointer"  class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(3)) !!}</a>

                                @php
                                $u->status = 4 
                                @endphp
                                <a href="{{ route('ordem_servicos.change_status', ['ordem_servicos' => $u,'status'  =>  4]) }}" class="dropdown-item">{!! html_entity_decode(\App\OrdemServico::getStatusInText(4)) !!}</a>
                            </div>
                        </div>
                        @endcan
                        <a href="{{ route('ordem_servicos.edit', ['ordem_servico' => $u]) }}" class="btn btn-outline-dark btn-sm h-100"><i class="fa fa-pencil-alt"></i> </a>
                        
                        @if($u->status == 3)
                        <form action="/ordem_servicos/{{$u->id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="status" value="4">
                            <button style="margin-right: 5px" class="btn btn-outline-secondary btn-sm h-100" type="submit">Reabrir</button>
                        </form>
                        @endif
                        @can('destroy', $u)
                        {{ Html::deleteLink('', route('ordem_servicos.destroy', ['user' => $u]), ['button_class' => 'btn btn-outline-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
                <a id="link_img_modal" href="#" target="_blank" data-toggle="tooltip" data-placement="top" title="Clique na imagem para visualizar em tela cheia"><img style="width: 100%; height: 100%;" src="public/files/ordem_servico/1.jpg" id="img_modal" class="img-responsive"></a>
            </div>
        </div>
    </div>
</div>

<!-- modal RESOLVIDO -->
<div id="modalServicoExecutado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open([ 'id' => 'form-servico-executado','method' =>  'PUT']) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa fa-check"></i> Finalizar Ordem de serviço</h3> 
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><h5>Serviço Executado:</h5></label>
                            <textarea name="servico_executado" id="servico_executado-modal" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><h5>Tipo de Manutenção:</h5></label>
                            <select class="form-control select-2" name="tipo_manutencao">
                                @foreach(App\OrdemServico::tipos() as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="status" value="3">


                </div>

                {{ Form::bsSubmit('Salvar') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal DETALHES-->
<div class="modal fade" id="exampleModal" style="z-index: 9999999" tabindex="99999" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <label>Descrição:</label>
                <textarea disabled name="descricao" id="descricao-modal" rows="5" class="form-control"></textarea>
            </div>
        </div> 

        <div class="col-md-6">
            <div class="form-group">
                <label>Serviço Executado:</label>
                <textarea disabled name="servico_executado" id="servico-executado-modal" rows="5" class="form-control"></textarea>
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
                <label>Tipo de Manutenção:</label><br>
                <div  id="tipo_manutencao-modal"></div>
            </div>
        </div>

    </div>

</div>
<div class="modal-footer" >
    <div id="footer-detalhes">

    </div>
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

    //Busca todas OS's nao confirmadas pelo usuário ao carregar a página
    $(document).ready(function(e) {
        $.get('/ordem_servicos/nao_confirmadas',function(data){
            if(data.length > 0){//Se existir OS's nao confirmadas, iniciar modal de confirmação
                iniciarAvisoConfirmaResolvido(data);
        }  
    });
    });

    $('#ordem_servicos-list').DataTable({
        bSort:false
    });

    //Seta imagem da OS no modal de visualização de imagens
    function setImageModal(id,extension){
        $('#img_modal').attr("src", "/files/ordem_servico/"+id+"."+extension);
        $('#link_img_modal').attr("href", "/files/ordem_servico/"+id+"."+extension);
    }

    //Adiciona o serviço que será marcado como resolvido no modal de 'Finalizar Ordem de serviço'
    function setServicoExecutado(os){
        $('#form-servico-executado').attr("action", "/ordem_servicos/"+os.id+"");
        $('#servico_executado-modal').val(os.servico_executado);
    }

    //Adiciona a OS escolhida no modal de detalhes da OS
    function setDetalhes(os_escolhida){

        //Busca os dados da OS escolhida e adiciona nos devidos campos
        $.get("api/ordem_servicos/"+os_escolhida,function(os){
            moment.locale('pt-BR');
            $('#equipamento-modal').val(os.equipamento.etiqueta);
            $('#id-modal').html('#'+os.id);
            $('#cadastrante-modal').val(os.cadastrante.name);
            $('#usuario-modal').val(os.usuario.name);
            $('#setor-modal').val(os.setor.name);
            $('#descricao-modal').val(os.descricao);
            $('#servico-executado-modal').val(os.servico_executado);
            $('#status-modal').html(getStatusInText(os.status));
            $('#tipo_manutencao-modal').html(getTipoManutencao(os.tipo_manutencao));
            $('#criado-modal').val(moment(os.created_at).format('DD/MM/Y H:m:ss',true));
            $('#resolucao-modal').val((os.resolucao)?moment(os.resolucao).format('DD/MM/Y H:m:ss',true):'Não resolvido');

            //Se a os não foi confirmada como resolvida pelo usuário e seu status for RESOLVIDO
            if(os.resolvido_confirmado != 1 && os.status == 3){
                //Adiciona o botão de marcar como resolvida a OS
                $('#footer-detalhes').html('<button type="button" class="btn btn-success" data-dismiss="modal" onclick="confirmarResolucao('+os.id+')">Marcar como resolvido</button>');
            }
        });
    }

    //Marca ordem de servico como resolvido
    function confirmarResolucao(id_os){
        dados = Object();
        dados['_token'] = $('input[name=_token]').val();
        dados['_method'] = "PUT";
        dados['resolvido_confirmado'] = 1;

        //Adiciona o CSRF-TOKEN no header da requisição AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:'/ordem_servicos/'+id_os,
            method:'POST',
            data: dados,
            dataType: "json"
        }).always(function() {
            //Mostra mensagem dizendo que a OS foi marcada como resolvida
            swal("Ordem de serviço resolvida!", {
                icon: "success",
                buttons : {
                    catch : {
                        value: 'confirm',
                        text: 'Ver mais',
                        className: 'btn btn-success'
                    },
                    cancel :{
                        tex: 'Sair',
                        className: 'btn btn-danger'
                    }
                }
                
            }).then((ver_mais) => {
                //Se o usuário clicar no botao de ver mais OS para serem marcadas com resolvidas
                if (ver_mais == 'confirm') {
                    $.get('/ordem_servicos/nao_confirmadas',function(data){//Busca OS's não confirmadas ainda
                        if(data.length > 0){//Se existir OS's não confirmadas
                            visualizarOSParaConfirmar(data);
                        }else{
                            swal("Todas ordens de serviço já foram marcadas como resolvidas!")
                            .then(() =>{
                                window.location.href = '/ordem_servicos';
                            });

                        }
                    });
                }
            });

        });
    }

    //Modal de confirmação de resolucao das ordens de serviço
    function iniciarAvisoConfirmaResolvido(resolucoes_nao_confirmadas){
        swal({
            title: '{!!auth()->user()->name!!},',
            className:'text-center',
            text: "Você possui {!!count($resolucao_nao_confirmada)!!} {!!(count($resolucao_nao_confirmada) > 1)?'ordens de serviço':'ordem de serviço'!!} aguardando confirmação de resolução. ",
            icon: 'warning',
            buttons:{
                cancel: {
                    visible: true,
                    text : 'Ver depois',
                    className: 'btn btn-danger'
                },                  
                confirm: {
                    text : 'Deixe-me ver',
                    className : 'btn btn-success'
                }
            }
        }).then((quer_ver) => {
            //Se o usuário quiser ver as OS's que podem ser marcadas como resolvidas
            if (quer_ver) {
                visualizarOSParaConfirmar(resolucoes_nao_confirmadas);
            } 
        });
    }

    //Exibe o modal para o usuário escolher uma OS para marcar como resolvida
    function visualizarOSParaConfirmar(resolucoes_nao_confirmadas){
        var resolucao_nao_confirmada = resolucoes_nao_confirmadas;

        let opcoes = Object();

        //Para cada OS, criar um botão referente a ela
        for (var i = resolucao_nao_confirmada.length - 1; i >= 0; i--) {
            opcoes[resolucao_nao_confirmada[i].id] = {
                text:'#'+resolucao_nao_confirmada[i].id
            };

        }
        swal({
            title: '{!!auth()->user()->name!!},',
            text: 'Escolha uma OS para visualizar.',
            buttons: opcoes
        }).then((os_escolhida) => {
            //Quando o usuário clicar no botao referente a OS que quer confirmar
            $.get("api/ordem_servicos/"+os_escolhida,function(data){//Busca dados da OS
                setDetalhes(data.id);//Adiciona esses dados no modal de detalhes
                $('#exampleModal').modal('show');//Exibe o modal
            })

        });
    }

    //Retorna em texto o tipo de manutenção da OS conforme valor passado
    function getTipoManutencao(tipo){
        switch(tipo){
            case 0:
            return 'Corretiva';
            break;
            case 1:
            return 'Preventiva';
            break;
            case 2:
            return 'Remanejamento';
            break;
            case 3:
            return 'Descarte';
            break;
        }
    }

    //Retorna em texto o status da OS conforme valor passado
    function getStatusInText(status){
        switch (status) {
            case 0:
            return 'Solicitado';
            break;
            case 1:
            return 'Recebido';
            break;
            case 2:
            return 'Em execução';
            break;
            case 3:
            return 'Resolvido';
            break;
            case 4:
            return 'Não resolvido';
            break;
            default:
            return 'Solicitada';
            break;
        }
    }
</script>

<style type="text/css">
    .swal-text {
      padding: 17px;
      border: 1px solid #F0E1A1;
      display: block;
      margin: 22px;
      text-align: center;
      color: #61534e;
  }
</style>
@stop
