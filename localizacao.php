<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>

<style>
    .select2-container .select2-selection--single {height:45px!important}
    .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 43px!important;font-size: 16px;}
    .select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
    .select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}
    #map { width: 100%;height: 400px;box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);}
</style>
<?php $id = $_GET['id']; ?>
<input type="hidden" id="id_local" name="id_local" value="<?php echo $id ?>" />
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div id="map"  tabindex="0" style="position: relative;"></div>
        </div>
        <div class="col-lg-12">
            <form class="forms-card" id="form-local" action="javascript:UpdateLocal();" method="post" style="width:100%;">
                <div class="card card-body">
                    <h4 class="card-title">Cadastro Local</h4>
                    <div class="basic-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Descrição: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="descricao" id="descricao" class="form-control" placeholder="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="text-label">Tipo Aatividade: </span></label>
                                        <div class="input-group">
                                            <input type="text" name="tipo" id="tipo" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="text-label">Cliente: </label>
                                        <div class="input-group">
                                            <select style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="cliente" name="cliente" ></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="text-label">Nº Ocupantes Fixos: </label>
                                        <div class="input-group">
                                            <input type="text" name="num_fixo" id="num_fixo" class="form-control" placeholder="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="text-label">Nº Ocupantes Flutuantes: </span></label>
                                        <div class="input-group">
                                            <input type="text" name="num_flutuante" id="num_flutuante" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="text-label">Área Climatizada(m2): </span></label>
                                        <div class="input-group">
                                            <input type="text" name="area_climatizada" id="area_climatizada" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="text-label">Carga Térmica (kcal/h): </span></label>
                                        <div class="input-group">
                                            <input type="text" name="carga_termica" id="carga_termica" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4>Endereço</h2>
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="text-label">Cep</label>
                                                <input onBlur="pesquisacep(this.value);" type="text" name="cep" id="cep" class="zip form-control" placeholder="Cep">
                                            </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="text-label">Endereço</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="endereco" name="endereco"  placeholder="Endereço" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Numero</label>
                                            <input type="text" onBlur="latclose(this.value);" id="numero" name="numero" class="form-control" placeholder="Número">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Complemento</label>
                                            <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Complemento" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Bairro</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="bairro" name="bairro"  placeholder="Bairro" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent" >  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-label">Cidade</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="cidade" name="cidade"  placeholder="Cidade" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent" >  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-label">Estado</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="estado" name="estado"  placeholder="Estado" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent" >  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-label">Latitude: </label>
                                            <div class="input-group">
                                                <input type="text" name="lat" id="lat" class="form-control" placeholder=""  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-label">Longitude: </label>
                                            <div class="input-group">
                                                <input type="text" name="lon" id="lon" class="form-control" placeholder=""  >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Salvar</button>  
                                </div>
                    </div>
                    
                </div>
            
            
            </form>


            <!--<div class="row">
                <div class="col-xl-12" >
                    <div class="card  m-b-0">
                        <div class="card-header" style="background: white;padding:15px;">
                            <h4 class="card-title">Localização</h4>
                        </div>
                        <div class="card-body p-0">
                        <div class="event-sideber-search">
                                <form action="#" method="post" class="chat-search-form">
                                    <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                                    <i class="fa fa-search"></i>
                                </form>
                            </div>
                            
                            <div class="table-responsive" style="background: white;padding: 10px;">
                                <table class="table table-padded market-capital table-responsive-fix-big" id="lista_localizacao" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descrição</th>
                                            <th style="text-align:right;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


        </div>      
    </div>
</div>
  
<script src="includes/local/update_local.js"></script>
<script src="includes/local/get_cep.js"></script>
<script src="js/leaf/leaflet.js"></script>
	
<script>
var descricao;
var full_address;

get_lista_cliente();

