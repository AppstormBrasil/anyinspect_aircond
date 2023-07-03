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
                    <h4 class="card-title">Cadastro de Clientes</h4>
                    <div class="basic-form">
                        <form id="form-cliente" action="javascript:cadastraCli();" method="post" style="width:100%;">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Nome Empresa <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="nome_empresa" id="nome_empresa" class="form-control" placeholder="Instagram Cliente" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Nome Responsável </label>
                                        <div class="input-group">
                                            <input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome Cliente"  >
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
                                        <label class="text-label">Whatsapp</label>
                                        <div class="input-group">
                                            <input type="text" id="telefone2" name="telefone2" class="phone form-control border-right-0" placeholder="Whatsapp">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" > <i class="fa fa-whatsapp" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">Telefone </label>
                                        <div class="input-group">
                                            <input type="text" name="telefone1" id="telefone1" class="phone form-control border-right-0" placeholder="Telefone 1" >
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
                                <div class="col-lg-12">
                                    <h4>Documentos</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">CNPJ</label>
                                        <input type="text" id="cnpj" name="cnpj" class="cnpj form-control" placeholder="CNPJ">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">CPF</label>
                                        <div class="input-group">
                                            <input type="text" id="cpf" name="cpf" class="cpf form-control" placeholder="CPF">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">RG</label>
                                        <div class="input-group">
                                            <input type="text" id="rg" name="rg" class="rg form-control" placeholder="RG">
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
                            <input type="hidden" id="lat" name="lat" class="form-control" />
                            <input type="hidden" id="lon" name="lon" class="form-control" />
                            
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
<script src="js/jquery.mask.js"></script>
<script src="js/get_cep.js"></script>
<script src="includes/cliente/cadastra_cliente.js"></script>
