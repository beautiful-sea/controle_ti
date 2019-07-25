@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Folha de Pagamento</h4>
</div>
@stop

@section('content')
<div class="my-2">
    @can('RH', \App\User::class)
    <a href="{{ route('folha_pagamentos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Folha de Pagamento</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="folha_pagamentos-list">
                <thead>
                    <tr>
                        <th>Colaborador</th>
                        <th>Data</th>
                        <th>Arquivo</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($folha_pagamentos as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ App\User::find($u->usuarios_id)->name }}</td>
                    <td>{{ date("d/m/Y",strtotime($u->periodo)) }}</td>
                    <td> 
                     <a id="download_folha_pagamento" onclick="download_folha_pagamento('{{date("d/m/Y",strtotime($u->periodo))}}')" href='javascript:void(0)' target="_blank" class="btn btn-primary" >Baixar</a> </td>

                     <td>
                        <div class="table-actions">
                            @can('RH',App\User::class)
                            <a href="{{ route('folha_pagamentos.edit', ['folha_pagamento' => $u]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('RH',App\User::class)
                            {{ Html::deleteLink('Excluir', route('folha_pagamentos.destroy', ['user' => $u]), ['button_class' => 'btn btn-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
<hr>

@can('RH', \App\User::class)
{{ Form::open(['/users/save'=>'asd','id' => 'personal_access_code-form','method'    =>  'PUT' ,'class' => 'without-spinner']) }}
<h2>Cadastro de Código de Acesso <i style="font-size: 12px" class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Código que será solicitado para o Colaborador baixar sua folha de pagamento"></i></h2>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Colaborador</label>
                    <select name="id" id="user"  class="form-control select-2">
                        @foreach($usuarios as $u)
                        <option value="{{$u}}" >{{$u->name}} | {{App\Setor::find($u->setor_id)->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>Código de Acesso</label> <i class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Combinação de digitos pessoais do colaborador.  EX: (final do CPF + final RG)"></i>
                    <input required="required" class="form-control" type="text" id="personal_access_code" name="personal_access_code">
                </div>
            </div>

        </div>

        <button style="float: right;" type="submit" class="btn btn-success" >Salvar</button>

    </div>
</div>
@endcan


{{ Form::close() }}

<!-- Modal -->
{{ Form::open(['id' => 'download_folha_pagamento-form']) }}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Download Folha de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Código pessoal de acesso:</label>
                    <input type="text" class="form-control" id="personal_access_code"  name="licenca" value="">
                    <input type="hidden" id="user_auth" class="form-control" name="licenca" value="{{auth()->user()}}">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a id="check_access" class="btn btn-danger">Baixar</a>

                <a style="display: none" id="access_granted_download" href="#" >Baixar</a>
                <input type="hidden" id="dt_folha_pagamento" value="">
                
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $('#folha_pagamentos-list').DataTable();
    

    $("#personal_access_code-form").submit(function(e){
        e.preventDefault();
        user['personal_access_code'] = $("#personal_access_code").val();
        user['_token'] = $('input[name=_token]').val();
        user['_method'] = 'PUT';
        $.ajax({
            url: "users/"+user.id,
            method:"POST",
            data: user,
            dataType: "json"
        }).done(function() {
            $.notify({
                message: 'Código cadastrado com sucesso!'
            },{
                type: 'success'
            });
        }).fail(function(){
           $.notify({
            message: 'Ops.. Parece que ocorreu um erro durante o cadastro.'
        },{
            type: 'danger'
        });
       });

        $("#personal_access_code").val('');
    });


    function download_folha_pagamento(data){
        $("#dt_folha_pagamento").val(data);
        $('#exampleModal').modal('show');  
    }


    $('#check_access').one('click',function(event) {
        var personal_access_code = $('#personal_access_code').val();

        event.preventDefault();

        dados = Object();

        dados['_token'] = $('input[name=_token]').val();
        dados['method'] = "POST";
        dados['personal_access_code'] = personal_access_code;
        dados['data']   =   $("#dt_folha_pagamento").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "users/verifyPersonalAcessToken",
            method:"POST",
            data: dados,
            dataType: "json",
            success: function(data,statusText,response){
                    console.log(data);

                if(response.status == 200){
                    $.notify({
                        message: data.message
                    },{
                        type: 'success',
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: false,
                        position: null,
                        placement: {
                            from: "bottom",
                            align: "left"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 999999,
                    });
                    document.getElementById('access_granted_download').click();
                }else{
                    $.notify({
                        message: data.message
                    },{
                        type: 'danger',
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: false,
                        position: null,
                        placement: {
                            from: "bottom",
                            align: "left"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 999999,
                    });
                }
            },
            error:function(data){
                    console.log(data);

                $.notify({
                    message: 'Não autorizado.'
                },{
                    type: 'danger',
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: false,
                    position: null,
                    placement: {
                        from: "bottom",
                        align: "left"
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 999999,
                });
                setTimeout(function(){
                    location.href = '/folha_pagamentos';
                }, 200000);
                
            }
        });


        $('#personal_access_code').val('');
    });
</script>
@stop
