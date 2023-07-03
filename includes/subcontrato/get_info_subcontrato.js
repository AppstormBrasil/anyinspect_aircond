toastr.options = {"positionClass": "toast-top-full-width"}

 // MAterial Date picker


function get_lista_client(){
	var idCliente = $("#id_page").val();
	
	$.ajax({
     url:"includes/subcontrato/get_info_subcontrato",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:idCliente},
		success:function(response){

		var status = response.status;
		var info_cliente = response.data[0];

			if(status == "SUCCESS") {
				$('#nome_cliente').val(info_cliente.name);
				$('#sexo').val(info_cliente.gender);
				$('#email').val(info_cliente.email);
				$('#telefone1').val(info_cliente.phone);
				$('#telefone2').val(info_cliente.phone2);
				$('#cep').val(info_cliente.zip);
				$('#endereco').val(info_cliente.street);
				$('#numero').val(info_cliente.number);
				$('#complemento').val(info_cliente.complemento);
				$('#bairro').val(info_cliente.neighbor);
				$('#cidade').val(info_cliente.city);
				$('#estado').val(info_cliente.state);
				$('#cpf').val(info_cliente.cpf);
				$('#rg').val(info_cliente.rg);
				$('#data_nascimento').val(info_cliente.data_nascimento);
				$('#obs').val(info_cliente.obs);
				$('#insta_cliente').val(info_cliente.insta_cliente)
				$('#nome_empresa').val(info_cliente.nome_empresa)
				$('#cnpj').val(info_cliente.cnpj)
				$('#lat').val(info_cliente.lat)
				$('#lon').val(info_cliente.lon)
				$('#funcao').val(info_cliente.funcao)
				$('#certificado').val(info_cliente.certificado)
				$('#validade_contrato').val(info_cliente.validade_contrato)
				$('#prox_auditoria').val(info_cliente.prox_auditoria)
				$('#ult_auditoria').val(info_cliente.ult_auditoria)
				
				if(info_cliente.foto != ""){
					$("#image_client").attr('src',info_cliente.foto +'?' + (new Date()).getTime());
				}
				var full_address = "";
				full_address = info_cliente.street+' '+info_cliente.number+' '+info_cliente.neighbor+' '+info_cliente.complemento+' '+info_cliente.city+' '+info_cliente.state;
                descricao = info_cliente.name;

				if(info_cliente.lat){
                    var lat = parseFloat(info_cliente.lat);
                    var lon = parseFloat(info_cliente.lon);
                    plot_map(lat,lon,full_address);
                 }
				
			} else {
				window.location.href = '#404';
			}
		}
    }); 

  }
  
  get_lista_client();