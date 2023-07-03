<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		//echo "<script>window.location.href = '#403';</script>";
		//exit(0);
	}
?>
				
<style>
		#results { padding:20px; border:1px solid; background:#ccc; }
	.market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {background: white!important;}
	.transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {color: #65461f;}
	.market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {color: #000000!important;}
	.dataTables_filter{display:none;}
	table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
	table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
	.dt-buttons{margin-bottom: 20px;float: right;}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-2">
			<div class="card">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs">
								<li class="nav-item"><a id="pic_btn" href="#foto" data-toggle="tab" class="nav-link active show">Foto</a></li>
								<li class="nav-item"><a id="web_btn" href="#webcam" data-toggle="tab" class="nav-link">Webcam</a></li>
							</ul>
							<div class="tab-content" style="margin-top: 40px;">
								<div id="foto" class="tab-pane fade active show">
								<div class="profile-interest profile-blog pt-3 border-bottom-1 pb-1 profile-interest">
										<div class="row">
											<div class="col-12">
													<a style="cursor:pointer;" id="carregar_imagem" class="interest-cats">
														<img style="width:100%;" id="image_client"  src="images/noimage.jpg" alt="" class="img-fluid">
													</a>
													<input type="file" style="display:none;" id="ufile" name="ufile">
													<?php $id = $_GET['id']; ?>
													<input type="hidden" id="id_clientt" name="id_clientt" value="<?php echo $id ?>" />
													
												<span id="status_img"></span>
												<div class="progress progress-bar progress-img bg-success wow animated progress-animated" style="width:0%;height:2px;" role="progressbar"> 
													<span class="sr-only"></span> 
												</div>
											</div>
										</div>
										<?php 
										
										if($user_level == 'a'){ ?>
										<!--<a style="width: 100%;margin-top: 10px;" class="btn btn-primary btn-xs single_link" href="#relatoriocolaborador/<?=$id?>" type="button"><span>Relatório</span></a>
										<a style="width: 100%;margin-top: 10px;" class="btn btn-primary btn-xs single_link" href="#designacaogso/<?=$id?>" type="button"><span>Designação GSO</span></a>
										<a style="width: 100%;margin-top: 10px;" class="btn btn-primary btn-xs single_link" href="#designacaoiioars/<?=$id?>" type="button"><span>Designação IIO ARS</span></a>
										<a style="width: 100%;margin-top: 10px;" class="btn btn-primary btn-xs single_link" href="#relatorioinspetores" type="button"><span>Relatório Inspetor</span></a>
										<a style="width: 100%;margin-top: 10px;" class="btn btn-primary btn-xs single_link" href="#emissaocertificado/<?=$id?>" type="button"><span>Emitir Certificado</span></a>--> 
										<?php } ?>

									</div>
								</div>
								<div id="webcam" class="tab-pane fade">
									<form>
										<div class="row">
											<div class="col-md-12" style="">
												<div id="my_camera"></div>
											</div>
											<div class="col-md-12 text-center" style=" padding-top:20px;">
												<input type="hidden" name="image" class="image-tag">
												<?php $id = $_GET['id']; ?>
												<input type="hidden" name="id_cli" value="<?php echo $id ?>">
												<button class="btn btn-primary" type="button" id="take_snapshot">Tirar Foto</button>
												<button style="display:none;" id="enviar_foto" class="btn btn-success">Enviar Foto</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-10">
			<div class="card">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs">
								<li class="nav-item"><a id="geral_" href="#geral" data-toggle="tab" class="nav-link active show">Geral</a></li>
								<li class="nav-item"><a href="#ativos" data-toggle="tab" class="nav-link">Histórico de Serviços</a></li>
								<li class="nav-item"><a href="#indicadores" data-toggle="tab" class="nav-link">Indicadores</a></li>
								<li class="nav-item"><a href="#configuracoes" data-toggle="tab" class="nav-link">Configurações</a></li>
								<li class="nav-item"><a href="#jornada_trabalho" data-toggle="tab" class="nav-link">Jornada de trabalho</a></li>
								<li class="nav-item"><a href="#qualificacao" data-toggle="tab" class="nav-link">Treinamentos</a></li>
								<li class="nav-item"><a href="#documentos" data-toggle="tab" class="nav-link">Documentos</a></li>
								</ul>
							<div class="tab-content" style="margin-top: 40px;">
								<div id="geral" class="tab-pane fade active show">
									<div class="pt-3">
										<h4 class="card-title">Dados Pessoais</h4>
											<br>
										<div class="settings-form">
											<!--<h4 class="text-primary">Account Setting</h4>-->
											<form class="form-update-func" action="javascript:updateFunc();" method="post" style="width:100%;">
											<?php $id = $_GET['id']; ?>
											<input type="hidden" id="id_page" value="<?=$id;?>" >
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Nome</label>
															<div class="input-group">
																<input type="text" name="nome" id="nome" class="form-control" placeholder="Nome Cliente" required >
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Permissão</label>
															<div class="input-group">
																<select id="type" name="type" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
																	<option disabled selected value="none">Selecione o tipo</option>
																	<option value="a">Administrador</option>
																	<option value="d">Diretor</option>
																	<option value="f">Funcionário</option>
																	<option value="g">Gerente</option>
																	<option value="r">Responsável Técnico</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Data de Nascimento</label>
															<input type="text" id="data_nascimento" name="data_nascimento" class="data form-control" placeholder="Data Nascimento" >
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Assinatura</label>
															<div id="assinatura"></div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Filial</label>
															<div class="input-group">
																<select id="base" name="type" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
																</select>
															</div>
														</div>
													</div>
													
													
												</div>
												
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">E-mail</label>
															<div class="input-group">
																<input type="email" id="email" name="email" class="form-control" placeholder="E-mail Cliente" required >
															</div>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Telefone 1</label>
															<div class="input-group">
																<input type="text" name="telefone1" id="telefone1" class="phone form-control border-right-0" placeholder="Telefone 1" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Telefone 2</label>
															<div class="input-group">
																<input type="text" id="telefone2" name="telefone2" class="phone form-control border-right-0" placeholder="Telefone 2">
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
																</div>
															</div>
														</div>
													</div>
													<hr>
												
													<div class="col-lg-3">
															<div class="form-group">
																<label class="text-label">Cep</label>
																<input onBlur="pesquisacep(this.value);" type="text" name="cep" id="cep" class="zip form-control" placeholder="Cep">
															</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group">
															<label class="text-label">Endereço</label>
															<div class="input-group">
																<input type="text" class="form-control" id="endereco" name="endereco"  placeholder="Endereço" >
															</div>
														</div>
													</div>
												
												
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Numero</label>
															<input type="text" id="numero" name="numero" class="form-control" placeholder="Número">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Complemento</label>
															<input type="text" id="complemento" name="complemento" class="form-control" placeholder="Complemento" >
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Bairro</label>
															<input type="text" class="form-control " id="bairro" name="bairro"  placeholder="Bairro" >
														</div>
													</div>
												
												
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Cidade</label>
															<input type="text" class="form-control " id="cidade" name="cidade"  placeholder="Cidade" >
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Estado</label>
															<input type="text" class="form-control " id="estado" name="estado"  placeholder="Estado" >
														</div>
													</div>
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Local de Nascimento</label>
															<input type="text" class="form-control " id="local_nascimento" name="local_nascimento"  placeholder="Local Nascimento" >
														</div>
													</div>
												
													<!--<div class="col-lg-3">
														<div class="form-group">
															<label class="text-label">Sexo</label>
															<div class="input-group">
																<select id="sexo" name="sexo" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
																	<option disabled selected value="none">Selecione o sexo</option>
																	<option value="m">Masculino</option>
																	<option value="f">Feminino</option>
																</select>
															</div>
														</div>
													</div>-->
												</div>
												
												<div class="row">
													<div class="col-lg-12">
														<br>
														<h4>Dados Profissionais</h2>
														<br>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Data Admissão</label>
															<div class="input-group">
																<input type="text" name="data_admicao" id="data_admicao" class="data form-control" placeholder="Data Admissão" >
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Cargo</label>
															<div class="input-group">
																<select id="cargo" name="cargo" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
																	<option disabled selected value="none">Selecione o tipo</option>
																	<option value="Gestor da Qualidade">Gestor da Qualidade</option>
																	<option value="Inspetor da Qualidade">Inspetor da Qualidade</option>
																	<option value="Inspetor da Qualidade e MMA">Inspetor da Qualidade e MMA</option>
																	<option value="Responsável Técnico">Responsável Técnico</option>
																	<option value="Supervisor Técnico Operacional">Supervisor Técnico Operacional</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Responsável Técnico</label>
															<div class="input-group">
																<input class="form-check-input styled-checkbox" id="type2" type="checkbox" name="type2" value="sim">
																<label for="type2" class="form-check-label check-green ">Sim</label>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Informação Extra</label>
															<textarea type="text" id="info_extra" name="info_extra" class="form-control" ></textarea>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-lg-5">
														<div class="form-group">
															<label class="text-label">Comissão (Em Porcentagem %)</label>
															<input type="text" id="comissao" name="comissao" class="form-control" placeholder="Valor em %" />
														</div>
													</div>
												</div>
												<input type="hidden" id="lat" name="lat" class="form-control" />
												<input type="hidden" id="lon" name="lon" class="form-control" />
												<button style="width:100%;" id="save_func" class="btn btn-primary" type="submit">Salvar</button>
											</form>


											<div class="row">
													<div class="col-lg-12">
														<br>
														<h4>Documentação</h2>
														<br>

														<form class="form-config-func" action="" method="post" style="width:100%;">
															<?php $id = $_GET['id']; ?>
															<div class="row">
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label class="text-label">Descrição</label>
																			<div class="input-group">
																			<input type="text" name="descricao_habilitacao" id="descricao_habilitacao" class="form-control" placeholder="Ex: CPF , RG , CNH , PASSAPORTE , VISTO AMERICANDO" required="" >
																			</div>
																		</div>
																	</div>	
																	<div class="col-lg-3">
																		<div class="form-group">
																			<label class="text-label">Conteúdo</label>
																			<div class="input-group">
																				<input type="text" name="nome" id="conteudo_habilitacao" class="form-control" placeholder="EX: XXX.XXX.XXX-XX" required="" >
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-3">
																		<div class="form-group">
																			<label class="text-label">Data Expira</label>
																			<div class="input-group">
																				<input type="text" name="data_expira_habilitacao" id="data_expira_habilitacao" class="data form-control" placeholder="EX: 10/10/2023" required="" >
																			</div>
																		</div>
																	</div>
																	<div class="input-group"> 
																			<button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="addHabilitacao()">Adicionar Documentação</button>		
																		</div>
																	<div class="col-lg-3">
																		
																	</div>
														</form>

													</div>

													<div class="table-responsive">
														<table class="table table-padded recent-order-list-table table-responsive-fix-big">
															<thead>
																<tr>
																	<th>Descrição</th>
																	<th>Conteúdo</th>
																	<th>Data Expira</th>
																	<th>Dias</th>
																	<th>Status</th>
																	<th>Ação</th>
																</tr>
															</thead>
															<tbody id="lista_habilitacao" >
															</tbody>
														</table>
													</div>

												</div>


										</div>
									</div>
								</div>
								</div>

								<div id="ativos" class="tab-pane fade">
									<div id="modal_pet"></div>
									<input type="hidden" id="numero_ativos" value="0">
									
									<div class="table-responsive">
										<table class="table table-padded recent-order-list-table table-responsive-fix-big" id="lista_clientes" >
											<thead>
												<tr>
													<th>Nome Cliente</th>
													<th>Serviço</th>
													<th>Data</th>
													<th>Iniciado</th>
													<th>Finalizado</th>
													<th>Tempo</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody  >
												</tbody>
										</table>
									</div>
								</div>
								<div id="indicadores" class="tab-pane fade">
									<div class="row">
											<div class="col-lg-2 col-6 col-xxl-3 col-sm-12 col-md-12">
													<div class="widget-music-category" >
														<div class="card-body text-center">
															<h3 class="text-white label-secondary mb-4" style="border-radius: 5px;padding: 5px;" id="total_geral">0</h3>
															<h4>Nº de Atendimentos </h4>
														</div>
													</div>
											</div>
											<div class="col-lg-2 col-6 col-xxl-3 col-sm-12 col-md-12">
													<div class="widget-music-category" >
														<div class="card-body text-center">
															<h3 class="label-warning text-white mb-4" style="border-radius: 5px;padding: 5px;" id="soma_valor_total">0</h3>
															<h4>Valor Total Gerado</h4>
														</div>
													</div>
											</div>
											<div class="col-lg-2 col-6 col-xxl-3 col-sm-12 col-md-12">
													<div class="widget-music-category" >
														<div class="card-body text-center">
															<h3 class="label-secondary text-white mb-4" style="border-radius: 5px;padding: 5px;" id="soma_valor_comissao">0</h3>
															<h4>Valor Total Comissão</h4>
														</div>
													</div>
											</div>
											<div class="col-lg-3 col-6 col-xxl-3 col-sm-12 col-md-12">
													<div class="widget-music-category" >
														<div class="card-body text-center">
															<h3 class="text-white label-warning mb-4" style="border-radius: 5px;padding: 5px;" id="latest_visit">Nenhuma Informação</h3>
															<h4>Último Serviço</h4>
														</div>
													</div>
											</div>
											<div class="col-lg-3 col-6 col-xxl-3 col-sm-12 col-md-12">
													<div class="widget-music-category" >
														<div class="card-body text-center">
														<h3 class="label-secondary text-white mb-4" style="border-radius: 5px;padding: 5px;" id="most_service">Nenhuma Informação</h3>
															<h4>Serviço mais realizado</h4>
														</div>
													</div>
											</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-12 col-xxl-12">
												<div class="widget-music-category" >
													<div class="card-body">
														<h4>Quantidade de atendimento por Mês</h4>
														<div style="height:400px" id="ind_mes" ></div>
													</div>
												</div>
										</div>
										<div class="col-lg-12 col-12 col-xxl-12">
												<div class="widget-music-category" >
													<div class="card-body">
														<h4>Análise Semanal</h4>
														<div style="height:400px" id="ind_semanal" ></div>
													</div>
												</div>
										</div>
									</div>
									<!-- ROW TEST -->
									<div class="row">
										<div class="col-lg-12">
											<div class="cards">
												<div class="row">
													<div class="col-lg-9 pr-lg-0">
														<div class="card-body">
															<div class="d-flex justify-content-between mb-3">
																<h4 class="card-title">Tipo de Serviços <span id="servicos_pendentes">0</span></h4>
															</div>
															<div style="height:400px"  id="all_service" ></div>
														</div>
													</div>
													<div class="col-lg-3 pl-lg-0">
														<div class="card-body bg-primary sale-report d-flex align-items-center">
															<div class="wrapper flex-fill text-center text-lg-left text-white">
																<h4 class="mb-5">Relação de Horas Trabalhadas</h4>
																<div class="d-flex d-lg-block justify-content-between main-report">
																	<div class="item">
																		<p>Horas Planejadas</p>
																		<h2 id="hora_total_esperado"></h2>
																	</div>
																	<div class="item">
																		<p style="color:#ffff4b;">Horas Realizadas</p>
																		<h2 style="color:#ffff4b;" id="hora_total_gasto"></h2>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>


								<!--Configurações-->
								<div id="configuracoes" class="tab-pane fade">

									<form class="form-config-func" action="" method="post" style="width:100%;">
											<?php $id = $_GET['id']; ?>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Serviços não autorizado</label>
															<div class="input-group">
																<select id="servico" name="type" style="width: 100%;height:50px;border: 1px solid #dddfe1;">
																</select>
															</div>
														</div>
													</div>	
													<div class="col-lg-3">
														<div class="form-group">
															<label class="text-label">Comissão</label>
															<div class="input-group">
																<input type="text" name="nome" id="porcentagemComicao" class="form-control" placeholder="% da comissão" required="" >
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="input-group"> 
															<button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="teamservice()">Adicionar Serviço</button>		
														</div>
													</div>
										</form>
									</div>
									<div class="table-responsive">
										<table class="table table-padded recent-order-list-table table-responsive-fix-big">
											<thead>
												<tr>
													<th>Descrição do Serviço</th>
													<th>Comissão</th>
													<th>Ação</th>
												</tr>
											</thead>
											<tbody id="lista_comicao" >
												</tbody>
										</table>
									</div>
								</div>

								<!--Fim configuracoes -->	
								<!--Jornada de trabalho-->
								<div id="jornada_trabalho" class="tab-pane fade">

									<form class="form-jornada_trab" action="" method="post" style="width:100%;">
											<?php $id = $_GET['id']; ?>
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group">
															<label class="text-label">Dia da semana</label>
															<div class="input-group">
																<select id="dia_semana" name="dia_semana" style="width: 100%;height:50px;border: 1px solid #dddfe1;"  >
																	<option disabled selected value="none">Dia da semana</option>
																	<option value="0">Domingo</option>
																	<option value="1">Segunda-Feira</option>
																	<option value="2">Terça-Feira</option>
																	<option value="3">Quarta-Feira</option>
																	<option value="4">Quinta-Feira</option>
																	<option value="5">Sexta-Feira</option>
																	<option value="6">Sábado</option>
																</select>
															</div>
														</div>
													</div>	
													<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Horario de inicio</label>
															<div class="input-group">
																<input type="text" name="nome" id="horaInicio" class="form-control timepicker_ " placeholder="Ex: 08:00" required="" >
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Horario de saída</label>
															<div class="input-group">
																<input type="text" name="nome" id="horafinal" class="form-control timepicker_ " placeholder="Ex: 19:00" required="" >
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Inicio da pausa</label>
															<div class="input-group">
																<input type="text" name="nome" id="pausaInicio" class="form-control timepicker_ " placeholder="Ex: 12:00" required="" >
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Final da pausa</label>
															<div class="input-group">
																<input type="text" name="nome" id="pausaFinal" class="form-control timepicker_ " placeholder="Ex: 14:00" required="" >
															</div>
														</div>
													</div>

													<div class="col-lg-12">
														<div class="input-group"> 
															<button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="CadastraJornadaTrabalho()">Adicionar Horario</button>		
														</div>
													</div>
										</form>


										<div class="table-responsive">
											<table class="table table-padded recent-order-list-table table-responsive-fix-big">
												<thead>
													<tr>
														<th>Dia da Semana</th>
														<th>Horario de inicio</th>
														<th>Horario de saída</th>
														<th>Inicio da pausa</th>
														<th>Final da pausa</th>
														<th>Ação</th>
													</tr>
												</thead>
												<tbody id="lista_dias_trabalho" >
												</tbody>
											</table>
										</div>

									</div>
								</div>
								<!--FIM JORNADA TRABALAHO-->

								<!-- INICIO QUALIFICACAO -->
								<div id="qualificacao" class="tab-pane fade">

									<form class="form-jornada_trab" action="" method="post" style="width:100%;">
												<?php $id = $_GET['id']; ?>
												<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label class="text-label">Descrição</label>
																<div class="input-group">
																	<input type="text" name="desc_qual" id="desc_qual" class="form-control" placeholder="" required="" >
																</div>
															</div>
														</div>	
														<div class="col-lg-6">
															<div class="form-group">
																<label class="text-label">Tipo</label>
																<div class="input-group">
																	<input type="text" name="tipo_qual" id="tipo_qual" class="form-control" placeholder="" required="" >
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label class="text-label">Número</label>
																<div class="input-group">
																	<input type="text" name="numero_qual" id="numero_qual" class="form-control" placeholder="" required="" >
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label class="text-label">Validade</label>
																<div class="input-group">
																	<input type="text" name="validade_qual" id="validade_qual" class="data form-control datetimepicker_inicio " placeholder="" required="" >
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label class="text-label">Carga Horária</label>
																<div class="input-group">
																	<input type="text" name="horaria_qual" id="horaria_qual" class="form-control" placeholder="" required="" >
																</div>
															</div>
														</div>
														<div class="col-lg-10">
															<div class="form-group">
																<label class="text-label">Local</label>
																<div class="input-group">
																	<input type="text" name="local_qual" id="local_qual" class="form-control" placeholder="" required="" >
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label class="text-label">Data Inicial</label>
																<div class="input-group">
																	<input type="text" name="dataini_qual" id="dataini_qual" class="data form-control datetimepicker_inicio " placeholder="" required="" >
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label class="text-label">Data Final</label>
																<div class="input-group">
																	<input type="text" name="datafim_qual" id="datafim_qual" class="data form-control datetimepicker_inicio " placeholder="" required="" >
																</div>
															</div>
														</div>
														

														<div class="col-lg-12">
															<div class="input-group"> 
																<button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="CadastraQual()">Adicionar Qualificação</button>		
															</div>
														</div>
											</form>


											<div class="table-responsive">
											<table class="table table-padded recent-order-list-table table-responsive-fix-big">
												<thead>
													<tr>
														<th>Descrição</th>
														<th>Tipo</th>
														<th>Número</th>
														<th>Validade</th>
														<th>Carga Horária</th>
														<th>Local</th>
														<th>Data Inicial</th>
														<th>Data Final</th>
														<th>Dias</th>
														<th>Status</th>
														<th>Ação</th>
													</tr>
												</thead>
												<tbody id="lista_qual" >
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div id="documentos" class="tab-pane fade">
								<div class="card-body widget-file-container">
                                <h4 class="card-title">Documentos Colaborador <button style="float:right;" class="btn btn-primary" onclick="ModalNewDoc()">Novo Documento</button></h4>
                                <div id="lista_documentos" class="d-flex flex-wrap"></div>
                            </div>

								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

        <!-- Modal to Event Details -->
        <div id="calendarModal" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 style="color: #222;">Editar Comissão</h2> <button type="button" class="close" data-dismiss="modal" style="color: #222;opacity: 1;">×</button>
                    </div>
                    <div id="modalBody" class="modal-body">
                    <div id="modalWhen" style="margin-top:5px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="ModalDate" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 style="color: #222;">Editar Jornada de trabalho</h2> <button type="button" class="close" data-dismiss="modal" style="color: #222;opacity: 1;">×</button>
                    </div>
                    <div id="modalDateBody" class="modal-body">
                    <div id="modalDateWhen" style="margin-top:5px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="ModalDoc" class="modal fade">
            <div class="modal-dialog" style="max-width:960px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 style="color: #222;">Visualizar Documento</h2> <button type="button" class="close" data-dismiss="modal" style="color: #222;opacity: 1;">×</button>
                    </div>
                    <div id="modalDocBody" class="modal-body">
                    <div id="modalDocWhen" style="margin-top:5px;"></div>
                    </div>
                </div>
            </div>
        </div>


    <!--<script src="assets/plugins/bootstrap-material-datetimepicker/js/pt-br.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="js/plugins-init/material-date-picker-init.js"></script>-->
    <script src="js/get_cep.js"></script>
	
	<script src="includes/funcionario/update_funcionario.js"></script>


	
<script>
    function get_lista_base(){
		var idCliente = $("#id_clientt").val();
		
		$.ajax({
		url:"includes/local/get_base",
		dataType:'JSON',
		method:"GET",
		data:{id:idCliente},
			success:function(response){
				var option = '<option value="0">Nenhum</option>'
				var i;
				for (i = 0; i < response.length; i++) {
					option += '<option value="'+response[i].sigla+'">'+response[i].sigla+'-'+response[i].descricao+'</option>';
							
				}
				$('#base').html(option);	
				
			}
		}); 
   }

   get_lista_base();

function get_service_hist(){
		var id = $("#id_clientt").val();

		var table = $('#lista_clientes').DataTable({
		ajax: {
			url: 'includes/funcionario/get_func_hist',
			data:{
				id:id
			},
			dataType:'JSON',
			method:'POST'
		},
		language: {
			"lengthMenu": "Mostrar  _MENU_ linhas registros",
			"zeroRecords": "Nenhum resultado encontrado",
			"info": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
			"infoEmpty": "Nenhum dado disponível",
			"infoFiltered": "(Filtrado de _MAX_ registros no total)",
			"sSearch":       "Procurar:",
			"oPaginate": {
				"sFirst":    "Primeiro",
				"sPrevious": "Anterior",
				"sNext":     "Seguinte",
				"sLast":     "Último"
			}
		}   ,
		
		columnDefs: [ 
			
			{ 
				"targets": 0 ,
				"data": 'nome_cliente',
					"render": function (data, type, row, meta) {
								var img = row.foto_cliente + '?' + (new Date()).getTime();
								return '<a  href="#cliente-'+row.id_pet+'" target="_blank"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_pet+'</a>';
					}		   
			},
			{ 
				"targets": 1 , 
				"data": 'short_dec'
				
			},
			{ 
				"targets": 2 , 
				"data": 'inicio_service'
				
			},
			{ 
				"targets": 3 , 
				"data": 'started_at'
				
			},
			{ 
				"targets": 4 , 
				"data": 'ended_at'
				
			},
			{ 
				"targets": 5 , 
				"data": 'hora_total_gasto'
				
			},
			
			{ 
			"targets": 6 ,
			"data": 'status',
			"className": "text-right",
			"render": function (data, type, row, meta) {

				status = row.status;
				if(status == 'Pendente'){
					status_type = 'label-light'
					color = 'text-dark';
				} else if(status == 'Em Andamento') {
					status_type = 'label-warning'
					color = 'text-white';
				} else {
					status_type = 'label-success'
					color = 'text-white';
				}
					return '<span class=" '+color+' label label label-rounded '+status_type+'">'+status+'</span>';
			}		   
			},

			{ "orderable": false, "targets": 1 },
		],
		"createdRow": function( row, data, dataIndex ) {
			$(row).addClass( 'row_'+data.id );
		},
		dom: 'Bfrtip',
		buttons: [
					{
						extend: 'print',
						orientation: 'landscape',
						messageTop: '<h2>Lista de Clientes</h2>',
						columns: ':not(.select-checkbox)',
						orientation: 'landscape',
						text: 'Imprimir',
						className: 'btn btn-primary' 
					},
					{
						extend: 'excel',
						className: 'btn btn-primary'
					},
					{
						extend: 'pdf',
						className: 'btn btn-primary'
					}
				],

		"deferRender": true
		});

		}

	
  setTimeout(function(){ 
	//get_service_hist();

	$("#search_clientes").on("input", function (e) {
      e.preventDefault();
     $('#lista_clientes').DataTable().search($(this).val()).draw(); 
  });
}, 30);

function get_historico_servico(){
	var id = $("#id_clientt").val();
	$.ajax({
     url:"includes/funcionario/get_func_hist",
	 method:"POST",
	 dataType:'json',
     data:{id:id},
		success:function(response){
		var status = response.status;
		var lista_cliente = response;
		var numero_ativos = response.numero_pets;
		var modal_pet = response.modal_pet;
		
		for(var a = 0; a < lista_cliente.length; a++){
			id_servico = lista_cliente[a].id_servico;
			short_dec_servico = lista_cliente[a].short_dec;
			status = lista_cliente[a].status;
			id_client = lista_cliente[a].id_client;
			nome_cliente = lista_cliente[a].nome_cliente;
			foto_cliente = lista_cliente[a].foto_cliente;
			id_pet = lista_cliente[a].id_pet;
			nome_pet = lista_cliente[a].nome_pet;
			foto_pet = lista_cliente[a].foto_pet;
			started_at = lista_cliente[a].started_at;
			ended_at = lista_cliente[a].ended_at;
			service_name = lista_cliente[a].service_name;
			price = lista_cliente[a].price;
			info_extra = lista_cliente[a].info_extra;
			pet_taxi = lista_cliente[a].pet_taxi;
			total_comission = lista_cliente[a].total_comission;
			hora_total_gasto = lista_cliente[a].hora_total_gasto;
			inicio_service = lista_cliente[a].inicio_service;
			foto_cliente = foto_cliente +'?' + (new Date()).getTime();

			if(status == 'Pendente'){
				status_type = 'label-light'
				color = '#222';
            } else if(status == 'Em Andamento') {
				status_type = 'label-warning'
				color = '#fff';
            } else if(status == 'Cancelado') {
				status_type = 'label-cancel'
				color = '#fff';
            } else {
				status_type = 'label-success'
				color = '#fff';
            }
			lista_clientes += '<tr id="'+id_pet+'">'+
												'<td id="'+id_client+'"><a href="#cliente-'+id_client+'"><img class="avatar_table" src="'+foto_cliente+'" > '+nome_cliente+'</a></td>'+
												'<td><span id="'+id_client+'">'+short_dec_servico+'</span></td>'+
												'<td id="'+id_client+'">'+inicio_service+'</td>'+
												'<td id="'+id_client+'">'+started_at+'</td>'+
												'<td id="'+id_client+'">'+ended_at+'</td>'+
												'<td id="'+id_client+'">'+hora_total_gasto+'</td>'+
												'<td><span style="color:'+color+'" class="label label label-rounded '+status_type+'">'+status+'</span>'+

										'</tr>';
			}
      		$('#lista_clientes').html(lista_clientes);

    }
    }); 

  }
  
  setTimeout(function(){ 
	get_historico_servico();

	$("#search_clientes").on("input", function (e) {
      e.preventDefault();
     $('#lista_clientes').DataTable().search($(this).val()).draw(); 
  });
}, 30);
  
  //get_historico_servico();

  	$("#carregar_imagem").click(function(){
		$("#ufile").click();
	});
  	



	
	$("#ufile").change(function(){
		var file = event.target.files;
		$("#load_img").show();
		$(".progress").css("width", "0px");
		$("#status_img").html("0%");

		var reader = new FileReader();
		reader.onload = function(e){
			$("#image_client").attr("src", e.target.result);
		}
		reader.readAsDataURL(this.files[0]);

		var data = new FormData();
		$.each(file, function(key, value)
		{
		var id = $('#id_clientt').val();
		data.append('upload_file', value);
		data.append("id", id);
		});

		$.ajax({
	  	xhr: function() {
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  //$("#status_img").html(percentInt + "%");
		  }
		}, false);
		xhr.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  $(".progress").css("width", percentInt+"%");
		  $("#status_img").html(percentInt + "%");


		  }
		}, false);
		return xhr;
	  },
	  type: 'POST',
	  url:"includes/funcionario/upload_pic_funcionario",
	  data: data,
	  dataType:'JSON',
	  async: true,
	  cache: false,
	  processData: false,
	  contentType: false,
	  success: function(data) {
		var image_path;
		status = data.status;
		status_message = data.status_message;
		id_pic = data.id_pic;

		if (status == 'SUCCESS') {
			setTimeout(function(){
				$('#status_img').fadeOut();
				$('progress').fadeOut();
			 }, 4000);
		
		} 
	  }
	});
	});

	$("#web_btn").click(function() {
		turn_on_camera();
	});

	$( "#pic_btn" ).click(function() {
		turn_off_camera();
	});

	function turn_off_camera(){
		Webcam.reset();
	}
	
	function turn_on_camera(){
		Webcam.on( 'error', function(err) {
		});

		Webcam.set({
			width: 285,
			height: 285,
			image_format: 'jpeg',
			jpeg_quality: 100
		});
	
		Webcam.attach('#my_camera');

		$('#take_snapshot').click(function(){
			Webcam.snap( function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
				image = data_uri;
				id = $("#id_clientt").val();

				$.ajax({
				url:"includes/funcionario/take_pic_funcionario",
				dataType:'JSON',
				data: {base64:image,id:id},// Add as Data the Previously create formData
				type:"POST",
				error:function(err){
					console.error(err);
				},
				success:function(data){
				},
				complete:function(){
				}
			});
			
			});
			
		})
	
		function take_snapshot() {
			var data_uri;
			Webcam.snap( function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
				image = data_uri;
				id = $("#id_clientt").val();
				$.ajax({
				url:"includes/view/pet/take_pic_funcionario",
				dataType:'JSON',
				data: {base64:image,id:id},// Add as Data the Previously create formData
				type:"POST",
				error:function(err){
					console.error(err);
				},
				success:function(data){
				},
				complete:function(){
				}
			});
			
			});
			

				
    	}
	
	}

	function get_indicadores(){
		Highcharts.setOptions({
			colors: ["#dfb590","#83c9d6","#60a9b7","#d0a37d","#464a53","#f8d999","#733f17","#935f37","#ad8a60","#cf965f","#bc6337","#d59f7b","#f2c280","#edc192","#f9d4a0","#fee3c6"]
		});

	var id = $("#id_clientt").val();
	data_count = 0;
	data_valor = 0;
	soma_valor_total = 0;
	total_geral = 0;
	latest_visit = 0;
	most_service = 0;
	soma_valor_comissao = 0;
	$.ajax({
				type: 'POST',
				url: 'includes/funcionario/get_func_indicador',
				data:{id:id},
				dataType: 'json',
				success: function (result) { 

					status = result.status;

					if(status == 'SUCCESS'){
						data_count = result.data_count;
						data_valor = result.data_valor;
						soma_valor_total = result.soma_valor_total;
						total_geral = result.total_geral;
						latest_visit = result.latest_visit;
						most_service = result.most_service;
						week_val = result.week_val;
						total_servico_prev = result.total_servico_prev;
						soma_valor_comissao = result.soma_valor_comissao;
						total_prod = result.valor_total_prod_mes_prev
						hora_total_gasto = result.hora_total_gasto
						hora_total_esperado = result.hora_total_esperado
					} else {
						data_count = 0;
						data_valor = 0;
						soma_valor_total = 0;
						total_geral = 0;
						latest_visit = 'N/A';
						most_service ='N/A';
						week_val = 0;
						total_servico_prev = 0;
						soma_valor_comissao = 0;
						total_prod = 0;
						hora_total_gasto = 0;
						hora_total_esperado = 0;
					}
					


					if(soma_valor_total != 'undefined'){
						$('#soma_valor_total').html('R$'+soma_valor_total);
					} else {
						$('#soma_valor_total').html('R$0,00');
					}
					
					$('#total_geral').html(total_geral);
					$('#latest_visit').html(latest_visit);
					$('#most_service').html(most_service);
					$('#servicos_pendentes').html(total_servico_prev);
					$('#total_prod').html(hora_total_gasto);
					$('#soma_valor_comissao').html('R$'+soma_valor_comissao);
					$('#hora_total_gasto').html(hora_total_gasto);
					$('#hora_total_esperado').html(hora_total_esperado);
					
					setTimeout(function(){ 
						$('#ind_mes').highcharts({
						chart: {
							type: 'spline',
							zoomType: 'xy',
							animation: {
								enabled: true
							}
						},
						title: {
							text: '',
							x: -20 //center
						},
						xAxis: {
							categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
						},
						yAxis: {
							title: {
								text: ''
							},
										tickInterval: 1,
							plotLines: [{
								value: 0,
								width: 1,
								color: '#65461f'
							}]
						},       tooltip:{
								formatter:function(){
									the_valor = data_valor[this.point.index];
									return   this.key + ' : <b>' + this.y + ' </b> Atendimentos <br> R$' + '<b>'+the_valor+'</b>';
								}
							},
					
						series: [{
							name: 'Nº de Atendimentos',
							data: data_count,
							color: "#464a53"
						}]
					});

					// INDICADOR SEMANAL
						function getPointCategoryName(point, dimension) {
						var series = point.series,
							isY = dimension === 'y',
							axis = series[isY ? 'yAxis' : 'xAxis'];
						return axis.categories[point[isY ? 'y' : 'x']];
					}

					Highcharts.chart('ind_semanal', {

						chart: {
							type: 'heatmap',
							marginTop: 40,
							marginBottom: 80,
							plotBorderWidth: 1
						},


						title: {
							text: ''
						},

						xAxis: {
							categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro' , 'Novembro' , 'Dezembro']
						},

						yAxis: {
							categories: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
							title: null,
							reversed: true
						},

						accessibility: {
							point: {
								descriptionFormatter: function (point) {
									var ix = point.index + 1,
										xName = getPointCategoryName(point, 'x'),
										yName = getPointCategoryName(point, 'y'),
										val = point.value;
									return ix + '. ' + xName + ' sales ' + yName + ', ' + val + '.';
								}
							}
						},

						colorAxis: {
							min: 0,
							minColor: '#FFFFFF',
							maxColor: Highcharts.getOptions().colors[0]
						},

						legend: {
							align: 'right',
							layout: 'vertical',
							margin: 0,
							verticalAlign: 'top',
							y: 5,
							symbolHeight: 280
						},

						tooltip: {
							formatter: function () {
								return '<b>' + getPointCategoryName(this.point, 'x') + '</b> Atendimentos <br><b>' +
									this.point.value + '</b> Serviços <br><b>' + getPointCategoryName(this.point, 'y') + '</b>';
							}
						},

						series: [{
							name: 'Nº de Serviços',
							borderWidth: 1,
							data:week_val,
							dataLabels: {
								enabled: true,
								color: '#222',
                                textShadow: false ,
                                style: {
                                    textOutline: false,
                                    textShadow: false 
                                }
							}
						}],

						responsive: {
							rules: [{
								condition: {
									maxWidth: 500
								},
								chartOptions: {
									yAxis: {
										labels: {
											formatter: function () {
												return this.value.charAt(0);
											}
										}
									}
								}
							}]
						}

					});

					// ALL SERVICES

					Highcharts.chart('all_service', {
							chart: {
								plotBackgroundColor: null,
								plotBorderWidth: null,
								plotShadow: false,
								type: 'pie',
							},
							title: {
								text: ''
							},
							tooltip: {
                                pointFormat: '{series.name}: <b>{point.y}</b>'
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.y}'
                                    },
									showInLegend: true
								},
								series: {
									events: {
										click: function (event) {
											if(control == true && last_click == event.point.x){
												control = false
											}else{
												control = true
												last_click  = event.point.x
											}
										}
									}
								}
							},
							series: [{
								name: "Quantidade por Serviço",
								data: result.servicos_total
							}]					
					});

					}, 400);

				},
				error: function (result) {
					toastr.error('Erro ao realizar o download dos dados, atualize a página.', 'Erro de download');
				}
			}); 


 }

 get_indicadores();
 //$('#sexo').select2();
 $('#type').select2();		

 	/*Comissao*/
	  $('#servico').select2({
        ajax: {
          url: 'includes/servico/get_servico',
          type : 'POST',
		  dataType: 'JSON',
          delay: 250,
		  data: function (params) {
				return {
				  searchTerm: params.term // search term
				};
		  },
		
				processResults: function (data, page) {
                    var results = [];
                    $.each(data, function (i, v) {
                        var o = {};
                        o.id = v.id;
                        o.short_dec = v.short_dec;
						results.push(o);
                    });

                    return {
                        results: results
                    };
                },
			    cache: true
			  },
		  escapeMarkup: function (markup) { 

				return markup;
			},
		  minimumInputLength: 0,
		  templateResult: formatc,
		  templateSelection: formatc,
      });
	  
	  function formatc(data) {
		var markup = "";
		if(data.loading){
			markup = "Procurando";
		}
		else if (data.id == undefined) {
			markup = 'Nenhum Serviço Cadastrado';
			
		} else {
			var markup = '<span>' + data.short_dec +' </span>';
		}
		return markup;
	}
		function teamservice(){
			var servico = $("#servico").val();
			var id_funcionario = $("#id_page").val();
			var porcentagemComicao = $("#porcentagemComicao").val();

			var data = $('#servico').select2('data');
			serv_txt = data[0].short_dec;
			if(servico == null || servico == ''){
				toastr.error('Erro!', 'Escolha o Serviço');
				return;
			}
			if(porcentagemComicao == null || porcentagemComicao == ''){
				toastr.error('Erro!', 'Digite a comissão');
			return;
			}
			var cat = $("#servico");
			$.ajax({
			url: "includes/servico/cadastrar-team-service", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				servico:servico,
                 id_funcionario :  id_funcionario,
                porcentagemComicao : porcentagemComicao
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id; 
					var lista_comicao_new = "";
					if(status == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						
						lista_comicao_new += '<tr id="com_id_'+last_id+'">'+
									'<td><span id="id_service_'+last_id+'">'+serv_txt+'</span></td>'+
									'<div id="valor_comissao"><td><span  id="func_comission_'+last_id+'">'+porcentagemComicao+'%</span></td>'+
									'<td><button class="btn btn-primary"  onclick="AlterarItem('+last_id+',\''+ porcentagemComicao + '\',\''+ serv_txt + '\')" type="button"><i class="icon-pencil f-s-16"></i></button>        <spam>&nbsp;</spam>'+
									'<button class="btn btn-danger"  onclick="RemoveItem('+last_id+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
							'</tr>';
						
							$('#lista_comicao').append(lista_comicao_new);
						}
						
					
					 else {
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){
				} 
		});
	}

		function addHabilitacao(){

			var diffDays = "";
			var status_doc = ""
			var data_expira_habilitacao = "";

			var id_funcionario = $("#id_page").val();
			var descricao_habilitacao = $("#descricao_habilitacao").val();
			var conteudo_habilitacao = $("#conteudo_habilitacao").val();
			data_expira_habilitacao = $("#data_expira_habilitacao").val();
			if(descricao_habilitacao == null || descricao_habilitacao == ''){
				toastr.error('Erro!', 'Digite a Descrição');
				return;
			}
			if(conteudo_habilitacao == null || conteudo_habilitacao == ''){
				toastr.error('Erro!', 'Digite o Conteúdo');
				return;
			}
			

			$.ajax({
			url: "includes/funcionario/cadastro-habilitacao", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				descricao_habilitacao:descricao_habilitacao,
				conteudo_habilitacao:conteudo_habilitacao,
                id_funcionario :  id_funcionario,
                data_expira_habilitacao : data_expira_habilitacao,
			},
				success: function(response){
					status_server = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id; 

				
					if(data_expira_habilitacao == ''){
						status_doc = 'N/A';
						diffDays = 'N/A';
						data_expira_habilitacao = 'N/A';
					} else {
						var res = data_expira_habilitacao.split("/");
						data_val_now = res[1]+'/'+res[0]+'/'+res[2];
						
						var today = moment().format('MM/DD/YYYY');
						var a = moment(today,'M/D/YYYY'); 
						var b = moment(data_val_now,'M/D/YYYY'); 
						var diffDays = b.diff(a, 'days');
						if(diffDays >= 0){
							status_doc = 'Válido';
						} else {
							status_doc = 'Expirado';
						}

						
					}
					var lista_habil_new = "";
					if(status_server == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						lista_habil_new += '<tr id="habil_'+last_id+'">'+
													'<td><span>'+descricao_habilitacao+'</span></td>'+
													'<td>'+conteudo_habilitacao+'</span></td>'+
													'<td><span>'+data_expira_habilitacao+'</span></td>'+
													'<td><span>'+diffDays+'</span></td>'+
													'<td><span>'+status_doc+'</span></td>'+
													'<td><button class="btn btn-danger"  onclick="RemoveHabilitacao('+last_id+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
											'</tr>';
							$('#lista_habilitacao').append(lista_habil_new);
							$("#descricao_habilitacao").val('');
							$("#conteudo_habilitacao").val('');
							$("#data_expira_habilitacao").val('');
						} else {
						toastr.error('Erro!', status_txt);
					
					} 
				},
				error:function(response){
				} 
		});
	}

	lista_comicao_func();
	function lista_comicao_func(){
		var id_funcionario = $("#id_page").val();

		$.ajax({
     		url:"includes/servico/get_lista_comicao_func",
	 		method:"POST",
	 		dataType:'json',
	 		data:{id_funcionario:id_funcionario},

	 	success:function(response){
			var status = response.status;
			var lista_comicao_func = response;
		for(var a = 0; a < lista_comicao_func.length; a++){
			id = lista_comicao_func[a].id;
			id_team = lista_comicao_func[a].id_tean;
			id_service = lista_comicao_func[a].id_service;
			comission = lista_comicao_func[a].comission;
			short_dec = lista_comicao_func[a].short_dec;
			lista_comicao += '<tr id="com_id_'+id+'">'+
									'<td><span id="id_service_'+id_service+'">'+short_dec+'</span></td>'+
									'<div id="valor_comissao"><td><span  id="func_comission_'+id_service+'">'+comission+'%</span></td>'+
									'<td><button class="btn btn-primary"  onclick="AlterarItem('+id+','+comission+','+id_service+')" type="button"><i class="icon-pencil f-s-16"></i></button>        <spam>&nbsp;</spam>'+
									'<button class="btn btn-danger"  onclick="RemoveItem('+id+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
							'</tr>';
			}
      		$('#lista_comicao').html(lista_comicao);

    	}

    	});
	}
	
	function RemoveItem(id){ 

		information = '<div class="user-info">'+
                            '<h5>Você deseja realmente remover este Serviço?</h5>'+
                        '</div>'+
                    '</div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/servico/delete_comicao_func',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id
                   }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                $('#com_id_'+id).remove();
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
	} 
	
	function RemoveHabilitacao(id){ 

		information = '<div class="user-info">'+
                            '<h5>Você deseja realmente remover esta Habilitação?</h5>'+
                        '</div>'+
                    '</div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/funcionario/delete_habilitacao',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id
                   }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                $('#habil_'+id).remove();
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
	} 

	function AlterarItem(id,comission,id_service){
	event_content = `<div class="modals">
                		<h5>Qual será o novo valor da comissão?</h5>
                	<div class="input-group"><input value=`+comission+` type="text" name="nome" id="new_comission" class="form-control" placeholder="% da comissão" required=""></div>
                	<button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="altera_func_comission(`+id+`,`+comission+`,`+id_service+`)">Alterar Comissão</button>
           			 </div>`
            $('#modalTitle').html('Alterar Comissão');
            $('#modalWhen').html(event_content);
            $('#calendarModal').modal();
    }        

      function altera_func_comission(id,comission,id_service){
          	var new_comission = $("#new_comission").val();
             $.ajax({
                   url: 'includes/servico/altera-func-comission.php',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id, 
                   new_comission : new_comission
                   }
             })

             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                toastr.success(status_txt, 'Sucesso'); 
                $('#calendarModal').modal(); 
                $('#func_comission_'+id_service).val(new_comission);
               
             })
             .fail(function(){
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });

        } 
        /*--Jornada de trabalho---*/

    $('#dia_semana').select2();

    toastr.options = {"positionClass": "toast-top-full-width"}
    $(".time").mask('00:00');
    toastr.options = {"positionClass": "toast-top-full-width"}
    $(".timepicker_").mask('00:00');
	$.datetimepicker.setLocale('pt');
    
	jQuery('.datetimepicker_inicio').datetimepicker({
        timepicker: false, 
        format:'d/m/Y',
		  inline:false,
          todayButton:true,
          autoclose: true,
		  lang:'pt',
		  step: 5,
		  scrollInput: false,
          defaultTime:'07:00' ,
         
	 });
	 
	 jQuery('.datetimepicker_termino').datetimepicker({
        timepicker: false,
           format:'d/m/Y',
          inline:false,
          autoclose: true,
		  todayButton:true,
		  lang:'pt',
		  step: 5,
          scrollInput: false,
          minDate:0,
          defaultTime:'17:00'
     });
     
     jQuery('.timepicker_').datetimepicker({
          timepicker: true,
          datepicker:false,
          format:'H:i',
          inline:false,
          autoclose: true,
		  todayButton:true,
		  lang:'pt',
		  step: 5,
          scrollInput: false,
          minDate:0,
          defaultTime:'07:00',
          onSelectTime:function(dp,$input){
           var min_to_sum = parseInt($('#serduracao').val());
           var date1 = new Date(dp);

           date1.setMinutes(date1.getMinutes() + min_to_sum);
            var horas = date1.getHours();
            if(horas <= 9){
                horas = '0'+horas;
            }

            var minutos = date1.getMinutes();
            if(minutos <= 9){
                minutos = '0'+minutos;
            }
            var hora_final = horas+':'+minutos;
            $('#hora_final_agenda').val(hora_final)

         }
     });


