"use strict";

function call_open_events_off() {
	var request = window.indexedDB.open('AnyInspect_dnata', 3);
	var db;
	request.onsuccess = function (event) {
	  db = request.result;
	  setTimeout(function(){
		$$('#open_list_approve').html('');
		$$('#open_list_pending').html('');	
		var box_historico_local = '';
		let objectStore2 = db.transaction("tb_events").objectStore("tb_events");
		objectStore2.openCursor().onsuccess = function(event) {
		var cursor = event.target.result;
		var dummy_approve  = "";
		var dummy_pending  = "";
		var current_status = "";
		var status_ = "";
		var read = "";
		var link_page = "";
		var total_groups = 0;
		var data = "";

		  if (cursor) {
			data = cursor.value;
			status_ = cursor.value.status_;
				if(status_ == 'Pendente'){
				current_status = 'list_status_pendente';
				}
				if(status_ == 'Em Andamento'){
				status_ = 'Em Andamento';
				current_status = 'list_status_andamento';
				read = 'read';
				}
				if(status_ == 'Cancelado'){
				status_ = 'Cancelado';
				current_status = 'list_status_cancelado';
				read = 'read';
				}
				if(status_ == 'Deletado'){
				status_ = 'Deletado';
				current_status = 'list_status_deletado';

				}
				if(status_ == 'Concluído'){
				status_ = 'Concluído';
				current_status = 'list_status_concluido';
				read = 'read';
				}
				if(status_ == 'Finalizado'){
				current_status = 'list_status_finalizado';
				read = 'read';
				}

				total_groups = data.total_groups;
				var length_desc_service = data.desc_service.length;
				if(length_desc_service > 31){
				var desc_service = data.desc_service.substring(0, 28)+'...';
				} else {
				var desc_service = data.desc_service;
				}
				if(total_groups > 1){
				link_page = "/atividade-grupo/"+data.id_group+"";
				
				} else {
				link_page = "/atividade/"+data.id+"";
				}

				if(status_ == 'Finalizado'){
				dummy_approve += 
				'<div class="patient-widget">'+		
					'<div class="patient-top-details">'+
						'<div>'+
							'<span class="invoice-id"><strong>'+data.br_start+'</strong></span>'+
						'</div>'+
						'<div>'+
							'<span class="date-col '+current_status+'">'+status_+'</span>'+
						'</div>'+
					'</div>'+
					'<div class="invoice-widget">'+
						'<div class="pat-info-left">'+
							'<div class="patient-img">'+
								'<a href="'+link_page+'">'+
								'<img src="'+data.foto_cliente+'" class="img-fluid" alt="User Image">'+
								'</a>'+
							'</div>'+
							'<div class="pat-info-cont">'+
								'<h4 class="pat-name"><a href="'+link_page+'">'+desc_service+'</a></h4>'+
								'<div class="patient-details-col">'+
								'<span class="">#'+data.id_group+'</span>'+
								'</div>'+
								'<div class="hour-col">'+
									'<div>'+
										'<span class="hours">'+data.nome_cliente+'</span>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'</div>'+
					'</div>';	
				}

				if(status_ == 'Pendente' || status_ == 'Em Andamento' || status_ == 'Finalizado'){
				dummy_pending += 
				'<div class="patient-widget">'+		
					'<div class="patient-top-details">'+
						'<div>'+
							'<span class="invoice-id"><strong>'+data.br_start+'</strong></span>'+
						'</div>'+
						'<div>'+
							'<span class="date-col '+current_status+'">'+status_+'</span>'+
						'</div>'+
					'</div>'+
					'<div class="invoice-widget">'+
						'<div class="pat-info-left">'+
							'<div class="patient-img">'+
								'<a href="'+link_page+'">'+
								'<img src="'+data.foto_cliente+'" class="img-fluid" alt="User Image">'+
								'</a>'+
							'</div>'+
							'<div class="pat-info-cont">'+
								'<h4 class="pat-name"><a href="'+link_page+'">'+desc_service+'</a></h4>'+
								'<div class="patient-details-col">'+
								'<span class="">#'+data.id_group+'</span>'+
								'</div>'+
								'<div class="hour-col">'+
									'<div>'+
										'<span class="hours">'+data.nome_cliente+'</span>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'</div>'+
					'</div>';	
				} 
  			  $$('#open_list_approve').append(dummy_approve);
			  $$('#open_list_pending').append(dummy_pending);
			  cursor.continue();
		  }
		 
		  db.close();
		
		};
	  }, 500);
	
	};
  }
function call_open_events_groups_off(id_group) {
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var request = window.indexedDB.open('AnyInspect_dnata', 3);
	var db;
	request.onsuccess = function (event) {
	  db = request.result;
	  setTimeout(function(){
		$$('#open_list_grupo').html('');  
		var box_historico_local = '';
		
		let objectStore2 = db.transaction("tb_events_group").objectStore("tb_events_group");
		objectStore2.openCursor().onsuccess = function(event) {

		var cursor = event.target.result;
		var data = "";
		var status_ = "";
		var read = "";
		var link_page = "";
		var total_groups = 0;
		var percent_act_box = "";
		var is_conc = 0;
		var dummy_open_list  = "";
		var current_status = "";
		if (cursor) {
		  if (cursor.value.id_group == id_group) {
			data = cursor.value;
			var endereco_cliente = data.endereco_cliente;
			var cidade_cliente = data.cidade_cliente;
			var cep_cliente = data.cep_cliente;
			var num_cliente = data.num_cliente;
			var bairro_cliente = data.bairro_cliente;
			var phone_cliente = data.phone_cliente;
			if(endereco_cliente != ''){
				endereco_cliente = endereco_cliente;
			}
			if(cidade_cliente != ''){
				cidade_cliente = ' , ' + cidade_cliente;
			}
			if(num_cliente != ''){
				num_cliente = ' , ' + num_cliente;
			}
			if(cep_cliente != ''){
				cep_cliente = ' , ' + cep_cliente;
			}
			if(bairro_cliente != ''){
				bairro_cliente = ' , ' + bairro_cliente;
			}
			var full_endereco = endereco_cliente + bairro_cliente + num_cliente + cidade_cliente + cep_cliente;
			status_ = data.status_;
			if(status_ == 'Pendente'){
			current_status = 'list_status_pendente';
			}
			if(status_ == 'Em Andamento'){
			status_ = 'Em Andamento';
			current_status = 'list_status_andamento';
			read = 'read';
			}
			if(status_ == 'Cancelado'){
			status_ = 'Cancelado';
			current_status = 'list_status_cancelado';
			read = 'read';
			}
			if(status_ == 'Deletado'){
			status_ = 'Deletado';
			current_status = 'list_status_deletado';

			}
			if(status_ == 'Concluído'){
			status_ = 'Concluído';
			current_status = 'list_status_concluido';
			read = 'read';
			}
			if(status_ == 'Finalizado'){
			current_status = 'list_status_finalizado';
			read = 'read';
			}

			total_groups = data.total_groups;

			$$('#foto_empresa_gru').html('<img style="border-radius:5px!important;min-width:60px;width:60px;" src="'+data.foto_cliente+'" alt="">')
			$$('#nome_empresa_gru').html('<strong>'+data.nome_cliente+'</strong>');
			$$('#end_empresa_gru').html('<div><i style="color:#9c9c9c;" class="fa fa-map-marker"></i> <small>'+full_endereco+'</small></div>');
			$$('#phone_cliente_gru').html('<i style="color:#9c9c9c;" class="fa fa-phone"></i> <small>'+data.phone_cliente+'</small>');
	
			var length_desc_service = data.desc_service.length;
			if(length_desc_service > 35){
			var desc_service = data.desc_service.substring(0, 34)+'...';
			} else {
			var desc_service = data.desc_service;
			}
			link_page = "/atividade/"+data.id+"";
			dummy_open_list += '<div class="patient-widget">'+		
										'<a href="'+link_page+'"><div class="patient-top-details">'+
										'<div>'+
											'<span class="invoice-id"><strong>'+data.qrcode+'</strong></span>'+
										'</div>'+
										'<div>'+
											'<span class="date-col '+current_status+'">'+status_+'</span>'+
										'</div>'+
										'</div>'+
										'<div class="invoice-widgets">'+
											'<div class="pat-info-lefts">'+
											'<div class="pat-info-conts">'+
												'<h4 class="pat-name"><a href="'+link_page+'"> <strong>'+data.ativo+'</strong></a></h4>'+
												'<div class="patient-details-col">'+
												'<span class="">#'+data.id+' '+desc_service+'</span>'+
												'</div>'+
												'<div class="hour-col">'+
													'<div>'+
														'<h5 class="hours">'+data.br_start+'</h5>'+
													'</div>'+
												'</div>'+
											'</div>'+
											'</div>'+
										'</div></a>'+
								'</div>'

			percent_act_box = '<h6 class="mt-4">'+is_conc+'% Completo</h6>'+
			'<div class="progress mb-3">'+
				'<div class="progress-bar bg-primary" style="width:'+is_conc+'%; height:6px;" role="progressbar"><span class="sr-only">'+is_conc+'% Completo</span></div>'+
			'</div>';
			$$('#open_list_grupo').append(dummy_open_list);
			$$('#percent_act').html(percent_act_box);
			cursor.continue();
		} else {
			cursor.continue();
		}
	}
	$('#search_events_all').keyup(function(){
		var that = this, $allListElements = $('#open_list_grupo > div');
		var $matchingListElements = $allListElements.filter(function(i, div){
			var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
			return ~listItemText.indexOf(searchText);
		});
		$allListElements.hide();
		$matchingListElements.show();
	});
		};
	  }, 500);
	
	};
}

