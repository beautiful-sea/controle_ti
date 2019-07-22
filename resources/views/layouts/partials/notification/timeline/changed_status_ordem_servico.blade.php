
<div class="timeline-badge"><i class="fa fa-sync"></i></div>
<div class="timeline-panel">
	<div class="timeline-heading">
		<h4 class="timeline-title">{{$n->data['changedBy']['name']}}</h4>
		<p><small class="text-muted"><i class="fa fa-clock"></i> {{date('d/m/Y H:i:s',strtotime($n->created_at))}}</small></p>
	</div>
	<div class="timeline-body">
		<p>Alterou o status da sua <a href="{{route('ordem_servicos.edit',App\OrdemServico::find($n->data['ordemServico']))}}">ordem de serviço</a> para {!!\App\OrdemServico::getStatusFormated($n->data['newStatus'])!!}</p>
	</div>
</div>