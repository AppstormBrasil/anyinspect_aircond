function get_lista_visitas_usuario(){
	
	var IdCondominio = $("#id_page").val();
	
	$.ajax({
     url:"includes/view/entrada/get_lista_visita_user",
     method:"GET",
     data:{id:IdCondominio},
		success:function(response){
    var status = response.status;  
    lista_visitantes = response.lista_visitantes;
	  
	  var box_visitante_list = '';
	  var box_moradores_left = '';
	  if(status == "SUCCESS") { 

		for(var a = 0; a < lista_visitantes.length; a++){
			IdVisitante = lista_visitantes[a].IdVisitante;
			IdCondominio = lista_visitantes[a].IdCondominio;
			IdResidencia = lista_visitantes[a].IdResidencia;
			IdMorador = lista_visitantes[a].IdMorador;
			tipo_visitante = lista_visitantes[a].tipo_visitante;
			identificacao = lista_visitantes[a].identificacao;
			email = lista_visitantes[a].email;
			tipo_veiculo = lista_visitantes[a].tipo_veiculo;
			nome_visitante = lista_visitantes[a].nome_visitante;
			tipo_veiculo = lista_visitantes[a].tipo_veiculo;
			placa_veiculo = lista_visitantes[a].placa_veiculo;
			tipo_veiculo = lista_visitantes[a].tipo_veiculo;
			data_entrada = lista_visitantes[a].data_entrada;
			hora_entrada = lista_visitantes[a].hora_entrada;
			obs = lista_visitantes[a].obs;
			qrcode_visitante = lista_visitantes[a].qrcode_visitante;

			imagem_visitante = lista_visitantes[a].imagem + '?' + (new Date()).getTime();

			box_visitante_list += '<div id="row_newvisitante_'+IdVisitante+'" class="col-md-2 col-sm-6">'+
											'<div class="single-transaction-card bg-primary" style="box-shadow: 0 2rem 2rem rgba(0, 0, 0, .1);background:#fbfbfb!important;">'+
												'<div class="card-img">'+
													'<img width="120px" src="images/nouser2.jpg" alt="">'+
												'</div>'+
												'<div class="card-info text-black">'+
													'<p>'+nome_visitante+'</p>'+
													'<p>'+identificacao+'</p>'+
													'<p>Veículo: <strong>'+tipo_veiculo+'</strong></p>'+
													'<p>Placa: <strong>'+placa_veiculo+'</strong></p>'+
													'<p>Data Visita: <strong>'+data_entrada+' ás '+hora_entrada+'</strong></p>'+
													'<a style="margin-top: 15px;background: #7f63f4;padding: 5px;border-radius: 5px;" href="javascript:edit_morador('+IdMorador+',\''+imagem_morador+'\')" >Mais detalhes <i class="fa fa-arrow-right"></i></a>'+
												'</div>'+
											'</div>'+
										'</div>'

			}
      		$('#lista_visitantes_atual').html(box_visitante_list);
				 
    
    	}
    }
    }); 

  }
  
  get_lista_visitas_usuario();