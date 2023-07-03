 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');

    $("#save_func" ).click(function() {
        jQuery(".form-update-func").validate({
           rules: {
				"nome": {
					required: !0
				},
				"email": {
				  required: true,
				  email : true
			  }
			},
		messages: {
			"nome": {
				  required: "Campo obrigatório",
				  minlength: "O título deve conter pelo menos três caracteres"
			},
			 "email": {
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
    
    });

  
function updateFunc(){
	var id_funcionario = $("#id_page").val();
		
	var nome = $("#nome").val();
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
	var info_extra = $("#info_extra").val();
	var comissao = $("#comissao").val();
	
    $.ajax({
         url: "includes/controller/pet/update_pet_funcionario", 
         type : 'POST', 
         dataType: 'JSON',
        data: {
				id_funcionario : id_funcionario,
                nome : nome, 
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
                info_extra : info_extra,
				comissao : comissao
			},
                success: function(response){
                var json = response; 
                status = json.status; 
                status_txt = json.status_txt;

                if(status == 'SUCCESS') {
                    setTimeout(function(){
                        toastr.success(status_txt, 'Sucesso.. Redirecionando');
						window.setTimeout( function(){
							//location.reload();
						}, 1000 );
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

