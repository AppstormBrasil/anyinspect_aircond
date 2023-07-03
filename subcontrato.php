<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	
<style type="text/css">
	#results { padding:20px; border:1px solid; background:#ccc; }
	.table-padded td {padding: 0px 5px!important;font-size:13px;}
	.dataTables_filter{display:none;}
	table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
	table.dataTable thead th, table.dataTable thead td {padding: 10px 15px;background: #f9f9f9;font-size: 12px;font-weight: 500;color: #000;}
	.dt-buttons{margin-bottom: 20px;float: right;}
	#map { width: 100%;height:200px;}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-2">
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
		</div>
		<div class="col-lg-10">
			<div class="card">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs">
								<li class="nav-item"><a id="geral_" href="#geral" data-toggle="tab" class="nav-link active show">Geral</a></li>
								<!--<li class="nav-item"><a href="#auditorias" data-toggle="tab" class="nav-link">Auditorias</a></li>-->
								
							</ul>
							<div class="tab-content" style="margin-top: 40px;">
								<div id="geral" class="tab-pane fade active show">
									<div class="pt-3">
										<h4 class="card-title">Editar Cliente</h4>
											<br>
										<div class="settings-form">
											<!--<h4 class="text-primary">Account Setting</h4>-->
											<form class="form-update-sub" action="javascript:update_sub();" method="post" style="width:100%;">
											<?php $id = $_GET['id']; ?>
											<input type="hidden" id="id_page" value="<?=$id;?>" >
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Nome Responsável</label>
															<div class="input-group">
																<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome Cliente" required >
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Nome Empresa</label>
															<div class="input-group">
																<input type="text" name="nome_empresa" id="nome_empresa" class="form-control" placeholder="Nome Empresa" >
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label class="text-label">Validade Contrato</label>
															<div class="input-group">
																<input type="text" name="validade_contrato" id="validade_contrato" class="validade_contrato form-control" placeholder="Validade Contrato" required >
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Próxima Auditoria</label>
															<div class="input-group">
																<input type="text" name="prox_auditoria" id="prox_auditoria" class="validade_contrato form-control" placeholder="Próxima Auditoria" required >
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Última Auditoria Auditoria</label>
															<div class="input-group">
																<input type="text" name="ult_auditoria" id="ult_auditoria" class="validade_contrato form-control" placeholder="Última Auditoria Auditoria" required >
															</div>
														</div>
													</div>
													

													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">E-mail</label>
															<div class="input-group">
																<input type="email" id="email" name="email" class="form-control" placeholder="E-mail Cliente"  >
															</div>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Whatsapp</label>
															<div class="input-group">
																<input type="text" id="telefone2" name="telefone2" class="phone form-control border-right-0" placeholder="Telefone 2">
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" > <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Telefone</label>
															<div class="input-group">
																<input type="text" name="telefone1" id="telefone1" class="phone form-control border-right-0" placeholder="Telefone 1" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
																</div>
															</div>
														</div>
													</div>
												
												</div>
												
												<div class="row">
													

												<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">CNPJ</label>
															<div class="input-group">
																<input type="text" id="cnpj" name="cnpj" class="cnpj form-control" placeholder="CNPJ" >
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">CPF</label>
															<div class="input-group">
																<input type="text" id="cpf" name="cpf" class="cpf form-control" placeholder="CPF" >
															</div>
														</div>
													</div>
												
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Função</label>
															<div class="input-group">
																<input type="text" id="funcao" name="funcao" class="form-control" placeholder="Função" >
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Certificado</label>
															<div class="input-group">
																<input type="text" id="certificado" name="certificado" class="form-control" placeholder="Certificado" >
															</div>
														</div>
													</div>
													

												</div>
												<hr>
												<div class="row">
													<div class="col-lg-12">
														<h4>Endereço</h2>
													</div>
												</div>
												<div class="row">	
													<div class="col-lg-12">
														<div id="map"  tabindex="0" style="position: relative;"></div>
													</div>
													<div class="col-lg-3">
															<div class="form-group">
																<label class="text-label">Cep</label>
																<input onBlur="pesquisacep(this.value);" type="text" name="cep" id="cep" class="zip form-control" placeholder="Cep">
															</div>
													</div>
													<div class="col-lg-9">
														<div class="form-group">
															<label class="text-label">Endereço</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="endereco" name="endereco"  placeholder="Endereço" >
															</div>
														</div>
													</div>
												</div>
												<div class="row">	
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Numero</label>
															<input type="text" id="numero" name="numero" class="form-control" placeholder="Número">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Complemento</label>
															<input type="text" id="complemento" name="complemento" class="form-control" placeholder="Complemento" >
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label class="text-label">Bairro</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="bairro" name="bairro"  placeholder="Bairro" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" >  </span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Cidade</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="cidade" name="cidade"  placeholder="Cidade" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" >  </span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Estado</label>
															<div class="input-group">
																<input type="text" class="form-control border-right-0" id="estado" name="estado"  placeholder="Estado" >
																<div class="input-group-append">
																	<span class="input-group-text bg-transparent" >  </span>
																</div>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Latitude: </label>
															<div class="input-group">
																<input type="text" name="lat" id="lat" class="form-control" placeholder=""  >
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="text-label">Longitude: </label>
															<div class="input-group">
																<input type="text" name="lon" id="lon" class="form-control" placeholder=""  >
															</div>
														</div>
													</div>
												</div>
												
												<hr>
												
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label class="text-label">Observação*</label>
															<textarea type="text" id="obs" name="obs" class="form-control" ></textarea>
														</div>
													</div>
												</div>
												<input type="hidden" id="lat" name="lat" class="form-control" />
												<input type="hidden" id="lon" name="lon" class="form-control" />
												<button style="width: 100%;height: 45px;" id="update_sub" class="btn btn-primary" type="submit">Salvar</button>
											</form>
										</div>
									</div>
								</div>

								<!--<div id="auditorias" class="tab-pane fade ">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												<label class="text-label">Próxima Auditoria</label>
												<div class="input-group">
													<input type="text" name="prox_auditoria" id="prox_auditoria" class="validade_contrato form-control" placeholder="Validade Contrato" required >
												</div>
											</div>
										</div>
										<div class="col-lg-5">
											<div class="form-group">
												<label class="text-label">Última Auditoria Auditoria</label>
												<div class="input-group">
													<input type="text" name="prox_auditoria" id="prox_auditoria" class="validade_contrato form-control" placeholder="Validade Contrato" required >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label class="text-label">Salvar</label>
												<div class="input-group">
												<button id="save_auditoria" class="btn btn-success">Salvar</button>
												</div>
											</div>
										</div>
									</div>
									<div class="table-responsive">
										<table id="lista_ativos" class="table table-padded market-capital table-responsive-fix-big" style="width:100%">
											<thead>
												<tr>
													<th>Id</th>
													<th>Próxima Auditoria</th>
													<th>Última Auditoria</th>
													<th>Responsável</th>
													<th>Ação</th>
												</tr>
											</thead>
											<tbody>
												</tbody>
										</table>
									</div>
									
								</div> -->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <script src="js/get_cep.js"></script>
    <script src="js/webcam.min.js"></script>

	<script src="includes/subcontrato/get_info_subcontrato.js"></script>
	<script src="includes/subcontrato/update_sub.js"></script>
	<script src="js/leaf/leaflet.js"></script>
	<script src="js/get_cep.js"></script>
	<script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>
	
<script language="JavaScript">
	
	toastr.options = {"positionClass": "toast-top-full-width"};
	Highcharts.setOptions({
		colors: ["#828282","#83c9d6","#60a9b7","#d0a37d","#464a53","#f8d999","#733f17","#935f37","#ad8a60","#cf965f","#bc6337","#d59f7b","#f2c280","#edc192","#f9d4a0","#fee3c6"]
	});

	$('.cnpj').mask('99.999.999/9999-99');

	jQuery('.validade_contrato').datetimepicker({
		timepicker: false,
		datepicker:true,
		format:'d/m/Y',
		inline:false,
		autoclose: true,
		todayButton:true,
		lang:'pt',
		step: 30,
		scrollInput: false,
		//minDate:0,
		//defaultTime:'07:00',
	});


	

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
	  url:"includes/subcontrato/upload_pic_sub",
	  data: data,
	  dataType:'JSON',
	  async: true,
	  cache: false,
	  processData: false,
	  contentType: false,
	  success: function(data) {
		var image_path;
		status = data.status;
		status_message = data.status_message;
		id_pic = data.id_pic;

		if (status == 'SUCCESS') {
			setTimeout(function(){
				$('#status_img').fadeOut();
				$('progress').fadeOut();
				toastr.success('Imagem atualizado com sucesso', 'Sucesso');
			 }, 200);
		
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
				url:"includes/view/pet/take_pic_client.php",
				dataType:'JSON',
				data: {base64:image,id:id},
				type:"POST",
				error:function(err){
					console.error(err);
				},
				success:function(data){
					console.log(data);
				},
				complete:function(){
					console.log("Request finished.");
				}
			});
			
			});
			
		})
	
		function take_snapshot() {
			var data_uri;
			Webcam.snap( function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
				image = data_uri;
				id = $("#id_clientt").val();

				$.ajax({
				url:"includes/view/pet/take_pic_client.php",
				dataType:'JSON',
				data: {base64:image,id:id},// Add as Data the Previously create formData
				type:"POST",
				error:function(err){
					console.error(err);
				},
				success:function(data){
					console.log(data);
				},
				complete:function(){
					console.log("Request finished.");
				}
			});
			});	
    	}
	
	}


