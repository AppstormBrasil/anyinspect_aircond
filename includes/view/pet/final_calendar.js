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
        defaultView: 'month',
        editable: true,
        selectable: true,
        allDaySlot: true,
        
        events: "includes/view/pet/get_eventos",
        
        eventClick:  function(event, jsEvent, view) {  // when some one click on any event

        var id, id_client , start , end , status_, title
        
        id = event.id;
        id_client = event.id_client;
		title = event.title;
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
		if(produtos == false){
			produtos = "-";
        }
        
        pet_taxi = event.pet_taxi;
        endereco = event.endereco;
        foto_cliente = event.foto_cliente;

        if(pet_taxi == 1){
            tem_taxi = 'Sim';
            end_taxi ='<span style="background: #d8d8d8;padding: 3px;">'+endereco+'</span>'
        } else {
            tem_taxi = 'Não';
            end_taxi = '';
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
		
		if(status_ == "Pendente"){
			$('#comecar').show();
		}
		else if(status_ == "Em Andamento"){
			$('#finalizar').show();
		}
		else{
			
		}
		
		if(quem_executou == null){
			quem_executou = "";
		}

		    var event_content = "";
			
			event_content = `<div class="profile-personal-info">
				<h3 class="text-primary mb-5"><strong>Agendamento</strong></h3>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Cliente</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><a target="_blank" href="pet-lista-cliente-detalhado-`+id_client+`"><span><img class="media-object rounded-circle" src="`+foto_cliente+`" alt="Avatar" height="30" width="30">` +name_client+`</a></span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Serviços</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+title+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Produtos</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+produtos+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Hora Inicio</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+br_start+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Hora Fim</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+termina_final+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Valor</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+preco+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Começou ás</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+started_data_final+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Terminou ás</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+ended_final+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Executado por:</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span>`+quem_executou+`</span>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-3">
						<h5 class="f-w-500"><strong>Peti Taxi:</strong> <span class="pull-right">:</span></h5>
					</div>
					<div class="col-9"><span><strong>`+tem_taxi+`: </strong> `+end_taxi+`</span>
					</div>
				</div>
            </div>`


            event_content2 = '<div class="body user_activity" style="text-align: left;">'+
								'<div class="sl-content">'+
                                    '<h2>Agendamento</h2>'+
								'</div>'+
								
							  '<br>'+
							  
                              '<div class="streamline b-accent">'+					
							  
							  '<div class="sl-item">'+
                                      '<div class="sl-content">'+
                                          '<h4 class="m-b-0">Cliente</h4>'+
                                          '<h5>'+name_client+'</h5>'+
                                      '</div>'+
                                  '</div>'+
                                  
                              '</div>'+
							  
							  '<br>'+
							  
                              '<div class="sl-item">'+
                                      '<div class="sl-content">'+
                                          '<h4 class="m-b-0">Serviços &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; Produtos Utilizados</h4>'+
                                          '<h5>'+title+' &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; ' + produtos + '</h5>'+
                                      '</div>'+
                                  '</div>'+
                                  
                              '</div>'+
							  
							  '<br>'+
							  
							 '<div class="streamline b-accent">'+
                              '<div class="sl-item">'+
                                      '<div class="sl-content">'+
                                          '<h4 class="m-b-0">Começa em &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; Começou em</h4>'+
                                          '<h5>'+br_start+'&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'+ started_data_final +'</h5>'+
                                      '</div>'+
                                  '</div>'+
                                  
                              '</div>'+
							  
							  '<br>'+
							  
							  '<div class="streamline b-accent">'+
                              '<div class="sl-item">'+
                                      '<div class="sl-content">'+
                                          '<div style="text-align:left;"><h5 class="m-b-0">Termina em &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; Terminou em</h5></div>'+
                                          '<h5>'+termina_final +'&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'+ ended_final +'</h5>'+
                                      '</div>'+
                                  '</div>'+
                                  
                              '</div>'+
							  
							  '<br>'+
							 
							 '<div class="streamline b-accent">'+
								'<div class="sl-item">'+
                                      '<div class="sl-content">'+
                                          '<h4 class="m-b-0">Preço:</h4>'+
                                          '<h5>'+preco+'</h5>'+
                                      '</div>'+
                                '</div>'+
                             '</div>'+
							 
							 '<br>'+
							 
							 '<div id="quem_executou" class="streamline b-accent">'+
								'<div class="sl-item">'+
                                      '<div class="sl-content">'+
                                          '<h4 class="m-b-0">Quem Executou:</h4>'+
                                          '<h5>'+quem_executou+'</h5>'+
                                      '</div>'+
                                '</div>'+
                             '</div>'+

                             '<div class="row mb-4">'+
                                '<div class="col-3">'+
                                    '<h5 class="f-w-500"><strong>Peti Taxi:</strong> <span class="pull-right">:</span></h5>'+
                                '</div>'+
                                '<div class="col-9"><span><strong>'+tem_taxi+': </strong>'+end_taxi+'</span>'+
                               '</div>'+
                            '</div>'+
							  
                          '</div></div>';
						  
						  
            endtime = $.fullCalendar.moment(event.end).format('h:mm');
            starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            $('#modalTitle').html(title);
            $('#modalWhen').html(event_content);
            $('#eventID').val(id);
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
                end_final = moment(end).format('DD/MM/YYYY '+endtime_hour+' ');
            }

          
           swal("Você tem certeza que desaja modificar o Dia?", {
            buttons: {
              cancel: "Não, obrigado!",
              sim: {
                text: "Sim, por favor!",
                value: "sim",
              },
            },
          })
          .then((value) => {
            switch (value) {
              case "sim":
                  //let message2 = 'Teste'
                  $.ajax({
                    url: 'includes/controller/pet/altera_dia',
                    dataType:'JSON',
                    data: {
                        id:id,
                        start_final:start_final,
                        end_final:end_final
                    },
                    type: "POST",
                    success: function(json) {
                        status = json.status;
                        status_txt = json.status_txt;
                        if(status == 'SUCCESS'){
                            toastr.success(status_txt, 'Sucesso');
                        }
                    
                        $('#calendar_').fullCalendar( 'refetchEvents' );
                        
                    }
                });
           
                break;
           
              default:
                   
                  //swal("Redirecionando....");
                  //setTimeout(function(){ location.reload(); }, 1000);
                  $('#calendar_').fullCalendar( 'refetchEvents' );
            }
          });
           
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

            swal("Você tem certeza que desaja modificar o Horário?", {
                buttons: {
                  cancel: "Não, obrigado!",
                  sim: {
                    text: "Sim, por favor!",
                    value: "sim",
                  },
                },
              })
              .then((value) => {
                switch (value) {
                  case "sim":
                      //let message2 = 'Teste'
                      $.ajax({
                        url: 'includes/controller/pet/altera_dia',
                        dataType:'JSON',
                        data: {
                            id:id,
                            start_final:start_final,
                            end_final:end_final
                        },
                        type: "POST",
                        success: function(json) {
                            status = json.status;
                            status_txt = json.status_txt;
                            if(status == 'SUCCESS'){
                                toastr.success(status_txt, 'Sucesso');
                            }
                        
                            $('#calendar_').fullCalendar( 'refetchEvents' );
                            
                        }
                    });
               
                    break;
               
                  default:
                      //swal("Redirecionando....");
                      $('#calendar_').fullCalendar( 'refetchEvents' );
                      //setTimeout(function(){ location.reload(); }, 1000);
                }
              });
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
           url: 'includes/controller/pet/delete_event',
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

        var has_taxi = $('#has_taxi').val();
        var obs_adr = $('#obs_adr').val();
        var obs = $('#obs').val();
		
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
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }

        if(endTime != ''){} else {
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }

        if(clientes != ''){} else {
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }

        if(pet_cliente != ''){} else {
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }
        if(tipo_servico != ''){} else {
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }
		if(tempo_estimado != ''){} else {
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }
		if(preco != ''){} else {
			toastr.error('Erro!', "Oops, preencha os campos obrigatórios!");
			return;
        }
		
		preco = preco.replace(",", ".");
		preco = parseFloat(preco).toFixed(2);
		
		categoryClass = "#9E9E9E";

       $("#createEventModal").modal('hide');
       
       $.ajax({
        url: "includes/controller/pet/cadastra_agendamento",
       data: {
        startTime:startTime,
        endTime:endTime,
        clientes:clientes,
        pet_cliente:pet_cliente,
        tipo_servico:tipo_servico,
        tempo_estimado:tempo_estimado,
        preco:preco,
        has_taxi:has_taxi,
        obs_adr:obs_adr,
        obs:obs
       },
           type: "POST",
           dataType: 'JSON',
           success: function(response) {
           status = response.status;
           status_message = response.status_txt;
           starttimes = $.fullCalendar.moment(event.start).format('DD-MM-YYYY HH:mm:ss');
           endtimes = $.fullCalendar.moment(event.end).format('DD-MM-YYYY HH:mm:ss');

           teste = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
          console.log(teste);
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

		toastr.success("Agendamento Cadastrado com Sucesso!", 'Sucesso');

              /* $("#calendar_").fullCalendar('renderEvent',
               {
                   id: id,
                   title: 'teste',
                   start: starttimes,
                   end: endtimes,
                   allDay: true,
                   className: categoryClass
               },
               true); */
           }
       });
       
   }
   
   function alteraStatus(acao){ // add event
   
	var eventID = $('#eventID').val();
         
		toastr.options = {"positionClass": "toast-top-full-width"}
       
       $.ajax({
        url: "includes/controller/pet/alteraStatus",
       data: {
        eventID:eventID,
        acao:acao
       },
            type: "POST",
            dataType: 'JSON',
			success: function(response) {
			status = response.status;
			status_message = response.status_txt;
			
			if(acao == "finalizar"){
				fullname = response.fullname;
				
				zap = response.zap;
				zap = zap.replace("(", "");
				zap = zap.replace(")", "");
				zap = zap.replace("-", "");
				zap = zap.replace(" ", "");

				toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
				
				swal("O serviço foi finalizado! Deseja enviar uma mensagem no whatsapp do cliente?", {
				  buttons: {
					cancel: "Não, obrigado!",
					sim: {
					  text: "Sim, por favor!",
					  value: "sim",
					},
				  },
				})
				.then((value) => {
				  switch (value) {
					case "sim":
						let message2 = 'Teste'
							window.open('https://api.whatsapp.com/send?phone=55'+zap+'&text='+message2+' ','_blank',true)

						toastr.success("Serviço finalizado com sucesso! Redirecionando...", 'Sucesso');
					
						setTimeout(function(){ location.reload(); }, 2000);
					  
					  break;
				 
					default:
                        $('#calendarModal').modal('hide');
						setTimeout(function(){ 
                            $('#calendar_').fullCalendar( 'refetchEvents' );
                         }, 100);
				  }
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

   