function get_info_gerais_off(id_atividade){
	var size_width = $$('#boxcanvas_cli').width() - 10;
	let user_info = Utils.userData();

	if(user_info === null || user_info === 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
		app.views.main.router.navigate('/sign-in/');
		app.views.main.router.navigate('/sign-in/' , {clearPreviousHistory: true});
		return;
	}
	
	let IdUser = user_info.id;
	let type = user_info.type;
	var request = window.indexedDB.open('AnyInspect_dnata', 3);
      var db;
      request.onsuccess = function (event) {
        db = request.result;
		setTimeout(function(){
          var objectStoreSingle = db.transaction("tb_single").objectStore("tb_single");
          objectStoreSingle.openCursor().onsuccess = function(event) {
			var cursor = event.target.result;
            if(cursor.value.id == id_atividade){ 
                  var data = cursor.value;
				  var full_endereco = "";
				  var det_info ;
				  det_info = data;
				  var endereco_ativo = det_info.endereco;
				  var empresa_cliente = det_info.empresa_cliente;
				  var lat_ativo = det_info.lat_ativo;
				  var lon_ativo = det_info.lon_ativo;
				  var id_group = det_info.id_group;
				  var endereco_cliente = data.cidade;
				  var endereco_cliente = data.endereco_cliente;
				  var cidade_cliente = data.cidade_cliente;
				  var cep_cliente = data.cep_cliente;
				  var num_cliente = data.num_cliente;
				  var phone_cliente = data.phone_cliente;
				  if(endereco_cliente != ''){
					  endereco_cliente = endereco_cliente;
				  }
				  if(cidade_cliente != ''){
					  cidade_cliente = ' , ' + cidade_cliente;
				  }
				  if(num_cliente != ''){
					  num_cliente = ' , ' + num_cliente;
				  }
				  if(cep_cliente != ''){
					  cep_cliente = ' , ' + cep_cliente;
				  }
				  full_endereco = endereco_cliente + num_cliente + cidade_cliente + cep_cliente;
				  var config = {
					  flow_approve: data.flow_approve,
					  geo_location: data.geo_location,
					  image_require: data.image_require,
					  image_single: data.image_single,
					  qr_check_in: data.qr_check_in,
					  signature: data.signature,
					  signature_exec: data.signature_exec,
					};
				  $$('#nome_empresa_at').html('<strong>'+empresa_cliente+'</strong>');
				  $$('#end_empresa_at').html('<i style="color:#9c9c9c;" class="fa fa-map-marker"></i> '+full_endereco);
				  $$('#phone_cliente').html(phone_cliente);
				  if(endereco_ativo != ''){
					  endereco_ativo = endereco_ativo;
					if(endereco_ativo != ''){
					  endereco_ativo = '<a class="open_map" style="color:#000;"> <i style="font-size:14px;margin-right: 5px;" class="ion-ios-pin" ></i>'+endereco_ativo+'</a>';
					} else {
					  endereco_ativo = endereco_ativo;
					}
			
				  } else {
					endereco_ativo = 'N/A';
				  }
			
				  var status_det = det_info.status_;
				  var eventID = det_info.id;
				  var id_funcionario = det_info.id_funcionario;
				  var id_form = det_info.id_form;
				  var qrcode = det_info.qrcode;
				  var priority = det_info.priority;
				  var info_extra = det_info.info_extra;
				  var box_aprovacao = "";
				  generateFormOff(id_form,status_det,id_atividade,config,id_group);
				  $("#titulo_atividade").html('<strong>'+det_info.desc_service+'</strong>');
				  $("#ativo_equipamento").html('<strong>'+qrcode+ ' - '  +det_info.descricao+'</strong>');
				  $("#local_ativo").html('<strong class="open_map_ativo">'+det_info.local_ativo+'</strong>');
				  $("#data_atividade").html('<strong>'+det_info.br_start+'</strong>');
				  $("#tempo_estimado").html('<strong>'+det_info.est_time+'</strong>');
				  $("#prioridade_").html('<strong>'+priority+'</strong>');
				  $("#info_extra").html('<strong>'+info_extra+'</strong>');
				  if(status_det == 'Pendente'){
					  $$('.status_activity').html('<div class="content status_pendente"><span class="">'+status_det+'</span></div>');
					  $$('.right_tab_act').html('')
		  
					  if(type == 'a' || type == 'g' || type == 'r' ){
						  $$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
					  } else {
						  $$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
					  }
				  
				  }
				  if(status_det == 'Em Andamento'){
					  $$('.status_activity').html('<div class="content status_andamento"><span class="">'+status_det+'</span></div>');
					  $$('#btn_action_service').html('');
					  setTimeout(function(){
						  window.animatelo.bounceIn('.right_tab_act');
					  }, 300);
		  
					  box_aprovacao = '<div class="col-100">'+
									  '<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
									  '</div>';
					  $$('#box_finish_action').html(box_aprovacao);
					  window.animatelo.bounceIn('#box_finish_action');
				  }
			  
					if(status_det == 'Finalizado'){
					  $$('.status_activity').html('<div class="content status_finalizado"><span class="">'+status_det+'</span></div>');
					  if(type == 'a' || type == 'g' || type == 'r' ){
						  if(config.flow_approve == 1){
							  $$('#box_finish_action').show();	
							  $$('#box_finish_action').html('<button style="float: left;width: 48%;margin-right: 5px;font-size: 16px;line-height: inherit;" id="concluido" class="btn status_approve  button btn_approve change_status_approve scaleffect">Aprovar</button>'+
							  '<button id="reprovado" style="float: left;width: 48%;margin-right: 5px;font-size: 16px;line-height: inherit;" class="btn btn_repprove status_repprove button  change_status_approve scaleffect">Reprovar</button>');
							  $$('#box_finish_action').show();
						  }
					  } else {
						  $$('#box_save_checklist').hide();
						  $$('#box_finish_action').hide();
						  $$('#box_action_sigcli').hide();
					  }
					  
					}
					
					if(status_det == 'Concluído'){
					  $$('.status_activity').html('<div class="content status_concluido"><span class="">'+status_det+'</span></div>')
					  $$('#box_save_checklist').html('')
					  $$('#box_save_checklist').hide();
					  $$('#box_finish_action').hide();
					  $$('#box_save_checklist').hide();
					} 

					setTimeout(function(){
						$$('.scaleffect').on('touchstart', function () {
						$$(this).addClass('box-scale'); 
						});
						$$('.scaleffect').on('touchend', function () {
						$$(this).removeClass('box-scale'); 
						});

					$$('.open_map_ativo').on('click', function (e) {
						e.preventDefault();
						if  ((navigator.platform.indexOf("iPhone") != -1) || 
							(navigator.platform.indexOf("iPad") != -1) || 
								(navigator.platform.indexOf("iPod") != -1)){
							window.open("maps://maps.google.com/maps?daddr="+lat_ativo+","+lon_ativo+"&amp;ll=");
						} 	else {
							window.open("https://maps.google.com/maps?daddr="+lat_ativo+","+lon_ativo+"&amp;ll=");  
							}
							
						});

					$$('.change_status_service').on('click', function (e) {
						e.preventDefault();
						let the_status = this.id;
						let user_info = Utils.userData();
						altera_status_off(eventID,the_status,id_funcionario,id_form,config,id_group,det_info);
						return;

					});
				$$('.change_status_approve').on('click', function (e) {
					e.preventDefault();
					let the_status = this.id;
					var txt_confirma;		
					if(the_status == 'concluido'){
						txt_confirma = 'Aprovar a Atividade';
						if(config.flow_approve == 1){
							var has_sign_tec = $$(".has_sign_tec").attr('src');
							if(has_sign_tec == undefined || has_sign_tec == "undefined"){
								var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
								toast_message.open();
								return;
							}
						}
					} 
					if(the_status == 'reprovado'){
						txt_confirma = 'Reprovar a Atividade';
						var open_modal_approve = app.sheet.create({
							el: '.open_modal_approve',
							swipeToClose: false,
							swipeToStep: false,
							backdrop: true,
							closeByBackdropClick: false,
							closeByOutsideClick: false
							});
							open_modal_approve.open();
									var manual_tag = "";
										manual_tag = '<li class="item-content item-input">'+
											'<div class="item-inner">'+
												'<div class="item-input-wrap">'+
													'<br>'+
													'<textarea id="reprove_message_" cols="30" rows="10" placeholder="Digite sua Justificativa"></textarea>'+
													'<br><button class="btn scaleffect no-active-state button btn_confirma_reprove">Confirmar</button><br><br><button style="background:#F44336" class="btn button scaleffect no-active-state close_manual" id="close_manual" >Cancelar</button>'+
												'</div>'+
											'</div>'+
										'</li>';

									$$('#box_noapprove').html(manual_tag);
									
									$$('.close_manual').on('click', function (e) {
										e.preventDefault();
										open_modal_approve.close();
									});
									
									$$('.btn_confirma_reprove').on('click', function (e) {
										e.preventDefault();
										var repprove_message = $$('#reprove_message_').val();
										fetch(current_path+'/view/repprove_event', {
											method: 'POST',
											headers : new Headers(),
											body:JSON.stringify({
												repprove_message:repprove_message,
												eventID:eventID,
												acao:the_status,
												id_funcionario:id_funcionario
											})
											}).then((res) => res.json())
											.then((data) =>  {
												var status ;
												status = data.status;
												if(status == 'SUCCESS'){
						
													if(the_status == 'reprovado'){
														$$('#btn_action_service').html('<button id="comecar" class="btn button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
														$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
														$$('#box_finish_action').html('');
													
													} else {
														$$('#box_finish_action').html('');
													}
													
													open_modal_approve.close();
													let user_info = Utils.userData();
													let IdUser = user_info.id;
													let type = user_info.type;
													$$('#box_sig_cli').html('');
													$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');	
												}
										
										})
										.catch((err)=>console.log(err))
									
									});

					} else {
							
						app.dialog.confirm('Você tem certeza que deseja '+txt_confirma+' ?','Confirmação ', function () {
							fetch(current_path+'/view/alteraStatus', {
								method: 'POST',
								headers : new Headers(),
								body:JSON.stringify({
									eventID:eventID,
									acao:the_status,
									id_funcionario:id_funcionario,
									id_form:id_form
								})
								}).then((res) => res.json())
								.then((data) =>  {
									var status ;
									status = data.status;
									if(status == 'SUCCESS'){
										if(the_status == 'concluido'){
											$$('#btn_action_service').html('');
											$$('#status_servico').html('<div class="content status_concluido"><span class="status_concluido ">Concluído</span></div>');
											var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
											toast_message.open();
											$$('#box_sig_cli').html('');
											$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
										}

										if(the_status == 'reprovar'){
											$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
											$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
											$$('#box_sig_cli').html('');
											$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
										}
										let user_info = Utils.userData();
										let IdUser = user_info.id;
										let type = user_info.type;
										$$('#box_sig_cli').html('');
										$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
										call_open_events_off();
										get_info_gerais_off(id_atividade);
										call_open_events_groups_off(id_group);
									}
							
							})
							.catch((err)=>console.log(err))
							});
					}
				});
				}, 500);
		  

			}  else{
				cursor.continue();
			  }
		}
		}, 500);
	}
}

$$('.back-last').on('click', function (e) {
	e.preventDefault();
	app.views.current.router.back();

});

if ( navigator.permissions && navigator.permissions.query) {
  navigator.permissions.query({ name: 'geolocation' }).then(function(result) {
      const permission = result.state;
      if ( permission === 'granted' || permission === 'prompt' ) {
      }
      result.onchange = function() {
    };
      
  });
}  
function qr_info(){
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	const html5QrCode = new Html5Qrcode("qr-reader",true);
	open_camera_qr_info(html5QrCode);
	$$('.stopscanerios').click(function () {
		html5QrCode.stop().then(ignore => {
		html5QrCode.clear();
		return;
		}).catch(err => { 
		}); 
	});
	
	$$('.startcam').click(function () {
		open_camera_qr_info(html5QrCode);
	});


	$$('.back-qr').on('click', function (e) {
		e.preventDefault();
		html5QrCode.stop().then(ignore => {
		html5QrCode.clear();
		return;
		}).catch(err => { 
		}); 
		app.views.current.router.back();
	});

	$$('.search_tag').on('click', function (e) {
	e.preventDefault();
	var qrCodeMessage = $$('#qr_tag_input').val();
	if(qrCodeMessage == null || qrCodeMessage == 'null' || qrCodeMessage == ''){
		var toast_message = app.toast.create({text: 'Digite a identificação!',closeTimeout: 2000,cssClass: 'error_toast'});
		toast_message.open();
		return;
	}

	fetch(current_path + '/view/get_qr_info', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,type:type,qrCodeMessage:qrCodeMessage})
		}).then((res) => res.json())
		.then((data) =>  {
		if(data.status == 'SUCCESS'){
		  app.preloader.hide();
		  html5QrCode.stop().then(ignore => {
			html5QrCode.clear();
			return;
			}).catch(err => { 
		  });  
		  var toast_message = app.toast.create({text: 'Encontrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
		  toast_message.open();
		  setTimeout(function () {
			app.views.main.router.navigate('/info_ativo/'+qrCodeMessage);
		  }, 100);
		  
		} else {
		  var toast_message = app.toast.create({text: 'Ativo não encontrado!',closeTimeout: 2000,cssClass: 'error_toast'});
		 toast_message.open();
		}
	  })
	  .catch((err)=>console.log(err));
	});
}

