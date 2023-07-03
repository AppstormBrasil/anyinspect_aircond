
<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>
<style>
.select2-container .select2-selection--single {height:50px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height:50px!important}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 2px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}
.container-fluid {width: 90%;}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card forms-card">
                <div class="card-body">
                    <h4 class="card-title">Perfil da Empresa</h4>
                    <div class="basic-form">
                        <form id="form-cliente" action="javascript:update_empresa();" method="post" style="width:100%;">
                            <div class="profile-interest profile-blog pt-3 border-bottom-1 pb-1 profile-interest">
                                <div class="row">
                                    <div class="col-12">
                                            <a style="cursor:pointer;" id="carregar_imagem" class="interest-cats">
                                                <img style="width:250px;" id="image_client"  src="images/noimage.jpg" alt="" class="img-fluid">
                                            </a>
                                            <input type="file" style="display:none;" id="ufile" name="ufile">
                                            <?php $id = 1; ?>
                                            <input type="hidden" id="id_clientt" name="id_clientt" value="<?php echo $id ?>" />
                                            
                                        <span id="status_img"></span>
                                        <div class="progress bg-success progress-animated" style="width:0%;height:2px;" role="progressbar"> 
                                            <span class="sr-only"></span> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="text-label">Nome Empresa<span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="nome_empresa" id="nome_empresa" class="form-control" placeholder="Nome Empresa"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">CNPJ</label>
                                        <div class="input-group">
                                            <input type="text" id="cnpj" name="cnpj" class="cnpj form-control" placeholder="CNPJ">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">E-mail</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail Cliente" >
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">Telefone</label>
                                        <div class="input-group">
                                            <input type="text" name="phone" id="phone" class="phone form-control border-right-0" placeholder="Telefone" >
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">Whatsapp</label>
                                        <div class="input-group">
                                            <input type="text" id="whatsapp" name="whatsapp" class="phone form-control border-right-0" placeholder="Whatsapp">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" > <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
                                            </div>
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
                                <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-label">Cep</label>
                                            <input onBlur="pesquisacep(this.value);" type="text" name="cep" id="cep" class="zip form-control" placeholder="Cep">
                                        </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label class="text-label">Endereço </label>
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
                                        <label class="text-label">Bairro </label>
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
                                        <label class="text-label">Cidade </label>
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
                                        <label class="text-label">Estado </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control border-right-0" id="estado" name="estado"  placeholder="Estado" >
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" >  </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Info Extra</h2>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Website </label>
                                            <div class="input-group">
                                                <input type="text" id="website" name="website" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Facebook </label>
                                            <div class="input-group">
                                                <input type="text" id="facebook" name="facebook" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Instagram </label>
                                            <div class="input-group">
                                                <input type="text" id="instagram" name="instagram" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Informações Adicionais</label>
                                        <textarea type="text" id="info_extra" name="info_extra" class="form-control" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="row">
                                <button style="width:100%;" type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>

<script src="js/get_cep.js"></script>

<script>
$("#car_plate").mask('SSS-9999');
$('.cpf').mask('000.000.000-00');
$('.cnpj').mask('99.999.999/9999-99');
$('.data').mask('99/99/9999');
$('.rg').mask('99.999.999-9');
$(".zip").mask('99999-999');
$(".time").mask('00:00');
$('.phone').mask('(00) 00000-0009');
$('.rg').mask('99.999.999-9');


    
function gt_empresa(){
	
    $.ajax({
         url: "includes/empresa/get_empresa", 
         dataType : 'JSON', 
            success: function(response){
            var json = response.data; 
            status = response.status; 
            
            console.log(json)
            if(status == 'SUCCESS') {
                bairro = json.bairro;
                cep = json.cep;
                cidade = json.cidade;
                cnpj = json.cnpj;
                email = json.email;
                endereco = json.endereco;
                estado = json.estado;
                facebook = json.facebook;
                foto = json.foto;
                id = json.id;
                info_extra = json.info_extra;
                instagram = json.instagram;
                nome_empresa = json.nome_empresa;
                number = json.number;
                phone = json.phone;
                type_companie = json.type_companie;
                website = json.website;
                whatsapp = json.whatsapp;
            
                $('#bairro').val(bairro);
                $('#cep').val(cep);
                $('#cidade').val(cidade);
                $('#cnpj').val(cnpj);
                $('#email').val(email);
                $('#endereco').val(endereco);
                $('#estado').val(estado);
                $('#facebook').val(facebook);
                //$('#foto').val(foto);
                $('#id').val(id);
                $('#info_extra').val(info_extra);
                $('#instagram').val(instagram);
                $('#nome_empresa').val(nome_empresa);
                $('#numero').val(number);
                $('#phone').val(phone);
                $('#type_companie').val(type_companie);
                $('#website').val(website);
                $('#whatsapp').val(whatsapp);

                if(foto != ""){
					$("#image_client").attr('src', foto +'?' + (new Date()).getTime());
				}


               
            } else { 
                $(".loading").hide(); 
                $(".alert-success").hide(); 
                $(".alert-danger").hide(); 
                $(".alert-danger").fadeIn(); 
            } 
        } 
    });
    
}    

gt_empresa()


function update_empresa(){
	
	var id_cliente = $("#id_page").val();
		
	bairro = $('#bairro').val();
    cep = $('#cep').val();
    cidade = $('#cidade').val();
    cnpj = $('#cnpj').val();
    email = $('#email').val();
    endereco = $('#endereco').val();
    estado = $('#estado').val();
    facebook = $('#facebook').val();
    id = $('#id').val();
    info_extra = $('#info_extra').val();
    instagram = $('#instagram').val();
    nome_empresa = $('#nome_empresa').val();
    number = $('#numero').val();
    phone = $('#phone').val();
    type_companie = $('#type_companie').val();
    website = $('#website').val();
    whatsapp = $('#whatsapp').val();
	
    $.ajax({
         url: "includes/empresa/update_empresa", 
         type : 'POST', 
         dataType:'JSON',
        data: {
            bairro:bairro,
            cep:cep,
            cidade:cidade,
            cnpj:cnpj,
            email:email,
            endereco:endereco,
            estado:estado,
            facebook:facebook,
            id:id,
            info_extra:info_extra,
            instagram:instagram,
            nome_empresa:nome_empresa,
            number:number,
            phone:phone,
            type_companie:type_companie,
            website:website,
            whatsapp:whatsapp
			},
                success: function(response){
                var json = response; 
                status = json.status; 
                status_txt = json.status_txt;

                if(status == 'SUCCESS') {
                    setTimeout(function(){
                        toastr.success(status_txt, 'Sucesso');
                    }, 100); 
                } else { 
                    $(".loading").hide(); 
                    $(".alert-success").hide(); 
                    $(".alert-danger").hide(); 
                    $(".alert-danger").fadeIn(); 
                    $(".error_txt").html(status_txt); 
                } 
            } 
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
		var id = 1;
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
	  url:"includes/empresa/upload_pic_empresa.php",
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
			 }, 4000);
		
		}
	  }
	});
	});
</script>
