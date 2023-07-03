
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card forms-card">
                <div class="card-body">
                    <h4 class="card-title">Cadastro de Pacotes</h4>
                    <div class="basic-form">
                            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="text-label">Nome do Pacote <span style="color:red;">*</span></label>
                                            <div class="input-group">
                                                <input type="text" name="produto" id="nome" class="form-control" placeholder="Produto" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Valor: <span style="color:red;">*</span></label>
                                            <div class="input-group">
                                                <input type="text" name="valor" id="valor" class="form-control money" placeholder="Valor" required >
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Quantidade de usos: <span style="color:red;">*</span></label>
                                            <div class="input-group">
                                            <input type="text" name="quantidade_usos" id="quantidade_usos" class="form-control" placeholder="Quantidade" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Validade: </label>
                                            <div class="input-group">
                                            <input type="text" name="validade" id="validade" class="form-control" placeholder="Validade do Pacote em dias" >
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <div class="form-group">
                                    <button style="width:100%;" type="buttom" class="btn btn-primary" onclick="cadastraPacote()">Salvar Pacote</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>

	<script>
    toastr.options = {"positionClass": "toast-top-full-width"};
    $('#valor').mask('000.000.000.000.000,00', {reverse: true});
    
    function cadastraPacote(){
        var nome = $("#nome").val();
        var valor = $("#valor").val();
        var quantidade_usos = $("#quantidade_usos").val();
        var validade = $("#validade").val();

        if(nome == ''){
            toastr.error('Ops!', 'Digite o nome do Pacote') ;
            return;
        }
        if(valor == ''){
            toastr.error('Ops!', 'Digite o valor para o Pacote') ;
            return;
        }
        if(quantidade_usos == ''){
            toastr.error('Ops!', 'Digite a quantidade de uso') ;
            return;
        }

       
        $.ajax({
            url: "includes/pacotes/cadastra-pacote", 
            type : 'POST', 
            dataType:'JSON',
            data: {
                nome : nome, 
                valor : valor, 
                quantidade_usos : quantidade_usos,
                validade:validade
            },
            success: function(response){; 
            status = response.status;
            status_txt = response.status_txt;
            last_id = response.last_id;
            if(status == 'SUCCESS') {
                $(".loading").hide(); 
                toastr.success('Sucesso!', status_txt)
                window.setTimeout( function(){
                    window.location.href = "#pacote-"+last_id;
                }, 2000 );
                $("#nome").val("");
                $("#valor").val("");
                $("#quantidade_usos").val("");
                $("#validade").val("");

            } else {
                $(".loading").hide(); 
                toastr.error('Sucesso!', status_txt)
            } 
        },
        error:function(response){
            console.log(response);
        } 
            });
        

    }

	</script>
