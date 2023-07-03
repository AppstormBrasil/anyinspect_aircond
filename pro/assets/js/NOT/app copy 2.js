"use strict";
// Dom7

var $$ = Dom7;
var toast_message ;

// Framework7 App main instance
var app  = new Framework7({
	root: '#app', // App root element
	id: 'com.anyinspect.pro',
	name: 'Framework7', // App name
	theme: 'ios', 
	// App root methods
	methods: {
		helloWorld: function () {
		app.dialog.alert('Hello World!');
		},
	},
	view: {
		iosDynamicNavbar: false,
		xhrCache: false,
	},
	smartSelect: {
		popupCloseLinkText: 'Ok',
		sheetCloseLinkText: 'Ok',
		searchbarDisableText: 'Cancelar',
		pageBackLinkText: 'Voltar',
		searchbarPlaceholder: 'Procurar'
	},
	photoBrowser: {
		type: 'standalone',
		popupCloseLinkText: 'Ok',
		sheetCloseLinkText: 'Ok',
		searchbarDisableText: 'Cancelar',
		pageBackLinkText: 'Voltar',
		searchbarPlaceholder: 'Procurar'
	},
	popup: {
		closeByBackdropClick: false,
	},
	actions: {
		convertToPopover: false,
		grid: true,
	},
	// App routes
	routes: routes,
	popup: {
	   closeOnEscape: true,
	},
	sheet: {
	   closeOnEscape: true,
	},
	popover: {
	   closeOnEscape: true,
	},
	actions: {
	   closeOnEscape: true,
	},
	
});

// FUNCIONS FOR ACTIVITIES

document.addEventListener('DOMContentLoaded', () => {
	// Feature detection
	if (!('serviceWorker' in navigator)) {
		console.log('Service Worker API isn’t supported.');
	} else if (!('PushManager' in window)) {
		console.log('Push API isn’t supported.');
	} else if (!('Notification' in window)) {
		console.log('Notifications API isn’t supported.');
	} else if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
		console.log('Notifications aren’t supported.');
	
	// Check permission
	} else if (Notification.permission == 'denied') {
		console.log('Notifications are disabled.');
	} else {
		console.log('Permissao ok');
			navigator.serviceWorker.register('service-worker.js')
			.then(registration => {
				console.log("Service Worker Registered");
		
				// We don't want to check for updates on first load or we will get a false
				// positive. registration.active will be falsy on first load.
				if(registration.active) {
				  // Check if an updated sw.js was found
				  registration.addEventListener('updatefound', () => {
					console.log('Update found. Waiting for install to complete.');
					const installingWorker = registration.installing;
		
					// Watch for changes to the worker's state. Once it is "installed", our cache
					// has been updated with our new files, so we can prompt the user to instantly
					// reload.
					installingWorker.addEventListener('statechange', () => {
					  if(installingWorker.state === 'installed') {
						console.log('Install complete. Triggering update prompt.');
						onUpdateFound();
					  }
					});
				  });
				}
			  
			  
			  })
			  .catch(e => console.log(e));
			//then(() => {


				navigator.serviceWorker.ready.then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription()).then(subscription => {
						// Subscribe user
						navigator.serviceWorker.ready.then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.subscribe({
							userVisibleOnly: true,
							applicationServerKey: urlBase64ToUint8Array("BMPVQVgOVhIw7XzIAj-LMJztv-7IUBMTTuTBm3AWs135sOy_hRtJ7GutB-AAxOZPSEcNHsekE9iFhQjYrublIaw"),
						})).then(subscription => {
							return pushSubscribe(subscription);
						});
					return pushSubscribe(subscription);
				//});
		
		
		});


		  function onUpdateFound() {
			var new_update = app.toast.create({
				text: 'Nova versão disponível',
				closeButton: true,
				on: {
				  close: function () {
					location.reload();
				  },
				}
			  });
			  new_update.open();
		  }
		
		function urlBase64ToUint8Array(base64String) {
			const padding = '='.repeat((4 - base64String.length % 4) % 4);
			const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
		
			const rawData = window.atob(base64);
			const outputArray = new Uint8Array(rawData.length);
		
			for (let i = 0; i < rawData.length; ++i) {
				outputArray[i] = rawData.charCodeAt(i);
			}
			return outputArray;
		}
		
		function pushSubscribe(subscription) {
			if(subscription){	
				const key = subscription.getKey('p256dh');
				const token = subscription.getKey('auth');
				const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];
				const user_push = {
				endpoint: subscription.endpoint,
				publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
				authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
				contentEncoding: contentEncoding
				}
				window.localStorage.setItem('user_info_push_insp', JSON.stringify(user_push));
			
				return subscription;
			}
		}
	}
});

let deferredPrompt;

window.addEventListener('appinstalled', (evt) => {
	console.log('aPP installed');
  });

  window.addEventListener('load', () => {
	if (navigator.standalone) {
	  console.log('Launched: Installed (iOS)');
	} else if (matchMedia('(display-mode: standalone)').matches) {
	  console.log('Launched: Installed');
	} else {
	  console.log('Launched: Browser Tab');
	}
  });

/*window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent the mini-infobar from appearing on mobile
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
  // Update UI notify the user they can install the PWA
  //showInstallPromotion();
}); */

/*buttonInstall.addEventListener('click', (e) => {
	// Hide the app provided install promotion
	hideMyInstallPromotion();
	// Show the install prompt
	deferredPrompt.prompt();
	// Wait for the user to respond to the prompt
	deferredPrompt.userChoice.then((choiceResult) => {
	  if (choiceResult.outcome === 'accepted') {
		console.log('User accepted the install prompt');
	  } else {
		console.log('User dismissed the install prompt');
	  }
	})
  });*/

  window.addEventListener('appinstalled', (evt) => {
	console.log('a2hs installed');
  });

  window.addEventListener('load', () => {
	if (navigator.standalone) {
	  console.log('Launched: Installed (iOS)');
	} else if (matchMedia('(display-mode: standalone)').matches) {
	  console.log('Launched: Installed');
	} else {
	  console.log('Launched: Browser Tab');
	}
  });

  // Detects if device is on iOS 
const isIos = () => {
	const userAgent = window.navigator.userAgent.toLowerCase();
	return /iphone|ipad|ipod/.test( userAgent );
  }
  // Detects if device is in standalone mode
  const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);
  
  // Checks if should display install popup notification:
  if (isIos() && !isInStandaloneMode()) {
	var installios = app.sheet.create({
		el: '.install_app_ios',
		swipeToClose: true,
		swipeToStep: true,
		backdrop: true,
	});
	
	setTimeout(function(){ 
		//installios.open(); 
	}, 1500);
  } 

  window.addEventListener('beforeinstallprompt', (event) => {
	if (!isIos()){
		var installandroid = app.sheet.create({
			el: '.install_app',
			swipeToClose: false,
			swipeToStep: false,
			backdrop: true,
		});
		console.log('👍', 'beforeinstallprompt', event);
		// Stash the event so it can be triggered later.
		window.deferredPrompt = event;
		setTimeout(function(){ 
			installandroid.open();
			$$('.sign-in ').append('<div class="sheet-backdrop backdrop-in"></div>'); 
		}, 200);
	} 
});

// CALL OPEN EVENTS

function call_open_events() {
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}

	$$('#open_list_dash').html('<img src="assets/img/load_cont.gif" />');
	fetch(current_path+'/view/get_open_events_group', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,type:type})
		}).then((res) => res.json())
		.then((data) =>  { 
			
			var dummy_approve  = "";
			var dummy_pending  = "";
			var current_status = "";
			var status = data.status;
			var status_ = "";
			var read = "";
			var link_page = "";
			var total_groups = 0;
		
			
			if(status == 'SUCCESS'){
				data.data.forEach(function (data) {

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

				});
			  
				$$('#open_list_approve').html(dummy_approve);
				$$('#open_list_pending').html(dummy_pending);
			} else {
				$$('#open_list_approve').html('<h2 style="text-align: center;margin-top: 80px;color: #ececec;font-size: 125px;">0</h2>');
				$$('#open_list_pending').html('<h2 style="text-align: center;margin-top: 80px;color: #ececec;font-size: 125px;">0</h2>');

				
			}

			$('#search_events_approve').keyup(function(){
				var that = this, $allListElements = $('#open_list_approve > div');
				var $matchingListElements = $allListElements.filter(function(i, div){
				  var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
				  return ~listItemText.indexOf(searchText);
				});
				$allListElements.hide();
				$matchingListElements.show();
			});
			
			$('#search_events_pending').keyup(function(){
				var that = this, $allListElements = $('#open_list_pending > div');
				var $matchingListElements = $allListElements.filter(function(i, div){
				  var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
				  return ~listItemText.indexOf(searchText);
				});
				$allListElements.hide();
				$matchingListElements.show();
			});



		})
		.catch((err)=>console.log(err))
}


