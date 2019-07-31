@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">Usuários</h4>
</div>
@stop

@section('header-breadcrumbs')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Usuários</li>
@endsection

@section('content')
<div class="my-2">
    @can('create', \App\User::class)
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Usuário</a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="users-list">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Perfil</th>
                        <th>Computador</th>
                        <th>Setor</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    @php
                    $class = '';

                    if ($u->locked) {
                    $class = 'text-muted';
                }
                @endphp

                <tr class="{{ $class }}">
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->usuario }}</td>
                    <td>{{ $u->role_string }}</td>
                    <td>{{ ($u->equipamento_id)?\App\Equipamento::find($u->equipamento_id)->etiqueta:'' }}</td>
                    <td>{{ ($u->setor_id)?\App\Setor::find($u->setor_id)->name:'' }}</td>
                    <td>
                        <div class="table-actions">
                            @can('edit', $u)
                            <a href="{{ route('users.edit', ['user' => $u]) }}" class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-alt"></i></a>
                            @endcan

                            @if (!$u->locked)
                            @can('block', $u)
                            @if ($u->id != Auth::user()->id)
                            <a href="{{ route('users.block', ['user' => $u]) }}" class="btn btn-outline-dark btn-sm confirmable"><i class="fa fa-lock"></i></a>
                            @endif
                            @endcan
                            @else
                            @can('unblock', $u)
                            @if ($u->id != Auth::user()->id)
                            <a href="{{ route('users.unblock', ['user' => $u]) }}" class="btn btn-outline-dark btn-sm confirmable"><i class="fa fa-lock-open"></i></a>
                            @endif
                            @endcan
                            @endif

                            @can('destroy', $u)
                            @if ($u->id != Auth::user()->id)
                            {{ Html::deleteLink('', route('users.destroy', ['user' => $u]), ['button_class' => 'btn btn-outline-danger btn-sm confirmable', 'icon' => 'trash']) }}
                            @endif
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
    $('#users-list').DataTable();
</script>
@stop
