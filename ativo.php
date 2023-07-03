<?php 

include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '403';</script>";
		exit(0);
	}
	
?>	

<style>
	#results { padding:20px; border:1px solid; background:#ccc; }
	.table-padded td {padding: 2px 5px!important;font-size:13px;}
	.dataTables_filter{display:none;}
	table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
	.dt-buttons{margin-bottom: 20px;float: right;}
	#map { width: 100%;height: 100%;box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);}
	table.dataTable tbody tr.odd{background: #f9f9f9!important;}
	@media print {
		#qr_frame{
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 10px;
			text-align:center;
			border:1px solid gray;
		}
		
		#qr_frame p{
		    font-size:11px;
		    padding:0px;
		}
	}	
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs">
								<li class="nav-item"><a id="geral_" href="#geral" data-toggle="tab" class="nav-link active show">Geral</a></li>
								<li class="nav-item"><a href="#historic" data-toggle="tab" class="nav-link">Histórico de Atividades</a></li>
								<li class="nav-item"><a href="#indicadores" data-toggle="tab" class="nav-link">Indicadores</a></li>
								<li class="nav-item"><a href="#identificador" data-toggle="tab" class="nav-link">QRCode</a></li>
							</ul>
							<div class="tab-content" style="margin-top:5px;">
								<div id="geral" class="tab-pane fade active show">
									<div class="pt-3">
										<?php $id = $_GET['id']; ?>
										<div class="settings-form">
											<form id="form-pet" action="javascript:update_ativo(<?php echo $id ?>);" method="post" style="width:100%;">
											<div class="row">
											
											<div class="col-lg-4">
														<a style="cursor:pointer;" id="carregar_imagem_ativo" >
															<img style="box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);"  id="image_client"  src="images/noimage.jpg" alt="" class="img-fluid">
														</a>
														<input type="file" style="display:none;" id="ufile" name="ufile">
														<?php $id = $_GET['id']; ?>
														<input type="hidden" id="id_ativo" name="id_ativo" value="<?php echo $id ?>" />
														<input type="hidden" id="id_client" name="id_client" />
														
													<span id="status_img"></span>
													<div class="progress-bar progress bg-success wow animated progress-animated" style="width:0%;height:2px;" role="progressbar"> 
														<span class="sr-only"></span> 
													</div>
												</div>
									
												<div class="col-lg-8">
													<div id="map"  tabindex="0" style="position: relative;"></div>
												</div>
												<div class="col-lg-12" style="margin-top: 25px;"></div>

												<div class="col-lg-12" >
													<div class="form-group">
														<label class="text-label">Empresa</label>
														<div class="input-group">
															<input disabled type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="">
														</div>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group">
														<label class="text-label">Atividade</label>
														<div class="input-group">
															<select style="width: 100%;height:50px;border: 1px solid #dddfe1;" id="my_Services" name="my_Services" required></select>
															<!--<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="my_Services" name="my_Services" required></select>-->
														</div>
													</div>
												</div>
												
												<div class="col-lg-12" >
													<div class="form-group">
														<label class="text-label">Descrição<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="descricao" name="descricao" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Condensador 1<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="cond1" name="cond1" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Modelo Condensadora 1<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="modelo_cond1" name="modelo_cond1" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Nº Série Condensadora 1 <span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="nserie_cond1" name="nserie_cond1" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Condensador 2<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="cond2" name="cond2" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Modelo Condensadora 2<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="modelo_cond2" name="modelo_cond2" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Nº Série Condensadora 2 <span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="nserie_cond2" name="nserie_cond2" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Condensador 3<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="cond3" name="cond3" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Modelo Condensadora 3<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="modelo_cond3" name="modelo_cond3" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Nº Série Condensadora 3 <span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="nserie_cond3" name="nserie_cond3" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">PN TOPO ?</label>
															<div class="input-group">
																<input class="form-check-input styled-checkbox" id="type_pai" type="checkbox" name="type_pai" value="sim">
																<label for="type_pai" class="form-check-label check-green ">Sim</label>
															</div>
														</div>
													</div>
												<div class="col-lg-10">
													<div class="form-group">
														<label class="text-label">Escolha o pn topo</label>
														<div class="input-group">
															<select id="list_pai" name="list_pai" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
																<option disabled selected value="none">Selecione o tipo</option>
																
															</select>
														</div>
													</div>
												</div>
													
												<!--<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Responsável </label>
														<div class="input-group">
															<div class="input-group">
																<select style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="responsavel" name="responsavel" ></select>
															</div>
														</div>
													</div>
												</div>-->
												<div class="col-lg-3" >
													<div class="form-group">
														<label class="text-label">Validade</label>
														<div class="input-group">
															<input type="text" class="data form-control date_picker" id="validade" name="validade" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Serial Number </label>
														<div class="input-group">
															<div class="input-group">
															<input type="text" class=" form-control" id="sn" name="sn" placeholder="" >
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Modelo Evaporadora </label>
														<div class="input-group">
															<input type="text" class="form-control" id="model" name="model" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Registro </label>
														<div class="input-group">
															<input type="text" class="form-control" id="register" name="register" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Fabricante </label>
														<div class="input-group">
															<input type="text" class="form-control" id="fabricante" name="fabricante" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Capacidade </label>
														<div class="input-group">
															<input type="text" class="form-control" id="capacidade" name="capacidade" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Tipo </label>
														<div class="input-group">
															<select class="form-control" style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="tipo" name="tipo" >
																<option value="">Escolher Tipo</option>
																<option value="CA - Cortina de Ar">CA - Cortina de Ar</option>
																<option value="T - Torre">T - Torre</option>
																<option value="SA - Split Ambiente">SA - Split Ambiente</option>
																<option value="SD- Split Dutado">SD- Split Dutado</option>
																<option value="CM - Central MultiSplit">CM - Central MultiSplit</option>
																<option value="CS - Central Self Contained">CS - Central Self Contained</option>
																<option value="CAG.AR - Chiller c/ Condensação a Ar">CAG.AR - Chiller c/ Condensação a Ar</option>
																<option value="CAG.AG - Chiller c/ Condensação a Água">CAG.AG - Chiller c/ Condensação a Água</option>
																<option value="BAG - Bomba de Água Gelada">BAG - Bomba de Água Gelada</option>
																<option value="BAC - Bomba de Água de Condensação">BAC - Bomba de Água de Condensação</option>
																<option value="ACJ - Ar Condicionado tipo Janela">ACJ - Ar Condicionado tipo Janela</option>
															
															</select>
														</div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Categoria </label>
														<div class="input-group">
															<select class="form-control" style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="category" name="category" ></select>
														</div>
													</div>
												</div>

												<div class="col-lg-12">
													<div class="form-group">
														<label class="text-label">Local 
														<a class="single_link" style="margin-bottom:15px;float:right;margin-left: 10px;"  href="lista-localizacao"><span style="width:100%;padding:12px;" class="label label-xl btn-secondary btn-xs">Lista Localização</span></a>
														<a style="margin-bottom:15px;float:right;margin-left: 10px;" class="new_local"><span style="width:100%;padding:12px;" class="label label-xl btn-primary btn-xs">Nova Localização</span></a>
														
														</label>
														<select class="form-control" style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="local" name="local" ></select>
													</div>
												</div>

												<!--<div class="col-lg-6">
													<div class="form-group">
														<label class="text-label">Latitude </label>
														<div class="input-group">
															<input type="text" class="form-control" id="lat" name="lat" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="text-label">Longitude </label>
														<div class="input-group">
															<input type="text" class="form-control" id="lon" name="lon" placeholder="" >
														</div>
													</div>
												</div>-->
												
												
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Observação</label>
															<textarea type="text" id="obs" name="obs" class="form-control" placeholder="Observação"></textarea>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-success">Salvar</button>
												</div>
											</div>	
										</form>
										
									</div>
								</div>
								<div id="historic" class="tab-pane fade">
								<div class="event-sideber-search">
									<form action="#" method="post" class="chat-search-form">
										<input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
										<i class="fa fa-search"></i>
									</form>
								</div>		
									<div class="table-responsive">
										<table class="table table-padded market-capital table-responsive-fix-big" id="lista_atividades" name="lista_atividades" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Id</th>
													<th>Aeronave</th>
													<th>Atividades</th>
													<th>Data</th>
													<th>Iniciado</th>
													<th>Finalizado</th>
													<th>Tempo</th>
													<th>Valor</th>
													<th>Relatório</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody >
												</tbody>
										</table>
									</div>
								</div>
								<div id="indicadores" class="tab-pane fade">
									<div class="row">
										<div class="col-lg-3 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body text-center">
														<h3 class="text-white label-secondary mb-4" style="border-radius: 5px;padding: 5px;" id="total_geral">0</h3>
														<h4>Nº de Atendimentos </h4>
													</div>
												</div>
										</div>
										<div class="col-lg-3 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body text-center">
														<h3 class="label-warning text-white mb-4" style="border-radius: 5px;padding: 5px;" id="soma_valor_total">0</h3>
														<h4>Valor</h4>
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
														<h4>Atividades mais Executada</h4>
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
										<div class="col-lg-6 col-6 col-xxl-3">
												<div class="widget-music-category" >
													<div class="card-body">
														<h2 class="text-dark mb-4" id="servicos_pendentes">0</h2>
														<h4>Tipo de Atividade</h4>
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

								<div id="identificador" class="tab-pane fade ">
									<div class="pt-3">
									
									
												
									<div class="col-lg-6" >
										<div class="form-group">
											<label class="text-label">Descrição<span style="color:red;">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" id="qrcode" name="qrcode" placeholder="" required>
												<button style="margin-left: 10px;margin-right: 10px;"type="button" id="update_tag" name="update_tag" class="btn btn-success">Salvar</button>
												<button type="button" id="print_qr" name="print_qr" class="btn btn-secondary">Print</button>
											</div>

										
										</div>
										<div id="qr_frame" >
											<div id="qrcodeimg" style="float: left;margin-right: 10px;height: 250px;"></div>
											<div>
											    <p class="qr_txt_tag">Tag</p>
    											<p id="qr_nome_empresa"></p>
    											<p id="qr_local"></p>
    											<p id="qr_model"></p>
    											<p id="qr_sn"></p>
    											<p id="qr_capacidade"></p>
												<p id="qr_model_cond_1"></p>
												<p id="qr_sn_cond_1"></p>
												<p id="qr_tecnoair"></p>
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
		</div>
	</div>
