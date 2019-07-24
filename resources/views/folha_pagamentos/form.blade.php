{{ Form::restForm($folha_pagamentos, ['id' => 'equipamento-form','route_prefix' =>  'folha_pagamentos','files'  =>  true]) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Colaborador</label>
                    <select name="usuarios_id"  class="form-control select-2">
                        @foreach($usuarios as $u)
                        <option value="{{$u->id}}" {{($folha_pagamentos->usuarios_id == $u->id)?'selected':''}}>{{$u->name}} | {{App\Setor::find($u->setor_id)->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Arquivo</label>
                    <input class="form-control" type="file" name="arquivo">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Data</label>
                    <input class="form-control" type="date"  value="{{$folha_pagamentos->periodo}}" name="periodo">
                </div>
            </div>

        </div>
    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
<script>
    $('#equipamento-form').validate({
        rules: {
            'etiqueta': 'required',
            'role': 'required',
        }
    });
</script>
@endsection
