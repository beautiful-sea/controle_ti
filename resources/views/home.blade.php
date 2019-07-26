@extends('ramodnil.page')

@section('css')
{{-- Seus estilos específicos de página aqui --}}
@endsection

@section('header-title')
<h1>Início</h1>
@stop


@section('content')

@can('ADMIN',\App\User::class)

<div class="row">



	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-primary card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fa fa-users"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">Usuários</p>
							<h4 class="card-title">{{count(App\User::all())}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-info card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fab fa-accusoft"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">Produtos</p>
							<h4 class="card-title">{{count(App\Produto::all())}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-secondary card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fa fa-key"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">Licenças</p>
							<h4 class="card-title">{{count(App\Licenca::all())}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-3">
		<div class="card card-stats card-secondary card-round">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="fa fa-tv"></i>
						</div>
					</div>
					<div class="col col-stats">
						<div class="numbers">
							<p class="card-category">Equipamentos</p>
							<h4 class="card-title">{{count(App\Equipamento::all())}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
</div>
<!-- VERIFICA SE EXISTE FOLHA DE PAGAMENTO NA DATA DE HOJE -->
@php $folhaPagamentoHoje = App\FolhaPagamento::where('periodo',date('Y-m-d'))->where('usuarios_id',auth()->user()->id)->first();  @endphp

<div class="container">
	<h3>Quadro de Avisos</h3>
	<div class="row">
		<div class="col-md-4">
			<div class="card card-info bg-default-gradient card-annoucement card-round">
				<div class="card-body text-center">
					<div class="card-opening">Bem vindo ao Portal BRVAL</div>
					<div class="card-desc">
						<img src="http://brval.com.br/wp-content/uploads/2013/04/logo3-300x123.png" width='200'>
					</div>
					<div class="card-detail">
					</div>
				</div>
			</div>
		</div>

		@if(count($folhaPagamentoHoje) > 0)

		<div class="col-md-4">
			<div class="card card-info bg-danger-gradient card-annoucement card-round">
				<div class="card-body text-center">
					<div class="card-opening">Atenção</div>
					<div class="card-desc">
						Sua folha de pagamento ja está disponível para download.
					</div>
					<div class="card-detail">
						<a id="download_folha_pagamento" class="btn btn-danger">Baixar</a>
					</div>
				</div>
			</div>
		</div>
		@endif

		@foreach( $avisos as $a)
		<div class="col-md-4">
			<div class="card card-info bg-{{$a->color}}-gradient card-annoucement card-round">
				<div class="card-body text-center">
					<div class="card-opening">{{$a->titulo}}</div>
					<div class="card-desc">
						{!!$a->descricao!!}
					</div>
					<div class="card-detail">

					</div>
				</div>
			</div>
		</div>
		@endforeach

	</div>
	<h3>Suas Informações</h3>

	<div class="row">

		@if(isset(auth()->user()->equipamento->etiqueta))
		<div class="col-sm-6 col-md-3">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center icon-primary bubble-shadow-small">
								<i class="flaticon-desk"></i>
							</div>
						</div>
						<div class="col col-stats">
							<div class="numbers">
								<p class="card-category">Computador</p>
								<h4 class="card-title">{!! auth()->user()->equipamento->etiqueta !!}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

		@if(isset(auth()->user()->setor->name))
		<div class="col-sm-6 col-md-3">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center icon-info bubble-shadow-small">
								<i class="flaticon-placeholder"></i>
							</div>
						</div>
						<div class="col col-stats">
							<div class="numbers">
								<p class="card-category">Setor</p>
								<h4 class="card-title">{!! auth()->user()->setor->name !!}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif


		<div class="col-sm-6 col-md-3">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center icon-secondary bubble-shadow-small">
								<i class="flaticon-round"></i>
							</div>
						</div>
						<div class="col col-stats">
							<div class="numbers">
								<p class="card-category">Ordens de Serviço</p>
								<h4 class="card-title">{!! count(App\OrdemServico::where('cadastrante_id',auth()->user()->id)->get()) !!}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	@if(count(auth()->user()->notifications) > 0)
	<h3>Atividades recentes</h3>
	@endif
	<div class="row">
		<div class="col-md-12">


			<ul class="timeline">
				@php
				$i = 0;
				@endphp
				@foreach(auth()->user()->notifications->take(8) as $n)
				@php $i++; @endphp

				<li class="{{($i%2 == 0)?'timeline-inverted':''}}">
					@include('layouts.partials.notification.timeline.'.snake_case(class_basename($n->type)))
				</li>
				@endforeach
			</ul>
		</div>
	</div>

</div>

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

				<a style="display: none" id="access_granted_download" href='#' target="_blank" class="btn btn-danger" >Baixar</a>
				
				
			</div>
		</div>
	</div>
</div>
@stop

@section('js')

<script type="text/javascript">
	$('#download_folha_pagamento').click(function(event) {
		event.preventDefault();
		$('#exampleModal').modal('show');
	});

// BLOQUEIA A TECLA ENTER PARA NÃO ENVIAR FORMULARIO
$(window).keydown(function(event){
	if(event.keyCode == 13) {
		event.preventDefault();
		return false;
	}
});



// VERIFICA O TOKEN DE ACESSO DO USUARIO PARA PERMITIR O DONWLOAD OU REJEITAR
$('#check_access').one('click',function(event) {
	var personal_access_code = $('#personal_access_code').val();

	event.preventDefault();

	dados = Object();

	dados['_token'] = $('input[name=_token]').val();
	dados['method'] = "POST";
	dados['personal_access_code'] = personal_access_code;

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
				$('#access_granted_download').attr('href',data.file_url);
				$('#access_granted_download').attr('download',data.download);
				document.getElementById('access_granted_download').click();
				setTimeout(function(){
					location.href = '/home';
				}, 1300);
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
				location.href = '/home';
			}, 1300);

		}
	});


	$('#personal_access_code').val('');
});
</script>
@endsection