lista_qualifica_func();
function lista_qualifica_func(){

		var id_funcionario = $("#id_page").val();
		
		$.ajax({
			url:"includes/funcionario/get_qualifica_funcionario",
			method:"POST",
			dataType:'json',
			data:{id_funcionario:id_funcionario},

		success:function(response){
			var status = response.status;
			var lista_qual_func = response;
			var new_qualifica_list = "";
			var status = "";
			
			for(var aa = 0; aa < lista_qual_func.length; aa++){
				id = lista_qual_func[aa].id;
				desc_qual = lista_qual_func[aa].desc_qual;
				tipo_qual = lista_qual_func[aa].tipo_qual;
				validade_qual = lista_qual_func[aa].validade_qual;
				numero_qual = lista_qual_func[aa].numero_qual;
				horaria_qual = lista_qual_func[aa].horaria_qual;
				local_qual = lista_qual_func[aa].local_qual;
				dataini_qual = lista_qual_func[aa].dataini_qual;
				datafim_qual = lista_qual_func[aa].datafim_qual;
				
				if(validade_qual == 'N/A'){
					status = 'N/A';
					diffDays = 'N/A';
				} else {
					var res = validade_qual.split("/");
					data_val_now = res[0]+'/'+res[1]+'/'+res[2];
					var today = moment().format('DD/MM/YYYY');
					var a = moment(today,'DD/MM/YYYY'); 
					var b = moment(data_val_now,'DD/MM/YYYY'); 
					var diffDays = b.diff(a, 'days');

					if(diffDays >= 0){
						status = '<span style="color:#fff" class="label label label-rounded label-success">Válido</span>';
					} else {
						status = '<span style="color:#fff" class="label label label-rounded label-danger">Expirado</span>';
					}
				}
				new_qualifica_list += '<tr id="qualifica__id_'+id+'">'+
				'<td><span class="text-pale-sky" >'+desc_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+tipo_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+numero_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+validade_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+horaria_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+local_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+dataini_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+datafim_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+diffDays+'</span></td>'+
				'<td><span class="text-pale-sky" >'+status+'</span></td>'+
				'<td><button class="btn btn-light editqual" id="'+id+'" type="button"><i class="icon-pencil f-s-17"></i></button><button class="btn btn-danger" onclick="RemoveQualifica('+id+')" type="button"><i class="icon-trash f-s-17"></i></button></td></tr>';

			}

			$('#lista_qual').html(new_qualifica_list);

			 setTimeout(function(){
				$('.editqual').on('click', function(e){ 
					e.preventDefault();
					var id = this.id;
					$('#editar-treinamento').modal();
					$.ajax({
                            url: "includes/treinamento/get_treinamento_user",
                           data: {
                            id:id
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    data = response[0];
									$('#desc_qual_edit').val(data.desc_qual);
									$('#tipo_qual_edit').val(data.tipo_qual);
									$('#numero_qual_edit').val(data.numero_qual);
									$('#validade_qual_edit').val(data.validade_qual);
									$('#horaria_qual_edit').val(data.horaria_qual);
									$('#local_qual_edit').val(data.local_qual);
									$('#dataini_qual_edit').val(data.dataini_qual);
									$('#datafim_qual_edit').val(data.datafim_qual);
									$('#id_qual_edit').val(data.id);
                                 }
                           });
				});

             }, 500);
			

		}
	});

	

	

}

