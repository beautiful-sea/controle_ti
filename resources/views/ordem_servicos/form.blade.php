{{ Form::restForm($ordem_servico, ['id' => 'ordem_servico-form','route_prefix'  =>  'ordem_servicos','files' => true]) }}

<div class="card">
    <div class="card-body">

        <div class="row">

            <div class="col-md-6" >
                <div class="form-group">
                    <label>Equipamento</label>
                    <select name="equipamento_id" class="form-control select-2">
                        @foreach(\App\Equipamento::all() as $e)
                        <option value="{{$e->id}}" {{($e->id == auth()->user()->equipamento_id)?'selected':''}}>{{$e->etiqueta}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6" >
                <div class="form-group">
                    <label>Setor</label>
                    <select name="setor_id" class="form-control select-2">
                        @foreach(\App\Setor::all() as $s)
                        <option value="{{$s->id}}" {{($s->id == auth()->user()->setor_id)?'selected':''}}>{{$s->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">


            <div class="col-md-6" >

            </div>
        </div>

        <div class="row">
            <div class="col-md-6" >
                <div class="form-group">
                    <label>Solicitando</label>
                        <input type="text" class="form-control" value="{{auth()->user()->name}}" placeholder="" selected="" disabled="">
                </div>
            </div>

            <div class="col-md-6" >
                <div class="form-group">
                    <label>Usuário</label>
                    <select name="usuario_id" class="form-control select-2">
                        @foreach(\App\User::all() as $u)
                        <option value="{{$u->id}}" {{($u->id == auth()->user()->id)?'selected':''}}>{{$u->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
           <div class="col-md-6" >
               {{ Form::bsTextarea('descricao', 'Descrição',['rows' => 3 ]) }}
           </div>
           <div class="col-md-6" >
               {{ Form::bsFile('arquivo', 'Arquivo') }}
           </div>
       </div>

   </div>
</div>

{{ Form::bsSubmit('Salvar') }}

{{ Form::close() }}

@section('js')
<script>
    $('#ordem_servico-form').validate({
        rules: {
            'nome': 'required',
            'descricao': 'required',
        }
    });
</script>
@endsection
