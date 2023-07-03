toastr.options = {"positionClass": "toast-top-full-width"}

 // MAterial Date picker


function get_lista_funcionario(){
	var idFuncionario = $("#id_page").val();
	
	$.ajax({
     url:"includes/view/pet/get_info_funcionario",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:idFuncionario},
		success:function(response){

		var status = response.status;
		var lista_pet = response.data[0];

			if(status == "SUCCESS") {
				$('#nome').val(lista_pet.name);
				$('#sexo').val(lista_pet.gender);
				$('#email').val(lista_pet.email);
				$('#telefone1').val(lista_pet.phone);
				$('#telefone2').val(lista_pet.phone2);
				$('#cep').val(lista_pet.zip);
				$('#endereco').val(lista_pet.street);
				$('#numero').val(lista_pet.number);
				$('#complemento').val(lista_pet.complemento);
				$('#bairro').val(lista_pet.neighbor);
				$('#cidade').val(lista_pet.city);
				$('#estado').val(lista_pet.state);
				$('#cpf').val(lista_pet.cpf);
				$('#rg').val(lista_pet.rg);
				$('#data_nascimento').val(lista_pet.data_nascimento);
				$('#info_extra').val(lista_pet.info_extra);
				$('#comissao').val(lista_pet.comissao);

				if(lista_pet.foto != ""){
					$("#image_client").attr('src', lista_pet.foto +'?' + (new Date()).getTime());
				}
				
			
			}
		}
    }); 

  }
  
  get_lista_funcionario();