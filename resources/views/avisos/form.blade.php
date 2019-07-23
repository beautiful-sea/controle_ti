{{ Form::restForm($aviso, ['id' => 'produto-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('titulo', 'Título') }}

        {{ Form::bsTextarea('descricao', 'Descrição',['rows'=>3]) }}

        <div class="form-group">
            <div>
                <label>Setor <small><u>(Deixe vazio caso queira mandar para todos setores)</u></small></label>
                <select class="form-control select-2" name="setor_id">
                    <option></option>
                    @foreach($setores as $s)
                        <option value="{{$s->id}}" {{($aviso->setor_id == $s->id)?'selected':''}}>{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label>Data de Início</label>
                <input type="date" class="form-control" name="data_inicio" value="{{$aviso->data_inicio}}">
            </div>
        </div>

        <div class="form-group">
            <div>
                <label>Data de Término</label>
                <input type="date" class="form-control" name="data_fim" value="{{$aviso->data_fim}}">
            </div>
        </div>

        <div class="form-group">
            <div>
                <label>Cor do cartão de aviso</label>
                <select class="form-control select-2" name="color">
                    <option value="danger" {{($aviso->color == 'danger')?'selected':''}}>Vermelho</option>
                    <option value="info" {{($aviso->color == 'info')?'selected':''}}>Azul Escuro</option>
                    <option value="primary" {{($aviso->color == 'primary')?'selected':''}}>Azul Claro</option>
                    <option value="default" {{($aviso->color == 'default')?'selected':''}}>Preto</option>
                    <option value="secondary" {{($aviso->color == 'secondary')?'selected':''}}>Roxo</option>
                    <option value="success" {{($aviso->color == 'success')?'selected':''}}> Verde</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
    <script>
        $('#produto-form').validate({
            rules: {
                'titulo': 'required',
                'descricao': 'required',
                'data_inicio': 'required',
                'data_fim': 'required',
                'color': 'required',
            }
        });
    </script>
@endsection
