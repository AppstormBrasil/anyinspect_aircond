toastr.options = {"positionClass": "toast-top-full-width"}
function get_lista_pet(){
	
	var idCliente = $("#id_page").val();
	
	$.ajax({
     url:"includes/view/pet/get_pets_from_client",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:idCliente},
		success:function(response){

		var status = response.status;
		var lista_pet = response.data;
		var numero_pets = response.numero_pets;
		var modal_pet = response.modal_pet;
		
	  if(status == "SUCCESS") {
		
		
		for(var a = 0; a < lista_pet.length; a++){
			id_pet = lista_pet[a].id_pet;
			name = lista_pet[a].name;
			breed = lista_pet[a].breed;
			gender = lista_pet[a].gender;
			size = lista_pet[a].size;
			hair = lista_pet[a].hair;
			mood = lista_pet[a].mood;
			dt_nasc = lista_pet[a].dt_nasc;
			obs = lista_pet[a].obs;
			botao = lista_pet[a].botao;
			
			lista_pets += '<tr id="row_pet_'+id_pet+'">'+
												'<td id="nome_pet_'+id_pet+'"><a href="pet-'+id_pet+'"><img  style="width:35px;height:35px;border-radius:50%;background:#f3f3f3;" class="user_pic" src="assets/images/favicon.png" > '+name+'</a></td>'+
												'<td><span class="text-pale-sky" id="raca_pet_'+id_pet+'">'+breed+'</span></td>'+
												'<td id="genero_pet_'+id_pet+'">'+gender+'</td>'+
												'<td id="porte_pet_'+id_pet+'">'+size+'</td>'+
												'<td id="hair_pet_'+id_pet+'">'+hair+'</td>'+
												'<td id="mood_pet_'+id_pet+'">'+mood+'</td>'+
												'<td id="dt_nasc_pet_'+id_pet+'">'+dt_nasc+'</td>'+
												'<td id="obs_pet'+obs+'">'+obs+'</td>'+
												'<td id="botao_'+id_pet+'">'+botao+'</td>'+
										'</tr>';
			}
      		$('#lista_pets').html(lista_pets);
			$('#numero_pets').val(numero_pets);
			$('#modal_pet').html(modal_pet);
			$("#car_plate").mask('SSS-9999');
			 $('.cpf').mask('000.000.000-00');
			 $('.cnpj').mask('99.999.999/9999-99');
			 $('.data').mask('99/99/9999');
			 $('.rg').mask('99.999.999-9');
			 $(".zip").mask('99999-999');
			 $(".time").mask('00:00');
			 $('.phone').mask('(00) 00000-0009');
			 //$('.rg').mask('99.999.999-9');
    	}
    }
    }); 

  }
  
  get_lista_pet();