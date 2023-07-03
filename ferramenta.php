<?php include('includes/common/check_permission.php'); ?>

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
				font-size: 14px;
				text-align:center;
				border:1px solid gray;
			}
		}

	</style>
</head>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs">
								<li class="nav-item"><a id="geral_" href="#geral" data-toggle="tab" class="nav-link active show">Geral</a></li>
								<li class="nav-item"><a href="#atividades" data-toggle="tab" class="nav-link">Histórico de Atividades</a></li>
								<li class="nav-item"><a href="#indicadores" data-toggle="tab" class="nav-link">Indicadores</a></li>
								<li class="nav-item"><a href="#identificador" data-toggle="tab" class="nav-link">QRCode</a></li>
								<li class="nav-item"><a href="#documentos" data-toggle="tab" class="nav-link">Documentos</a></li>
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
												
												<div class="col-lg-10" >
													<div class="form-group">
														<label class="text-label">Descrição<span style="color:red;">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" id="descricao" name="descricao" placeholder="" required>
														</div>
													</div>
												</div>
												<!--<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Equipamento Pai ?</label>
															<div class="input-group">
																<input class="form-check-input styled-checkbox" id="type_pai" type="checkbox" name="type_pai" value="sim">
																<label for="type_pai" class="form-check-label check-green ">Sim</label>
															</div>
														</div>
													</div> -->
												<div class="col-lg-2">
													<div class="form-group">
														<label class="text-label">Base</label>
														<div class="input-group">
															<select id="base" name="base" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
																<option disabled selected value="none">Selecione o tipo</option>
																
															</select>
														</div>
													</div>
												</div> 
													
												<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Responsável </label>
														<div class="input-group">
															<div class="input-group">
															<input type="text" class="data form-control" id="responsavel" name="responsavel" placeholder="" >
																<!--<select style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="responsavel" name="responsavel" ></select>-->
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Validade</label>
														<div class="input-group">
															<input type="text" class="data form-control date_picker" id="validade" name="validade" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label class="text-label">Calibração</label>
														<div class="input-group">
															<input type="text" class="data form-control date_picker" id="calibracao" name="calibracao" placeholder="" >
														</div>
													</div>
												</div>
												<!--<div class="col-lg-3">
													<div class="form-group">
														<label class="text-label">Categoria </label>
														<div class="input-group">
															<div class="input-group">
																<select style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="category" name="category" ></select>
															</div>
														</div>
													</div>
												</div>-->
												<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Patrimônio </label>
														<div class="input-group">
															<input type="text" class="form-control" id="register" name="register" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Modelo </label>
														<div class="input-group">
															<input type="text" class="form-control" id="model" name="model" placeholder="" >
														</div>
													</div>
												</div>
												
												<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Fabricante </label>
														<div class="input-group">
															<input type="text" class="form-control" id="fabricante" name="fabricante" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Capacidade </label>
														<div class="input-group">
															<input type="text" class="form-control" id="capacidade" name="capacidade" placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="text-label">Tipo </label>
														<div class="input-group">
															<select class="form-control" style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="tipo" name="tipo" >
																<option value="">Escolher Tipo</option>
																<option value="Administrativo">Administrativo</option>
																<option value="Calibrável">Calibrável</option>
																<option value="Ferramenta">Ferramenta</option>
																<option value="Ferramental">Ferramental</option>
																<option value="GSE">GSE</option>
															
															</select>
														</div>
													</div>
												</div>
												<div class="col-lg-4">
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
														<a style="margin-bottom:15px;float:right;margin-left: 10px;" target="_blank" class="single_link" href="#lista-localizacao"><span style="width:100%;padding:12px;" class="label label-xl btn-secondary btn-xs">Lista Localização</span></a>
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
								<div id="atividades" class="tab-pane fade">
								<div class="event-sideber-search">
									<form action="#" method="post" class="chat-search-form">
										<input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
										<i class="fa fa-search"></i>
									</form>
								</div>		
									<div class="table-responsive">
										<table class="table table-padded market-capital table-responsive-fix-big" id="atividates_table" name="lista_pets" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Descrição</th>
													<th>Atividades</th>
													<th>Data</th>
													<th>Iniciado</th>
													<th>Finalizado</th>
													<th>Tempo</th>
													<th>Valor</th>
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
											<div id="qr_frame" style="width: 141px;border: 1px solid gray;text-align: center;padding: 5px;">
												<div id="qrcodeimg"></div>
												<h4 style="margin-top: 15px;" class="qr_txt"></h4>
											</div>
											
										</div>

									</div>
								</div>	
								
								<div id="documentos" class="tab-pane fade ">
									<div class="pt-3">		
										<div class="col-lg-12" >
											<div class="card-body widget-file-container">
												<h4 class="card-title">Documentos <button style="float:right;" class="btn btn-primary" onclick="ModalNewDoc()">Novo Documento</button></h4>
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



