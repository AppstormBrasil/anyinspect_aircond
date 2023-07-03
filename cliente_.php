<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
   <link href="css/style-full.css" rel="stylesheet">
   <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
		.dataTables_filter{display:none;}
		table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
		table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;}
		.dt-buttons{margin-bottom: 20px;float: right;}
		.btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;}
    </style>
</head>
<body>
   <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
	<div id="main-wrapper">
         <?php include('includes/common/nav-header.php'); ?>
        <?php include('includes/common/header.php'); ?>
        <?php include('includes/common/sidebar.php'); ?>
        <div class="content-body">
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
                                            <!--<li class="nav-item"><a href="#pets" data-toggle="tab" class="nav-link">Pets</a></li>-->
											<li class="nav-item"><a href="#historico" data-toggle="tab" class="nav-link">Histórico de Serviços</a></li>
											<li class="nav-item"><a href="#pacotes" data-toggle="tab" class="nav-link">Pacotes</a></li>
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
																<div class="col-lg-5">
																	<div class="form-group">
																		<label class="text-label">Nome Cliente</label>
																		<div class="input-group">
																			<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome Cliente" required >
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<label class="text-label">Instagram</label>
																		<div class="input-group">
																			<input type="text" name="insta_cliente" id="insta_cliente" class="form-control" placeholder="Instagram Cliente" >
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<label class="text-label">Sexo</label>
																		<div class="input-group">
																			<select id="sexo" name="sexo" style="width: 100%;height:45px;border: 1px solid #dddfe1;"  >
																				<option disabled selected value="none">Selecione o sexo</option>
																				<option value="m">Masculino</option>
																				<option value="f">Feminino</option>
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
																			<input type="email" id="email" name="email" class="form-control" placeholder="E-mail Cliente"  >
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
																		<label class="text-label">Whatsapp</label>
																		<div class="input-group">
																			<input type="text" id="telefone2" name="telefone2" class="phone form-control border-right-0" placeholder="Telefone 2">
																			<div class="input-group-append">
																				<span class="input-group-text bg-transparent" > <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
																			</div>
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
															</div>
															<hr>
															<div class="row">
																<div class="col-lg-12">
																	<h4>Documentos</h2>
																</div>
															</div>
															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<label class="text-label">CPF</label>
																		<div class="input-group">
																			<input type="text" id="cpf" name="cpf" class="cpf form-control" placeholder="CPF" >
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<label class="text-label">RG</label>
																		<div class="input-group">
																			<input type="text" id="rg" name="rg" class="rg form-control" placeholder="RG" >
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<label class="text-label">Data de Nascimento</label>
																		<input type="text" id="data_nascimento" name="data_nascimento" class="data form-control" placeholder="Data Nascimento" >
																	</div>
																</div>
															</div>
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
                                            <div id="pets" class="tab-pane fade">
												<div id="modal_pet"></div>
												<input type="hidden" id="numero_pets" value="0">
												<div class="row float-right">
												<a style="margin-bottom:15px;" data-toggle="modal" href="#novo-pet" ><span style="width:100%;padding:12px;" class="label label-xl btn-primary">Adcicionar Pet</span></a>
												</div>

                                                <div class="table-responsive">
                                                    <table class="table table-padded recent-order-list-table table-responsive-fix-big">
                                                        <thead>
                                                            <tr>
                                                                <th>Nome</th>
                                                                <th>Raça</th>
                                                                <th>Gênero</th>
                                                                <th>Porte</th>
																<th>Compr. Corte</th>
																<th>Comportamento</th>
                                                                <th>Data de Nascimento</th>
																<th>Observação</th>
																<th>Ação</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="lista_pets" >
                                                         </tbody>
                                                    </table>
                                                </div>
												<?php include('includes/modal/novo-pet.php');?>
                                                <input type="file" style="display:none" id="ufile_imagem_pet" name="ufile_imagem_pet">
                                            </div>

											<div id="historico" class="tab-pane fade">
												<div class="event-sideber-search">
													<form action="#" method="post" class="chat-search-form">
														<input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
														<i class="fa fa-search"></i>
													</form>
												</div>
															
                                                <div class="table-responsive">
													<table class="table table-padded market-capital table-responsive-fix-big" id="cliente_table" name="cliente_table" class="display" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Nome Cliente</th>
                                                                <th>Serviço</th>
                                                                <th>Início</th>
                                                                <th>Fim</th>
																<th>Valor</th>
																<th>Status</th>
																<th>Status Pagamento</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody >
                                                         </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!--PACOTES-->

                                            <div id="pacotes" class="tab-pane fade">
												<form class="form-config-func" action="" method="post" style="width:100%;">
                                                        <?php $id = $_GET['id']; ?>
                                                           <div class="row">
																<div class="col-lg-8">
																	<div class="form-group">
																		<label class="text-label">Selecione um Pacote</label>
																		<div class="input-group">
																			<select id="pacote" name="type" style="width: 100%;height:46px;border: 1px solid #dddfe1;">
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="input-group"> 
																		<button style="width: 100%;height:46px; margin-top: 29px " id="save-pacote" class="btn btn-primary" type="button"  onclick="comprarPacote()">Adicionar Pacote</button>		
																	</div>
																</div>
															</div>
													</form> 										
													<div class="table-responsive">
                                                    	<table class="table table-padded recent-order-list-table table-responsive-fix-big">
                                                        <thead>
                                                            <tr>
                                                                <th>Nome do pacote</th>
                                                                <th>Serviço</th>
																<th>Valor</th>
																<th>Qtd</th>
																<th>Data Compra</th>
																<th>Data Vencimento</th>
																<th>Ação</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="lista_pacote" >
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
																	<h3 class="text-white label-dark mb-4" style="border-radius: 5px;padding: 5px;" id="total_geral">0</h3>
																	<h4>Nº de Atendimentos </h4>
																</div>
															</div>
													</div>
													<div class="col-lg-3 col-6 col-xxl-3">
															<div class="widget-music-category" >
																<div class="card-body text-center">
																	<h3 class="label-warning text-white mb-4" style="border-radius: 5px;padding: 5px;" id="soma_valor_total">0</h3>
																	<h4>Valor Investido</h4>
																</div>
															</div>
													</div>
													<div class="col-lg-3 col-6 col-xxl-3">
															<div class="widget-music-category" >
																<div class="card-body text-center">
																	<h3 class="text-white label-dark mb-4" style="border-radius: 5px;padding: 5px;" id="latest_visit">Nenhuma Informação</h3>
																	<h4>Última Visita</h4>
																</div>
															</div>
													</div>
													<div class="col-lg-3 col-6 col-xxl-3">
															<div class="widget-music-category" >
																<div class="card-body text-center">
																	<h3 class="label-warning text-white mb-4" style="border-radius: 5px;padding: 5px;" id="most_service">Nenhuma Informação</h3>
																	<h4>Serviço mais Utilizado</h4>
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
            <!-- #/ container -->
        </div>
        <?php include('includes/common/footer.php'); ?>
        <?php //include('includes/common/right-sidebar.php'); ?>
    </div>
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/pt-br.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/innoto-switchery/dist/switchery.min.js"></script>
	<script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/get_cep.js"></script>
    <script src="js/webcam.min.js"></script>
	<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script> 
    <script src="assets/plugins/tables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/tables/buttons.flash.min.js"></script>
    <script src="assets/plugins/tables/jszip.min.js"></script>
    <script src="assets/plugins/tables/pdfmake.min.js"></script>
    <script src="assets/plugins/tables/vfs_fonts.js"></script>
    <script src="assets/plugins/tables/buttons.html5.min.js"></script>
    <script src="assets/plugins/tables/buttons.print.min.js"></script>
    <script src="js/highchart/highcharts.js"></script>
    <script src="js/highchart/series-label.js"></script>
    <script src="js/highchart/exporting.js"></script>
	<script src="js/highchart/data.js"></script>
	<script src="js/highchart/heatmap.js"></script>
	<script src="js/highchart/export-data.js"></script>
	<script src="js/highchart/accessibility.js"></script>
	<script src="includes/cliente/get_info_client.js"></script>
	<script src="includes/cliente/update_client.js"></script>

	
