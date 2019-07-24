{{ Form::restForm($licenca, ['id' => 'licenca-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('chave', 'Chave') }}

        <div class="form-group">
            <label>Produto</label>
            <select name="produto_id" class="form-control select-2">
            @foreach($produtos as $p)
                <option value="{{$p->id}}" {{($p->id == $licenca->produto_id)?'selected':''}}>{{$p->nome}}</option>
            @endforeach
        </select>
        </div>
        
    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
    <script>
        $('#licenca-form').validate({
            rules: {
                'chave': 'required',
                'role': 'required',
            }
        });
    </script>
@endsection
