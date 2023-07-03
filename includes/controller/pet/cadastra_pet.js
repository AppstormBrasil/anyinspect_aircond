 toastr.options = {"positionClass": "toast-top-full-width"}
 
 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $('.rg').mask('99.999.999-9');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');
 $('.rg').mask('99.999.999-9'); 

jQuery("#form-pet").validate({
    rules: {
        "nome_novo_pet": {
            required: !0
        }
    },
    messages: {
        "nome_novo_pet": {
			  required: "Campo obrigatório",
			  minlength: "O título deve conter pelo menos três caracteres"
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

		
	function cadastraPet(){
		var id_cliente = $("#id_page").val();
		var nome_pet = $("#nome_novo_pet").val();
		var raca_pet = $("#raca_novo_pet").val();
		var sexo_pet = $("#sexo_novo_pet").val();
		var porte_pet = $("#porte_novo_pet").val();
		var hair_pet = $("#hair_novo_pet").val();
		var mood_pet = $("#mood_novo_pet").val();
		var obs_pet = $("#obs_novo_pet").val();
		var dt_nasc_pet = $("#dt_nasc_novo_pet").val();

		$.ajax({
			url: "includes/controller/pet/cadastra_pet", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                id_cliente : id_cliente, 
                nome_pet : nome_pet, 
                raca_pet : raca_pet, 
                sexo_pet : sexo_pet, 
                porte_pet : porte_pet, 
				hair_pet : hair_pet,
				mood_pet : mood_pet,
				obs_pet : obs_pet,
                dt_nasc_pet : dt_nasc_pet
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt); 
							window.setTimeout( function(){
								location.reload();
							}, 1000 );
							toastr.success('Sucesso! Redirecionando....', status_txt)
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