//call_open_events_off();
//START FUNCTION READ ALL
function call_open_events_off() {

	var request = window.indexedDB.open('AnyInspect', 3);
	var db;
	request.onsuccess = function (event) {
	  db = request.result;
	  setTimeout(function(){
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

			 
			  cursor.continue();

			  $$('#open_list_approve').append(dummy_approve);
			  $$('#open_list_pending').append(dummy_pending);
			  //db.close();

		  }
		  else {
			$('#open_list_approve').html(box_historico_local);   
			$('#open_list_pending').html(box_historico_local);   
		  }
		
		};
	  }, 500);
	
	};
  }

function call_user_profile() {
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	//$$('#open_list').html('<img src="assets/img/load_cont.gif" />');

	
	var box_sig = "";

	box_sig = '<div id="box_action_sig_user" class="box row" style="padding:10px;margin-top: 20px;"></div>'+
	'<div id="/signature-page-user/'+IdUser+'" class="box row "><div class="col-100"><a href="/signature-page-user/'+IdUser+'" style="width:100%" class="item-link item-content link "><i class="fa fa-pencil-square-o" style="font-size: 16px;"></i>Assinatura</a></div></div>';

	$$('#box_sig_user').html(box_sig);

	fetch(current_path+'/view/get_user_profile', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,type:type})
		}).then((res) => res.json())
		.then((data) =>  { 
			
			var status = data.status;
			var content = data[0];
			var box_signature_user_ = "";
		
			if(status == 'SUCCESS'){
				$$('#user_name_').html(content.name);

				if(content.foto != ''){
					$$('#user_pic_').html('<img src="'+content.foto+'" alt="">')
				}

				if(content.sign == 'null' || content.sign == null){

				} else {
					box_signature_user_ =  '<div class="title-col-100" style="padding:10px">'+
                        '<h6 style="width:100%;">'+
                          '<img src="'+content.sign+'" alt=""></h6>'+
                        '</div>';
					$('#box_action_sig_user').html(box_signature_user_);
				}
				var qrcode = new QRCode("qr_user_", {
					text: IdUser,
					width: 128,
					height: 128,
					colorDark : "#000000",
					colorLight : "#ffffff",
					correctLevel : QRCode.CorrectLevel.H
				});
			
				
			}
		})
		.catch((err)=>console.log(err))
}

// CALL OPEN EVENTS GROUP

function call_open_events_groups(id_group) {
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}

	$$('#open_list_grupo').html('<img src="assets/img/load_cont.gif" />');

	
	
	
	fetch(current_path+'/view/get_evento_group', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,type:type,id_group:id_group})
		}).then((res) => res.json())
		.then((data) =>  { 
			
			
			var dummy_open_list  = "";
			var current_status = "";
			var status = data.status;
			var status_ = "";
			var read = "";
			var link_page = "";
			var total_groups = 0;
			var percent_act_box = "";
			var is_conc = data.per;

	
			if(status == 'SUCCESS'){

				var endereco_cliente = data.data[0].endereco_cliente;
				var cidade_cliente = data.data[0].cidade_cliente;
				var cep_cliente = data.data[0].cep_cliente;
				var num_cliente = data.data[0].num_cliente;
				var bairro_cliente = data.data[0].bairro_cliente;
				var phone_cliente = data.data[0].phone_cliente;

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

				data.data.forEach(function (data) {
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
					 
				});

				percent_act_box = '<h6 class="mt-4">'+is_conc+'% Completo</h6>'+
                '<div class="progress mb-3">'+
                    '<div class="progress-bar bg-primary" style="width:'+is_conc+'%; height:6px;" role="progressbar"><span class="sr-only">'+is_conc+'% Completo</span></div>'+
                '</div>';
			  
				$$('#open_list_grupo').html(dummy_open_list);
				$$('#percent_act').html(percent_act_box);
			} else {
				$$('#open_list_grupo').html('<h2 style="text-align: center;margin-top: 80px;color: #ececec;font-size: 125px;">0</h2>');

				
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



		})
		.catch((err)=>console.log(err))
}

function call_open_events_groups_off(id_group) {

	console.log('eSTOU NO GROUPS OFF')

	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}

	$$('#open_list_grupo').html('<img src="assets/img/load_cont.gif" />');

	

	var request = window.indexedDB.open('AnyInspect', 3);
	var db;
	request.onsuccess = function (event) {
	  db = request.result;
	  setTimeout(function(){
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

		  if (cursor.value.id_group == id_group) {
			data = cursor.value;

			console.log(data)

			
			var status = data.status_;
			
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
			  
				$$('#open_list_grupo').html(dummy_open_list);
				$$('#percent_act').html(percent_act_box);
			

			

			 
			cursor.continue();
		  } else {
			$$('#open_list_grupo').html('<h2 style="text-align: center;margin-top: 80px;color: #ececec;font-size: 125px;">0</h2>');

			
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


	
	
	/* fetch(current_path+'/view/get_evento_group', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,type:type,id_group:id_group})
		}).then((res) => res.json())
		.then((data) =>  { 
			
			
			var dummy_open_list  = "";
			var current_status = "";
			var status = data.status;
			var status_ = "";
			var read = "";
			var link_page = "";
			var total_groups = 0;
			var percent_act_box = "";
			var is_conc = data.per;

	
			if(status == 'SUCCESS'){

				var endereco_cliente = data.data[0].endereco_cliente;
				var cidade_cliente = data.data[0].cidade_cliente;
				var cep_cliente = data.data[0].cep_cliente;
				var num_cliente = data.data[0].num_cliente;
				var bairro_cliente = data.data[0].bairro_cliente;
				var phone_cliente = data.data[0].phone_cliente;

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

				data.data.forEach(function (data) {
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
					 
				});

				percent_act_box = '<h6 class="mt-4">'+is_conc+'% Completo</h6>'+
                '<div class="progress mb-3">'+
                    '<div class="progress-bar bg-primary" style="width:'+is_conc+'%; height:6px;" role="progressbar"><span class="sr-only">'+is_conc+'% Completo</span></div>'+
                '</div>';
			  
				$$('#open_list_grupo').html(dummy_open_list);
				$$('#percent_act').html(percent_act_box);
			} else {
				$$('#open_list_grupo').html('<h2 style="text-align: center;margin-top: 80px;color: #ececec;font-size: 125px;">0</h2>');

				
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



		})
		.catch((err)=>console.log(err)) */
}

function get_calendar(){
	$$('#calendar-inline-container-book').html('');
	var home_date , month_dummy ;
	var current_month = "";
	var weekLater = new Date();
	month_dummy = weekLater.getMonth() + 1;
	
	if(month_dummy == 1){
	  current_month = 'Jan';
	}
	if(month_dummy == 2){
	  current_month = 'Fev';
	}
	if(month_dummy == 3){
	  current_month = 'Mar';
	}
	if(month_dummy == 4){
	  current_month = 'Abr';
	}
	if(month_dummy == 5){
	  current_month = 'Mai';
	}
	if(month_dummy == 6){
	  current_month = 'Jun';
	}
	if(month_dummy == 7){
	  current_month = 'Jul';
	}
	if(month_dummy == 8){
	  current_month = 'Ago';
	}
	if(month_dummy == 9){
	  current_month = 'Set';
	}
	if(month_dummy == 10){
	  current_month = 'Out';
	}
	if(month_dummy == 11){
	  current_month = 'Nov';
	}
	if(month_dummy == 12){
	  current_month = 'Dez';
	}

	home_date = weekLater.getDate()+'-'+current_month;
	$$('#day_today').html(home_date); 

	$$('#calendar_serv').html('<img src="assets/img/load_cont.gif" />');

	var now = new Date();
	var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
	var weekLater = new Date().setDate(today.getDate() + 7);
	var the_day = "";
	var the_date = "";
	var string_day = "";
	var day = 0 
	var month = 0 
	var year = 0;

	var dummy_open_list_cal = "";
	let status , current_status , status_ , read;
	var total_month = 0;
	var items_new = [];
	var myinfo = "";
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}

	fetch(current_path+'/view/get_open_events_calendar', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,the_date:the_date,type:type})
		}).then((res) => res.json())
		.then((response) =>  {
			var myinfo = response.content;
			var status = response.status;

			if(status == 'SUCCESS'){
				response.content.forEach(function (data) {
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

					var length_desc_service = data.desc_service.length;
					  if(length_desc_service > 31){
						var desc_service = data.desc_service.substring(0, 32)+'...';
					  } else {
						var desc_service = data.desc_service;
					  }
					var link_page = "/atividade/"+data.id+"";
					
					dummy_open_list_cal += '<div class="patient-widget">'+		
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

				  
			  });
			
			  $$('#calendar_serv').html(dummy_open_list_cal);
			} else {
				$$('#calendar_serv').html('<div class="block-title" style="text-align: center;"><h3>Nenhuma Atividade</h3></div>'); 
			}


		})
		.catch((err)=>console.log(err))


