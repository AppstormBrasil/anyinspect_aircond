 toastr.options = {"positionClass": "toast-top-full-width"}
 
 $('.money').mask('000.000.000.000.000,00', {reverse: true});

jQuery("#form-produto").validate({
    rules: {
        "produto": {
            required: !0
        },
	  "valor": {
            required: !0
        },
		"tipo": {
            required: !0
        },
    },
    messages: {
        "produto": {
			  required: "Campo obrigatório",
		},
		 "valor": {
			  required: "Campo obrigatório"
        },
		"tipo": {
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
		var produto = $("#produto").val();
		var valor = $("#valor").val();
		valor = converteMoedaFloat(valor);
		var tipo = $("#tipo").val();
		
		$.ajax({
			url: "includes/controller/pet/cadastra_produto", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                produto : produto, 
                valor : valor, 
                tipo : tipo
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					id_cliente = response.id_cliente;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt);
							toastr.success('Sucesso!', "Você está sendo redirecionado para a página do produto....");
							
							$("#produto").val("");
							$("#valor").val("");
							$("#tipo").val('').trigger('change');
							
							window.setTimeout( function(){
								 window.location.href = "lista-produto-detalhado?id=" + id_cliente;
							}, 1300 );
		
						}, 100); 
					} else {
						$(".loading").hide(); 
						$(".alert-success").hide(); 
						$(".alert-danger").hide(); 
						$(".alert-danger").fadeIn(); 
						$(".error_txt").html(status_txt); 
					} 
				},
				error:function(response){
					alert("Erro!");
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