</div>
            <!-- #/ container -->

		<?php include('includes/modal/novo-local.php'); ?>


  
    <script src="js/styleSwitcher.js"></script>
    <script src="js/qrcode.min.js"></script>
	<script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/innoto-switchery/dist/switchery.min.js"></script>
  

    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="includes/ativo/update_ativo_single.js"></script>
    <script src="js/highchart/highcharts.js"></script>
    <script src="js/highchart/series-label.js"></script>
    <script src="js/highchart/exporting.js"></script>
	<script src="js/highchart/data.js"></script>
	<script src="js/highchart/heatmap.js"></script>
	<script src="js/highchart/export-data.js"></script>
	<script src="js/highchart/accessibility.js"></script>
	<script src="js/webcam.min.js"></script>
	<script src="js/leaf/leaflet.js"></script>

	<!--<script src="includes/local/cadastro_local.js"></script>-->
	
		
<script >

toastr.options = {"positionClass": "toast-top-full-width"};

id_team = 0;


function serv(){
		var all_ativos = $('#my_Services');

	$.ajax({
		type: 'POST',
		dataType : 'JSON',
		url: 'includes/dashboard/get_services?id_team='+id_team+' ',
	}).then(function (data) {
		new_list_ativos = ''
		for (i = 0; i < data.length; i++) {
			new_list_ativos += '<option value="'+data[i].id+'">'+data[i].short_dec+'</option>';
		
		}
		$('#my_Services').html(new_list_ativos);
		
	});
	
}

	

