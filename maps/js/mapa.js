var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {	
	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
	
    var options = {
        zoom: 5,
		center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {

	mcOptions = {
		styles: [{
			height: 53,
			url: "https://github.com/googlemaps/js-marker-clusterer/tree/gh-pages/images/m1.png",
			width: 53
		  },
		  {
			height: 56,
			url: "https://github.com/googlemaps/js-marker-clusterer/tree/gh-pages/images/m2.png",
			width: 56
		  },
		  {
			height: 66,
			url: "https://github.com/googlemaps/js-marker-clusterer/tree/gh-pages/images/m3.png",
			width: 66
		  },
		  {
			height: 78,
			url: "https://github.com/googlemaps/js-marker-clusterer/tree/gh-pages/images/m4.png",
			width: 78
		  },
		  {
			height: 90,
			url: "https://github.com/googlemaps/js-marker-clusterer/tree/gh-pages/images/m5.png",
			width: 90
		  }
		]
	  }
	
	$.getJSON('js/pontos.json', function(pontos) {
		
		var latlngbounds = new google.maps.LatLngBounds();
		
		$.each(pontos, function(index, ponto) {
			
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
				title: "Meu ponto personalizado! :-D",
				icon: 'img/marcador.png'
			});
			
			var myOptions = {
				content: "<p>" + ponto.Descricao + "</p>",
				pixelOffset: new google.maps.Size(-150, 0)
        	};

			infoBox[ponto.Id] = new InfoBox(myOptions);
			infoBox[ponto.Id].marker = marker;
			
			infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
				abrirInfoBox(ponto.Id, marker);
			});
			
			markers.push(marker);
			
			latlngbounds.extend(marker.position);
			
		});
		
		var markerCluster = new MarkerClusterer(map, markers , mcOptions);
		
		map.fitBounds(latlngbounds);
		
	});
	
}

carregarPontos();