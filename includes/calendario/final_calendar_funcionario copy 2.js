$(document).ready(function(){
	
	toastr.options = {"positionClass": "toast-top-full-width"}
    var scrollTime = moment().format("HH:mm:ss");
    var scrollTime = moment().format("HH") + ":00:00";


    var calendar = $('#calendar_').fullCalendar({ 
       
       
        handleWindowResize: true,
        height: $(window).height(),   
        eventLimit: true,
        height: $(window).height() - 250,  
		selectable: true,
       

        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        ignoreTimezone: false,
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
        dayNamesShort: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],


        selectConstraint: "businessHours",
        aspectRatio: 1.8,
        minTime: '07:00',
        maxTime: '23:59',

       
        defaultView: 'agendaDay',
		editable: true,
		selectable: true,
		allDaySlot: false,
		timeslotsPerHour: 4,
		axisFormat: 'HH:mm',
        timeFormat: 'HH:mm',
        slotLabelFormat:"HH:mm",
		slotDuration : "00:15",
        firstHour: 6,
		scrollTime : scrollTime,
		nowIndicator: true,
   		now: new Date(),
       
       
		buttonText: {
			prev: "anterior",
			next: "próximo",
			prevYear: "ano passado",
			nextYear: "próxiimo ano",
			today: "Hoje",
			month: "Mês",
			week: "Semana",
            day: "Dia",
            agendaDay: "Hoje",
            timelineDay: 'TimeLine',
            listWeek: 'Resumo'
		}	,	
        header:{
            left: 'prev,next today',
            center: 'title',
            //right: 'month,agendaWeek,agendaDay',
            right: 'month,agendaDay,timelineDay,agendaWeek,listWeek'
        },
        views:{
			week:{
			  timeFormat: 'HH:mm' //this will return 23:00 time format
			   },
			   groupByResource: true
        },
       
        /*views: {
            agendaWeek: {
                type: 'agendaDay',
                duration: { days: 1 },
                // views that are more than a day will NOT do this behavior by default
                // so, we need to explicitly enable it
                groupByResource: true
                //// uncomment this line to group by day FIRST with resources underneath
                //groupByDateAndResource: true
            },
            
        }, */

		events: {
            url: "includes/calendario/get_eventos_funcionarios",
            type: 'GET',
            data: function() {
                return {
                    lista_funcionario: $("#lista_funcionario_filtro").val(),

                };
            },
        },
        resourceColumns: [
            {
                labelText: 'Colaboradores',
                field: 'title',
                width: 150
  
            }
            // other columns...
          ],
		resources: {
            url: "includes/calendario/get_funcionarios_filtro_resource",
            type: 'GET',
            data: function() {
                return {
                    lista_funcionario: $("#lista_funcionario_filtro").val(),

                };
            },
           
        },
        resourceRender: function(resourceObj,labelTds, bodyTds) {

            let imageStyles= "background:url('"+resourceObj.foto+"') left center no-repeat;\
                border-radius:50%;\
                width: 30px;\
                height: 30px;\
                margin-right:5px;\
                display: inline-block;margin: 5px;background-size: cover;"
            let elStyles = "display: flex;"
            labelTds.html('<div style="'+elStyles+'">\
                      <div style="'+imageStyles+'">\
                      	</div><div style="line-height:40px;"><a style="color:#fff;" target="_blank" href="funcionario-'+resourceObj.id+' ">'+resourceObj.title+'</a></div>\
                    </div>')
          },
		eventRender: function( event, element, view ) {
			var title = element.find('.fc-title, .fc-list-item-title');          
            title.html(title.text());

            element.find(".fc-content").css('padding-left','20px');
            element.find(".fc-content").after($("<div class=\"fc-avatar-image\"></div>").html('<img src=\''+event.foto_cliente+'\' />'));

            $('.fc-scroller').css('overflow','visible');


            /*element.popover({
                title:    '<div class="popoverTitleCalendar" style="background-color:'+ event.title +'; color:'+ event.title +'">'+ event.title +'</div>',
                content:  '<div class="popoverInfoCalendar">' +
                          '<p><strong>Calendar:</strong> ' + event.title + '</p>' +
                          '<p><strong>Username:</strong> ' + event.title + '</p>' +
                          '<p><strong>Event Type:</strong> ' + event.title + '</p>' +
                          '<p><strong>Event Time:</strong> ' + title + '</p>' +
                          '<div class="popoverDescCalendar"><strong>Description:</strong> '+ event.title +'</div>' +
                          '</div>',
                delay: { 
                   show: "800", 
                   hide: "50"
                },
                trigger: 'hover',
                placement: 'top',
                html: true,
                container: 'body'
              }); */

        },

        
      
        eventClick:  function(event, jsEvent, view) {  // when some one click on any event

        var id, id_client , start , end , status_, title
        
        id = event.id;
        id_client = event.id_client;
		title = event.desc_service;
        start = event.start;
        end = event.end;
        status_ = event.status_;
		br_start = event.br_start;
		termina = event.termina;
		name_client = event.name_client;
		preco = event.preco;
		started_at = event.started_at;
		ended_at = event.ended_at;
		quem_executou = event.quem_executou;
		produtos = event.produtos;
		foto_funcionario = event.foto_funcionario;
		foto_ativo = event.foto_ativo;
		nome_funcionario = event.nome_funcionario;
		id_funcionario = event.id_funcionario;
		id_ativo = event.id_ativo;
		ativo = event.ativo;
		info_extra = event.info_extra;
		Info_list = event.Info_list;
		func_list = event.func_list;
        start_dateReage = event.start_dateReage;
        est_time = event.est_time;
        valor_frete = event.valor_frete;
		category = event.category;
        price_taxi = event.price_taxi;
        prioridade = event.prioridade;
        id_form = event.id_form;
        
        pet_taxi = event.pet_taxi;
        endereco = event.endereco;
        foto_cliente = event.foto_cliente;

        if(pet_taxi == 1){
            tem_taxi = 'Sim <strong>[' + 'R$'+price_taxi+']</strong>';
            end_taxi ='<span>'+endereco+'</span>'
        } else {
            tem_taxi = 'Não';
            end_taxi = '';
        }

		var informacao_adicional = "";

        if (info_extra == "") {
            informacao_adicional = Info_list;
        }else{
            informacao_adicional = '<span >'+info_extra+'</span>'+Info_list+'';
        }
		 
		if(produtos == false){
			produtos = "-";
        }
		
		if(nome_funcionario != null){
			nome_funcionario = nome_funcionario
        } else {
			nome_funcionario = 'N/A';
		}
        
		
		termina = termina.split(" ");
		termina_hora = termina[1];
		termina_data = termina[0];
		
		termina_data = termina_data.split("-");
		termina_data = (termina_data[2] + "/" + termina_data[1] + "/" + termina_data[0]);
		termina_final = termina_data + " " + termina_hora;
		
		started_at = started_at.split(" ");
		started_hora = started_at[1];
		started_data = started_at[0];
		
		started_data = started_data.split("-");
		started_data = (started_data[2] + "/" + started_data[1] + "/" + started_data[0]);
		started_data_final = started_data + " " + started_hora;
		
		ended_at = ended_at.split(" ");
		ended_hora = ended_at[1];
		ended_data = ended_at[0];
		
		ended_data = ended_data.split("-");
		ended_data = (ended_data[2] + "/" + ended_data[1] + "/" + ended_data[0]);
		ended_final = ended_data + " " + ended_hora;
		
		br_start_dummy = br_start.split(" ");
        br_start_hora = br_start_dummy[1];
        
        var event_content = "";
        var cancel_btn = "";
        $('#time_est_edit').val(est_time);
		
		if(quem_executou == null){
			quem_executou = "";
        }
        
       
        var edit_pet  = "", edit_client = "" , edit_funcionario = "" , edit_servico = "", edit_valor = "" , edit_pet_taxi = "" , edit_endereco = "" , edit_info_adicional = "" , edit_prioridade = "";

        if(status_ == "Pendente"){
			$('#comecar').show();
			$('#finalizar').hide();
			cancel_btn = '<button id="editarservice_open" style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;color:#000;" class="btn btn-light">Reagendar</button><button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;border-color: #F44336;" type="submit" class="btn btn-danger calncelserico" id="calncelserico" >Cancelar Serviço</button><button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #222222;color: #fff;border-color: #222222;" type="submit" class="btn btn-danger delete_service" id="delete_service" >Deletar Serviço</button>';

            edit_pet = '<i class="edit_pet icon-pencil f-s-16"></i>';
            edit_prioridade = '<i class="edit_prioridade icon-pencil f-s-16"></i>';
            edit_client = '<i class="edit_client icon-pencil f-s-16"></i>';
            edit_funcionario = '<i class="edit_funcionario icon-pencil f-s-16"></i>';
            edit_servico = '<i class="edit_servico icon-pencil f-s-16"></i>';
            edit_valor = '<i class="edit_valor icon-pencil f-s-16"></i>';
            edit_pet_taxi = '<i class="edit_pet_taxi icon-pencil f-s-16"></i>';
            edit_endereco = '';
            edit_info_adicional = '<i class="edit_info_adicional icon-pencil f-s-16"></i>';
			
		}
		else if(status_ == "Em Andamento"){
			$('#finalizar').show();
			$('#comecar').hide();
            cancel_btn = '<button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;border-color: #F44336;" type="submit" class="btn btn-danger calncelserico" id="calncelserico" >Cancelar Serviço</button>';
            $('#concluido').hide();
			$('#reprovar').hide();
		
		}
		else if(status_ == "Cancelado"){
			cancel_btn = '<button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;" class="btn " >Cancelado</button>';
			$('#comecar').hide();
            $('#finalizar').hide();
            $('#concluido').hide();
			$('#reprovar').hide();
		
        } else if(status_ == "Finalizado"){
			cancel_btn = '<button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;" class="btn " >Cancelado</button>';
			$('#comecar').hide();
			$('#finalizar').hide();
			$('#concluido').show();
			$('#reprovar').show();
		
        } else if(status_ == "Concluído"){
			
			$('#comecar').hide();
			$('#finalizar').hide();
			$('#concluido').hide();
			$('#reprovar').hide();
		
        } else {
			$('#comecar').hide();
			$('#finalizar').hide();
		}
			
		event_content = `<div class="profile-personal-info">
		<h3 class="mb-5"><strong>Data</strong>
		<span><strong>`+br_start+`</strong>
		`+cancel_btn+`
		</span></h3>
		<span><a href="atividade-`+id+`-`+id_form+` " ><h2 style="margin-bottom: 45px;">Serviço: `+title+`</h2></a></span>
		
		<div style="display:none;" class="form-group" id="time_atividade_box_edit" >
				<div class="row" id="start_funcionario_box" style="font-weight:700;">
					
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<span>Início</span>
							<input style="cursor:pointer;" readonly required id="startTime_edit" name="startTime_edit" type="text" class="form-control datetimepicker_inicio" placeholder="Hora Início ">
							<input id="startTime_dummy_edit" name="startTime_dummy_edit" type="hidden" >
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<span>Termino</span>
							<input style="cursor:pointer;" readonly required id="endTime_edit" name="endTime_edit" type="text" class="timepicker_ form-control datetimepicker_termino" placeholder="Hora Fim ">
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group" style="margin-top:20px">
							<button style="width:100%;background: #a8cfb8;color: #074822;" id="editar_servico"  class="save_edit btn">Salvar</button>
						</div>
					</div>
				</div>
			</div>
        
        <div class="row mb-4">
            <div class="col-4">
				<h5 class="f-w-500"><strong>Ativo/Equipamento </strong> `+edit_pet+` <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8" id="name_pet_edit"><a target="_blank" href="barco-`+id_ativo+`"><span  ><img class="avatar_table" src="`+foto_ativo+`" alt="Avatar" height="30" width="30"></a><span><strong>` +ativo+`</strong></span>[`+category+`] </span>
			</div>
		</div>    
        <div class="row mb-4">
            <div class="col-4">
				<h5 class="f-w-500"><strong>Prioridade </strong> `+edit_prioridade+` <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8" id="prioridade_edit"><span>` +prioridade+`</span>
			</div>
		</div>    

		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Cliente</strong> `+edit_client+` <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8" id="name_client_edit" ><a target="_blank" href="cliente-`+id_client+`"><span><img class="avatar_table" src="`+foto_cliente+`" alt="Avatar" height="30" width="30"></a><span style="margin-right: 10px;">` +name_client+`</span></span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Funcionário</strong> `+edit_funcionario+` <span class="pull-right">:</span></h5>
			</div>
			<div style="margin-left: 10px;" id="name_funcionario_edit">`+func_list+`</div>
			
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Serviço</strong> `+edit_servico+`<span class="pull-right">:</span></h5>
			</div>
			<div class="col-8" ><span id="servico_name_edit">`+title+`</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Hora Inicio</strong> <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span style="font-weight: 600;">`+br_start_hora+`</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Hora Fim</strong> <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span style="font-weight: 600;">`+termina_hora+`</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Valor</strong> `+edit_valor+`<span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span style="font-weight: 600;">R$`+preco+`</span>
			</div>
		</div>
		<div style="display:none;" class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Começou ás</strong> <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span>`+started_data_final+`</span>
			</div>
		</div>
		<div style="display:none;" class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Terminou ás</strong> <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span>`+ended_final+`</span>
			</div>
		</div> 
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Executado por:</strong> <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span>`+quem_executou+`</span>
			</div>
        </div>
        <div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong> Transporte:</strong> `+edit_pet_taxi+` <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span id="pet_taxi_edit">`+tem_taxi+`  </span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Endereço:</strong>  `+edit_endereco+` <span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span id="pet_endereco_edit" >`+end_taxi+`</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<h5 class="f-w-500"><strong>Informações Adicionais:</strong> `+edit_info_adicional+`<span class="pull-right">:</span></h5>
			</div>
			<div class="col-8"><span id="info_adicional_edit" >`+info_extra+`: </span>
			</div>
		</div>
	</div>`

    
    if(status_ == 'Finalizado'){
			
	  
		endtime = $.fullCalendar.moment(event.end).format('HH:mm');
		starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
		var mywhen = starttime + ' - ' + endtime;
		$('#modalTitle').html(title);
		$('#modalWhen').html(event_content);
		$('#eventID').val(id);
		$('#eventFunc').val(id_funcionario);
		$('#calendarModal').modal();
		$('#editarservice_open').hide();
	
	} 
	else if(status_ == 'Cancelado'){
		endtime = $.fullCalendar.moment(event.end).format('h:mm');
		starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
		var mywhen = starttime + ' - ' + endtime;
		$('#modalTitle').html(title);
		$('#modalWhen').html(event_content);
		$('#eventID').val(id);
		$('#eventFunc').val(id_funcionario);
		$('#calendarModal').modal();
		$('#editarservice_open').hide();
	} 
	else {

		endtime = $.fullCalendar.moment(event.end).format('h:mm');
		starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
		var mywhen = starttime + ' - ' + endtime;
		$('#modalTitle').html(title);
		$('#modalWhen').html(event_content);
		$('#eventID').val(id);
		$('#eventFunc').val(id_funcionario);
		$('#calendarModal').modal();
		$('#editarservice_open').show();
		
	}

	$('#editarservice_open').on('click', function(e){ 
		e.preventDefault();
		edit_time(); //send data to delete function
	});

	$('.calncelserico').on('click', function(e){ 
		e.preventDefault();
		doCancel(); 
    });
    
    $('.delete_service').on('click', function(e){ 
		e.preventDefault();
		doDelete(); 
    });

    $('.edit_pet').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();

        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Ativo/Equipamento </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Ativo/Equipamento</label>'+
                    '<div class="input-group">'+
                        '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente_edit" name="pet_cliente_edit" required></select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        $('#pet_cliente_edit').select2({
			ajax: {
				url: 'includes/calendario/get_ativos_from_client?id_cliente='+id_client+'',
				type : 'POST',
				dataType : 'JSON',
				delay: 600,
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

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var choose_pet = $('#pet_cliente_edit').select2('data');
                
                if(choose_pet.length == 0 ){
                    toastr.error('Ops!Escolha o Ativo', 'Error');  
                    return;
                }
                
                let id_event = $('#id_edit').val();
                let name = choose_pet[0].name;
                let foto = choose_pet[0].foto;
                let id = choose_pet[0].id;
                var campo = 'id_pet';
                var valor_campo = id;
                var interface = 'name_pet_edit';
                var valor_interface = '<a target="_blank" href="barco-'+valor_campo+'"><span><img class="avatar_table" src="'+foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name+'</strong></span>';
                var database = 'tb_book_detail';
               
               
               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });


    $('.edit_client').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Cliente </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                
                '<div class="col-lg-12">'+
                    '<div class="form-group">'+
                        '<label class="text-label">Cliente</label>'+
                        '<div class="input-group">'+
                            '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="cliente_edit" name="cliente_edit" required></select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                
                '<div class="col-lg-12">'+
                    '<div class="form-group">'+
                        '<label class="text-label">Ativo/Equipamento</label>'+
                        '<div class="input-group">'+
                            '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente_edit" name="pet_cliente_edit" required></select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<input type="hidden" id="id_edit" value="'+id+'" />'+
                '</div>'+

            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $('#pet_cliente_edit').select2();

        $('#cliente_edit').select2({
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
                            o.name_bolt = v.name_bolt;
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
        
        
        $('#cliente_edit').on('select2:select', function (e) {
          
                id_cliente = $('#cliente_edit').val();
                $('#pet_cliente_edit').select2({
                ajax: {
                    url: 'includes/calendario/get_ativos_from_client?id_cliente='+id_cliente+'',
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
        
        $('.update_event').on('click', function(e){ 
            e.preventDefault();

            var choose_pet = $('#pet_cliente_edit').select2('data');
            var choose_client = $('#cliente_edit').select2('data');
            let id_event = $('#id_edit').val();

            if(choose_client.length == 0){
                toastr.error('Ops!Escolha o cliente', 'Error');  
                return;
            } else if(choose_pet.length == 0 ){
                toastr.error('Ops!Escolha o Ativo', 'Error');  
                return;
            }
            
            
            let name_client = choose_client[0].name;
            let foto_client = choose_client[0].foto;
            let id_client = choose_client[0].id;
            var campo_client = 'id_client';
            var valor_campo_client = id_client;
            var interface_client = 'name_client_edit';
            var valor_interface_client = '<a target="_blank" href="cliente-'+valor_campo+'"><span><img class="avatar_table" src="'+foto_client+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name_client+'</strong></span>';
            var database_client = 'tb_booking';

            let name = choose_pet[0].name;
            let foto = choose_pet[0].foto;
            let id = choose_pet[0].id;
            var campo = 'id_ativo';
            var valor_campo = id;
            var interface = 'name_pet_edit';
            var valor_interface = '<a target="_blank" href="barco-'+valor_campo+'"><span><img class="avatar_table" src="'+foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name+'</strong></span>';
            var database = 'tb_book_detail';
                
            if(id_client != ''){
                if(valor_campo != ''){ } else {
                    toastr.error('Erro!', "Oops, escolha a opção!");
                    return;
                }
        
                information = '<div class="user-info">'+
                                '<div class="detail">'+
                                    '<h4><strong>Confirmação</strong></h4>'+
                                    '<h5>Você deseja realmente editar?</h5>'+
                                '</div>'+
                            '</div>';
            
                        swal({
                            html: information,
                            showCancelButton: true,
                            confirmButtonColor: '#3ab9da',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, Confirmar!',
                            cancelButtonText: 'Não Obrigado',
                            showLoaderOnConfirm: true,
                            
                            preConfirm: function() {
                                $.ajax({
                                    url: 'includes/calendario/editar_evento',
                                    type: "POST",
                                    dataType: 'JSON',
                                    data: {
                                        id_event:id_event,
                                        campo:campo_client,
                                        valor_campo:valor_campo_client,
                                        database:database_client								
                                    },
                                    
                                    success: function(response) {					
                                            var json = response;
                                            status = json.status;
                                            status_txt = json.status_txt;
                                            if(status == "SUCCESS") {
                                                setTimeout(function(){
                                                    $(".loading").hide();
                                                    $('#'+interface_client+'').html(valor_interface_client);
                                                    $.ajax({
                                                        url: 'includes/calendario/editar_evento',
                                                        type: "POST",
                                                        dataType: 'JSON',
                                                        data: {
                                                            id_event:id_event,
                                                            campo:campo,
                                                            valor_campo:valor_campo,
                                                            database:database								
                                                        },
                                                        
                                                        success: function(response) {					
                                                                var json = response;
                                                                status = json.status;
                                                                status_txt = json.status_txt;
                                                                if(status == "SUCCESS") {
                                                                    setTimeout(function(){
                                                                        $(".loading").hide();
                                                                        toastr.success(status_txt, 'Sucesso');
                                                                        $("#ModalEditServico").modal('hide');
                                                                        $('#'+interface+'').html(valor_interface);
                                                                        $('#calendar_').fullCalendar('refetchEvents');
                                                                    }, 100);
                                                
                                                                } else {
                                                                    $(".loading").hide();
                                                                    toastr.error(status_txt, 'Error');
                                                                }
                                                        }
                                                    });
       
                                                }, 100);
                            
                                            } else {
                                                    $(".loading").hide();
                                                    toastr.error(status_txt, 'Error');
                                            }
                                    }
                                });
                            
                            },
                            allowOutsideClick: true			  
                        });
            }
            
        });

           
        
    });

    $('.edit_funcionario').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();

        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Funcionário </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Ativo/Equipamento</label>'+
                    '<div class="input-group">'+
                        //'<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente_edit" name="pet_cliente_edit" required></select>'+
                        '<select style="" id="lista_funcionario_filtro_edit" name="lista_funcionario_filtro_edit[]" required multiple="multiple"></select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $('#lista_funcionario_filtro_edit').select2({
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

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var choose_pet = $('#lista_funcionario_filtro_edit').select2('data');
                
                if(choose_pet.length == 0 ){
                    toastr.error('Ops!Escolha o Funcionário', 'Error');  
                    return;
                }
                var valor_interface = ""; 
                var id_funcionario = "";
                id_funcionario = $('#lista_funcionario_filtro_edit').val();
                for(let i = 0; i < choose_pet.length; i = i + 1 ) {
                    valor_interface += '<a target="_blank" href="barco-'+choose_pet[i].id+'"><span><img class="avatar_table" src="'+choose_pet[i].foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+choose_pet[i].name+'</strong></span>';

                }
                
                let id_event = $('#id_edit').val();
                var interface = 'name_funcionario_edit';
                $.ajax({
                    url: 'includes/calendario/editar_evento_funcionario',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        id_event:id_event,
                        id_funcionario:id_funcionario								
                    },
                    success: function(response) {					
                            var json = response;
                            status = json.status;
                            status_txt = json.status_txt;
                            if(status == "SUCCESS") {
                                setTimeout(function(){
                                    $(".loading").hide();
                                    toastr.success(status_txt, 'Sucesso');
                                    $("#ModalEditServico").modal('hide');
                                    $('#'+interface+'').html(valor_interface);
                                    $('#calendar_').fullCalendar('refetchEvents');
                                }, 100);
            
                            } else {
                                $(".loading").hide();
                                toastr.error(status_txt, 'Error');
                            }
                    }
                });
            });
        
        
    });

    $('.edit_servico').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Ativo/Equipamento </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Ativo/Equipamento</label>'+
                    '<div class="input-group">'+
                        '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="tipo_servico_edit" name="tipo_servico_edit" required></select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $("#tipo_servico_edit").val('').trigger('change');
        
        $('#tipo_servico_edit').select2({
				
            ajax: {
            url: 'includes/calendario/get_services',
            data:{id_team:id_funcionario},
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
            templateSelection: servicesearch,
                    
        });

        function servicesearch(data) {
            var markupfun = "";
            if(data.loading){
                markupfun = "Procurando";
            }
            if (data.id == 'none') {
                return 'Nenhum Serviço atribuído <a target="_blank" style="float: right;" class="btn btn-primary btn-sm" href="funcionario-'+id_team +'" >Atribuir Serviço</a>';
            } else {
                var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.short_dec +' </span>';
            }
            
            return markupfun;
        }



            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var choose_pet = $('#tipo_servico_edit').select2('data');
                
                if(choose_pet.length == 0 ){
                    toastr.error('Ops!Escolha o Serviço', 'Error');  
                    return;
                }
                let id_event = $('#id_edit').val();
                let name = choose_pet[0].short_dec;
                //let foto = choose_pet[0].foto;
                let id = choose_pet[0].id;
                var campo = 'service_name';
                var valor_campo = id;
                var interface = 'servico_name_edit';
                //var valor_interface = '<a target="_blank" href="barco-'+valor_campo+'"><span><img class="avatar_table" src="'+foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name+'</strong></span>';
                var valor_interface = name;
                var database = 'tb_book_detail';

               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });
    

    $('.edit_valor').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Valor </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Valor Serviço</label>'+
                    '<div class="input-group">'+
                       '<input type="text" style="width: 100%;height: 45px;border:1px solid #dddfe1;padding-left:5px;font-weight: 800;font-size: 15px;" id="valor_edit" name="valor_edit" required></input>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $('#valor_edit').mask('000.000.000.000.000,00', {reverse: true});
            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var valor_edit = $('#valor_edit').val();
                
                if(valor_edit == '' ){
                    toastr.error('Ops!Digite o valor Serviço', 'Error');  
                    return;
                }
                
                let id_event = $('#id_edit').val();
                var campo = 'price';
                var valor_campo = valor_edit;
                var interface = 'servico_name_edit';
                var valor_interface = '<span style="font-weight: 600;">R$'+valor_edit+'</span>';
                var database = 'tb_book_detail';

               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });

    $('.edit_pet_taxi').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Transporte </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+

                '<div class="col-lg-12">'+
					'<div class="form-group">'+
						'<div class="form-check">'+
							'<input name="pet_taxi_" id="pet_taxi_" class="form-check-input styled-checkbox" type="checkbox">'+
							'<label name="pet_taxi_" for="pet_taxi_" class="form-check-label">Transporte</label>'+
							'<input name="has_taxi_edit" id="has_taxi_edit" type="hidden">'+
						'</div>'+
					'</div>'+
					'<div id="endereco_cliente_edit" style="display:none;" class="form-group">'+
						'<label class="text-label">Endereço</label>'+
						'<div class="input-group">'+
							'<textarea type="text" id="obs_adr_edit" name="obs_adr_edit" class="form-control" >'+endereco+'</textarea>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="text-label" style="margin-top: 15px;">Valor Transporte:</label>'+
							'<div class="input-group">'+
							'<input id="price_taxi_edit" name="price_taxi_edit" value="'+price_taxi+'" type="text" class="form-control" placeholder="Valor Transporte ">'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+


            '</div>'+

            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        $('#price_taxi_edit').mask('000.000.000.000.000,00', {reverse: true});
        
        setTimeout(function(){ 
            $("#pet_taxi_").click(function(){
                var checkbox_edir = $('[name="pet_taxi_"]');
                if (checkbox_edir.is(':checked'))
                {
                    $('#endereco_cliente_edit').show();
                    $('#has_taxi_edit').val(1);
                }else
                {
                    $('#endereco_cliente_edit').hide();
                    $('#has_taxi_edit').val(0);
                }
            });
         }, 300);
       
            $('.update_event').on('click', function(e){ 
                
                let id_event = $('#id_edit').val();
                var has_taxi_edit = $('#has_taxi_edit').val();
                var obs_adr_edit = $('#obs_adr_edit').val();
                var price_taxi_edit = $('#price_taxi_edit').val();
               
                var checkbox_edir = $('[name="pet_taxi_"]');
                if (checkbox_edir.is(':checked'))
                {
                    var pet_taxi_edit = '<span>Sim <strong>[R$'+price_taxi_edit+']</strong>  </span>';
                    var pet_endereco_edit = obs_adr_edit;

                }else
                {
                    var pet_taxi_edit = '<span>Não </span>';
                    var pet_endereco_edit = '';
                    
                } 

                e.preventDefault();
                $.ajax({
                    url: 'includes/calendario/editar_evento_taxi',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        id_event:id_event,
                        has_taxi:has_taxi_edit,								
                        obs_adr:obs_adr_edit,								
                        price_taxi:price_taxi_edit,								
                    },
                    success: function(response) {					
                            var json = response;
                            status = json.status;
                            status_txt = json.status_txt;
                            if(status == "SUCCESS") {
                                setTimeout(function(){
                                    $(".loading").hide();
                                    toastr.success(status_txt, 'Sucesso');
                                    $("#ModalEditServico").modal('hide');
                                    $('#pet_taxi_edit').html(pet_taxi_edit);
                                    $('#pet_endereco_edit').html(pet_endereco_edit);
                                    $('#calendar_').fullCalendar('refetchEvents');
                                }, 100);
            
                            } else {
                                $(".loading").hide();
                                toastr.error(status_txt, 'Error');
                            }
                    }
                });
            });
    });

    $('.edit_info_adicional').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Informação Adicional </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Informação Adicional</label>'+
                    '<div class="input-group">'+
                       '<textarea type="text" id="obs_extra_edit" name="obs_extra_edit" class="form-control" >'+info_extra+'</textarea>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var obs_extra_edit = $('#obs_extra_edit').val();

                let id_event = $('#id_edit').val();
                var campo = 'info_extra';
                var valor_campo = obs_extra_edit;
                var interface = 'info_adicional_edit';
                var valor_interface = obs_extra_edit;
                var database = 'tb_book_detail';

               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });
    
    $('.edit_prioridade').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Prioridade </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Escolha a Prioridade</label>'+
                    '<div class="input-group">'+
                        '<div class="input-group">'+
                        '<select class="form-control" id="prioridade_edit_val" name="prioridade_edit_val" >'+
                        '<option value="Normal">Normal</option>'+
                        '<option value="Alta">Alta</option>'+
                        '<option value="Média">Média</option>'+
                        '</select>'+
                    '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var prioridade_edit_val = $('#prioridade_edit_val').val();

                let id_event = $('#id_edit').val();
                var campo = 'priority';
                var valor_campo = prioridade_edit_val;
                var interface = 'prioridade_edit';
                var valor_interface = prioridade_edit_val;
                var database = 'tb_book_detail';
                edit_event_pri(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });

    

    },
        
        select: function(start, end, jsEvent , resource , resourceObj) { // click on empty time slot

            $('#petss').hide();
            $('#produto_div').hide();
            $("#clientes").val('').trigger('change');
            $('#tempo_estimado_div').hide();
			$('#endereco_cliente').hide();
            $("#tipo_servico").val('').trigger('change');
            $("#lista_funcionario").val('').trigger('change');
            $("#tempo_estimado").val('');
            $('#obs').val('');
            $('#obs_adr').val('');
            $('#preco').val('');
            $('#produto_div').hide();
            $('#preco_div').hide();
            $('#createEventModal #startTime').val('');
            $('#date_time_box').hide();
			$('#has_taxi').val('0');
            $('#endTime').val('');
            
            var pet_taxi = document.getElementById("pet_taxi");
			pet_taxi.checked = false;
			var checkbox = $('[name="pet_taxi"]');
            checkbox.checked = false;
            
            $('#pet_cliente').val('');
		    $("#pet_cliente").val('').trigger('change');
            $('#tipo_servico').val('');
		    $("#tipo_servico").val('').trigger('change');
            $('#clientes').val('');
		    $("#clientes").val('').trigger('change');
            $('#lista_funcionario').val('');
		    $("#lista_funcionario").val('').trigger('change');

                
			starttime_hour = $.fullCalendar.moment(start).format('HH:mm');
			endtime_hour = $.fullCalendar.moment(end).format('HH:mm');
			starttime = $.fullCalendar.moment(start).format('DD/MM/YYYY HH:mm:ss');
            endtime = $.fullCalendar.moment(end).format('DD/MM/YYYY HH:mm:ss');
            
            $('#starttime_hour').val(starttime_hour);

            if(start._ambigTime == true){
                start_final = moment(start).format('DD/MM/YYYY 07:00');
                end_final = moment(start).format('DD/MM/YYYY 08:00');
            } else {
                start_final = moment(start).format('DD/MM/YYYY '+starttime_hour+'');
                end_final = moment(end).format('DD/MM/YYYY '+endtime_hour+' ');
            }

            var mywhen = starttime + ' - ' + endtime;
            
            var box_service = "";
            box_service = '<div class="form-group" id="time_atividade_box" style="width: 100%;" >'+
                                '<div class="row" id="start_funcionario_box">'+
                                    '<div id="ready_fun">'+
                                    '</div>'+
                                     
                                    
                                    '<div class="col-lg-12">'+
                                        '<div class="form-group">'+
                                            '<label class="text-label">Escolha o Serviço</label>'+
                                            '<div class="input-group">'+
                                                '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="tipo_servico" name="tipo_servico" required></select>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    
                                    '<div style="display:none;width:100%" id="date_time_box">'+
                                        
                                        '<div class="col-lg-12">'+
                                            '<div class="form-group">'+
                                                '<label class="text-label">Escolha a Prioridade</label>'+
                                                '<div class="input-group">'+
                                                    '<select class="form-control" id="prioridade" name="prioridade" >'+
                                                    '<option value="Normal">Normal</option>'+
                                                    '<option value="Alta">Alta</option>'+
                                                    '<option value="Média">Média</option>'+
                                                    '</select>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    
                                        '<div class="col-lg-6 col-md-6" style="float: left;" >'+
                                            '<div class="form-group">'+
                                                '<span>Data</span>'+
                                                '<input style="cursor:pointer;" readonly required id="startTime" name="startTime" type="text" class="form-control datetimepicker_inicio" placeholder="Hora Início ">'+
                                                '<input id="startTime_dummy" name="startTime_dummy" type="hidden" >'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-lg-6 col-md-6" style="float: left;">'+
                                            '<div class="form-group">'+
                                                '<span>Termino</span>'+
                                                '<input style="cursor:pointer;" readonly required id="endTime" name="endTime" type="text" class="timepicker_ form-control datetimepicker_termino" placeholder="Hora Fim ">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-lg-6 col-md-6" style="float: left;">'+
                                            '<div class="form-group">'+
                                                '<label>Repetir Agendamento</label>'+
                                                '<select id="repeat_option" onchange="getrepeat(this);" class="form-control" >'+
                                                    '<option value="0" selected="">Não</option>'+
                                                    '<option value="7">1 Semana</option>'+
                                                    '<option value="14">2 Semanas</option>'+
                                                    '<option value="21">3 Semanas</option>'+
                                                    '<option value="28">4 Semanas</option>'+
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+

                                        '<div class="col-lg-6 col-md-6" style="float: left;">'+
                                            '<label>Próximos Agendamentos</label>'+
                                            '<ul id="extra_date" class="extra_date ">'+
                 
                                            '</ul>'+

                                        '</div>'+

                                    '</div>'+

                                '</div>'+

                               '</div>';

            var box_funcionario = ""   
            var box_funcionario = '<div id="box_func_choose">'+
                                        '<div class="form-group">'+
                                            '<label class="text-label">Funcionário</label>'+
                                            '<div class="input-group">'+
                                                '<select style="" id="lista_funcionario" name="lista_funcionario" required ></select>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';             
            

            if(resourceObj == undefined){
                
               
                $('#mask_choice_first').html(box_funcionario);
                $('#mask_choice_second').html(box_service);
                
                $('#createEventModal #startTime').val(start_final);
                $('#createEventModal #endTime').val(end_final);
                $('#createEventModal #when').text(mywhen);
                $('#createEventModal').modal('toggle');

                $('#tipo_servico').select2();
               

            } else {
                $('#tipo_servico').select2();
               
                $('#mask_choice_first').html(box_service);
                $('#mask_choice_second').html(box_funcionario);
                $('#lista_funcionario').val(resourceObj.resourceId);
                get_list_service(resourceObj.resourceId);
                $('#has_chose_fun').val(resourceObj.resourceId);
				
				   var choose_fun = "";
				   choose_fun = '<div class="col-lg-12">'+
							'<div class="form-group">'+
								'<label class="text-label">Funcionário</label>'+
								'<div class="input-group">'+
								'<strong><a target="_blank" href="funcionario-'+resourceObj.id+'"><span><img style="width:40px;height:40px;margin-right: 10px;" class="avatar_table" src="'+resourceObj.foto+'" alt="Avatar" height="45" width="45"></span>'+resourceObj.name+'</a></strong>'+
								'</div>'+
							'</div>'+
						'</div>';
                $('#ready_fun').html(choose_fun);
                $('#box_func_choose').hide();


                $('#createEventModal #startTime').val(start_final);
                $('#createEventModal #endTime').val(end_final);
                $('#createEventModal #when').text(mywhen);
                $('#createEventModal').modal('toggle');

                
            }


            $('#lista_funcionario').select2({
                ajax: {
                  url: 'includes/calendario/get_funcionarios_calendar',
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
                  templateResult: formatfunresul,
                  templateSelection: formatfunselect,
              });
              
            function formatfunresul(data) {
                var markupfun = "";
                if(data.loading){
                    markupfun = "Procurando";
                }
                else if (data.id == undefined) {
                    markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="cadastro-funcionario" >Cadastrar Funcionario</a>';
                    return;
                } else {
                    var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
                    //get_list_service(data.id);
                }
                return markupfun;
            }
            function formatfunselect(data) {
                var markupfun = "";
                if(data.loading){
                    markupfun = "Procurando";
                }
                else if (data.id == undefined) {
                    markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="cadastro-funcionario" >Cadastrar Funcionario</a>';
                    return;
                } else {
                    var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
                    //get_list_service(data.id);
                    get_list_service(data.id);
                    getrepeat(0);
                    
        
                }
                return markupfun;
            }

            
           


       },
       eventDrop: function(event, delta){ // event drag and drop
           id = event.id;
           start = event.start;
		   end = event.end;
		   
           starttime_hour = $.fullCalendar.moment(start).format('h:mm');
           endtime_hour = $.fullCalendar.moment(end).format('h:mm');
           starttime = $.fullCalendar.moment(start).format('DD/MM/YYYY HH:mm:ss');
           endtime = $.fullCalendar.moment(end).format('DD/MM/YYYY HH:mm:ss');
            if(start._ambigTime == true){
                start_final = moment(start).format('DD/MM/YYYY 07:00');
                end_final = moment(start).format('DD/MM/YYYY 08:00');
            } else {
                start_final = moment(start).format('DD/MM/YYYY '+starttime_hour+'');
                end_final = moment(start).format('DD/MM/YYYY '+endtime_hour+' ');
            }
			
			swal({
				html: '<h2>Você tem certeza que deseja mudar o dia ?</h2>',
				showCancelButton: true,
				confirmButtonColor: '#403f3f',
				cancelButtonColor: '#b1b1b1',
				confirmButtonText: 'Sim, mudar!',
				cancelButtonText: 'Cancelar',
				showLoaderOnConfirm: true,
				  
				preConfirm: function() {
				  return new Promise(function(resolve) {
					   
					 $.ajax({
						   url: 'includes/calendario/altera_dia',
						   type: 'POST',
						   dataType: 'JSON',
						   data: {
							id:id,
							start_final:start_final,
							end_final:end_final
						}
					 })
					 .done(function(response){
						var json = response;
						status = json.status;
						status_txt = json.status_txt;
						if(status == 'SUCCESS'){
                            toastr.success(status_txt, 'Sucesso');  
                        }
						$('#calendar_').fullCalendar( 'refetchEvents' );
						swal.close(); 
					   
					 })
					 .fail(function(){
						 $('#calendar_').fullCalendar( 'refetchEvents' );
						 swal('Oops...', 'Erro ao mudar o dia!', 'error');
						 
					 });
				  
				  
				  });
				},
				allowOutsideClick: false			  
			});

           $('#calendar_').fullCalendar( 'refetchEvents' );
           
       },
       eventResize: function(event) {  // resize to increase or decrease time of event
            id = event.id;
            start = event.start;
            end = event.end;
            
            starttime_hour = $.fullCalendar.moment(start).format('h:mm');
            endtime_hour = $.fullCalendar.moment(end).format('h:mm');
            starttime = $.fullCalendar.moment(start).format('DD/MM/YYYY HH:mm:ss');
            endtime = $.fullCalendar.moment(end).format('DD/MM/YYYY HH:mm:ss');
            if(start._ambigTime == true){
                start_final = moment(start).format('DD/MM/YYYY 07:00');
                end_final = moment(start).format('DD/MM/YYYY 08:00');
            } else {
                start_final = moment(start).format('DD/MM/YYYY '+starttime_hour+'');
                end_final = moment(end).format('DD/MM/YYYY '+endtime_hour+' ');
            }
			
			swal({
				html: '<h2>Você tem certeza que deseja mudar o Horário ?</h2>',
				showCancelButton: true,
				confirmButtonColor: '#3ab9da',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, Mudar!',
				cancelButtonText: 'Cancelar',
				showLoaderOnConfirm: true,
				  
				preConfirm: function() {
				  return new Promise(function(resolve) {
					   
					 $.ajax({
						   url: 'includes/calendario/altera_dia',
						   type: 'POST',
						   dataType:"json",
						   data: {
							id:id,
							start_final:start_final,
							end_final:end_final
						}
					 })
					 .done(function(response){
						var json = response;
						status = json.status;
						status_txt = json.status_txt;
						if(status == 'SUCCESS'){
                            toastr.success(status_txt, 'Sucesso');  
                        }
						$('#calendar_').fullCalendar( 'refetchEvents' );
						swal.close(); 
					   
					 })
					 .fail(function(){
						 $('#calendar_').fullCalendar( 'refetchEvents' );
						 swal('Oops...', 'Erro ao mudar o dia!', 'error');
						 
					 });
				  
				  });
				},
				allowOutsideClick: false			  
			});

          
           $('#calendar_').fullCalendar( 'refetchEvents' );

       }
    });

    

    function edit_time(){
	
        $('#time_atividade_box_edit').show();
        $(".timepicker_").mask('00:00');
         const now = moment()
         now.format("HH:mm:ss") // 13:00:00
         $.datetimepicker.setLocale('pt');
         jQuery('.datetimepicker_inicio').datetimepicker({
             format:'d/m/Y H:i',
             inline:false,
             todayButton:true,
             lang:'pt',
             step: 5,
             scrollInput: false,
             defaultTime:now.format("HH:mm:ss"),
             onSelectTime:function(dp,$input){
                var min_to_sum = parseFloat($('#time_est_edit').val());
                var time_est_edit = $('#time_est_edit').val()
                var min_to_sum = moment.duration(time_est_edit).asMinutes();
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
                $('#endTime_edit').val(hora_final)
               
     
              }
 
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
             //defaultTime:'07:00',
        });
 
        $('.save_edit').on('click', function(e){ // delete event clicked
         // We don't want this to act as a link so cancel the link action
             e.preventDefault();
             save_editar_servico(); //send data to delete function
         });
 
 
    }
    
    $('.save_edit').on('click', function(e){ 
        e.preventDefault();
        save_editar_servico(); 
    });

    function save_editar_servico(){
        

        var startTime = $('#startTime_edit').val();
        var endTime = $('#endTime_edit').val();
        var eventIDedit = $('#eventID').val();

        var start_inicial = $('#start_inicial').val();
        var end_inicial = $('#end_inicial').val();
    
        if(startTime != ''){ } else {
            toastr.error('Erro!', "Oops, preencha a data e horário Inicial!");
            return;
        }

        if(endTime != ''){} else {
            toastr.error('Erro!', "Oops, preencha a data e horário final!");
            return;
        }



        information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>Confirmação</strong></h4>'+
                            '<h5>Você deseja realmente reagendar?</h5>'+
                        '</div>'+
                    '</div>';
    
                swal({
                    html: information,
                    showCancelButton: true,
                    confirmButtonColor: '#3ab9da',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Reagendar!',
                    cancelButtonText: 'Não Obrigado',
                    showLoaderOnConfirm: true,
                    
                    preConfirm: function() {
                        $.ajax({
                            url: 'includes/calendario/editar_agendamento',
                            type: "POST",
                            dataType: 'JSON',
                            data: {
                                startTime:startTime,
                                endTime:endTime,
                                eventIDedit:eventIDedit,								
                                start_inicial:start_inicial	,							
                                end_inicial:end_inicial								
                            },
                            
                            success: function(response) {					
                                    var json = response;
                                    status = json.status;
                                    status_txt = json.status_txt;
                                    if(status == "SUCCESS") {
                                        setTimeout(function(){
                                            $(".loading").hide();
                                            toastr.success(status_txt, 'Sucesso');
                                            $("#calendarModal").modal('hide');
                                            //$("#EditTime").modal('hide');
                                            $('#calendar_').fullCalendar('refetchEvents');
                                        
                                        }, 100);
                    
                                    } else {
                                            $(".loading").hide();
                                            toastr.error(status_txt, 'Error');
                                    }
                            }
                        });
                    
                    },
                    allowOutsideClick: true			  
                });
                        
    } 
    
    function edit_event(id_event,campo,valor_campo,interface,valor_interface,database){
        
        if(valor_campo != ''){ } else {
            toastr.error('Erro!', "Oops, escolha a opção!");
            return;
        }

        information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>Confirmação</strong></h4>'+
                            '<h5>Você deseja realmente editar?</h5>'+
                        '</div>'+
                    '</div>';
    
                swal({
                    html: information,
                    showCancelButton: true,
                    confirmButtonColor: '#3ab9da',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Confirmar!',
                    cancelButtonText: 'Não Obrigado',
                    showLoaderOnConfirm: true,
                    
                    preConfirm: function() {
                        $.ajax({
                            url: 'includes/calendario/editar_evento',
                            type: "POST",
                            dataType: 'JSON',
                            data: {
                                id_event:id_event,
                                campo:campo,
                                valor_campo:valor_campo,
                                database:database								
                            },
                            
                            success: function(response) {					
                                    var json = response;
                                    status = json.status;
                                    status_txt = json.status_txt;
                                    if(status == "SUCCESS") {
                                        setTimeout(function(){
                                            $(".loading").hide();
                                            toastr.success(status_txt, 'Sucesso');
                                            $("#ModalEditServico").modal('hide');
                                            $('#'+interface+'').html(valor_interface);
                                            $('#calendar_').fullCalendar('refetchEvents');
                                        
                                        }, 100);
                    
                                    } else {
                                            $(".loading").hide();
                                            toastr.error(status_txt, 'Error');
                                    }
                            }
                        });
                    
                    },
                    allowOutsideClick: true			  
                });
                        
    } 

    function edit_event_pri(id_event,campo,valor_campo,interface,valor_interface,database){
        
        if(valor_campo != ''){ } else {
            toastr.error('Erro!', "Oops, escolha a opção!");
            return;
        }

        information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>Confirmação</strong></h4>'+
                            '<h5>Você deseja realmente editar?</h5>'+
                        '</div>'+
                    '</div>';
    
                swal({
                    html: information,
                    showCancelButton: true,
                    confirmButtonColor: '#3ab9da',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Confirmar!',
                    cancelButtonText: 'Não Obrigado',
                    showLoaderOnConfirm: true,
                    
                    preConfirm: function() {
                        $.ajax({
                            url: 'includes/calendario/editar_evento_pri',
                            type: "POST",
                            dataType: 'JSON',
                            data: {
                                id_event:id_event,
                                campo:campo,
                                valor_campo:valor_campo,
                                database:database								
                            },
                            
                            success: function(response) {					
                                    var json = response;
                                    status = json.status;
                                    status_txt = json.status_txt;
                                    if(status == "SUCCESS") {
                                        setTimeout(function(){
                                            $(".loading").hide();
                                            toastr.success(status_txt, 'Sucesso');
                                            $("#ModalEditServico").modal('hide');
                                            $('#'+interface+'').html(valor_interface);
                                            $('#calendar_').fullCalendar('refetchEvents');
                                        
                                        }, 100);
                    
                                    } else {
                                            $(".loading").hide();
                                            toastr.error(status_txt, 'Error');
                                    }
                            }
                        });
                    
                    },
                    allowOutsideClick: true			  
                });
                        
    } 
   
   $('#deleteButton').on('click', function(e){ // delete event clicked
       // We don't want this to act as a link so cancel the link action
       e.preventDefault();
       doDelete(); //send data to delete function
   });

   function doCancel(){  
    toastr.options = {"positionClass": "toast-top-full-width"}
   
    var eventID = $('#eventID').val();
        
    
    information = '<div class="user-info">'+
                     '<div class="detail">'+
                         '<h4><strong>Confirmação</strong></h4>'+
                         '<h5>Você deseja realmente cancelar este serviço?</h5>'+
                     '</div>'+
                 '</div>';
 
             swal({
                 html: information,
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Sim, Cancelar!',
                 cancelButtonText: 'Não Obrigado',
                 showLoaderOnConfirm: true,
                 
                 preConfirm: function() {
                     $.ajax({
                         url: 'includes/calendario/cancel_event',
                         type: "POST",
                         dataType: 'JSON',
                         data: {
                              IdEvento:eventID
                         },
                        
                         success: function(response) {					
                              var json = response;
                              status = json.status;
                              status_txt = json.status_txt;
                              if(status == "SUCCESS") {
                                    setTimeout(function(){
                                      $(".loading").hide();
                                      toastr.success(status_txt, 'Sucesso');
                                      $("#calendarModal").modal('hide');
                                      //$("#calendar_").fullCalendar('removeEvents',eventID);
                                      $('#calendar_').fullCalendar('refetchEvents');
                                    }, 100);
              
                                } else {
                                         $(".loading").hide();
                                        toastr.error(status_txt, 'Error');
                                }
                         }
                     });
                 
                 },
                 allowOutsideClick: true			  
             });
}
  
