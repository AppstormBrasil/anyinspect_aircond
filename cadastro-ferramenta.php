
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
                    <h4 class="card-title">Cadastro de Ferramenta</h4>
                    <div class="basic-form">
                        <form id="form-produto" action="javascript:cadastraProd();" method="post" style="width:100%;">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Descricao: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Local 
                                        <!--<a style="margin-bottom:15px;float:right;margin-left: 10px;" target="_blank" href="lista-localizacao"><span style="width:100%;padding:12px;" class="label label-xl btn-secondary btn-xs">Lista Localização</span></a>
                                        <a style="margin-bottom:15px;float:right;margin-left: 10px;" class="new_local"><span style="width:100%;padding:12px;" class="label label-xl btn-primary btn-xs">Nova Localização</span></a>-->
                                        
                                        </label>
                                        <select class="form-control" style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="local" name="local" ></select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Patrimônio: </label>
                                        <div class="input-group">
                                            <input type="text" name="patrimonio" id="patrimonio" class="form-control" placeholder="Patrimônio" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Sn: </label>
                                        <div class="input-group">
                                            <input type="text" name="sn" id="sn" class="form-control" placeholder="Serial Number" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Pn: </label>
                                        <div class="input-group">
                                            <input type="text" name="pn" id="pn" class="form-control" placeholder="Part Number" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Tipo </label>
                                        <div class="input-group">
                                            <select id="tipo" name="tipo" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
                                                <option disabled selected value="none"></option>
                                                <option value="Administrativo">Administrativo</option>
                                                <option value="Ferramenta">Ferramenta</option>
                                                <option value="Ferramental">Ferramental</option>
                                                <option value="GSE">GSE</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Data Calibração: </label>
                                        <div class="input-group">
                                            <input type="text" name="calibracao" id="calibracao" class="data form-control" placeholder="Data Calibração" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Data Vencimento: </label>
                                        <div class="input-group">
                                            <input type="text" name="vencimento" id="vencimento" class="data form-control" placeholder="Data Vencimento" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <br>
                            <div class="row">
                                <button style="width:100%;" type="submit" class="btn btn-primary">Cadastrar Ferramenta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<script src="js/plugins-init/select2-init.js"></script>
<script src="js/jquery.mask.js"></script>

	<script>
    $('.data').mask('99/99/9999');
    $.datetimepicker.setLocale('pt');
    jQuery('.data').datetimepicker({
        timepicker: false, 
        format:'d/m/Y',
		  inline:false,
          todayButton:true,
          autoclose: true,
		  lang:'pt',
		  step: 5,
		  scrollInput: false,
          defaultTime:'07:00' ,
         
	 });

    $('#tipo').select2();
    get_lista_local();
    function get_lista_local(){
		var id_client = $("#id_client").val();
		
		$.ajax({
		url:"includes/local/get_local_todos",
		dataType:'JSON',
		method:"POST",
		data:{id_client:id_client},
			success:function(response){
				var option = '<option disabled selected value="none"></option>'
				var i;
				var status = response.status;
				if(status == 'SUCCESS'){
					for (i = 0; i < response.data.length; i++) {
						option += '<option value="'+response.data[i].id+'">'+response.data[i].nome_empresa+' - '+response.data[i].descricao+'</option>';
					}
					$('#local').html(option);	
				}
			}
		}); 
   }
   $('#local').select2();
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        jQuery("#form-produto").validate({
            rules: {
                "descricao": {
                    required: !0
                },
                "patrimonio": {
                    required: !0
                }
            },
            messages: {
                "descricao": {
                    required: "Campo obrigatório",
                },
                "patrimonio": {
                    required: "Campo obrigatório"
                }
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
                var descricao = $("#descricao").val();
                var local = $("#local").val();
               
                var patrimonio = $("#patrimonio").val();
                var sn = $("#sn").val();
                var pn = $("#pn").val();
                var calibracao = $("#calibracao").val();
                var vencimento = $("#vencimento").val();
                var tipo = $("#tipo").val();
                $.ajax({
                    url: "includes/ferramenta/cadastra_ferramenta", 
                    type : 'POST', 
                    dataType:'JSON',
                    data: {
                        descricao : descricao, 
                        local : local, 
                        patrimonio : patrimonio,
                        sn : sn,
                        pn : pn,
                        calibracao : calibracao,
                        vencimento : vencimento,
                        tipo : tipo
                    },
                        success: function(response){
                            status = response.status; 
                            status_txt = response.status_txt;
                            id_cliente = response.last_id;
                            if(status == 'SUCCESS') {
                                setTimeout(function(){
                                    $(".loading").hide(); 
                                    $(".alert-danger").hide(); 
                                    $(".alert-success").show(); 
                                    $(".success_txt").html(status_txt);
                                    toastr.success('Sucesso!', "Você está sendo redirecionado para a página da Ferramenta....");
                                     $("#descricao").val("");
                                    $("#patrimonio").val("");
                                    $("#sn").val("");
                                    $("#pn").val("");
                                    $("#calibracao").val("");
                                    $("#vencimento").val("");
                                    $("#local").val('').trigger('change');
                                    window.setTimeout( function(){
                                        window.location.href = "#ferramenta-" + id_cliente;
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
