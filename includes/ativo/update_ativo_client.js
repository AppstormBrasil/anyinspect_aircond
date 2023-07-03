 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $('.rg').mask('99.999.999-9');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');
 $('.rg').mask('99.999.999-9');

    $("#save_pet" ).click(function() {
        jQuery(".form-update-pet").validate({
           rules: {
				"nome_cliente": {
					required: !0
				}
			},
		messages: {
			"nome_cliente": {
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
    
    });


function update_pet(){
	
	var id_cliente = $("#id_page").val();
		
	var nome_cliente = $("#nome_cliente").val();
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
    var valor_frete = $("#valor_frete").val();
    
	
    $.ajax({
         url: "includes/barco/update_barco", 
         type : 'POST', 
         dataType: 'JSON',
        data: {
				id_cliente : id_cliente,
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
                lat: lat,
                lon: lon,
                insta_cliente: insta_cliente,
                valor_frete:valor_frete
			},
                success: function(response){
                var json = response; 
                var status = json.status; 
                var status_txt = json.status_txt;

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

