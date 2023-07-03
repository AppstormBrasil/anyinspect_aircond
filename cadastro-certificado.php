<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>		
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
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
                    <h4 class="card-title">Cadastro de Designação</h4>
                    <div class="basic-form">
                        <form id="form-cliente" action="javascript:CadastroCertificado();" method="post" style="width:100%;">
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Descrição Designação <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="descricao" id="descricao" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div id="conteudo" class="summernote"></div>
                                    <br>
                                    <button style="width:100%;" type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                           
                            
                            <br>

                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<script src="assets/plugins/summernote/js/summernote.min.js"></script>
<script>
$('.data').mask('99/99/9999');

jQuery(document).ready(function() {
  $(".summernote").summernote({
      height: 350,
      minHeight: null,
      maxHeight: null,
      focus: !1
  }), $(".inline-editor").summernote({
      airMode: !0
  })
}), window.edit = function() {
  $(".click2edit").summernote()
}, window.save = function() {

  $("#conteudo").val($('#conteudo').code());

  $(".click2edit").summernote("destroy")
};


/*$('#titulo').on('keyup', function() {
    if (this.value.length > -1) {
    $('#titulo_left').html(this.value);
 }});*/

function CadastroCertificado(){
    

		var descricao = $("#descricao").val();
        var conteudo = $('#conteudo').summernote('code');

		$.ajax({
			url: "includes/certificados/cadastro-certificado", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                descricao : descricao, 
                conteudo : conteudo, 
                
			},
				success: function(response){
					var status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							window.location.href = "#editcertificado/" + last_id;
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
</script>
