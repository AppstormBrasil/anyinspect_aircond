
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	
<style>
.container-fluid{width:90%;}
.select2-container .select2-selection--single {height:50px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height:50px!important}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 2px!important}
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
                    <h4 class="card-title">Cadastro de Funcionários</h4>
                    <div class="basic-form">
                        <form id="form-func" action="javascript:cadastraFunc();" method="post" style="width:100%;">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Nome <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">E-mail <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Senha </label>
                                        <div class="input-group">
                                            <input type="text" id="senha" name="senha" class="form-control" placeholder="Senha para login" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Tipo </label>
                                        <div class="input-group">
                                            <select id="type" name="type" style="width: 100%;height:45px;border: 1px solid #dddfe1;"  required >
                                                <option disabled selected value="none"></option>
                                                <option value="a">Administrador</option>
                                                <option value="f">Funcionário</option>
                                                <option value="g">Gerente</option>
                                                <option value="o">Operador</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Telefone 1 </label>
                                        <div class="input-group">
                                            <input type="text" name="telefone1" id="telefone1" class="phone form-control border-right-0" placeholder="Telefone 1">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Telefone 2</label>
                                        <div class="input-group">
                                            <input type="text" id="telefone2" name="telefone2" class="phone form-control border-right-0" placeholder="Telefone 2">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" > <i class="fa fa-phone" aria-hidden="true"></i> </span>
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
<script src="includes/funcionario/cadastra_funcionario.js"></script>
<script>
$('#sexo').select2();
$('#type').select2();
</script>