function altera_status(eventID,the_status,id_funcionario,id_form,configs,id_groups,det_info){
		let user_info = Utils.userData();
		if(user_info == null || user_info == 'null'){
			app.views.main.router.navigate({ name: 'sign-in' });
		}
		let IdUser = user_info.id;
		let id_user = user_info.id;
		let type = user_info.type;
		var has_sign_client = "";
		var has_sign_exec = "";
		var has_sign_tec = "";
		var config = configs;
		var id_group = id_groups;
		var txt_confirma;
		var loadLocation = "";
		var start_lat = det_info.start_lat;
		var id = det_info.id;
		var qrcode = det_info.qrcode;
		var qr_checkin_info = det_info.qr_checkin;
			if(the_status == 'comecar'){
				txt_confirma = 'Iniciar Atividade';
				if(config.geo_location == 1){
					if(start_lat == ''){
						if(config.qr_check_in == 0){
							app.views.main.router.navigate('/gps-signin/0/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form+'/'+configs+'/'+id_groups+'/'+det_info);
							return;
						} else {
							app.views.main.router.navigate('/gps-signin/1/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form+'/'+configs+'/'+id_groups+'/'+det_info);
							return;
						}
					} else {
						if(config.qr_check_in == 1){
							app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form+'/'+configs+'/'+id_groups+'/'+det_info);
							return;
						} 
					}
				} else {
					if(config.qr_check_in == 1){
						app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
						return;
					} 
				}
			}
			if(the_status == 'finalizar'){
				txt_confirma = 'Enviar Aprovação';
			}
			if(the_status == 'cancelar'){
				txt_confirma = 'Cancelar Atividade';
			}
		if(the_status != 'comecar'){
			if(config.signature_exec == 1){
				has_sign_exec = $$(".has_sign_rest_exec").attr('src');
				if(has_sign_exec == undefined || has_sign_exec == "undefined"){
					var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Execução!',closeTimeout: 2000,cssClass: 'error_toast'});
					toast_message.open();
					return;
				} else {
					if(config.signature == 1){
						has_sign_client = $$(".has_sign_client").attr('src');
						if(has_sign_client == undefined || has_sign_client == "undefined"){
							var toast_message = app.toast.create({text: 'Obrigatório Assinatura Cliente',closeTimeout: 2000,cssClass: 'error_toast'});
							toast_message.open();
							return;
						} 
					} 
				}
			} 
		} 

		if(the_status == 'concluido'){
			if(config.flow_approve == 1){
				var has_sign_tec = $$(".has_sign_tec").attr('src');
				if(has_sign_tec == undefined || has_sign_tec == "undefined"){
					var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
					toast_message.open();
					return;
				}
			} else {
				$$('#box_finish_action').html('');
			}
		}
		
		if(the_status == 'finalizar'){
			if(config.flow_approve == 1){
				if(type == 'a' || type == 'r' || type == 'g'){
					var has_sign_tec = $$(".has_sign_tec").attr('src');
					if(has_sign_tec == undefined || has_sign_tec == "undefined"){
						var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
						toast_message.open();
						return;
					}
				}
			} else {
				the_status = 'concluido';	
			}
		}

	
		fetch(current_path+'/view/alteraStatus', {
			method: 'POST',
			headers : new Headers(),
			body:JSON.stringify({
				eventID:eventID,
				acao:the_status,
				id_funcionario:IdUser,
				id_form:id_form
			})
			}).then((res) => res.json())
			.then((data) =>  {  
				status = data.status;
				var box_aprovacao = "";
				if(the_status == 'comecar'){
					$$('#btn_action_service').html('');
					$$('#status_servico').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.status_activity').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
					setTimeout(function(){
						$$('#box_sig_cli').html('');
						$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
						call_open_events();
						call_open_events_groups(id_group);
						get_info_gerais(eventID);
					}, 200);
					box_aprovacao = '<div class="col-100">'+
												'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
												'</div>';
					$$('#box_finish_action').html(box_aprovacao);
					
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
					setTimeout(function(){
						
					$$('.change_status_approve').on('click', function (e) {
						e.preventDefault();
						let the_status = this.id;
						var txt_confirma;		
						if(the_status == 'concluido'){
							txt_confirma = 'Aprovar a Atividade';
								if(config.flow_approve == 1){
									var has_sign_tec = $$(".has_sign_tec").attr('src');
									if(has_sign_tec == undefined || has_sign_tec == "undefined"){
										var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
										toast_message.open();
										return;
									}
								} else {
									$$('#box_finish_action').html('');
								}
						} 
						if(the_status == 'reprovado'){
							txt_confirma = 'Reprovar a Atividade';
							var open_modal_approve = app.sheet.create({
								el: '.open_modal_approve',
								swipeToClose: false,
								swipeToStep: false,
								backdrop: true,
								closeByBackdropClick: false,
								closeByOutsideClick: false
							  });
								
							  open_modal_approve.open();
										var manual_tag = "";
											manual_tag = 
												'<div class="item-inner">'+
													'<div class="item-input-wrap">'+
														'<br>'+
														'<textarea id="reprove_message_" cols="30" rows="10" placeholder="Digite sua Justificativa"></textarea>'+
														'<br><button class="btn scaleffect no-active-state button btn_confirma_reprove">Confirmar</button><br><br><button style="background:#F44336" class="btn button scaleffect no-active-state close_manual" id="close_manual" >Cancelar</button>'+
													'</div>'+
												'</div>'+
										$$('#box_noapprove').html(manual_tag);
										$$('.close_manual').on('click', function (e) {
											e.preventDefault();
											open_modal_approve.close();
										});
										$$('.btn_confirma_reprove').on('click', function (e) {
											e.preventDefault();
											var repprove_message = $$('#reprove_message_').val();
											fetch(current_path+'/view/repprove_event', {
												method: 'POST',
												headers : new Headers(),
												body:JSON.stringify({
													repprove_message:repprove_message,
													eventID:eventID,
													acao:the_status,
													id_funcionario:id_funcionario
												})
												}).then((res) => res.json())
												.then((data) =>  {
													var status ;
													status = data.status;
													if(status == 'SUCCESS'){

														console.log('the_status concluido - ' + the_status)
							
														if(the_status == 'reprovado'){
															$$('#btn_action_service').html('<button id="comecar" class="btn button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
															$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
															$$('#box_finish_action').html('');
														
														} else {
															$$('#box_finish_action').html('');
														}
														
														open_modal_approve.close();
														let user_info = Utils.userData();
														if(user_info == null || user_info == 'null'){
															app.views.main.router.navigate({ name: 'sign-in' });
														}
														let IdUser = user_info.id;
														let type = user_info.type;
														$$('#box_sig_cli').html('');
														$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
														get_info_gerais(eventID);
														call_open_events();
														call_open_events_groups(id_group);	
													}
											
											})
											.catch((err)=>console.log(err))
										
										});
			
						} else {
							app.dialog.confirm('Você tem certeza que deseja '+txt_confirma+' ?','Confirmação ', function () {
								fetch(current_path+'/view/alteraStatus', {
								  method: 'POST',
								  headers : new Headers(),
								  body:JSON.stringify({
									  eventID:eventID,
									  acao:the_status,
									  id_funcionario:id_funcionario,
									  id_form:id_form
								  })
								  }).then((res) => res.json())
								  .then((data) =>  {
									  var status ;
									  status = data.status;
									  if(status == 'SUCCESS'){
										  if(the_status == 'concluido'){
											  $$('#btn_action_service').html('');
											  $$('#status_servico').html('<div class="content status_concluido"><span class="status_concluido ">Concluído</span></div>');
											  var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
											  toast_message.open();
										  }
			  
										  if(the_status == 'reprovar'){
											  $$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
											  $$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
										  
										  }
										  let user_info = Utils.userData();
										  if(user_info == null || user_info == 'null'){
											app.views.main.router.navigate({ name: 'sign-in' });
										}
										  let IdUser = user_info.id;
										  let type = user_info.type;
										  $$('#box_sig_cli').html('');
										  $$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
										  $$('#box_finish_action').remove();
										  call_open_events();
										  get_info_gerais(eventID);
										  call_open_events_groups(id_group);
									  }
							  })
							  .catch((err)=>console.log(err))
							  });
						
						}
					});
					}, 500);						
				}
				
				else if(the_status == 'Em Andamento'){
					$$('#status_servico').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.status_activity').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
					box_aprovacao = '<div class="col-100">'+
												'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
												'</div>';
					$$('#box_finish_action').html(box_aprovacao);
					setTimeout(function(){
						$$('#box_sig_cli').html('');
						$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
						call_open_events();
						call_open_events_groups(id_group);
						get_info_gerais(eventID);
					}, 200);
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
										
				}
				
				else if(the_status == 'cancelar'){
					$$('#btn_action_service').html('<button class="button btn_status_cancelado">Cancelado</button>');
					$$('#status_servico').html('<div class="content status_cancelado"><span class="">Cancelado</span></div> ');
					$$('.status_activity').html('<div class="content status_cancelado"><span class="">Cancelado</span></div> ');
					open_manual_Tag.close();
					let user_info = Utils.userData();
					if(user_info == null || user_info == 'null'){
						app.views.main.router.navigate({ name: 'sign-in' });
					}
					let IdUser = user_info.id;
					let type = user_info.type;
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
				
				}
				
				else if(the_status == 'finalizar'){
					let user_info = Utils.userData();
					if(user_info == null || user_info == 'null'){
						app.views.main.router.navigate({ name: 'sign-in' });
					}
					let IdUser = user_info.id;
					let type = user_info.type;
					var has_sign_client = "";
					var has_sign_exec = ""
					if(config.signature_exec == 1){
						has_sign_exec = $$(".has_sign_rest_exec").attr('src');
						if(has_sign_exec == undefined || has_sign_exec == "undefined"){
							var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Execução!',closeTimeout: 2000,cssClass: 'error_toast'});
						    toast_message.open();
							return;
						} else {
							if(config.signature == 1){
								has_sign_client = $$(".has_sign_client").attr('src');
								if(has_sign_client == undefined || has_sign_client == "undefined"){
									var toast_message = app.toast.create({text: 'Obrigatório Assinatura Cliente',closeTimeout: 2000,cssClass: 'error_toast'});
									toast_message.open();
									return;
								} else {
									if(type == 'a' || type == 'g' || type == 'r' ){
										$$('#box_finish_action').html('<button style="float:left;width:48%;margin-right:5px;font-size:16px;height:45px;" id="concluido" class="status_approve  button btn_approve change_status_approve scaleffect">Aprovar</button><button id="reprovado"  style="float:left;width:48%;font-size:16px;height:45px;" class="btn_repprove status_repprove button btn_status_reprovar change_status_approve scaleffect">Reprovar</button>');
										
									} else {
										$$('#box_finish_action').html('');
									}
									$$('#status_servico').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
									$$('.status_activity').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
								}
		
							} else {
								if(type == 'a' || type == 'g' || type == 'r' ){
									$$('#box_finish_action').html('<button style="float: left;width:48%;margin-right:5px;font-size:16px;height:45px;" id="concluido" class="status_approve  button btn_approve change_status_approve scaleffect">Aprovar</button><button id="reprovado"  style="float:left;width:48%;font-size:16px;height:45px;" class="btn_repprove status_repprove button btn_status_reprovar change_status_approve scaleffect">Reprovar</button>');
									
								} else {
									$$('#box_finish_action').html('');
								}
								$$('#status_servico').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
								$$('.status_activity').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
							}
							
						}
					} 
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
					$$("input,textarea,select").prop("disabled",true); 
					$$('#box_save_checklist').hide();
					$$('#box_images_up').hide();
					$$("#phone_cliente").prop("disabled",false); 
					$$("#zap_message").prop("disabled",false); 
					$$('.change_status_approve').on('click', function (e) {
						e.preventDefault();
						let the_status = this.id;
						var txt_confirma;			
						if(the_status == 'concluido'){
							txt_confirma = 'Aprovar a Atividade';
							if(config.flow_approve == 1){
								var has_sign_tec = $$(".has_sign_tec").attr('src');
								if(has_sign_tec == undefined || has_sign_tec == "undefined"){
									var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
									toast_message.open();
									return;
								}
							}
						} 
						if(the_status == 'reprovado'){
							txt_confirma = 'Reprovar a Atividade';
							var open_modal_approve = app.sheet.create({
								el: '.open_modal_approve',
								swipeToClose: false,
								swipeToStep: false,
								backdrop: true,
								closeByBackdropClick: false,
								closeByOutsideClick: false
							  });
								
							  open_modal_approve.open();
										var manual_tag = "";
											manual_tag = '<li class="item-content item-input">'+
												'<div class="item-inner">'+
													'<div class="item-input-wrap">'+
														'<br>'+
														'<textarea id="reprove_message_" cols="30" rows="10" placeholder="Digite sua Justificativa"></textarea>'+
														'<br><button class="btn scaleffect no-active-state button btn_confirma_reprove">Confirmar</button><br><br><button style="background:#F44336" class="btn button scaleffect no-active-state close_manual" id="close_manual" >Cancelar</button>'+
													'</div>'+
												'</div>'+
											'</li>';
			
										$$('#box_noapprove').html(manual_tag);
										
										$$('.close_manual').on('click', function (e) {
											e.preventDefault();
											open_modal_approve.close();
										});
										
										$$('.btn_confirma_reprove').on('click', function (e) {
											e.preventDefault();
											var repprove_message = $$('#reprove_message_').val();
											fetch(current_path+'/view/repprove_event', {
												method: 'POST',
												headers : new Headers(),
												body:JSON.stringify({
													repprove_message:repprove_message,
													eventID:eventID,
													acao:the_status,
													id_funcionario:id_funcionario
												})
												}).then((res) => res.json())
												.then((data) =>  {
													var status ;
													status = data.status;
													if(status == 'SUCCESS'){
							
														if(the_status == 'reprovado'){
															$$('#btn_action_service').html('<button id="comecar" class="btn button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
															$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
															$$('#box_finish_action').html('');
														
														} else {
															$$('#box_finish_action').html('');
														}
														open_modal_approve.close();
														let user_info = Utils.userData();
														if(user_info == null || user_info == 'null'){
															app.views.main.router.navigate({ name: 'sign-in' });
														}
														let IdUser = user_info.id;
														let type = user_info.type;
														$$('#box_sig_cli').html('');
														$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
														get_info_gerais(eventID)
														call_open_events();
														call_open_events_groups(id_group);	
													}
											
											})
											.catch((err)=>console.log(err))
										});
						} else {
							app.dialog.confirm('Você tem certeza que deseja '+txt_confirma+' ?','Confirmação ', function () {
								fetch(current_path+'/view/alteraStatus', {
								  method: 'POST',
								  headers : new Headers(),
								  body:JSON.stringify({
									  eventID:eventID,
									  acao:the_status,
									  id_funcionario:id_funcionario,
									  id_form:id_form
								  })
								  }).then((res) => res.json())
								  .then((data) =>  {
									  var status ;
									  status = data.status;
									  if(status == 'SUCCESS'){
										  if(the_status == 'concluido'){
											  $$('#btn_action_service').html('');
											  $$('#status_servico').html('<div class="content status_concluido"><span class="status_concluido ">Concluído</span></div>');
											  var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
											  toast_message.open();
										  }
			  
										  if(the_status == 'reprovar'){
											  $$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
											  $$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
										  
										  }
										  let user_info = Utils.userData();
										  if(user_info == null || user_info == 'null'){
											app.views.main.router.navigate({ name: 'sign-in' });
										}
										  let IdUser = user_info.id;
										  let type = user_info.type;
										  $$('#box_sig_cli').html('');
										  $$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
	   								      get_info_gerais(eventID)
										  call_open_events();
										  call_open_events_groups(id_group);
									  }
							  
							  })
							  .catch((err)=>console.log(err))
							  });
						
						}
					});				
					$$('#box_sig_cli').html('');
					$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
					get_info_gerais(eventID)
					call_open_events();
					call_open_events_groups(id_group);
				
				}
				else if(the_status == 'concluido'){
					$$('#btn_action_service').html('');
					$$('#box_save_checklist').html('');
					$$('#status_servico').html('<div class="content status_concluido "><span class="">Concluído</span></div> ');
					$$('.status_activity').html('<div class="content status_concluido "><span class="">Concluído</span></div> ');
					let user_info = Utils.userData();
					if(user_info == null || user_info == 'null'){
						app.views.main.router.navigate({ name: 'sign-in' });
					}
					let IdUser = user_info.id;
					let type = user_info.type;
					//get_open_service(IdUser,type);
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
					if(config.flow_approve == 0){
						$('#box_finish_action').html('');
					}
					$$('#box_sig_cli').html('');
					$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
					get_info_gerais(eventID)
					call_open_events();
					call_open_events_groups(id_group);
				}

				else if(the_status == 'reprovar'){
					$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
					$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
					$$('.status_activity').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
					$$('#box_sig_cli').html('');
					$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
					get_info_gerais(eventID)
					call_open_events();
					call_open_events_groups(id_group);
				}	
			})
			.catch((err)=>console.log(err))	
}



// GENERATE FORM 


function generateFormOff(formID,status_det,id_atividade,config,id_group) {
    var id_atividade = id_atividade;
    var formID = formID;
	var user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;	

$("#sjfb-fields").empty();
	
var request = window.indexedDB.open('AnyInspect_dnata', 3);
var db;

request.onsuccess = function (event) {
	db = request.result;
	setTimeout(function(){
	  var objectStoreSingle = db.transaction("tb_form").objectStore("tb_form");
	  objectStoreSingle.openCursor().onsuccess = function(event) {
		var cursor = event.target.result;
			if(cursor.value.id == formID){ 
			  var data2 = cursor.value.conteudo_formulario;
			if (data2) {
				var conteudo_formulario = JSON.parse(data2);
				var enable_disable = ""; 
				var i = 0;
				var k = 0;
				var j = 1;
				var check_result = "";
				var id_ = "";
				var c_type = "";
				var c_label = "";
				var c_label_final = "";
				var c_period = "";
				var bg_section = "";
				var sig_exec = "";
				var sig_resp = "";
				var sig_client = "";
				var box_btn_sign = "";
	
				if(conteudo_formulario == null || conteudo_formulario == 'null' ){
				} else {
					$('#box_sig_cli').append('<div class="text-center" ><h3 style="margin-bottom: 30px;">Assinaturas</h3></div>');
					$.each( conteudo_formulario, function( k, v ) {
						var fieldType = v['type'];
						var label = v['label'];
						c_type = fieldType;
						c_label = label;
						var res = v['label'].split("@");
						c_label_final = res[0];
						c_period = res[1];
						if(c_type == 'signature_box' ){
							let user_info = Utils.userData();
							if(user_info == null || user_info == 'null'){
								app.views.main.router.navigate({ name: 'sign-in' });
							}
							let IdUser = user_info.id;
							let type = user_info.type;
							if(status_det == 'Concluído'){
								var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
	
							} else if(status_det == 'Finalizado'){
								if(c_label_final == 'Responsável Técnico'){
									if(type == 'a' || type == 'g' || type == 'r' ){
										var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
										'<a href="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" style="padding:5px;" class="item-link item-content link edit_tecnico" ><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinar</a>'+
										'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
									} else {
										var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
									}
								} else  {
									var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
								}
							} else if(status_det == 'Em Andamento'){
								if(c_label_final == 'Responsável Execução'){
									var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'<a href="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" style="padding:5px;" class="item-link item-content link edit_resp_exec_sign" ><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinar</a>'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
								
								} else if(c_label_final == 'Cliente'){
									var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'<a href="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" style="padding:5px;" class="item-link item-content link edit_client_sign" ><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinar</a>'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
								} else if(c_label_final == 'Responsável Técnico'){
	
									if(type == 'a' || type == 'g' || type == 'r' ){ 
	
										var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
										'<a href="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" style="padding:5px;" class="item-link item-content link " ><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinar</a>'+
										'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div><br>';
									} else {
										var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
										'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
									}
								}  else {
									var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
								}
							} else {
								
								if(c_label_final == 'Responsável Técnico'){
									if(type == 'a' || type == 'g' || type == 'r' ){ 
										var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
										'<a href="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" style="padding:5px;" class="item-link item-content link " ><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinar</a>'+
										'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
									} else {
										var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
										'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
									}
								} else {
									var box_btn_sign = '<div id="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" class="box row js-signature-'+formID+'-'+j+' " ><div class="col-100 text-center">'+
									'<a href="/signature-page/'+formID+'/'+id_atividade+'/js-signature-'+formID+'-'+j+'/'+c_label_final+'" style="padding:5px;" class="item-link item-content link " ><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinar</a>'+
									'</div></div><div style="border-top: 1px solid gray;margin-bottom: 30px;margin-top: 5px;" class="col-100 text-center">Assinatura '+c_label+'</div>';
								}
							}
							$('#box_sig_cli').append(box_btn_sign);
						}
						$('#sjfb-fields').append(addFieldHTMLOff(fieldType,id_atividade,label,config,formID));
						var $currentField = $('#sjfb-fields .sjfb-field').last();
						$currentField.find('label').text(v['label']);
						if (v['choices']) {
							var uniqueID = formID;
							var name_radio = $currentField.find('label').text(c_label_final).prevObject[0].id;
							var name_check = $currentField.find('label').text(c_label_final).prevObject[0].id;
							var choose_type = "";
							var choose_choise = "";
							$.each( v['choices'], function( k, v ) {
								if (fieldType == 'select') {
									var selected = v['sel'] ? ' selected' : '';
									var choiceHTML = '<option' + selected + '>' + v['label'] + '</option>';
									$currentField.find(".choices").append(choiceHTML);
								}
	
								else if (fieldType == 'radio') {
									var selected = v['sel'] ? ' checked' : '';
								   if(v['label'] == 'Sim'){
									  choose_type = 'fa fa-thumbs-up';
									  choose_choise = 'yes_option';
								   } 
								   if(v['label'] == 'Não'){
									choose_type = 'fa fa-thumbs-down';
									choose_choise = 'no_option';
								   }
								   
								   if(v['label'] == 'N/A'){
									choose_type = 'fa fa-ban';
									choose_choise = 'na_option';
								   }
	
									var choiceHTML = '<label for="radio-' + i + '" class="col-33">'+
										'<input class="'+enable_disable+'" id="radio-' + i + '" type="radio" name="radio-' + name_radio + '" ' + selected + ' value="' + v['label'] + '" >'+
										'<div class="front-end box '+choose_choise+' ">'+
										  '<i class="'+choose_type+'"></i>'+
										'</div>'+
									'</label>';
									
									$currentField.find(".choices").append(choiceHTML);
								}
	
								else if (fieldType == 'checkbox') {
									var selected = v['sel'] ? ' checked' : '';
									/*var choiceHTML = '<label class="control control--checkbox item-checkbox item-content">'+
														'<input '+enable_disable+' id="ch_'+i+'" type="checkbox" name="checkbox-' + uniqueID + '[]"' + selected + ' value="' + v['label'] + '" />'+
														'<i class="icon icon-checkbox"></i>'+
														'<div class="item-inner">'+
														'<div class="item-title">' + v['label'] + '</div>'+
														'</div>'+
													'</label>'; */
	
									var choiceHTML = '<label class="col-12 item-content">'+
															'<div class="form-check mb-5 mr-5">'+
																'<input class="form-check-input styled-checkbox '+enable_disable+' " id="ch_'+i+'" type="checkbox" name="checkbox-'+name_check+'[]"' + selected + ' value="' + v['label'] + '" >'+
																'<label for="ch_'+i+'" class="form-check-label check-green ">' + v['label'] + '</label>'+
															'</div>'+
													 '</label>'; 
									$currentField.find(".choices").append(choiceHTML);
								}
								i++;
								
								$('.img_file').removeAttr('required');
								$('.img_file').removeAttr('required-choice');
							});
						}
	
						//Is it required?
						if (v['req']) {
							if (fieldType == 'file') {$currentField.find("input").prop('required',false).removeClass('required-choice') }
							else if (fieldType == 'text') { $currentField.find("input").prop('required',true).addClass('required-choice') }
							else if (fieldType == 'textarea') { $currentField.find("textarea").prop('required',true).addClass('required-choice') }
							else if (fieldType == 'select') { $currentField.find("select").prop('required',true).addClass('required-choice') }
							else if (fieldType == 'radio') { $currentField.find("input").prop('required',true).addClass('required-choice') }
							else if (fieldType == 'number') { $currentField.find("input").prop('required',true).addClass('required-choice') }
							else if (fieldType == 'date') { $currentField.find("input").prop('required',true).addClass('required-choice') }
							else if (fieldType == 'time') { $currentField.find("input").prop('required',true).addClass('required-choice') }
							$currentField.addClass('required-field');
						}
						j++;
	
					});
					setTimeout(function(){ 
						$(".calendar_date_time_check").click(function(e){
							e.preventDefault();
							var elmId = $(this).attr('id')
							var day , month , year, currentMonth , currentYear , currentDay , final_date , total_date , final_date_
							var calendarDateTime = app.calendar.create({
								inputEl: elmId,
								timePicker: false,
								dateFormat: 'dd/mm/yyyy',
								on: {
									change: function(p, dayContainer, year, month, day ){
								
									},
									dayClick: function (p, dayContainer, year, month, day) {
										if(month < 10){
											month = '0'+month;
										}
										var final_date = day+'/'+month+'/'+year;
										$$('#'+elmId).val(final_date)
										calendarDateTime.close();
									}
								}
							}); 
							calendarDateTime.open();
						});
						$(".calendar_time_check").click(function(e){
							e.preventDefault();
							var elmId = $(this).attr('id')
							var pickerDescribe = app.picker.create({
								inputEl: elmId,
								rotateEffect: true,
								cols: [
									{
									textAlign: 'left',
									values: ('01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20 21 22 23').split(' ')
									},
									{
									values: (':').split(' ')
									},
									{
									values: ('00 05 10 15 20 25 30 35 40 45 50 55').split(' ')
									},
								],
								on: {
									closed: function(p, dayContainer, year, month, day ){
										var hour_ = p.value[0];
										var min_ = p.value[2]; 
										var final_hour = p.value[0]+p.value[1]+p.value[2];
										$$('#'+elmId).val(final_hour)
										pickerDescribe.close();
									},
								}
							});
							pickerDescribe.open();
						});
					}, 200);
	
					$('#sjfb-fields').append('<div id="box_save_checklist" style="padding:10px;"><button style="width:100%;" type="submitt" class="scaleffect btn btn-primary save_check_list button">Salvar Atividades</button></div>');
					
					$$('.scaleffect').on('touchstart', function () {
						$$(this).addClass('box-scale'); 
					  });
					  $$('.scaleffect').on('touchend', function () {
						$$(this).removeClass('box-scale'); 
					  });
	
					if(status_det == 'Finalizado' || status_det == 'Concluído'){
						enable_disable = 'disabled';
						$("input,textarea,select").prop("disabled",true); 
						$('#box_save_checklist').hide();
	
						$("#phone_cliente").prop("disabled",false); 
						$("#zap_message").prop("disabled",false); 
					}
					setTimeout(function () {
						call_lista_atividades_off(id_form,id_atividade);
					}, 150);
					function call_lista_atividades_off(id_form,id_atividade) {
							var current_data = 0;
							let objectStore2 = db.transaction("tb_event_result").objectStore("tb_event_result");
							objectStore2.openCursor().onsuccess = function(event) {
							var cursor = event.target.result;
							if(cursor){
								if (cursor.value.at == id_atividade && cursor.value.formID == formID) { 
									var data_bd = cursor.value;
									var objData = JSON.parse(data_bd.data);
									$.each( objData, function( k, v ) {
										var statusdummy = "";
										var find_id = v['name'];
										var find_valor = v['value'];
										var rates = document.getElementsByName(find_id);
										var rate_value;
										
										for(var i = 0; i < rates.length; i++){
											if(find_valor == rates[i].value){
												if (find_id.indexOf('checkbox') > -1){
												} else {
													$("input[name="+find_id+"]").val([find_valor]);
												}
											} 
										}
			
										$$('input[name="'+find_id+'[]"]').each(function(){
											var res = find_valor.split(",");
											for(i = 0; i < res.length; i++) {
												if(res[i] == $(this).attr('value')){
														$(this).prop( "checked", true );
												} 
												}
										});
										if (find_id.indexOf('checkbox') > -1){
										} else {
											
											if (find_id.indexOf('select') > -1){
												$$("select[name="+find_id+"]").val([find_valor[0]]);
											} else if (find_id.indexOf('textarea') > -1){
												$$("textarea[id="+find_id+"]").val([find_valor[0]]);
											} else {
												$$("input[id="+find_id+"]").val([find_valor[0]]);
											}
										}
									});
								} else {
									current_data = 0;
									cursor.continue();
								}
							}
						};
						
						
						let objectStore3 = db.transaction("tb_event_result").objectStore("tb_event_result");
						objectStore3.openCursor().onsuccess = function(event) {
							var cursor3 = event.target.result;
							var find_id = "";
							var find_valor = "";
							var box_signature = "";
							if(cursor3){

								if (cursor3.value.IdEvento == id_atividade && cursor3.value.IdFormulario == formID) { 
									find_id = cursor3.value.campo;
									find_valor = cursor3.value.valor;
									var rates = document.getElementsByName(find_id);
								  	 var rate_value;

									for(var i = 0; i < rates.length; i++){
										if(find_valor == rates[i].value){
											//var els=document.getElementsByName(""+find_id+"");
											//els[i].value = find_valor;
											if (find_id.indexOf('checkbox') > -1){
												//console.log(find_id)
											} else {
												$("input[name="+find_id+"]").val([find_valor]);
											}
										  } 
									  }
	
									  $$('input[name="'+find_id+'[]"]').each(function(){
										var res = find_valor.split(",");
										  for(i = 0; i < res.length; i++) {
											  if(res[i] == $(this).attr('value')){
													  $(this).prop( "checked", true );
											  } 
											}
									  });
	
									  if (find_id.indexOf('js-signature') > -1){
	
										if($('.'+find_id)[0]){
											var my_box_link = $('.'+find_id)[0].id;
	
											if(find_valor == null || find_valor == 'null'){
												find_valor = '';
											} else {
												find_valor = find_valor;
											}
	
											if(status_det == 'Concluído'){
												box_signature =  '<div class="title-col-100" style="padding:10px">'+
												'<h6 style="width: 100%;">'+
													'<img class="has_sign_tec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura"></h6>'+
												'</div>';
											
											
											
											} else if(status_det == 'Finalizado'){
												if(my_box_link){
													var res_type = my_box_link.split("/");
													res_type = res_type.slice(-1).pop();
													
													var img_valor_ = "";
													var img_valor__ = "";
	
													if(res_type == 'Responsável Técnico'){
														
														if(type == 'a' || type == 'g' || type == 'r' ){
															if(find_valor == ''){
																var img_valor_ = '';
															} else {
																img_valor_ = '<img class="has_sign_tec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
															}
															
															
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
															'<a href="'+my_box_link+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
															'<h6 style="width: 100%;">'+
															img_valor_+'</h6>'+
															'</div>';
														} else {
	
															if(find_valor == ''){
																var img_valor_ = '';
															} else {
																img_valor_ = '<img class="has_sign_tec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
															}
	
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
															'<h6 style="width: 100%;">'+
															img_valor_+'</h6>'+
															'</div>';
														}
	
														
													} else if(res_type == 'Responsável Execução'){
														
														if(type == 'a' || type == 'g' || type == 'r' ){
															if(find_valor == ''){
																var img_valor_ = '';
															} else {
																img_valor_ = '<img class="has_sign_resp_exec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
															}
															
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
																'<a href="'+my_box_link+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
																'<h6 style="width: 100%;">'+
																img_valor_+'</h6>'+
																'</div>';
														} else {
	
															if(find_valor == ''){
																var img_valor_ = '';
															} else {
																img_valor_ = '<img class="has_sign_resp_exec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
															}
	
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
														'<h6 style="width: 100%;">'+
														img_valor_+'</h6>'+
														'</div>';
														}
													} else {
	
														if(type == 'a' || type == 'g' || type == 'r' ){
															if(find_valor == ''){
																var img_valor__ = '';
															} else {
																img_valor__ = '<img class="has_sign_resp_client" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
															}
		
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
																'<a href="'+my_box_link+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
																'<h6 style="width: 100%;">'+
																img_valor__+'</h6>'+
																'</div>';
														} else {
															if(find_valor == ''){
																var img_valor__ = '';
															} else {
																img_valor__ = '<img class="has_sign_resp_client" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
															}
	
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
															'<h6 style="width: 100%;">'+
															img_valor__+'</h6>'+
															'</div>';
														}
													}
	
												}
											} else {
												if(my_box_link){
													var res_type = my_box_link.split("/");
													res_type = res_type.slice(-1).pop();
													var img_valor = "";
													if(res_type == 'Responsável Execução'){
														if(find_valor == ''){
															var img_valor = '';
														} else {
															img_valor = '<img class="has_sign_rest_exec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
														}
													
														box_signature =  '<div class="title-col-100" style="padding:10px">'+
														'<a href="'+my_box_link+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
														'<h6 style="width: 100%;">'+
														img_valor+'</h6>'+
														'</div>';
													} else if(res_type == 'Cliente'){
														var img_valor__ = "";
														if(find_valor == ''){
															var img_valor__ = '';
														} else {
															img_valor__ = '<img class="has_sign_client" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
														}

														box_signature =  '<div class="title-col-100" style="padding:10px">'+
														'<a href="'+my_box_link+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
														'<h6 style="width: 100%;">'+
														img_valor__+'</h6>'+
														'</div>';
													} else {
	
														var img_valor__ = "";
														if(find_valor == ''){
															var img_valor__ = '';
														} else {
															img_valor__ = '<img class="has_sign_tec" id="'+my_box_link+'" src="'+find_valor+'" alt="Assinatura">';
														}
	
														if(type == 'a' || type == 'g' || type == 'r' ){
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
															'<a href="'+my_box_link+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
															'<h6 style="width: 100%;">'+
															img_valor__+'</h6>'+
															'</div>';
														} else {
															box_signature =  '<div class="title-col-100" style="padding:10px">'+
															'<h6 style="width: 100%;">'+
															img_valor__+'</h6>'+
															'</div>';
														}

													}
												}
											}
											$('.'+find_id).html(box_signature);
										}
										
									} else {
										if (find_id.indexOf('checkbox') > -1){
											//console.log(find_id)
										} else {
											
											if (find_id.indexOf('select') > -1){
												console.log(find_id)
												$("select[name="+find_id+"]").val([find_valor]);
											} else {
												//console.log(find_id)
												$("input[name="+find_id+"]").val([find_valor]);
											}
											
										}
									}									
									cursor3.continue();
								} else {
									current_data = 0;
									cursor3.continue();
								}
							}
						};
					}
	
	
					$("input[type='text']").change( function() {
						if(this.value){
							$(this).css("border", "1px solid #dddfe1;");
						}
					});
	
					$('.save_check_list').on('click', function (e) {
						e.preventDefault();
						var requiredElements = document.getElementById("sjfb-sample").querySelectorAll("[required]"),
						c = document.getElementById("check"),
						o = document.getElementById("output");
	
						var s = "";
						for (var i = 0; i < requiredElements.length; i++) {
							var e = requiredElements[i];
							if(e.value.length > 0){
								$( '#'+e.id+'' ).css("border", "1px solid #e6e6e6");
	
							} else {
									var targetOffset = $('#'+e.id+'').offset().top - $(window).scrollTop();
									$('.page-content').animate({ 
										scrollTop: targetOffset + 20
									}, 600);
									$( '#'+e.id+'' ).focus();
									$( '#'+e.id+'' ).blur();
									$( '#'+e.id+'' ).css("border", "1px solid #f44336");
									toast_message = app.toast.create({text: 'Campo obrigatório',closeTimeout: 3000,cssClass: 'error_toast'});
									toast_message.open();
									return false;
							}
	
						}
	
						var x = $('#sjfb-sample').serializeArray();
						var output = [];
						x.forEach(function(value) {
						var existing = output.filter(function(v, i) {
							return v.name == value.name;
						});
						if (existing.length) {
							var existingIndex = output.indexOf(existing[0]);
							output[existingIndex].value = output[existingIndex].value.concat(value.value);
						} else {
							if (typeof value.value == 'string')
							value.value = [value.value];
							output.push(value);
						}
						});
				
						function isEmpty(obj) {
							for(var key in obj) {
								if(obj.hasOwnProperty(key))
									return false;
							}
							return true;
						}
						var data = JSON.stringify(output);
						var data_value = JSON.stringify(output);
						var request = window.indexedDB.open('AnyInspect_dnata', 3);
						var db;
						request.onsuccess = function (event) {
						db = request.result;
							setTimeout(function(){
								var current_data = 0;
								let objectStore2 = db.transaction("tb_save_event").objectStore("tb_save_event");
								objectStore2.openCursor().onsuccess = function(event) {
								var cursor = event.target.result;
								if(cursor){
									if (cursor.value.at == id_atividade && cursor.value.formID == formID) {
										console.log('e igual o id e form')
										data = cursor.value;
										current_data = 1;
										var key = cursor.key;
										var objectStore = db.transaction(['tb_save_event'], "readwrite").objectStore('tb_save_event');
										var request = objectStore.get(key);
										request.onerror = function(event) {
										};
										request.onsuccess = function(event) {
										var data = request.result;
										data.data = data_value;
										var requestUpdate = objectStore.put(data);
										requestUpdate.onerror = function(event) {
											var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
											toast_message.open();
										};
										requestUpdate.onsuccess = function(event) {
											var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
											toast_message.open();
										};
										};																	
									} else {
										current_data = 0;
										cursor.continue();
									}
								} else {
									var request = window.indexedDB.open('AnyInspect_dnata', 3);
									var dbsavebdhist;
									var IdEvent;
									request.onsuccess = function (event) {
									dbsavebdhist  = request.result;
									setTimeout(function(){
										var store = dbsavebdhist.transaction(["tb_save_event"], "readwrite")
										.objectStore("tb_save_event")
										.add({ formID:formID ,at:id_atividade, data: data});
										store.onsuccess = function(event) {
											IdEvent = event.target.result;
											dbsavebdhist.close(); 
											var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'success_toast'});
											toast_message.open();
										}
										store.onerror = function(event) {
											var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
											toast_message.open();
										}
										} , 200)
									}; 
								}
								};
							}, 500);
						};
					});
				}
			} 
		}  else{
			cursor.continue();
		  }
		}
	}, 500);
}

var k = 0 ;
function addFieldHTMLOff(fieldType,id_atividade,label,config,formID) {
	k++;
	var uniqueID = formID;
	var rand = formID;
	var box_single_box = "";
	if(config.image_single == 1){
		box_single_box = '<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
							'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
							'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
							'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
						'</div>';
	} else {
		
		if(label == 'Observações'){
			box_single_box = '<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
							'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
							'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
							'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
						'</div>';
		} else {
			box_single_box = '<div style="margin-top:20px;"></div>';
		}
	}
	switch (fieldType) {
		case 'text':
		return '' +
				'<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-text field_elements ">' +
				'<div class="block" ><label for="text-' + uniqueID + '" class="block-title" ></label></div>' +
					'<input name="text-'+uniqueID+'-'+k+'" class="form-control" type="text" id="text-'+uniqueID +'-'+k+'">' +
					box_single_box+

				'</div>';
		case 'number':
		return '' +
				'<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-number field_elements ">' +
				'<div class="block" ><label for="number-' + uniqueID + '" class="block-title" ></label></div>' +
					'<input name="number-'+uniqueID+'-'+k+'" class="form-control" type="number" id="number-'+uniqueID +'-'+k+'">' +
					box_single_box+
				'</div>';
		case 'date':
		return '' +
				'<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-date field_elements ">' +
				'<div class="block" ><label for="date-' + uniqueID + '" class="block-title" ></label></div>' +
					'<input name="date-'+uniqueID+'-'+k+'" class="form-control calendar_date_time_check" type="text" id="date-'+uniqueID +'-'+k+'">' +
					box_single_box+
				'</div>';
		case 'time':
		return '' +
				'<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-time field_elements ">' +
				'<div class="block" ><label for="time-' + uniqueID + '" class="block-title" ></label></div>' +
					'<input name="time-'+uniqueID+'-'+k+'" class="form-control calendar_time_check" type="text" id="time-'+uniqueID +'-'+k+'">' +
					box_single_box+
				'</div>';
				
		case 'textarea':
			return '' +
				'<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-textarea field_elements">' +
					'<div class="block" ><label for="textarea-' + uniqueID + '" class="block-title"></label></div>' +
					'<textarea class="form-control form-control-lg" name="textarea-'+ uniqueID +'-'+k+'"  id="textarea-' + uniqueID +'-'+k+'"></textarea>' +
					box_single_box+
				'</div>';

		case 'select':
			return '' +
				'<div id="sjfb-' + uniqueID +'" class="sjfb-field sjfb-select field_elements">' +
					'<div class="block" ><label for="select-' + uniqueID + '" class="block-title"></label></div>' +
					'<select name="select-' + uniqueID +'-'+k+'" id="select-' + uniqueID +'-'+k+'" class="form-control choices choices-select"></select>' +
					box_single_box+
				'</div>';

		case 'radio':

			return '' +
				'<div id="sjfb-'+uniqueID+'-'+k+'" class="list sjfb-field sjfb-radio field_elements">' +
					'<div class="block" ><label class="block-title"></label></div>' +
					'<li class="row choices choices-radio"></li>' +
					box_single_box+
				'</div>';

		case 'checkbox':
			return '' +
				'<div id="sjfb-'+uniqueID+'-'+k+'" class="list sjfb-field sjfb-checkbox field_elements">' +
					'<div class="block" ><label class="block-title"></label></div>' +
					'<li class="choices choices-checkbox"></li>' +
					box_single_box+
				'</div>';
		case 'section':

			if(label == 'Assinaturas'){
				return '' +
				'<div id="sjfb-section-' + uniqueID +'" class="sjfb-field sjfb-section required-field" style="background: #ffffff;color: #fff;margin-bottom: 0px;padding: 0;border-bottom: 0px;">' +
				'<label class="block-title" style="color:#fff;"></label>' +
				'</div>';
			} else {

			
				return '' +
				'<div id="sjfb-section-' + uniqueID +'" class="sjfb-field sjfb-section required-field" style="background:#d0d0d0;color:#333;margin-bottom: 0px;padding: 5px;border-bottom: 0px;">' +
				'<label class="block-title" style="padding: 5px;"></label>' +
				'</div>';
			}
				

		case 'agree':
			return '' +
				'<div id="sjfb-agree-' + uniqueID +'" class="sjfb-field sjfb-agree required-field">' +
				'<input name="checkbox-' + uniqueID +'-'+k+'" type="checkbox" required>' +
				'<label class="block-title"></label>' +
				'</div>'
	}
}

}



// COMMENTS SAVE
function save_comment_off(id_element,id_booking){
	var comment = $$('#new_comment_element').val();
	var comment_el = "";
	if(comment != ""){
		var request = window.indexedDB.open('AnyInspect_dnata', 3);
		var dbsavebdhist;
		var IdEvent;
		request.onsuccess = function (event) {
		dbsavebdhist  = request.result;
		setTimeout(function(){
			var store = dbsavebdhist.transaction(["tb_save_event_comment"], "readwrite")
			.objectStore("tb_save_event_comment")
			.add({ id_booking:id_booking ,id_element:id_element, comment: comment});
			store.onsuccess = function(event) {
				IdEvent = event.target.result;
				dbsavebdhist.close(); 

				comment_el += '<section class="year">'+
						'<section>'+
						'<ul>'+
						'<li>'+comment+'<br><small>'+date_create+'</small></li>'+
						'</ul>'+
						'</section>'+     
					'</section>';
					$$('#comment_list').append(comment_el);
				var toast_message = app.toast.create({text: 'Salco com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
				toast_message.open();
				
				$$('#new_comment_element').val('');
			}
			store.onerror = function(event) {
				var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
				toast_message.open();
			}
			} , 200)
		}; 
	} else {
		toast_message = app.toast.create({text: 'Digite algum comentário',closeTimeout: 3000,cssClass: 'error_toast'});
		toast_message.open();
	}	
}


// COMMENTS SAVE
function save_pa_off(id_element,id_booking){
	var what_at = $$('#what_at').val();
	var why_at = $$('#why_at').val();
	var how_at = $$('#how_at').val();
	var resp_at = $$('#resp_at').val();
	var where_at = $$('#where_at').val();
	var when_at = $$('#when_at').val();
	var cost_at = $$('#cost_at').val();
	$.ajax({
		url:  current_path+"/controller/update_pa",
		type : 'POST',
		dataType: 'JSON',
		data: {
			id_booking: id_booking,
			id_element: id_element,
			what_at: what_at,
			why_at: why_at,
			how_at: how_at,
			resp_at: resp_at,
			where_at: where_at,
			when_at: when_at,
			cost_at: cost_at
		},
		success: function(response){
			status = response.status;
			if(status == "SUCCESS") {
				toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 3000,cssClass: 'success_toast'});
				toast_message.open();

			} else {
				toast_message = app.toast.create({text: 'Erro ao salvar',closeTimeout: 3000,cssClass: 'error_toast'});
				toast_message.open();

			}

		}
	}); 
}


//START UPDATE FUNCTION
function save_event(dateTime) {
	var Idtubulacao = $('#Idtubulacao').val();
	var Observacao = $('#Observacao').val();
	var Localizacao = $('#local').val();
	var user_id = Utils.userData();
	var IdUsuario = user_id.id;
	var Idtubhist = "";
	var request = window.indexedDB.open('Braskem', 1);
	var dbsavebdhist;
	request.onsuccess = function (event) {
	dbsavebdhist  = request.result;
	
	setTimeout(function(){
		  var store = dbsavebdhist.transaction(["tb_tubulacao_local"], "readwrite")
		  .objectStore("tb_tubulacao_local")
		  .add({ Idtubulacao:Idtubulacao ,IdUsuario:IdUsuario, Localizacao: Localizacao, DataRegistro:dateTime , Observacao:Observacao });		  
		  store.onsuccess = function(event) {
			Idtubhist = event.target.result;
			dbsavebdhist.close(); 
			var toast_message = app.toast.create({text: 'Registrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
			toast_message.open();
		  }
		  store.onerror = function(event) {
			var toast_message = app.toast.create({text: 'Erro ao registrar localização!',closeTimeout: 2000,cssClass: 'error_toast'});
                toast_message.open();    
		  }
		} , 200)
	  };
	}
function update_data(table,key,message){
	var objectStore = db.transaction([table], "readwrite").objectStore(table);
	var request = objectStore.get(key);
	request.onerror = function(event) {
	};
	request.onsuccess = function(event) {
	var data = request.result;
	data.gps_lat = message.gps_lat;
	data.gps_lon = message.gps_lon;
	var requestUpdate = objectStore.put(data);
	requestUpdate.onerror = function(event) {
	};
	requestUpdate.onsuccess = function(event) {
	};
	};
}

function altera_status_off(eventID,the_status,id_funcionario,id_form,configs,id_groups,det_info){
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	let IdUser = user_info.id;
	let id_user = user_info.id;
	let type = user_info.type;
	var has_sign_client = "";
	var has_sign_exec = "";
	var has_sign_tec = "";
	var config = configs;
	var id_group = id_groups;
	var txt_confirma;
	var loadLocation = "";
	var start_lat = det_info.start_lat;
	var id = det_info.id;
	var qrcode = det_info.qrcode;
	var qr_checkin_info = det_info.qr_checkin;

		if(the_status == 'comecar'){
			txt_confirma = 'Iniciar Atividade';
			if(config.geo_location == 1){
				if(start_lat == ''){
					if(config.qr_check_in == 0){
						app.views.main.router.navigate('/gps-signin/0/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form+'/'+configs+'/'+id_groups+'/'+det_info);
						return;
					} else {
						app.views.main.router.navigate('/gps-signin/1/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form+'/'+configs+'/'+id_groups+'/'+det_info);
						return;
					}
				} else {
					if(config.qr_check_in == 1){
						app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form+'/'+configs+'/'+id_groups+'/'+det_info);
						return;
					} 
				}
			
			} else {
				if(config.qr_check_in == 1){
					app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
					return;
				} 
			}
		}
		if(the_status == 'finalizar'){
			txt_confirma = 'Enviar Aprovação';
		}

		if(the_status == 'cancelar'){
			txt_confirma = 'Cancelar Atividade';
		}
		
	//}


	if(the_status != 'comecar'){
		if(config.signature_exec == 1){
			has_sign_exec = $$(".has_sign_rest_exec").attr('src');
			if(has_sign_exec == undefined || has_sign_exec == "undefined"){
				var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Execução!',closeTimeout: 2000,cssClass: 'error_toast'});
				toast_message.open();
				return;
			} else {
				if(config.signature == 1){
					has_sign_client = $$(".has_sign_client").attr('src');
					if(has_sign_client == undefined || has_sign_client == "undefined"){
						var toast_message = app.toast.create({text: 'Obrigatório Assinatura Cliente',closeTimeout: 2000,cssClass: 'error_toast'});
						toast_message.open();
						return;
					} 
				} 
			}
		} 
	} 

	if(the_status == 'concluido'){
		if(config.flow_approve == 1){
			var has_sign_tec = $$(".has_sign_tec").attr('src');
			if(has_sign_tec == undefined || has_sign_tec == "undefined"){
				var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
				toast_message.open();
				return;
			}
		} else {
			$$('#box_finish_action').html('');
		}
	}
	if(the_status == 'finalizar'){
		if(config.flow_approve == 1){
			if(type == 'a' || type == 'r' || type == 'g'){
				var has_sign_tec = $$(".has_sign_tec").attr('src');
				if(has_sign_tec == undefined || has_sign_tec == "undefined"){
					var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
					toast_message.open();
					return;
				}
			}

		} else {
			the_status = 'concluido';	
		}
		
	}
	
	var objectStore1 = db.transaction(['tb_events_group'], "readwrite").objectStore('tb_events_group');
	var request1 = objectStore1.get(eventID);
	request1.onerror = function(event) {
		// Tratar erro
	};
	request1.onsuccess = function(event) {
		var data1 = request1.result;

		var the_status_final;

		if( the_status == "comecar"){
		the_status_final = "Em Andamento";
		}	else if(the_status == "cancelar"){
		the_status_final = "Cancelado";
		}	else if(the_status == "reprovar"){
		the_status_final = "Cancelado";
		} else if(the_status == "finalizar"){
		the_status_final = "Finalizado";
		} else if(the_status == "concluido"){
		the_status_final = "Concluído";
		}

		data1.status_ = the_status_final;
		var requestUpdate = objectStore1.put(data1);
		requestUpdate.onerror = function(event) {
		};
		requestUpdate.onsuccess = function(event) {
			
		}
	};
	var objectStore = db.transaction(['tb_single'], "readwrite").objectStore('tb_single');
              var request = objectStore.get(eventID);
              request.onerror = function(event) {
              };
              request.onsuccess = function(event) {
              var data = request.result;
  			  var the_status_final;

			  if( the_status == "comecar"){
				the_status_final = "Em Andamento";
			  }	else if(the_status == "cancelar"){
				the_status_final = "Cancelado";
			  }	else if(the_status == "reprovar"){
				the_status_final = "Cancelado";
			  } else if(the_status == "finalizar"){
				the_status_final = "Finalizado";
			  } else if(the_status == "concluido"){
				the_status_final = "Concluído";
			  }

              data.status_ = the_status_final;
              var requestUpdate = objectStore.put(data);
              requestUpdate.onerror = function(event) {
              };
              requestUpdate.onsuccess = function(event) {
				status = data.status;
				var box_aprovacao = "";
				
				if(the_status == 'comecar'){
					$$('#btn_action_service').html('');
					$$('#status_servico').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.status_activity').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');

					setTimeout(function(){
						$$('#box_sig_cli').html('');
						$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
						call_open_events_off();
						call_open_events_groups_off(id_group);
						get_info_gerais_off(eventID);
					}, 200);

					box_aprovacao = '<div class="col-100">'+
												'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
												'</div>';
					$$('#box_finish_action').html(box_aprovacao);
					
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();


					setTimeout(function(){
					$$('.change_status_approve').on('click', function (e) {
						e.preventDefault();
						let the_status = this.id;
						var txt_confirma;				
						if(the_status == 'concluido'){
							txt_confirma = 'Aprovar a Atividade';
								if(config.flow_approve == 1){
									var has_sign_tec = $$(".has_sign_tec").attr('src');
									if(has_sign_tec == undefined || has_sign_tec == "undefined"){
										var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
										toast_message.open();
										return;
									}
								} else {
									$$('#box_finish_action').html('');
								}
						} 
						if(the_status == 'reprovado'){
							txt_confirma = 'Reprovar a Atividade';
			
							var open_modal_approve = app.sheet.create({
								el: '.open_modal_approve',
								swipeToClose: false,
								swipeToStep: false,
								backdrop: true,
								closeByBackdropClick: false,
								closeByOutsideClick: false
							});
								
							open_modal_approve.open();
										var manual_tag = "";
											manual_tag = 
												'<div class="item-inner">'+
													'<div class="item-input-wrap">'+
														'<br>'+
														'<textarea id="reprove_message_" cols="30" rows="10" placeholder="Digite sua Justificativa"></textarea>'+
														'<br><button class="btn scaleffect no-active-state button btn_confirma_reprove">Confirmar</button><br><br><button style="background:#F44336" class="btn button scaleffect no-active-state close_manual" id="close_manual" >Cancelar</button>'+
													'</div>'+
												'</div>'+
										$$('#box_noapprove').html(manual_tag);
										$$('.close_manual').on('click', function (e) {
											e.preventDefault();
											open_modal_approve.close();
										});
										
										$$('.btn_confirma_reprove').on('click', function (e) {
											e.preventDefault();
											var repprove_message = $$('#reprove_message_').val();
											fetch(current_path+'/view/repprove_event', {
												method: 'POST',
												headers : new Headers(),
												body:JSON.stringify({
													repprove_message:repprove_message,
													eventID:eventID,
													acao:the_status,
													id_funcionario:id_funcionario
												})
												}).then((res) => res.json())
												.then((data) =>  {
													var status ;
													status = data.status;
													if(status == 'SUCCESS'){

														console.log('the_status concluido - ' + the_status)
							
														if(the_status == 'reprovado'){
															$$('#btn_action_service').html('<button id="comecar" class="btn button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
															$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
															$$('#box_finish_action').html('');
														
														} else {
															$$('#box_finish_action').html('');
														}
														
														open_modal_approve.close();
														let user_info = Utils.userData();
														if(user_info == null || user_info == 'null'){
															app.views.main.router.navigate({ name: 'sign-in' });
														}
														let IdUser = user_info.id;
														let type = user_info.type;
														$$('#box_sig_cli').html('');
														$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
														get_info_gerais(eventID);
														call_open_events();
														call_open_events_groups(id_group);
														
													}
											
											})
											.catch((err)=>console.log(err))
										
										});
			
						} else {	
							app.dialog.confirm('Você tem certeza que deseja '+txt_confirma+' ?','Confirmação ', function () {
								fetch(current_path+'/view/alteraStatus', {
								method: 'POST',
								headers : new Headers(),
								body:JSON.stringify({
									eventID:eventID,
									acao:the_status,
									id_funcionario:id_funcionario,
									id_form:id_form
								})
								}).then((res) => res.json())
								.then((data) =>  {
									var status ;
									status = data.status;
									if(status == 'SUCCESS'){
										if(the_status == 'concluido'){
											$$('#btn_action_service').html('');
											$$('#status_servico').html('<div class="content status_concluido"><span class="status_concluido ">Concluído</span></div>');
											var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
											toast_message.open();
										}
			
										if(the_status == 'reprovar'){
											$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
											$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
										
										}
										let user_info = Utils.userData();
										if(user_info == null || user_info == 'null'){
											app.views.main.router.navigate({ name: 'sign-in' });
										}
										let IdUser = user_info.id;
										let type = user_info.type;
										$$('#box_sig_cli').html('');
										$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
										$$('#box_finish_action').remove();
										call_open_events();
										get_info_gerais(eventID);
										call_open_events_groups(id_group);
									}
							
							})
							.catch((err)=>console.log(err))
							});
						
						}
					});
					}, 500);						
				}
				
				else if(the_status == 'Em Andamento'){
					$$('#status_servico').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.status_activity').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
					box_aprovacao = '<div class="col-100">'+
												'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
												'</div>';
					$$('#box_finish_action').html(box_aprovacao);
					setTimeout(function(){
						$$('#box_sig_cli').html('');
						$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
						call_open_events_off();
						call_open_events_groups_off(id_group);
						get_info_gerais_off(eventID);
					}, 200);
					
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
										
				}
				else if(the_status == 'cancelar'){
					$$('#btn_action_service').html('<button class="button btn_status_cancelado">Cancelado</button>');
					$$('#status_servico').html('<div class="content status_cancelado"><span class="">Cancelado</span></div> ');
					$$('.status_activity').html('<div class="content status_cancelado"><span class="">Cancelado</span></div> ');
					open_manual_Tag.close();
					let user_info = Utils.userData();
					if(user_info == null || user_info == 'null'){
						app.views.main.router.navigate({ name: 'sign-in' });
					}
					let IdUser = user_info.id;
					let type = user_info.type;
					//get_open_service(IdUser,type);
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
				
				}
				
				else if(the_status == 'finalizar'){
					let user_info = Utils.userData();
					if(user_info == null || user_info == 'null'){
						app.views.main.router.navigate({ name: 'sign-in' });
					}
					let IdUser = user_info.id;
					let type = user_info.type;
					var has_sign_client = "";
					var has_sign_exec = ""
					if(config.signature_exec == 1){
						has_sign_exec = $$(".has_sign_rest_exec").attr('src');
						if(has_sign_exec == undefined || has_sign_exec == "undefined"){
							var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Execução!',closeTimeout: 2000,cssClass: 'error_toast'});
							toast_message.open();
							return;
						} else {
							if(config.signature == 1){
								has_sign_client = $$(".has_sign_client").attr('src');
								if(has_sign_client == undefined || has_sign_client == "undefined"){
									var toast_message = app.toast.create({text: 'Obrigatório Assinatura Cliente',closeTimeout: 2000,cssClass: 'error_toast'});
									toast_message.open();
									return;
								} else {
									if(type == 'a' || type == 'g' || type == 'r' ){
										$$('#box_finish_action').html('<button style="float:left;width:48%;margin-right:5px;font-size:16px;height:45px;" id="concluido" class="status_approve  button btn_approve change_status_approve scaleffect">Aprovar</button><button id="reprovado"  style="float:left;width:48%;font-size:16px;height:45px;" class="btn_repprove status_repprove button btn_status_reprovar change_status_approve scaleffect">Reprovar</button>');
										
									} else {
										$$('#box_finish_action').html('');
									}
									$$('#status_servico').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
									$$('.status_activity').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
								}
							} else {
								if(type == 'a' || type == 'g' || type == 'r' ){
									$$('#box_finish_action').html('<button style="float: left;width:48%;margin-right:5px;font-size:16px;height:45px;" id="concluido" class="status_approve  button btn_approve change_status_approve scaleffect">Aprovar</button><button id="reprovado"  style="float:left;width:48%;font-size:16px;height:45px;" class="btn_repprove status_repprove button btn_status_reprovar change_status_approve scaleffect">Reprovar</button>');
									
								} else {
									$$('#box_finish_action').html('');
								}
								$$('#status_servico').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
								$$('.status_activity').html('<div class="content status_finalizado"><span class="">Finalizado</span></div>');
							}
						}
					} 
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();

					$$("input,textarea,select").prop("disabled",true); 
					$$('#box_save_checklist').hide();
					$$('#box_images_up').hide();
					$$("#phone_cliente").prop("disabled",false); 
					$$("#zap_message").prop("disabled",false); 
					$$('.change_status_approve').on('click', function (e) {
						e.preventDefault();
						let the_status = this.id;
						var txt_confirma;			
						if(the_status == 'concluido'){
							txt_confirma = 'Aprovar a Atividade';

							if(config.flow_approve == 1){
								var has_sign_tec = $$(".has_sign_tec").attr('src');
								if(has_sign_tec == undefined || has_sign_tec == "undefined"){
									var toast_message = app.toast.create({text: 'Obrigatório Assinatura Responsável Técnico!',closeTimeout: 2000,cssClass: 'error_toast'});
									toast_message.open();
									return;
								}
							}
						} 
						if(the_status == 'reprovado'){
							txt_confirma = 'Reprovar a Atividade';
			
							var open_modal_approve = app.sheet.create({
								el: '.open_modal_approve',
								swipeToClose: false,
								swipeToStep: false,
								backdrop: true,
								closeByBackdropClick: false,
								closeByOutsideClick: false
							});
								
							open_modal_approve.open();
										var manual_tag = "";
											manual_tag = '<li class="item-content item-input">'+
												'<div class="item-inner">'+
													'<div class="item-input-wrap">'+
														'<br>'+
														'<textarea id="reprove_message_" cols="30" rows="10" placeholder="Digite sua Justificativa"></textarea>'+
														'<br><button class="btn scaleffect no-active-state button btn_confirma_reprove">Confirmar</button><br><br><button style="background:#F44336" class="btn button scaleffect no-active-state close_manual" id="close_manual" >Cancelar</button>'+
													'</div>'+
												'</div>'+
											'</li>';
			
										$$('#box_noapprove').html(manual_tag);
										$$('.close_manual').on('click', function (e) {
											e.preventDefault();
											open_modal_approve.close();
										});
										$$('.btn_confirma_reprove').on('click', function (e) {
											e.preventDefault();
											var repprove_message = $$('#reprove_message_').val();
											fetch(current_path+'/view/repprove_event', {
												method: 'POST',
												headers : new Headers(),
												body:JSON.stringify({
													repprove_message:repprove_message,
													eventID:eventID,
													acao:the_status,
													id_funcionario:id_funcionario
												})
												}).then((res) => res.json())
												.then((data) =>  {
													var status ;
													status = data.status;
													if(status == 'SUCCESS'){
														if(the_status == 'reprovado'){
															$$('#btn_action_service').html('<button id="comecar" class="btn button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
															$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
															$$('#box_finish_action').html('');
														
														} else {
															$$('#box_finish_action').html('');
														}
														open_modal_approve.close();
														let user_info = Utils.userData();
														if(user_info == null || user_info == 'null'){
															app.views.main.router.navigate({ name: 'sign-in' });
														}
														let IdUser = user_info.id;
														let type = user_info.type;
														$$('#box_sig_cli').html('');
														$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
														get_info_gerais(eventID)
														call_open_events();
														call_open_events_groups(id_group);	
													}
											})
											.catch((err)=>console.log(err))
										
										});
			
						} else {
							app.dialog.confirm('Você tem certeza que deseja '+txt_confirma+' ?','Confirmação ', function () {
								fetch(current_path+'/view/alteraStatus', {
								method: 'POST',
								headers : new Headers(),
								body:JSON.stringify({
									eventID:eventID,
									acao:the_status,
									id_funcionario:id_funcionario,
									id_form:id_form
								})
								}).then((res) => res.json())
								.then((data) =>  {
									var status ;
									status = data.status;
									if(status == 'SUCCESS'){
										if(the_status == 'concluido'){
											$$('#btn_action_service').html('');
											$$('#status_servico').html('<div class="content status_concluido"><span class="status_concluido ">Concluído</span></div>');
											var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
											toast_message.open();
										}
										if(the_status == 'reprovar'){
											$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
											$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
										
										}
										let user_info = Utils.userData();
										if(user_info == null || user_info == 'null'){
											app.views.main.router.navigate({ name: 'sign-in' });
										}
										let IdUser = user_info.id;
										let type = user_info.type;
										$$('#box_sig_cli').html('');
										$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
											get_info_gerais(eventID)
										call_open_events();
										call_open_events_groups(id_group);
									}
							
							})
							.catch((err)=>console.log(err))
							});
						
						}
					});
					$$('#box_sig_cli').html('');
					$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
					get_info_gerais_off(eventID)
					call_open_events_off();
					call_open_events_groups_off(id_group);
				}
				
				else if(the_status == 'concluido'){
					$$('#btn_action_service').html('');
					$$('#box_save_checklist').html('');
					$$('#status_servico').html('<div class="content status_concluido "><span class="">Concluído</span></div> ');
					$$('.status_activity').html('<div class="content status_concluido "><span class="">Concluído</span></div> ');
					let user_info = Utils.userData();
					if(user_info == null || user_info == 'null'){
						app.views.main.router.navigate({ name: 'sign-in' });
					}
					let IdUser = user_info.id;
					let type = user_info.type;
					//get_open_service(IdUser,type);
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();

					if(config.flow_approve == 0){
						$('#box_finish_action').html('');
					}
					$$('#box_sig_cli').html('');
					$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
					get_info_gerais_off(eventID)
					call_open_events_off();
					call_open_events_groups_off(id_group);
				}
				else if(the_status == 'reprovar'){
					$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
					$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
					$$('.status_activity').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
					$$('#box_sig_cli').html('');
					$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
					get_info_gerais_off(eventID)
					call_open_events_off();
					call_open_events_groups_off(id_group);
				}

              };
              };
}

  function getDateTime() {
	var now     = new Date(); 
	var year    = now.getFullYear();
	var month   = now.getMonth()+1; 
	var day     = now.getDate();
	var hour    = now.getHours();
	var minute  = now.getMinutes();
	var second  = now.getSeconds(); 
	if(month.toString().length == 1) {
		 month = '0'+month;
	}
	if(day.toString().length == 1) {
		 day = '0'+day;
	}   
	if(hour.toString().length == 1) {
		 hour = '0'+hour;
	}
	if(minute.toString().length == 1) {
		 minute = '0'+minute;
	}
	if(second.toString().length == 1) {
		 second = '0'+second;
	}   
	var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;   
	 return dateTime;
  }