function updatequal(){
	var id = $('#id_qual_edit').val();
	var desc_qual = $('#desc_qual_edit').val();
	var tipo_qual = $('#tipo_qual_edit').val();
	var numero_qual = $('#numero_qual_edit').val();
	var validade_qual = $('#validade_qual_edit').val();
	var horaria_qual = $('#horaria_qual_edit').val();
	var local_qual = $('#local_qual_edit').val();
	var dataini_qual = $('#dataini_qual_edit').val();
	var datafim_qual = $('#datafim_qual_edit').val();

	$.ajax({
		url: 'includes/treinamento/update_treinamento',
		type: 'POST',
		dataType:"json",
		data: {
		id : id, 
		desc_qual : desc_qual,
		tipo_qual : tipo_qual,
		numero_qual : numero_qual,
		validade_qual : validade_qual,
		horaria_qual : horaria_qual,
		local_qual : local_qual,
		dataini_qual : dataini_qual,
		datafim_qual : datafim_qual
	}
	})

	.done(function(response){
	var json = response;
	status = json.status;
	status_txt = json.status_txt;
	toastr.success(status_txt, 'Sucesso'); 

	$('#editar-treinamento').modal('hide');
	setTimeout(function(){
		var list_qualifica = "";

		var res = validade_qual.split("/");
		data_val_now = res[1]+'/'+res[0]+'/'+res[2];
		var today = moment().format('MM/DD/YYYY');
		var a = moment(today,'M/D/YYYY'); 
		var b = moment(data_val_now,'M/D/YYYY'); 
		var diffDays = b.diff(a, 'days');
		var status = "";


			
		if(diffDays > 0){
			status = 'Válido';
		} else {
			status = 'Expirado';
		}

		list_qualifica += '<td><span class="text-pale-sky" >'+desc_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+tipo_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+numero_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+validade_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+horaria_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+local_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+dataini_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+datafim_qual+'</span></td>'+
				'<td><span class="text-pale-sky" >'+diffDays+'</span></td>'+
				'<td><span class="text-pale-sky" >'+status+'</span></td>'+
				'<td><button class="btn btn-light editqual" id="'+id+'" type="button"><i class="icon-pencil f-s-17"></i></button> <button class="btn btn-danger" onclick="RemoveQualifica('+id+')" type="button"><i class="icon-trash f-s-17"></i></button></td>';
		
		$('#qualifica__id_'+id+'').html(list_qualifica);
	}, 10);
	})
}

