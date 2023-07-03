<div id="createEventModal" class="modal fade" role="dialog" style="padding:0px;">
	 <div class="modal-dialog">

	 <!-- Modal content-->
	 <div class="modal-content">
	 	 <form class="form novo_evento" id="validate_evento" role="form" action="javascript:save_event();" >
		 <div class="modal-header">
		 <h4 class="modal-title">Nova Atividade</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
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
            <div id="ativo_box" style="display:none;">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-label">Ativo </label>
						<div>
							<div class="col-6 form-check mb-2 mr-5">
								<input class="form-check-input styled-checkbox" id="sel_na" type="checkbox" name="sel_na" value="" >
								<label for="sel_na" class="form-check-label check-green ">N/A</label>
							</div>
							<div class="col-6 form-check mb-2 mr-5">
								<input class="form-check-input styled-checkbox" id="sel_all" type="checkbox" name="sel_all" value="" >
								<label for="sel_all" class="form-check-label check-green ">Todos</label>
							</div>
						</div>
                        <div class="input-group">
                            <select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="ativos" name="ativos" required multiple></select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-label">Atividade</label>
                        <div class="input-group">
                            <select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="my_Services" name="my_Services" required></select>
                        </div>
                    </div>
                </div>
				<!--<div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-label">Aeroporto</label>
                        <div class="input-group">
                            <select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="my_aeroporto" name="my_aeroporto" required></select>
                        </div>
                    </div>
                </div>-->
            </div>
			<div class="col-lg-12" style="float: left;">
				<div class="form-group">
					<label class="text-label">Escolha a Prioridade</label>
					<div class="input-group">
						<select class="form-control" id="prioridade" name="prioridade" >
						<option value="Normal">Normal</option>
						<option value="Média">Média</option>
						<option value="Alta">Alta</option>
						</select>
					</div>
				</div>
			</div>

            <input type="hidden" id="id_funcionario" name="id_funcionario" ></input>
			<input type="hidden" id="est_time" name="est_time" ></input>
			<input type="hidden" id="est_hour_min" name="est_hour_min" ></input>
			
			
			<div style="padding:10px;display:none;" class="form-groups" id="time_atividade_box" >
				  <div class="row" id="start_funcionario_box" >
					 
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<h3 class="text-label">Escolha a data</h3>
							<input style="cursor:pointer;" readonly required id="startTime" name="startTime" type="text" class="form-control datetimepicker_inicio" >
							<input id="startTime_dummy" name="startTime_dummy" type="hidden"  >
							<input id="startdate_dummy" name="startdate_dummy" type="hidden" >
						</div>
					</div>
					
					<!--<div  class="col-lg-12 col-md-12">
							<div class="form-group">
							<h3 class="text-label">Horário Duplicado</h3>
								<input style="cursor:pointer;" id="startTimeencaixe" name="startTimeencaixe" type="text" class="form-control dataencaixe" >
							</div>
					</div>-->

					<div class="col-lg-12 col-md-12" style="float: left;">
						<div class="form-group">
							<label>Repetir Atividade</label>
							<div>
								<select style="width: 20%;float:left;margin-right: 5px;" class="form-control" id="repeat_option_days"></select>
								<select style="width:77%;" class="form-control" id="repeat_option_type">
									<option value="days">Dia(s)</option>
									<option value="weeks">Semana(s)</option>
									<option value="months">Mês</option>
								</select>
								<button type="button" onclick="getrepeatcustom()" class="mt-2 mb-2 btn-sm btn btn-success">Calcular</button>
							</div>
							

							<!--<select id="repeat_option" onchange="getrepeat(this);" class="form-control" >
								<option value="0" selected="">Não</option>
								<option value="7">1 Semana</option>
								<option value="14">2 Semanas</option>
								<option value="21">3 Semanas</option>
								<option value="28">4 Semanas</option>
								<option value="outro">Outro</option>
							</select>
							<select id="repeat_option" onchange="getrepeat(this);" class="form-control" >
								<option value="0" selected="">Não</option>
								<option value="7">1 Semana</option>
								<option value="14">2 Semanas</option>
								<option value="21">3 Semanas</option>
								<option value="28">4 Semanas</option>
								<option value="outro">Outro</option>
							</select>
							
							<div class="mt-3" style="display:none;" id="box_outros_horario">
								<label>Digite os dias</label>
								<input id="new_custom_repeat" name="new_custom_repeat" type="text" class="mt-2 form-control" >
								<button type="button" onclick="getrepeatcustom(this)" class="mb-2 btn-sm btn btn-success">Calcular</button>
							</div> -->
						
						</div>

					
						<div class="col-lg-12 col-md-12" style="float: left;">
							<label>Próximas Atividades</label>
							<ul id="extra_date" class="extra_date ">
							</ul>
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