var tomorow = new Date('2020', '03', '12');
var monthNames = ['Janeiro', 'Fevereiro', 'Maço', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto' , 'Setembro' , 'Outubro', 'Novembro', 'Dezembro'];
var dayNamesShort = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
var dayNames = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
var calendarInline = app.calendar.create({
containerEl: '#calendar-inline-container-book',
value: [new Date()],

weekHeader: true,
renderToolbar: function () {
	return '<div class="toolbar calendar-custom-toolbar no-shadow">' +
	'<div class="toolbar-inner">' +
		'<div class="left">' +
		'<a href="#" class="link icon-only"><i class="icon icon-back ' + (app.theme === 'md' ? 'color-black' : '') + '"></i></a>' +
		'</div>' +
		'<div class="center"></div>' +
		'<div class="right">' +
		'<a href="#" class="link icon-only"><i class="icon icon-forward ' + (app.theme === 'md' ? 'color-black' : '') + '"></i></a>' +
		'</div>' +
	'</div>' +
	'</div>';
},

on: {
	change: function(ch){

	},
	opened:function(op){
	},
	init: function (c) {
	$$('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] +', ' + c.currentYear);
	$$('.calendar-custom-toolbar .left .link').on('click', function () {
		calendarInline.prevMonth();
	});
	$$('.calendar-custom-toolbar .right .link').on('click', function () {
		calendarInline.nextMonth();
	});
	},
	monthYearChangeStart: function (c) {
	$$('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] +', ' + c.currentYear);
	},
	dayClick: function (p, dayContainer, year, month, day) {
		//datePickerEditSet.close();
	},
	dayClick: function (p, dayContainer, year, month, day){

		month = month + 1;
		if(day <10){
			day = '0'+day;
		}
		if(month <10){
			month = '0'+month;
		}
		
		$$("#calendar_serv").html('<img src="assets/img/load_cont.gif"> ');
		
		  the_date = year + '-' + month + '-' + day

		let user_info = Utils.userData();
		if(user_info == null || user_info == 'null'){
			app.views.main.router.navigate({ name: 'sign-in' });
		}
		let IdUser = user_info.id;
		let type = user_info.type;

		fetch(current_path+'/view/get_open_service_month', {
			method: 'POST',
			headers : new Headers(),
			body:JSON.stringify({IdUser:IdUser,the_date:the_date,type:type})
			}).then((res) => res.json())
			.then((response) =>  {
			
			  dummy_open_list_cal = "";
			  
			  total_month = response.total_month;
			  status = response.status;
			  
			  if(status == 'SUCCESS'){

				$$('#title_total_calendar').show();
				$$('#total_month_all').html(total_month);
				response.content.forEach(function (data) {

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

					var length_desc_service = data.desc_service.length;
					  if(length_desc_service > 31){
						var desc_service = data.desc_service.substring(0, 32)+'...';
					  } else {
						var desc_service = data.desc_service;
					  }
					var link_page = "/atividade/"+data.id+"";
					
					dummy_open_list_cal += '<li class="swipeout">'+
							'<a href="'+link_page+'" class="item-link item-content swipeout-content link">'+
							'<div class="item-inner">'+
								'<div class="item-title-row">'+
									'<div class="item-texts ">Atividade:#'+data.id+'<h5><strong>'+desc_service+'</strong><h5></div>'+
									'<div class="item-after '+current_status+' ">'+status_+'</div>'+
								'</div>'+
								
								'<div class="item-title"><h5>Ativo: <i style="color:#9c9c9c;" class="fa fa-qrcode"></i><strong>'+data.qrcode+'-'+data.ativo+'</strong></h5></div>'+
								'<div class="item-texts "><h5>Data: <strong>'+data.br_start+'</strong></h5></div>'+
							'</div>'+
						'</a>'+
					'</li>';

			  });
				
				$$('#calendar_serv').html(dummy_open_list_cal); 
			  } else {
				$$('#title_total_calendar').hide();
				$$('#total_month_all').html('');
				$$('#calendar_serv').html('<div class="block-title" style="text-align: center;"><h3>Nenhuma Atividade</h3></div>'); 
				$$(".load_agenda").html('');
			  }
		  })
		  .catch((err)=>console.log(err))
	}

}
});

$('#search_events_month').keyup(function(){
	var that = this, $allListElements = $('#calendar_serv > div');
	var $matchingListElements = $allListElements.filter(function(i, div){
		var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
		return ~listItemText.indexOf(searchText);
	});
	$allListElements.hide();
	$matchingListElements.show();
  });
}


function get_calendar_single(){

	var dateObj = new Date();
	var month = dateObj.getUTCMonth(); //months from 1-12
	var day = dateObj.getUTCDate();
	var year = dateObj.getUTCFullYear();
	var the_date = "";
	month = month + 1;
	if(day <10){
		day = '0'+day;
	}
	if(month <10){
		month = '0'+month;
	}

	$$(".load_agenda").html('<img style="width: 100px;margin: auto;" src="images/load.gif"> ');
	  the_date = year + '-' + month + '-' + day

	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	let IdUser = user_info.id;

	fetch(current_path+'/view/get_open_service_month', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,the_date:the_date})
		}).then((res) => res.json())
		.then((response) =>  {

		  var calserv = "";
		  let status , current_status , taxi;
		  var has_taxi_ , alta_shadow , priority = "";
		  var total_month = 0;
		  total_month = response.total_month;
		  status = response.status;
		  
		  if(status == 'SUCCESS'){

			$$('#title_total_calendar').show();
			$$('#total_month_all').html(total_month);
			if(response.data){
				response.data.forEach(function (data) {
					status = data.status;
					if(status == 'Pendente'){
					  current_status = 'pendente';
					}
					if(status == 'Em Andamento'){
					  status = 'Andamento';
					  current_status = 'andamento';
					}
					if(status == 'Finalizado'){
					  current_status = 'finalizado';
					}
					if(status == 'Cancelado'){
					  current_status = 'cancelado';
					}
					if(status == 'Deletado'){
					  current_status = 'deletado';
					}
					if(status == 'Aprovado'){
					  current_status = 'aprovado';
					}

					taxi = data.pet_taxi;
					if(taxi == 'Sim'){
						has_taxi_ = '<i alt="taxi" class="icon ion-ios-car"></i>';
					} else {
						has_taxi_ = '';
					}

					 if(status == 'Concluído'){ } else {
						priority = data.priority;
						if(priority == 'Alta'){
							priority = '<span style="color:#F44336;background: #F44336;clip-path: polygon( 0% 100%, 100% 100%, 100% 0%);">Alta</span>';
							alta_shadow = 'alta_shadow';	
						
						} else if(priority == 'Média'){
							priority = '<span style="color:#f1c951;background: #f1c951;clip-path: polygon( 0% 100%, 100% 100%, 100% 0%);">Alta</span>';
							alta_shadow = '';
						} else {
							priority = "";
							alta_shadow = "";
						}
					  }
					
					$$(".load_agenda").html('');
					calserv +=
					'<div class="content '+alta_shadow+'" >'+
						'<div class="image">'+
							'<a href="/service-details/'+data.id_service+'"><img src="'+data.foto_bolt+'" alt=""></a>'+
						'</div>'+
						'<div class="text" style="width: -webkit-fill-available;">'+
							'<a href="/service-details/'+data. id_service+'"><h6><strong>'+data.short_dec+'</strong></h6></a>'+
							'<div class="price-booking">'+
							'<h6>'+data.name_bolt+' ['+data.category_bolt+'] '+has_taxi_+' </h6>'+
							'</div>'+
							'<p class="location"><i class="icon ion-ios-calendar"></i>'+data.start_date+'</p>'+
						'</div>'+
						'<div class="status_list"><span class="'+current_status+'">'+status+'</span>'+
							'<div style="margin-top: 24px;position: absolute;right: 10px;" class="price-booking">'+
							'<div style="float: right;">'+priority+'</div>'+
						'</div>'+ 
						'</div>'+
					'</div>';
					 
				  });
			} else {
				calserv = '';
				$$(".load_agenda").html('');
			}
			
			$$('#calendar_serv').html(calserv); 
		  } else {
			$$('#title_total_calendar').hide();
			$$('#total_month_all').html('');
			$$('#calendar_serv').html('<div class="block-title" style="text-align: center;"><h3>Nenhum Agendamento</h3></div>'); 
			$$(".load_agenda").html('');
		  }
	  })
	  .catch((err)=>console.log(err))
}

