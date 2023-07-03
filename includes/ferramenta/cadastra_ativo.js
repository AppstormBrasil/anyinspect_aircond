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
        "descricao_ativo": {
            required: !0
        }
    },
    messages: {
        "descricao_ativo": {
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

		
	function cadastraAtivo(){
		var id_cliente = $("#id_page").val();
		var descricao = $("#descricao_ativo").val();
		var cat = $("#category_ativo");
		var category = cat[0].selectedOptions[0].innerText;
		$.ajax({
			url: "includes/ativo/cadastra_ativo", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                id_cliente : id_cliente, 
                descricao : descricao, 
                category : category
				
			},
				success: function(response){
					var lista_barcos = "";
					var status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id;
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt); 
							$("#descricao_ativo").val('');
							var table = $('#lista_ativos').DataTable();
							table.ajax.reload();
							$("#novo-ativo").modal('hide');
							toastr.success(status_txt, '!Sucesso');
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
					toastr.error(status_txt, '!Error');
					console.log(response);
				} 
			});
		}