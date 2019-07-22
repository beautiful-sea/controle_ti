@extends('ramodnil.page')

@section('css')
{{-- Seus estilos específicos de página aqui --}}
@endsection

@section('header-title')
<h1>Início</h1>
@stop


@section('content')

@can('index',\App\User::class)

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

<div class="container">

	<h3>Suas Informaçoes</h3>

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
								<h4 class="card-title">{!! count(auth()->user()->ordemServicos()) !!}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<h3>Notificações</h3>

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


@stop

@section('js')
{{-- Seus scripts específicos de página aqui --}}
@endsection