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
<?php $id = $_GET['id']; ?>
<input type="hidden" id="id_manual" name="id_manual" value="<?php echo $id ?>" />
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card forms-card">
                <div class="card-body">
                    <h4 class="card-title">Editar Manual</h4>
                    <div class="basic-form">
                        <form id="form-cliente" action="javascript:UpdateManual();" method="post" style="width:100%;">
                            <div class="row">
                                <div class="col-3">
                                        <a style="cursor:pointer;" id="carregar_imagem" >
                                            <img style="width:120px;" id="image_client"  src="images/profile.jpg" alt="" class="img-fluid">
                                        </a>
                                        <h6>Cick para importar o PDF</h6>
                                        <input type="file" style="display:none;" id="ufile" name="ufile">
                                        <?php $id = $_GET['id']; ?>
                                        <input type="hidden" id="id_clientt" name="id_clientt" value="<?php echo $id ?>" />
                                        
                                    <span id="status_img"></span>
                                    <div class="progress-bar progress-img-residencia bg-success wow animated progress-animated" style="width:0%;height:2px;" role="progressbar"> 
                                        <span class="sr-only"></span> 
                                    </div>
                                </div>
                                <div id="box_download" class="col-9">
                                       
                            </div>
                            </div>
                           <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Pub <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="pub" id="pub" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Rev </label>
                                        <div class="input-group">
                                            <input type="text" name="rev" id="rev" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Data Eff</label>
                                        <input type="text" name="data_eff" id="data_eff" class="data form-control" placeholder="" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Descrição</label>
                                        <div class="input-group">
                                            <input type="text" name="descricao" id="descricao" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Tipo </label>
                                        <div class="input-group">
                                            <input type="text" name="tipo" id="tipo" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Ref.Fabricante </label>
                                        <div class="input-group">
                                             <input type="text" name="ref_fabricante" id="ref_fabricante" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Empresa </label>
                                        <div class="input-group">
                                            <input type="text" name="empresa" id="empresa" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Link </label>
                                        <div class="input-group">
                                            <input type="text" name="link" id="link" class="form-control" placeholder="" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Observação</label>
                                        <textarea type="text" id="obs" name="obs" class="form-control" ></textarea>
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

<script>
$('.data').mask('99/99/9999');

get_manual();
function get_manual() {
		id = $("#id_manual").val();
		$.ajax({
			url:  "includes/manuais/get_manual",
			type : 'GET',
			dataType: 'JSON',
			data:{
				id:id
			},
			success: function(response){
				var json = response.data;
				status = response.status;
				if(status  == 'SUCCESS') {

					var data_eff = json.data_eff;
                    var descricao = json.descricao;
                    var empresa = json.empresa;
                    var pub = json.pub;
                    var ref_fabricante = json.ref_fabricante;
                    var rev = json.rev;
                    var tipo = json.tipo;
                    var link = json.link;
                    var obs = json.obs;
                    var link_file = json.link_file;

					setTimeout(function(){
                        $("#data_eff").val(data_eff);
                        $("#descricao").val(descricao);
                        $("#empresa").val(empresa);
                        $("#pub").val(pub);
                        $("#ref_fabricante").val(ref_fabricante);
                        $("#rev").val(rev);
                        $("#tipo").val(tipo);
                        $("#link").val(link);
                        $("#obs").val(obs);
                        if(link_file != ''){
                            $('#box_download').html('<img style="width:40px;" id="image_client"  src="images/pdf_img.png" alt="" class="img-fluid"> <a target="_blank" href="'+link_file+'">Click para download</a>')
                        }
                        

					}, 200);
				
				} 
			}
        });
	}
function UpdateManual(){
        id = $("#id_manual").val();
		var data_eff = $("#data_eff").val();
		var descricao = $("#descricao").val();
		var empresa = $("#empresa").val();
		var pub = $("#pub").val();
		var ref_fabricante = $("#ref_fabricante").val();
		var rev = $("#rev").val();
		var tipo = $("#tipo").val();
		var link = $("#link").val();
		var obs = $("#obs").val();
		
		$.ajax({
			url: "includes/manuais/update-manual", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                id : id, 
                data_eff : data_eff, 
                descricao : descricao, 
                empresa : empresa,
				pub : pub,
                ref_fabricante : ref_fabricante, 
                rev : rev, 
                tipo : tipo, 
                link : link,
                obs : obs 
                
			},
				success: function(response){
					var status = response.status; 
					status_txt = response.status_txt;
										
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							toastr.success('Sucesso!', status_txt);
						}, 300); 
					} else {
						$(".loading").hide(); 
						toastr.error('Error!', status_txt);
					} 
				},
				error:function(response){
					alert("Erro!");
					console.log(response);
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
			//$("#image_client").attr("src", e.target.result);
		} 
		reader.readAsDataURL(this.files[0]);

		var data = new FormData();
		$.each(file, function(key, value)
		{
		var id = $('#id_manual').val();
		data.append('name', value);
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
	  url:"includes/manuais/upload_manual",
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


</script>
