<link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
<link href="assets/plugins/fullcalendar/css/scheduler.min.css" rel="stylesheet" />

<?php include('includes/common/check_permission.php'); ?>

<style>
.select2-container .select2-selection--single {height:45px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 43px!important;font-size: 16px;}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {color: #020202!important;line-height: 34px!important;}
.fc-agendaDay-view tr {
    /*height: 85px !important;*/
}

.xdsoft_inline{
	width: 100%;
    padding: 0px;
}

.xdsoft_datepicker{
	width: 100%!important;
    padding: 0px!important;
    margin: 0px!important;
}

/*.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_default, .xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current, .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div.xdsoft_current>div {
    background: #484848;
    box-shadow: none;
    color: #fff;
}*/
.xdsoft_calendar td.xdsoft_current>div {
    background: #2c2f37;
    box-shadow: none;
    color: #fff;
}

.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_default, .xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current, .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div.xdsoft_current {
    background: #fff;
    box-shadow: none;
	color: #fff;
	font-weight: 300;
}

.xdsoft_datetimepicker .xdsoft_calendar td:hover, .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div:hover {
    color: #2c2f37 !important;
    background: transparent!important;
    box-shadow: none !important;
}

.xdsoft_datetimepicker .xdsoft_calendar td, .xdsoft_datetimepicker .xdsoft_calendar th {
	background:#fff;
}


.xdsoft_datetimepicker .xdsoft_calendar th {
    color: #2c2f37;
}

.xdsoft_datetimepicker .xdsoft_calendar td, .xdsoft_datetimepicker .xdsoft_calendar th {
	border:none;
}

.xdsoft_datetimepicker .xdsoft_calendar td, .xdsoft_datetimepicker .xdsoft_calendar th {
	font-size: 13px;
    height: 40px;
}

.xdsoft_datetimepicker .xdsoft_calendar td>div {
	padding-top: 7px;
    border-radius: 50%;
    border: 1px solid #d0d0d0;
    width: 35px;
    height: 35px;
    text-align: center;
    margin: auto;
    padding-left: 5px;
}

.xdsoft_date>div:hover {
    color: #fff !important;
    background: #2c2f37 !important;
    box-shadow: none !important;
}

.xdsoft_datetimepicker .xdsoft_label>.xdsoft_select>div>.xdsoft_option.xdsoft_current {
    background: #2c2f37;
    box-shadow: #2c2f37 0 1px 3px 0 inset;
    color: #fff;
    font-weight: 300;
}

.xdsoft_datetimepicker .xdsoft_label>.xdsoft_select>div>.xdsoft_option:hover {
    color: #fff;
    background: #2c2f37;
}

.xdsoft_datetimepicker{color: #333;padding: 8px;padding-left: 0;padding-top: 2px;position: absolute;z-index: 9999;-moz-box-sizing: border-box;box-sizing: border-box;
	display: none;
}

.xdsoft_datetimepicker{
	border:none;
}

.xdsoft_datetimepicker .xdsoft_year {
	margin-left: 5px;
    background: none;
    width: 65px;
}

.xdsoft_datetimepicker .xdsoft_label>.xdsoft_select.xdsoft_monthselect {
    right: 0px;
    width: inherit;
}

[data-theme-version=dark] .xdsoft_datetimepicker {
    background: #2b2e37;
}

[data-theme-version=dark] .xdsoft_time_box>div>div.xdsoft_current {
    background: #2b2e37;
}

[data-theme-version=dark] .xdsoft_calendar th {
	background: #2b2e37;
	color: #fff;
}

[data-theme-version=dark] .xdsoft_calendar td {
	background: #2b2e37!important;
	color: #fff;
}

[data-theme-version=dark] .xdsoft_datetimepicker .xdsoft_calendar td>div {
    border: 1px solid #ffffff;
}

[data-theme-version=dark] .xdsoft_calendar td.xdsoft_current>div {
    background: #ffffff;
    color: #2b2e37;
}

[data-theme-version=dark] .xdsoft_datetimepicker .xdsoft_month {
    width: 100px;
    text-align: right;
    color: #fff;
    background: #2b2e37;
}

[data-theme-version=dark] .xdsoft_datetimepicker .xdsoft_year {
    width: 65px;
    text-align: right;
    color: #fff;
    background: #2b2e37;
}

[data-theme-version=dark] .xdsoft_datetimepicker .xdsoft_label>.xdsoft_select {
    border: 1px solid #ccc;
    position: absolute;
    right: 0;
    top: 30px;
    z-index: 101;
    display: none;
    background: #2b2e37;
    max-height: 160px;
    overflow-y: hidden;
}

.xdsoft_scrollbar {
    width: 4px;
}

.btn-dark:active, .btn-dark:focus, .btn-dark:hover {
    background: #2f3137!important;
    color: #fff!important;
    border-color: #2f3137!important;
}

#horarios_disponiveis .btn-success {
    background: #b5d8b8;
    border-color: #b5d8b8;
    color: #000;
    width: 65px;
}

