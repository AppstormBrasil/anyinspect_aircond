<?php include('includes/common/check_permission.php'); ?>

	<link rel="stylesheet" href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
	<link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

<style>
.nav-tabs .nav-link.active {
    color: #ffffff;
    border-radius: 5px;
    background: #18998d;
}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-4 col-xxl-4">
		<ul class="nav nav-tabs" style="background: white;box-shadow: -1px 3px 20px 16px rgb(119 119 119 / 10%);border-radius: 5px;margin-bottom: 15px;">
			<li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link active show">Registrar</a>
			</li>
			<li class="nav-item"><a href="#qrcode" data-toggle="tab" class="nav-link">QR Code</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="my-posts" class="tab-pane fade active show">
					<div class="card ">
						<div class="card-body campaign-statistics p-0">
							<h4 class="card-title" style="padding-left: 20px;padding-top: 20px;">Registrar Ferramenta</h4>
							<form class="form-visitante" action="javascript:save_action_tooling();" method="post" style="width:100%;">
								<div class="col-lg-12">
									<div class="form-group">
											<label class="text-label">Ferramenta</label>
											<select class="form-control" id="ferramentas" name="ferramentas" required ></select>
										</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
											<label class="text-label">Colaborador</label>
											<select style="" id="lista_colaboradores" name="lista_colaboradores" value="" ></select>
										</div>
								</div>
								<div id="box_descricao" class="col-lg-12">
									<div class="form-group">
										<label class="text-label">Nº OS</label>
										<div class="input-group">
											<input type="text" class="form-control" id="numero_os" name="numero_os" placeholder="" required>
										</div>
									</div>
								</div>

								<div id="box_descricao" class="col-lg-12">
									<div class="form-group">
										<label class="text-label">Destino</label>
										<div class="input-group">
											<input type="text" class="form-control" id="destino" name="destino" placeholder="" required>
										</div>
									</div>
								</div>

								<div id="box_descricao" class="col-lg-12">
									<div class="form-group">
										<label class="text-label">Observação</label>
										<div class="input-group">
											<input type="text" class="form-control" id="observacao" name="observacao" placeholder="">
										</div>
									</div>
								</div>
								
								<div class="col-lg-12" style="float: left;">
									<div class="form-group">
										<label class="text-label">Ação</label>
										<div class="d-flex align-items-center">
											<div class="input-group mb-0">
												<select id="acao" class="form-control">
													<option disabled selected value="">- Selecione -</option>
													<option value="1">Entrada</option>
													<option value="2">Saída</option>
												</select>
											</div>  
										</div>
									</div>
								</div>

								<div class="modal-footer">
									<button style="width:100%;" class="btn btn-success" type="submit">Salvar</button>
								</div>

							</form>
						</div>
					</div>
				</div>
				<div id="qrcode" class="tab-pane fade">
				<div class="card ">
					<div class="card-body campaign-statistics p-0">
						<h4 class="card-title" style="padding-left: 20px;padding-top: 20px;">Registrar QR Code</h4>
						<div class="card-block text-center">
									<div class="well" style="position: relative;display: inline-block;">
								<canvas  height="200" id="webcodecam-canvas"></canvas>
								<div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
								<div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
								<div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
								<div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
							</div>
							<div style="display:none;" class="alert alert-danger box_warn_message_qr text-center">  <span style="font-size: 12px;" class="warn_message_qr text-center"></span>
							</div>
							<div style="display:none;" class="alert alert-success box_success_message_qr text-center"> <span style="font-size: 12px;" class="success_message_qr text-center"></span>
								</div>
								<ul style="width:50%;margin:auto;" class="list-icons d-flex flex-item text-center p-t-10">
								<li class="col"><a href="javascript:void(0)" onclick="play_camera();" data-toggle="tooltip" title="" data-original-title="Ligar Scaner" style="font-size: 30px;color: #9e9e9e;"><i class="fa fa-video-camera font-20"></i></a></li>
								<li class="col"><a href="javascript:void(0)" onclick="stop_camera();" data-toggle="tooltip" title="" data-original-title="Desligar Scaner" style="font-size: 30px;color: #9e9e9e;"><i class="fa fa-power-off font-20"></i></a></li>

							</ul>
						</div>
					</div>
				</div>	
			</div>
			</div>		
		</div>
		<div class="col-xl-8 col-xxl-8">
			<div class="card chat-app-wrapper">
				<div class="card-body chat-contacts p-0 ">
					<h4 class="card-title " style="background: white;margin-bottom: 0px;padding: 20px;">Lista de Ferramentas</h4>
					<div class="event-sideber-search">
						<form action="#" method="post" class="chat-search-form">
							<input onkeyup="myFunction()" id="search_encomendas" type="text" class="form-control" placeholder="Procurar">
							<i class="fa fa-search"></i>
						</form>
					</div>
					<div id="accordion-three" class="current-campaign-list accordion list-encomendas-right" >
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<script src="assets/plugins/innoto-switchery/dist/switchery.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="js/plugins-init/material-date-picker-init.js"></script>
	
	<script src="assets/plugins/qrcode/JsBarcode.all.min.js" ></script>
    <script src="assets/plugins/qrcode/qrcode.min.js" ></script>
	<script src="assets/plugins/qrcode/qrcodelib.js"></script>
    <script src="assets/plugins/qrcode/webcodecamjquery.js"></script>
	