function doDelete(){  
    toastr.options = {"positionClass": "toast-top-full-width"}
   
    var eventID = $('#eventID').val();
        
    
    information = '<div class="user-info">'+
                     '<div class="detail">'+
                         '<h4><strong>Confirmação</strong></h4>'+
                         '<h5>Você deseja realmente deletar este serviço?</h5>'+
                     '</div>'+
                 '</div>';
 
             swal({
                 html: information,
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Sim, Deletar!',
                 cancelButtonText: 'Não Obrigado',
                 showLoaderOnConfirm: true,
                 
                 preConfirm: function() {
                     $.ajax({
                         url: 'includes/calendario/delete_event',
                         type: "POST",
                         dataType: 'JSON',
                         data: {
                              IdEvento:eventID
                         },
                        
                         success: function(response) {					
                              var json = response;
                              status = json.status;
                              status_txt = json.status_txt;
                              if(status == "SUCCESS") {
                                    setTimeout(function(){
                                      $(".loading").hide();
                                      toastr.success(status_txt, 'Sucesso');
                                      $("#calendarModal").modal('hide');
                                      //$("#calendar_").fullCalendar('removeEvents',eventID);
                                      $('#calendar_').fullCalendar('refetchEvents');
                                    }, 100);
              
                                } else {
                                         $(".loading").hide();
                                        toastr.error(status_txt, 'Error');
                                }
                         }
                     });
                 
                 },
                 allowOutsideClick: true			  
             });
}
   
  
   $('#titulo_formulario').on('keyup', function() {
    if (this.value.length > 1) {
      $('#titulo_formulario-error').remove();
   }});



});



 function saveCalendary(){ // add event
         
		toastr.options = {"positionClass": "toast-top-full-width"}
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();
        var obs_extra = $('#obs_extra').val();
        var id_funcionario = $('#lista_funcionario').val();
        var repeat_option = $('#repeat_option').val();
        var has_multiple = [];

        var has_taxi = $('#has_taxi').val();
        var obs_adr = $('#obs_adr').val();
        var price_taxi = $('#price_taxi').val();
        var prioridade = $('#prioridade').val();
        
        if(repeat_option > 0){
            $('#extra_date li').each(function() {
                has_multiple.push($(this)[0].outerText);
               
              })

        } 
        
        var has_chose_fun = $('#has_chose_fun').val();
		if(has_chose_fun != ''){
			id_funcionario = has_chose_fun;
		} else {
			id_funcionario = $('#lista_funcionario').val();
		}

        var clientes = $('#clientes').val();
        if(clientes == null){clientes = "";}
        
        var pet_cliente = $('#pet_cliente').val();
		if(pet_cliente == null){pet_cliente = "";}
		
        var tipo_servico = $('#tipo_servico').val();
		if(tipo_servico == null){tipo_servico = "";}
		
        var tempo_estimado = $('#tempo_estimado').val();
		if(tempo_estimado == null){tempo_estimado = "";}
		
		var preco = $('#preco').val();
		if(preco == null){preco = "";}
		
        if(startTime != ''){ } else {
			toastr.error('Erro!', "Oops, Escolha a data Inicial!");
			return;
        }

        if(endTime != ''){} else {
			toastr.error('Erro!', "Oops, Escolha a data Final!");
			return;
        }
        
        if(tipo_servico != ''){} else {
			toastr.error('Erro!', "Oops, Escolha o serviço!");
			return;
        }

        if(clientes != ''){} else {
			toastr.error('Erro!', "Oops, Escolha o cliente");
			return;
        }

        if(pet_cliente != ''){} else {
			toastr.error('Erro!', "Oops, Ecolha o Ativo!");
			return;
        }
		
		if(preco != ''){} else {
			toastr.error('Erro!', "Oops, Digite o Valor!");
			return;
        }
		
		preco = preco.replace(",", ".");
		preco = parseFloat(preco).toFixed(2);
		
        categoryClass = "#9E9E9E";

       
       $.ajax({
        url: "includes/calendario/cadastra_agendamento",
       data: {
        startTime:startTime,
        endTime:endTime,
        clientes:clientes,
        tipo_servico:tipo_servico,
        tempo_estimado:tempo_estimado,
        preco:preco,
		id_funcionario:id_funcionario,
		has_chose_fun:has_chose_fun,
		obs_extra:obs_extra,
        has_multiple:has_multiple,
        id_ativo :pet_cliente,
        has_taxi:has_taxi,
        obs_adr:obs_adr,
        price_taxi:price_taxi,
        prioridade:prioridade
       },
		   type: "POST",
		   dataType: 'JSON',
           success: function(response) {

            $("#createEventModal").modal('hide');

           status = response.status;
           status_message = response.status_txt;
           starttimes = $.fullCalendar.moment(event.start).format('DD-MM-YYYY HH:mm:ss');
           endtimes = $.fullCalendar.moment(event.end).format('DD-MM-YYYY HH:mm:ss');

           teste = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
            newevent = 
          {
            title: tipo_servico,
            id: clientes,
            className: categoryClass,
            start: starttimes,
            end: endtimes,
            allDay: true,
          }
          
        $('#calendar_').fullCalendar('addEventSource', newevent);
		$('#calendar_').fullCalendar('refetchEvents');
		$("#clientes").val('').trigger('change');
		$("#pet_cliente").val('').trigger('change');
		$("#tipo_servico").val('').trigger('change');
		$("#lista_funcionario").val('').trigger('change');
		$("#tempo_estimado").val('');
		$('#obs').val('');
		$('#obs_adr').val('');
		$('#preco').val('');
        $('#produto_div').hide();
        $('#has_taxi').val('0');
		document.getElementById("has_taxi").checked = false;
		
		toastr.success("Agendamento Cadastrado com Sucesso!", 'Sucesso');
           }
       });
       
       return;
   }
   
   function alteraStatusReprovado(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#eventID').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/noimage.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Digite o Motivo!</h5>'+
							'<br><span><textarea rows="4" type="text" id="repprove_message" name="repprove_message" class="form-control" ></textarea></span>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, Enviar!',
					cancelButtonText: 'Não Obrigado',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {

                       var repprove_message =  $('#repprove_message').val();
                       if(repprove_message == ''){
                        toastr.success("Digite a Justificativa!", 'Ops'); 
                        return;
                       }
                        
                        $.ajax({
                            url: "includes/calendario/repprove_event",
                           data: {
                            eventID:eventID,
                            acao:acao,
                            id_funcionario:id_funcionario,
                            repprove_message:repprove_message
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;

                                    toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
                                    $('#calendarModal').modal('hide');
                                    $('#calendar_').fullCalendar( 'refetchEvents' );
                                    $('#concluido').hide();
                                    $('#reprovar').hide();
                                 }
                           });


					
					},
					allowOutsideClick: true			  
                });

       
       
       
   }
   
   function alteraStatus(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#eventID').val();
	var id_funcionario = $('#eventFunc').val();
         
	   toastr.options = {"positionClass": "toast-top-full-width"}
       
       $.ajax({
        url: "includes/calendario/alteraStatus",
       data: {
        eventID:eventID,
		acao:acao,
		id_funcionario:id_funcionario
       },
			type: "POST",
			dataType: 'JSON',
			success: function(response) {
			status = response.status;
			status_message = response.status_txt;
			
			if(acao == "concluido"){
				fullname = response.fullname;
				foto = response.foto;

				imagem = foto +'?' + (new Date()).getTime();
				
				zap = response.zap;
				zap = zap.replace("(", "");
				zap = zap.replace(")", "");
				zap = zap.replace("-", "");
				zap = zap.replace(" ", "");

				toastr.success("Serviço finalizado com sucesso!", 'Sucesso');

				$('#calendarModal').modal('hide');
				$('#calendar_').fullCalendar( 'refetchEvents' );

				information = '<div class="user-info">'+
                        '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
							'<h4><strong>'+fullname+'</strong></h4>'+
							'<h5>O serviço foi finalizado! Deseja enviar uma mensagem no whatsapp do cliente?</h5>'+
							'<h5>Telefone Cliente</h5>'+
							'<span><input class="phone" value="'+response.zap+'" type="text" style="margin-bottom: 10px;width:100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="phone_message_cliente" name="phone_message_cliente"></input></span>'+
							'<br><span><textarea type="text" id="zap_message" name="zap_message" class="form-control" ></textarea></span>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, Enviar!',
					cancelButtonText: 'Não Obrigado',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {
						zap_message = $('#zap_message').val();
						phone_message_cliente = $('#phone_message_cliente').val();

						phone_message_cliente = phone_message_cliente.replace("(", "");
						phone_message_cliente = phone_message_cliente.replace(")", "");
						phone_message_cliente = phone_message_cliente.replace("-", "");
						phone_message_cliente = phone_message_cliente.replace(" ", "");
						
						if(zap_message != ''){
							if(phone_message_cliente != ''){
                                var string_zap = 'https://wa.me/55'+phone_message_cliente+'/?text='+zap_message+' ';

                                window.open(string_zap+' ','_blank');

								//window.open('https://api.whatsapp.com/send?phone=55'+phone_message_cliente+'&text='+zap_message+' ','_blank');
							} else {
								toastr.error('Erro!', "Oops, Digite o telefone do cliente!");
								$('#calendarModal').modal('hide');
								$('#calendar_').fullCalendar( 'refetchEvents' );
							}
							
						} else {
							toastr.error('Erro!', "Oops, Digite uma mensagem para o cliente!");
							$('#calendarModal').modal('hide');
							$('#calendar_').fullCalendar( 'refetchEvents' );
						}
						

						toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
						$('#calendarModal').modal('hide');
						$('#calendar_').fullCalendar( 'refetchEvents' );
					
					},
					allowOutsideClick: true			  
                });
                
                $('.phone').mask('(00) 00000-0009');
				$('#concluido').show();
                $('#reprovar').show();
                $('#finalizar').hide();
				
			}
			else{
                toastr.success("Serviço iniciado com sucesso!", 'Sucesso');
                $('#calendarModal').modal('hide');
				setTimeout(function(){ 
                    $('#calendar_').fullCalendar( 'refetchEvents' );
                 }, 100);
			}
			
			

           }
       });
       
   }


   function adicionarInfo(id , info_extra){

            var ModalAddInfom = "";

            ModalAddInfom = `<div class="modals">
                        <div class="form-group">
                        <label class="text-label">Digite a anotação desejada</label>
                            <input type="text" value="`+info_extra+ `"  name="Newinfo_extra" id="Newinfo_extra" class="form-control" required="" >
                        <button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="addInformacao(`+id+`)">Salvar</button>                        
                        </div>

                     </div>`


            $('#modalWhenInfo').html(ModalAddInfom);
            $('#ModalAddInfo').modal();


   }

   function addInformacao(id){
    var Newinfo_extra = $("#Newinfo_extra").val();

        $.ajax({
           url: 'includes/calendario/cadastra_infoextra.php',
           type: "POST",
           dataType:'JSON',
           data: {
                id : id,
                Newinfo_extra : Newinfo_extra
           },
           success: function(response) {                    
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                if(status == "SUCCESS") {
                      setTimeout(function(){
                        $(".loading").hide();
                        toastr.success(status_txt, 'Sucesso');
                      }, 100);

                  } else {
                           $(".loading").hide();
                          
                           toastr.error(status_txt, 'Error');
                  }
               
           }
       });
   }