// CALL ACTIVITIE INFO

function get_info_gerais(id_atividade){

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

	fetch(current_path+'/view/get_eventos_single', {
	  method: 'POST',
	  headers : new Headers(),
	  body:JSON.stringify({idatividade:id_atividade})
	  }).then((res) => res.json())
	  .then((data) =>  {
		
		var full_endereco = "";
		var det_info ;
		det_info = data[0];
		
		var endereco_ativo = det_info.endereco;

		var lat_ativo = det_info.lat_ativo;
		var lon_ativo = det_info.lon_ativo;
		var id_group = det_info.id_group;
		var endereco_cliente = data.empresa.cidade;
		var cliente = data.cliente.name_client;
		var endereco_cliente = data.cliente.endereco_cliente;
		var cidade_cliente = data.cliente.cidade_cliente;
		var cep_cliente = data.cliente.cep_cliente;
		var num_cliente = data.cliente.num_cliente;
		var foto_cliente = data.cliente.foto_cliente;
		var phone_cliente = data.cliente.phone_cliente;

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


		var config = data.config;

		$$('#nome_empresa_at').html('<strong>'+cliente+'</strong>');
		$$('#end_empresa_at').html('<i style="color:#9c9c9c;" class="fa fa-map-marker"></i> '+full_endereco);
		$$('#phone_cliente').html(phone_cliente);
		$$("#foto_empresa").attr('src', foto_cliente +'?' + (new Date()).getTime());

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
  
		var id = det_info.id;
		var status_det = det_info.status_;
		var eventID = det_info.id;
		var id_funcionario = det_info.id_funcionario;
		var id_form = det_info.id_form;
		var qrcode = det_info.qrcode;
		var priority = det_info.priority;
		var info_extra = det_info.info_extra;
		var foto_cliente = det_info.foto_cliente
		var box_aprovacao = "";


		generateForm(id_form,status_det,id_atividade,config,id_group);
		
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
				//'<button id="cancelar" class="button btn_status_cancelar scaleffect no-active-state ">Cancelar</button>');
			} else {
				$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
			}
		
		}

		if(status_det == 'Em Andamento'){
			$$('.status_activity').html('<div class="content status_andamento"><span class="">'+status_det+'</span></div>');
			$$('#btn_action_service').html('');
			//$$('#btn_action_service').html('<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Enviar Aprovação</button>');
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
			//$$('#btn_action_service').html('<a style="background:#26cc64;color: #fff;" class="button button-large button-fill open_zap_send" style="background: #39ca3d;"><i style="font-size: 24px;margin-right: 10px;" class="fa fa-whatsapp"></i>Enviar WhatsApp</a>');
			
			$$('#box_save_checklist').hide();
		  } 

		// START ATIVITY 
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
				//let id_user = 1
				let user_info = Utils.userData();
				let id_user = user_info.id;
				let type = user_info.type;
				var txt_confirma;
				var loadLocation = "";

				altera_status(eventID,the_status,id_funcionario,id_form,config,id_group,det_info);
				return;

			});
		
		
			
		// CHANGE CONC STATUS

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
											get_info_gerais(id_atividade);
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
							  call_open_events();
							  get_info_gerais(id_atividade);
							  call_open_events_groups(id_group);
						  }
				  
				  })
				  .catch((err)=>console.log(err))
				  });
			
			}
		});
		
		
		}, 500); 

		
  
		})
		.catch((err)=>console.log(err))


}

function get_info_gerais_off(id_atividade){

	console.log('Estou no info geral off')
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


	var request = window.indexedDB.open('AnyInspect', 3);
      var db;
      
      request.onsuccess = function (event) {
        db = request.result;
        
		setTimeout(function(){
          var objectStoreSingle = db.transaction("tb_single").objectStore("tb_single");
          objectStoreSingle.openCursor().onsuccess = function(event) {
            var cursor = event.target.result;
            if(cursor.value.id == id_atividade){ 
                  var data = cursor.value;

			}
		
		var full_endereco = "";
		var det_info ;
		det_info = data;
		
		var endereco_ativo = det_info.endereco;
		var empresa_cliente = det_info.empresa_cliente;

		var lat_ativo = det_info.lat_ativo;
		var lon_ativo = det_info.lon_ativo;
		var id_group = det_info.id_group;
		var endereco_cliente = data.cidade;
		var cliente = data.nome_client;
		var endereco_cliente = data.endereco_cliente;
		var cidade_cliente = data.cidade_cliente;
		var cep_cliente = data.cep_cliente;
		var num_cliente = data.num_cliente;
		var foto_cliente = data.foto_cliente;
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
  
		var id = det_info.id;
		var status_det = det_info.status_;
		var eventID = det_info.id;
		var id_funcionario = det_info.id_funcionario;
		var id_form = det_info.id_form;
		var qrcode = det_info.qrcode;
		var priority = det_info.priority;
		var info_extra = det_info.info_extra;
		var foto_cliente = det_info.foto_cliente
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
				//'<button id="cancelar" class="button btn_status_cancelar scaleffect no-active-state ">Cancelar</button>');
			} else {
				$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
			}
		
		}

		if(status_det == 'Em Andamento'){
			$$('.status_activity').html('<div class="content status_andamento"><span class="">'+status_det+'</span></div>');
			$$('#btn_action_service').html('');
			//$$('#btn_action_service').html('<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Enviar Aprovação</button>');
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
			//$$('#btn_action_service').html('<a style="background:#26cc64;color: #fff;" class="button button-large button-fill open_zap_send" style="background: #39ca3d;"><i style="font-size: 24px;margin-right: 10px;" class="fa fa-whatsapp"></i>Enviar WhatsApp</a>');
			
			$$('#box_save_checklist').hide();
		  } 

		// START ATIVITY 
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
				//let id_user = 1
				let user_info = Utils.userData();
				let id_user = user_info.id;
				let type = user_info.type;
				var txt_confirma;
				var loadLocation = "";

				altera_status(eventID,the_status,id_funcionario,id_form,config,id_group,det_info);
				return;

			});
		
		
			
		// CHANGE CONC STATUS

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
											
											//get_info_gerais(id_atividade);
											//call_open_events();
											//call_open_events_groups(id_group);
											
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
		
		
		
		}
		
		}, 500);
	}
	


}

$$('.back-last').on('click', function (e) {
	e.preventDefault();
	app.views.current.router.back();

});

if ( navigator.permissions && navigator.permissions.query) {
//try permissions APIs first
  navigator.permissions.query({ name: 'geolocation' }).then(function(result) {
      // Will return ['granted', 'prompt', 'denied']
      const permission = result.state;
      if ( permission === 'granted' || permission === 'prompt' ) {
          
          
          //_onGetCurrentLocation();
      }
      
      result.onchange = function() {
      console.log('geolocation permission state has changed to ', this.state);
    };
      
  });
} else if (navigator.geolocation) {
    console.log('sem permissao gps ainda')
//then Navigation APIs
  //_onGetCurrentLocation();
}

 
function start_get_location(gps,eventID,the_status,id_user,qrcode,id_form,det_info){

	app.dialog.progress('Buscando sua localização! Aguarde 15s');
	if ( navigator.geolocation ) { 
		navigator.geolocation.getCurrentPosition( setCurrentPosition, positionError, { 
			enableHighAccuracy: true, 
			timeout: 15000, 
			maximumAge: 0 
		} );
	}

	function setCurrentPosition(position){
		var lat = position.coords.latitude;
		var lon = position.coords.longitude;
		$$('#gps_lat').val(lat);
		$$('#gps_lon').val(lon);
		plot_map(lat,lon);
		app.dialog.close();
	}

	function positionError(position){
		app.dialog.close();
		console.log(position)
		var message = '';

		switch ( position.code ) { 
			case 1: 
			console.error( "User denied the request for Geolocation." );
			app.dialog.alert('Ops!Parece que você não habilitou as configurações de Geolocalização  ' , 'Erro');
			break; 
	
			case 2: 
				console.error( "Location information is unavailable." ); 
				message = 'Não foi possível encontrar sua localização';
				gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message,det_info)
				break; 
	
			case 3: 
	
				console.error( "The request to get user location timed out." ); 
				message = 'Tempo esgotado.Não foi possível encontrar sua localização';
				gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message,det_info)
				break; 
	
			case 4: 
				message = 'Não foi possível encontrar sua localização';
				gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message,det_info)
				console.error( "An unknown error occurred." ); 
				break; 
		}
	
	}


}

function gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message,det_info){

var qr_manual_Tag = app.sheet.create({
	el: '.qr_manual_Tag',
	swipeToClose: false,
	swipeToStep: false,
	backdrop: true,
	closeByBackdropClick: false,
	closeByOutsideClick: false
	});
	  
qr_manual_Tag.open();
		
var manual_tag_qr = "";
manual_tag_qr = 
		'<div class="item-inner">'+
			'<div class="item-input-wrap">'+
				'<div class="block-title tag_invalid_txt" style="text-align: center;font-size:17px;color: #F44336;overflow: inherit;">'+message+'</div>'+
				'<div class="row" style="margin-top: 10px;" >'+
				'<a style="width:100%;" class="btn confirm_gps_manual">Confirmar assim mesmo</a>'+
				'</div>'+
				'<div class="row" style="margin-top: 10px;" >'+
				'<a style="width:100%;" class="btn try_gps_again">Tentar Novamenta</a>'+
				'</div>'+
				'<div class="row" style="margin-top: 10px;" >'+
				'<a style="background:#F44336;width: 100%;" class="btn close_manual" id="close_manual" >Cancelar</a>'+
				'</div>'+
			'</div>'+
		'</div>';


$$('#box_not_found_tag').html(manual_tag_qr);



 $$('.try_gps_again').on('click', function (e) {
	e.preventDefault();
	start_get_location(gps,eventID,the_status,id_user,qrcode,id_form,message,det_info);
  }); 

  $$('.confirm_gps_manual').on('click', function (e) {
	e.preventDefault();
	gps_signin_off(gps,eventID,the_status,id_user,qrcode,id_form,message,qr_manual_Tag,det_info)
  }); 
  
  $$('.close_manual').on('click', function (e) {
	e.preventDefault();
	qr_manual_Tag.close();
	setTimeout(function () {
		$$('.back').click()
	}, 1000);
  }); 



}

function gps_signin_off(gps,eventID,the_status,id_user,qrcode,id_form,message,qr_manual_Tag,det_info){

	var gps_lat = 0;
	var gps_lon = 0;

	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var id_funcionario = user_info.id;
	var type = user_info.type;

	
	var the_status = 'Em Andamento';
	var id_group = det_info.det_info;

	app.dialog.confirm(message,'Ops! ', function () {
	fetch(current_path + '/controller/checkin-gps', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:id_funcionario,eventID:eventID,gps_lat:gps_lat,gps_lon:gps_lon})
		}).then((res) => res.json())
		.then((data) =>  {
		if(data.status == 'SUCCESS'){
			app.preloader.hide();
			var toast_message = app.toast.create({text: 'Registrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
			toast_message.open();
			$$('#gps_lat').val('');
			$$('#gps_lon').val('');
			$$('#box_sig_cli').html('');
			$$('#box_sig_cli').append('<div class="block"><label class="block-title">Assinaturas</label></div>');
			get_info_gerais(eventID);
			call_open_events();
			call_open_events_groups(id_group);
			
			qr_manual_Tag.close();
			setTimeout(function () {
				app.views.current.router.back();
				$$('.back').click()
			}, 1000);
			
		} else {
			var toast_message = app.toast.create({text: 'Erro ao registrar localização!',closeTimeout: 2000,cssClass: 'error_toast'});
					toast_message.open();
		}
		})
		.catch((err)=>console.log(err))
	});

}

var map;
function plot_map(lat,lon){

	var desc_box = 'Localização';
	if(map == undefined){
		map = L.map('map_atividade').setView([lat, lon], 16);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		L.marker([lat, lon]).addTo(map)
			.bindPopup('Estou aqui!')
			.openPopup();
	
	
	} else {
		map.off();
		map.remove();
		map = L.map('map_atividade').setView([lat, lon], 16);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		L.marker([lat, lon]).addTo(map)
			.bindPopup('Estou aqui!')
			.openPopup();
	
	}  
}
	


// FUNCION OPEN CAMERA READ QR CODE

