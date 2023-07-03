
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
                    <h4 class="card-title">Cadastro de Produtos à venda</h4>
                    <div class="basic-form">
                        <form id="form-produto" action="javascript:cadastraProd();" method="post" style="width:100%;">
                            
                            <div class="row">

                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="text-label">Titulo: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="titulo" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label class="text-label">Categoria: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required >
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
                                        <label class="text-label">Tipo <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <select id="tipo" name="tipo" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
                                                <option disabled selected value="none"></option>
                                                <option value="L">L - Litro</option>
                                                <option value="MG">MG - Miligrama</option>
                                                <option value="ML">ML - Mililitro</option>
                                                <option value="KG">KG - Quilograma</option>
                                                <option value="UN">UN - Unidade</option>
                                                <option value="PC">PC - Peça</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="text-label">Quantidade: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="qtd" id="qtd" class="form-control" placeholder="Quantidade" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Descrição: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <button style="width:100%;" type="submit" class="btn btn-primary">Salvar Produto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
	<script>
      $('#tipo').select2();
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        jQuery("#form-produto").validate({
            rules: {
                "titulo": {
                    required: !0
                },
                "categoria": {
                    required: !0
                },
                "valor": {
                    required: !0
                },
                "tipo": {
                    required: !0
                },
                "qtd": {
                    required: !0
                },
                "descricao": {
                    required: !0
                },
            },
            messages: {
                "titulo": {
                    required: "Campo obrigatório",
                },
                "categoria": {
                    required: "Campo obrigatório"
                },
                "valor": {
                    required: "Campo obrigatório"
                },
                "tipo": {
                    required: "Campo obrigatório"
                },
                "qtd": {
                    required: "Campo obrigatório"
                },
                "descricao": {
                    required: "Campo obrigatório"
                },
            },

            ignore: [],
            errorClass: "invalid-feedback animated fadeInUp",
            errorElement: "div",
            errorPlacement: function(e, a) {
                jQuery(a).parents(".form-group > div").append(e)
            },
            highlight: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            },
            success: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-valid")
            }

        });
                
            function cadastraProd(){
                var titulo = $("#titulo").val();
                var categoria = $("#categoria").val();
                var tipo = $("#tipo").val();
                var qtd = $("#qtd").val();
                var descricao = $("#descricao").val();
                
                var valor = $("#valor").val();
                valor = converteMoedaFloat(valor);

                
                $.ajax({
                    url: "includes/loja/cadastrar_produto.php", 
                    type : 'POST', 
                    dataType:'JSON',
                    data: {
                        titulo : titulo,
                        categoria : categoria,
                        tipo : tipo,
                        qtd : qtd,
                        descricao : descricao,
                        valor : valor
                    },
                        success: function(response){
                            status = response.status; 
                            status_txt = response.status_txt;
                            id_prod = response.id_prod;
                            
                            if(status == 'SUCCESS') {
                                setTimeout(function(){
                                    $(".loading").hide(); 
                                    $(".alert-danger").hide(); 
                                    $(".alert-success").show(); 
                                    $(".success_txt").html(status_txt);
                                    toastr.success('Sucesso!', "Você está sendo redirecionado para a página do produto....");
                                    
                                    $("#titulo").val("");
                                    $("#valor").val("");
                                    $("#tipo").val('').trigger('change');
                                    
                                    window.setTimeout( function(){
                                        window.location.href = "#venda_produto-" + id_prod;
                                    }, 1300 );
                
                                }, 100); 
                            } else {
                                $(".loading").hide(); 
                                toastr.error('Error!', "Erro ao cadastrar o Produto se o problema persistir entre em contato com o Administrador");
                            } 
                        },
                        error:function(response){
                            console.log(response);
                        } 
                    });
                }
                
            function converteMoedaFloat(valor){
            
            if(valor === ""){
                valor =  0;
            }else{
                valor = valor.replace(".","");
                valor = valor.replace(",",".");
                valor = parseFloat(valor);
            }
            return valor;

            }
	</script>
