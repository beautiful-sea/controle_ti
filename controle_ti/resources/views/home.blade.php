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


@stop

@section('js')
{{-- Seus scripts específicos de página aqui --}}
@endsection