lista_habilicatao_func();
function lista_habilicatao_func(){

		var id_funcionario = $("#id_page").val();
		$.ajax({
			url:"includes/funcionario/get_habilitacao_funcionario",
			method:"POST",
			dataType:'json',
			data:{id_funcionario:id_funcionario},

		success:function(response){
			var status = response.status;
			var lista_habil_func = response;
			var new_habilita_list = "";
			
			for(var aa = 0; aa < lista_habil_func.length; aa++){
				
				id = lista_habil_func[aa].id;
				descricao = lista_habil_func[aa].descricao;
				valor = lista_habil_func[aa].valor;
				data_expira = lista_habil_func[aa].data_expira;
				data_cadastro = lista_habil_func[aa].data_cadastro;
				dias_expira = lista_habil_func[aa].dias_expira;
				
				if(dias_expira == 'N/A'){
					status = 'N/A';
				} else {
				if(dias_expira >= 0){
					status = '<span style="color:#fff" class="label label label-rounded label-success">Válido</span>';
				} else {
					status = '<span style="color:#fff" class="label label label-rounded btn-danger ">Expirado</span>';
					
				}
				}
				new_habilita_list += '<tr id="habil_'+id+'">'+
				'<td><span class="text-pale-sky" >'+descricao+'</span></td>'+
				'<td><span class="text-pale-sky" >'+valor+'</span></td>'+
				'<td><span class="text-pale-sky" >'+data_expira+'</span></td>'+
				'<td><span class="text-pale-sky" >'+dias_expira+'</span></td>'+
				'<td><span class="text-pale-sky" >'+status+'</span></td>'+
				'<td><button class="btn btn-light editdoc" id="'+id+'" type="button"><i class="icon-pencil f-s-17"></i></button><button class="btn btn-danger" onclick="RemoveHabilitacao('+id+')" type="button"><i class="icon-trash f-s-17"></i></button></td></tr>';

			}

			$('#lista_habilitacao').html(new_habilita_list);

			setTimeout(function(){
				$('.editdoc').on('click', function(e){ 
					e.preventDefault();
					var id = this.id;
					$('#editar-doc').modal();
					$.ajax({
                            url: "includes/funcionario/get_doc_user",
                           data: {
                            id:id
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    data = response[0];
									$('#descricao_habilitacao_edit').val(data.descricao);
									$('#conteudo_habilitacao_edit').val(data.valor);
									$('#data_expira_habilitacao_edit').val(data.data_expira);
									$('#id_doc_edit').val(data.id);
                                 }
                           });
				});

             }, 500);

		}
	});
}

