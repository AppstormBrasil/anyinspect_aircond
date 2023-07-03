function get_valores(){
	
	$.ajax({
	 url:"includes/dashboard/dash_1",
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
				var atrasadas = response.atrasadas;
				var treinamentos_expira = response.treinamentos_expira;
				var ferramentas_expira = response.ferramentas_expira;
				var material_expira = response.material_expira;

				var map_txt = response.map_txt;
				var map_only = response.map_only;

				$('#date_hoje').html(data_hoje);
				$('#servicos_todos').html(servicos_total);
				$('#servicos_hoje').html(servicos_hoje);
				$('#servicos_pendentes').html(servicos_pendentes_hoje);
				$('#servicos_finalizados').html(servicos_finalizados);
				$('#servicos_em_andamento').html(servicos_em_andamento);
				$('#servicos_em_andamento').html(servicos_em_andamento);
				$('#ferramentas_expira').html(ferramentas_expira);
				$('#treinamentos_expira').html(treinamentos_expira);
				$('#material_expira').html(material_expira);


				
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

  function open_map(map_txt,map_only){

    
    // Creating map options
    var mapOptions = {
            center: [-23.664657,-51.356548],
            zoom: 6
         }
         // Creating a map object
         var map = new L.map('my_map_dash', mapOptions);
         
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);
         
         // Creating latlng object
         //var latlang = [[[-23.304831, -45.966911], [-23.179140, -45.887240]]];
         var latlang = [];

         latlang.push(map_only);

         // Creating poly line options
         var multiPolyLineOptions = {color:'blue'};
         
         // Creating multi poly-lines
         var multipolyline = L.multiPolyline(latlang , multiPolyLineOptions);
         
         // Adding multi poly-line to map
         multipolyline.addTo(map);

         /*var locations = [
            ["MP - MONITOR MULTIPARÂMETROS", -23.664657, -51.356548],["Checklist de Frota Pesada", -22.5789005, -47.4004927]
            ]; */

        //console.log(map_txt)
        for (var i = 0; i < map_txt.length; i++) {
            marker = new L.marker([map_txt[i][1], map_txt[i][2]])
            .bindPopup(map_txt[i][0])
            .addTo(map);
        }
        
        


}