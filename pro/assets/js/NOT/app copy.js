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
	var IdUser = 1;
	var type = 'a';
	$$('#open_list').html('<img src="assets/img/load_cont.gif" />');
	fetch(current_path+'/view/get_open_events', {
		method: 'POST',
		headers : new Headers(),
		body:JSON.stringify({IdUser:IdUser,type:type})
		}).then((res) => res.json())
		.then((data) =>  { 
			
			var dummy_open_list  = "";
			var current_status = "";
			var status = data.status;
			var status_ = "";
			var read = "";
		
			
			if(status == 'SUCCESS'){
				data.content.forEach(function (data) {

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

					dummy_open_list += '<li class="swipeout">'+
												'<a href="/atividade/'+data.id+'" class="item-link item-content swipeout-content link">'+
												'<div class="item-media">'+
													'<img src="'+data.foto_funcionario+'" width="48" height="48" alt="">'+
													'<div class="online"></div>'+
												'</div>'+
												'<div class="item-inner">'+
													'<div class="item-title-row">'+
														'<div class="item-title">'+data.desc_service+'</div>'+
														'<div class="item-after '+current_status+' ">'+status_+'</div>'+
													'</div>'+
													'<div class="item-text '+read+' ">'+data.br_start+'</div>'+
												'</div>'+
											'</a>'+
											'<div class="swipeout-actions-right">'+
												'<a href="#" data-confirm="Are you sure you want to delete this item?" class="swipeout-delete"><i class="f7-icons">multiply_circle</i></a>'+
											'</div>'+
										'</li>' 
				});
			  
				$$('#open_list').html(dummy_open_list);
			} else {
				$$('#open_list').html('<h2 style="text-align: center;margin-top: 80px;color: #ececec;font-size: 125px;">0</h2>');

				
			}



		})
		.catch((err)=>console.log(err))
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
	var IdUser = user_info.id;
	var type = user_info.type;
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
	
				  dummy_open_list_cal += '<li class="swipeout">'+
											  '<a href="/atividade/'+data.id+'" class="item-link item-content swipeout-content link">'+
											  '<div class="item-media">'+
												  '<img src="'+data.foto_funcionario+'" width="48" height="48" alt="">'+
												  '<div class="online"></div>'+
											  '</div>'+
											  '<div class="item-inner">'+
												  '<div class="item-title-row">'+
													  '<div class="item-title">'+data.desc_service+'</div>'+
													  '<div class="item-after '+current_status+' ">'+status_+'</div>'+
												  '</div>'+
												  '<div class="item-text '+read+' ">'+data.br_start+'</div>'+
											  '</div>'+
										  '</a>'+
										  '<div class="swipeout-actions-right">'+
											  '<a href="#" data-confirm="Are you sure you want to delete this item?" class="swipeout-delete"><i class="f7-icons">multiply_circle</i></a>'+
										  '</div>'+
									  '</li>' 
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

				  dummy_open_list_cal += '<li class="swipeout">'+
											  '<a href="/atividade/'+data.id+'" class="item-link item-content swipeout-content link">'+
											  '<div class="item-media">'+
												  '<img src="'+data.foto_funcionario+'" width="48" height="48" alt="">'+
												  '<div class="online"></div>'+
											  '</div>'+
											  '<div class="item-inner">'+
												  '<div class="item-title-row">'+
													  '<div class="item-title">'+data.desc_service+'</div>'+
													  '<div class="item-after '+current_status+' ">'+status_+'</div>'+
												  '</div>'+
												  '<div class="item-text '+read+' ">'+data.br_start+'</div>'+
											  '</div>'+
										  '</a>'+
										  '<div class="swipeout-actions-right">'+
											  '<a href="#" data-confirm="Are you sure you want to delete this item?" class="swipeout-delete"><i class="f7-icons">multiply_circle</i></a>'+
										  '</div>'+
									  '</li>' 
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

	var type = 'a';
	var size_width = $$('#boxcanvas_cli').width() - 10;

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
		var nome_empresa = data.empresa.nome_empresa;
		var endereco_cliente = data.empresa.cidade;
		var foto_empresa = data.empresa.foto_empresa;

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
		var foto_empresa = det_info.foto_empresa;
		var title_service_det = det_info.title;
		var preco_pet_det = det_info.preco;
		var cliente_foto_det = det_info.foto_cliente;
		var cliente_name_det = det_info.name_client;
		var status_det = det_info.status_;
		var hora_ini_det = det_info.start;
		var hora_fim_det = det_info.end;
		var come_ini_det = det_info.started_at;
		var term_fim_det = det_info.ended_at;
		var exec_por_det = det_info.quem_executou;
		var eventID = det_info.id;
		var id_funcionario = det_info.id_funcionario;
		var name_bolt = det_info.name_bolt;
		var br_start = det_info.br_start;
		var start_time = det_info.start_time;
		var end_time = det_info.end_time;
		var info_extra = det_info.info_extra;
		var phone = det_info.phone;
		var id_form = det_info.id_form;
		var qrcode = det_info.qrcode;
		var priority = det_info.priority;
		var title = det_info.title;
		var id_client = det_info.id_client;
		var phone_team = det_info.phone_team;
		var foto_cliente = det_info.foto_cliente
		var start_lat = det_info.start_lat
		var start_lon = det_info.start_lon
		var qr_checkin = det_info.qr_checkin


		generateForm(id_form,status_det,id_atividade);
		
		$("#titulo_atividade").html('<strong>'+det_info.desc_service+'</strong>');
		$("#ativo_equipamento").html('<strong>'+det_info.descricao+'</strong>');
		$("#local_ativo").html('<strong>'+det_info.local_ativo+'</strong>');
		$("#data_atividade").html('<strong>'+det_info.br_start+'</strong>');
		$("#tempo_estimado").html('<strong>'+det_info.est_time+'</strong>');

		if(status_det == 'Pendente'){
			$$('.status_activity').html('<div class="content status_pendente"><span class="">'+status_det+'</span></div>');
			$$('.right_tab_act').html('')

			if(type == 'a' || type == 'g' ){
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
			
		}
	
		  if(status_det == 'Finalizado'){
			$$('.status_activity').html('<div class="content status_finalizado"><span class="">'+status_det+'</span></div>')
			if(type == 'a' || type == 'g' ){
				
			  $$('#box_finish_action').show();	
			  $$('#box_finish_action').html('<button style="float: left;width: 48%;margin-right: 5px;font-size: 16px;line-height: inherit;" id="concluido" class="btn status_approve  button btn_approve change_status_approve">Aprovar</button>'+
			  '<button id="reprovado" style="float: left;width: 48%;margin-right: 5px;font-size: 16px;line-height: inherit;" class="btn btn_repprove status_repprove button  change_status_approve">Reprovar</button>');
			  $$('#box_finish_action').show();
			
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
			$$('#btn_action_service').html('<a style="background:#26cc64;color: #fff;" class="button button-large button-fill open_zap_send" style="background: #39ca3d;"><i style="font-size: 24px;margin-right: 10px;" class="fa fa-whatsapp"></i>Enviar WhatsApp</a>');
			
			$$('#box_save_checklist').hide();
		  } 

		// START ATIVITY 
		setTimeout(function(){
			$$('.change_status_service').on('click', function (e) {
				e.preventDefault();
				let the_status = this.id;
				let id_user = 1
				var txt_confirma;
				var loadLocation = "";

				var gps_permission = app.sheet.create({
					el: '.gps_permission',
					swipeToClose: false,
					swipeToStep: true,
					backdrop: true,
					closeByBackdropClick: false,
					closeByOutsideClick: false
				  });

				if(config.geo_location == 0 && config.qr_check_in == 0){
					altera_status(eventID,the_status,id_funcionario,id_form);
				
				} else {

					if(the_status == 'comecar'){
						txt_confirma = 'Iniciar Atividade';
						
						if(config.geo_location == 1){

							if(start_lat == ''){
								// JA FEZ O CHECK-IN
								if(config.qr_check_in == 0){
									app.views.main.router.navigate('/gps-signin/0/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form)
								} else {
									app.views.main.router.navigate('/gps-signin/1/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form)
								}
							} else {
								if(qr_checkin == 0){
									app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
								} else {
									altera_status(eventID,the_status,id_funcionario,id_form);
								}
							}
						
						} else {
							if(qr_checkin == 0){
								app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
							} else {
								altera_status(eventID,the_status,id_funcionario,id_form);
							}

						}
 
						
						//app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
					}
					if(the_status == 'finalizar'){
						txt_confirma = 'Enviar Aprovação';
						altera_status(eventID,the_status,id_funcionario,id_form);
					}
		
					if(the_status == 'cancelar'){
						txt_confirma = 'Cancelar Atividade';
					}

				
					
				}
				

			});
		
		
			
		// CHANGE CONC STATUS

		$$('.change_status_approve').on('click', function (e) {
			e.preventDefault();
			let the_status = this.id;
			var txt_confirma;
			
									
			if(the_status == 'concluido'){
				txt_confirma = 'Aprovar a Atividade';
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
											get_info_gerais(id_atividade)
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
							  let IdUser = user_info.id;
							  let type = user_info.type;
							  call_open_events();
							  get_info_gerais(id_atividade)
						  }
				  
				  })
				  .catch((err)=>console.log(err))
				  });
			
			}
		});
		
		
		}, 500); 

		if(config.signature == 1){

			// CHECK IF HAS SIG ALREADY
			fetch(current_path+'/view/get_evi_sign', {
				method: 'POST',
				headers : new Headers(),
				body:JSON.stringify({
					id:id
				})
				}).then((res) => res.json())
				.then((data) =>  {
					var status = "" ;
					var box_aprovacao = "";
					status = data.status;
					if(status == 'SUCCESS'){
						 // ADD ALL SIGN
						 var img_sign = data.img_sign;

						 var src_img_sign = "";
						 var target_img_sign = "";
						 for(var c = 0; c < img_sign.length; c++){
							 var src_img_sign = img_sign[c].src_img;
							 var target_img = img_sign[c].target_img;

							 $$('#boxcanvas_cli').html('<div><img height="112" width="'+size_width+'" src="'+src_img_sign+'" alt=""></div>');

						 }
						 if(status_det == 'Finalizado' || status_det == 'Concluído' || status_det == 'Pendente'){

						 } else {
							box_aprovacao = '<div class="col-100">'+
												'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
												'</div>';
							$$('#box_finish_action').html(box_aprovacao);
							window.animatelo.bounceIn('#box_finish_action');
						 }
						 




					} else {
						// ENABLE SIGNIN BOX

						$$('#box_action_sigcli').html('<div class="col-100"><a style="width:100%" class="btn btn-primary" id="save_sigcli">Confirmar Assinatura</a></div>');
						$('#boxcanvas_cli').html('<a class="box-shadow"  id="clear_sig1cli" style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top: -38px;"><i class="fa fa-eraser" style="font-size: 16px;color: #4c4c4c;"></i></a><canvas id="signature-pad-cli" class="signature-pad-cli" width='+size_width+' height="110" ></canvas>')
						var signaturePadcli = new SignaturePad(document.getElementById('signature-pad-cli'), {
							backgroundColor: 'rgba(255, 255, 255, 0)',
							penColor: 'rgb(0, 0, 0)',
							maxWidth: 1.5,
							velocityFilterWeight: 0.2
						});

						var saveButton = document.getElementById('save_sigcli');
						var cancelButton = document.getElementById('clear_sig1cli');
						
						saveButton.addEventListener('click', function (event) {
							event.preventDefault();

							var data = signaturePadcli.toDataURL('image/png');
							if(data == ''){
								var toast_message = app.toast.create({text: 'Assinatura não localizada!',closeTimeout: 2000,cssClass: 'error_toast'});
								  toast_message.open();
								  return;
							} else {
								setTimeout(function(){
									$.ajax({
										url:  current_path+"/controller/upload_image_sign",
										type : 'POST',
										dataType: 'JSON',
										data: {
										image_data: data,
										id_imagem: 'sig_cli',
										id_booking: id,
										id_user: 1,
										},
										success: function(response){
											status = response.status;
											if(status == "SUCCESS") {
												var image_data = "";
												var id_imagem = "";
												$(".loading").hide();
												toast_message = app.toast.create({text: 'Salvo com sucesso',closeTimeout: 3000,cssClass: 'success_toast'});
												toast_message.open();
												$('#box_action_sigcli').hide();
												$$('#boxcanvas_cli').html('<div><img height="200" width="'+size_width+'" src="'+data+'" alt=""></div>');

												box_aprovacao = '<div class="col-100">'+
												'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
												'</div>';

												
						
												$$('#box_finish_action').html(box_aprovacao);

												window.animatelo.bounceIn('#box_finish_action');

												setTimeout(function(){
													$$('.change_status_service').on('click', function (e) {
														e.preventDefault();
														let the_status = this.id;
														let id_user = 1
														var txt_confirma;


														var get_img = $('#dummy_sig_cli').val('');
														$$('#boxcanvas_cli').html('<div><img height="20" width="30" src="assets/img/sign.png" alt=""><img height="112" width="'+size_width+'" src="'+get_img+'" alt=""></div>');
														
														if(config.qr_check_in == 1){
															if(the_status == 'comecar'){
																txt_confirma = 'Iniciar Atividade';
																app.views.main.router.navigate('/qr-signin/'+id+'/'+the_status+'/'+id_user+'/'+qrcode+'/'+id_form);
															}
															if(the_status == 'finalizar'){
																txt_confirma = 'Enviar Aprovação';
																altera_status(eventID,the_status,id_funcionario,id_form);
															}
												
															if(the_status == 'cancelar'){
																txt_confirma = 'Cancelar Atividade';
															}
														} else {
															altera_status(eventID,the_status,id_funcionario,id_form);
														}
										
													});
												}, 200);

											} else {
												toastr.error('Erro ao Editar a Imagem', 'Sucesso');
						
											}
						
										}
									}); 
								}, 500); 
							}
								
								
						
						});
						
						cancelButton.addEventListener('click', function (event) {
							event.preventDefault();
							$('#dummy_sig_cli').val('')
							signaturePadcli.clear();
						});
					}
			
			
					function fill_canvas(img,target_img) {
						if(target_img == 'box_sig_colab'){
							var canvas = document.getElementById('signature-pad');
						} else {
							var canvas = document.getElementById('signature-pad-cli');
						}
						var context = canvas.getContext('2d');
						var imgPath = img;
						var imgObj = new Image();
						imgObj.src = imgPath;
						var x = 0;
						var y = 0;
					
						imgObj.onload = function(){
							context.drawImage(imgObj, x, y);
						} 
					}
			
			
			
				})
			.catch((err)=>console.log(err))
			
			
		} else {
			$('#box_sig_cli').html('')
			box_aprovacao = '<div class="col-100">'+
			'<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Finalizar Atividade</button>'+
			'</div>';
			$$('#box_finish_action').html(box_aprovacao);

		}
		
  
		})
		.catch((err)=>console.log(err))


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

 
function start_get_location(gps,eventID,the_status,id_user,qrcode,id_form){
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
				//gps_signin_off(id,id_form,gps,message);

				gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message)
				
				
				break; 
	
			case 3: 
	
				console.error( "The request to get user location timed out." ); 
				message = 'Tempo esgotado.Não foi possível encontrar sua localização';
				//app.dialog.alert('Ops!Não foi possível encontrar sua localização  ' , 'Erro');
				//gps_signin_off(id,id_form,gps,message);
				gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message)
				
				
				break; 
	
			case 4: 
				message = 'Não foi possível encontrar sua localização';
				gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message)
				//gps_signin_off(id,id_form,gps,message);
				console.error( "An unknown error occurred." ); 
				break; 
		}
		
		//gps_signin_off(id,id_form,gps);

		
	}


}

