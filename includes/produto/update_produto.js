 $('.data').mask('99/99/9999');
 $('.rg').mask('99.999.999-9');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');
    $("#save_func" ).click(function() {
        jQuery(".form-update-prod").validate({
           rules: {
				"produto": {
					required: !0
				},
			  "tipo": {
					required: !0
				},
				"valor": {
					required: !0
				},
			},
		messages: {
			"produto": {
				  required: "Campo obrigatório"
			},
			 "tipo": {
				  required: "Campo obrigatório"
			},
			"valor": {
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
    
    });


function updateProd(){
	var id_produto = $("#id_page").val();
	var produto = $("#produto").val();
	var valor = $("#valor").val();
	valor = converteMoedaFloat(valor);
	var tipo = $("#tipo").val();
    var qtd = $("#qtd").val();
    var validade = $("#validade").val();
    var base = $("#base").val();
    var min_qtd = $("#min_qtd").val();
    $.ajax({
         url: "includes/produto/update_produto", 
         type : 'POST', 
         dataType: 'JSON',
        data: {
				id_produto : id_produto,
                produto : produto, 
                valor : valor, 
                tipo : tipo,
                qtd:qtd,
                validade:validade,
                base:base,
                min_qtd:min_qtd
			},
                success: function(response){
                var json = response; 
                var status = json.status; 
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