function updatedoc(){
	var id = $('#id_doc_edit').val();
	var descricao = $('#descricao_habilitacao_edit').val();
	var valor =  $('#conteudo_habilitacao_edit').val();
	var data_expira = $('#data_expira_habilitacao_edit').val();

	$.ajax({
		url: 'includes/funcionario/update_doc',
		type: 'POST',
		dataType:"json",
		data: {
		id : id, 
		descricao : descricao,
		valor : valor,
		data_expira : data_expira
	}
	})

	.done(function(response){
	var json = response;
	status = json.status;
	status_txt = json.status_txt;
	toastr.success(status_txt, 'Sucesso'); 

	$('#editar-doc').modal('hide');
	setTimeout(function(){
		var list_doc = "";

		var res = data_expira.split("/");
		data_val_now = res[1]+'/'+res[0]+'/'+res[2];
		var today = moment().format('MM/DD/YYYY');
		var a = moment(today,'M/D/YYYY'); 
		var b = moment(data_val_now,'M/D/YYYY'); 
		var diffDays = b.diff(a, 'days');
		var status = "";
		
		if(diffDays == 'N/A' || diffDays == ''){
			status = 'N/A';
		} else {
			if(dias_expira >= 0){
				status = '<span style="color:#fff" class="label label label-rounded label-success">Válido</span>';
			} else {
				status = '<span style="color:#fff" class="label label label-rounded btn-danger ">Expirado</span>';
			}
	   }
		list_doc += '<td><span class="text-pale-sky" >'+descricao+'</span></td>'+
				'<td><span class="text-pale-sky" >'+valor+'</span></td>'+
				'<td><span class="text-pale-sky" >'+data_expira+'</span></td>'+
				'<td><span class="text-pale-sky" >'+dias_expira+'</span></td>'+
				'<td><span class="text-pale-sky" >'+status+'</span></td>'+
				'<td><button class="btn btn-light editdoc" id="'+id+'" type="button"><i class="icon-pencil f-s-17"></i></button><button class="btn btn-danger" onclick="RemoveHabilitacao('+id+')" type="button"><i class="icon-trash f-s-17"></i></button></td>';
		$('#habil_'+id+'').html(list_doc);
	}, 10);
	})
}


	 function CadastraQual(){
		var id_funcionario = $("#id_page").val();
		var desc_qual = $("#desc_qual").val();
		var tipo_qual = $("#tipo_qual").val();
		var validade_qual = $("#validade_qual").val();
		var numero_qual = $("#numero_qual").val();
		var horaria_qual = $("#horaria_qual").val();
		var local_qual = $("#local_qual").val();
		var dataini_qual = $("#dataini_qual").val();
		var datafim_qual = $("#datafim_qual").val();
		
		
		$.ajax({
         url: "includes/funcionario/cadastro-qualifica", 
         type: 'POST',
         dataType:"json", 
         data: {
            id_funcionario : id_funcionario,
            desc_qual : desc_qual,
            tipo_qual : tipo_qual,
            validade_qual : validade_qual,           
            numero_qual : numero_qual ,           
            horaria_qual : horaria_qual ,           
            local_qual : local_qual ,           
            dataini_qual : dataini_qual ,           
            datafim_qual : datafim_qual           

         },
         	success: function(response){
				status = response.status; 
				status_txt = response.status_txt;
				last_id = response.last_id;
					if(status == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						
						var res = validade_qual.split("/");
						data_val_now = res[1]+'/'+res[0]+'/'+res[2];
						var today = moment().format('MM/DD/YYYY');
						var a = moment(today,'M/D/YYYY'); 
						var b = moment(data_val_now,'M/D/YYYY'); 
						var diffDays = b.diff(a, 'days');
						var status = "";

							
						if(diffDays > 0){
							status = 'Válido';
						} else {
							status = 'Expirado';
						}
						
						
						var new_qualifica = "";
						new_qualifica = '<tr id="qualifica__id_'+last_id+'">'+
						'<td><span class="text-pale-sky" >'+desc_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+tipo_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+numero_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+validade_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+horaria_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+local_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+dataini_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+datafim_qual+'</span></td>'+
						'<td><span class="text-pale-sky" >'+diffDays+'</span></td>'+
						'<td><span class="text-pale-sky" >'+status+'</span></td>'+
						'<td><button class="btn btn-danger" onclick="RemoveQualifica('+last_id+')" type="button"><i class="icon-trash f-s-17"></i></button></td></tr>';
						$('#lista_qual').append(new_qualifica);

						$("#desc_qual").val('');
						$("#tipo_qual").val('');
						$("#validade_qual").val('');
						$("#numero_qual").val('');
						$("#horaria_qual").val('');
						$("#local_qual").val('');
						$("#dataini_qual").val('');
						$("#datafim_qual").val('');
						
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
			error:function(response){
			}
		});	
	 }

    function CadastraJornadaTrabalho(){


    	var id_funcionario = $("#id_page").val();
    	var dia_semana = $("#dia_semana").val();
    	var horaInicio = $("#horaInicio").val();
    	var horafinal = $("#horafinal").val();
    	var pausaInicio = $("#pausaInicio").val();
		var pausaFinal = $("#pausaFinal").val();
		
		var cat = $("#dia_semana");

		if(dia_semana == 'null' || dia_semana == null){
			toastr.error('Escolha um dia da Semana!', 'Error');
			return;
		}
		
		if(horaInicio == 'null' || horaInicio == null || horaInicio == ''){
			toastr.error('Digite o horário de Inicio!', 'Error');
			return;
		}
		
		if(horafinal == 'null' || horafinal == null || horafinal == ''){
			toastr.error('Digite o horário de Termino!', 'Error');
			return;
		}

		dia_semana_txt = cat[0].selectedOptions[0].innerText;
    	
    	$.ajax({
         url: "includes/funcionario/cadastro-jornada-trabalho", 
         type: 'POST',
         dataType:"json", 
         data: {
            id_funcionario : id_funcionario,
            dia_semana : dia_semana,
            horaInicio : horaInicio,
            horafinal : horafinal,
            pausaInicio : pausaInicio,
            pausaFinal : pausaFinal

         },
         	success: function(response){
				status = response.status; 
				status_txt = response.status_txt;
				last_id = response.last_id;
					if(status == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						var new_joranada = "";
						new_joranada = '<tr id="jornada__id_'+last_id+'">'+
						'<td><span class="text-pale-sky" id="'+dia_semana+'">'+dia_semana_txt+'</span></td>'+
						'<td><span class="text-pale-sky" id="hora_inicio">'+horaInicio+':00</span></td>'+
						'<td><span class="text-pale-sky" id="hora_termino_1">'+horafinal+':00</span></td>'+
						'<td><span class="text-pale-sky" id="pausa_incio_1">'+pausaInicio+':00</span></td>'+
						'<td><span class="text-pale-sky" id="pausa_final_1">'+pausaFinal+':00</span></td>'+
						'<td><button class="btn btn-primary" onclick="ModalAlteraJornada('+last_id+',\''+ horaInicio + '\',\''+ horafinal + '\',\''+ pausaInicio + '\',\''+ pausaFinal + '\')" type="button"><i class="icon-pencil f-s-16"></i></button><spam>&nbsp;</spam><button class="btn btn-danger" onclick="RemoveDiaJornada('+last_id+')" type="button"><i class="icon-trash f-s-17"></i></button></td></tr>';
						$('#lista_dias_trabalho').append(new_joranada);

					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
			error:function(response){
			}
		});		


    }

    TabelajornadaDeTrabalho();

    function TabelajornadaDeTrabalho(){

		var id_funcionario = $("#id_page").val();

		$.ajax({
     		url:"includes/funcionario/get_lista_jornada.php",
	 		method:"POST",
	 		dataType:'json',
	 		data:{id_funcionario:id_funcionario},

	 	success:function(response){
			var status = response.status;
			var lista_jornada_trabalho = response;

		
		for(var a = 0; a < lista_jornada_trabalho.length; a++){
			id = lista_jornada_trabalho[a].id;
			id_func = lista_jornada_trabalho[a].id_func;
			dia_semana = lista_jornada_trabalho[a].dia_semana;
			hora_inicio = lista_jornada_trabalho[a].hora_inicio;
			hora_termino = lista_jornada_trabalho[a].hora_termino;
			pausa_incio = lista_jornada_trabalho[a].pausa_incio;
			pausa_final = lista_jornada_trabalho[a].pausa_final;

			if (dia_semana == 0){ var dia_semana = "Domingo"}
			else if (dia_semana == 1){ var dia_semana = "Segunda-Feira"}
			else if (dia_semana == 2){ var dia_semana = "Terça-Feira"}
			else if (dia_semana == 3){ var dia_semana = "Quarta-Feira"}
			else if (dia_semana == 4){ var dia_semana = "Quinta-Feira"}
			else if (dia_semana == 5){ var dia_semana = "Sexta-Feira"}
			else if (dia_semana == 6){ var dia_semana = "Sabado"}
			else {var dia_semana = "Error"}	



			lista_dias_trabalho += '<tr id="jornada__id_'+id+'">'+
									'<td><span class="text-pale-sky" id="dia_semana'+id+'">'+dia_semana+'</span></td>'+
									'<td><span class="text-pale-sky" id="hora_inicio">'+hora_inicio+'</span></td>'+
									'<td><span class="text-pale-sky" id="hora_termino_'+id+'">'+hora_termino+'</span></td>'+
									'<td><span class="text-pale-sky" id="pausa_incio_'+id+'">'+pausa_incio+'</span></td>'+
									'<td><span class="text-pale-sky" id="pausa_final_'+id+'">'+pausa_final+'</span></td>'+
									'<td><button class="btn btn-primary" onclick="ModalAlteraJornada('+id+',\''+hora_inicio+'\',\''+hora_termino+'\',\''+pausa_incio+'\',\''+pausa_final+'\')" type="button"><i class="icon-pencil f-s-16"></i></button><spam>&nbsp;</spam>'+
									'<button class="btn btn-danger"  onclick="RemoveDiaJornada('+id+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
									'</tr>';
			}
      		$('#lista_dias_trabalho').html(lista_dias_trabalho);

    	}

    	});

    }


    function RemoveDiaJornada(id){

    information = '<div class="user-info">'+
                        '<h5>Você deseja realmente remover essa jornada de trabalho?</h5>'+
                    '</div></div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/funcionario/delete_dia_jornada.php',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id
                   }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                $('#jornada__id_'+id).remove();
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });

    }


    function RemoveQualifica(id){

    information = '<div class="user-info">'+
                        '<h5>Você deseja realmente remover essa qualificação?</h5>'+
                    '</div></div>';
                
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/funcionario/delete_qualifica',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id
                   }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                $('#qualifica__id_'+id).remove();
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });

    }

	
    function ModalAlteraJornada(id, hora_inicio, hora_termino, pausa_incio, pausa_final){

		ModalJornada = `<div class="modals">
                		<div class="form-group">
						<label class="text-label">Horario de inicio</label>
							<input type="text" value="`+hora_inicio+ `"  name="nome" id="Newhora_Inicio" class="form-control timepicker_ " required="" >
						<label class="text-label">Horario de inicio</label>
								<input type="text" value="`+hora_termino+ `" name="nome"  id="Newhora_termino" class="form-control timepicker_" required="" >
						<label class="text-label">Horario de inicio</label>
								<input type="text" name="nome" value="`+pausa_incio+ `" id="Newpausa_incio" class="form-control timepicker_" required="" >
						<label class="text-label">Horario de inicio</label>
								<input type="text" value="`+pausa_final+ `" name="nome" id="Newpausa_final" class="form-control timepicker_" required="" >
						<button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="altera_jornada(`+id+`)">Salvar</button>						
						</div>

           			 </div>`
        

            $('#modalDateTitle').html('Alterar jornada de trabalho');
            $('#modalDateWhen').html(ModalJornada);
            $('#ModalDate').modal();

            $(".timepicker_").mask('00:00');

				jQuery('.timepicker_').datetimepicker({
				  timepicker: true,
				  datepicker:false,
				  format:'H:i',
				  inline:false,
				  autoclose: true,
				  todayButton:true,
				  lang:'pt',
				  step: 5,
				  scrollInput: false,
				  minDate:0,
				  defaultTime:'07:00',
				  onSelectTime:function(dp,$input){
				   var min_to_sum = parseInt($('#serduracao').val());
				   var date1 = new Date(dp);

				   date1.setMinutes(date1.getMinutes() + min_to_sum);
				    var horas = date1.getHours();
				    if(horas <= 9){
				        horas = '0'+horas;
				    }

				    var minutos = date1.getMinutes();
				    if(minutos <= 9){
				        minutos = '0'+minutos;
				    }
				    var hora_final = horas+':'+minutos;
				    $('#hora_final_agenda').val(hora_final)

				 }
				});
    
    } 
    
	function ModalNewDoc(){
		var ModalNewDoc = "";
		ModalNewDoc = `<div class="modals">
                		<div class="form-group">
						<label class="text-label">Nome Documento</label>
						<input type="text"  name="nome_documento_new" id="nome_documento_new" class="form-control" required="" >
						<div class="text-center">
						<a style="cursor:pointer;" id="carregar_new_doc" >
							<img style="width:250px;" src="images/noimage.jpg" alt="" class="img-fluid">
						</a>
						<span id="status_img_doc"></span>
						<div class="progress progress-bar bg-success wow animated progress-animated progress_doc" style="width:0%;height:2px;" role="progressbar"> 
							<span class="sr-only"></span> 
						</div>
						</div>
						<input type="file" style="display:none;" id="ufile_doc" name="ufile_doc">
												
						</div>

           			 </div>`
        

            $('#modalDocTitle').html('Click na imagem para adicionar o documento');
            $('#modalDocWhen').html(ModalNewDoc);
            $('#ModalDoc').modal();

			$("#carregar_new_doc").click(function(){
				$("#ufile_doc").click();
			});
			
			$("#ufile_doc").change(function(){
			var file = event.target.files;
			$("#load_img_doc").show();
			$(".progress_doc").css("width", "0px");
			$("#status_img_doc").html("0%");

			var reader = new FileReader();
			reader.onload = function(e){
				//$("#image_client").attr("src", e.target.result);
			}
			reader.readAsDataURL(this.files[0]);

			var data = new FormData();
			$.each(file, function(key, value)
			{
			var id = $('#id_clientt').val();
			var nome_documento_new = $('#nome_documento_new').val();
			data.append('upload_file', value);
			data.append('nome_documento_new', nome_documento_new);
			data.append("id", id);
			});

			$.ajax({
			xhr: function() {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener("progress", function(evt){
			if (evt.lengthComputable) {
			var percentComplete = evt.loaded / evt.total;
			var percentInt = parseInt(percentComplete * 100);
			$("#status_img_doc").html(percentInt + "%");
			$(".progress_doc").css("width", percentInt+"%");
			}
			}, false);
			xhr.addEventListener("progress", function(evt){
			if (evt.lengthComputable) {
			var percentComplete = evt.loaded / evt.total;
			var percentInt = parseInt(percentComplete * 100);
			$(".progress_doc").css("width", percentInt+"%");
			$("#status_img_doc").html(percentInt + "%");


			}
			}, false);
			return xhr;
		},
		type: 'POST',
		url:"includes/funcionario/upload_documento",
		data: data,
		dataType:'JSON',
		async: true,
		cache: false,
		processData: false,
		contentType: false,
		success: function(data) {
			var image_path;
			status = data.status;
			status_message = data.status_message;
			link = data.link;
			nome_documento_new = data.nome_documento_new;
			id = data.last_id;

			if (status == 'SUCCESS') {
				setTimeout(function(){
					$('#status_img_doc').fadeOut();
					$('progress_doc').fadeOut();
					$('#ModalDoc').modal('hide');
					toastr.success(status_message, 'Sucesso');  
					var new_doc = "";
					new_doc = '<div id="documento_'+id+'" class="file-container">'+
					'<button class="btn btn-primary btn-sm" onclick="OpenDocModel('+id+',\''+link+'\',\''+nome_documento_new+'\')" type="button"><i class="icon-eye f-s-16"></i></button><spam>&nbsp;</spam>'+
											'<button class="btn btn-danger btn-sm"  onclick="RemoveDocumento('+id+',\''+nome_documento_new+'\')" type="button" ><i class="icon-trash f-s-17"></i></button>'+
                                        '<img style="margin-top:15px;" src="assets/images/icons/35.png" alt="">'+
                                        '<p><small><a href="'+link+'">'+nome_documento_new+'</a></small>'+
                                        '</p>'+
                                    '</div>';

									$('#lista_documentos').append(new_doc);

				}, 1000);
			
			} 
		}
		});
		});


    }

	function OpenDocModel(id,link,description){
		var ModalNewDoc = "";
		ModalNewDoc = `<div class="modals">
                		<div class="form-group">
						<label class="text-label">`+description+`</label>
						<embed src="`+link+`" frameborder="0" width="100%" height="400px">
						</div>

           			 </div>`
        

            $('#modalDocTitle').html('Visualizar Documento');
            $('#modalDocWhen').html(ModalNewDoc);
            $('#ModalDoc').modal();
	}

	get_lista_documentos();

	function get_lista_documentos(){

		var id_team = $('#id_clientt').val();

		$.ajax({
					url:"includes/funcionario/get_lista_documentos",
					method:"POST",
					dataType:'json',
					data:{id_team:id_team},

				success:function(response){
					var status = response.status;
					var lista_documentos = response;
					var lista_documentos_ = "";
				
				for(var a = 0; a < lista_documentos.length; a++){
					id = lista_documentos[a].id;
					id_team = lista_documentos[a].id_team;
					description = lista_documentos[a].description;
					category = lista_documentos[a].category;
					link = lista_documentos[a].link;

					lista_documentos_ += '<div id="documento_'+id+'" class="file-container">'+
					'<button class="btn btn-primary btn-sm" onclick="OpenDocModel('+id+',\''+link+'\',\''+description+'\')" type="button"><i class="icon-eye f-s-16"></i></button><spam>&nbsp;</spam>'+
											'<button class="btn btn-danger btn-sm"  onclick="RemoveDocumento('+id+',\''+description+'\')" type="button" ><i class="icon-trash f-s-17"></i></button>'+
											'<img style="margin-top:15px;" src="assets/images/icons/35.png" alt="">'+
											'<p><small><a href="'+link+'">'+description+'</a></small>'+
											'</p>'+
										'</div>';
					}
					$('#lista_documentos').html(lista_documentos_);
				}
				});
	}
	
	function RemoveDocumento(id,nome){
		information = '<div class="user-info">'+
							'<div class="image"><a class="waves-effect waves-block"></a></div>'+
							'<div class="detail">'+
								'<h5>Você deseja remover este Documento ?</h5>'+
								'<h4><strong>'+nome+'</strong></h4>'+
							'</div>'+
						'</div>';
		
		swal({
			html: information,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sim, remover!',
			cancelButtonText: 'Cancelar',
			showLoaderOnConfirm: true,
			
			preConfirm: function() {
			return new Promise(function(resolve) {
				
				$.ajax({
					url: 'includes/funcionario/delete_documento',
					type: 'POST',
					dataType:"json",
					data: {
						id : id
					}
				})
				.done(function(response){
					var json = response;
					status = json.status;
					status_txt = json.status_txt;
					//swal('Removido!', status_txt, status);
					swal.close(); 
					$('#documento_'+id).remove();
					toastr.success(status_txt, 'Sucesso');  
				
				})
				.fail(function(){
					toastr.error('Erro ao deletar!', 'Error');  
				});
			});
			},
			allowOutsideClick: false			  
		});	
	}  
		

    function altera_jornada(id){

          	var Newhora_Inicio = $("#Newhora_Inicio").val();
          	var Newhora_termino = $("#Newhora_termino").val();
          	var Newpausa_incio = $("#Newpausa_incio").val();
          	var Newpausa_final = $("#Newpausa_final").val();

             $.ajax({
                   url: 'includes/funcionario/update-jornada.php',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id, 
                   Newhora_Inicio : Newhora_Inicio,
                   Newhora_termino : Newhora_termino,
                   Newpausa_incio : Newpausa_incio,
                   Newpausa_final : Newpausa_final
                   }
             })

             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
				toastr.success(status_txt, 'Sucesso'); 
				$('#lista_dias_trabalho').html('');
				
				$('#ModalDate').modal('hide');
				setTimeout(function(){
					
					var id_funcionario = $("#id_page").val();

				$.ajax({
					url:"includes/funcionario/get_lista_jornada",
					method:"POST",
					dataType:'json',
					data:{id_funcionario:id_funcionario},

				success:function(response){
					var status = response.status;
					var lista_jornada_trabalho_update = response;
					var lista_dias_trabalho_ = "";
				
				for(var a = 0; a < lista_jornada_trabalho_update.length; a++){
					id = lista_jornada_trabalho_update[a].id;
					id_func = lista_jornada_trabalho_update[a].id_func;
					dia_semana = lista_jornada_trabalho_update[a].dia_semana;
					hora_inicio = lista_jornada_trabalho_update[a].hora_inicio;
					hora_termino = lista_jornada_trabalho_update[a].hora_termino;
					pausa_incio = lista_jornada_trabalho_update[a].pausa_incio;
					pausa_final = lista_jornada_trabalho_update[a].pausa_final;

					if (dia_semana == 0){ var dia_semana = "Domingo"}
					else if (dia_semana == 1){ var dia_semana = "Segunda-Feira"}
					else if (dia_semana == 2){ var dia_semana = "Terça-Feira"}
					else if (dia_semana == 3){ var dia_semana = "Quarta-Feira"}
					else if (dia_semana == 4){ var dia_semana = "Quinta-Feira"}
					else if (dia_semana == 5){ var dia_semana = "Sexta-Feira"}
					else if (dia_semana == 6){ var dia_semana = "Sabado"}
					else {var dia_semana = "Error"}	



					lista_dias_trabalho_ += '<tr id="jornada__id_'+id+'">'+
											'<td><span class="text-pale-sky" id="dia_semana'+id+'">'+dia_semana+'</span></td>'+
											'<td><span class="text-pale-sky" id="hora_inicio">'+hora_inicio+'</span></td>'+
											'<td><span class="text-pale-sky" id="hora_termino_'+id+'">'+hora_termino+'</span></td>'+
											'<td><span class="text-pale-sky" id="pausa_incio_'+id+'">'+pausa_incio+'</span></td>'+
											'<td><span class="text-pale-sky" id="pausa_final_'+id+'">'+pausa_final+'</span></td>'+
											'<td><button class="btn btn-primary" onclick="ModalAlteraJornada('+id+',\''+hora_inicio+'\',\''+hora_termino+'\',\''+pausa_incio+'\',\''+pausa_final+'\')" type="button"><i class="icon-pencil f-s-16"></i></button><spam>&nbsp;</spam>'+
											'<button class="btn btn-danger"  onclick="RemoveDiaJornada('+id+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
											'</tr>';
					}
					$('#lista_dias_trabalho').html(lista_dias_trabalho_);
				}
				});
			 	}, 10);
             })
             .fail(function(){
                 console.log('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             }); 

    }

</script>

<script src="includes/funcionario/get_info_funcionario.js"></script>
<?php include('includes/modal/editar-treinamento.php'); ?>
<?php include('includes/modal/editar-doc.php'); ?>
