function get_lista_ativo(){
	var idCliente = $("#id_page").val();
	$.ajax({
     url:"includes/cliente/get_ativos_from_client",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:idCliente},
		success:function(response){
		var status = response.status;
		var lista_pet = response.data;
		var modal_ativo = response.modal_pet;
	    if(status == "SUCCESS") {
		for(var a = 0; a < lista_ativos.length; a++){
			id = lista_ativos[a].id;
			descricao = lista_ativos[a].descricao;
			categoria = lista_ativos[a].categoria;
			model = lista_ativos[a].model;
			register = lista_ativos[a].register;
			obs = lista_ativos[a].obs;
			botao = lista_ativos[a].botao;
			id_cat = lista_ativos[a].id_cat;
			categoria = lista_ativos[a].categoria;
			foto = lista_ativos[a].foto +'?' + (new Date()).getTime();
			lista_barcos += '<tr id="row_ativo_'+id+'">'+
									'<td><a href="barco-'+id+'"><img  style="width:35px;height:35px;border-radius:50%;background:#f3f3f3;" class="user_pic" src="'+foto+'" > <span id="descricao__'+id+'">'+descricao+'</span></a></td>'+
									'<td><span class="text-pale-sky" id="categoria__'+id+'">'+categoria+'</span></td>'+
									'<td id="model__'+id+'">'+model+'</td>'+
									'<td id="register__'+id+'">'+register+'</td>'+
									'<td id="obs__'+id+'">'+obs+'</td>'+
									'<td id="btn_bolt__'+id+'">'+botao+'</td>'+
							'</tr>';
			}
      		$('#lista_ativos').html(lista_barcos);
			$('#modal_pet').html(modal_ativo);
    	}
    }
    }); 
  }
  
  get_lista_ativo();