function qr_code_start(eventID,the_status,id_funcionario,qrcode,id_form,configs,id_groups,det_info){
	const html5QrCode = new Html5Qrcode("qr-reader",true);

	open_camera_qr_sign(eventID,the_status,id_funcionario,qrcode,id_form,html5QrCode,configs,id_groups,det_info);
	$$('.stopscanerios').click(function () {
		html5QrCode.stop().then(ignore => {
		console.log("QR Code scanning stopped.");
		html5QrCode.clear();
		return;
		}).catch(err => { 
		// Stop failed, handle it. 
		console.log("Unable to stop scanning.");
		}); 
	});
	
	$$('.startcam').click(function () {
		open_camera_qr_sign(eventID,the_status,id_funcionario,qrcode,id_form,html5QrCode,configs,id_groups,det_info);
	});


	$$('.back-qr').on('click', function (e) {
		e.preventDefault();
		html5QrCode.stop().then(ignore => {
		console.log("QR Code scanning stopped.");
		html5QrCode.clear();
		return;
		}).catch(err => { 
		// Stop failed, handle it. 
		console.log("Unable to stop scanning.");
		}); 
		app.views.current.router.back();
	
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
		console.log("QR Code scanning stopped.");
		html5QrCode.clear();
		return;
		}).catch(err => { 
		// Stop failed, handle it. 
		console.log("Unable to stop scanning.");
		}); 
	});
	
	$$('.startcam').click(function () {
		open_camera_qr_info(html5QrCode);
	});


	$$('.back-qr').on('click', function (e) {
		
		e.preventDefault();
		html5QrCode.stop().then(ignore => {
		console.log("QR Code scanning stopped.");
		html5QrCode.clear();
		return;
		}).catch(err => { 
		// Stop failed, handle it. 
		console.log("Unable to stop scanning.");
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
			console.log("QR Code scanning stopped.");
			html5QrCode.clear();
			return;
			}).catch(err => { 
			// Stop failed, handle it. 
			console.log("Unable to stop scanning.");
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

function open_camera_qr_info(html5QrCode){
	
	let user_info = Utils.userData();
	if(user_info == null || user_info == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}
	var IdUser = user_info.id;
	var type = user_info.type;

	if(IdUser == null || IdUser == 'null'){
		app.views.main.router.navigate({ name: 'sign-in' });
	}

	var open_manual_Tag = app.sheet.create({
		el: '.open_manual_Tag',
		swipeToClose: false,
		swipeToStep: false,
		backdrop: true,
		closeByBackdropClick: false,
		closeByOutsideClick: false
	  });
	
	Html5Qrcode.getCameras().then(cameras => {
		const config = { fps: 50, qrbox: 250 };
		const cameraMode = { facingMode: "environment" };
		if (cameras && cameras.length) {
		var cameraId = cameras[0].id;
		// .. use this to start scanning.
		
		html5QrCode.start(
		cameraMode,
		config,
		qrCodeMessage => {
		// do something when code is read
		//processQrCode(qrCodeMessage);
	
			const soundEffect = new Audio();
			soundEffect.src = 'voice/pi.wav';
			soundEffect.play();
			
			html5QrCode.stop().then(ignore => {
			$$('#qr-reader-results').html(qrCodeMessage)

			html5QrCode.clear();

			fetch(current_path + '/view/get_qr_info', {
				method: 'POST',
				headers : new Headers(),
				body:JSON.stringify({IdUser:IdUser,type:type,qrCodeMessage:qrCodeMessage})
				}).then((res) => res.json())
				.then((data) =>  {
				if(data.status == 'SUCCESS'){
				  app.preloader.hide();
				  var toast_message = app.toast.create({text: 'Encontrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
				  toast_message.open();
				 
				  setTimeout(function () {
					//app.views.main.router.navigate({ name: 'info_ativo' });
					app.views.main.router.navigate('/info_ativo/'+qrCodeMessage);
				  }, 10);
				  
				} else {
				  var toast_message = app.toast.create({text: 'Ativo não encontrado!',closeTimeout: 2000,cssClass: 'error_toast'});
				 toast_message.open();
				}
			  })
			  .catch((err)=>console.log(err))

			
			}).catch(err => { 

			console.log("Unable to stop scanning.");
			}); 
			
			return;
	
		
		},
		errorMessage => {
		// parse error, ignore it.
		//console.log("errorMessage="+errorMessage);
		})
		.catch(err => {
		// Start failed, handle it.
		//console.log("err1="+err);
		});
		}
		
		}).catch(err => {
		// handle err
		//console.log("err2="+err);
		});


		

}

function open_camera_qr_sign(eventID,the_status,id_funcionario,qrcode,id_form,html5QrCode,configs,id_groups,det_info){
	
	var qr_manual_Tag = app.sheet.create({
		el: '.qr_manual_Tag',
		swipeToClose: false,
		swipeToStep: false,
		backdrop: true,
		closeByBackdropClick: false,
		closeByOutsideClick: false
	  });
	
	Html5Qrcode.getCameras().then(cameras => {
		const config = { fps: 50, qrbox: 250 };
		const cameraMode = { facingMode: "environment" };
		if (cameras && cameras.length) {
		var cameraId = cameras[0].id;
		// .. use this to start scanning.
		
		html5QrCode.start(
		cameraMode,
		config,
		qrCodeMessage => {
		// do something when code is read
		//processQrCode(qrCodeMessage);
		if(qrCodeMessage == qrcode) {
			const soundEffect = new Audio();
			soundEffect.src = 'voice/pi.wav';
			soundEffect.play();
			
			html5QrCode.stop().then(ignore => {
			$$('#qr-reader-results').html(qrCodeMessage)

			html5QrCode.clear();

			fetch(current_path + '/controller/checkin-qrcode', {
				method: 'POST',
				headers : new Headers(),
				body:JSON.stringify({IdUser:id_funcionario,eventID:eventID,qrCodeMessage:qrCodeMessage})
				}).then((res) => res.json())
				.then((data) =>  {
				if(data.status == 'SUCCESS'){
				  app.preloader.hide();
				  var toast_message = app.toast.create({text: 'Registrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
				  toast_message.open();
				  altera_status(eventID,the_status,id_funcionario,id_form,configs,id_groups,det_info);
  
				  setTimeout(function () {
					$$('.back').click()
				  }, 1000);
				  
				} else {
				  var toast_message = app.toast.create({text: 'Erro ao registrar localização!',closeTimeout: 2000,cssClass: 'error_toast'});
							toast_message.open();
				}
			  })
			  .catch((err)=>console.log(err))

			
			}).catch(err => { 

			console.log("Unable to stop scanning.");
			}); 
			
			return;
	
		} else {
			//open_camera.close();
			$$('#qr-reader-results').html(qrCodeMessage)
	
			const soundEffect = new Audio();
			soundEffect.src = 'voice/pi.wav';
			soundEffect.play();
			
			qr_manual_Tag.open();
				
				var manual_tag_qr = "";
				manual_tag_qr = '<li class="item-content item-input">'+
						'<div class="item-inner">'+
							'<div class="item-input-wrap">'+
								'<div class="block-title tag_invalid_txt" style="text-align: center;font-size: 25px;color: #F44336;overflow: inherit;">TAG INVÁLIDA</div>'+
								'<p style="text-align:center;font-size: 11px;" >TAG não corresponde com a atividades </p><br>'+
								'<p style="text-align:center;" >Deseja digitar manualmente a Tag para Iniciar a Atividade ? </p><br>'+
								'<input type="text" name="tag_manual" id="tag_manual" style="text-transform: uppercase;" >'+
								'<div class="row" style="margin-top: 10px;" ><a style="width:100%;" class="btn btn_confirma_manual">Confirmar</a></div>'+
								'<div class="row" style="margin-top: 10px;" >'+
									'<a style="background:#F44336;width: 100%;" class="btn close_manual" id="close_manual" >Cancelar</a>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</li>';
	
				$$('#box_not_found_tag').html(manual_tag_qr);

				$$('#tag_manual').focus();
				document.getElementById("tag_manual").style.border = "1px solid #f44336";
	
				$$('.close_manual').on('click', function (e) {
					e.preventDefault();
					qr_manual_Tag.close();
				}); 
	
				$$('.btn_confirma_manual').on('click', function (e) {
					e.preventDefault();
					var value_manual = $$('#tag_manual').val();

					value_manual = value_manual.toUpperCase();

					if(value_manual == ''){
						var toast_message = app.toast.create({text: 'Campo Obrigatório',closeTimeout: 2000,cssClass: 'error_toast'});
						toast_message.open();
						$$('#tag_manual').focus();
						document.getElementById("tag_manual").style.border = "1px solid #f44336";
						return false;
					} else {
						
						window.animatelo.bounceIn('.tag_invalid_txt');
						document.getElementById("tag_manual").style.border = "1px solid #d8d8d8";  
	
						if(value_manual == qrcode){

							$$('#qr-reader-results').html(value_manual);
							qr_manual_Tag.close();

							fetch(current_path + '/controller/checkin-qrcode', {
								method: 'POST',
								headers : new Headers(),
								body:JSON.stringify({IdUser:id_funcionario,eventID:eventID,qrCodeMessage:qrCodeMessage})
								}).then((res) => res.json())
								.then((data) =>  {
								if(data.status == 'SUCCESS'){
								  app.preloader.hide();
								  var toast_message = app.toast.create({text: 'Registrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
								  toast_message.open();
								  //the_status = 'Em Andamento';
								  altera_status(eventID,the_status,id_funcionario,id_form,configs,id_groups,det_info);

								  setTimeout(function () {
									$$('.back').click()
								  }, 1000);
								  
								} else {
								  var toast_message = app.toast.create({text: 'Erro ao registrar localização!',closeTimeout: 2000,cssClass: 'error_toast'});
								  toast_message.open();
								}
							  })
							.catch((err)=>console.log(err))

						}
					}
	
				});

				return;
		
			}
		},
		errorMessage => {
		// parse error, ignore it.
		//console.log("errorMessage="+errorMessage);
		})
		.catch(err => {
		// Start failed, handle it.
		//console.log("err1="+err);
		});
		}
		
		}).catch(err => {
		// handle err
		//console.log("err2="+err);
		});


		

}

// OPEN CAMERA AND CHECK QR VALIDATION

function get_tag_id(code,eventID,the_status,id_funcionario,qrcode,id_form,config,id_group){

	if(code == qrcode){
		altera_status(eventID,the_status,id_funcionario,id_form,config,id_group,det_info)
	} else {
		open_manual_Tag.open();
		
		var manual_tag = "";
			manual_tag = '<li class="item-content item-input">'+
				'<div class="item-inner">'+
					'<div class="item-input-wrap">'+
						'<div class="block-title"  style="text-align: center;font-size: 25px;color: #F44336;overflow: inherit;">TAG INVÁLIDA</div>'+
						'<p style="text-align:center;font-size: 11px;" >TAG não corresponde com as atividades da Embarcação</p><br>'+
						'<p style="text-align:center;" >Deseja digitar manualmente a Tag para Iniciar a Atividade ? </p><br>'+
						'<input type="text" name="tag_manual" id="tag_manual" style="text-transform: uppercase;" >'+
						'<button class="button btn_confirma_manual">Confirmar</button>'+
					'</div>'+
				'</div>'+
			'</li>';

		$$('#box_not_found').html(manual_tag);
		
		//var toast_message = app.toast.create({text: 'TAG não encontrada',closeTimeout: 2000,cssClass: 'error_toast'});
		//toast_message.open();
		$$('#tag_manual').focus();
		document.getElementById("tag_manual").style.border = "1px solid #f44336";

		$$('.close_manual').on('click', function (e) {
			e.preventDefault();
			open_manual_Tag.close();

			device_type = deviceOS();
			if(device_type != 'iphone'){
				start_camera_open(eventID,the_status,id_funcionario,qrcode,id_form,config,id_group);
			} else {
				//qr_open(eventID,the_status,id_funcionario,qrcode);
				qr_code_start(eventID,the_status,id_funcionario,qrcode,id_form,config,id_group);
				$$('#camera_box').hide();
			}

			
			
		});

		$$('.btn_confirma_manual').on('click', function (e) {
			e.preventDefault();
			var value_manual = $$('#tag_manual').val();
			//open_manual_Tag.close();

			if(value_manual == ''){
				var toast_message = app.toast.create({text: 'Campo Obrigatório',closeTimeout: 2000,cssClass: 'error_toast'});
				toast_message.open();
				$$('#tag_manual').focus();
				document.getElementById("tag_manual").style.border = "1px solid #f44336";
				return false;
			} else {
				document.getElementById("tag_manual").style.border = "none";
				get_tag_id(value_manual,eventID,the_status,id_funcionario,qrcode,id_form,config,id_group);

			}

			

		});

	}

	
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

		/*var gps_permission = app.sheet.create({
			el: '.gps_permission',
			swipeToClose: false,
			swipeToStep: true,
			backdrop: true,
			closeByBackdropClick: false,
			closeByOutsideClick: false
		  }); */


		//if(config.geo_location == 0 && config.qr_check_in == 0){
			//altera_status(eventID,the_status,id_funcionario,id_form,config,id_group);
		
		//} else {

			if(the_status == 'comecar'){
				txt_confirma = 'Iniciar Atividade';
				if(config.geo_location == 1){
					if(start_lat == ''){
						// JA FEZ O CHECK-IN
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
						} else {
							//altera_status(eventID,the_status,id_funcionario,id_form,config,id_group);
						}
					}
				
				} else {
					
					if(config.qr_check_in == 1){
						app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
						return;
					} else {
						//altera_status(eventID,the_status,id_funcionario,id_form,config,id_group);
					}

				}
			}
			if(the_status == 'finalizar'){
				txt_confirma = 'Enviar Aprovação';
				//altera_status(eventID,the_status,id_funcionario,id_form,config,id_group);
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

				console.log('type - ' + type)
				
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

						$$('.change_status_service').on('click', function (e) {
							//altera_status(eventID,the_status,id_funcionario,id_form,config,id_group,det_info);
						});

   				    // CHANGE CONC STATUS
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
														//$$('#phone_cliente').val(phone_team);
														//$$('#zap_message').val('Atividade Reprovada - Motivo: ' +repprove_message);
														//send_zap.open();
														
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

					
					//$$('#btn_action_service').html('<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Enviar Aprovação</button>');
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
					//$$('#term_fim_det').html(get_data_atual());

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
														//$$('#phone_cliente').val(phone_team);
														//$$('#zap_message').val('Atividade Reprovada - Motivo: ' +repprove_message);
														//send_zap.open();
														
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

function deviceOS() {
	var useragent = navigator.userAgent;

	if(useragent.match(/Android/i)) {
		return 'android';
	} else if(useragent.match(/webOS/i)) {
		return 'webos';
	} else if(useragent.match(/iPhone/i)) {
		return 'iphone';
	} else if(useragent.match(/iPod/i)) {
		return 'ipod';
	} else if(useragent.match(/iPad/i)) {
		return 'ipad';
	} else if(useragent.match(/Windows Phone/i)) {
		return 'windows phone';
	} else if(useragent.match(/SymbianOS/i)) {
		return 'symbian';
	} else if(useragent.match(/RIM/i) || useragent.match(/BB/i)) {
		return 'blackberry';
	} else {
		return false;
	}
}

// GENERATE FORM 

function generateForm(formID,status_det,id_atividade,config,id_group) {

	var day , month , year, currentMonth , currentYear , currentDay , final_date , total_date , final_date_
	var calendarDateTime = app.calendar.create({
		inputEl: '.calendar_date_time_check',
		timePicker: false,
		//dateFormat: { day: 'numeric', month: 'numeric', year: 'numeric' },
		dateFormat: 'dd/mm/yyyy',
		on: {
			change: function(p, dayContainer, year, month, day ){
		
			},
			dayClick: function (p, dayContainer, year, month, day) {
				var final_date = day+'/'+month+'/'+year;
				$$('#data_servico').html(final_date)
				$$('#choose_date_dummy').val(final_date)
				calendarDateTime.close();

				
			}
		}
	  }); 
	
	  var pickerDescribe = app.picker.create({
		inputEl: '.calendar_time_check',
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
				calc_next_time(final_hour)
			},
			
		}
	  });
            
	$("#sjfb-fields").empty();
		$.getJSON(current_path+'/view/sjfb-load-form?form_id=' + formID, function(data) {
			
			if (data) {
				var conteudo_formulario = JSON.parse(data.conteudo_formulario);
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
					//$('#sjfb-fields').append('<p style="padding:5px;margin: 5px;background: #2f4260;" ><span style="color: #fff;font-size: 16px;font-weight: 700;">Check-list </span></p>')
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
						
						//Add the field
						$('#sjfb-fields').append(addFieldHTML(fieldType,id_atividade,label,config));

						
						var $currentField = $('#sjfb-fields .sjfb-field').last();
						//Add the label
						//console.log(v['label'])

						$currentField.find('label').text(v['label']);
						//Any choices?
						if (v['choices']) {
							//var uniqueID = Math.floor(Math.random()*999999)+1;
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
								
									/*var choiceHTML = '<div class="col-sm-6 col-md-4 col-xl">'+
										'<div class="form-radio">'+
											'<input id="radio-' + i + '" class="radio-outlined" '+enable_disable+' type="radio" name="radio-' + name_radio + '"' + selected + ' value="' + v['label'] + '" >'+
											'<label for="radio-' + i + '" class="radio-green">' + v['label'] + '</label>'+
										'</div>'+
									'</div>'; */

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
	
						//$('.choices-select').select2();
						j++;
	
					});


					var day , month , year, currentMonth , currentYear , currentDay , final_date , total_date , final_date_
					var calendarDateTime = app.calendar.create({
						inputEl: '.calendar_date_time_check',
						timePicker: false,
						//dateFormat: { day: 'numeric', month: 'numeric', year: 'numeric' },
						dateFormat: 'dd/mm/yyyy',
						on: {
							change: function(p, dayContainer, year, month, day ){
						
							},
							dayClick: function (p, dayContainer, year, month, day) {
								var final_date = day+'/'+month+'/'+year;
								$$('#data_servico').html(final_date)
								$$('#choose_date_dummy').val(final_date)
								calendarDateTime.close();

								
							}
						}
					}); 
					
					var pickerDescribe = app.picker.create({
						inputEl: '.calendar_time_check',
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
								//calc_next_time(final_hour)
							},
							
						}
					});
	
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
						call_lista_atividades(id_form,id_atividade);
					}, 150);
					
					
					function call_lista_atividades(id_form,id_atividade) {
					
					  $.getJSON(current_path+'/view/get_atividade_result?IdFormulario='+id_form+'&IdEvento='+id_atividade+'', function(data) {

						if(data){
							if(data.status  == 'SUCCESS') {
								  
							  var box_atividades = "";
							  var box_signature = "";
							  let user_info = Utils.userData();
							  if(user_info == null || user_info == 'null'){
								app.views.main.router.navigate({ name: 'sign-in' });
							}
							  let IdUser = user_info.id;
							  let type = user_info.type;
							  
							  //id = json.id;
							  var resp_atividade = data.resp_atividade;
							  for(var a = 0; a < resp_atividade.length; a++){
								  var statusdummy = "";
								  var find_id = resp_atividade[a].campo
								  var find_valor = resp_atividade[a].valor
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

													

													/*box_signature =  '<div class="title-col-100" style="padding:10px">'+
													'<h6 style="width: 100%;">'+
													img_valor_+'</h6>'+
													'</div>';*/
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

													

													/*box_signature =  '<div class="title-col-100" style="padding:10px">'+
													'<h6 style="width: 100%;">'+
													img_valor__+'</h6>'+
													'</div>';*/
												}

											} else {
												//console.log(res_type)
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

								  
							  }
						  
						  } else {
							  $('#no_item_message').show();
						  }
						}

					  });
					

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
								//var formID = $('#id_form').val();
								$.ajax({
								method: "POST",
								url: current_path+'/controller/sjfb-save-result',
								data: {
									data : data,
									formID:formID,
									at:id_atividade
								},
								dataType: 'json',
								success: function(response) {
									var status = response.status;

									if(status == 'SUCCESS'){
										var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
										toast_message.open();
										return false;
									} else {
										var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
										toast_message.open();
										return false;
									}

								}
							});
				
					});
	
				}

			
			} else {
				console.log('no data found')
			}
	
			//HTML templates for rendering frontend form fields
			function addFieldHTML(fieldType,id_atividade,label,config) {

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

			
		});
}

function generateFormOff(formID,status_det,id_atividade,config,id_group) {

	/*ar day , month , year, currentMonth , currentYear , currentDay , final_date , total_date , final_date_
	var calendarDateTime = app.calendar.create({
		inputEl: '.calendar_date_time_check',
		timePicker: false,
		//dateFormat: { day: 'numeric', month: 'numeric', year: 'numeric' },
		dateFormat: 'dd/mm/yyyy',
		on: {
			change: function(p, dayContainer, year, month, day ){
		
			},
			dayClick: function (p, dayContainer, year, month, day) {
				var final_date = day+'/'+month+'/'+year;
				$$('#data_servico').html(final_date)
				$$('#choose_date_dummy').val(final_date)
				calendarDateTime.close();

				
			}
		}
	  }); 
	
	  var pickerDescribe = app.picker.create({
		inputEl: '.calendar_time_check',
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
				calc_next_time(final_hour)
			},
			
		}
	  }); */
            
$("#sjfb-fields").empty();
var data2;		
	
	
var request = window.indexedDB.open('AnyInspect', 3);
var db;

request.onsuccess = function (event) {
	db = request.result;
	
	setTimeout(function(){
	  var objectStoreSingle = db.transaction("tb_form").objectStore("tb_form");
	  objectStoreSingle.openCursor().onsuccess = function(event) {
		var cursor = event.target.result;
			
			if(cursor.value.id == formID){ 

				  data2 = cursor.value.conteudo_formulario;
			}
		
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
					//$('#sjfb-fields').append('<p style="padding:5px;margin: 5px;background: #2f4260;" ><span style="color: #fff;font-size: 16px;font-weight: 700;">Check-list </span></p>')
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
						
						//Add the field
						$('#sjfb-fields').append(addFieldHTMLOff(fieldType,id_atividade,label,config));
	
						
						var $currentField = $('#sjfb-fields .sjfb-field').last();
						//Add the label
						//console.log(v['label'])
	
						$currentField.find('label').text(v['label']);
						//Any choices?
						if (v['choices']) {
							//var uniqueID = Math.floor(Math.random()*999999)+1;
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
								
									/*var choiceHTML = '<div class="col-sm-6 col-md-4 col-xl">'+
										'<div class="form-radio">'+
											'<input id="radio-' + i + '" class="radio-outlined" '+enable_disable+' type="radio" name="radio-' + name_radio + '"' + selected + ' value="' + v['label'] + '" >'+
											'<label for="radio-' + i + '" class="radio-green">' + v['label'] + '</label>'+
										'</div>'+
									'</div>'; */
	
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
	
						//$('.choices-select').select2();
						j++;
	
					});
	
	
					var day , month , year, currentMonth , currentYear , currentDay , final_date , total_date , final_date_
					var calendarDateTime = app.calendar.create({
						inputEl: '.calendar_date_time_check',
						timePicker: false,
						//dateFormat: { day: 'numeric', month: 'numeric', year: 'numeric' },
						dateFormat: 'dd/mm/yyyy',
						on: {
							change: function(p, dayContainer, year, month, day ){
						
							},
							dayClick: function (p, dayContainer, year, month, day) {
								var final_date = day+'/'+month+'/'+year;
								$$('#data_servico').html(final_date)
								$$('#choose_date_dummy').val(final_date)
								calendarDateTime.close();
	
								
							}
						}
					}); 
					
					var pickerDescribe = app.picker.create({
						inputEl: '.calendar_time_check',
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
								//calc_next_time(final_hour)
							},
							
						}
					});
	
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
						//call_lista_atividades_off(id_form,id_atividade);
					}, 150);
					
					
					function call_lista_atividades_off(id_form,id_atividade) {
					
					  $.getJSON(current_path+'/view/get_atividade_result?IdFormulario='+id_form+'&IdEvento='+id_atividade+'', function(data) {
	
						if(data){
							if(data.status  == 'SUCCESS') {
								  
							  var box_atividades = "";
							  var box_signature = "";
							  let user_info = Utils.userData();
							  if(user_info == null || user_info == 'null'){
								app.views.main.router.navigate({ name: 'sign-in' });
							}
							  let IdUser = user_info.id;
							  let type = user_info.type;
							  
							  //id = json.id;
							  var resp_atividade = data.resp_atividade;
							  for(var a = 0; a < resp_atividade.length; a++){
								  var statusdummy = "";
								  var find_id = resp_atividade[a].campo
								  var find_valor = resp_atividade[a].valor
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
	
											} else {
												//console.log(res_type)
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
	
								  
							  }
						  
						  } else {
							  $('#no_item_message').show();
						  }
						}
	
					  });
					
	
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
								//var formID = $('#id_form').val();
								$.ajax({
								method: "POST",
								url: current_path+'/controller/sjfb-save-result',
								data: {
									data : data,
									formID:formID,
									at:id_atividade
								},
								dataType: 'json',
								success: function(response) {
									var status = response.status;
	
									if(status == 'SUCCESS'){
										var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
										toast_message.open();
										return false;
									} else {
										var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
										toast_message.open();
										return false;
									}
	
								}
							});
				
					});
	
				}
	
			
			} else {
				console.log('no data found')
			}
		
		
		
		
		
		}

	
		
		
		
	
	
	
	}, 500);
}
	
	
			//HTML templates for rendering frontend form fields
			function addFieldHTMLOff(fieldType,id_atividade,label,config) {
				var k;
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
function save_comment(id_element,id_booking){
	var comment = $$('#new_comment_element').val();
	var comment_el = "";
	if(comment != ""){
		$.ajax({
			url:  current_path+"/controller/upload_comment_form",
			type : 'POST',
			dataType: 'JSON',
			data: {
				id_booking: id_booking,
				id_element: id_element,
				comment: comment
			},
			success: function(response){
				var status = response.status;
				var date_create = response.date_create;
				if(status == "SUCCESS") {
	
					comment_el += '<section class="year">'+
						'<section>'+
						'<ul>'+
						'<li>'+comment+'<br><small>'+date_create+'</small></li>'+
						'</ul>'+
						'</section>'+     
					'</section>';
	
					
	
					$$('#comment_list').append(comment_el);
					toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 3000,cssClass: 'success_toast'});
					toast_message.open();
					$$('#new_comment_element').val('');
	
				} else {
					toast_message = app.toast.create({text: 'Erro ao salvar',closeTimeout: 3000,cssClass: 'error_toast'});
					toast_message.open();
	
				}
	
			}
		}); 
	} else {
		toast_message = app.toast.create({text: 'Digite algum comentário',closeTimeout: 3000,cssClass: 'error_toast'});
		toast_message.open();
	}
	
	
}