</div>



    <script src="js/qrcode.min.js"></script>
	<script src="includes/ferramenta/update_ativo_single.js"></script>
    <script src="js/highchart/highcharts.js"></script>
    <script src="js/highchart/series-label.js"></script>
    <script src="js/highchart/exporting.js"></script>
	<script src="js/highchart/data.js"></script>
	<script src="js/highchart/heatmap.js"></script>
	<script src="js/highchart/export-data.js"></script>
	<script src="js/highchart/accessibility.js"></script>
	<script src="js/webcam.min.js"></script>
	<script src="js/leaf/leaflet.js"></script>

		
<script >
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

get_lista_base()

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
		var table = $('#atividates_table').DataTable({
		ajax: {
			url: 'includes/ativo/get_ativo_hist',
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
		},
		"bDestroy": true,
		columnDefs: [ 
			
			{ 
				"targets": 0 ,
				"data": 'descricao',
					"render": function (data, type, row, meta) {
								var img = row.foto_ativo + '?' + (new Date()).getTime();
								return '<a  class="single_link" href="#ferramenta-'+row.id_ativo+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.descricao+'</a>';
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
			"targets": 6,
			"data": 'price',
			"render": function (data, type, row, meta) {
				price = row.price
				return 'R$'+price
			
			}
			},
			{ 
			"targets": 7 ,
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
     $('#atividates_table').DataTable().search($(this).val()).draw(); 
  });
}, 30);

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
	
	/*function get_lista_tipo_pai(){
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
   }*/
	
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
	
	function get_lista_local(){
		var id_client = $("#id_client").val();
		
		$.ajax({
		url:"includes/local/get_local_todos",
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
     url:"includes/ferramenta/get_info_ativo",
	 dataType:'JSON',
     method:"GET",
     data:{id:idCliente},
		success:function(response){
		var status = response.status;
		var info_ativo = response.data;

			if(status == "SUCCESS") {
				$('#descricao').val(info_ativo.descricao);
				$('#model').val(info_ativo.model);
				$('#register').val(info_ativo.patrimonio);
				$('#fabricante').val(info_ativo.fabricante);
				$('#capacidade').val(info_ativo.capacidade);
				$('#lat').val(info_ativo.lat);
				$('#lon').val(info_ativo.lon);
				$('#obs').val(info_ativo.obs)
				$('#validade').val(info_ativo.validade);
				$('#calibracao').val(info_ativo.calibracao);
				$('#responsavel').val(info_ativo.responsavel);
				$('#qrcode').val(info_ativo.qrcode);
				$('#nome_empresa').val(info_ativo.nome_empresa);
				$('#id_client').val(info_ativo.id_client);
				$('#tipo').val(info_ativo.tipo);
				$('#list_pai').val(info_ativo.id_depende);
				$('#base').val(info_ativo.base);

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


				if(info_ativo.lat == 'null' || info_ativo.lat == null){
				} else {
					plot_map(info_ativo.lat,info_ativo.lon)
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

  setTimeout(function(){
	get_ativo_info();
  }, 100);


var map;
function plot_map(lat,lon){
    
    var desc_box = '<div style="text-align:center;"><h4>'+descricao+'</h4><p>'+full_address+'</p></div>';

    if(map == undefined){
        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="#https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var streets  = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
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

        L.control.layers(baseLayers, overlays).addTo(map);
    
    
    } else {
        map.off();
        map.remove();

        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="#https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="#https://www.mapbox.com/">Mapbox</a>';
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

  	get_lista_categoria();
  
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
         url: "includes/ferramenta/update_tag", 
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

 get_indicadores();
	

function filfunresult(data) {
	var markupfun = "";
	if(data.loading){
		markupfun = "Procurando";
	}
	else if (data.id == undefined) {
		markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="#cadastro-funcionario" >Cadastrar Funcionario</a>';
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
		markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="#cadastro-funcionario" >Cadastrar Funcionario</a>';
		return;
	} else {
		var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
	}
	
	return markupfun;
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
			var id = $('#id_ativo').val();
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
		url:"includes/ferramenta/upload_documento",
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

		var id_tool = $('#id_ativo').val();

		$.ajax({
					url:"includes/ferramenta/get_lista_documentos",
					method:"POST",
					dataType:'json',
					data:{id_tool:id_tool},

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
					url: 'includes/ferramenta/delete_documento',
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


</script>
