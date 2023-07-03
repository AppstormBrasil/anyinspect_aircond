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

jQuery("#form-func").validate({
    rules: {
        "nome": {
            required: !0
        },
        "email": {
          email : true
      },
	  "email": {
            required: !0
        }
    },
    messages: {
        "nome": {
			  required: "Campo obrigatório",
			  minlength: "O título deve conter pelo menos três caracteres"
        },
		 "email": {
			  email: "Por favor digite um e-mail válido"
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
		
	function cadastraFunc(){
		var nome = $("#nome").val();
		var sexo = $("#sexo").val();
		var email = $("#email").val();
		var senha = $("#senha").val();
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
		var info_extra = $("#info_extra").val();
		
		$.ajax({
			url: "includes/controller/pet/cadastra-funcionario", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                nome : nome, 
                sexo : sexo, 
                email : email,
				senha : senha,
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
                info_extra : info_extra
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					id_funcionario = response.id_funcionario;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt);
							window.setTimeout( function(){
								 window.location.href = "pet-lista-funcionario-detalhado-" + id_funcionario;
							}, 1000 );
							toastr.success('Sucesso!', status_txt);
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