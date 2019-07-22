<a href="{{route('ordem_servicos.edit',$notification->data['ordemServico'])}}">
	<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
	<div class="notif-content">
		<span class="block">
			<b>{{$notification->data['createdBy']['name']}}</b>
			cadastrou uma ordem de serviço
		</span>
		<span class="time"> {{date('d/m/Y H:i:s',strtotime($notification->created_at))}}</span> 
	</div>
</a>
