<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '403';</script>";
		exit(0);
	}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Serviço</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
	<link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
	<link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="includes/servico/form_builder/style.css" rel="stylesheet" />
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
	<style>
		.select2-container .select2-selection--single {height:50px!important}
		.select2-container--default .select2-selection--single .select2-selection__rendered {line-height:50px!important}
		.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top:-4px!important}
		.select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}

		#add-field li{
			border: 1px dashed gray;
    		margin-bottom: 10px;
			cursor: pointer;
		}

		#add-field li:hover{
			border: 1px dashed #1ea59a;
		}

		#bar-fixed.stickIt {
			position: fixed;
    		top: 5px;
    		width: 23%;
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
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
		<?php include('includes/common/header.php'); ?>
        <!--**********************************
            Header end
        ***********************************-->
        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('includes/common/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
								<div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a id="pic_btn" href="#foto" data-toggle="tab" class="nav-link active show">Foto</a></li>
                                            <li class="nav-item"><a id="web_btn" href="#webcam" data-toggle="tab" class="nav-link">Webcam</a></li>
	                                    </ul>
                                        <div class="tab-content" style="margin-top: 40px;">
											<div id="foto" class="tab-pane fade active show">
												<div class="profile-interest profile-blog pt-3 border-bottom-1 pb-1 profile-interest">
													<div class="row">
														<div class="col-12">
																<a style="cursor:pointer;" id="carregar_imagem" class="interest-cats">
																	<img style="width:100%;" id="image_client"  src="images/noimage.jpg" alt="" class="img-fluid">
																</a>
																<input type="file" style="display:none;" id="ufile" name="ufile">
																<?php $id = $_GET['id']; ?>
																<input type="hidden" id="id_clientt" name="id_clientt" value="<?php echo $id ?>" />
																<input type="hidden" id="id_form" value="<?=$id;?>" >			
																
															<span id="status_img"></span>
															<div class="progress-bar progress-img-residencia bg-success wow animated progress-animated" style="width:0%;height:2px;" role="progressbar"> 
																<span class="sr-only"></span> 
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="webcam" class="tab-pane fade">
												<form method="POST" action="./includes/controller/pet/salvaImagemCliente">
													<div class="row">
														<div class="col-md-12" style="">
															<div id="my_camera"></div>
														</div>
														<div class="col-md-12 text-center" style=" padding-top:20px;">
															<input type="hidden" name="image" class="image-tag">
															<?php $id = $_GET['id']; ?>
															<input type="hidden" name="id_cli" value="<?php echo $id ?>">
															<button class="btn btn-primary" type="button" id="take_snapshot">Tirar Foto</button>
															<button style="display:none;" id="enviar_foto" class="btn btn-success">Enviar Foto</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div>
					
					
					
						<div class="body" >
						<div class="card" id="bar-fixed">
							<div class="add-wrap list-type5 "  style="padding:30px;width:100%;">
								<h4><b>Adicionar Campo</b></h4>	<br>
								<ul class="kt-nav ui-sortable" role="tablist">
									<li class="kt-nav__item">
										<a id="add-text" data-type="text" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-format-text"></i><span class="kt-nav__link-text">Texto</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a data-type="textarea" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-format-size"></i> <span class="kt-nav__link-text">Texto Múltiplo</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a data-type="select" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-arrow-down-drop-circle-outline"></i> <span class="kt-nav__link-text">Lista de Seleção(Seleção Múltipla)</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a data-type="radio" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-checkbox-marked-circle"></i> <span class="kt-nav__link-text">Lista de Seleção(Seleção Única)</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a data-type="checkbox" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-checkbox-marked"></i> <span class="kt-nav__link-text">Lista de Check(Seleção Múltipla)</span>
										</a>
									</li>                                            
									<li class="kt-nav__item">
										<a data-type="section" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-folder-outline"></i> <span class="kt-nav__link-text">Sessão</span>
										</a>
									</li>                                            
									<li class="kt-nav__item">
										<a data-type="signature" href="#" class="kt-nav__link">
											<i style="font-size: 23px;" class="mdi mdi-pen"></i> <span class="kt-nav__link-text">Assinatura</span>
										</a>
									</li>                                            
								</ul>
								<br>
								<h4><b>Informações Complementares</b></h4>
								<br>
								
								<div class="form-group">
									<div class="form-check">
										<input id="qr_check_in" class="form-check-input styled-checkbox" type="checkbox">
										<label for="qr_check_in" class="form-check-label check-green ">QRCode Check-in?</label>
									</div>
								</div>
								
								<div class="form-group">
									<div class="form-check">
										<input id="geo_location" class="form-check-input styled-checkbox" type="checkbox">
										<label for="geo_location" class="form-check-label check-green ">Geo Localização?</label>
									</div>
								</div>
								
								<div class="form-group">
									<div class="form-check">
										<input id="signature" class="form-check-input styled-checkbox" type="checkbox">
										<label for="signature" class="form-check-label check-green ">Assinatura Cliente?</label>
									</div>
								</div>
								
								<div class="form-group">
									<div class="form-check">
										<input id="signature_exec" class="form-check-input styled-checkbox" type="checkbox">
										<label for="signature_exec" class="form-check-label check-green ">Assinatura Executor?</label>
									</div>
								</div>
								
								<div class="form-group">
									<div class="form-check">
										<input id="flow_approve" class="form-check-input styled-checkbox" type="checkbox">
										<label for="flow_approve" class="form-check-label check-green ">Aprovação?</label>
									</div>
								</div>

								<div class="form-group">
									<div class="form-check">
										<input id="image_require" class="form-check-input styled-checkbox" type="checkbox">
										<label for="image_require" class="form-check-label check-green ">Imagem obrigatória?</label>
									</div>
								</div>
								<div class="form-group">
									<div class="form-check">
										<input id="image_single" class="form-check-input styled-checkbox" type="checkbox">
										<label for="image_single" class="form-check-label check-green ">Imagem individual?</label>
									</div>
								</div>

								<div class="col-lg-12">
									
									<button style="width: 100%;" type="button" onclick="editarServico()" class="btn btn-primary">Salvar</button>  
								</div>
								
								
							</div>
							
						</div>
					</div>
					
					
					
					</div>
					<div class="col-lg-9">
                        <div class="card forms-card">
                            <div class="card-body">
								<h4 class="card-title">Editar Atividade</h4>
                                <div class="basic-form">
									<form id="form-cliente" action="javascript:editarServico();" method="post" style="width:100%;">
                                       
										
										<div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
													<label class="text-label">Descrição da Atividade: <span style="color:red;">*</span></label>
													<div class="input-group">
														<input type="text" name="tipo_servico" id="tipo_servico" class="form-control" placeholder="" required >
                                                    </div>
												</div>
											</div>
                                            
											<div class="col-lg-12">
                                                <div class="form-group">
													<label class="text-label">Categoria: <span style="color:red;">*</span></label>
													<div class="input-group">
														<select id="categoria" name="categoria" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
															<option disabled selected value="none">Selecione o tipo</option>
															<option value="Check-List2">Check-List</option>
															<option value="Manutenção Preventiva">Manutenção Preventiva</option>
															<option value="Manutenção Corretiva">Manutenção Corretiva</option>
														</select>
                                                    </div>
												</div>
											</div>
											
											
											 <div class="col-lg-6">
                                                <div class="form-group">
													<label class="text-label">Tempo Estimado (Hora/Minuto) <span style="color:red;">*</span></label>
													<div class="input-group">
														<input type="text" name="tempo_estimado" id="tempo_estimado" class="form-control" placeholder="HH/MM" required >
                                                    </div>
												</div>
											</div>
											<div class="col-lg-6">
                                                <div class="form-group">
													<label class="text-label">Preço Sugerido: <span style="color:red;">*</span></label>
													<div class="input-group">
														<input type="text" name="preco_sugerido" id="preco_sugerido" class="form-control" placeholder="00.00" required >
                                                    </div>
												</div>
											</div>
											<div class="col-lg-12">
												<textarea type="text" id="description" name="description" class="form-control" placeholder="Descrição do Serviço"></textarea>
												<br>
												<button style="width:100%;" type="button" onclick="editarServico()" class="btn btn-primary">Salvar</button>  
											</div>
                                            <?php $id = $_GET['id']; ?>
                                            <input type="hidden" name="id_page" id="id_page" value="<?php echo $id ?>">
										</div>
                                    </form>
                                </div>
                            </div>
						</div>
						
						<div class="card m-b-0" >
							<div card="card-body p-0">


									


								<div class="col-lg-12">

								<div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a id="geral_" href="#form_builder" data-toggle="tab" class="nav-link active show">Editor Formulário</a></li>
                                            <li class="nav-item"><a href="#form_viewer" data-toggle="tab" class="nav-link">Visualizar Formulário</a></li>
                                            <li class="nav-item"><a href="#form_products" data-toggle="tab" class="nav-link">Produtos Utilizados</a></li>
											
											
	                                    </ul>
                                        <div class="tab-content" >
                                            <div id="form_builder" class="tab-pane fade active show">
											
												<div id="sjfb-wrap">
													<div class="row" >                                    
															<form class="col-lg-12 col-md-12" class="form" id="sjfb" role="form" action="javascript:save_form();">
																<div class="col-lg-12 col-md-12" style="margin-top: 30px;">
																	<h3 class="card-title">Check-list</h3>
																</div>
														
																<?php $id = $_GET['id']; ?>
																	<input type="hidden" id="id_form" value="<?=$id;?>" >			
																<div id="form-fields"  style="padding:15px;border:none;"></div>
																<div class="row" >
																	<div class="col-lg-12 col-md-12 text-center" style="margin: 30px 0px 30px 0px;">
																		<button type="submit" class="submit btn btn-primary waves-effect ">Salvar Formulário</button>
																		</div>
																	</div>	
															</form>
														

													</div>
												</div>
											
											
											</div>

											<div id="form_viewer" class="tab-pane fade">
												<div style="margin-top:30px;margin-bottom: 30px;" id="sjfb-wrap-viewer">
													<form class="form" >
														<div id="sjfb-fields-viewer"></div>
													</form>

												</div>
											</div>
											
											<div id="form_products" class="tab-pane fade">
											
											<div class="m-b-5">
												
												<div class="card-body p-0">
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Produtos Utilizados: <span style="color:red;">*</span></label>
															<div class="input-group">
																<select style="width: 100%;height:70px;border: 1px solid #dddfe1; cursor:pointer;" id="produtos" ></select>
															</div>

															<div class="col-lg-12">
														<br>
														<button style="width:100%;" type="button" onclick="salvarProdutoServico()" class="btn btn-primary">Salvar</button>  
													</div>
														</div>
													</div>
													<div class="table-responsive">
														<table class="table table-padded table-responsive-fix-big property-overview-table">
															<thead>
																<tr>
																	<th>Produto</th>
																	<th>Quantidade</th>
																	<th>Tipo</th>
																	<th>Ação</th>
																</tr>
															</thead>
															<tbody id="table_produtos">    
															</tbody>
															
														</table>
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
                </div>
            </div>
        </div> 
		<!-- Modal Novo Cliente -->
		<div id="novo_produto_modal" class="modal fade" style="z-index: 55555;">
			<div class="modal-dialog" style="max-width:660px!important;">
				<div class="modal-content">
					<form class="form novo_evento" id="validate_evento" role="form" action="javascript:cadastraProd();" >
						<div class="modal-header">
						<h4 class="modal-title">Novo Produto</h4>&nbsp; <button type="button" class="close" data-dismiss="modal">×</button>
						</div>
						<div class="modal-body">
							<div class="col-lg-12">
								<div class="form-group">
									<label class="text-label">Nome do Produto</label>
									<div class="input-group">
									<input type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="produto" name="produto" required></input>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="text-label">Valor</label>
									<div class="input-group">
									<input class="money" type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="valor" name="valor" required></input>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="text-label">Tipo</label>
									<div class="input-group">
									<select id="tipo" name="tipo" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
										<option disabled selected value="none"></option>
										<option value="L">L - Litro</option>
										<option value="MG">MG - Miligrama</option>
										<option value="ML">ML - Mililitro</option>
										<option value="KG">KG - Quilograma</option>
										<option value="UN">UN - Unidade</option>
										<option value="PC">PC - Peça</option>
									</select>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="text-label">Quantidade</label>
									<div class="input-group">
									<input class="money" type="text" style="width: 100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="qtd" name="qtd	" required></input>
									</div>
								</div>
							</div>
							<div style="display:none;width: 100%;height: 40px;background: #E91E63;text-align: center;color: white;line-height: 40px;font-size: 15px;" class="error_modal_novo_produto"></div>
						</div>
						<div class="modal-footer">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
							<button type="button" onclick="cadastraProd()" class="btn btn-success">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>	
    </div>

       <?php include('includes/common/footer.php'); ?>
        <?php //include('includes/common/right-sidebar.php'); ?>
        <!--**********************************
            Right sidebar end
        ***********************************-->
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
	<script src="js/webcam.min.js"></script>

	<script src="includes/servico/form_builder/js/jquery-ui.min.js" type="text/javascript" ></script> 
	<script src="includes/servico/form_builder/js/form_builder.js" type="text/javascript" ></script>
	<script src="includes/servico/form_builder/js/update_new_form.js" type="text/javascript" ></script>
	<script src="includes/servico/form_builder/js/upload_img_form.js" type="text/javascript" ></script>

	<script>

	toastr.options = {"positionClass": "toast-top-full-width"};
	$('#tempo_estimado').mask('00:00');
	$('#preco_sugerido').mask('000.000.000.000.000,00', {reverse: true});

	/* it seems javascript..*/
	var topLimit = $('#bar-fixed').offset().top;
	$(window).scroll(function() {
	//console.log(topLimit <= $(window).scrollTop())
	if (topLimit <= $(window).scrollTop()) {
		$('#bar-fixed').addClass('stickIt')
	} else {
		$('#bar-fixed').removeClass('stickIt')
	}
	})
	
	function get_service_single() {
		id = $("#id_page").val();
		$.ajax({
			url:  "includes/servico/get_servico_single",
			type : 'GET',
			dataType: 'JSON',
			data:{
				id:id
			},
			success: function(response){
				var json = response.data;
				status = response.status;
				if(status  == 'SUCCESS') {

					est_time = json.est_time;
					id = json.id;
					price = json.price;
					short_dec = json.short_dec;
					description = json.description;
					foto_servico = json.foto;
					signature = json.signature;
					geo_location = json.geo_location;
					qr_check_in = json.qr_check_in;
					signature_exec = json.signature_exec,
					flow_approve = json.flow_approve
					categoria = json.categoria
					image_require = json.image_require
					image_single = json.image_single


					setTimeout(function(){
						$('#tipo_servico').val(short_dec);
						$('#tempo_estimado').val(est_time);
						$('#preco_sugerido').val(price);
						$('#description').val(description);
						$('#categoria').val(categoria);

						$('#categoria').select2();

						if(signature == 1){
							$("#signature").prop('checked', true);
						} else {
							$("#signature").prop('checked', false);
						}
						
						if(geo_location == 1){
							$("#geo_location").prop('checked', true);
						} else {
							$("#geo_location").prop('checked', false);
						}
						
						if(qr_check_in == 1){
							$("#qr_check_in").prop('checked', true);
						} else {
							$("#qr_check_in").prop('checked', false);
						}
						
						if(signature_exec == 1){
							$("#signature_exec").prop('checked', true);
						} else {
							$("#signature_exec").prop('checked', false);
						}
						
						if(flow_approve == 1){
							$("#flow_approve").prop('checked', true);
						} else {
							$("#flow_approve").prop('checked', false);
						}
						
						if(image_require == 1){
							$("#image_require").prop('checked', true);
						} else {
							$("#image_require").prop('checked', false);
						}
						
						if(image_single == 1){
							$("#image_single").prop('checked', true);
						} else {
							$("#image_single").prop('checked', false);
						}

						

						if(foto != ""){
							$("#image_client").attr('src', foto_servico +'?' + (new Date()).getTime());
						}
					}, 200);
				
				} else {
					window.location.href = '404';
				}
				}
			});
	}

	get_service_single();

	function get_lista_produtos(){
	var id = $("#id_clientt").val();
	$.ajax({
     url:"includes/servico/get_lista_produtos",
	 method:"POST",
	 dataType:'json',
     data:{id:id},
		success:function(response){

		var status = response.status;
		if(status == 'SUCCESS'){
			var lista_prod = "";
			var lista_produtos = response.data;
				for(var a = 0; a < lista_produtos.length; a++){
					desc = lista_produtos[a].desc;
					foto = lista_produtos[a].foto;
					id_product = lista_produtos[a].id_product;
					id_service = lista_produtos[a].id_service;
					qtd = lista_produtos[a].qtd;
					type = lista_produtos[a].type;
					validade = lista_produtos[a].validade;
					value = lista_produtos[a].value;
					id_serv_prod = lista_produtos[a].id_serv_prod;
					qtd_fracionada = lista_produtos[a].qtd_fracionada;
					foto = foto +'?' + (new Date()).getTime();
					if(status == 'Pendente'){
						status_type = 'label-light'
					} else if(status == 'Em Andamento') {
						status_type = 'label-warning'
					} else {
						status_type = 'label-success'
					}
					lista_prod += '<tr id="row_prod_'+id_serv_prod+'">'+
													'<td id="nome_prod_'+id_serv_prod+'"><a href="produto-'+id_serv_prod+'"><img  style="width:35px;height:35px;border-radius:50%;background:#f3f3f3;" class="user_pic" src="'+foto+'" > '+desc+'</a></td>'+
													'<td><input value="'+qtd_fracionada+'" style="height: 35px;min-height: 35px;margin-top: 6px;width: 55%;" type="text" name="qtd_prod" id="qtd_prod_'+id_serv_prod+'" class="form-control" ></td>'+
													'<td> '+type+'</td>'+
													'<td><span class="label label label-rounded '+validade+'"><button onclick="updateprodqtd('+id_serv_prod+')" class="btn btn-success btn-xs" id="'+id_serv_prod+'" type="button"><i class="icon-plus f-s-16"></i></button><button style="margin-left:15px;" class="btn btn-danger btn-xs" onclick="RemoveItemProd('+id_product+',\''+desc+'\',\''+foto+'\',\''+id_serv_prod+'\')" id="1" type="button"><i class="icon-trash f-s-16"></i></button></span></td>'+

											'</tr>';
				}
      		$('#table_produtos').html(lista_prod);
		} 
    }
    }); 

  }

  get_lista_produtos();

	function editarServico(){
		var tipo_servico = $("#tipo_servico").val();
		var tempo_estimado = $("#tempo_estimado").val();
		var preco_sugerido = $("#preco_sugerido").val();
		var categoria = $("#categoria").val();
		var id = $("#id_page").val();
		preco_sugerido = preco_sugerido.replace(",", ".");
		preco_sugerido_final = parseFloat(preco_sugerido).toFixed(2);

		var geo_location , signature , signature_exec , flow_approve , categoria , image_require, image_single;
		
		
		if ($('#geo_location').is(':checked')) {
			geo_location = 1;
		} else {
			geo_location = 0;
		}
		
		if ($('#signature').is(':checked')) {
			signature = 1;
		} else {
			signature = 0;
		}
		
		if ($('#qr_check_in').is(':checked')) {
			qr_check_in = 1;
		} else {
			qr_check_in = 0;
		}
		
		if ($('#signature_exec').is(':checked')) {
			signature_exec = 1;
		} else {
			signature_exec = 0;
		}
		
		if ($('#flow_approve').is(':checked')) {
			flow_approve = 1;
		} else {
			flow_approve = 0;
		}
		
		if ($('#image_require').is(':checked')) {
			image_require = 1;
		} else {
			image_require = 0;
		}
		
		if ($('#image_single').is(':checked')) {
			image_single = 1;
		} else {
			image_single = 0;
		}
		
		if(tipo_servico == ""){
			toastr.error('Digite a descrição da atividade!', 'Ops');
			return false;
		}
		if(tempo_estimado == ""){
			toastr.error('Digite o tempo estimado para a atividade!', 'Ops');
			return false;
		}
		if(preco_sugerido == ""){
			toastr.error('Digite o valor sugerido para a atividade!', 'Ops');
			return false;
		}
		
		if(categoria == "null" || categoria == null){
			toastr.error('Escolha a categoria', 'Ops');
			return false;
		}

		

		$.ajax({
			url: "includes/servico/update_servico", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				id:id,
                tipo_servico : tipo_servico,
				tempo_estimado : tempo_estimado,
				preco_sugerido : preco_sugerido,
				geo_location : geo_location,
				qr_check_in : qr_check_in,
				signature : signature,
				signature_exec : signature_exec,
				flow_approve : flow_approve,
				image_require : image_require,
				image_single : image_single,
				categoria : categoria
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					if(status == 'SUCCESS') {
						setTimeout(function(){
							toastr.success('Sucesso!', status_txt)
						}, 100); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){
					toastr.error('Erro!', 'Erro ao Salvar');
				} 
		});
	}

	function salvarProdutoServico(){
		var produtos = $("#produtos").val();
		var id = $("#id_page").val();
		if(produtos == null){
			toastr.error('Erro!', 'Escolha o Produto');
			return;
		}

		$.ajax({
			url: "includes/servico/update_produto", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				id:id,
                produtos : produtos
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					if(status == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						setTimeout(function(){
							location.reload();
						}, 300); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){

				} 
		});
	}

	function updateprodqtd(id){
		var qtd_prod = $("#qtd_prod_"+id).val();

		$.ajax({
			url: "includes/servico/update_prod_qtd", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				id:id,
                qtd_prod : qtd_prod
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){
							toastr.success('Sucesso!', status_txt)
						}, 100); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){
					console.log(response);
				} 
		});
	}

	function RemoveItemProd(id,nome,imagem,id_serv_prod){
	var id_service = $('#id_clientt').val();
    information = '<div class="user-info">'+
                        '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja remover este Produto ?</h5>'+
                        '</div>'+
                    '</div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/servico/delete_serv_prod',
                   type: 'POST',
                   dataType:"json",
                   data: {
					id_product : id,
					id_service : id_service
                }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                $('#row_prod_'+id_serv_prod).remove();
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Erro ao deletar!', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}  

$('.money').mask('000.000.000.000.000,00', {reverse: true});
            function cadastraProd(){
                var produto = $("#produto").val();
                var valor = $("#valor").val();
                valor = converteMoedaFloat(valor);
                var tipo = $("#tipo").val();
				var qtd = $("#qtd").val();

				if(produto == ''){
					$('.error_modal_novo_produto').show();
					$('.error_modal_novo_produto').html('<span>Digitar o nome do Produto</span>');
					return;
				}
				if(valor == ''){
					$('.error_modal_novo_produto').show();
					$('.error_modal_novo_produto').html('<span>Digitar o Valor</span>');
					return;
				}
				if(tipo == ''){
					$('.error_modal_novo_produto').show();
					$('.error_modal_novo_produto').html('<span>Digitar o Tipo</span>');
					return;
				}
				if(qtd == ''){
					$('.error_modal_novo_produto').show();
					$('.error_modal_novo_produto').html('<span>Digitar a Quantidade</span>');
					return;
				}

				$('.error_modal_novo_produto').hide();
                
                $.ajax({
                    url: "includes/produto/cadastra_produto", 
                    type : 'POST', 
                    dataType:'JSON',
                    data: {
                        produto : produto, 
                        valor : valor, 
                        tipo : tipo,
                        qtd : qtd
                    },
                        success: function(response){
                            status = response.status; 
                            status_txt = response.status_txt;
                            id_cliente = response.id_cliente;
                            
                            if(status == 'SUCCESS') {
                                setTimeout(function(){
                                    $(".loading").hide(); 
										toastr.success('Sucesso!', status_txt);
										$("#novo_produto_modal").modal('hide');
                                    $("#produto").val("");
                                    $("#qtd").val("");
                                    $("#valor").val("");
                                    $("#tipo").val('').trigger('change');
                                }, 100); 
                            } else {
                                $(".loading").hide(); 
                                toastr.error('Error!', "Erro ao cadastrar o Produto se o problema persistir entre em contato com o Administrador");
                            } 
                        },
                        error:function(response){
                            toastr.error('Error!', "Erro ao cadastrar o Produto se o problema persistir entre em contato com o Administrador");
                        } 
                    });
                }
                
            function converteMoedaFloat(valor){
            
            if(valor === ""){
                valor =  0;
            }else{
                valor = valor.replace(".","");
                valor = valor.replace(",",".");
                valor = parseFloat(valor);
            }
            return valor;

            }

	  
	  $('#produtos').select2({
        ajax: {
          url: 'includes/servico/get_products',
          type : 'POST',
		  dataType: 'JSON',
          delay: 250,
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
                        o.foto = v.foto;
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
			markup = 'Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_produto_modal" >Cadastrar Produto</a>';
			
		} else {
			var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.name +' </span>';
		}
		return markup;
	}
	
	$("#carregar_imagem").click(function(){
		$("#ufile").click();
	});
	
	$("#ufile").change(function(){
		var file = event.target.files;
		$("#load_img").show();
		$(".progress").css("width", "0px");
		$("#status_img").html("0%");

		var reader = new FileReader();
		reader.onload = function(e){
			$("#image_client").attr("src", e.target.result);
		}
		reader.readAsDataURL(this.files[0]);

		var data = new FormData();
		$.each(file, function(key, value)
		{
		var id = $('#id_clientt').val();
		data.append('upload_file', value);
		data.append("id", id);
		});

		$.ajax({
	  	xhr: function() {
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  //$("#status_img").html(percentInt + "%");
		  }
		}, false);
		xhr.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  $(".progress").css("width", percentInt+"%");
		  $("#status_img").html(percentInt + "%");


		  }
		}, false);
		return xhr;
	  },
	  type: 'POST',
	  url:"includes/servico/upload_pic_servico",
	  data: data,
	  dataType:'JSON',
	  async: true,
	  cache: false,
	  processData: false,
	  contentType: false,
	  success: function(data) {
		var image_path;
		status = data.status;
		status_txt = data.status_txt;
		id_pic = data.id_pic;

		if(status == 'SUCCESS') {
			setTimeout(function(){
				toastr.success('Sucesso!', status_txt)
				$('#status_img').hide();
			}, 100); 
		} else {
			toastr.error('Erro!', status_txt)
		} 
	  }
	});	
	});
		
	
	$( "#web_btn" ).click(function() {
		turn_on_camera();
	});

	$( "#pic_btn" ).click(function() {
		turn_off_camera();
	});

	function turn_off_camera(){
		Webcam.reset();
	}

	function turn_on_camera(){
		Webcam.on( 'error', function(err) {
		console.log("Sem webcam");
		});

		Webcam.set({
			width: 285,
			height: 285,
			image_format: 'jpeg',
			jpeg_quality: 100
		});
	
		Webcam.attach('#my_camera');

		$('#take_snapshot').click(function(){
			Webcam.snap( function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
				image = data_uri;
				id = $("#id_clientt").val();

				$.ajax({
				
				url:"includes/servico/take_pic_servico",
				data: {base64:image,id:id},// Add as Data the Previously create formData
				type:"POST",
				dataType:'JSON',
				error:function(err){
					console.error(err);
				},
				success:function(data){
					status = data.status;
					status_txt = data.status_txt;
					if(status == 'SUCCESS') {
					setTimeout(function(){
						toastr.success('Sucesso!', status_txt)
						$('#status_img').hide();
					}, 100); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
				complete:function(){
					console.log("Request finished.");
				}
			});
			
			});
			
		})
	
	}


var formID = $('#id_clientt').val();

generateForm(formID,'Em Andamento');

function generateForm(formID,status_det) {
$("#sjfb-fields-viewer").empty();
    $.getJSON('includes/atividade/sjfb-load-form?form_id=' + formID, function(data) {
        
        if (data) {
            var titulo_formulario = data.titulo_formulario;
            var tipo_formulario = data.tipo_formulario;
            var imagem = data.imagem;
            var conteudo_formulario = JSON.parse(data.conteudo_formulario);
            var enable_disable = ""; 
            var i = 0;
            var k = 0;

            
            if(conteudo_formulario == null || conteudo_formulario == 'null' ){
                
            } else {
                //$('#sjfb-fields').append('<p style="padding:5px;margin: 5px;background: #2f4260;" ><span style="color: #fff;font-size: 16px;font-weight: 700;">Check-list </span></p>')
                $.each( conteudo_formulario, function( k, v ) {

                    var fieldType = v['type'];
					
                    //Add the field
                    $('#sjfb-fields-viewer').append(addFieldHTML(fieldType));
                    var $currentField = $('#sjfb-fields-viewer .sjfb-field').last();
                    //Add the label
                    $currentField.find('label').text(v['label']);
                    //Any choices?
                    
					if (v['choices']) {
                        //var uniqueID = Math.floor(Math.random()*999999)+1;
                        var uniqueID = formID;
                        var name_radio = $currentField.find('label').text(v['label']).prevObject[0].id;
                        
                        $.each( v['choices'], function( k, v ) {
                        
                            if (fieldType == 'select') {
                                var selected = v['sel'] ? ' selected' : '';
                                var choiceHTML = '<option' + selected + '>' + v['label'] + '</option>';
                                $currentField.find(".choices").append(choiceHTML);
                            }

                            else if (fieldType == 'radio') {

                                var selected = v['sel'] ? ' checked' : '';
                            
                                var choiceHTML = '<div class="col-sm-6 col-md-4 col-xl">'+
                                    '<div class="form-radio">'+
                                        '<input id="radio-' + i + '" class="radio-outlined" '+enable_disable+' type="radio" name="radio-' + name_radio + '"' + selected + ' value="' + v['label'] + '" >'+
                                        '<label for="radio-' + i + '" class="radio-green">' + v['label'] + '</label>'+
                                    '</div>'+
                                '</div>';
                                
                                $currentField.find(".choices").append(choiceHTML);
                            }

                            else if (fieldType == 'checkbox') {
                                var selected = v['sel'] ? ' checked' : '';

                                var choiceHTML = '<div class="col-12">'+
                                                        '<div class="form-check mb-5 mr-5">'+
                                                            '<input class="form-check-input styled-checkbox" styled-checkbox" '+enable_disable+' id="ch_'+i+'" type="checkbox" name="checkbox-' + uniqueID + '[]"' + selected + ' value="' + v['label'] + '" >'+
                                                            '<label for="ch_'+i+'" class="form-check-label check-green ">' + v['label'] + '</label>'+
                                                        '</div>'+
                                                    '</div>';
                                
                                
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

                    $('.choices-select').select2();

                });

                //$('#sjfb-fields-viewer').append('<div id="box_save_checklist" style="padding:10px;"><button type="submitt" class="btn btn-primary save_check_list button">Salvar Check-List</button></div>');

                
                if(status_det == 'Finalizado' || status_det == 'Concluído'){
                    enable_disable = 'disabled';
                    $("input,textarea,select").prop("disabled",true); 
                    $('#box_save_checklist').hide();

                    $("#phone_cliente").prop("disabled",false); 
                    $("#zap_message").prop("disabled",false); 
                }


                function call_lista_atividades(id_form,id) {
                $.ajax({
                    url:  "includes/atividade/get_atividade_result",
                    type : 'GET',
                    data :{
                        IdFormulario:formID,
                        IdEvento:id
                    },
                    success: function(response){
                    var json = JSON.parse(response);
                    var status = json.status;
                
                        if(status  == 'SUCCESS') {
                            
                            var box_atividades = "";
                            id = json.id;
                            var resp_atividade = json.resp_atividade;
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

            
            //call_lista_atividades(id_form,id_atividade);

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
                            
                           $('#text-4-1').css("border", "1px solid #dddfe1!important");
                           $('#text-4-1').attr('border', "1px solid #dddfe1!important")
                           

                        } else {
                                var targetOffset = $('#'+e.id+'').offset().top - $(window).scrollTop();
                                $('.page-content').animate({ 
                                    scrollTop: targetOffset + 500
                                }, 600);
                                $( '#'+e.id+'' ).focus();
                                $( '#'+e.id+'' ).blur();
                                $( '#'+e.id+'' ).css("border", "1px solid #f44336");
                                toastr.error('Campo Obrigatório', 'Erro!');
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
                   
                    //document.getElementByClass('#'+e.id+'').style.border = "1px solid #dddfe1";
            
                    var data = JSON.stringify(output);
                            //var formID = $('#id_form').val();

                            $.ajax({
                            method: "POST",
                            url: 'includes/atividade/sjfb-save-result',
                            data: {
                                data : data,
                                formID:id_form,
                                at:id_atividade
                            },
                            dataType: 'json',
                            success: function(response) {
                                var status = response.status;
                                var status_message = response.status_txt;
                                toastr.success(status_message, 'Sucesso!');
                                return false;
               
                            }
                        });
            
                });

            }

        
        }

        //HTML templates for rendering frontend form fields
        function addFieldHTML(fieldType) {
            k++;
            var uniqueID = formID;
            var rand = formID;
            switch (fieldType) {

                case 'text':
                    return '' +
                        '<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-text ">' +
                        '<label for="text-' + uniqueID + '" class="block-title" ></label>' +
                        '<input name="text-'+uniqueID+'-'+k+'" class="form-control" type="text" id="text-'+uniqueID +'-'+k+'">' +
                        
                        '<div class="post-input" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a></div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"></div>'+
                            '</div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5>Imagem</h5>'+
                                '<div class="col-2" >'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" >'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.jpg" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+
                            '</div>'+
                        
                        
                        '</div>';
                        

                case 'textarea':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-textarea">' +
                        '<label for="textarea-' + uniqueID + '" class="block-title"></label>' +
                        '<textarea class="form-control form-control-lg" name="textarea-'+ uniqueID +'-'+k+'"  id="textarea-' + uniqueID +'-'+k+'"></textarea>' +
                       
                        
                        '</div>';

                case 'select':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-select">' +
                        '<label for="select-' + uniqueID + '" class="block-title"></label>' +
                        '<select name="select-' + uniqueID +'-'+k+'" id="select-' + uniqueID +'-'+k+'" class="form-control choices choices-select"></select>' +
                        
                        '<div class="post-input" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a></div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"></div>'+
                            '</div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5>Imagem</h5>'+
                                '<div class="col-2" >'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" >'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.jpg" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+
                            '</div>'+
                        
                        
                        
                        
                        '</div>';

                case 'radio':
                    return '' +
                        '<div id="sjfb-' + uniqueID +'-'+k+'" class="list sjfb-field sjfb-radio">' +
                        '<label class="block-title"></label>' +
                        '<li class="choices choices-radio"></li>' +
                        
                        '<div class="post-input" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a></div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"></div>'+
                            '</div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5>Imagem</h5>'+
                                '<div class="col-2" >'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" >'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.jpg" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+
                            '</div>'+
                        
                        
                        '</div>';

                case 'checkbox':
                    return '' +
                        '<div id="sjfb-checkbox-'+uniqueID +'-'+k+ '" class="list sjfb-field sjfb-checkbox">' +
                        '<label class="sjfb-label block-title"></label>' +
                        '<li class="choices choices-checkbox"></li>' +
                        
                        '<div class="post-input" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a></div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"></div>'+
                            '</div>'+
                            
                            '<div style="display:none;margin-top: 10px;background: #f7f7f7;padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5>Imagem</h5>'+
                                '<div class="col-2" >'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" >'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.jpg" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+
                            '</div>'+
                        
                        
                        '</div>';

                case 'section':
                    return '' +
                        '<div id="sjfb-section-' + uniqueID +'" class="sjfb-field sjfb-section required-field" style="background: #1ea59a;color: #fff;">' +
                        '<label class="block-title" style="padding: 5px;"></label>' +
                        '</div>';
                case 'signature':
                    return '' +
                        '<div id="sjfb-signature-' + uniqueID +'" class="sjfb-field sjfb-signature required-field" style="background: #1ea59a;color: #fff;">' +
                        '<label class="block-title" style="padding: 5px;"></label>' +
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

function toogle_element(element){
	$('#'+element+'').toggle(250);
}

	</script>
	
</body>

</html>