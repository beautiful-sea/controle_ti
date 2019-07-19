{{ Form::restForm($equipamento, ['id' => 'equipamento-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('etiqueta', 'Etiqueta') }}
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