function alteraHorario(id , br_start_hora, termina_hora, start_dateReage, id_funcionario){
            var ModalAltTime = "";
            ModalAltTime = `<div class="modals">
                        <div class="form-group">
                        <label class="text-label">Horario de inicio</label>
                            <input type="text" value="`+br_start_hora+ `"  name="nome" id="Newhora_Inicio" class="form-control timepicker_ " required="" >
                        <label class="text-label">Horario de finalização</label>
                            <input type="text" value="`+termina_hora+ `" name="nome"  id="Newhora_termino" class="form-control timepicker_" required="" >
                        <label class="text-label">Data</label>
                            <input type="text" value="`+start_dateReage+ `" name="nome"  id="Newstarted_data" class="form-control  " required="" >
                        <button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="AlterarTime(`+id+`,`+id_funcionario+`)">Salvar</button>                        
                        </div>

                     </div>`


            $('#modalWhenTime').html(ModalAltTime);
            $('#ModalAddTime').modal();

            $(".timepicker_").mask('00:00');
            $(".datepicker_").mask('00/00/0000');
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

   function AlterarTime(id, id_funcionario){

        var Newhora_Inicio = $("#Newhora_Inicio").val();
        var Newhora_termino = $("#Newhora_termino").val();
        var Newstarted_data = $("#Newstarted_data").val(); 

        $.ajax({
           url: 'includes/calendario/altera_horario.php',
           type: "POST",
           dataType:'JSON',
           data: {
                id : id,
                id_funcionario : id_funcionario,
                Newhora_Inicio : Newhora_Inicio,
                Newhora_termino : Newhora_termino,
                Newstarted_data : Newstarted_data
           },
           success: function(response) {                    
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                if(status == "SUCCESS") {
                      setTimeout(function(){
                        $(".loading").hide();
                        toastr.success(status_txt, 'Sucesso');
                      }, 100);

                  } else {
                    $(".loading").hide();
                    toastr.error(status_txt, 'Error');
                  }
               
           }
       });
   }


   