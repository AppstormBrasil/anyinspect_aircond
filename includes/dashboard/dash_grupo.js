function get_valores(){
	var id_grupo = $("#id_grupo").val();
	$.ajax({
	 url:"includes/dashboard/dash_grupo",
	 dataType:'JSON',
     method:"GET",
	 data:{id_grupo:id_grupo},
		success:function(response){
			var status = response.status;
			if(status == "SUCCESS"){
				var servicos_hoje = response.servicos_hoje;
				var servicos_total = response.servicos_total;
				var data_hoje = response.data_hoje;
				var servicos_pendentes_hoje = response.servicos_pendentes_hoje;
				var servicos_finalizados = response.servicos_finalizados;
				var servicos_em_andamento = response.servicos_em_andamento;
				var atrasadas = response.atrasadas;

				var map_txt = response.map_txt;
				var map_only = response.map_only;

				$('#date_hoje').html(data_hoje);
				$('#servicos_todos').html(servicos_total);
				$('#servicos_hoje').html(servicos_hoje);
				$('#servicos_pendentes').html(servicos_pendentes_hoje);
				$('#servicos_finalizados').html(servicos_finalizados);
				$('#servicos_em_andamento').html(servicos_em_andamento);


				
				var box_atrasados = "";
				if(atrasadas > 0){
					box_atrasados = '<span class="text-muted f-s-12 blink">Atrasadas</span><h2 style="color:#E53935;">'+atrasadas+'</h2>';
					$('#atrasados').html(box_atrasados);
				}
				
				$('.compl_act').html(servicos_finalizados+'/'+servicos_hoje);

				per = response.per ; 
				var box_percent = "";

				box_percent = '<h6 class="mt-4">'+per+'% Completo</h6>'+
								'<div class="progress mb-3">'+
									'<div class="progress-bar bg-primary" style="width: '+per+'%; height:6px;" role="progressbar"><span class="sr-only">'+per+'% Completo</span>'+
									'</div>'+
								'</div>';

				$('#percent_act').html(box_percent);   

				open_map(map_txt,map_only);
				$('#new_map').hide();
				
								

			}else{
				console.log("Erro! Entre em contato com o administrador!");
				$('#new_map').hide();
			}
		
		
		}
    }); 

  }
  
  get_valores();