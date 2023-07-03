<?php include('includes/common/check_permission.php'); ?>
 <?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '403';</script>";
		exit(0);
	}
?> 
	<style>
		.select2-container .select2-selection--single {height:45px!important}
		.select2-container--default .select2-selection--single .select2-selection__rendered {line-height:35px!important}
		.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
		.select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}
	</style>
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
												<input type="hidden" name="id_pacote" value="<?php echo $id ?>">
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
		<div class="col-lg-9">
			<div class="card forms-card">
				<div class="card-body">
					<h4 class="card-title">Cadastro de Pacotes</h4>
					<div class="basic-form">
						<form id="form-cliente" action="javascript:editarServico();" method="post" style="width:100%;">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="text-label">Nome do Pacote:<span style="color:red;">*</span></label>
										<div class="input-group">
											<input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do pacote" required >
										</div>
									</div>
								</div>
									<div class="col-lg-4">
									<div class="form-group">
										<label class="text-label">Valor<span style="color:red;">*</span></label>
										<div class="input-group">
											<input type="text" name="valor" id="valor" class="form-control " placeholder="Preço total do pacote" required >
										</div>
									</div>
								</div>
									<div class="col-lg-4">
									<div class="form-group">
										<label class="text-label">Quantidade</label>
										<div class="input-group">
											<input type="text" name="quantidade_usos" id="quantidade_usos" class="form-control " placeholder="Qtd de usos" required >
										</div>
									</div>
								</div>
									<div class="col-lg-4">
									<div class="form-group">
										<label class="text-label">Validade</label>
										<div class="input-group">
											<input type="text" name="validade" id="validade" class="form-control " placeholder="Tempo máximo em dias" required >
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<button type="button" onclick="editarProduto()" class="btn btn-primary">Atualizar Pacote</button>  
								</div>
								<?php $id = $_GET['id']; ?>
								<input type="hidden" name="id_page" id="id_page" value="<?php echo $id ?>">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card  m-b-0">
				<div class="card-header">
					<h4 class="card-title">Serviços Inclusos no Pacote</h4>
				</div>
				<div class="card-body p-3">
					<div class="col-lg-12">
						<div class="form-group">
							<label class="text-label">Serviços: <span style="color:red;">*</span></label>
							<div class="input-group">
							<select style="width: 100%;height:20px;border: 1px solid #dddfe1; cursor:pointer;" id="servico" ></select>
							</div>
							<br>
							<div class="form-group">
								<button type="button" onclick="salvarProdutoServico()" class="btn btn-primary">Adicionar Serviço</button>  
							</div>
						
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-padded table-responsive-fix-big property-overview-table">
							<thead>
								<tr>
									<th>Nome Serviço</th>
									<th>Valor</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody id="table_servico_pack">
								
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>      
	</div>
</div>

	<script src="js/webcam.min.js"></script>
<script>
$('#tempo_estimado').mask('00:00');
$('#valor').mask('000.000.000.000.000,00', {reverse: true});

