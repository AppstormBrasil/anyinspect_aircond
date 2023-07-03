 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');

jQuery("#form-cliente").validate({
    rules: {
        "nome_cliente": {
            required: !0
        },
		"nome_empresa": {
            required: !0
        }
    },
    messages: {
        "nome_cliente": {
			  required: "Campo obrigatório",
			  minlength: "O título deve conter pelo menos três caracteres"
        },
		"nome_empresa": {
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

	function cadastraCli(){
		var nome_cliente = $("#nome_cliente").val();
		var nome_empresa = $("#nome_empresa").val();
		var sexo = $("#sexo").val();
		var email = $("#email").val();
		var telefone1 = $("#telefone1").val();
		var telefone2 = $("#telefone2").val();
		var cep = $("#cep").val();
		var endereco = $("#endereco").val();
		var numero = $("#numero").val();
		var complemento = $("#complemento").val();
		var bairro = $("#bairro").val();
		var cidade = $("#cidade").val();
		var estado = $("#estado").val();
		var cpf = $("#cpf").val();
		var rg = $("#rg").val();
		var data_nascimento = $("#data_nascimento").val();
		var obs = $("#obs").val();
		var lat = $("#lat").val();
		var lon = $("#lon").val();
		var insta_cliente = $("#insta_cliente").val();
		var cnpj = $("#cnpj").val();
		$.ajax({
			url: "includes/cliente/cadastra-cliente", 
			type : 'POST', 
			dataType:'JSON',
			data: {
                nome_cliente : nome_cliente, 
                sexo : sexo, 
                email : email, 
                telefone1 : telefone1, 
                telefone2 : telefone2, 
                cep : cep, 
                endereco : endereco, 
                numero : numero, 
                complemento : complemento, 
                bairro : bairro, 
                cidade : cidade, 
                estado : estado, 
                cpf : cpf, 
                rg : rg, 
                data_nascimento : data_nascimento, 
                obs : obs, 
				nome_empresa:nome_empresa,
				cnpj:cnpj,
				lat : lat,
				lon : lon,
				insta_cliente:insta_cliente
			},
				success: function(response){
					var status = response.status; 
					status_txt = response.status_txt;
					id_cliente = response.id_cliente;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt);
							window.setTimeout( function(){
								 window.location.href = "#cliente-" + id_cliente;
							}, 1000 );
							toastr.success('Sucesso!', status_txt);
						}, 100); 
					} else {
						$(".loading").hide(); 
						$(".alert-success").hide(); 
						$(".alert-danger").hide(); 
						$(".alert-danger").fadeIn(); 
						$(".error_txt").html(status_txt); 
						toastr.error('Error!', status_txt);
					} 
				},
				error:function(response){
					toastr.error('Error!', 'Erro ao Cadastrar');
					console.log(response);
				} 
			});
		}

		