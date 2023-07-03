<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Calendário</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
	<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
	<link href="assets/plugins/fullcalendar/css/scheduler.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/plugins/datepicker/jquery.datetimepicker.min.css">
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
	<style>
.select2-container .select2-selection--single {height:45px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 43px!important;font-size: 16px;}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {color: #020202!important;line-height: 34px!important;}
.fc-agendaDay-view tr {
	background: #1ea59a;
    height:25px !important;
}

.fc-time-grid-event .fc-time {
    font-size: .85em;
    font-weight: 800;
}

.fc-avatar-image{
	top: 2px;
    height: 15px;
    width: 15px;
    border-radius: 50%;
    position: absolute;
    z-index: 2;
}
.fc-avatar-image img{
  height:15px;
  width: 15px;
  border-radius: 50%;
}
.fc-avatar-image:before{
    content: none !important;
}

.fc-nonbusiness {
	background-image: linear-gradient(45deg, #eaf4f5 5%, #f0f9fa 5%, #f6feff 50%, #b1b1b1 50%, #f0f9fa 55%, #f0f9fa 55%, #f0f9fa 100%);
    background-size: 14.14px 14.14px;
}

.calendar-container {
    width: 300px;
    overflow-x: scroll;
}

.fc table {
    width: 100%;
    box-sizing: border-box;
    table-layout: fixed;
    border-collapse: collapse;
    border-spacing: 0;
}

.fc th.fc-widget-header {
	line-height: 1rem;
    padding: 4.2px;
    background: 0 0!important;
    color: #464a53;
    text-transform: capitalize;
    font-size: 14px;
}

.fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed thead {
    border-color: #dddfe1;
}

.fc-axis.fc-time{
	border-color: #eeeff0;
}

.fc-time-grid table {
    border: 1px solid #eeeff0;
}

.fc-next-button, .fc-prev-button {
    color: #464a53;
    border: 1px solid #dddfe1!important;
}

.fc-button {
    border: 1px solid #dddfe1!important;
}

.fc-agendaDay-button, .fc-agendaWeek-button {
    border: 1px solid #dddfe1!important;
    color: #464646;
}

.fc-list-view {
    border-width: 0.5px;
    border-style: solid;
    border-color: #dddfe1;
}

.fc-ltr .fc-resource-area tr>* {
    text-align: left;
    background: #1c9a8e;
}


</style>
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
	<div id="main-wrapper" >
        <?php include('includes/common/nav-header.php'); ?>
		<?php include('includes/common/header.php'); ?>
        <?php include('includes/common/sidebar.php'); ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
				
					<div class="col-lg-12">
                        <div class="card forms-card">
                            <div class="card-body">
								<h4 class="card-title">Agenda de Atividades</h4>
                                <div class="basic-form">
									<div class="card-box">
										<div class="row">

										<div class="col-12" style="float: left;">
											<div class="form-group">
												<span style="float: left;">Filtrar por Colaborador</span>
												<div class="input-group">

												<select style="" id="lista_funcionario_filtro" name="lista_funcionario_filtro[]" required multiple="multiple"></select>
												<input id="id_funcionario_filtro" name="id_funcionario_filtro" type="hidden" class="form-control" >
												</div>
											</div>
										</div>   

											<div class="col-md-12 col-lg-12 col-xl-12">
												<div id="calendar_">
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
    </div>
	
	<div id="createEventModal" class="modal fade" role="dialog">
	 <div class="modal-dialog">

	 <!-- Modal content-->
	 <div class="modal-content">
	 	 <form class="form novo_evento" id="validate_evento" role="form" action="javascript:save_event();" >
		 <div class="modal-header">
		 <h4 class="modal-title">Nova Atividade</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
		 </div>
		 <div class="modal-body">
		 	
			<div id="mask_choice_first"></div>
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="text-label">Cliente</label>
						<div class="input-group">
							<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="clientes" name="clientes" required></select>
						</div>
					</div>
				</div>
				<input name="has_chose_fun" id="has_chose_fun" type="hidden">

				<div class="col-lg-12">
					<div style="display:none;" id="petss">
					
						<div class="form-group">
							<label class="text-label">Ativo</label>
							<div class="input-group">
								<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente" name="pet_cliente" required></select>
							</div>
						</div>


						<div class="form-group">
							<label class="text-label">Escolha a Atividade</label>
							<div class="input-group">
								<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="tipo_servico" name="tipo_servico" required></select>
							</div>
						</div>
					
					
					</div>
				
				</div>

				<div style="display:none;width:100%" id="date_time_box">

					<div class="col-lg-6" style="float: left;">
						
							<div class="form-group">
								<label class="text-label">Tempo Estimado</label>
								<div class="input-group">
									<input type="text" style="width: 100%;height:45px;border:1px solid #dddfe1;padding-left:5px;background:#e9ecef;" id="tempo_estimado" name="tempo_estimado" readonly disabled required></input>
									<input type="hidden" id="time_est_minute"/>
								</div>
							</div>
					
					</div>
					
					<div class="col-lg-6" style="float: left;">
						<div class="form-group">
							<label class="text-label">Escolha a Prioridade</label>
							<div class="input-group">
								<select class="form-control" id="prioridade" name="prioridade" >
								<option value="Normal">Normal</option>
								<option value="Alta">Alta</option>
								<option value="Média">Média</option>
								</select>
							</div>
						</div>
					</div>
				
					<div class="col-lg-6 col-md-6" style="float: left;" >
						<div class="form-group">
							<span>Data</span>
							<input style="cursor:pointer;" readonly required id="startTime" name="startTime" type="text" class="form-control datetimepicker_inicio" placeholder="Hora Início ">
							<input id="startTime_dummy" name="startTime_dummy" type="hidden" >
						</div>
					</div>
					<div class="col-lg-6 col-md-6" style="float: left;">
						<div class="form-group">
							<span>Termino</span>
							<input style="cursor:pointer;" readonly required id="endTime" name="endTime" type="text" class="timepicker_ form-control datetimepicker_termino" placeholder="Hora Fim ">
						</div>
					</div>
					<div class="col-lg-6 col-md-6" style="float: left;">
						<div class="form-group">
							<label>Repetir Agendamento</label>
							<select id="repeat_option" onchange="getrepeat(this);" class="form-control" >
								<option value="0" selected="">Não</option>
								<option value="7">1 Semana</option>
								<option value="14">2 Semanas</option>
								<option value="21">3 Semanas</option>
								<option value="28">4 Semanas</option>
							</select>
						</div>
					</div>

					<div class="col-lg-6 col-md-6" style="float: left;">
						<label>Próximos Agendamentos</label>
						<ul id="extra_date" class="extra_date ">

						</ul>

					</div>

				</div>

				
			
			
			</div>
	  		
			
			<div class="row">
				<div class="col-lg-12" id="mask_choice_second" style="width: 100%;"></div>
			</div>	
			
			<div class="row">

			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Obs</label>
					<div class="input-group">
						<textarea type="text" id="obs_extra" name="obs_extra" class="form-control" ></textarea>
					</div>
				</div>
			</div>
			<div style="display:none;width: 100%;height: 40px;background: #E91E63;text-align: center;color: white;line-height: 40px;font-size: 15px;" class="error_modal_top"></div>
		 	
		    </div>
		 	<input name="starttime_hour" id="starttime_hour" type="hidden">

		 </div>
		 <div class="modal-footer">
		 <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		 <button type="button" onclick="saveCalendary()" class="btn btn-success">Salvar</button>
		 </div>
		</form>
	 
	 
	 </div>
	 </div>
</div>

<!-- Modal Novo Cliente -->
<div id="novo_pet_modal" class="modal fade" style="z-index: 55555;">
	<div class="modal-dialog" style="max-width:660px!important;">
		<div class="modal-content">
			
			<form class="form novo_evento" id="validate_evento" role="form" action="javascript:saveNewPet();" >
			
				<div class="modal-header">
				<h4 class="modal-title">Novo Pet</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12">
						<div class="form-group">
							<label class="text-label">Nome do Pet</label>
							<div class="input-group">
							<input type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="nome_novo_pet" name="nome_novo_pet" required></input>
							</div>
						</div>
					</div>
					<div style="display:none;width: 100%;height: 40px;background: #E91E63;text-align: center;color: white;line-height: 40px;font-size: 15px;" class="error_modal_novo_pet"></div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
					<button type="button" onclick="saveNewPet()" class="btn btn-success">Salvar</button>

				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Novo Cliente -->
<div id="novo_cliente_modal" class="modal fade" style="z-index: 55555;">
	<div class="modal-dialog" style="max-width:660px!important;">
		<div class="modal-content">
			<form class="form novo_evento" id="validate_evento" role="form" action="javascript:save_novo_cliente();" >
				<div class="modal-header">
				<h4 class="modal-title">Novo Agendamento</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12">
						<div class="form-group">
							<label class="text-label">Nome do Cliente</label>
							<div class="input-group">
							<input type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="nome_novo_cliente" name="nome_novo_cliente" required></input>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label class="text-label">Telefone Cliente</label>
							<div class="input-group">
							<input class="phone" type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="phone_novo_cliente" name="phone_novo_cliente" required></input>
							</div>
						</div>
					</div>
					<div style="display:none;width: 100%;height: 40px;background: #E91E63;text-align: center;color: white;line-height: 40px;font-size: 15px;" class="error_modal_novo_cliente"></div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
					<button type="button" onclick="saveNewCliente()" class="btn btn-success">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal to Event Details -->
<div id="calendarModal" class="modal fade">
	<div class="modal-dialog" style="max-width:660px!important;">
		<div class="modal-content">
			<div class="modal-header">
			<h2 >Detalhes da Atividade  <h2 style="margin-left: 10px;"id="num_atividade"></h2></h2> <button type="button" class="close" data-dismiss="modal" >×</button>
			</div>
			<div id="modalBody" class="modal-body">
			<div id="modalWhen" style="margin-top:5px;"></div>
			</div>
			<input type="hidden" id="eventID"/>
			<input type="hidden" id="eventFunc"/>
			<div class="modal-footer">
			<button id="comecar" style="display:none;" onclick="alteraStatus('comecar')" class="btn btn-start">Iniciar Atividade</button>
			<button id="finalizar" style="display:none;" onclick="alteraStatus('finalizar')" class="btn btn-close">Finalizar Atividade</button>
			<button id="concluido" style="display:none;" onclick="alteraStatus('concluido')" class="btn btn-conc">Aprovar</button>
			<button id="reprovar" style="display:none;" onclick="alteraStatusReprovado('reprovar')" class="btn btn-danger">Reprovar</button>
			<!--<button type="submit" class="btn btn-danger" id="deleteButton">Deletar</button>-->
			</div>
		</div>
	</div>
</div>


        <div id="ModalAddInfo" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 >Adicionar Informação</h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
                    </div>
                    <div id="modalBodyInfo" class="modal-body">
                    <div id="modalWhenInfo" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID"/>
                    <input type="hidden" id="eventFunc"/>
                    <div class="modal-footer">
                    <button style="display:none;" onclick="adicionaInformacao('id')" class="btn btn-close">Adicionar Informação</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="ModalAddTime" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2>Alterar Horario </h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
                    </div>
                    <div id="modalBodyTime" class="modal-body">
                    <div id="modalWhenTime" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID"/>
                    <input type="hidden" id="eventFunc"/>
                    <div class="modal-footer">
                    <button style="display:none;" onclick="adicionaInformacao('id')" class="btn btn-close">Adicionar Informação</button>
                    </div>
                </div>
            </div>
        </div>
       
	    <div id="ModalEditServico" class="modal fade">
            <div class="modal-dialog" >
                <div class="modal-content modal-content-edit" style="width:98%;background:#f9f9f9;margin-left: 5px;">

				</div>
            </div>
        </div>

		<input type="hidden" id="time_est_edit"/>
		<input type="hidden" id="start_inicial"/>
		<input type="hidden" id="end_inicial"/>

       <?php include('includes/common/footer.php'); ?>
        <?php include('includes/common/right-sidebar.php'); ?>
    </div>
	
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
	<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
	<script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
	<script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="js/jquery.mask.js"></script>
	<script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>
	<script src="assets/plugins/moment/moment.js"></script>
	<script src='assets/plugins/fullcalendar/js/fullcalendar2.min.js'></script>
	<script src='assets/plugins/fullcalendar/js/scheduler.min.js'></script>
	<script src='assets/plugins/fullcalendar/js/fullcalendar-columns.js'></script>
	<script src="includes/calendario/final_calendar_funcionario.js"></script>

	<script>
	$('#lista_funcionario_filtro').select2();
	$('#tipo_servico').select2();
	$('#prioridade').select2();
	$('.phone').mask('(00) 00000-0009');
	$.datetimepicker.setLocale('pt');
 
	 $('#clientes').select2({
        ajax: {
          url: 'includes/calendario/get_clientes',
          type : 'POST',
		  dataType: 'JSON',
          delay: 200,
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
                        o.name = v.name;
                        o.phone = v.phone;
                        o.street = v.street;
                        o.number = v.number;
                        o.neighbor = v.neighbor;
                        o.complemento = v.complemento;
                        o.city = v.city;
                        o.state_ = v.state_;
                        o.foto = v.foto;
                        o.zip = v.zip;
                        o.pet_name = v.pet_name;
                        o.all_pets = v.all_pets;
                        o.valor_frete = v.valor_frete;
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
		  templateResult: formatcre,
		  templateSelection: formatcse,
      });
	  
	  function formatcre(data) {

		$('#pet_cliente option:selected').remove();
		$('#pet_cliente').val('');
		$("#pet_cliente").val('').trigger('change');
		var markup = "";


		if(data.loading){
			markup = "Procurando";
		}
		else if (data.id == undefined) {
			markup = 'Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_cliente_modal" >Cadastrar Cliente</a>';
			
						
		} else {
			endereco = data.street+' nº'+data.number+','+data.neighbor+' - '+data.city;
			$('#obs_adr').val(endereco);
			$('#price_taxi').val(data.valor_frete);
			var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +'</span>';
		}
		return markup;
	}

	function formatcse(data) {
		var markup = "";
		if(data.loading){
			markup = "Procurando";
		}
		else if (data.id == undefined) {
			//markup = 'Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_cliente_modal" >Cadastrar Cliente</a>';
			
		} else {
			endereco = data.street+' nº'+data.number+','+data.neighbor+' - '+data.city;
			$('#obs_adr').val(endereco);
			$('#price_taxi').val(data.valor_frete);
			var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +'</span>';
		}
		return markup;
	}

	$('#clientes').on('select2:select', function (e) {
		
		$('#pet_cliente option:selected').remove();
		$("#pet_cliente").val('').trigger('change');

		$("#produto_div").show();	
		$("#petss").show();
			id_cliente = $('#clientes').val();
			
			$('#pet_cliente').select2({
			ajax: {
				url: 'includes/calendario/get_ativos_from_client?id_cliente='+id_cliente+'',
				type : 'POST',
				dataType : 'JSON',
				delay: 200,
				data: function (params) {
						return {
						searchTerm: params.term // search term
					}
			},
				dropdownParent: "#createEventModal",
				processResults: function (data) {
					var results = [];
					$.each(data, function (i, v) {
						var o = {};
						o.id = v.id;
						o.name = v.name_bolt;
						o.foto = v.foto;
						results.push(o);
					});
					return {results: results};
			},
			cache: false
			},
				escapeMarkup: function (markuppet) { 
				return markuppet;
				},
				minimumInputLength: 0,
				templateResult: formatpetresult,
				templateSelection: formatpetresult,
			});
	});

	
	function formatpetresult(data) {
		
	
		var markuppet = "";
		if(data.loading){
			markuppet = "Procurando";
		} else if (data.id == undefined) {
			markuppet = '<span>Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_pet_modal" >Cadastrar Pet</a></span>';
			return
		} else {
			var markuppet = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> <strong>'+ data.name +'</strong> </span>';
		}
		return markuppet;
	}
	function formatpetselect(data) {
		var markuppetsel = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> '+ data.name +'</span>';
		return markuppetsel;
	}

	//-----------------------------------------------------------------------//  
	$("#pet_taxi").click(function(){
		var checkbox = $('[name="pet_taxi"]');

		if (checkbox.is(':checked'))
		{
			$('#endereco_cliente').show();
			$('#has_taxi').val(1);
		}else
		{
			$('#endereco_cliente').hide();
			$('#has_taxi').val(0);
		}
	});

	  
	get_funcionario_filter();
	function get_funcionario_filter(){
		$('#lista_funcionario_filtro').select2({
        ajax: {
          url: 'includes/calendario/get_funcionarios_filtro',
          type : 'POST',
		  dataType: 'JSON',
          delay: 10,
		  data: function (params) {
				return {
				  searchTerm: params.term // search term
				};
		  },
		
			processResults: function (data, page) {
				var resultsfun = [];
				$.each(data, function (i, v) {
					var o = {};
					o.id = v.id;
					o.name = v.name;
					o.foto = v.foto;
					o.phone = v.phone;
					resultsfun.push(o);

				});

				return {
					results: resultsfun
				};
			},
			cache: true
			},
		  escapeMarkup: function (markupfun) { return markupfun;},
		  minimumInputLength: 0,
		  minimumResultsForSearch: -1,
		  templateResult: filfunresult,
		  templateSelection: filfunselec,
		});
		
		function filfunresult(data) {
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
	}

	$('#lista_funcionario_filtro').on('select2:select', function (e) {
        $('#calendar_').fullCalendar('refetchEvents');
	});
	
	$('#lista_funcionario_filtro').on('select2:unselecting', function (e) {
		let id = (e.params.args.data.id)
		$("#lista_funcionario_filtro option[value='"+id+"']").remove();
		let lista_funcionario_filtro = $('#lista_funcionario_filtro').val();
		$('#calendar_').fullCalendar('refetchEvents');
	});


		$('#clientes').on('select2:select', function (e) {
			id_cliente = $('#clientes').val();			
		});

		function get_list_service(id_team){
			$("#tipo_servico").val('').trigger('change');
			
			$('#tipo_servico').select2({
				
				ajax: {
				url: 'includes/calendario/get_services',
				data:{id_team:id_team},
				dataType : 'JSON',
				delay: 250,
				processResults: function (data, page) {
				var resultsfun = [];
				$.each(data, function (i, v) {
					var o = {};
					o.id = v.id;
					o.short_dec = v.short_dec;
					o.foto = v.foto;
					o.phone = v.phone;
					o.get_open_days = v.get_open_days;
					o.est_time = v.est_time;
					o.price = v.price;
					o.est_time_min = v.est_hour_min;
					resultsfun.push(o);

				});

				return {
					results: resultsfun
				};
				},
				cache: true
				},
				escapeMarkup: function (markupfun) { return markupfun;},
				minimumInputLength: 0,
				minimumResultsForSearch: -1,
				templateResult: servicesearch,
				templateSelection: serviceselect,
						
			});
			

			function servicesearch(data) {
				var markupfun = "";
				if(data.loading){
					markupfun = "Procurando";
				}
				if (data.id == 'none') {
					return 'Nenhuma Atividade atribuído <a target="_blank" style="float: right;" class="btn btn-primary btn-sm" href="funcionario-'+id_team +'" >Atribuir Atividade</a>';
				} else {
					var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.short_dec +' </span>';
				}
				
				return markupfun;
			}

			function serviceselect(data) {
				var markupfun = "";
				if(data.loading){
					markupfun = "Procurando";
				}
				else if (data.id == 'none') {
					return 'Nenhuma Atividade atribuído <a target="_blank" style="float: right;" class="btn btn-primary btn-sm" href="funcionario-'+id_team+'" >Atribuir Atividade</a>';
					return;
				} else {
					var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.short_dec +' </span>';

					var per_max = data.est_time;
					var result = [];

					$('#time_atividade_box').show();
					$('#preco').val(data.price);
					$("#preco_div").show();

					$("#tempo_estimado_div").show();
					$("#preco_div").show();
					$('#tempo_estimado').val(data.est_time);
					$('#time_est_minute').val(data.est_time_min);
					$('#preco').val(data.price);
					$('#preco').mask('000.000.000.000.000,00', {reverse: true});
					$('#date_time_box').show();
					$(".timepicker_").mask('00:00');
					const now = moment()
					now.format("HH:mm:ss") // 13:00:00
					//$.datetimepicker.setLocale('pt');
					
					jQuery('.datetimepicker_inicio').datetimepicker({
						format:'d/m/Y H:i',
						inline:false,
						todayButton:true,
						lang:'pt',
						step: 5,
						scrollInput: false,
						defaultTime:now.format("HH:mm:ss"),
						onSelectTime:function(dp,$input){
						var min_to_sum = parseInt($('#time_est_minute').val());
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
							$('#endTime').val(hora_final);
							var repeat_option = $("#repeat_option :selected").val();
							getrepeatdin(repeat_option);
				
						}

					});

					var starttime_hour = $('#starttime_hour').val();
					
					calc_next_time(starttime_hour);
					
					function calc_next_time(time){

						datetimepicker_inicio = $('#startTime').val();
						var min_to_sum = parseInt($('#time_est_minute').val());
						var time = '1999-01-01 '+time;
						var date1 = new Date(time);

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
							$('#endTime').val(hora_final)
	
							var repeat_option = $("#repeat_option :selected").val();
							getrepeatdin(repeat_option);
						}
					
					
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
						//defaultTime:'07:00',
				});
					
				}
				
				return markupfun;
			}
		}

	  
		function getrepeat(choose){

			var datetimepicker_inicio = $('#startTime').val();
			var endTime = $('#endTime').val();

			hora_inicial = datetimepicker_inicio.split(" ");
			hora_inicial = hora_inicial[1];
			let id = choose.id;
			let value = choose.value;

			var new_date1 = moment(datetimepicker_inicio, "DD/MM/YYYY");
			var new_date2 = moment(datetimepicker_inicio, "DD/MM/YYYY");
			var new_date3 = moment(datetimepicker_inicio, "DD/MM/YYYY");
			var new_date4 = moment(datetimepicker_inicio, "DD/MM/YYYY");

			var day7 = new_date1.add(7, 'days').format('DD/MM/YYYY');
			var day14 = new_date2.add(14, 'days').format('DD/MM/YYYY');
			var day21 = new_date3.add(21, 'days').format('DD/MM/YYYY');
			var day28 = new_date4.add(28, 'days').format('DD/MM/YYYY');

			var extra1 = '<li id="'+day7+'" value="'+hora_inicial+'|'+endTime+'" ><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day7+' <span style="font-size:13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			var extra2 = '<li id="'+day14+'" value="'+hora_inicial+'|'+endTime+'"><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day14+' <span style="font-size: 13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			var extra3 = '<li id="'+day21+'" value="'+hora_inicial+'|'+endTime+'"><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day21+' <span style="font-size: 13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			var extra4 = '<li id="'+day28+'" value="'+hora_inicial+'|'+endTime+'"><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day28+' <span style="font-size: 13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';

			if(value == 0){
				$('#extra_date').html('');
			}
			if(value == 7){
				$('#extra_date').html(extra1);
			} 
			
			if(value == 14){
				$('#extra_date').html(extra1+extra2);
			}
			if(value == 21){
				$('#extra_date').html(extra1+extra2+extra3);
			}
			if(value == 28){
				$('#extra_date').html(extra1+extra2+extra3+extra4);
			}

		}
		
		function getrepeatdin(choose){

			var datetimepicker_inicio = $('#startTime').val();
			var endTime = $('#endTime').val();

			hora_inicial = datetimepicker_inicio.split(" ");
			hora_inicial = hora_inicial[1];
			let value = choose;

			var new_date1 = moment(datetimepicker_inicio, "DD/MM/YYYY");
			var new_date2 = moment(datetimepicker_inicio, "DD/MM/YYYY");
			var new_date3 = moment(datetimepicker_inicio, "DD/MM/YYYY");
			var new_date4 = moment(datetimepicker_inicio, "DD/MM/YYYY");

			var day7 = new_date1.add(7, 'days').format('DD/MM/YYYY');
			var day14 = new_date2.add(14, 'days').format('DD/MM/YYYY');
			var day21 = new_date3.add(21, 'days').format('DD/MM/YYYY');
			var day28 = new_date4.add(28, 'days').format('DD/MM/YYYY');

			var extra1 = '<li id="'+day7+'" value="'+hora_inicial+'|'+endTime+'" ><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day7+' <span style="font-size:13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			var extra2 = '<li id="'+day14+'" value="'+hora_inicial+'|'+endTime+'"><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day14+' <span style="font-size: 13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			var extra3 = '<li id="'+day21+'" value="'+hora_inicial+'|'+endTime+'"><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day21+' <span style="font-size: 13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			var extra4 = '<li id="'+day28+'" value="'+hora_inicial+'|'+endTime+'"><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+day28+' <span style="font-size: 13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';

			if(value == 0){
				$('#extra_date').html('');
			}
			if(value == 7){
				$('#extra_date').html(extra1);
			} 
			
			if(value == 14){
				$('#extra_date').html(extra1+extra2);
			}
			if(value == 21){
				$('#extra_date').html(extra1+extra2+extra3);
			}
			if(value == 28){
				$('#extra_date').html(extra1+extra2+extra3+extra4);
			}

		}


		function saveNewCliente(){
			nome_novo_cliente = $('#nome_novo_cliente').val();
			phone_novo_cliente = $('#phone_novo_cliente').val();
			if(nome_novo_cliente == ''){
				$('.error_modal_novo_cliente').show();
				$('.error_modal_novo_cliente').html('<span>Digitar o nome</span>');
				return;
			}
			if(phone_novo_cliente == ''){
				$('.error_modal_novo_cliente').show();
				$('.error_modal_novo_cliente').html('<span>Digitar o telefone</span>');
				return;
			}

			$('.error_modal_novo_cliente').hide();
			$.ajax({
				url:"includes/cliente/cadastra-novo-cliente",
				method: "POST",
				dataType : 'JSON',
				data: {
					nome_novo_cliente:nome_novo_cliente,
					phone_novo_cliente:phone_novo_cliente,
				},
				success:function(response){

					status = response.status;
					status_txt = response.status_txt;

					if(status == 'SUCCESS'){
						$("#novo_cliente_modal").modal('hide');
						toastr.success(status_txt, 'Sucesso');
					} else {
						toastr.error(status_txt, 'Error');
					}
					
				}
			}); 
		}

		function saveNewPet(){
			nome_pet = $('#nome_novo_pet').val();
			id_cliente = $('#clientes').val();
			if(nome_pet == ''){
				$('.error_modal_novo_pet').show();
				$('.error_modal_novo_pet').html('<span>Digitar o nome do Pet</span>');
				return;
			}
			
			$('.error_modal_novo_pet').hide();
			$.ajax({
				url:"includes/calendario/cadastra_pet",
				method: "POST",
				dataType : 'JSON',
				data: {
					nome_pet:nome_pet,
					id_cliente:id_cliente
				},
				success:function(response){

					status = response.status;
					status_txt = response.status_txt;

					if(status == 'SUCCESS'){
						$("#novo_pet_modal").modal('hide');
						toastr.success(status_txt, 'Sucesso');
					} else {
						toastr.error(status_txt, 'Error');
					}
					
				}
			}); 
		}
		
	</script>
	
</body>

</html>