.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_today {
    color: #18998d;
}

.modal
{
  overflow: scroll !important;
}
</style>
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
								<div class="event-sideber-search">
									<form action="#" method="post" class="chat-search-form">
										<input id="search_funcionarios" type="search" class="form-control" placeholder="Procurar">
										<i class="fa fa-search"></i>
									</form>
								</div>
							</div>   
							<div class="row" id="list_funcionarios"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>      
	</div>
</div>

	<!-- Modal  to Add Event -->
<div id="createEventModal" class="modal fade" role="dialog">
	 <div class="modal-dialog">
	 <div class="modal-content">
	 	 <form class="form novo_evento" id="validate_evento" role="form" action="javascript:save_event();" >
		 <div class="modal-header">
		 <h4 class="modal-title">Novo Agendamento</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
		 </div>
		 <div class="modal-body">
		 	<div class="row form-group col-12" id="funcionario_avatar">
		</div>

			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Cliente</label>
					<div class="input-group">
						<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="clientes" name="clientes" required></select>
					</div>
				</div>
			</div>
			<input type="hidden" id="id_funcionario" name="id_funcionario" ></input>
			<input type="hidden" id="est_time" name="est_time" ></input>
			<input type="hidden" id="est_hour_min" name="est_hour_min" ></input>
			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Tipo de Serviço</label>
					<div class="input-group">
						<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="my_Services" name="my_Services" required></select>
					</div>
				</div>
			</div>
			<div style="display:none;" id="preco_div">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="text-label">Preço</label>
						<div class="input-group">
							<input class="form-control" type="text" style="width: 100%;height:40px;border-radius:5px;padding-left:5px;" id="preco" name="preco" required></input>
						</div>
					</div>
					
				</div>
			</div>
			
			<div style="padding:10px;display:none;" class="form-groups" id="time_atividade_box" >
				  <div class="row" id="start_funcionario_box" >
					 
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<h3 class="text-label">Escolha a data</h3>
							<input style="cursor:pointer;" readonly required id="startTime" name="startTime" type="text" class="form-control datetimepicker_inicio" >
							<input id="startTime_dummy" name="startTime_dummy" type="hidden" >
						</div>
					</div>
					<div class="col-lg-6 col-md-6" >
						<div id="horarios_disponiveis"></div>
					</div>

					<div  class="col-lg-12 col-md-12">
							<div class="form-group">
							<h3 class="text-label">Encaixe</h3>
								<input style="cursor:pointer;" id="startTimeencaixe" name="startTimeencaixe" type="text" class="form-control dataencaixe" >
							</div>
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
			
			<div class="col-lg-12">
				<div id="endereco_cliente" class="form-group">
					<label class="text-label">Obs</label>
					<div class="input-group">
						<textarea type="text" id="obs" name="obs" class="form-control" ></textarea>
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
			<h2 >Detalhes do Agendamento</h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
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
    </div>
	
    
	<script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>

