<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	
<style>
      body {
        margin: 0;
        padding: 0;
        font-family: Arial;
        font-size: 14px;
      }
     
      #map {
        width: 100%;
        height: 750px;
      }
      #markerlist {
        margin-top: 15px;
      }

      #markerlist div{width:100%;}
      .title {
        border-bottom: 1px solid #e0ecff;
        overflow: hidden;
        width: 100%;
        cursor: pointer;
        padding: 2px 0;
        display: block;
        color: #000;
        text-decoration: none;
        padding: 5px;
      }
      .title:visited {
        color: #000;
      }
      .title:hover {
        background: #e0ecff;
      }
      #timetaken {
        color: #f00;
      }
      .info {
        width: 200px;
      }
      .info img {
        border: 0;
      }
      .info-body {
        width: 200px;
        height: 200px;
        line-height: 200px;
        margin: 2px 0;
        text-align: center;
        overflow: hidden;
      }
      .info-img {
        height: 145px;
        width: 200px;
      }
    </style>

<div class="container-fluid">
    <div class="row page-titles">
        
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Equipamentos</a></li>
                <li class="breadcrumb-item active">Lista de Ativos</li>
            </ol>
        </div>
    </div>
    <div class="row">
            <div id="panel" class="col-3 card">
                <h3>Lista Equipamentos</h3>
                <div>
                    <input type="checkbox" checked="checked" id="usegmm"/>
                    <span>Agurpar Equipamentos</span>
                </div>
                <div>
                    <br>
                    <div class="form-group">
                        <label class="text-label">Local</label>
                        <select style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="local" name="local" ></select>
                    </div>
                    <select style="display:none;" id="nummarkers">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100" selected="selected">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    </select>

                    <div style="display:none"><span>Time used: <span id="timetaken"></span> ms</span></div>
                </div>
                <div  id="markerlist">
                </div>
            </div>
            <div id="map-container" class="col-9">
            <div id="map" class="card"></div>
            </div>
    </div>
</div>

    
    
<script src="http://maps.googleapis.com/maps/api/js?&key=AIzaSyD-tPEm242_yeC6KgejZZCgt4ebvkkpBQE"></script>
<script type="text/javascript" src="js/markerclusterer.js"></script>
<script src="DB/data.json"></script>


