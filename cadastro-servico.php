
<?php 
	include('includes/common/check_permission.php');
    $user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>
<style>
    .select2-container .select2-selection--single {height:45px!important}
    .select2-container--default .select2-selection--single .select2-selection__rendered {line-height:35px!important}
    .select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #ddd!important;
        color: #020202!important;
        height: 42px!important;
        line-height: 34px!important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card forms-card">
                <div class="card-body">
                    <h4 class="card-title">Cadastro de Serviços</h4>
                    <div class="basic-form">
                        <form id="form-cliente" style="width:100%;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">Descrição do Serviço: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="tipo_servico" id="tipo_servico" class="form-control" placeholder="" required >
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">Tempo Estimado (Hora/Minuto) <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="tempo_estimado" id="tempo_estimado" class="form-control" placeholder="HH/MM" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
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
                                    <button type="button" onclick="salvarServico()" class="btn btn-primary">Salvar Serviço</button>  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>

<script src="includes/servico/cadastra_servico.js"></script>
