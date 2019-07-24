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
                        @can('RH',App\User::class)
                        <a href='/files/folha_pagamentos/{{date("Y/m",strtotime($u->periodo))}}/{!! $u->usuarios_id.".".$u->extensao !!}' target="_blank" class="btn btn-primary">Visualizar</a> </td>
                        @else
                        <a href='/files/folha_pagamentos/{{date("Y/m",strtotime($u->periodo))}}/{!! $u->usuarios_id.".".$u->extensao !!}' target="_blank" class="btn btn-primary" download='Folha de Pagamento - {{date("d/m/Y",strtotime($u->periodo))}}.{{$u->extensao}}' >Baixar</a> </td>
                        @endcan

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
@stop

@section('js')
<script>
    $('#folha_pagamentos-list').DataTable();
</script>
@stop