<script>

     
function $$(element) {
  return document.getElementById(element);
} 

    var data_ ;
    var total_ativos;
    
    function get_lista_local(){
		var idCliente = $("#id_clientt").val();
		
		$.ajax({
		url:"includes/local/get_local",
		dataType:'JSON',
		method:"GET",
		data:{id:idCliente},
			success:function(response){
				var option = '<option disabled selected value="none"></option>'
				var i;
				var status = response.status;
				if(status == 'SUCCESS'){
					for (i = 0; i < response.data.length; i++) {
						option += '<option value="'+response.data[i].id+'">'+response.data[i].descricao+'</option>';
					}
					$('#local').html(option);	
				}
				
				$('#local').select2();	
				
				
			}
		}); 
   }
   get_local()
   function get_local(){
    $.ajax({
        url:  "includes/map/get_map_ativos",
        type : 'POST',
        dataType: 'JSON',
        data: {
        id: '0'
       
        },
        success: function(response){
            status = response.status;
            if(status == "SUCCESS") {
                data_ = response.list_ativos;
                total_ativos = response.total_ativos;
                google.maps.event.addDomListener(window, 'load', speedTest.init);
                get_lista_local()
                
            } 
        }
    }); 
 



var speedTest = {};

speedTest.pics = null;
speedTest.map = null;
speedTest.markerClusterer = null;
speedTest.markers = [];
speedTest.infoWindow = null;

speedTest.init = function() {
  var latlng = new google.maps.LatLng(-23.533773, -46.625290);
  var options = {
    'zoom': 5,
    'center': latlng,
    'mapTypeId': google.maps.MapTypeId.ROADMAP,
    'icon' : 'images/map/pin.png'
  };



  speedTest.map = new google.maps.Map($$('map'), options);
  //speedTest.map = new google.maps.Map(document.getElementById("mapa"), options);
  speedTest.pics = data_;

  console.log(speedTest.pics)
  
  var useGmm = document.getElementById('usegmm');
  google.maps.event.addDomListener(useGmm, 'click', speedTest.change);
  
  var numMarkers = document.getElementById('nummarkers');
  google.maps.event.addDomListener(numMarkers, 'change', speedTest.change);

  speedTest.infoWindow = new google.maps.InfoWindow();

  speedTest.showMarkers();
};

speedTest.showMarkers = function() {
  speedTest.markers = [];

  var type = 1;
  if ($$('usegmm').checked) {
    type = 0;
  }

  if (speedTest.markerClusterer) {
    speedTest.markerClusterer.clearMarkers();
  }

  var panel = $$('markerlist');
  panel.innerHTML = '';
  var numMarkers = $$('nummarkers').value;
  
  var a = 360.0 / total_ativos;
  var titleText = "";
  for (var i = 0; i < (total_ativos); i++) {
   
   
   
   titleText = speedTest.pics[i].descricao_ativo
   
   if (titleText === '') {
      titleText = 'No title';
    }
    
    
    
    var item = document.createElement('div');
    var image = document.createElement('img');
    var title = document.createElement('a');
    

    image.src = 'images/noimage.png';
    image.className = 'avatar';
    title.href = '#';
    title.className = 'title';
    title.innerHTML = titleText;
   

    item.appendChild(title);
    panel.appendChild(item);

    var choiceHTML = '<div class="">'+
                            '<div class="card mb-2">'+
                                '<div class="card-body p-3 d-flex justify-content-between align-items-center">'+
                                    '<a href="#" class="title"><h5 class="item">'+titleText+'</h5></a>'+
                                    '<div class="item">'+
                                        '<h2 class="text-lgreen">45°C</h2>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

    
    //$('#markerlist').append(choiceHTML);

     

    var newLat = speedTest.pics[i].lat_local + -.00004 * Math.cos((+a*i) / 180 * Math.PI);  
    var newLng = speedTest.pics[i].long_local + -.00004 * Math.sin((+a*i) / 180 * Math.PI);  

    //var latLng = new google.maps.LatLng(speedTest.pics[i].lat_local,speedTest.pics[i].long_local);
    var latLng = new google.maps.LatLng(newLat,newLng);


    
    var imageUrl = 'images/map/pin_4.png';
    var markerImage = new google.maps.MarkerImage(imageUrl,
    new google.maps.Size(35, 35));

    var marker = new google.maps.Marker({
      'position': latLng,
      'icon': markerImage
    });

    var fn = speedTest.markerClickFunction(speedTest.pics[i], latLng);
    google.maps.event.addListener(marker, 'click', fn);
    google.maps.event.addDomListener(title, 'click', fn);
    speedTest.markers.push(marker);
  }

  window.setTimeout(speedTest.time, 0);
};

speedTest.markerClickFunction = function(pic, latlng) {
  return function(e) {
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
      e.stopPropagation();
      e.preventDefault();
    }

    var title = pic.descricao_ativo;
    var url = pic.photo_url;
    var fileurl = pic.photo_file_url;
    var foto_ativo = pic.foto_ativo;
    var logo = 'images/empresa/logo.png';

    var infoHtml = '<div class="info"><h3>' + title +
      '</h3><div class="info-body">' +
      '<a href="' + url + '" target="_blank"><img src="' +
      foto_ativo + '" class="info-img"/></a></div>' +
      '<p>Localização:'+pic.descricao+'</p>'+
      '<a href=" target="_blank">' +
      '<img style="width:20px" src="'+logo+'"/></a><br/>' +
      '<a href="' + logo + '" target="_blank">' + pic.owner_name +
      '</a></div></div>';

    speedTest.infoWindow.setContent(infoHtml);
    speedTest.infoWindow.setPosition(latlng);
    speedTest.infoWindow.open(speedTest.map);
  };
};

speedTest.clear = function() {
  $$('timetaken').innerHTML = 'cleaning...';
  for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
    marker.setMap(null);
  }
};

speedTest.change = function() {
  speedTest.clear();
  speedTest.showMarkers();
};

speedTest.time = function() {
  $$('timetaken').innerHTML = 'timing...';
  var start = new Date();
  if ($$('usegmm').checked) {
    speedTest.markerClusterer = new MarkerClusterer(speedTest.map, speedTest.markers, {imagePath: 'images/map/m'});
  } else {
    for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
      marker.setMap(speedTest.map);
    }
  }

  var end = new Date();
  $$('timetaken').innerHTML = end - start;
};

}
$('#markerlist').slimscroll({
        position: "right",
        size: "5px",
        height: "550px",
        color: "#7F63F4"
    });

</script>
