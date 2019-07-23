@extends('ramodnil.page')

@section('header-title')
<div class="page-header">
    <h4 class="page-title">FAQ</h4>
</div>
@stop

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="card card-space">
			<div class="card-header">
				<h4 class="card-title">Perguntas Frequentes</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active show" id="v-pills-home-tab-icons" data-toggle="pill" href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons" aria-selected="true">
								<i class="fa fa-ticket-alt"></i>
								Ordem de Serviço
							</a>
							<!-- <a class="nav-link" id="v-pills-profile-tab-icons" data-toggle="pill" href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons" aria-selected="false">
								<i class="flaticon-user-4"></i>
								Profile
							</a>
							<a class="nav-link" id="v-pills-buy-tab-icons" data-toggle="pill" href="#v-pills-buy-icons" role="tab" aria-controls="v-pills-buy-icons" aria-selected="false">
								<i class="flaticon-cart"></i>
								How to buy?
							</a>
							<a class="nav-link" id="v-pills-quality-tab-icons" data-toggle="pill" href="#v-pills-quality-icons" role="tab" aria-controls="v-pills-quality-icons" aria-selected="false">
								<i class="flaticon-hands"></i>
								Quality
							</a> -->
						</div>
					</div>
					<div class="col-12 col-md-9">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade active show" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
								<div class="accordion accordion-secondary" id="accordion">
									<div class="card">
										<div class="card-header collapsed" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" role="button">
											<div class="span-icon">
												<div class="fa fa-plus-square"></div>
											</div>
											<div class="span-title">
												Como cadastrar uma ordem de serviço?
											</div>
										</div>

										<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body">
												No menu lateral esquerdo clique na aba <b><i class="fa fa-phone-square-alt"></i>Suporte</b>, em seguida selecione o item <b> <i class="fa fa-ticket-alt" ></i>Ordem de Serviço</b>. Clique no botão <b><i class="fa fa-plus"></i>Nova Ordem de Serviço</b>, preencha os dados com as inforçãoes solicitadas e clique em <b> <i class="fa fa-check"></i>Salvar. </b>
												<br>
												<br>
												<br>
												Clique <a target="_blank" href="{{route('ordem_servicos.create')}}">aqui</a> para ser redirecionado para o cadastro de OS.
											</div> 
										</div>
									</div>
									<div class="card">
										<div class="card-header collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="button">
											<div class="span-icon">
												<div class="fa fa-sync-alt"></div>
											</div>
											<div class="span-title">
												Como acompanhar a ordem de serviço?
											</div>
										</div>
										<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
											<div class="card-body">
												Ao receber sua ordem de serviço, o funcionário responsável pelo suporte atualizará o status conforme o andamento da manutenção. Você receberá notificações que poderão ser visualizadas ná pagina <b><i class="fa fa-home"></i>Dashboard</b>, na seção <b>Atividades recentes</b> ou clicando no item de <b><i class="fa fa-bell"></i>notificações</b>  localizado no canto superior direito do painel.
											</div>
										</div>
									</div>
									
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-profile-icons" role="tabpanel" aria-labelledby="v-pills-profile-tab-icons">
								<h5 class="mt-3">Profile</h5>
								<hr>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

								<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>

								<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didnâ€™t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

								<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should</p>
							</div>
							<div class="tab-pane fade" id="v-pills-buy-icons" role="tabpanel" aria-labelledby="v-pills-buy-tab-icons">
								<h5 class="mt-3">How To Buy</h5>
								<hr>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

								<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>

								<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didnâ€™t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

								<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should</p>
							</div>
							<div class="tab-pane fade" id="v-pills-quality-icons" role="tabpanel" aria-labelledby="v-pills-quality-tab-icons">
								<div class="accordion accordion-secondary">
									<div class="card">
										<div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" role="button">
											<div class="span-icon">
												<div class="flaticon-box-1"></div>
											</div>
											<div class="span-title">
												Lorem Ipsum #1
											</div>
											<div class="span-mode"></div>
										</div>

										<div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion" role="button">
											<div class="card-body">
												Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header collapsed" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" role="button">
											<div class="span-icon">
												<div class="flaticon-box-1"></div>
											</div>
											<div class="span-title">
												Lorem Ipsum #2
											</div>
											<div class="span-mode"></div>
										</div>
										<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
											<div class="card-body">
												Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header collapsed" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" role="button">
											<div class="span-icon">
												<div class="flaticon-box-1"></div>
											</div>
											<div class="span-title">
												Lorem Ipsum #3
											</div>
											<div class="span-mode"></div>
										</div>
										<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
											<div class="card-body">
												Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">

			</div>
		</div>
	</div>
</div>

@stop

@section('js')
@stop