<script language="JavaScript">

	Highcharts.setOptions({
		colors: ["#828282","#e69fb0","#9e3b5d","#d0a37d","#464a53","#f8d999","#733f17","#935f37","#ad8a60","#cf965f","#bc6337","#d59f7b","#f2c280","#edc192","#f9d4a0","#fee3c6"]
	});

	function get_service_hist(){
		var id = $("#id_clientt").val();
		var table = $('#cliente_table').DataTable({
		ajax: {
			url: 'includes/cliente/get_cliente_hist',
			dataType: 'JSON',
			data:{
				id:id
			},
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
								return '<a  href="cliente-'+row.id+'" target="_blank"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_cliente+'</a>';
					}		   
			},
			{ 
				"targets": 1 , 
				"data": 'short_dec'
				
			},
			{ 
				"targets": 2 , 
				"data": 'started_at'
				
			},
			{ 
				"targets": 3 , 
				"data": 'ended_at'
				
			},
						
			{
			"targets": 4,
			"data": 'price',
			"render": function (data, type, row, meta) {
				price = row.price
				return 'R$'+price
			
			}
			},
			{ 
				"targets": 5 ,
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
					} else if(status == 'Cancelado') {
						status_type = 'label-cancel'
						color = 'text-white';
					} else {
						status_type = 'label-success'
						color = 'text-white';
					}
						return '<span class=" '+color+' label label label-rounded '+status_type+'">'+status+'</span>';
				}		   
			},
			{ 
				"targets": 6 , 
				"data": 'status_pagamento',
				"className": "text-right",
				
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
		get_service_hist();
		$("#search_clientes").on("input", function (e) {
		e.preventDefault();
		$('#cliente_table').DataTable().search($(this).val()).draw(); 
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
						credits: {
                            enabled: false
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
						credits: {
                            enabled: false
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
								return '<b>' + getPointCategoryName(this.point, 'x') + '</b> sold <br><b>' +
									this.point.value + '</b> Serviços on <br><b>' + getPointCategoryName(this.point, 'y') + '</b>';
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
							credits: {
								enabled: false
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
							credits: {
								enabled: false
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
					//toastr.error('Erro ao realizar o download dos dados, atualize a página.', 'Erro de download');
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
		status_txt = data.status_txt;
		id_pic = data.id_pic;

		if (status == 'SUCCESS') {
			toastr.success('Sucesso!', status_txt); 
			setTimeout(function(){
				$('#status_img').fadeOut();
				$('progress').fadeOut();
			 }, 4000);
		
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

function RemoveServicoPacote(id_cliente,id_package){

information = '<div class="user-info">'+
				  '<h5>Você deseja realmente remover esse  pacote?</h5>'+
			  '</div></div>';   
console.log(id_cliente);
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
			 url: 'includes/pacotes/delete_pacote_cliente.php',
			 type: 'POST',
			 dataType:"json",
			 data: {
			 id_package : id_package,
			 id_cliente : id_cliente
			 }
	   })
	   .done(function(response){
		  var json = response;
		  status = json.status;
		  status_txt = json.status_txt;
		  $('#pacote_'+id_cliente).remove();
		  swal.close(); 
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


	/*  function get_lista_breed(){
		$.ajax({
		url:"includes/pet/get_breeds",
		dataType:'JSON',
		method:"GET",
		data:{id:0},
			success:function(response){
				var option = '<option disabled selected value="none"></option>'
				var i;
				for (i = 0; i < response.length; i++) {
					option += '<option value="'+response[i].id+'">'+response[i].breed+'</option>';
							
				}
				$('#raca_novo_pet').html(option);	
			}
		}); 

	}
	get_lista_breed();
	  
	  
	  $('#sexo_novo_pet').select2();
	  $('#porte_novo_pet').select2();
	  $('#hair_novo_pet').select2();
	  $('#corte_novo_pet').select2();
	  $('#mood_novo_pet').select2();
	  $('#raca_novo_pet').select2();
	  
	  $('#corte_novo_pet').select2({
        ajax: {
          url: 'includes/view/pet/get_cuts',
          type : 'json',
          delay: 2,
          processResults: function (data) {
			      return {results: data};
			    },
			    cache: true
			  },
		  templateResult: function(data) {
			return data.cut;
		  },
		  templateSelection: function(data) {
			return data.cut;
		  },
      }); */



//PACOTE


	  $('#pacote').select2({
        ajax: {
          url: 'includes/pacotes/get_select_pacotes.php',
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
                        o.nome = v.nome;
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
			markup = 'Nenhum Pacote Cadastrado';
			
		} else {
			var markup = '<span>' + data.nome +' </span>';
		}
		return markup;
	}





	function comprarPacote(){
		var id_pacote = $("#pacote").val();
		var id_cliente = $("#id_clientt").val();

		$.ajax({
         url: "includes/pacotes/cadastra_pacote_cliente.php", 
         type: 'POST',
         dataType:"json", 
         data: {
            id_pacote : id_pacote,
            id_cliente : id_cliente

         },
         	success: function(response){
				status = response.status; 
				status_txt = response.status_txt;
					if(status == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						setTimeout(function(){
							location.reload();
						}, 300); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
			error:function(response){
				console.log(response);
			}
		});	
		
	}


	lista_servico_cliente();

    function lista_servico_cliente(){

    	var id_cliente = $("#id_clientt").val();

		$.ajax({
     		url:"includes/pacotes/get_list_servico_cliente.php",
	 		method:"POST",
	 		dataType:'json',
	 		data:{id_cliente:id_cliente},

	 	success:function(response){
			var status = response.status;
			var lista_package = response;

		
		for(var a = 0; a < lista_package.length; a++){
			id = lista_package[a].id;
			id_package = lista_package[a].id_package;
			id_service = lista_package[a].id_service;
			status = lista_package[a].status;
			short_dec = lista_package[a].short_dec;
			nome = lista_package[a].nome;
			total = lista_package[a].total_;
			data_compra = lista_package[a].data_compra;
			valor = lista_package[a].valor;
			data_vencimento = lista_package[a].data_vencimento;

			lista_pacote += '<tr id="row_id_'+id+'">'+
									'<td><span class="text-pale-sky" id="pacote_'+id+'">'+nome+'</span></td>'+
									'<td><span class="text-pale-sky" id="servico_">'+short_dec+'</span></td>'+
									'<td><span class="text-pale-sky" >'+valor+'</span></td>'+
									'<td><span class="text-pale-sky" >'+total+'</span></td>'+
									'<td><span class="text-pale-sky" >'+data_compra+'</span></td>'+
									'<td><span class="text-pale-sky" >'+data_vencimento+'</span></td>'+
									'<td><button class="btn-xs btn btn-danger" onclick="RemoveServicoPacote('+id+' , '+id_package+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
									'</tr>';
			}
      		$('#lista_pacote').html(lista_pacote);

    	}

    	});

    }



</script>
</body>
</html>