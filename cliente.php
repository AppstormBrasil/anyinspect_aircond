
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	

	<style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
		.table-padded td {padding: 0px 5px!important;font-size:13px;}
		.dataTables_filter{display:none;}
		table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
		table.dataTable thead th, table.dataTable thead td {padding: 10px 15px;background: #f9f9f9;font-size: 12px;font-weight: 500;color: #000;}
		.dt-buttons{margin-bottom: 20px;float: right;}
		#map { width: 100%;height:200px;}
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
												<div class="progress-bar progress-img-residencia bg-success wow animated progress-animated" style="width:0%;height:2px;" role="progressbar"> 
													<span class="sr-only"></span> 
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="webcam" class="tab-pane fade">
									<form method="POST" action="./includes/controller/pet/salvaImagemCliente">
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
								<li class="nav-item"><a href="#ativos" data-toggle="tab" class="nav-link">Ativos</a></li>
								<li class="nav-item"><a href="#historico" data-toggle="tab" class="nav-link">Histórico de Atividades</a></li>
								<li class="nav-item"><a href="#financeiro" data-toggle="tab" class="nav-link">Financeiro</a></li>
								<li class="nav-item"><a href="#indicadores" data-toggle="tab" class="nav-link">Indicadores</a></li>
								
							</ul>
							<div class="tab-content" style="margin-top: 40px;">
								<div id="geral" class="tab-pane fade active show">
									<div class="pt-3">
										<h4 class="card-title">Editar Cliente</h4>
											<br>
										<div class="settings-form">
											<!--<h4 class="text-primary">Account Setting</h4>-->
											<form class="form-update-pet" action="javascript:update_client();" method="post" style="width:100%;">
											<?php $id = $_GET['id']; ?>
											<input type="hidden" id="id_page" value="<?=$id;?>" >
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Nome Responsável</label>
															<div class="input-group">
																<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome Cliente" required >
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Nome Empresa</label>
															<div class="input-group">
																<input type="text" name="nome_empresa" id="nome_empresa" class="form-control" placeholder="Nome Empresa" >
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Razão Social</label>
															<div class="input-group">
																<input type="text" name="razao_social" id="razao_social" class="form-control" placeholder="Razão Social" >
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Validade Contrato</label>
															<div class="input-group">
																<input type="text" name="validade_contrato" id="validade_contrato" class="validade_contrato form-control" placeholder="Validade Contrato" required >
															</div>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">E-mail</label>
															<div class="input-group">
																<input type="email" id="email" name="email" class="form-control" placeholder="E-mail Cliente"  >
															</div>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Whatsapp</label>
															<div class="input-group">
																<input type="text" id="telefone2" name="telefone2" class="phone form-control border-right-0" placeholder="Telefone 2">
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" > <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Telefone</label>
															<div class="input-group">
																<input type="text" name="telefone1" id="telefone1" class="phone form-control border-right-0" placeholder="Telefone 1" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
																</div>
															</div>
														</div>
													</div>
												
												</div>
												<div class="row">
												<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">CNPJ</label>
															<div class="input-group">
																<input type="text" id="cnpj" name="cnpj" class="cnpj form-control" placeholder="CNPJ" >
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">CPF</label>
															<div class="input-group">
																<input type="text" id="cpf" name="cpf" class="cpf form-control" placeholder="CPF" >
															</div>
														</div>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-lg-12">
														<h4>Endereço</h2>
													</div>
												</div>
												<div class="row">	
													<div class="col-lg-12">
														<div id="map"  tabindex="0" style="position: relative;"></div>
													</div>
													<div class="col-lg-3">
															<div class="form-group">
																<label class="text-label">Cep</label>
																<input onBlur="latclose(this.value);" type="text" name="cep" id="cep" class="zip form-control" placeholder="Cep">
															</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group">
															<label class="text-label">Endereço</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="endereco" name="endereco"  placeholder="Endereço" >
															</div>
														</div>
													</div>
												</div>
												<div class="row">	
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
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="bairro" name="bairro"  placeholder="Bairro" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" >  </span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Cidade</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="cidade" name="cidade"  placeholder="Cidade" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" >  </span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Estado</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="estado" name="estado"  placeholder="Estado" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" >  </span>
																</div>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Latitude: </label>
															<div class="input-group">
																<input type="text" name="lat" id="lat" class="form-control" placeholder=""  >
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Longitude: </label>
															<div class="input-group">
																<input type="text" name="lon" id="lon" class="form-control" placeholder=""  >
															</div>
														</div>
													</div>
												</div>
												
												<hr>
												<div class="row">
													<div class="col-lg-12">
														<h4>Configurações</h2>
													</div>
												</div>
												<!--<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Valor Frete</label>
															<div class="input-group">
																<input type="text" id="valor_frete" name="valor_frete" class="valor_frete form-control" placeholder="" >
															</div>
														</div>
													</div>
													
												</div>-->
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Observação*</label>
															<textarea type="text" id="obs" name="obs" class="form-control" ></textarea>
														</div>
													</div>
												</div>
												<input type="hidden" id="lat" name="lat" class="form-control" />
												<input type="hidden" id="lon" name="lon" class="form-control" />
												<button style="width: 100%;height: 45px;" id="save_pet" class="btn btn-primary" type="submit">Salvar</button>
											</form>
										</div>
									</div>
								</div>
								
								<div id="ativos" class="tab-pane fade">
									<div id="modal_pet"></div>
									
									<div class="row float-right">
										<a style="margin-bottom:15px;" data-toggle="modal" href="#novo-ativo" ><span style="width:100%;padding:12px;" class="label label-xl btn-primary">Cadastrar Ativo</span></a>
									</div>
									<div class="event-sideber-search">
										<form action="#" method="post" class="chat-search-form">
											<input id="search_ativos" type="text" class="form-control" placeholder="Procurar">
											<i class="fa fa-search"></i>
										</form>
									</div>

									<div class="table-responsive">
										<table id="lista_ativos" class="table table-padded market-capital table-responsive-fix-big" style="width:100%">
											<thead>
												<tr>
													<th>Id</th>
													<th>Descrição</th>
													<th>Modelo</th>
													<th>Tag</th>
													<th>Nº Série</th>
													<th>Localização</th>
													<th>Ação</th>
												</tr>
											</thead>
											<tbody>
												</tbody>
										</table>
									</div>
									<?php include('includes/modal/novo-ativo.php');?>
									<input type="file" style="display:none" id="ufile_imagem_pet" name="ufile_imagem_pet">
								</div>

								<div id="financeiro" class="tab-pane fade">
									<div class="event-sideber-search">
										<form action="#" method="post" class="chat-search-form">
											<input id="search_financeiro" type="text" class="form-control" placeholder="Procurar">
											<i class="fa fa-search"></i>
										</form>
									</div>
												
									<div class="table-responsive">
										<table class="table table-padded market-capital table-responsive-fix-big" id="financeiro_table"  style="width:100%">
											<thead>
												<tr>
													<th>Mês</th>
													<th>Valor</th>
													<th>Status</th>
													<th>Boleto</th>
													
												</tr>
											</thead>
											<tbody>
												</tbody>
										</table>
									</div>
								</div>
								
								<div id="historico" class="tab-pane fade">
									<div class="event-sideber-search">
										<form action="#" method="post" class="chat-search-form">
											<input id="search_ativos_hist" type="text" class="form-control" placeholder="Procurar">
											<i class="fa fa-search"></i>
										</form>
									</div>
												
									<div class="table-responsive">
										<table class="table table-padded market-capital table-responsive-fix-big" id="ativo_table_hist" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Id</th>
													<th>Ativo</th>
													<th>Atividade</th>
													<th>Data Atividade</th>
													<th>Iniciado</th>
													<th>Finalizado</th>
													<th>Tempo</th>
													<th>Relatório</th>
													<!--<th>Valor</th>-->
													<th>Status</th>
												</tr>
											</thead>
											<tbody >
												</tbody>
										</table>
									</div>
								</div>

								<!-- START INDICADORES -->
								<div id="indicadores" class="tab-pane fade">
									<div class="row">
										<div class="col-lg-3 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body text-center">
														<h3 class="text-white label-secondary mb-4" style="border-radius: 5px;padding: 5px;" id="total_geral">0</h3>
														<h4>Nº de Atividades </h4>
													</div>
												</div>
										</div>
										<div class="col-lg-3 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body text-center">
														<h3 class="label-warning text-white mb-4" style="border-radius: 5px;padding: 5px;" id="soma_valor_total">0</h3>
														<h4>Valor Recebido</h4>
													</div>
												</div>
										</div>
										<div class="col-lg-3 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body text-center">
														<h3 class="text-white label-secondary mb-4" style="border-radius: 5px;padding: 5px;" id="latest_visit">Nenhuma Informação</h3>
														<h4>Última Visita</h4>
													</div>
												</div>
										</div>
										<div class="col-lg-3 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body text-center">
														<h3 class="label-warning text-white mb-4" style="border-radius: 5px;padding: 5px;" id="most_service">Nenhuma Informação</h3>
														<h4>Atividade mais Realizada</h4>
													</div>
												</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-12 col-xxl-12">
												<div class="widget-music-category" >
													<div class="card-body">
														<!--<h2 class="text-warning mb-4" id="servicos_pendentes">0</h2>-->
														<h4>Quantidade de atendimento por Mês</h4>
														<div style="height:400px" id="ind_mes" ></div>
													</div>
												</div>
										</div>
										<div class="col-lg-12 col-12 col-xxl-12">
											
												<div class="widget-music-category" >
													<div class="card-body">
														<!--<h2 class="text-warning mb-4" id="servicos_pendentes">0</h2>-->
														<h4>Análise Semanal</h4>
														<div style="height:400px" id="ind_semanal" ></div>
													</div>
												</div>
										</div>
										<div class="col-lg-6 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body">
														<h2 class="text-dark mb-4" id="servicos_pendentes">0</h2>
														<h4>Tipo de Serviço</h4>
														<div style="height:400px" id="all_service" ></div>
													</div>
												</div>
										</div>
										<div class="col-lg-6 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body">
														<h2 class="text-dark mb-4" id="total_prod">0</h2>
														<h4>Produtos Gastos</h4>
														<div style="height:400px" id="all_prod" ></div>
													</div>
												</div>
										</div>
									</div>
								</div>
								<!-- END INDICADORES -->
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


    <script src="js/get_cep.js"></script>
    <script src="js/webcam.min.js"></script>
    <script src="js/highchart/highcharts.js"></script>
    <script src="js/highchart/series-label.js"></script>
    <script src="js/highchart/exporting.js"></script>
	<script src="js/highchart/data.js"></script>
	<script src="js/highchart/heatmap.js"></script>
	<script src="js/highchart/export-data.js"></script>
	<script src="js/highchart/accessibility.js"></script>
	<script src="includes/cliente/get_info_client.js"></script>
	<script src="includes/cliente/update_client.js"></script>
	<script src="includes/ativo/cadastra_ativo.js"></script>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
	<!--<script src="js/leaf/leaflet.js"></script>-->
	
<script language="JavaScript">
	
	toastr.options = {"positionClass": "toast-top-full-width"};
	Highcharts.setOptions({
		colors: ["#828282","#83c9d6","#60a9b7","#d0a37d","#464a53","#f8d999","#733f17","#935f37","#ad8a60","#cf965f","#bc6337","#d59f7b","#f2c280","#edc192","#f9d4a0","#fee3c6"]
	});

	$('.cnpj').mask('99.999.999/9999-99');

	jQuery('.validade_contrato').datetimepicker({
		timepicker: false,
		datepicker:true,
		format:'d/m/Y',
		inline:false,
		autoclose: true,
		todayButton:true,
		lang:'pt',
		step: 30,
		scrollInput: false,
		//minDate:0,
		//defaultTime:'07:00',
	});

	function get_service_hist(){
		var id = $("#id_clientt").val();

		var table_hist = $('#ativo_table_hist').DataTable({
		ajax: {
			url: 'includes/cliente/get_cliente_hist',
			dataType: 'JSON',
			data:{
				id:id
			},
			method:'POST'
		},
		"bDestroy": true,
		language: {
			"lengthMenu": "Mostrar  _MENU_ linhas registros",
			"zeroRecords": "Nenhum resultado encontrado",
			"info": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
			//"infoEmpty": "Nenhum dado disponível",
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
				"data": 'id_group',
				"width": '20px',
				"render": function (data, type, row, meta) {
					id_group = row.id_group;
					aeroporto = row.aeroporto;
					id_servico = row.id_servico;
					return '<a class="single_link" href="#detalhe-grupo-'+id_group+'" >#'+id_group+'</a>';
				}
					   
			},
			{ 
				"targets": 1 ,
				"data": 'descricao',
				"width": '25%',
					"render": function (data, type, row, meta) {
								var id_ativo = row.id_ativo;
								var img = row.foto_ativo + '?' + (new Date()).getTime();
								var descricao = row.descricao;
								var qrcode = row.qrcode;
								var ativo;

								if(descricao == null){
									ativo = 'N/A';
								} else {
									ativo = descricao + ' - ' + qrcode;
								}


								return '<a  class="single_link" href="#ativo-'+id_ativo+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+ativo+'</strong></a>';
					}		   
			},
			{ 
				"targets": 2 , 
				"data": 'short_dec',
				"width": '25%',
				"render": function (data, type, row, meta) {
				id_book = row.id_book;
				id_servico = row.id_servico;
				short_dec = row.short_dec;
				if(short_dec == 'null' || short_dec == null){
					short_dec = 'N/A';
				} else {
					var length_desc_service = row.short_dec.length;
					if(length_desc_service > 31){
						var short_dec = row.short_dec.substring(0, 28)+'...';
					} else {
						var short_dec = row.short_dec;
					}
				}
				
				return '<a class="single_link" href="#atividade-'+id_book+'-'+id_servico+'" >#'+id_book+'-'+short_dec+'</a>';
			}
				
			},
			{ 
				"targets": 3 , 
				"data": 'start_date'
				
			},
			{ 
				"targets": 4 , 
				"data": 'started_at'
				
			},
			{ 
				"targets": 5 , 
				"data": 'ended_at'
				
			},
			{ 
				"targets": 6 , 
				"data": 'hora_total_gasto'
				
			},
			{ 
			"targets": 7 , 
			"data": 'id_book',
			"render": function (data, type, row, meta) {
				id_book = parseInt(row.id_book,10);
				id_book = pad(id_book, 4);

			

				id_servico = row.id_servico;
				return '<i class="mdi mdi-file-document"></i><a class="single_link" href="#rel-atv-'+id_book+'" >Relatório</a>';
			}
			},
			
			/*{
			"targets": 8,
			"data": 'price',
			"render": function (data, type, row, meta) {
				price = row.price
				return 'R$'+price
				}
			},*/
			{ 
				"targets": 8 ,
				"data": 'status',
				"width": '5%',
				"className": "text-right",
				"render": function (data, type, row, meta) {

					status = row.status;
					if(status == 'Pendente'){
						status_type = 'label-light'
						color = 'text-dark';
					} else if(status == 'Em Andamento') {
						status_type = 'label-warning'
						color = 'text-white';
					} else if(status == 'Concluído') {
						status_type = 'label-concluido'
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
						className: 'btn btn-primary btn-xs' 
					},
					{
						extend: 'excel',
						className: 'btn btn-primary btn-xs'
					},
					{
						extend: 'pdf',
						className: 'btn btn-primary btn-xs'
					}
				],

		"deferRender": true
		});
		

		setTimeout(function(){
			$("#search_ativos_hist").on("input", function (e) {
			e.preventDefault();
			 $('#ativo_table_hist').DataTable().search($(this).val()).draw(); 
			}); 

			$('#ativo_table_hist thead th').each(function () {
				var title = $(this).text();
				if(title == 'Ação'){
				} else {
					$(this).html(title+' <input type="text" class="col-search-input" placeholder="' + title + '" />');
				}
			});

			table_hist.columns().every(function () {
				//var table = this;
				$('input', this.header()).on('keyup change', function () {
					if (table_hist.search() !== this.value) {
						table_hist.search(this.value).draw();
					}
				});
			});

			table_hist.columns().eq( 0 ).each( function ( colIdx ) {
				$('input, select', table_hist.column(colIdx).header()).on('click', function(e) {
						e.stopPropagation();
					});
			});

		}, 500);



		}

		setTimeout(function(){ 
			get_service_hist();
			/*$("#search_ativos_hist").on("input", function (e) {
			e.preventDefault();
			$('#ativo_table_hist').DataTable().search($(this).val()).draw(); 
			});*/
		}, 30);

	
	
	
	function get_payment_hist(){
		var id = $("#id_clientt").val();

		var table = $('#financeiro_table').DataTable({
		ajax: {
			url: 'includes/cliente/get_cliente_payment',
			dataType: 'JSON',
			data:{
				id:id
			},
			method:'POST'
		},
		"bDestroy": true,
		language: {
			"lengthMenu": "Mostrar  _MENU_ linhas registros",
			"zeroRecords": "Nenhum resultado encontrado",
			"info": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
			//"infoEmpty": "Nenhum dado disponível",
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
				"render": function (data, type, row, meta) {
					mes = row.mes;
					ano = row.ano;
					return mes+' '+ano;
			
				}  
			},
			{ 
				"targets": 1 , 
				"data": 'valor',
				"render": function (data, type, row, meta) {
					valor = row.valor;
					return 'R$'+valor;
			
				}
				
			},
			{ 
				"targets": 2 ,
				"data": 'status'	   
			},
			{ 
				"targets": 3 , 
				"data": 'status',
				"render": function (data, type, row, meta) {
					mes_num = row.mes_num;
					return '<i class="mdi mdi-file-document"></i><a class="single_link" href="#cliente_boleto-'+id+'-'+mes_num+'" >Visualizar</a>';
			
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
						className: 'btn btn-primary btn-xs' 
					},
					{
						extend: 'excel',
						className: 'btn btn-primary btn-xs'
					},
					{
						extend: 'pdf',
						className: 'btn btn-primary btn-xs'
					}
				],

		"deferRender": true
		});

		}
	setTimeout(function(){ 
		get_payment_hist();
		$("#search_financeiro").on("input", function (e) {
		e.preventDefault();
		//$('#financeiro_table').DataTable().search($(this).val()).draw(); 
	});
	}, 30);

	function pad(n, width, z) {
		z = z || '0';
		n = n + '';
		return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}
	
	function get_lista_ativos(){
		var id = $("#id_clientt").val();

		var table_ativo = $('#lista_ativos').DataTable({
		ajax: {
			url: 'includes/cliente/get_ativo_list',
			dataType: 'JSON',
			data:{
				id:id
			},
			method:'POST'
		},
		"bDestroy": true,
		language: {
			"lengthMenu": "Mostrar  _MENU_ linhas registros",
			"zeroRecords": "Nenhum resultado encontrado",
			"info": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
			//"infoEmpty": "Nenhum dado disponível",
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
				"data": 'id_ativo',
			},
			{ 
				"targets": 1 ,
				"data": 'descricao',
					"render": function (data, type, row, meta) {
								var img = row.foto_ativo + '?' + (new Date()).getTime();
								return '<a  class="single_link" href="#ativo-'+row.id_ativo+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.descricao+'</a>';
					}		   
			},
			{ 
				"targets": 2 ,
				"data": 'model'	   
			},
			{ 
				"targets": 3 ,
				"data": 'qrcode'	   
			},
			{ 
				"targets": 4 ,
				"data": 'register'	   
			},
			{ 
				"targets": 5 ,
				"data": 'descricao_local'	   
			},
			{ 
				"targets": 6 , 
				"data": 'status',
				"render": function (data, type, row, meta) {
					var img = row.foto_ativo + '?' + (new Date()).getTime();
					return '<a  href="#ativo-'+row.id_ativo+'" class="single_link btn btn-light" id="'+row.id_ativo+'" ><i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger" onclick="RemoveItem('+row.id_ativo+',\''+row.descricao+'\',\''+img+'\')" id="'+row.id_ativo+'" type="button"><i class="icon-trash f-s-16"></i></button>';
			
				}
				
			},

			{ "orderable": false, "targets": 1 },
		],
		"createdRow": function( row, data, dataIndex ) {
			$(row).addClass( 'row_ativo_'+data.id_ativo );
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
						className: 'btn btn-light btn-xs' 
					},
					{
						extend: 'excel',
						className: 'btn btn-primary btn-xs'
					},
					{
						extend: 'pdf',
						className: 'btn btn-primary btn-xs'
					}
				],

		"deferRender": true
		});

		}
	setTimeout(function(){ 
		get_lista_ativos();
		$("#search_ativos").on("input", function (e) {
		e.preventDefault();
		$('#lista_ativos').DataTable().search($(this).val()).draw(); 
	});
	}, 30);

	function get_indicadores(){
	var id = $("#id_clientt").val();
	data_count = 0;
	data_valor = 0;
	soma_valor_total = 0;
	total_geral = 0;
	latest_visit = 0;
	most_service = 0;
	total_prod = 0;
	$.ajax({
				type: 'POST',
				url: 'includes/cliente/get_cliente_indicador',
				data:{id:id},
				dataType: 'json',
				success: function (result) { 
					data_count = result.data_count;
					data_valor = result.data_valor;
					soma_valor_total = result.soma_valor_total;
					total_geral = result.total_geral;
					latest_visit = result.latest_visit;
					most_service = result.most_service;
					week_val = result.week_val;
					total_servico_prev = result.total_servico_prev;
					total_prod = result.total_produto_prev
					if(soma_valor_total){
						$('#soma_valor_total').html('R$'+soma_valor_total);
						$('#total_prod').html('R$'+total_prod);
					} else {
						$('#soma_valor_total').html('R$0,00');
						$('#total_prod').html('R$0,00');
					}
					
					$('#total_geral').html(total_geral);
					$('#latest_visit').html(latest_visit);
					$('#most_service').html(most_service);
					$('#servicos_pendentes').html(total_servico_prev);
					
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
								color: '#828282'
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
							color: "#828282"
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
								return '<b>' + getPointCategoryName(this.point, 'x') + '</b> <br><b>' +
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
								//height: 100 + '%'	

							},
							title: {
								text: ''
							},
							tooltip: {
								//pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                pointFormat: '{series.name}: <b>{point.y}</b>'
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
									/*dataLabels: {
										enabled: true
									}, */
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.y}'
                                    },
									showInLegend: true
								},
								series: {
									events: {
										click: function (event) {
											
										}
									}
								}
							},
							series: [{
								name: "Quantidade por Serviço",
								data: result.servicos_total
							}]					
					});
					// ALL PRODUCTS 
					// LAST MONTH PRODUTOS VALOR
                    Highcharts.chart('all_prod', {
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
								pointFormat: '{series.name}: <b>R${point.y}</b>',
								
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>:R${point.y}'
                                    },
									showInLegend: true
								},
								series: {
									
								}
							},
							series: [{
								name: "Produto",
								data: result.produto_total_prev
							}]					
					});
					}, 300);

				},
				error: function (result) {
					toastr.error('Erro ao realizar o download dos dados, atualize a página.', 'Erro de download');
				}
			}); 


 }

 get_indicadores();

	
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
	  url:"includes/cliente/upload_pic_client.php",
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
				toastr.success('Imagem atualizado com sucesso', 'Sucesso');
			 }, 200);
		
		}
	  }
	});
	});
		
	
	$( "#web_btn" ).click(function() {
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
		console.log("Sem webcam");
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
				url:"includes/view/pet/take_pic_client.php",
				dataType:'JSON',
				data: {base64:image,id:id},
				type:"POST",
				error:function(err){
					console.error(err);
				},
				success:function(data){
					console.log(data);
				},
				complete:function(){
					console.log("Request finished.");
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
				url:"includes/view/pet/take_pic_client.php",
				dataType:'JSON',
				data: {base64:image,id:id},// Add as Data the Previously create formData
				type:"POST",
				error:function(err){
					console.error(err);
				},
				success:function(data){
					console.log(data);
				},
				complete:function(){
					console.log("Request finished.");
				}
			});
			});	
    	}
	
	}


	  function get_lista_cat(){
		$.ajax({
		url:"includes/ativo/get_cat_ativo",
		dataType:'JSON',
		method:"GET",
		data:{id:0},
			success:function(response){
				var option = '<option disabled selected value="none"></option>'
				var i;
				for (i = 0; i < response.length; i++) {
					option += '<option value="'+response[i].id+'">'+response[i].description+'</option>';
							
				}
				$('#category_ativo').html(option);	
				$('#category_ativo').select2();
			}
		}); 

	}
	get_lista_cat();

	function RemoveItem(id,nome,imagem){
	var id_service = $('#id_clientt').val();
    information = '<div class="user-info">'+
                        '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja remover este ítem ?</h5>'+
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
                   url: 'includes/ativo/delete_ativo',
                   type: 'POST',
                   dataType:"json",
                   data: {
					id : id,
                }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
				swal.close(); 
				console.log(id)
				$('#row_ativo_'+ id).remove();
				var table_ativo = $('#lista_ativos').DataTable();
				table_ativo.ajax.reload();
			   
				toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Erro ao deletar!', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}  

function go_to_page(id){
      window.location.href = "ativo-"+id+" ";
}

function latclose(conteudo){

      logradouro = $('#endereco').val();
      bairro = $('#bairro').val();
      localidade =  $('#cidade').val();
      uf = $('#estado').val();
      num = conteudo;

      ad_final = logradouro+','+num+','+bairro+','+localidade+','+uf;
      ad_final = removeAcento(ad_final);

      console.log(ad_final)
      
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://locationiq.org/v1/search.php?key=5073c64ffbe054&q="+ad_final+"&format=json",
        "method": "GET"
      }

      $.ajax(settings).done(function (response) {

        if(response.error){
          console.log(response);
        } else {
          var lat = response[0].lat
          var lon = response[0].lon
          $('#lat').val(lat);
          $('#lon').val(lon);

          lat = parseFloat(lat);
          lon = parseFloat(lon);
          plot_map(lat,lon,ad_final);

        }
          
      });
}

