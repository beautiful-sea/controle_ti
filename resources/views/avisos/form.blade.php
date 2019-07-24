{{ Form::restForm($aviso, ['id' => 'produto-form']) }}
<div id="app">
    <div class="card">
        <div class="card-body">
            <form-aviso :aviso='{{$aviso}}' :setores="{{json_encode($setores)}}"></form-aviso>
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