$('#servico').select2({
ajax: {
	url: 'includes/servico/get_servico',
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
				o.short_dec = v.short_dec;
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
	markup = 'Nenhum Serviço Cadastrado';
	
} else {
	var markup = '<span>' + data.short_dec +' </span>';
}
return markup;
}

function get_service_single() {
id = $("#id_page").val();
$.ajax({
	url:  "includes/pacotes/get_pacote_single",
	type : 'GET',
	dataType: 'JSON',
	data:{
		id:id
	},
	success: function(response){
		var json = response.data;
		status = response.status;
		if(status  == 'SUCCESS') {

			id = json.id;
			nome = json.nome;
			valor = json.valor;
			data_cadastro = json.data_cadastro;
			quantidade_usos = json.quantidade_usos;
			validade = json.validade;

			setTimeout(function(){
				$('#nome').val(nome);
				$('#valor').val(valor);
				$('#quantidade_usos').val(quantidade_usos);
				$('#validade').val(validade);
				if(json.foto != ""){
				$("#image_client").attr('src', json.foto +'?' + (new Date()).getTime());
			}

			}, 200);
		
		} 
		}
	});
}

get_service_single();

function editarProduto(){
var nome = $("#nome").val();
var valor = $("#valor").val();
var validade = $("#validade").val();
var quantidade_usos = $("#quantidade_usos").val();
var id = $("#id_page").val();
valor = valor.replace(",", ".");
valor = parseFloat(valor).toFixed(2);
if(nome == ""){
	toastr.error(status_txt, 'Preencha o campo Nome!');
	return false;
}
if(valor == ""){
	alert("Preencha o campo Valor!");
	return false;
}
if(quantidade_usos == ""){
	alert("Preencha o campo Quantidade Usos!");
	return false;
}
$.ajax({
	url: "includes/pacotes/update_pacote", 
	type : 'POST', 
	dataType: 'JSON',
	data: {
		id:id,
		nome : nome,
		valor : valor,
		quantidade_usos:quantidade_usos,
		validade : validade
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
var id_pacote = $("#id_page").val();
var servico = $("#servico").val();
if(servico == null){
	toastr.error('Erro!', 'Escolha o Produto');
	return;
}

$.ajax({
	url: "includes/pacotes/cadastra_servico_no_pacote.php", 
	type : 'POST', 
	dataType: 'JSON',
	data: {
		id_pacote : id_pacote,
		servico : servico
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
			console.log(response);
		} 
});
}


function get_itens_pacote(){
var id_pacote = $("#id_page").val();
var nome = $("#nome").val();
	$.ajax({
	url:"includes/pacotes/get_list_servicos",
	method:"POST",
	dataType:'json',
	data:{id_pacote : id_pacote},
		success:function(response){
		if(status == 'SUCCESS'){
			var lista_servico = "";
			var lista_serv = response.data;
				for(var a = 0; a < lista_serv.length; a++){
					id_package = lista_serv[a].id_package;
					id_service = lista_serv[a].id_service;
					short_dec = lista_serv[a].short_dec;
					price = lista_serv[a].price;
					lista_servico += '<tr id="row_servico_'+id_service+'">'+
											'<td id="nome_prod_'+id_package+'"><a class="single_link" href="produto-'+id_package+'"> '+short_dec+'</a></td>'+
											'<td id="nome_pack_'+id_package+'"><a class="single_link" href="price-'+price+'"> '+price+'</a></td>'+
											'<td><button class="btn-xs btn btn-danger" onclick="RemoveServico('+id_package+' , '+id_service+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
									'</tr>';
				}
			$('#table_servico_pack').html(lista_servico);
		} 
		}
	}); 

}
setTimeout(function(){
get_itens_pacote();
}, 500);


function RemoveServico(id_package,id_service){

information = '<div class="user-info">'+
				'<h5>Você deseja realmente remover esse Serviço do pacote?</h5>'+
			'</div></div>';   
console.log(id_package);
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
			url: 'includes/pacotes/delete_servico_pacote.php',
			type: 'POST',
			dataType:"json",
			data: {
			id_package : id_package,
			id_service : id_service
			}
		})
		.done(function(response){
		var json = response;
		status = json.status;
		status_txt = json.status_txt;
		$('#row_servico_'+id_service).remove();
		swal.close(); 
		toastr.success(status_txt, 'Sucesso');  
		
		})
		.fail(function(){
			swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
		});
	});
},
allowOutsideClick: false			  
});

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
url:"includes/pacotes/upload_pic_pacote",
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

if (status == 'SUCCESS') {
	toastr.success('Sucesso!', status_txt); 
	setTimeout(function(){
		$('#status_img').fadeOut();
		$('progress').fadeOut();
		}, 4000);

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
		url:"includes/pacotes/take_pic_pacote.php",
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
		url:"includes/pacotes/take_pic_client.php",
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

</script>