<script>
toastr.options = {"positionClass": "toast-top-full-width"}

$.ajax({
	url:"includes/calendario/get_funcionarios",
	method: "POST",
	dataType : 'JSON',
	data: {
		
	},
	success:function(response){
		list_funcionarios = "";
		for (i = 0; i < response.length; i++) {
		list_funcionarios += '<div id="'+response[i].id+'" class="col-sm-4 col-xl-2 " style="min-width:180px">'+
										'<div id="'+response[i].id+'" class="cards ">'+
											'<div id="'+response[i].id+'" class="card-body ">'+
												'<div id="'+response[i].id+'" class="text-center ">'+
													'<img style="cursor: pointer;" data-foto="'+response[i].foto+'" data-nome="'+response[i].name+'" id="'+response[i].id+'" width="96" height="96" src="'+response[i].foto+'" class="rounded-circle new_booking" alt="">'+
													'<h6 id="'+response[i].id+'" class="mt-4 ">'+response[i].name+'</h6>'+
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
			//$('#time_atividade_box').hide();
			$('#horarios_disponiveis').hide();

			$("#my_Services").empty();
			$("#my_Services").val('').trigger('change');
			//$("#my_aeroporto").empty();
			//$("#my_aeroporto").val('').trigger('change');
			$("#clientes").empty();
			$("#clientes").val('').trigger('change');
            $("#tempo_estimado").val('');
            $('#obs').val('');
            //$('#startTimeencaixe').val('');
            $('#startTime_dummy').val('');
            $('#startdate_dummy').val('');
            $('#startTime').val('');
            $('#preco').val('');
            $('#tempo_estimado_div').hide();
            $('#preco_div').hide();
			$('#createEventModal #startTime').val('');
			$('#createEventModal').modal('toggle');
			var func_avatar = '<div class="col-1" style="float: left;">'+
			'<a target="_blank" href="funcionario-'+id+' "><span><img style="width: 50px;height: 50px;" class="avatar_table" src="'+foto+'" alt="Avatar" height="50" width="50"></a>'+
			'</div>'+
			'<div class="col-9" style="margin-left: 21px;">'+
				'<h3>'+nome+'</h3></span><span>Colaborador</span>'+
			'</div>';

			$('#funcionario_avatar').html(func_avatar);
			
			setTimeout(function(){
				get_serv();
				//get_aeroporto();
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
	//$('.startTimeencaixe').mask('00:00');
	$.datetimepicker.setLocale('pt');
     
    $('#clientes').select2({
        ajax: {
		  url: 'includes/dashboard/get_clientes',
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
			var markup = '<span><img style="height:35px;width:35px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' </span>';
		}
		return markup;
    }

    $('#clientes').on('select2:select', function (e) {
        e.preventDefault();
		 $('#ativos').select2();
         $('#ativo_box').show();
         $('#ativos option:selected').remove();
         $("#ativos").val('').trigger('change');
          id_cliente = $('#clientes').val();

		  var all_ativos = $('#ativos');
			$.ajax({
				type: 'POST',
				dataType : 'JSON',
				url: 'includes/dashboard/get_ativos_from_client?id_cliente='+id_cliente+'',
			}).then(function (data) {
				// create the option and append to Select2
				var option = new Option(data.name, data.id, data.id_service , true, true , true);
				all_ativos.append(option).trigger('change');
				var extra_info_sn = ""; 
				var extra_info_model = ""; 
			

				new_list_ativos = '';
				for (i = 0; i < data.length; i++) {

					if(data[i].sn == "" || data[i].sn == "undefined" || data[i].sn == undefined){
						
					} else {
						extra_info_sn = 'Sn('+data[i].sn+')';
					}

					if(data[i].model == "" || data[i].model == "undefined" || data[i].model == undefined){
						
					} else {
						extra_info_model = 'Model('+data[i].model+')';
					}

					

					new_list_ativos += '<option value="'+data[i].id+'">'+data[i].name+' '+extra_info_sn+' '+extra_info_model+'</option>';
					
					/*if(data[i].name != 'N/A'){
						new_list_ativos += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
					} else {
						new_list_ativos += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
					} */
					
				}

				$('#ativos').html(new_list_ativos);
				$("#sel_all").click(function(){
					if($("#sel_all").is(':checked') ){
						$("#ativos > option").prop("selected","selected");
						$("#ativos").trigger("change");
						//$("#ativos option[value='41']").remove();
						//$("#ativos").trigger("change");

					}else{
						$("#ativos").val('').trigger('change');
					}

					
				});
				
				$("#sel_na").click(function(){
					if($("#sel_na").is(':checked') ){
						$("#ativos").select2("val", $("#ativos option:contains('N/A')").val() );
						$("#ativos").trigger("change");
					}else{
						$("#ativos").val('').trigger('change');
					}

					

				});

				$('#time_atividade_box').show();

				
			});



		 /*function get_ativos(id_cliente){
				console.log('estou no ativo ' +id_cliente )
				
				$('#ativos').select2({
				ajax: {
					url: 'includes/dashboard/get_ativos_from_client?id_cliente='+id_cliente+'',
					type : 'POST',
					dataType : 'JSON',
					delay: 300,
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
							o.name = v.name;
							o.foto = v.foto;
								results.push(o);
						});
						return {results: results};
				},
				cache: true
				},
				escapeMarkup: function (markuppet) { 
					return markuppet;
				},
				minimumInputLength: 0,
				templateResult: formatativoresult,
				templateSelection: formatativosel,
				});
		
		} */
          
          
    });

    function formatativoresult(data) {
        var markuppet = "";
		if(data.loading){
			markuppet = "Procurando";
		} else if (data.id == undefined) {
			markuppet = '<span>Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_pet_modal" >Cadastrar</a></span>';
			return
		} else {
			var markuppet = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> <strong>'+ data.name +'</strong> </span>';
		}
		return markuppet;
	}
	function formatativosel(data) {
		var markuppetsel = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> '+ data.name +'</span>';
		return markuppetsel;
	}
    

				var per_max = 0;
				var resultdays = [];

				var agora = moment();
				data_hoje = agora.format("YYYY-MM-DD");
				data_hoje_usa = agora.format("YYYY-MM-DD");

				
				$('#horarios_disponiveis').show();
				$('#est_time').val(per_max);
				$('#est_hour_min').val('1');
				$("#preco_div").show();
				//$('#preco').mask('000.000.000.000.000,00', {reverse: true});
				//$('#startTime').val(data_hoje);
				

				/*for(var i in data2.get_open_days){
					resultdays.push(parseInt(i));
				} */

				var final_date_usa = data_hoje_usa + ' 07:00';	
				$('#startTime').val(final_date_usa);
				
				
				jQuery('.datetimepicker_inicio').datetimepicker({
				format:'Y-m-d H:i',
				defaultTime:'07:00',
				inline:true,
				todayButton:true,
				timepicker:true,
				scrollMonth:false,
				lang:'pt',
				step: 15,
				scrollInput: false,
				minDate:0,
				//disabledWeekDays:resultdays,
				
				onChangeDateTime:function(dp,$input){
					var final_date_usa = $input.val();	

					startTime_dummy = final_date_usa.split(" ");
					startTime_dummy = startTime_dummy[1];
					

					//$('#startTime').val(final_date_usa);
					//get_availible_hour(final_date_usa,id_team,per_max);	

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

					$('#startTime_dummy').val(startTime_dummy);
					$('#endTime').val(hora_final);
				}
				});
    
	 
	function get_serv(){
		id_team = $("#id_funcionario").val();
		//SEVICOS HERE
		$('#my_Services').select2({
			ajax: {
			url: 'includes/dashboard/get_services?id_team='+id_team+' ',
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
				return 'Nenhum Serviço atribuído <a target="_blank" class="btn btn-primary btn-sm" href="funcionario-'+id_team+'" >Atribuir Serviço</a>';
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
				return 'Nenhum Serviço atribuído <a target="_blank" class="btn btn-primary btn-sm" href="funcionario-'+id_team+'" >Atribuir Serviço</a>';
				return;
			} else {

				var markupfunselect = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data2.foto+'" class="flag" /> ' + data2.id +' - ' + data2.short_dec +' </span>';

				var per_max = data2.est_time;
				var resultdays = [];

				/*var agora = moment();
				data_hoje = agora.format("YYYY-MM-DD");
				data_hoje_usa = agora.format("YYYY-MM-DD");

				$('#time_atividade_box').show();
				$('#horarios_disponiveis').show();
				$('#est_time').val(per_max);
				$('#est_hour_min').val(data2.est_hour_min);
				$("#preco_div").show();
				//$('#preco').mask('000.000.000.000.000,00', {reverse: true});
				//$('#startTime').val(data_hoje);
				

				//for(var i in data2.get_open_days){
				//	resultdays.push(parseInt(i));
				//}
				var final_date_usa = data_hoje_usa + ' 07:00';	
				$('#startTime').val(final_date_usa);
				
				
				jQuery('.datetimepicker_inicio').datetimepicker({
				format:'Y-m-d H:i',
				defaultTime:'07:00',
				inline:true,
				todayButton:true,
				timepicker:true,
				scrollMonth:false,
				lang:'pt',
				step: 15,
				scrollInput: false,
				minDate:0,
				//disabledWeekDays:resultdays,
				
				onChangeDateTime:function(dp,$input){
					var final_date_usa = $input.val();	

					startTime_dummy = final_date_usa.split(" ");
					startTime_dummy = startTime_dummy[1];
					

					//$('#startTime').val(final_date_usa);
					//get_availible_hour(final_date_usa,id_team,per_max);	

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

					$('#startTime_dummy').val(startTime_dummy);
					$('#endTime').val(hora_final);
				}
				}); */
				
				setTimeout(function(){
					//get_availible_hour(final_date_usa,id_team,per_max,resultdays);
					//return;
				},200) 
			}
			
			return markupfunselect;
		}
	}

	function get_aeroporto(){
		//SEVICOS HERE
		$('#my_aeroporto').select2({
			ajax: {
			url: 'includes/dashboard/get_aeroportos',
			data:{},
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
					o.short_dec = v.aeroporto;
					o.iata = v.iata;
					o.icao = v.icao;
					o.cidade = v.cidade;
					o.foto = "images/nouser.png";
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
			templateSelection: formatservice,
		});
		
		function formatservice(data2) {
			var markup2 = "";
			if(data2.loading){
				markup2 = "Procurando";
			}
			else if (data2.id == 'none') {
				return 'Nenhum Serviço atribuído <a target="_blank" class="btn btn-primary btn-sm" href="funcionario-'+id_team+'" >Atribuir Serviço</a>';
				return;
				
			} else {

				var descricao = data2.short_dec
				markup2 = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data2.foto+'" class="flag" /> ' + data2.iata +' - ' + descricao +' </span>';
				setTimeout(function(){
					
				},200)
				return markup2;
			}
			
		}

		
	}



		$('#clientes').on('select2:select', function (e) {
			id_cliente = $('#clientes').val();			
		});
		$('#my_Services').on('select2:select', function (e) {
			id_my_Services = $('#my_Services').val();			
		});
		$('#my_aeroporto').on('select2:select', function (e) {
			id_my_aeroporto = $('#my_aeroporto').val();			
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
						list_horarios_dummy += '<button id="'+data[i].time+'"  type="button" class="'+btn_state+' btn btn-sm btn-ft btn-'+data[i].status_time+'" style="margin-right: 5px;margin-bottom: 5px;font-size: 14px!important;min-width: 65px;">'+data[i].time+'</button>';
						}
						$('#horarios_disponiveis').html(list_horarios_dummy);
						$('.availible').on('click', function(e){
							e.preventDefault();
							var choose_time = this.id;
							$('#horarios_disponiveis button').removeClass('btn-dark');
							$(this).toggleClass('btn-dark');
							$('#startTime_dummy').val(choose_time);
							choose_date = $('#startTime').val();
							var min_to_sum = parseInt($('#est_hour_min').val());
							var date1 = new Date(choose_date);
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

						});
					} else {
						$('#horarios_disponiveis').html('<div style="text-align: center;">Não foi possível encontrar um horário</div>');
					}
					
				}
			}); 
		}

		$('#repeat_option').on('change', function() {
			var check_value = this.value;
			if(check_value == 'outro'){
				$('#box_outros_horario').show();
			} else {
				$('#data_inicial').hide();
				$('#data_final').val('');
			} 
		});
		create_days_repeat();
		function create_days_repeat(){
			var repeatdays = "";
			repeatdays += '<option value="0">Não</option>';
			for (var i = 1; i <= 31; i++) {
				repeatdays += '<option value="'+i+'">'+i+'</option>';
			}
			$('#repeat_option_days').html(repeatdays);
		}


		function getrepeatcustom(choose){
			var extras = "";
			var day = "";
			var new_date = "";
			var repeat_option_days = $('#repeat_option_days').val();
			var repeat_option_type = $('#repeat_option_type').val();
			
			console.log(repeat_option_days)
			console.log(repeat_option_type)

			/*if(repeat_option_type == 'weeks'){
				repeat_option_type = 'days';
				repeat_option_days = repeat_option_days;

			} */
			
			var choose_date = $('#startTime').val();
			var hora_inicial = $('#startTime_dummy').val();

			choose_date = choose_date.split("-");
			choose_date = choose_date[2]+'/'+choose_date[1]+'/'+choose_date[0];

			var time = hora_inicial;


			var durationInMinutes = $('#est_hour_min').val();
			var endTime = moment(hora_inicial, 'HH:mm:ss').add(durationInMinutes, 'minutes').format('HH:mm');
			//let id = choose.id;
			//let value = choose.value;

			

			

			for (var i = 1; i <= repeat_option_days; i++) {

				//day = new_date.add(i, 'days').format('DD/MM/YYYY');
				var days = i;
				if(repeat_option_type == 'weeks'){
					days = days * 7;
				}
				
				if(repeat_option_type == 'months'){
					days = (days * 30) + 1;
				}

				
				new_date = moment(choose_date, "DD/MM/YYYY");

				console.log(days)
				
				var current_date = new_date.add(days, 'days').format('DD/MM/YYYY');
				
				extras += '<li id="'+new_date.add(days, 'days').format('DD/MM/YYYY')+'" value="'+hora_inicial+'|'+endTime+'" ><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> '+current_date+' <span style="font-size:13px;font-weight: 700;">'+hora_inicial+' ás '+endTime+'</span></a></li>';
			}

			$('#extra_date').html(extras);
		
	
	   }

		function getrepeat(choose){

	
		var choose_date = $('#startTime').val();
		var hora_inicial = $('#startTime_dummy').val();

		choose_date = choose_date.split("-");
		choose_date = choose_date[2]+'/'+choose_date[1]+'/'+choose_date[0];

		var time = hora_inicial;

		/* if(startTimeencaixe == null || startTimeencaixe == 'null' || startTimeencaixe == ''){
			time = $('#startTime_dummy').val();
		 } else {
			time = $('#startTimeencaixe').val();
			
		 } */

		var durationInMinutes = $('#est_hour_min').val();
		var endTime = moment(hora_inicial, 'HH:mm:ss').add(durationInMinutes, 'minutes').format('HH:mm');
		let id = choose.id;
		let value = choose.value;

		
		var new_date1 = moment(choose_date, "DD/MM/YYYY");
		var new_date2 = moment(choose_date, "DD/MM/YYYY");
		var new_date3 = moment(choose_date, "DD/MM/YYYY");
		var new_date4 = moment(choose_date, "DD/MM/YYYY");

		 console.log(new_date1)
		 console.log(new_date2)


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

		var choose_date = $('#startTime').val();
		var hora_inicial = $('#startTime_dummy').val();

		choose_date = choose_date.split("-");
		choose_date = choose_date[2]+'/'+choose_date[1]+'/'+choose_date[0];

		var time = hora_inicial;

		 if(startTimeencaixe == null || startTimeencaixe == 'null' || startTimeencaixe == ''){
			time = $('#startTime_dummy').val();
		 } else {
			time = $('#startTimeencaixe').val();
			
		 }

		var durationInMinutes = $('#est_hour_min').val();
		var endTime = moment(hora_inicial, 'HH:mm:ss').add(durationInMinutes, 'minutes').format('HH:mm');
		
		
		let value = choose;

		var new_date1 = moment(choose_date, "DD/MM/YYYY");
		var new_date2 = moment(choose_date, "DD/MM/YYYY");
		var new_date3 = moment(choose_date, "DD/MM/YYYY");
		var new_date4 = moment(choose_date, "DD/MM/YYYY");

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
		

	  
		
	  
	  function saveCalendary(){ // add event
         
		 toastr.options = {"positionClass": "toast-top-full-width"}
		 var startTimeencaixe = $('#startTimeencaixe').val();
		 var time = $('#startTime_dummy').val();

		 
		 if(startTimeencaixe == null || startTimeencaixe == 'null' || startTimeencaixe == ''){
			time = $('#startTime_dummy').val();
		 } else {
			time = $('#startTimeencaixe').val();
			
		 }

		 var date_inicial = $('#startTime').val();
		 
		 var est_time = $('#est_time').val();
		 var durationInMinutes = $('#est_hour_min').val();
		 var timefinal = moment(time, 'HH:mm:ss').add(durationInMinutes, 'minutes').format('HH:mm');
		 
		 startTime = date_inicial;

		 startDate_dummy = date_inicial.split(" ");
		 startDate_dummy = startDate_dummy[0];
		 
		 endTime = startDate_dummy+' '+timefinal;
		 var obs_adr = $('#obs_adr').val();
		 var obs = $('#obs').val();
		 var id_funcionario = $('#id_funcionario').val();
		 var ativo = $('#ativos').val();

		 var repeat_option = $('#repeat_option_days').val();
		 console.log(repeat_option)
         var has_multiple = [];

		 if(repeat_option > 0){
            $('#extra_date li').each(function() {
                has_multiple.push($(this)[0].outerText);
              })
        } 

		var prioridade = $('#prioridade').val();
		
		
		
		 
		 var clientes = $('#clientes').val();
		 if(clientes == null){clientes = "";}
		 
		 var my_Services = $('#my_Services').val();
		 if(my_Services == null){my_Services = "";}
		 
		 /*var my_aeroporto = $('#my_aeroporto').val();
		 if(my_aeroporto == null){my_aeroporto = "";}*/
		 
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
 
		 
		 /*if(my_Services != ''){} else {
			 toastr.error('Erro!', "Oops, Escolha o serviço!");
			 return;
		 }*/
		 
		
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
		 url: "includes/dashboard/cadastra_agenda_air",
		data: {
		 startTime:startTime,
		 endTime:endTime,
		 clientes:clientes,
		 tipo_servico:my_Services,
		 //aeroporto:my_aeroporto,
		 tempo_estimado:tempo_estimado,
		 preco:preco,
		 obs_adr:obs_adr,
		 id_funcionario:id_funcionario,
		 obs:obs,
		 ativo:ativo,
		 has_multiple:has_multiple,
		 prioridade:prioridade,
		},
			type: "POST",
			dataType: 'JSON',
			success: function(response) {
			status = response.status;
			status_message = response.status_txt;
	
			$("#clientes").val('').trigger('change');
			$("#my_Services").val('').trigger('change');
			$("#my_aeroporto").val('').trigger('change');
			$("#ativos").val('').trigger('change');
			$("#tempo_estimado").val('');
			$('#obs').val('');
			$('#preco').val('');
			$('#preco_div').hide();
			$('#horarios_disponiveis').html('');
			$('#horarios_disponiveis').hide();
			$('#createEventModal').modal('hide');
			$("#sel_all").prop("checked", false);
            get_open_service();
            get_valores();
 
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
			var that = this, $allListElements = $('#list_funcionarios div > div > div > div');
			var $matchingListElements = $allListElements.filter(function(i, div){
				var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
				return ~listItemText.indexOf(searchText);
			});
			$allListElements.hide();
			$matchingListElements.show();
			
		});



	
	</script>