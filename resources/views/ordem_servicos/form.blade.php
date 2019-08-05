{{ Form::restForm($ordem_servico, ['id' => 'ordem_servico-form','route_prefix'  =>  'ordem_servicos','files' => true]) }}

<!-- VERIFICA A AÇÃO E O CONTROLLER ATUAL -->
@php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);

$disabled = ($ordem_servico->status != 0 && auth()->user()->role == 1)? "disabled":"enabled";
@endphp

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label>O problema está relacionado a qual equipamento?</label>
                    <select {{$disabled}} name="equipamento_id" class="form-control select-2">
                        @if($action == 'create')
                        @foreach(\App\Equipamento::all() as $e)
                        <option value="{{$e->id}}" {{($e->id == auth()->user()->equipamento_id)?'selected':''}}>{{$e->etiqueta}}</option>
                        @endforeach
                        @else
                        @foreach(\App\Equipamento::all() as $e)
                        <option value="{{$e->id}}" {{($e->id == App\User::find($ordem_servico->cadastrante_id)->equipamento_id)?'selected':''}}>{{$e->etiqueta}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>O equipamento é de qual setor?</label>
                    <select {{$disabled}} name="setor_id" class="form-control select-2">
                        @if($action == 'create')
                        @foreach(\App\Setor::all() as $s)
                        <option value="{{$s->id}}" {{($s->id == auth()->user()->setor_id)?'selected':''}}>{{$s->name}}</option>
                        @endforeach
                        @else
                        @foreach(\App\Setor::all() as $s)
                        <option value="{{$s->id}}" {{($s->id == App\User::find($ordem_servico->cadastrante_id)->setor_id)?'selected':''}}>{{$s->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>A qual usuário pertence o equipamento?</label>
                    <select {{$disabled}} name="usuario_id" class="form-control select-2">
                        @if($action == 'create')
                        @foreach(\App\User::all() as $u)
                        <option value="{{$u->id}}" {{($u->id == auth()->user()->id)?'selected':''}}>{{$u->name}}</option>
                        @endforeach
                        @else
                        @foreach(\App\User::all() as $u)
                        <option value="{{$u->id}}" {{($u->id == App\User::find($ordem_servico->cadastrante_id)->id)?'selected':''}}>{{$u->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row"  >
                   {{ Form::bsTextarea('descricao', 'Descreva o problema',['rows' => 3 , ($ordem_servico->status != 0 && auth()->user()->role == 1)? 'disabled':"enabled" => true]) }}
               </div>


               <div class="row" >
                <div class="form-group">
                    @if($action == 'create')
                    <input type="hidden" class="form-control" value="{{auth()->user()->name}}" placeholder="" selected="" disabled="">
                    @else
                    <input type="hidden" class="form-control" value="{{App\User::find($ordem_servico->cadastrante_id)->name}}" placeholder="" selected="" disabled="">
                    @endif
                </div>
            </div>

            <div class="row" >
             {{ Form::bsFile('arquivo', 'Se possível, envie uma imagem (print) mostrando o problema',[($ordem_servico->status != 0 && auth()->user()->role == 1)? 'disabled':"enabled" => true]) }}
         </div>
     </div>

 </div>

 <td>{!! \App\OrdemServico::getStatusFormated($ordem_servico->status) !!}</td>


</div>
</div>

{{ Form::bsSubmit('Salvar',['id'=>'salvar']) }}

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
