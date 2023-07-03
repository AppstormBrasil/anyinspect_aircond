<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
    }
    
    $start_date =  date('d/m/Y', strtotime(' - 30 days')); 
	$end_date = date('d/m/Y', strtotime(' + 1 days')); 
?>

    <link rel="stylesheet" href="js/leaf/leaflet.css" />
    <script src="js/leaf/leaflet.js"></script>
    
<style>
    .time-filter li:first-child::before {background-color: #a660ff;}
    .time-filter li:last-child::before {background-color: #fda23f;}
    .ghbtns { position: relative; top: 4px; margin-left: 5px; }
     a {color: #0077ff; }
</style>

            <div class="container-fluid">
                <div class="row page-titles">
                   
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">Indicador</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="text-label">Data Incial<span style="color:red;">*</span></label>
                            <div class="input-group">
                                <input value="<?php echo $start_date?>" type="text" name="data_ini" id="data_ini" class="data form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="text-label">Data Final</label>
                            <div class="input-group">
                                <input value="<?php echo $end_date?>" type="text" id="data_fim" name="data_fim" class="data form-control" placeholder=""><button onclick="get_services_count_current()" type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
			   <div class="row">
                     <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 style="color: #aaaaaa;" class="mt-0 mb-1 text-light" id="valor_total_prod_mes_atual">0</h2><span class="">Total Ganho</span>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-1 text-light" id="total_gasto">0</h2><span class="">Total Gasto</span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-1 text-light" id="clients_visits_total">0</h2><span class="">Total Visita Clientes</span>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-12 col-xxl-12 col-xl-12 col-md-12 col-sm-12">
                        <div class="card widget-music-category" >
                            <div class="card-body">
                                <h4>Quantidade de atendimento por Mês</h4>
                                <div style="height:400px" id="ind_mes_ano" ></div>
                            </div>
                        </div>
                    </div>
                    

                </div> 

                <div class="row">

                   

                    <div class="col-lg-12 col-12 col-xxl-12 col-md-12 col-sm-12">							
                            <div class="card widget-music-category" >
                                <div class="card-body">
                                    <!--<h2 class="text-warning mb-4" id="servicos_pendentes">0</h2>-->
                                    <h4>Análise Semanal</h4>
                                    <div style="height:400px" id="ind_semanal" ></div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-12 col-12 col-xxl-12 col-md-12 col-sm-12">							
                            <div class="card widget-music-category" >
                                <div class="card-body">
                                    <!--<h2 class="text-warning mb-4" id="servicos_pendentes">0</h2>-->
                                    <h4>Visita de Clientes</h4>
                                    <div style="height:400px" id="client_vis" ></div>
                                </div>
                            </div>
                    </div>
                   
                    <div class="col-lg-12 col-12 col-xxl-12 col-md-12 col-sm-12">							
                            <div class="card widget-music-category" >
                                <div class="card-body">
                                    <!--<h2 class="text-warning mb-4" id="servicos_pendentes">0</h2>-->
                                    <h4>Numero por Serviços</h4>
                                    <div style="height:400px" id="ser_vis" ></div>
                                </div>
                            </div>
                    </div>
                    <!--<div class="col-lg-6 col-xxl-6 col-md-12 col-sm-12">
						
							<div class="card widget-music-category">
								<div class="card-body">
									<h2 class="text-dark mb-4" id="total_servico_prev"></h2>
									<h3 class="prev_month" ></h3>
                                    <div style="height:400px" id="services_count_prev" ></div>
								</div>
							</div>
					</div> -->

                    <h2 style="display:none;" id="total_servico_prev"></h2>
                    <h3 style="display:none;" class="prev_month" ></h3>
                    <div style="display:none;" id="services_count_prev" ></div>
                    
                    <div class="col-lg-12 col-xxl-12 col-md-12 col-sm-12">
							<div class="card widget-music-category">
								<div class="card-body">
									<h2 class="text-dark mb-4" id="total_servico_cur"></h2>
									<h3 class="cur_month"></h3>
                                    <div style="height:400px" id="services_count_cur" ></div>
								</div>
							</div>
						
					</div>
                    <div class="col-lg-12 col-12 col-xxl-12 col-md-12 col-sm-12">							
                            <div class="card widget-music-category" >
                                <div class="card-body">
                                    <!--<h2 class="text-warning mb-4" id="servicos_pendentes">0</h2>-->
                                    <h4>Região dos clientes</h4>
                                    <div style="height:500px" id="map" ></div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="js/highchart/highcharts.js"></script>
    <script src="js/highchart/series-label.js"></script>
    <script src="js/highchart/exporting.js"></script>
	<script src="js/highchart/data.js"></script>
	<script src="js/highchart/heatmap.js"></script>
	<script src="js/highchart/export-data.js"></script>
	<script src="js/highchart/accessibility.js"></script>
    <script src="js/leaflet-heat.js"></script>
    <script>

$('.data').mask('99/99/9999');
Highcharts.setOptions({
    colors: ["#555","#888","#333","#d0a37d","#464a53","#f8d999","#733f17","#935f37","#ad8a60","#cf965f","#bc6337","#d59f7b","#f2c280","#edc192","#f9d4a0","#fee3c6"]
});

  get_services_count_current();

  function get_services_count_current(){

    var data_ini = $('#data_ini').val();
    var data_fim = $('#data_fim').val();

    $.ajax({
				type: 'post',
				url: 'includes/indicadores/get_services_din',
				data: {data_ini:data_ini,data_fim:data_fim},
				dataType: 'json',
				success: function (result) { 
                    week_val = result.week_val;
                    valor_total_prod_mes_atual = result.valor_total_prod_mes_atual;
                    valor_total_prod_mes_prev = result.valor_total_prod_mes_prev;
                    compare_curs = result.compare_curs;
                    compare_prevs = result.compare_prevs;
                    get_area_clients = result.get_area_clients;
                    var data_valor = result.data_valor;
                    var data_count = result.data_count;
                    var data_valor_taxi = result.data_valor_taxi;
                    var data_count_taxi = result.data_count_taxi;
                    var clients_visits = result.clients_visits;
                    var pet_visits = result.pet_visits;
                    var serv_visits = result.ser_visits;
                    var get_total_gasto = result.get_total_gasto;
                    var clients_visits_total = result.clients_visits_total;
                    $('#valor_total_prev').html('R$' + valor_total_prod_mes_prev);
                    $('#valor_total_prod_mes_atual').html('R$' + valor_total_prod_mes_atual);
                    $('.cur_month').html(result.cur_month);
                    $('.prev_month').html(result.prev_month);
                    $('#total_servico_cur').html(result.total_servico_cur);
                    $('#total_servico_prev').html(result.total_servico_prev);
                    $('#pmonth').html(result.prev_month);
                    $('#pmonthtot').html('R$' + valor_total_prod_mes_prev);
                    $('#nmonth').html(result.cur_month);
                    $('#nmonthtot').html('R$' + valor_total_prod_mes_atual);
                    $('#total_gasto').html('R$' + get_total_gasto);
                    $('#clients_visits_total').html(clients_visits_total);
                    setTimeout(function(){ 
                        service_month_year(data_count,data_valor);
                        get_clients_location();
                    }, 300);

                    function get_clients_location(){
                        var map = L.map('map').setView([-23.161590, -45.911560], 15);
                        L.marker([-23.161590, -45.911560]).addTo(map)
                        .bindPopup('Minha localização.<br>')
                        .openPopup();

                        //var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        var tiles =   L.tileLayer.grayscale('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                        }).addTo(map);


                        get_area_clients = get_area_clients.map(function (p) { return [p[0], p[1]]; });

                        var heat = L.heatLayer(get_area_clients).addTo(map); 
                    }

                    L.TileLayer.Grayscale = L.TileLayer.extend({
                        options: {
                            quotaRed: 21,
                            quotaGreen: 71,
                            quotaBlue: 8,
                            quotaDividerTune: 0,
                            quotaDivider: function() {
                                return this.quotaRed + this.quotaGreen + this.quotaBlue + this.quotaDividerTune;
                            }
                        },

                        initialize: function (url, options) {
                            options = options || {}
                            options.crossOrigin = true;
                            L.TileLayer.prototype.initialize.call(this, url, options);

                            this.on('tileload', function(e) {
                                this._makeGrayscale(e.tile);
                            });
                        },

                        _createTile: function () {
                            var tile = L.TileLayer.prototype._createTile.call(this);
                            tile.crossOrigin = "Anonymous";
                            return tile;
                        },

                        _makeGrayscale: function (img) {
                            if (img.getAttribute('data-grayscaled'))
                                return;

                                    img.crossOrigin = '';
                            var canvas = document.createElement("canvas");
                            canvas.width = img.width;
                            canvas.height = img.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(img, 0, 0);

                            var imgd = ctx.getImageData(0, 0, canvas.width, canvas.height);
                            var pix = imgd.data;
                            for (var i = 0, n = pix.length; i < n; i += 4) {
                                            pix[i] = pix[i + 1] = pix[i + 2] = (this.options.quotaRed * pix[i] + this.options.quotaGreen * pix[i + 1] + this.options.quotaBlue * pix[i + 2]) / this.options.quotaDivider();
                            }
                            ctx.putImageData(imgd, 0, 0);
                            img.setAttribute('data-grayscaled', true);
                            img.src = canvas.toDataURL();
                        }
                    });

                    L.tileLayer.grayscale = function (url, options) {
                        return new L.TileLayer.Grayscale(url, options);
                    };
                    
                   

                    function clients_visitors(){
                        Highcharts.chart('client_vis', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        credits: {
                            enabled: false
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif',
                                    
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Nº de vistas por clientes'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Número de visítas: <b>{point.y} visitas</b>'
                        },
                        series: [{
                            name: 'Clientes',
                            data: clients_visits,
                            color: "#222",
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#fff',
                                align: 'right',
                                format: '{point.y}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif',
                                    textShadow: false 
                                }
                            }
                        }]
                    });
                    }

                    clients_visitors();
                    
                    function pet_visitors(){
                        Highcharts.chart('pet_vis', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        credits: {
                            enabled: false
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif',
                                    
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Nº de vistas por Pets'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Número de visítas: <b>{point.y} visitas</b>'
                        },
                        series: [{
                            name: 'Pets',
                            data: pet_visits,
                            color: "#fefe4b",
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#222',
                                align: 'right',
                                format: '{point.y}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif',
                                    textShadow: false 
                                }
                            }
                        }]
                    });
                    }

                    //pet_visitors();
                    
                    function serv_visitors(){
                        Highcharts.chart('ser_vis', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        credits: {
                            enabled: false
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'sans-serif',
                                    
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Nº de Serviços'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Número de visítas: <b>{point.y} visitas</b>'
                        },
                        series: [{
                            name: 'Serviços',
                            data: serv_visits,
                            color: "#888",
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#fff',
                                align: 'right',
                                format: '{point.y}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif',
                                    textShadow: false 
                                }
                            }
                        }]
                    });
                    }

                    serv_visitors();
                    // GET MONTH COMPARE
                    function compare_month(){
                        $('#ind_mes').highcharts({
                            chart: {
                                type: 'spline',
                                zoomType: 'xy',
                                animation: {
                                    enabled: true
                                }
                            },
                            title: {
                                text: '',
                                x: -20 //center
                            },
                            xAxis: {
                                categories: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
                            },
                            yAxis: {
                                title: {
                                    text: ''
                                },
                                            tickInterval: 1,
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#828282'
                                }]
                            },       tooltip:{
                                    formatter:function(){
                                        return  this.y + ' Atendimentos'
                                    }
                                },
                        
                            series: [{
                                //type: 'line',
                                name: 'Mês de ' + result.cur_month,
                                data: compare_curs,
                                color: "#828282"
                            },{
                                //type: 'line',
                                name: 'Mês de ' + result.prev_month,
                                color: "#83c9d6",
                                data: compare_prevs
                            }]
                        });
                    
                    }
                    compare_month();
                    function compare_service(){
                        control = false
                        last_click = -1
                        Highcharts.chart('services_count_cur', {
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie',
                                },
                                title: {
                                    text: 'Quantidade por tipo de Serviço'
                                },
                                credits: {
                                    enabled: false
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.y}</b>'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: {
                                            enabled: true,
                                            format: '<b>{point.name}</b>: {point.y}'
                                        },
                                        showInLegend: true
                                    },
                                    series: {
                                        events: {
                                            click: function (event) {
                                                if(control == true && last_click == event.point.x){
                                                    control = false
                                                }else{
                                                    console.log(event.point);
                                                    control = true
                                                    last_click  = event.point.x
                                                }
                                                //CRIA Gráfico 2 this.name + ' clicked\n' + event.point.x
                                            }
                                        }
                                    }
                                },
                                series: [{
                                    name: "Quantidade por Serviço",
                                    data: result.data_current
                                }]					
                        });

                        // LAST MONTH DATA

                        Highcharts.chart('services_count_prev', {
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie',
                                },
                                title: {
                                    text: 'Quantidade por tipo de Serviço'
                                },
                                credits: {
                                    enabled: false
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.y}</b>'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: {
                                            enabled: true,
                                            format: '<b>{point.name}</b>: {point.y}'
                                        },
                                        showInLegend: true
                                    },
                                    series: {
                                        events: {
                                            click: function (event) {
                                                if(control == true && last_click == event.point.x){
                                                    control = false
                                                }else{
                                                    console.log(event.point);
                                                         control = true
                                                    last_click  = event.point.x
                                                }
                                            }
                                        }
                                    }
                                },
                                series: [{
                                    name: "Quantidade por Serviço",
                                    data: result.data_prev
                                }]					
                        });

                    }
                    compare_service()

                function get_products(){
                    // LAST MONTH PRODUTOS VALOR
                    
                    Highcharts.chart('dataprev_prod', {
							chart: {
								plotBackgroundColor: null,
								plotBorderWidth: null,
								plotShadow: false,
								type: 'pie',
							},
							title: {
								text: 'Quantidade por tipo de Serviço'
                            },
                            credits: {
                                enabled: false
                            },
							tooltip: {
								//pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                pointFormat: '{series.name}: <b>R${point.y}</b>'
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>:R${point.y}'
                                    },
									showInLegend: true
								},
								series: {
									
								}
							},
							series: [{
								name: "Produto",
								data: result.dataprev_prod
							}]					
					});
                    
                    // CURRENT MONTH DATA
                    Highcharts.chart('datacur_prod', {
							chart: {
								plotBackgroundColor: null,
								plotBorderWidth: null,
								plotShadow: false,
								type: 'pie',

							},
							title: {
								text: 'Quantidade por tipo de Serviço'
                            },
                            credits: {
                                enabled: false
                            },
							tooltip: {
                                pointFormat: '{series.name}: <b>{point.y}</b>'
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.y}'
                                    },
									showInLegend: true
								},
								series: {
									events: {
										click: function (event) {
											if(control == true && last_click == event.point.x){
												control = false
											}else{
												control = true
												last_click  = event.point.x
											}
											//CRIA Gráfico 2 this.name + ' clicked\n' + event.point.x
										}
									}
								}
							},
							series: [{
								name: "Produto",
								data: result.datacur_prod
							}]					
					});


                }
                    // Grafico Semanal

                    function getPointCategoryName(point, dimension) {
						var series = point.series,
							isY = dimension === 'y',
							axis = series[isY ? 'yAxis' : 'xAxis'];
						return axis.categories[point[isY ? 'y' : 'x']];
					}

                   
					Highcharts.chart('ind_semanal', {
						chart: {
							type: 'heatmap',
							marginTop: 40,
							marginBottom: 80,
							plotBorderWidth: 1
						},
						title: {
							text: ''
                        },
                        credits: {
                            enabled: false
                        },
						xAxis: {
							categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro' , 'Novembro' , 'Dezembro']
						},
						yAxis: {
							categories: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
							title: null,
							reversed: true
						},
						accessibility: {
							point: {
								descriptionFormatter: function (point) {
									var ix = point.index + 1,
										xName = getPointCategoryName(point, 'x'),
										yName = getPointCategoryName(point, 'y'),
										val = point.value;
									return ix + '. ' + xName + ' Serviços ' + yName + ', ' + val + '.';
								}
							}
						},
						colorAxis: {
							min: 0,
							minColor: '#FFFFFF',
							maxColor: Highcharts.getOptions().colors[0]
						},
						legend: {
							align: 'right',
							layout: 'vertical',
							margin: 0,
							verticalAlign: 'top',
							y: 5,
							symbolHeight: 280
						},
						tooltip: {
							formatter: function () {
								return '<b>' + getPointCategoryName(this.point, 'x') + '</b>  <br><b>' +
									this.point.value + '</b> Serviços  <br><b>' + getPointCategoryName(this.point, 'y') + '</b>';
							}
						},
						series: [{
							name: 'Nº de Serviços',
							borderWidth: 1,
							data:week_val,
							dataLabels: {
								enabled: true,
								color: '#fff',
                                textShadow: true ,
                                style: {
                                    textOutline: false,
                                    textShadow: false 
                                }
							}
						}],
						responsive: {
							rules: [{
								condition: {
									maxWidth: 500
								},
								chartOptions: {
									yAxis: {
										labels: {
											formatter: function () {
												return this.value.charAt(0);
											}
										}
									}
								}
							}]
						}

                    });
                    
                    function service_month_year(data_count,data_valor){
                        $('#ind_mes_ano').highcharts({
                            chart: {
                                type: 'column',
                                zoomType: 'xy',
                                animation: {
                                    enabled: true
                                }
                            },
                            title: {
                                text: '',
                                x: -20 //center
                            },
                            credits: {
                                enabled: false
                            },
                            xAxis: {
                                categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
                            },
                            yAxis: {
                                title: {
                                    text: ''
                                },
                                            tickInterval: 1,
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#3ab9da'
                                }]
                            },       tooltip:{
                                    formatter:function(){
                                        the_valor = data_valor[this.point.index];
                                        return   this.key + ' : <b>' + this.y + ' </b> Atendimentos <br> R$' + '<b>'+the_valor+'</b>';
                                    }
                                },
                        
                            series: [{
                                name: 'Nº de Atendimentos',
                                data: data_count,
                            }]
                        });
                    }

                    function service_month_taxi(data_count_taxi,data_valor_taxi){
                        $('#ind_mes_taxi').highcharts({
                            chart: {
                                type: 'column',
                                zoomType: 'xy',
                                animation: {
                                    enabled: true
                                }
                            },
                            title: {
                                text: '',
                                x: -20 //center
                            },
                            credits: {
                                enabled: false
                            },
                            xAxis: {
                                categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
                            },
                            yAxis: {
                                title: {
                                    text: ''
                                },
                                //tickInterval: 1,
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#828282'
                                }]
                            },       tooltip:{
                                    formatter:function(){
                                        the_valor = data_valor_taxi[this.point.index];
                                        return   this.key + ' : <b>' + this.y + ' </b> Atendimentos <br> R$' + '<b>'+the_valor+'</b>';
                                    }
                                },
                        
                            series: [{
                                name: 'Nº de Atendimentos',
                                data: data_count_taxi,
                                color: '#fefe4b'
                            }]
                        });
                    }

					
				},
				error: function (result) {
					toastr.error('Erro ao realizar o download dos dados, atualize a página.', 'Erro de download');
				}
			}); 
  }
    $('.track-list').slimscroll({
        position: "right",
        size: "5px",
        height: "268px",
        color: "#7F63F4"
    });
    </script>
