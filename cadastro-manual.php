<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		//exit(0);
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
                    <h4 class="card-title">Cadastro de Manual</h4>
                    <div class="basic-form">
                        <form id="form-cliente" action="javascript:CadastroManual();" method="post" style="width:100%;">
                            
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
function CadastroManual(){
    

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
			url: "includes/manuais/cadastra-manual", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
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
					last_id = response.last_id;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							window.location.href = "#manual/" + last_id;
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
