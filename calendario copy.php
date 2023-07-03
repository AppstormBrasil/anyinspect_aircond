<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
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
	<link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/plugins/datepicker/jquery.datetimepicker.min.css">
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
	<style>
.select2-container .select2-selection--single {height:45px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 43px!important;font-size: 16px;}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {color: #020202!important;line-height: 34px!important;}
.fc-agendaDay-view tr {
    /*height: 85px !important;*/
}
.fc-agendaWeek-view tr {
    /*height: 85px !important;*/
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
								<h4 class="card-title">Agenda de Serviços</h4>
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
	
	<!-- Modal  to Add Event -->
<div id="createEventModal" class="modal fade" role="dialog">
	 <div class="modal-dialog">

	 <!-- Modal content-->
	 <div class="modal-content">
	 	 <form class="form novo_evento" id="validate_evento" role="form" action="javascript:save_event();" >
		 <div class="modal-header">
		 <h4 class="modal-title">Novo Agendamento</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
		 </div>
		 <div class="modal-body">
		 	 <div class="form-group" id="time_atividade_box" >
				  <div class="row" id="start_funcionario_box" style="text-align: center;font-weight:700;">
					 
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<span>Início</span>
							<input style="cursor:pointer;" readonly required id="startTime" name="startTime" type="text" class="form-control datetimepicker_inicio" placeholder="Título do Formulário ">
							<input id="startTime_dummy" name="startTime_dummy" type="hidden" >
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							 <span>Termino</span>
							<input style="cursor:pointer;" readonly required id="endTime" name="endTime" type="text" class="form-control datetimepicker_termino" placeholder="Título do Formulário ">
						</div>
					 </div>
				 </div>
			 </div>
			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Cliente</label>
					<div class="input-group">
						<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="clientes" name="clientes" required></select>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Tipo de Serviço</label>
					<div class="input-group">
						<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="tipo_servico" name="tipo_servico" required></select>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Funcionário</label>
					<div class="input-group">
						<select style="" id="lista_funcionario" name="lista_funcionario[]" required multiple="multiple"></select>
					</div>
				</div>
			</div>
			<div style="display:none;" id="tempo_estimado_div">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="text-label">Tempo Estimado</label>
						<div class="input-group">
							<input type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;background:#e9ecef;" id="tempo_estimado" name="tempo_estimado" readonly disabled required></input>
						</div>
					</div>
				</div>
			</div>
			<div style="display:none;" id="preco_div">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="text-label">Preço</label>
						<div class="input-group">
							<input type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;background:#e9ecef;" id="preco" name="preco" required></input>
						</div>
					</div>
					<div id="endereco_cliente" class="form-group">
						<label class="text-label">Obs</label>
						<div class="input-group">
							<textarea type="text" id="obs" name="obs" class="form-control" ></textarea>
						</div>
					</div>
				</div>
			</div>
			
			<div style="display:none;" id="quem_executou">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="text-label">Quem está executando:</label>
						<div class="input-group">
							<input type="text" style="width: 100%;height:40px;border: 1px solid #dddfe1; border-radius:5px;" id="quem_executou" name="quem_executou" required></input>
						</div>
					</div>
				</div>
			</div>
			  <div style="display:none;width: 100%;height: 40px;background: #E91E63;text-align: center;color: white;line-height: 40px;font-size: 15px;" class="error_modal_top"></div>
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
			<div class="modal-header" style="background: #9E9E9E;">
			<h2 style="color: #fff;">Detalhes do Agendamento</h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
			</div>
			<div id="modalBody" class="modal-body">
			<div id="modalWhen" style="margin-top:5px;"></div>
			</div>
			<input type="hidden" id="eventID"/>
			<input type="hidden" id="eventFunc"/>
			<div class="modal-footer">
			<button id="comecar" style="display:none;" onclick="alteraStatus('comecar')" class="btn btn-start">Iniciar Serviço</button>
			<button id="finalizar" style="display:none;" onclick="alteraStatus('finalizar')" class="btn btn-close">Finalizar Serviço</button>
			<button type="submit" class="btn btn-danger" id="deleteButton">Deletar</button>
			</div>
		</div>
	</div>
</div>


        <div id="ModalAddInfo" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" style="background: #9E9E9E;">
                    <h2 style="color: #fff;">Adicionar Informação</h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
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
                    <div class="modal-header" style="background: #9E9E9E;">
                    <h2 style="color: #fff;">Alterar Horario </h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
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
	<script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
	<script src="includes/calendario/final_calendar.js"></script>

	<script>
	$('#lista_funcionario_filtro').select2();
	$('.phone').mask('(00) 00000-0009');
	$.datetimepicker.setLocale('pt');
	 jQuery('.datetimepicker_inicio').datetimepicker({
		  format:'d/m/Y H:i',
		  inline:false,
		  todayButton:true,
		  lang:'pt',
		  step: 15,
		  scrollInput: false,
		  defaultTime:'08:00'

	 });
	 
	 jQuery('.datetimepicker_termino').datetimepicker({
		  format:'d/m/Y H:i',
		  inline:false,
		  todayButton:true,
		  lang:'pt',
		  step: 15,
		  scrollInput: false,
		  defaultTime:'17:00'
	 });
	 
	 $('#clientes').select2({
        ajax: {
          url: 'includes/calendario/get_clientes',
          type : 'POST',
		  dataType: 'JSON',
          delay: 10,
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
			markup = 'Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_cliente_modal" >Cadastrar Cliente</a>';
			
		} else {
			endereco = data.street+' nº'+data.number+','+data.neighbor+' - '+data.city;
			$('#obs_adr').val(endereco);
			var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
		}
		return markup;
	}

	$('#lista_funcionario').select2({
        ajax: {
          url: 'includes/calendario/get_funcionarios',
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
		  templateResult: formatfun,
		  templateSelection: formatfun,
      });
	  
	  function formatfun(data) {
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
		console.log(lista_funcionario_filtro);
		$('#calendar_').fullCalendar('refetchEvents');
	});

	

		$('#clientes').on('select2:select', function (e) {
			id_cliente = $('#clientes').val();			
		});

		
		$('#tipo_servico').select2({
		
		ajax: {
          url: 'includes/view/pet/get_services',
          dataType : 'JSON',
          delay: 250,
          processResults: function (data) {
			      return {results: data};
			    },
			    cache: true
			  },
		  templateResult: function(data) {
			return data.short_dec;
		  },
		  templateSelection: function(data) {
			return data.short_dec;
		  },
      });
	  
		$('#tipo_servico').on('select2:select', function (e) {
			tipo_servico = $('#tipo_servico').val();
			
			$("#produto_div").show();
		});
	  
	  $('#produtos').select2({
        ajax: {
          url: 'includes/view/pet/get_products',
          dataType : 'JSON',
          delay: 250,
          processResults: function (data) {
			      return {results: data};
			    },
			    cache: true
			  },
		  templateResult: function(data) {
			return data.desc;
		  },
		  templateSelection: function(data) {
			return data.desc;
		  },
      });
	  
		$('#tipo_servico').on('select2:select', function (e) {
			
			$("#tempo_estimado_div").show();
			$("#preco_div").show();
			
			tipo_servico = $('#tipo_servico').val();
			
			
			$.ajax({
				url:"includes/view/pet/get_specific_service",
				method: "POST",
				dataType : 'JSON',
				data: {tipo_servico:tipo_servico},
				success:function(response){
					var est_time = response.est_time;
					var price = response.price;
					var produto_final = response.produtos;
					
					$('#tempo_estimado').val(est_time);
					$('#preco').val(price);
					$('#produtosss').val(produto_final);
					$('#preco').mask('000.000.000.000.000,00', {reverse: true});
					$('#price_taxi').mask('000.000.000.000.000,00', {reverse: true});
					
				}
			}); 
			
		});

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