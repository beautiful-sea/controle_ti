{{ Form::restForm($armario, ['id' => 'armario-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('numero', 'Número do armário') }}

        <div class="form-group">
            <label>Local</label>
            <select name="local" class="form-control select-2">
                @foreach (App\Armario::local() as $key => $l)
                <option value="{{$key}}" >{{$l}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Colaborador</label>
            <select name="usuarios_id" class="form-control select-2">
                <option value="">Vazio</option>
                @foreach ($usuarios as $u)
                <option value="{{$u->id}}" {{($u->id == $armario->usuarios_id)?'selected':''}}  >{{$u->name}}  |  {{\App\Setor::find($u->setor_id)->name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
    <script>
        $('#armario-form').validate({
            rules: {
                'numero': {
                    'required':true,
                    'number'  :true
                },
                'local':'required',
            }
        });
    </script>
@endsection