<script>
toastr.options = {"positionClass": "toast-top-full-width"}
//$('#my_Services').select2();
$.ajax({
	url:"includes/calendario/get_funcionarios",
	method: "POST",
	dataType : 'JSON',
	data: {
		
	},
	success:function(response){
		list_funcionarios = "";
		for (i = 0; i < response.length; i++) {
		list_funcionarios += '<div id="'+response[i].id+'" class="col-sm-4 col-xl-2 ">'+
										'<div id="'+response[i].id+'" class="cards ">'+
											'<div id="'+response[i].id+'" class="card-body ">'+
												'<div id="'+response[i].id+'" class="text-center ">'+
													'<img style="cursor: pointer;" data-foto="'+response[i].foto+'" data-nome="'+response[i].name+'" id="'+response[i].id+'" width="128" height="128" src="'+response[i].foto+'" class="rounded-circle new_booking" alt="">'+
													'<h4 id="'+response[i].id+'" class="mt-4 ">'+response[i].name+'</h4>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>';
		}

		$('#list_funcionarios').html(list_funcionarios)

		$('.new_booking').on('click', function(e){
			e.preventDefault();
			var id = this.id;
			var foto = $(this).attr("data-foto");
			var nome = $(this).attr("data-nome");

			foto_avatar = $(this).data("foto")
			$("#id_funcionario").val(id);
			$('#time_atividade_box').hide();
			$('#horarios_disponiveis').hide();

			$("#my_Services").empty();
			$("#my_Services").val('').trigger('change');
			$("#clientes").empty();
			$("#clientes").val('').trigger('change');
            $("#tempo_estimado").val('');
            $('#obs').val('');
            $('#startTimeencaixe').val('');
            $('#startTime_dummy').val('');
            $('#startTime').val('');
            $('#preco').val('');
            $('#tempo_estimado_div').hide();
            $('#preco_div').hide();
			$('#createEventModal #startTime').val('');
			$('#createEventModal').modal('toggle');
			var func_avatar = '<div class="col-1" style="float: left;">'+
			'<a class="single_link" target="_blank" href="funcionario-'+id+' "><span><img style="width: 50px;height: 50px;" class="avatar_table" src="'+foto+'" alt="Avatar" height="50" width="50"></a>'+
			'</div>'+
			'<div class="col-9" style="margin-left: 21px;">'+
				'<h3>'+nome+'</h3></span><span>Colaborador</span>'+
			'</div>';

			$('#funcionario_avatar').html(func_avatar);
			
			setTimeout(function(){
				get_serv();
			},200)

		}); 
		
	}
});

	jQuery('.dataencaixe').datetimepicker({
		datepicker:false,  
		format:'H:i',

		  inline:false,
		  todayButton:true,
		  lang:'pt',
		  step: 15,
		  scrollInput: false,
		  defaultTime:'07:00'

	 });
	
	$('.phone').mask('(00) 00000-0009');
	$('.startTimeencaixe').mask('00:00');
	$.datetimepicker.setLocale('pt');
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
			var markup = '<span><img style="height:35px;width:35px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
		}
		return markup;
	}
	 
	function get_serv(){
		id_team = $("#id_funcionario").val();
		
		console.log(id_team)
		//SEVICOS HERE
		$('#my_Services').select2({
			ajax: {
			url: 'includes/calendario/get_services?id_team='+id_team+' ',
			data:{id_team:id_team},
			type : 'GET',
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
					o.short_dec = v.short_dec;
					o.foto = v.foto;
					o.get_open_days = v.get_open_days;
					o.est_time = v.est_time;
					o.est_hour_min = v.est_hour_min;
					o.price = v.price;
					results.push(o);

				});

				return {
					results: results
				};
			},
			cache: true
		},
			escapeMarkup: function (markup2) { 
					return markup2;
				},
			minimumInputLength: 0,
			templateResult: formatservice,
			templateSelection: serviceselect,
		});
		
		function formatservice(data2) {
			var markup2 = "";
			if(data2.loading){
				markup2 = "Procurando";
			}
			else if (data2.id == 'none') {
				return 'Nenhum Serviço atribuído <a target="_blank" class="single_link btn btn-primary btn-sm" href="funcionario-'+id_team+'" >Atribuir Serviço</a>';
				return;
				
			} else {

				var descricao = data2.short_dec
				markup2 = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data2.foto+'" class="flag" /> ' + data2.id +' - ' + descricao +' </span>';
				setTimeout(function(){
					
				},200)
				return markup2;
			}
			
		}

		function serviceselect(data2) {
			var markupfunselect = "";
			if(data2.loading){
				markupfunselect = "Procurando";
			}
			else if (data2.id == 'none') {
				return 'Nenhum Serviço atribuído <a target="_blank" class="single_link btn btn-primary btn-sm" href="funcionario-'+id_team+'" >Atribuir Serviço</a>';
				return;
			} else {

				var markupfunselect = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data2.foto+'" class="flag" /> ' + data2.id +' - ' + data2.short_dec +' </span>';

				var per_max = data2.est_time;
				var resultdays = [];

				var agora = moment();
				data_hoje = agora.format("YYYY-MM-DD");
				data_hoje_usa = agora.format("YYYY-MM-DD");

				$('#time_atividade_box').show();
				$('#horarios_disponiveis').show();
				$('#preco').val(data2.price);
				$('#est_time').val(per_max);
				$('#est_hour_min').val(data2.est_hour_min);
				$("#preco_div").show();
				$('#preco').mask('000.000.000.000.000,00', {reverse: true});
				$('#startTime').val(data_hoje);
				

				for(var i in data2.get_open_days){
					resultdays.push(parseInt(i));
				}

				var final_date_usa = data_hoje_usa;	
				jQuery('.datetimepicker_inicio').datetimepicker({
				format:'Y-m-d',
				inline:true,
				todayButton:true,
				timepicker:false,
				scrollMonth:false,
				lang:'pt',
				//step: 15,
				scrollInput: false,
				disabledWeekDays:resultdays,
				onChangeDateTime:function(dp,$input){
					var final_date_usa = $input.val();	
					$('#startTime').val(final_date_usa);
					get_availible_hour(final_date_usa,id_team,per_max);		
				}
				});
				
				setTimeout(function(){
					get_availible_hour(final_date_usa,id_team,per_max,resultdays);
					return;
				},200) 
			}
			
			return markupfunselect;
		}
	}


		$('#clientes').on('select2:select', function (e) {
			id_cliente = $('#clientes').val();			
		});
		$('#my_Services').on('select2:select', function (e) {
			id_my_Services = $('#my_Services').val();			
		});

		function get_availible_hour(final_date_usa,id_team,per_max,resultdays){
			$('#horarios_disponiveis').html('<div style="text-align: center;"><img src="assets/images/30.gif" alt="Loading" ></div>');
			$.ajax({
				url:"includes/calendario/get_availible_time",
				method: "POST",
				dataType : 'JSON',
				data: {
					id_func:id_team,
					per_max:per_max,
					final_date_usa:final_date_usa
				},
				success:function(response){

					status = response.status;
					status_txt = response.status_txt;
					if(status == 'SUCCESS'){
						data = response.data.data;
						var list_horarios_dummy = "";
					
						list_horarios_dummy += '<div><h3>Esolha o Horário</h3></div>'
						for (i = 0; i < data.length; i++) {

						var stat = data[i].status_time;
						if(stat != 'light'){
							btn_state = 'availible';
						} else {
							btn_state = 'disabled';
						}
						list_horarios_dummy += '<button id="'+data[i].time+'"  type="button" class="'+btn_state+' btn btn-sm btn-ft btn-'+data[i].status_time+'" style="margin-right: 5px;margin-bottom: 5px;font-size: 14px!important;">'+data[i].time+'</button>';
						}
						$('#horarios_disponiveis').html(list_horarios_dummy);
						$('.availible').on('click', function(e){
							e.preventDefault();
							var choose_time = this.id;
							$('#horarios_disponiveis button').removeClass('btn-dark');
							$(this).toggleClass('btn-dark');
							$('#startTime_dummy').val(choose_time);
						});
					} else {
						$('#horarios_disponiveis').html('<div style="text-align: center;">Não foi possível encontrar um horário</div>');
					}
					
				}
			}); 
		}

		

	  
		
	  
	  function saveCalendary(){ // add event
         
		 toastr.options = {"positionClass": "toast-top-full-width"}
		 var startTimeencaixe = $('#startTimeencaixe').val();
		 var time = $('#startTime_dummy').val();

		 console.log(time)
		 console.log(startTimeencaixe)
		 
		 if(startTimeencaixe == null || startTimeencaixe == 'null' || startTimeencaixe == ''){
			time = $('#startTime_dummy').val();
		 } else {
			time = $('#startTimeencaixe').val();
			
		 }

		 var date_inicial = $('#startTime').val();
		 var est_time = $('#est_time').val();
		 var durationInMinutes = $('#est_hour_min').val();
		 var timefinal = moment(time, 'HH:mm:ss').add(durationInMinutes, 'minutes').format('HH:mm');
		 startTime = date_inicial+' '+time;
		 endTime = date_inicial+' '+timefinal;
		 var obs_adr = $('#obs_adr').val();
		 var obs = $('#obs').val();
		 var id_funcionario = $('#id_funcionario').val();
		
 
		 
		 
		 var clientes = $('#clientes').val();
		 if(clientes == null){clientes = "";}
		 
		 var my_Services = $('#my_Services').val();
		 if(my_Services == null){my_Services = "";}
		 
		 var tempo_estimado = $('#tempo_estimado').val();
		 if(tempo_estimado == null){tempo_estimado = "";}
		 
		 var preco = $('#preco').val();
		 if(preco == null){preco = "";}
		 
		 if(endTime != ''){} else {
			 toastr.error('Erro!', "Oops, Escolha a data Final!");
			 return;
		 }
 
		 if(clientes != ''){} else {
			 toastr.error('Erro!', "Oops, Escolha o cliente");
			 return;
		 }
 
		 
		 if(my_Services != ''){} else {
			 toastr.error('Erro!', "Oops, Escolha o serviço!");
			 return;
		 }
		 
		 if(preco != ''){} else {
			 toastr.error('Erro!', "Oops, Digite o preço!");
			 return;
		 }

		 if(startTime != ''){ } else {
			 toastr.error('Erro!', "Oops, Escolha a data Inicial!");
			 return;
		 }
		 if(time != ''){ } else {
			 toastr.error('Erro!', "Oops, Escolha o horário disponível!");
			 return;
		 }
		 
		 preco = preco.replace(",", ".");
		 preco = parseFloat(preco).toFixed(2);
		 
		 categoryClass = "#9E9E9E";
 
		$("#createEventModal").modal('hide');
		
		$.ajax({
		 url: "includes/calendario/cadastra_agenda",
		data: {
		 startTime:startTime,
		 endTime:endTime,
		 clientes:clientes,
		 tipo_servico:my_Services,
		 tempo_estimado:tempo_estimado,
		 preco:preco,
		 obs_adr:obs_adr,
		 id_funcionario:id_funcionario,
		 obs:obs,
		},
			type: "POST",
			dataType: 'JSON',
			success: function(response) {
			status = response.status;
			status_message = response.status_txt;

				
			$("#clientes").val('').trigger('change');
			$("#my_Services").val('').trigger('change');
			$("#tempo_estimado").val('');
			$('#obs').val('');
			$('#preco').val('');
			$('#preco_div').hide();
			$('#horarios_disponiveis').html('');
			$('#horarios_disponiveis').hide();
			$('#createEventModal').modal('hide');
		
 
		 toastr.success("Agendamento Cadastrado com Sucesso!", 'Sucesso');
			}
		});
		
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

		$('input[type="search"]').keyup(function(){

			console.log('teste')
    
			var that = this, $allListElements = $('#list_funcionarios div > div > div > div');
			var $matchingListElements = $allListElements.filter(function(i, div){
				var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
				return ~listItemText.indexOf(searchText);
			});
			
			$allListElements.hide();
			$matchingListElements.show();
			
		});



	</script>
	
</body>

</html>