var map;
function plot_map(lat,lon,ad_final){

	console.log(lat);

	console.log(lon);
    
    var desc_box = '<div style="text-align:center;"><h4>Endereço</h4><p>'+ad_final+'</p></div>';

    if(map == undefined){
        
		const cities = L.layerGroup();

		const mLittleton = L.marker([lat, lon]).bindPopup(desc_box).addTo(cities);
		const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		});

		const osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
		});

		const map = L.map('map', {
			center: [lat, lon],
			zoom: 17,
			layers: [osm, cities]
		});

		const baseLayers = {
			'OpenStreetMap': osm,
			'OpenStreetMap.HOT': osmHOT
		};

		const overlays = {
			'Cities': cities
		};
		
		
		/*var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var streets   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
         grayscale  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

        map = L.map('map', {
            center: [lat, lon],
            zoom: 15,
            layers: [grayscale, cities]
        });

        L.marker([lat, lon]).bindPopup(desc_box).addTo(cities)
        

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets
        };

        var overlays = {
            "Cidade": cities
        };

        L.control.layers(baseLayers, overlays).addTo(map); */
    
    
    } else {
        map.off();
        map.remove();
		

        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});


        map = L.map('map', {
            center: [lat, lon],
            zoom: 15,
            layers: [grayscale, cities]
        });
    
        L.marker([lat, lon]).bindPopup(desc_box).addTo(cities)
        

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets
        };

        var overlays = {
            "Cidade": cities
        };
    
        L.control.layers(baseLayers, overlays).addTo(map);
    
    }  
   


}	
</script>
