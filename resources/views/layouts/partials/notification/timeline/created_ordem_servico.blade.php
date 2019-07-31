
<div class="timeline-badge"><a style="color: inherit;" href="{{route('ordem_servicos.edit',$n->data['ordemServico'])}}"><i class="fa fa-phone-volume"></i></a></div>
<div class="timeline-panel">
	<div class="timeline-heading">
		<h4 class="timeline-title">{{$n->data['createdBy']['name']}}</h4>
		<p><small class="text-muted"><i class="fa fa-clock"></i> {{date('d/m/Y H:i:s',strtotime($n->created_at))}}</small> <span id="tempoPassado-{{$n->id}}"></span></p>
	</div>
	<div class="timeline-body">
		<p>Cadastrou uma <b>ordem de serviço</b></p>
	</div>
</div>

