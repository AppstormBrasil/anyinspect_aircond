$(document).ready(function(){
	
	toastr.options = {"positionClass": "toast-top-full-width"}

    var calendar = $('#calendar_').fullCalendar({  // assign calendar
        handleWindowResize: true,
        height: $(window).height(),   
        eventLimit: true,
        
		//height: $(window).height() - 200,  

        ignoreTimezone: false,
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
       /*titleFormat: {
          month: 'MMMM yyyy',
          week: "d[ MMMM][ yyyy]{ - d MMMM yyyy}",
          day: 'dddd, d MMMM yyyy'
        },*/
   
   
		buttonText: {
			prev: "anterior",
			next: "próximo",
			prevYear: "ano passado",
			nextYear: "próxiimo ano",
			today: "Hoje",
			month: "Mês",
			week: "Semana",
			day: "Dia"
		}	,	
        header:{
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
		//defaultView: 'agendaWeek',
		/*views: {
            agenda: {
				
			}
		}, */

		defaultView: 'month',
		editable: true,
		selectable: true,
		allDaySlot: false,
		timeslotsPerHour: 4,
		axisFormat: 'HH:mm',
		timeFormat: 'HH:mm',
        slotDuration : "01:00",
        scrollTime: '09:00:00',
		lockOverflow: function(scrollbarWidths) { return;},
		events: {
            url: "includes/calendario/get_eventos",
            type: 'GET',
            data: function() {
                return {
                    lista_funcionario: $("#lista_funcionario_filtro").val(),
                    /*cliente: $("#id_cliente_filtro").val(),
                    servico: $('#id_servico_filtro').val(),
                    prestador: $('#id_prestador_filtro').val(),
                    data_inicial: $('#data_inicial_filtro').val(),
                    data_final: $('#data_final_filtro').val()*/
                };
            },
        },
		eventRender: function( event, element, view ) {
			var title = element.find('.fc-title, .fc-list-item-title');          
            title.html(title.text());
            $('.fc-scroller').css('overflow','visible');
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
		foto_pet = event.foto_pet;
		nome_funcionario = event.nome_funcionario;
		id_funcionario = event.id_funcionario;
		id_pet = event.id_pet;
		pet_name = event.pet_name;
		mood = event.mood;
		info_extra = event.info_extra;
		Info_list = event.Info_list;
		func_list = event.func_list;
		start_dateReage = event.start_dateReage;

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
        
        endereco = event.endereco;
        foto_cliente = event.foto_cliente;

		
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
		
		
		if(status_ == "Pendente"){
			$('#comecar').show();
			$('#finalizar').hide();
		}
		else if(status_ == "Em Andamento"){
			$('#finalizar').show();
			$('#comecar').hide();
		}
		else{
			$('#comecar').hide();
			$('#finalizar').hide();
		}
		
		if(quem_executou == null){
			quem_executou = "";
		}


        var event_content = "";

        var btn_reagenda = "";

        var btn_reagenda = `<div class="row mb-4">
                                <div class="col-5">
                                    <a style="cursor:pointer;" id="`+id+`"  
                                    onclick="alteraHorario(id, \'`+br_start_hora+`\', \'`+termina_hora+`\', 
                                    \'`+start_dateReage+`\', \'`+id_funcionario+`\')" >
                                    <span style="background:#313131; color:#ffffff" 
                                    class="label  label-rounded ">Reagendar</a></span>
                                </div>
                            <div class="col-9">
                        </div>
                    </div>`;

             if (status_ == "Pendente"){
                btn_reagenda = btn_reagenda;
             }else{
                btn_reagenda = " ";
             }

			var event_content = "";

			event_content = `<div class="profile-personal-info">
				
                <h3 class="mb-5"><strong>Agendamento</strong><span ><strong>`+br_start+`</strong></span></h3>
				<span><h1 style="margin-bottom: 45px;">Serviço: `+title+`</h1></span>
                `+btn_reagenda+`
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Cliente</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><a target="_blank" href="cliente-`+id_client+`"><span><img class="avatar_table" src="`+foto_cliente+`" alt="Avatar" height="30" width="30"></a><span>` +name_client+`</span></span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Funcionário</strong> <span class="pull-right">:</span></h5>
					</div>
					<div style="margin-left: 10px;">`+func_list+`</div>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Serviço</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+title+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Hora Inicio</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span style="font-weight: 600;">`+br_start_hora+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Hora Fim</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span style="font-weight: 600;">`+termina_hora+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Valor</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span style="font-weight: 600;">R$`+preco+`</span>
					</div>
				</div>
				
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Executado por</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+quem_executou+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Informações Adicionais</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9">`+informacao_adicional+`
                      <a style="cursor:pointer;" id="`+id+`"  onclick="adicionarInfo(id, \'`+info_extra+`\')" ><span style="background:#313131 ;color:#ffffff" class="label label label-rounded ">+ Infomação</a></span>
                    </div>
				</div>
				
				</div>
            </div>`    

		  
						  
            endtime = $.fullCalendar.moment(event.end).format('h:mm');
            starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            $('#modalTitle').html(title);
            $('#modalWhen').html(event_content);
			$('#eventID').val(id);
			$('#eventFunc').val(id_funcionario);
            $('#calendarModal').modal();
        },
        
        select: function(start, end, jsEvent) { // click on empty time slot
                
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

            var mywhen = starttime + ' - ' + endtime;
            
            $('#createEventModal #startTime').val(start_final);
            $('#createEventModal #endTime').val(end_final);
            $('#createEventModal #when').text(mywhen);
            $('#createEventModal').modal('toggle');






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
				  
					console.log('lksajlksa')
				  
				  });
				},
				allowOutsideClick: false			  
			});

          
           $('#calendar_').fullCalendar( 'refetchEvents' );

       }
    });
   
   $('#deleteButton').on('click', function(e){ // delete event clicked
       // We don't want this to act as a link so cancel the link action
       e.preventDefault();
       doDelete(); //send data to delete function
   });
   
   function doDelete(){  // delete event 
       toastr.options = {"positionClass": "toast-top-full-width"}
       $("#calendarModal").modal('hide');
       var eventID = $('#eventID').val();

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
                        $("#calendar_").fullCalendar('removeEvents',eventID);
                      }, 100);

                  } else {
                           $(".loading").hide();
                          toastr.error(status_txt, 'Error');
                  }
           }
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

        var obs_adr = $('#obs_adr').val();
        var obs = $('#obs').val();
		var id_funcionario = $('#lista_funcionario').val();

		
		
        var clientes = $('#clientes').val();
		if(clientes == null){clientes = "";}
		
        var pet_cliente = 0;
		
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

        if(clientes != ''){} else {
			toastr.error('Erro!', "Oops, Escolha o cliente");
			return;
        }

        
        if(tipo_servico != ''){} else {
			toastr.error('Erro!', "Oops, Escolha o serviço!");
			return;
        }
		
		if(preco != ''){} else {
			toastr.error('Erro!', "Oops, Digite o preço!");
			return;
        }
		
		preco = preco.replace(",", ".");
		preco = parseFloat(preco).toFixed(2);
		
		categoryClass = "#9E9E9E";

       $("#createEventModal").modal('hide');
       
       $.ajax({
        url: "includes/calendario/cadastra_agendamento",
       data: {
        startTime:startTime,
        endTime:endTime,
        clientes:clientes,
        tipo_servico:tipo_servico,
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
          
        //$("#titulo_formulario").val('').trigger('change');    
        //$('#calendar_').fullCalendar('renderEvent', newevent, true);
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
       
   }
   
   function alteraStatus(acao){ // add event
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
			
			if(acao == "finalizar"){
				fullname = response.fullname;
				foto = response.foto;

				imagem = foto +'?' + (new Date()).getTime()
				
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
							'<br><span><textarea type="text" id="zap_message" name="zap_message" class="form-control" >Querido(a), seu pet está pronto! Espero que goste do nosso serviço, muito obrigada pela confiança!</textarea></span>'+
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
								window.open('https://api.whatsapp.com/send?phone=55'+phone_message_cliente+'&text='+zap_message+' ','_blank',true);
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
					allowOutsideClick: false			  
				});
				
				
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
    console.log(id);
    console.log(info_extra);

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


   