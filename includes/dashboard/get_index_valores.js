function get_valores(){
	
	$.ajax({
	 url:"includes/dashboard/get_index_valores",
	 dataType:'JSON',
     method:"GET",
		success:function(response){
			var status = response.status;
			if(status == "SUCCESS"){
				var servicos_hoje = response.servicos_hoje;
				var servicos_total = response.servicos_total;
				var data_hoje = response.data_hoje;
				var servicos_pendentes_hoje = response.servicos_pendentes_hoje;
				var servicos_finalizados = response.servicos_finalizados;
				var servicos_em_andamento = response.servicos_em_andamento;
				var clientes_30dias = response.clientes_30dias;
				$('#date_hoje').html(data_hoje);
				$('#servicos_todos').html(servicos_total);
				$('#servicos_hoje').html(servicos_hoje);
				$('#servicos_pendentes').html(servicos_pendentes_hoje);
				$('#servicos_finalizados').html(servicos_finalizados);
				$('#servicos_em_andamento').html(servicos_em_andamento);
				$('#clientes_30dias').html(clientes_30dias);
			}else{
				console.log("Erro! Entre em contato com o administrador!");
			}
		
		
		}
    }); 

  }
  
  get_valores();