$('.new_local').on('click', function(e){ 
        e.preventDefault();
        $('#nova-localizacao').modal();
});

var qrcode = new QRCode("qrcodeimg", {
	text: 'Anyinspect',
	width: 128,
	height: 128,
	colorDark : "#000000",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H
});

get_lista_tipo_pai()

$.datetimepicker.setLocale('pt');
jQuery('.date_picker').datetimepicker({
	timepicker: false,
	datepicker:true,
	format:'d/m/Y',
	inline:false,
	autoclose: true,
	todayButton:true,
	lang:'pt',
	step: 30,
	scrollInput: false,
	minDate:0,
	//defaultTime:'07:00',
});

function get_service_hist(){
		var id = $("#id_ativo").val();

		var table = $('#lista_atividades').DataTable({
		ajax: {
			url: 'includes/ativo/get_ativo_hist',
			data:{
				id:id
			},
			dataType:'JSON',
			method:'POST'
		},
		"bDestroy": true,
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
				"data": 'id_booking',
				"render": function (data, type, row, meta) {
								
								return row.id_booking;
					}	
				
			},
			{ 
				"targets": 1 ,
				"data": 'descricao',
					"render": function (data, type, row, meta) {
								var img = row.foto_ativo + '?' + (new Date()).getTime();
								return '<a class="single_link" href="ativo-'+row.id_ativo+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.descricao+'</a>';
					}		   
			},
			{ 
				"targets": 2 , 
				"data": 'short_dec'
				
			},
			{ 
				"targets": 3 , 
				"data": 'inicio_service'
				
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
			"targets": 7,
			"data": 'price',
			"render": function (data, type, row, meta) {
				price = row.price
				return 'R$'+price
			
			}
			},
			{
			"targets": 8,
			"data": 'id_booking',
			"render": function (data, type, row, meta) {
				
				return '<i class="mdi mdi-file-document"></i><a class="single_link" href="rel-atv-'+row.id_booking+'">Relatório</a>';
			
			}
			},
			{ 
			"targets": 9 ,
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
					return '<span class=" '+color+' label label  '+status_type+'">'+status+'</span>';
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
	get_service_hist();
	$("#search_clientes").on("input", function (e) {
      e.preventDefault();
     $('#lista_atividades').DataTable().search($(this).val()).draw(); 
  });
}, 30);

	
	toastr.options = {"positionClass": "toast-top-full-width"};
	Highcharts.setOptions({
		colors: ["#dfb590","#83c9d6","#60a9b7","#d0a37d","#464a53","#f8d999","#733f17","#935f37","#ad8a60","#cf965f","#bc6337","#d59f7b","#f2c280","#edc192","#f9d4a0","#fee3c6"]
	});

	//$('.data').mask('99/99/9999');
	
	function get_lista_categoria(){
		var idCliente = $("#id_ativo").val();
		
		$.ajax({
		url:"includes/ativo/get_cat_ativo",
		dataType:'JSON',
		method:"GET",
		data:{id:idCliente},
			success:function(response){
				var option = '<option disabled selected value="none"></option>'
				var i;
				for (i = 0; i < response.length; i++) {
					option += '<option value="'+response[i].description+'">'+response[i].description+'</option>';
							
				}
				$('#category').html(option);	
				
			}
		}); 
   }
	
	function get_lista_tipo_pai(){
		var idCliente = $("#id_clientt").val();
		
		$.ajax({
		url:"includes/ativo/get_tipo_pai",
		dataType:'JSON',
		method:"GET",
		data:{id:idCliente},
			success:function(response){
				var option = '<option value="0">Nenhum</option>'
				var i;
				for (i = 0; i < response.length; i++) {
					option += '<option value="'+response[i].id+'">'+response[i].descricao+'-'+response[i].qrcode+'</option>';
							
				}
				$('#list_pai').html(option);	
				
			}
		}); 
   }
	
	function get_lista_local(){
		var id_client = $("#id_client").val();
		
		$.ajax({
		url:"includes/local/get_local_cliente",
		dataType:'JSON',
		method:"POST",
		data:{id_client:id_client},
			success:function(response){
				var option = '<option disabled selected value="none"></option>'
				var i;
				var status = response.status;
				if(status == 'SUCCESS'){
					for (i = 0; i < response.data.length; i++) {
						option += '<option value="'+response.data[i].id+'">'+response.data[i].descricao+'</option>';
					}
					$('#local').html(option);	
				}
				
				
				
				
			}
		}); 
   }

   function CadastroLocal(){
		var descricao = $("#nova_descricao").val();
		var id_client = $("#id_client").val();
		//var responsavel = $("#novo_responsavel").val();
		
		$.ajax({
			url: "includes/local/cadastra_local", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                descricao : descricao, 
                id_client : id_client, 
                
               
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt); 
							toastr.success('Sucesso!', 'Cadastrado com Sucesso')
							$('#nova-localizacao').modal('hide');
							window.setTimeout( function(){
								get_lista_local();
							}, 1000 );
							
						}, 100); 
					} else {
						$(".loading").hide(); 
						$(".alert-success").hide(); 
						$(".alert-danger").hide(); 
						$(".alert-danger").fadeIn(); 
						$(".error_txt").html(status_txt); 
					} 
				},
				error:function(response){
					alert("Erro!");
					console.log(response);
				} 
			});
		}
   

    var descricao;
	var full_address;
	function get_ativo_info(){
	var idCliente = $("#id_ativo").val();
	$.ajax({
     url:"includes/ativo/get_info_ativo",
	 dataType:'JSON',
     method:"GET",
     data:{id:idCliente},
		success:function(response){
		var status = response.status;
		var info_ativo = response.data;

			if(status == "SUCCESS") {
				
				$('#qr_nome_empresa').text("Nome Empresa: " + info_ativo.nome_empresa);
				$('#qr_local').text("Local: " + info_ativo.localizacao + " | Capacidade: " + info_ativo.capacidade);
				$('#qr_model').text("Modelo Evap: " + info_ativo.model + " | SN: " + info_ativo.sn);
				//$('#qr_sn').text("SN: " + info_ativo.sn);
				//$('#qr_capacidade').text("Capacidade: " + info_ativo.capacidade);
				$('#qr_model_cond_1').text("ModelCond1: " + info_ativo.modelo_cond1 + " | SNCond1: " + info_ativo.nserie_cond1);
				//$('#qr_sn_cond_1').text("SNCond1: " + info_ativo.nserie_cond1);
				$('.qr_txt_tag').html(info_ativo.qrcode);
				$('#qr_tecnoair').html('<img style="width: 75px;;;float:left;margin-right:10px;" src="'+info_ativo.foto_empresa+'" >' + info_ativo.comp.whatsapp);

				

				
				$('#descricao').val(info_ativo.descricao);
				$('#model').val(info_ativo.model);
				$('#register').val(info_ativo.register);
				$('#fabricante').val(info_ativo.fabricante);
				$('#capacidade').val(info_ativo.capacidade);
				$('#lat').val(info_ativo.lat);
				$('#lon').val(info_ativo.lon);
				$('#obs').val(info_ativo.obs)
				$('#validade').val(info_ativo.validade);
				$('#responsavel').val(info_ativo.responsavel);
				$('#qrcode').val(info_ativo.qrcode);
				$('#nome_empresa').val(info_ativo.nome_empresa);
				$('#id_client').val(info_ativo.id_client);
				$('#tipo').val(info_ativo.tipo);
				$('#list_pai').val(info_ativo.id_depende);
				$('#cond1').val(info_ativo.cond1);
				$('#modelo_cond1').val(info_ativo.modelo_cond1);
				$('#nserie_cond1').val(info_ativo.nserie_cond1);
				$('#cond2').val(info_ativo.cond2);
				$('#modelo_cond2').val(info_ativo.modelo_cond2);
				$('#nserie_cond2').val(info_ativo.nserie_cond2);
				$('#cond3').val(info_ativo.cond3);
				$('#modelo_cond3').val(info_ativo.modelo_cond3);
				$('#nserie_cond3').val(info_ativo.nserie_cond3);
				$('#sn').val(info_ativo.sn);
				serv();

				setTimeout(function(){
					$("#my_Services").val(info_ativo.id_service);
				},200)

				

				if(info_ativo.type_pai == 1){
					$("#type_pai").prop( "checked", true );
				}

				
				if(info_ativo.foto_ativo != ""){
					$("#image_client").attr('src', info_ativo.foto_ativo +'?' + (new Date()).getTime());
				}
				if(info_ativo.foto_cliente != ""){
					$("#box_dono").html(
						'<img style="width:50px;height:50px;border-radius:50%;background:#f3f3f3;float:left;margin-right:10px" class="user_pic" src="'+info_ativo.foto_cliente+'" ><h4> '+info_ativo.nome_empresa+'</h4> '
					);
				}
				full_address = info_ativo.endereco+' '+info_ativo.numero+' '+info_ativo.bairro+' '+info_ativo.complemento+' '+info_ativo.cidade+' '+info_ativo.estado;
                descricao = info_ativo.descricao;
				setTimeout(function(){
					
					$('#category').val(info_ativo.category);
					//$('#local').select2();	
				}, 500);

				window.setTimeout( function(){
					get_lista_local();
					$('#local').val(info_ativo.local);
			   }, 50 );
				
			   window.setTimeout( function(){
					
					$('#local').val(info_ativo.local);
			   }, 1000 );


				if(info_ativo.lat == 'null' || info_ativo.lat == null || info_ativo.lat == ""){
					plot_map(0,0)
				} else {
					plot_map(info_ativo.lat,info_ativo.lon,descricao,full_address)
					//set_map(info_ativo.lat,info_ativo.lon,info_ativo.descricao);
				}
				qrcode.makeCode(info_ativo.qrcode);

				$('.qr_txt').html(info_ativo.qrcode);

			} else {
				window.location.href = '404';
			}
		}
    }); 

  }

  var map;
