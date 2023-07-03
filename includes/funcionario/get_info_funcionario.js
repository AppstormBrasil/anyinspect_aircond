toastr.options = {"positionClass": "toast-top-full-width"}
function get_lista_funcionario(){
	var idFuncionario = $("#id_page").val();
	
	$.ajax({
     url:"includes/funcionario/get_info_funcionario",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:idFuncionario},
		success:function(response){
		var status = response.status;
		var info_funcionaio = response.data[0];
			if(status == "SUCCESS") {
				$('#nome').val(info_funcionaio.name);
				$('#email').val(info_funcionaio.email);
				$('#telefone1').val(info_funcionaio.phone);
				$('#telefone2').val(info_funcionaio.phone2);
				$('#cep').val(info_funcionaio.zip);
				$('#endereco').val(info_funcionaio.street);
				$('#numero').val(info_funcionaio.number);
				$('#complemento').val(info_funcionaio.complemento);
				$('#bairro').val(info_funcionaio.neighbor);
				$('#cidade').val(info_funcionaio.city);
				$('#estado').val(info_funcionaio.state);
				$('#cpf').val(info_funcionaio.cpf);
				$('#rg').val(info_funcionaio.rg);
				$('#data_nascimento').val(info_funcionaio.data_nascimento);
				$('#info_extra').val(info_funcionaio.info_extra);
				$('#comissao').val(info_funcionaio.comissao);
				$("#type").select2("val", info_funcionaio.type);
				if(info_funcionaio.type2 == 1){
					$("#type2").prop( "checked", true );
				}
				$("#sexo").select2("val", info_funcionaio.gender);
				
				if(info_funcionaio.foto != ""){
					$("#image_client").attr('src', info_funcionaio.foto +'?' + (new Date()).getTime());
				}
				
				if(info_funcionaio.sign != ""){
					$("#assinatura").html('<img src="'+info_funcionaio.sign+'">');
				}

				$('#data_admicao').val(info_funcionaio.data_admicao);
				$('#local_nascimento').val(info_funcionaio.local_nascimento);
				$('#cargo').val(info_funcionaio.cargo);
				$('#base').val(info_funcionaio.base);
				


			} else {
				window.location.href = '#404';
			}
		}
    }); 

  }
  
  get_lista_funcionario();