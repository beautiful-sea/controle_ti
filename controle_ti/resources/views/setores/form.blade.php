{{ Form::restForm($setor, ['id' => 'setor-form','route_prefix' => 'setores']) }}

<div class="card">
    <div class="card-body">
        {{ Form::bsText('name', 'Nome') }}
    </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
    <script>
        $('#setor-form').validate({
            rules: {
                'name': 'required',
            }
        });
    </script>
@endsection
