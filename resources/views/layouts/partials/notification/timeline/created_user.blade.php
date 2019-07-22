<div class="timeline-badge" ><a style="color: inherit;" href="{{route('users.edit',$n->data['userCreated']['id'])}}"><i class="fa fa-user-plus"></i></a></div>
<div class="timeline-panel">
	<div class="timeline-heading">
		<h4 class="timeline-title">{{$n->data['createdBy']['name']}}</h4>
		<p><small class="text-muted"><i class="fa fa-clock"></i> {{date('d/m/Y H:i:s',strtotime($n->created_at))}}</small></p>
	</div>
	<div class="timeline-body">
		<p>Criou o usuário <b>{{$n->data['userCreated']['name']}}</b></p>
	</div>
</div>