function get_info_local(){
	var id_local = $("#id_local").val();
	
	$.ajax({
     url:"includes/local/get_info_local",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:id_local},
		success:function(response){

		var status = response.status;
		var info_cliente = response.data[0];

			if(status == "SUCCESS") {

				$('#bairro').val(info_cliente.bairro);
				$('#cep').val(info_cliente.cep);
				$('#cidade').val(info_cliente.cidade);
				$('#complemento').val(info_cliente.complemento);
				$('#descricao').val(info_cliente.descricao);
				$('#endereco').val(info_cliente.endereco);
				$('#numero').val(info_cliente.numero);
				$('#complemento').val(info_cliente.complemento);
				$('#estado').val(info_cliente.estado);
				$('#lat').val(info_cliente.lat);
				$('#lon').val(info_cliente.lon);
                $('#responsavel').val(info_cliente.responsavel);
                $('#num_fixo').val(info_cliente.num_fixo);
                $('#num_flutuante').val(info_cliente.num_flutuante);
                $('#area_climatizada').val(info_cliente.area_climatizada);
                $('#carga_termica').val(info_cliente.carga_termica);
                $('#tipo').val(info_cliente.tipo);
                $('#cliente').val(info_cliente.id_client);
                
                full_address = info_cliente.endereco+' '+info_cliente.numero+' '+info_cliente.bairro+' '+info_cliente.complemento+' '+info_cliente.cidade+' '+info_cliente.estado;
                descricao = info_cliente.descricao;

                if(info_cliente.lat){
                    var lat = parseFloat(info_cliente.lat);
                    var lon = parseFloat(info_cliente.lon);
                    plot_map(lat,lon);
                 }

            
            } else {
				//window.location.href = '404';
			}
		}
    }); 

  }
  setTimeout(function(){
    get_info_local();
  }, 500);   



var map;
function plot_map(lat,lon){
    
    var desc_box = '<div style="text-align:center;"><h4>'+descricao+'</h4><p>'+full_address+'</p></div>';

    if(map == undefined){
        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

        map = L.map('map', {
            center: [lat, lon],
            zoom: 15,
            layers: [grayscale, cities]
        });

        L.marker([lat, lon]).bindPopup(desc_box).addTo(cities)
        

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets
        };

        var overlays = {
            "Cidade": cities
        };

        L.control.layers(baseLayers, overlays).addTo(map);
    
    
    } else {
        map.off();
        map.remove();

        var cities = L.layerGroup();
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});


        map = L.map('map', {
            center: [lat, lon],
            zoom: 15,
            layers: [grayscale, cities]
        });
    
        L.marker([lat, lon]).bindPopup(desc_box).addTo(cities)
        

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets
        };

        var overlays = {
            "Cidade": cities
        };
    
        L.control.layers(baseLayers, overlays).addTo(map);
    
    }  
   


}

function latclose(conteudo){
      logradouro = $('#endereco').val();
      bairro = $('#bairro').val();
      localidade =  $('#cidade').val();
      uf = $('#estado').val();
      num = conteudo;

      ad_final = logradouro+','+num+','+bairro+','+localidade+','+uf;
      ad_final = removeAcento(ad_final);
     
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://locationiq.org/v1/search.php?key=5073c64ffbe054&q="+ad_final+"&format=json",
        "method": "GET"
      }

      $.ajax(settings).done(function (response) {

        if(response.error){
          console.log(response);
        } else {
          var lat = response[0].lat
          var lon = response[0].lon
          $('#lat').val(lat);
          $('#lon').val(lon);

          lat = parseFloat(lat);
          lon = parseFloat(lon);
          plot_map(lat,lon);

        }
          
      });
}


function RemoveItem(productId,nome,imagem){
    information = '<div class="user-info">'+
                        '<div class="image"><a class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja realmente remover esta Raça?</h5>'+
                        '</div>'+
                    '</div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/local/delete_local',
                   type: 'POST',
                   dataType:"json",
                   data: {
                    id : productId
                }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                //swal('Removido!', status_txt, status);
                swal.close(); 
                $('.row_'+productId).remove();
                toastr.success(status_txt, 'Sucesso'); 
                
               
             })
             .fail(function(){
                 swal('Oops...', 'Algum erro ao deletar !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}

function go_to_page_single(){
      window.location.href = "cadastro-local";
}


function get_lista_cliente(){
   
    $.ajax({
    url:"includes/cliente/get_client",
    dataType:'JSON',
    method:"GET",
        success:function(response){
            var option = '<option disabled selected value="none"></option>'
            var i;
            for (i = 0; i < response.data.length; i++) {
                option += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
                        
            }
            $('#cliente').html(option);	
            
        }
    }); 
}
</script>