function latclose(conteudo){

      logradouro = $('#endereco').val();
      bairro = $('#bairro').val();
      localidade =  $('#cidade').val();
      uf = $('#estado').val();
      num = conteudo;

      ad_final = logradouro+','+num+','+bairro+','+localidade+','+uf;
      ad_final = removeAcento(ad_final);

     
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://locationiq.org/v1/search.php?key=5073c64ffbe054&q="+ad_final+"&format=json",
        "method": "GET"
      }

      $.ajax(settings).done(function (response) {

        if(response.error){
          console.log(response);
        } else {
          var lat = response[0].lat
          var lon = response[0].lon
          $('#lat').val(lat);
          $('#lon').val(lon);

          lat = parseFloat(lat);
          lon = parseFloat(lon);
          plot_map(lat,lon,ad_final);

        }
          
      });
}

var map;
function plot_map(lat,lon,ad_final){
    
    var desc_box = '<div style="text-align:center;"><h4>Endereço</h4><p>'+ad_final+'</p></div>';

    if(map == undefined){
        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var streets   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
         grayscale  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

        map = L.map('map', {
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

        L.control.layers(baseLayers, overlays).addTo(map);
    
    
    } else {
        map.off();
        map.remove();

        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});


        map = L.map('map', {
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
    
        L.control.layers(baseLayers, overlays).addTo(map);
    
    }  
}
</script>
