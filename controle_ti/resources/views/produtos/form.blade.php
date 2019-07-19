{{ Form::restForm($produto, ['id' => 'produto-form']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('nome', 'Nome') }}
    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
    <script>
        $('#produto-form').validate({
            rules: {
                'nome': 'required',
                'role': 'required',
            }
        });
    </script>
@endsection