function plot_map(lat,lon,descricao,full_address){
    
    var desc_box = '<div style="text-align:center;"><h4>'+descricao+'</h4><p>'+full_address+'</p></div>';

	    if(map == undefined || map == 'undefined'){
			
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

					
    
    
    } else {

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

    
    }  
   


}



  	get_lista_categoria();
  	get_ativo_info();
	$("#carregar_imagem_ativo").click(function(){
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
		var id = $('#id_ativo').val();
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
	  url:"includes/ativo/upload_pic_ativo",
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
			toastr.success(status_txt, '!Sucesso')
			setTimeout(function(){
				$('#status_img').fadeOut();
				$('.progress').fadeOut();
			 }, 40);
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

	$( "#update_tag" ).click(function() {
		var id = $("#id_ativo").val();
		var qrcodeval = $('#qrcode').val();


	
    $.ajax({
         url: "includes/ativo/update_tag", 
		 type : 'POST', 
		 dataType: 'JSON',
        data: {
				id : id,
                qrcode : qrcodeval               
			},
                success: function(response){
                var json = response; 
                status = json.status; 
                status_txt = json.status_txt;

                if(status == 'SUCCESS') {
                    setTimeout(function(){
                        toastr.success(status_txt, 'Sucesso!');
                    }, 10);
					qrcode.makeCode(qrcodeval);
					$('.qr_txt').html(qrcodeval);

                } else { 
                    $(".loading").hide(); 
                    $(".alert-success").hide(); 
                    $(".alert-danger").hide(); 
                    $(".alert-danger").fadeIn(); 
                    $(".error_txt").html(status_txt); 
                } 
            } 
    });
    
});


$( "#print_qr" ).click(function() {
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		w = window.open();
		w.document.write(printContents);
		w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
		w.document.close(); // necessary for IE >= 10
		w.focus(); // necessary for IE >= 10
		return true;
	}
	printDiv('qr_frame');
});


	function turn_off_camera(){
		Webcam.reset();
	}
	
	function turn_on_camera(){
		Webcam.on( 'error', function(err) {
		console.log("Sem webcam");
		});

		Webcam.set({
			width: 450,
			height: 300,
			image_format: 'jpeg',
			jpeg_quality: 100
		});
	
		Webcam.attach('#my_camera');

		$('#take_snapshot').click(function(){
			Webcam.snap( function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
				image = data_uri;
				id = $("#id_ativo").val();

				$.ajax({
				url:"includes/ativo/take_pic_ativo",
				dataType:'JSON',
				data: {base64:image,id:id},// Add as Data the Previously create formData
				type:"POST",
				error:function(err){
					status = data.status;
					status_txt = data.status_txt;
					toastr.error(status_txt, '!Error')
				},
				success:function(data){
					console.log(data);
					status = data.status;
					status_txt = data.status_txt;
					toastr.success(status_txt, '!Sucesso')
				},
				complete:function(){

					console.log("Request finished.");
				}
			});
			
			});
			
		})
	}




	
 function get_indicadores(){
	var id = $("#id_ativo").val();
	data_count = 0;
	data_valor = 0;
	soma_valor_total = 0;
	total_geral = 0;
	latest_visit = 0;
	most_service = 0;
	total_prod = 0;
	$.ajax({
				type: 'POST',
				url: 'includes/ativo/get_ativo_indicador',
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
					total_prod = result.total_produto_prev;
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
							categories: ['Jan', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
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
								return '<b>' + getPointCategoryName(this.point, 'x') + '</b> sold <br><b>' +
									this.point.value + '</b> Atividades on <br><b>' + getPointCategoryName(this.point, 'y') + '</b>';
							}
						},

						series: [{
							name: 'Nº de Atividades',
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
								type: 'pie'
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
											
										}
									}
								}
							},
							series: [{
								name: "Quantidade por Atividade",
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
								style: {
									fontFamily: 'Poppins', 
								}
							},
							title: {
								text: ''
							},
							tooltip: {
								//pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
								pointFormat: '{series.name}: <b>R${point.y}</b>',
								style: {
									fontFamily: 'Poppins', 
								}
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

 //get_indicadores();
	

function filfunresult(data) {
	var markupfun = "";
	if(data.loading){
		markupfun = "Procurando";
	}
	else if (data.id == undefined) {
		markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="single_link btn btn-primary btn-sm" href="cadastro-funcionario" >Cadastrar Funcionario</a>';
		return;
	} else {
		var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
	}
	
	return markupfun;
}
function filfunselec(data) {
	var markupfun = "";
	if(data.loading){
		markupfun = "Procurando";
	}
	else if (data.id == undefined) {
		markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="cadastro-funcionario" >Cadastrar Funcionario</a>';
		return;
	} else {
		var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
	}
	
	return markupfun;
}


 

</script>