<script>
	var arrayComplete = [];
		 $(document).ready(function(){

			$('#lista_colaboradores').select2();
			get_funcionario_filter();

			function get_funcionario_filter(){
				
		
				$('#lista_colaboradores').select2({
				ajax: {
				url: 'includes/funcionario/get_lista_funcionarios',
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
						markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="single_lnk btn btn-primary btn-sm" href="#cadastro-treinamento" >Cadastrar Treinamento</a>';
						return;
					} else {
						var markupfun = '<span>'+ data.name+' </span>';
					}
					
					return markupfun;
				}
				function filfunselec(data) {
					var markupfun = "";
					if(data.loading){
						markupfun = "Procurando";
					}
					else if (data.id == undefined) {
						markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="#cadastro-funcionario" >Cadastrar Funcionario</a>';
						return;
					} else {
						var markupfun = '<span>'+data.name +'</span>';
					}
					
					return markupfun;
				}
			}

			$('.list-encomendas-right').slimscroll({
				position: "left",
				size: "5px",
				height: "512px",
				color: "#c6c8c9"
			});

			var elem1 = Array.prototype.slice.call($('.js-switch-vei'));
			elem1.forEach(html => {
				new Switchery(html, {
				color: '#e91e64', 
				disabled: false,
				disabledOpacity   : 0.5,
				secondaryColor: '#EEE'
				});
			});

			 $("#ferramentas").select2({
			  ajax: { 
			  url: 'includes/ferramenta/get_lista_ferramentas',
			   type: "GET",
			   dataType: 'json',
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
                        o.name = v.descricao;
                        o.value = v.id;
						o.image = v.foto_ativo;
						o.nome = v.descricao;
						o.patrimonio = v.patrimonio;
						o.local = v.local;
						o.calibracao = v.calibracao;
						o.data_validade = v.data_validade;
						o.status = v.status;
						
                        results.push(o);
                    })

                    return {
                        results: results
                    };
                },
			   cache: true
			  },
			  escapeMarkup: function (markup) { return markup;},
				minimumInputLength: 0,
				templateResult: function (response) {
				
					var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+response.image+'" class="flag" /> ' + response.name + '</span>';

					return markup;
				},
				templateSelection: function (response) {
					var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+response.image+'" class="flag" /> ' + response.name + '</span>';
					 return markup

				}
			 
			 });
		});

		function myFunction() {
			var input = document.getElementById("search_encomendas");
			var filter = input.value.toLowerCase();
			var nodes = document.getElementsByClassName('main_box_list_single');

			for (i = 0; i < nodes.length; i++) {

				if (nodes[i].innerText.toLowerCase().includes(filter)) {
				nodes[i].style.display = "block";
				} else {
				nodes[i].style.display = "none";
				}
			}
		}

		function save_action_tooling() {

			var id_colaborador = $("#lista_colaboradores").val();
			var numero_os = $("#numero_os").val();
			var destino = $("#destino").val();
			var observacao = $("#observacao").val();
			var acao = $("#acao").val();
		
			$.ajax({
				url: "includes/ferramenta/cadastra_ferramenta_acao", 
				type : 'POST', 
				dataType: 'JSON',
				data: {
					id_colaborador : id_colaborador, 
					numero_os : numero_os, 
					destino : destino,
					observacao : observacao,
					acao : acao,
					ferramentas : arrayComplete
					
				},
					success: function(response){
						var lista_barcos = "";
						var status = response.status; 
						var status_txt = response.status_txt;
						var last_id = response.last_id;

						if(status == 'SUCCESS') {
							setTimeout(function(){
								$(".loading").hide(); 
								$(".alert-danger").hide(); 
								$(".alert-success").show(); 
								$(".success_txt").html(status_txt); 
							
								toastr.success(status_txt, 'Sucesso!');
							}, 100); 
						} else {
							$(".loading").hide(); 
							$(".alert-success").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-danger").fadeIn(); 
							$(".error_txt").html(status_txt); 

							toastr.error(status_txt, 'Erro!');
						} 
					},
					error:function(response){
						toastr.error(status_txt, '!Error');
					} 
				});
		}

		function toggleSwitch(switch_elem, on) {
					if (on){ // turn it on
						if ($(switch_elem)[0].checked){ // it already is so do 
							// nothing
						}else{
							$(switch_elem).trigger('click').attr("checked", "checked"); // it was off, turn it on
						}
					}else{ // turn it off
						if ($(switch_elem)[0].checked){ // it's already on so 
							$(switch_elem).trigger('click').removeAttr("checked"); // turn it off
						}else{ // otherwise 
							// nothing, already off
						}
					}
				}

		
		$('#ferramentas').on("select2:selecting", function(e) {
			
			//VERIFICAR SE ESTÁ DISPONÍVEL
			var id = e.params.args.data.id;
			var name = e.params.args.data.name;
			var image = e.params.args.data.image;
			var patrimonio = e.params.args.data.patrimonio;
			var local = e.params.args.data.local;
			var value = e.params.args.data.value;
			var calibracao = e.params.args.data.calibracao;
			var data_validade = e.params.args.data.data_validade;
			var box_visitante = "";
			var status = e.params.args.data.status;

			var tool = {
				"id": id,
				"name": name,
				"status": status,
			};

			arrayComplete.push(tool);

			box_visitante += '<div class="card mb-3">'+
									'<div class="card-header" style="padding:1em;">'+
										'<h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree'+value+'" aria-expanded="false" aria-controls="collapseThree'+value+'">'+
											'<i class="fa" aria-hidden="true"></i>'+ 
											'<div class="media">'+
												'<img alt="#" class="mr-3 rounded-circle" src="'+image+'" style="border-radius: 50%;" width="50px">'+
												'<div class="media-body">'+
													'<h5><strong>Ferramenta: </strong>' +name+ '</h5><span class=""><strong>Pn: </strong> '+patrimonio+' </span>';

													if(status == 0 ){
														box_visitante += '<p><span class="badge badge-success d-inline-block badge-sm"> Disponível</span></p>';
													}else{
														box_visitante += '<p><span class="badge badge-danger d-inline-block badge-sm"> Indisponível</span></p>';
													}

												box_visitante += '</div>'+
												'<h4 style="margin-right:10px" class="text-primary"><span class="badge badge-primary d-inline-block badge-sm">' +local+ '</span></h4>'+	
											'</div>'+										
										'</h5>'+
									'</div>'+
									'<div id="collapseThree'+value+'" class="collapse" data-parent="#accordion-three">'+
										'<div class="card-body pt-0">'+
										'<p>Data Calibração: '+calibracao+' </p>'+
										'<p>Data Validade: '+data_validade+ '</p>'+
										// '<div class="modal-footer"><span class="badge badge-danger d-inline-block badge-sm"> Remover</span>'+
										'</div>'+
										'</div>'+
									'</div>'+
								'</div>';			


					
			$('#accordion-three').prepend(box_visitante);

			$('#id_residencia').val(''); 
			$('#IdMorador').val('');
			$('#nome').val('');
			$('#email').val('');
			$('#telefone1').val('');
			
			$('#recebe_email').val('');
			$('#recebe_sms').val('');
			$('#full_name').val('');
			
			if(e.params.args.data.lista_moradores){
				nome_morador = e.params.args.data.lista_moradores[0].nome_morador;
				email_morador = e.params.args.data.lista_moradores[0].email;
				telefone1_morador = e.params.args.data.lista_moradores[0].telefone1;
				recebe_email = e.params.args.data.lista_moradores[0].recebe_email;
				recebe_sms = e.params.args.data.lista_moradores[0].recebe_sms;
				IdMorador = e.params.args.data.lista_moradores[0].IdMorador;

				nome_residencia = e.params.args.data.nome_residencia
				name = e.params.args.data.name


				
				
				$('#id_residencia').val(e.params.args.data.id); 
				$('#IdMorador').val(IdMorador);
				$('#nome').val(nome_morador);
				$('#email').val(email_morador);
				$('#telefone1').val(telefone1_morador);
				
				$('#recebe_email').val(recebe_email);
				$('#recebe_sms').val(recebe_sms);
				$('#full_name').val(name);


				if(recebe_email == 1){
					toggleSwitch("#recebe_email_toogle", true);
					
				} else {
					toggleSwitch("#recebe_email_toogle", false);
				}  
			
				if(recebe_sms == 1){
					toggleSwitch("#recebe_sms_toogle", true);
				} else {
					toggleSwitch("#recebe_sms_toogle", false);
				}
			
				$('.modal-footer').html('<button style="width:100%;" class="btn btn-success" type="submit">Salvar</button>')
			} else {
				
			}
			
			

		});
		
		
			function stop_camera(){
		var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
			$('.box_warn_message_qr').hide(); 
			decoder.stop();
	}

		function play_camera(){
			var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
			decoder.play();
		}
			var arg = {
				resultFunction: function(result) {
					var bar_code = result.code;
					var format_code = result.format;
					setTimeout(function(){
					check_registro_qr(bar_code);
						//check_registro_qr(bar_code)
					}, 500);    

				}
			};

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.options.brightness = 20;
    decoder.options.successTimeout = 1500;
    decoder.options.DecodeQRCodeRate = 10;
    decoder.options.DecodeBarCodeRate = 10;
    decoder.options.codeRepetition = true;
    //decoder.play();
	
	
	//check_registro_qr('00208424');
	
	function check_registro_qr(code){
			$.ajax({
				url:"includes/ferramenta/get_tag_ferramenta",
				method:"GET",
				dataType: 'json',
				data:{
					id:code
				},
				success:function(response){
					var status = response.status;  
					var status_message = response.status_message
					box_registro = "";
						if(status == "SUCCESS") { 

							
							//console.log(response)
							//$('#get-encomenda').modal('show');

							var name = response[0].descricao;
							var image = response[0].foto_ativo;
							var patrimonio = response[0].patrimonio;
							var local = response[0].local;
							var value = response[0].id;
							var calibracao = response[0].calibracao;
							var data_validade = response[0].data_validade;
							var box_visitante = "";
							box_visitante += '<div class="card mb-3">'+
									'<div class="card-header" style="padding:1em;">'+
										'<h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree'+value+'" aria-expanded="false" aria-controls="collapseThree'+value+'">'+
											'<i class="fa" aria-hidden="true"></i>'+ 
											'<div class="media">'+
												'<img alt="#" class="mr-3 rounded-circle" src="'+image+'" style="border-radius: 50%;" width="50px">'+
												'<div class="media-body">'+
													'<h5><strong>Ferramenta: </strong>' +name+ '</h5><span class=""><strong>Pn: </strong> '+patrimonio+' </span>'+
													'<p><span class="badge badge-success d-inline-block badge-sm"> Disponível</span></p>'+
												'</div>'+
												'<h4 style="margin-right:10px" class="text-primary"><span class="badge badge-primary d-inline-block badge-sm">' +local+ '</span></h4>'+	
											'</div>'+										
										'</h5>'+
									'</div>'+
									'<div id="collapseThree'+value+'" class="collapse" data-parent="#accordion-three">'+
										'<div class="card-body pt-0">'+
										'<p>Data Calibração: '+calibracao+' </p>'+
										'<p>Data Validade: '+data_validade+ '</p>'+
										// '<div class="modal-footer"><span class="badge badge-danger d-inline-block badge-sm"> Remover</span>'+
										'</div>'+
										'</div>'+
									'</div>'+
								'</div>';			


					
						$('#accordion-three').prepend(box_visitante);

							
							
							
							$("#IdPost").val(IdPost);
							$("#IdResidencia").val(IdResidencia);
							$("#card_registro_encomenda").html(box_registro);	
							$("#qr_ref").html(code);
							

							//$(".box_warn_message_qr").hide(300);  
							//$(".box_success_message_qr").fadeIn();
							//$(".box_success_message_qr").fadeOut();
							//$(".box_success_message_qr").fadeIn(300);
							//$(".box_success_message_qr").html('<h3>'+status_message+'</h3>');

							setTimeout(function(){
								//$("#card_registro_colaborador").html('');
								//$(".box_success_message_qr").hide(300);
								//$(".box_warn_message_qr").hide(300);
								//$('#codigo_qr').val('');
							}, 5000); 
						
							
							
					} else {

						$(".box_success_message_qr").hide();
						$(".box_warn_message_qr").fadeIn();
						$(".box_warn_message_qr").fadeOut();
						$(".box_warn_message_qr").fadeIn(300);
						$(".box_warn_message_qr").html('<h3 style="color:#fff;">'+status_message+'</h3>');

					}
			
				}
			});
		}


	function send_saida_encomenda(){
	
		
		
	
	var IdPost = $("#IdPost").val();;
	var IdResidencia = $("#IdResidencia").val();		
	var retirado_por = $("#responsavel").val();
	

	information = '<div class="user-info">'+
	'<div class="image"><img  style="width:120px;border-radius:50%;" class="user_pic" src="images/nouser2.jpg" alt="Arquivo"></div>'+
	'<div class="detail">'+
			'<br><h5>Você tem  certeza que deseja registrar a Retirada ?</h5>'+
	'</div>'+
	'</div>';

		swal({
		html: information,
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, Registrar!',
		cancelButtonText: 'Cancelar',
		showLoaderOnConfirm: false,
		animation: "slide-from-top",
		inputPlaceholder: "Nome do Morador",
		input: 'text',
		inputAttributes: {
			autocapitalize: 'off'
		},

		preConfirm: function(inputValue) {
			if (inputValue === "") {
					swal.showValidationError(
					'Por favor digite o nome do Responsável'
				)
				return false 
			} else {
				swal.resetValidationError();
			}

				$('#loading_send').html('<img src="assets/images/loading.gif" />');
				$.ajax({
				url:  "includes/controller/correspondencias/enviar_saida",
				dataType:"json",
				type: 'POST',
				data: {
					IdPost :IdPost,
					IdResidencia:IdResidencia,
					retirado_por: inputValue
				}
				})
				.done(function(response){
				var json = response;
				status = json.status;
				status_txt = json.status_txt;
				swal.close();
				if(status == 'ERROR'){
					toastr.error(status_txt, 'Error');
					$('#loading_send').html('');
				} else {
					$('#status_visita_'+IdPost).html('<span class="badge badge-sucess d-inline-block badge-sm"> Saída Registrada </span>');
					toastr.success(status_txt, 'Sucesso'); 
					$('#loading_send').html('');
					$('#get-encomenda').modal('toggle');
					

					$('#box_post_'+IdPost).remove();

				}
				
			

				})
				.fail(function(){
					swal.resetValidationError();
					//swal('Oops...', 'Ops aconteceu algo de errado !', 'error');

				});
			
				},
			 allowOutsideClick: false			  
		});	

}
	 
</script>
