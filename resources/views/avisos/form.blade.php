<header>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'base_url'  => \URL::to('/'),
        ]); ?>
    </script>
</header>
<div id="app">
    <div class="card">
        <div class="card-body">
            <form-aviso :aviso='{{$aviso}}' :setores="{{json_encode($setores)}}"></form-aviso>
        </div>
    </div>  
</div>

@section('js')

<script>
    $('#avisos-form').validate({
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
