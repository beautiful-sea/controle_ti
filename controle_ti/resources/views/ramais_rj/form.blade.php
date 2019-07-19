{{ Form::restForm($ramal, ['id' => 'ramal-form','route_prefix' => 'ramais_rj']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('ramal', 'Ramal') }}

        <div class="form-group">

            <label>Setor</label>
            <select class="form-control select-2" name="setor_id">
                @foreach($setores as $s)
                <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
    <script>
        $('#ramal-form').validate({
            rules: {
                'ramal': 'required',
            }
        });
    </script>
@endsection