// COMMENTS SAVE
function save_pa(id_element,id_booking){

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

/*setTimeout(function () {

var $ptrContent = $$('.ptr-content');
// Add 'refresh' listener on it
$ptrContent.on("ptr:refresh", function (e) {
  // Emulate 2s loading
  setTimeout(function () {
	$$('#open_list').html('<div><img style="width:100%;" src="assets/img/load_cont.gif" ></div>');
	call_open_events();
	setTimeout(function () {
		app.ptr.done(); // or e.detail();
	}, 150);
  
}, 1000);
});

$$('.scaleffect').on('touchstart', function () {
	$$(this).addClass('box-scale'); 
});
$$('.scaleffect').on('touchend', function () {
	$$(this).removeClass('box-scale'); 
});

}, 150); */

/*$$('.install_android').on('click', function(e){
	e.preventDefault();
	console.log('👍', 'butInstall-clicked');
	const promptEvent = window.deferredPrompt;
	if (!promptEvent) {
		console.log('The deferred prompt isnt available.');
	// The deferred prompt isn't available.
	return;
	}
	// Show the install prompt.
	promptEvent.prompt();
	// Log the result
	promptEvent.userChoice.then((result) => {
	console.log('👍', 'userChoice', result);
	// Reset the deferred prompt variable, since
	// prompt() can only be called once.
	window.deferredPrompt = null;

	$$('.sign-in .sheet-backdrop ').remove();
	app.sheet.close('.install_app');
	
	installandroid.close();
	// Hide the install button.
	
	});
	
});*/


/*var $ptrContent = $$('.ptr-content');
	
	$ptrContent.on('ptr:refresh', function (e) {
	let user_info = Utils.userData();
	if(user_info == null || user_info == ''){
		app.views.main.router.navigate({ name: 'sign-in' });
	} else {
		var IdUser = user_info.id;
		var type = user_info.type;

		console.log('fui acionado')

		$$('#open_list').html('<div><img style="width:100%;" src="assets/img/load_cont.gif" ></div>');
		call_open_events();
		setTimeout(function () {
			app.ptr.done(); // or e.detail();
		}, 1500);
	}
}); */

/*setTimeout(function(){ 
	
	$(".logout_global").click(function(e){
		console.log('to aqi no logout global')
		e.preventDefault();
		window.localStorage.removeItem('user_info_app_mir');
		app.views.main.router.navigate('/sign-in/' , {clearPreviousHistory: true});
	  });
	  
	  $(".hot_reload").click(function(e){
		e.preventDefault();
		window.location.reload()
	  });
}, 1000); */





// Init/Create main view
var mainView = app.views.create('.view-main', {
  url: '/'
});