function gps_try(gps,eventID,the_status,id_user,qrcode,id_form,message){

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
manual_tag_qr = '<li class="item-content item-input">'+
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
		'</div>'+
	'</li>';

$$('#box_not_found_tag').html(manual_tag_qr);



$$('.try_gps_again').on('click', function (e) {
	e.preventDefault();
	start_get_location(gps,eventID,the_status,id_user,qrcode,id_form,message);
  }); 

  $$('.confirm_gps_manual').on('click', function (e) {
	e.preventDefault();
	gps_signin_off(gps,eventID,the_status,id_user,qrcode,id_form,message)
  }); 
  
  $$('.close_manual').on('click', function (e) {
	e.preventDefault();
	qr_manual_Tag.close();
	setTimeout(function () {
		$$('.back').click()
	}, 1000);
  }); 



}

function gps_signin_off(gps,eventID,the_status,id_user,qrcode,id_form,message){
	var gps_lat = 0;
	var gps_lon = 0;

	let user_info = Utils.userData();
	var id_funcionario = user_info.id;
	var type = user_info.type;
	var the_status = 'Em Andamento';

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
			
			if(gps == 1){
				get_info_gerais(eventID);
			} else {
				altera_status(eventID,the_status,id_funcionario,id_form);
			}
			
			qr_manual_Tag.close();
			setTimeout(function () {
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
	
	//var desc_box = '<div style="text-align:center;"><h4>'+descricao+'</h4><p>'+full_address+'</p></div>';
	var desc_box = 'Localização';

	if(map == undefined){
		/*var cities = L.layerGroup();
		var mbAttr = 'Map data &copy; Mapbox';
		var	mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

		var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
		streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

		map = L.map('map_atividade', {
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

		L.control.layers(baseLayers, overlays).addTo(map); */

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

		/*var cities = L.layerGroup();
		var mbAttr = 'Map data &copy; Mapbox';
			mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

		var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
		streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});


		map = L.map('map_atividade', {
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
	
		L.control.layers(baseLayers, overlays).addTo(map); */
	
	}  
	


}
	


// FUNCION OPEN CAMERA READ QR CODE

function qr_code_start(eventID,the_status,id_funcionario,qrcode,id_form){
	const html5QrCode = new Html5Qrcode("qr-reader",true);

	open_camera_qr_sign(eventID,the_status,id_funcionario,qrcode,id_form,html5QrCode);

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
		open_camera_qr_sign(eventID,the_status,id_funcionario,qrcode,id_form,html5QrCode);
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
	var IdUser = user_info.id;
	var type = user_info.type;
	
	
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
			//app.views.main.router.navigate({ name: 'info_ativo' });
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
	var IdUser = user_info.id;
	var type = user_info.type;

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

function open_camera_qr_sign(eventID,the_status,id_funcionario,qrcode,id_form,html5QrCode){
	
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
				  altera_status(eventID,the_status,id_funcionario,id_form);
  
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
								 console.log(the_status);
								 
								  altera_status(eventID,the_status,id_funcionario,id_form);

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

function get_tag_id(code,eventID,the_status,id_funcionario,qrcode,id_form){

	if(code == qrcode){
		altera_status(eventID,the_status,id_funcionario,id_form)
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
				start_camera_open(eventID,the_status,id_funcionario,qrcode);
			} else {
				//qr_open(eventID,the_status,id_funcionario,qrcode);
				qr_code_start(eventID,the_status,id_funcionario,qrcode);
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
				get_tag_id(value_manual,eventID,the_status,id_funcionario,qrcode,id_form);

			}

			

		});

	}

	
}

function altera_status(eventID,the_status,id_funcionario,id_form){

		let user_info = Utils.userData();
		let IdUser = user_info.id;

		fetch(current_path+'/view/alteraStatus.php', {
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
				
				if(the_status == 'comecar'){
					$$('#btn_action_service').html('');
					$$('#status_servico').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');

					setTimeout(function(){
						call_open_events();
						get_info_gerais(eventID);
					}, 200);
					
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
										
				}
				
				if(the_status == 'Em Andamento'){
					//$$('#btn_action_service').html('<button id="finalizar" class="button btn_status_finalizado change_status_service scaleffect no-active-state">Enviar Aprovação</button>');
					$$('#status_servico').html('<div class="content status_andamento"><span class="">Em Andamento</span></div>');
					$$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');

					setTimeout(function(){
						call_open_events();
						get_info_gerais(eventID);
					}, 200);
					
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
										
				}
				
				if(the_status == 'cancelar'){
					$$('#btn_action_service').html('<button class="button btn_status_cancelado">Cancelado</button>');
					$$('#status_servico').html('<div class="content status_cancelado"><span class="">Cancelado</span></div> ');

					
					open_manual_Tag.close();
					let user_info = Utils.userData();
					let IdUser = user_info.id;
					let type = user_info.type;
					//get_open_service(IdUser,type);
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
				
				}
				
				if(the_status == 'finalizar'){
					let user_info = Utils.userData();
					let IdUser = user_info.id;
					let type = user_info.type;
					if(type == 'a' || type == 'g' ){
						$$('#btn_action_service').html('<button style="float: left;width: 48%;margin-right: 5px;font-size: 16px;" id="concluido" class="status_approve  button btn_approve change_status_approve">Aprovar</button><button id="reprovado"  style="float: left;width: 48%;font-size: 16px;" class="btn_repprove status_repprove button btn_status_reprovar change_status_approve">Reprovar</button>');
						
					} else {
						$$('#btn_action_service').html('');
					}
					$$('#status_servico').html('<div class="content status_finalizado"><span class="">Finalizado</span></div> ');
	
					
					//open_manual_Tag.close();
					get_info_gerais(eventID);
					call_open_events();
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();

					$$("input,textarea,select").prop("disabled",true); 
					$$('#box_save_checklist').hide();
					$$('#box_images_up').hide();
					$$("#phone_cliente").prop("disabled",false); 
					$$("#zap_message").prop("disabled",false); 
					//$$('#term_fim_det').html(get_data_atual());
				
				}
				
				if(the_status == 'concluido'){
					$$('#btn_action_service').html('');
					$$('#box_save_checklist').html('');
					$$('#status_servico').html('<div class="content status_concluido "><span class="">Concluído</span></div> ');
					let user_info = Utils.userData();
					let IdUser = user_info.id;
					let type = user_info.type;
					//get_open_service(IdUser,type);
					var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
					toast_message.open();
					get_info_gerais(eventID);
					//send_zap.open();
				
				}

				if(the_status == 'reprovar'){
					$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
					$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
					get_info_gerais(eventID);
				
				}
				
				/*$$('.change_status_service').on('click', function () {
					let the_status = this.id;
					var txt_confirma;
					if(the_status == 'comecar'){
						txt_confirma = 'Iniciar Atividade';
					}
					if(the_status == 'finalizar'){
						txt_confirma = 'Enviar Aprovação';
					}
	
					if(the_status == 'cancelar'){
						txt_confirma = 'Cancelar Atividade';
					}

					
					device_type = deviceOS();
					if(device_type != 'iphone'){
						start_camera_open(eventID,the_status,id_funcionario,qrcode);
					} else {
						//qr_open(eventID,the_status,id_funcionario,qrcode);
						qr_code_start(eventID,the_status,id_funcionario,qrcode);
						$$('#camera_box').hide();
					}
				
				}); */

				/*$$('.change_status_approve').on('click', function (e) {
					e.preventDefault();
					let the_status = this.id;
					var txt_confirma;
					
											
					if(the_status == 'concluido'){
						txt_confirma = 'Aprovar a Atividade';
					} 
					if(the_status == 'reprovado'){
						txt_confirma = 'Reprovar a Atividade';
							
							open_manual_Tag.open();
									var manual_tag = "";
										manual_tag = '<li class="item-content item-input">'+
											'<div class="item-inner">'+
												'<div class="item-input-wrap">'+
													'<p style="text-align:center;" >Adicionar Comentário </p><br>'+
													'<textarea id="reprove_message_" cols="30" rows="10" placeholder="Digite sua Justificativa"></textarea>'+
													'<button class="button btn_confirma_reprove">Confirmar</button>'+
												'</div>'+
											'</div>'+
										'</li>';
		
									$$('#box_not_found').html(manual_tag);
									
									$$('.close_manual').on('click', function (e) {
										e.preventDefault();
										open_manual_Tag.close();
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
														$$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
														$$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
													
													}
													
													open_manual_Tag.close();
													let user_info = Utils.userData();
													let IdUser = user_info.id;
													let type = user_info.type;
													get_open_service(IdUser,type);
													$$('#phone_cliente').val(phone_team);
													$('#zap_message').val('Atividade Reprovada - Motivo: ' +repprove_message);
													send_zap.open();
													
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
										  //send_zap.open();
										  if(title == 'Lavagem'){
											add_extra_service(eventID,id_funcionario,id_bolt,id_client)
										  } 
										  
									  }
		  
									  if(the_status == 'reprovar'){
										  $$('#btn_action_service').html('<button id="comecar" class="button btn_status_pendente change_status_service scaleffect no-active-state ">Iniciar Atividade</button>');
										  $$('#status_servico').html('<div class="content status_pendente"><span class="">Pendente</span></div> ');
									  
									  }
									  let user_info = Utils.userData();
									  let IdUser = user_info.id;
									  let type = user_info.type;
									  get_open_service(IdUser,type);
								  }
						  
						  })
						  .catch((err)=>console.log(err))
						  });
					
					}
				}); */

			
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

function generateForm(formID,status_det,id_atividade) {
            
	$("#sjfb-fields").empty();

		$.getJSON(current_path+'/view/sjfb-load-form?form_id=' + formID, function(data) {
			
			if (data) {
				var conteudo_formulario = JSON.parse(data.conteudo_formulario);
				var enable_disable = ""; 
				var i = 0;
				var k = 0;
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

				if(conteudo_formulario == null || conteudo_formulario == 'null' ){
					
				} else {
					//$('#sjfb-fields').append('<p style="padding:5px;margin: 5px;background: #2f4260;" ><span style="color: #fff;font-size: 16px;font-weight: 700;">Check-list </span></p>')
					$.each( conteudo_formulario, function( k, v ) {
						var fieldType = v['type'];
						var label = v['label'];

						c_type = fieldType;
						c_label = label;

						var res = c_label.split("@");

       					c_label_final = res[0];
						c_period = res[1];

						console.log(c_label_final)
						console.log(c_period)

						//Add the field
						$('#sjfb-fields').append(addFieldHTML(fieldType,id_atividade,label));

						
						var $currentField = $('#sjfb-fields .sjfb-field').last();
						//Add the label
						$currentField.find('label').text(c_label);
						//Any choices?
						if (v['choices']) {
							//var uniqueID = Math.floor(Math.random()*999999)+1;
							var uniqueID = formID;
							var name_radio = $currentField.find('label').text(c_label).prevObject[0].id;
							var choose_type = "";
							var choose_choise = "";
							  
							$.each( v['choices'], function( k, v ) {
	
							
								if (fieldType == 'select') {
									var selected = v['sel'] ? ' selected' : '';
									var choiceHTML = '<option' + selected + '>' + c_label + '</option>';
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
								   } else{
									choose_type = 'fa fa-thumbs-down';
									choose_choise = 'no_option';
								   }

									var choiceHTML = '<label for="radio-' + i + '" class="col-50">'+
										'<input class="'+enable_disable+'" id="radio-' + i + '" type="radio" name="radio-' + name_radio + '" ' + selected + ' value="' + c_label + '" >'+
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
																'<input class="form-check-input styled-checkbox '+enable_disable+' " id="ch_'+i+'" type="checkbox" name="checkbox-'+uniqueID+'[]"' + selected + ' value="' + v['label'] + '" >'+
																'<label for="ch_'+i+'" class="form-check-label check-green ">' + c_label + '</label>'+
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
						   
							$currentField.addClass('required-field');
						}
	
						//$('.choices-select').select2();
	
					});
	
					$('#sjfb-fields').append('<div id="box_save_checklist" style="padding:10px;"><button style="width:100%;" type="submitt" class="btn btn-primary save_check_list button">Salvar Atividades</button></div>');
					
					if(status_det == 'Finalizado' || status_det == 'Concluído'){
						enable_disable = 'disabled';
						$("input,textarea,select").prop("disabled",true); 
						$('#box_save_checklist').hide();
	
						$("#phone_cliente").prop("disabled",false); 
						$("#zap_message").prop("disabled",false); 
					}
	
					call_lista_atividades(id_form,id_atividade);
					
					function call_lista_atividades(id_form,id_atividade) {
					
					  $.getJSON(current_path+'/view/get_atividade_result?IdFormulario='+id_form+'&IdEvento='+id_atividade+'', function(data) {

						if(data){
							if(data.status  == 'SUCCESS') {
								  
							  var box_atividades = "";
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
											  $("input[name="+find_id+"]").val([find_valor]);
										  
									  } 
								  }
								  $('input[name="'+find_id+'[]"]').each(function(){
									  var res = find_valor.split(",");
									  for(i = 0; i < res.length; i++) {
										  if(res[i] == $(this).attr('value')){
												  $(this).prop( "checked", true );
										  } 
										}
								  });
								  $('#'+find_id).val(find_valor);
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
	
			
			}
	
			//HTML templates for rendering frontend form fields
			function addFieldHTML(fieldType,id_atividade,label) {

				k++;
				var uniqueID = formID;
				var rand = formID;

				switch (fieldType) {

					
	
					case 'text':

					return '' +
							'<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-text field_elements ">' +
							'<div class="block" ><label for="text-' + uniqueID + '" class="block-title" ></label></div>' +
								'<input name="text-'+uniqueID+'-'+k+'" class="form-control" type="text" id="text-'+uniqueID +'-'+k+'">' +
							
								'<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
									'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
									'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
									'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
								
								'</div>'+

							'</div>';
							
	
					case 'textarea':
						return '' +
							'<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-textarea field_elements">' +
								'<div class="block" ><label for="textarea-' + uniqueID + '" class="block-title"></label></div>' +
								'<textarea class="form-control form-control-lg" name="textarea-'+ uniqueID +'-'+k+'"  id="textarea-' + uniqueID +'-'+k+'"></textarea>' +

								'<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
									'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
									'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
									'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
								
								'</div>'+			   
							
							'</div>';
	
					case 'select':
						return '' +
							'<div id="sjfb-' + uniqueID +'" class="sjfb-field sjfb-select field_elements">' +
								'<div class="block" ><label for="select-' + uniqueID + '" class="block-title"></label></div>' +
								'<select name="select-' + uniqueID +'-'+k+'" id="select-' + uniqueID +'-'+k+'" class="form-control choices choices-select"></select>' +
							
								'<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
									'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
									'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
									'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
								
								'</div>'+
							
							
							'</div>';
	
					case 'radio':

						return '' +
							'<div id="sjfb-'+uniqueID+'-'+k+'" class="list sjfb-field sjfb-radio field_elements">' +
								'<div class="block" ><label class="block-title"></label></div>' +
								'<li class="row choices choices-radio"></li>' +
								
								'<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
									'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
									'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
									'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
								
								'</div>'+

							'</div>';
	
					case 'checkbox':
						return '' +
							'<div id="sjfb-'+uniqueID+'-'+k+'" class="list sjfb-field sjfb-checkbox field_elements">' +
								'<div class="block" ><label class="block-title"></label></div>' +
								'<li class="choices choices-checkbox"></li>' +
								
									'<div class="row block" style="text-align: center;margin-top: 10px;border-top: 1px solid #ececec;padding: 10px;">'+
										'<div class="action_block col-33" ><a href="/comments-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' " ><i class="fa fa-comment"></i>  </a></div>'+
										'<div class="action_block col-33"><a href="/imagem-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-camera"></i> </a></div>'+
										'<div class="action_block col-33"><a href="/pa-atividade/'+uniqueID+'-'+k+'/'+id_atividade+'/'+label+' "><i class="fa fa-exclamation-triangle"></i> </a></div>'+
									'</div>'+

							'</div>';
	
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
