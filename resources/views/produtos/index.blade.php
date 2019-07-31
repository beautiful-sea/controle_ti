@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Produtos</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Produtos</li>
@endsection

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('produtos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Produto</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="produtos-list">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->nome }}</td>
                    <td>
                        <div class="table-actions">
                            @can('edit', $u)
                            <a href="{{ route('produtos.edit', ['produto' => $u]) }}" class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                            @endcan

                            @can('destroy', $u)
                            {{ Html::deleteLink('Excluir', route('produtos.destroy', ['user' => $u]), ['button_class' => 'btn btn-outline-danger btn-sm confirmable', 'icon' => 'trash']) }}
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
    $('#produtos-list').DataTable();
</script>
@stop
