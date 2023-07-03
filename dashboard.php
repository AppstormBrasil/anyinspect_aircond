<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
    
</head>
<style>

.select2-container .select2-selection--single {height:45px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 43px!important;
    font-size: 16px;}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #ddd!important;
    color: #020202!important;
    height: 42px!important;
    line-height: 34px!important;
}
</style>
<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include('includes/common/nav-header.php'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->
	
        <!--**********************************
            Header start
        ***********************************-->
		<?php include('includes/common/header.php'); ?>
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('includes/common/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">

                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="card">
                        <div class="card-body stat-widget-seven gradient-m1">
                            <div class="media align-items-center ml-3">
                                <img class="mr-5" src="assets/images/icons/24.png" alt="">
                                <div class="media-body">
                                <a href="index" ><h2 class="mt-0 mb-2">Agendazy</h2></a>
                                    <h5 class="text-uppercase">Gerenciar Pet Shop</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="card">
                            <div class="card-body stat-widget-seven gradient-m2">
                                <a href="lista-retornos">
									<div class="media align-items-center ml-3">
										<img class="mr-5" src="assets/images/icons/26.png" alt="">
										<div class="media-body">
											<h2 class="mt-0 mb-2"><span id="clientes_30dias"></span></h2>
											<h5 class="text-uppercase" id="media_serviços_por_dia">Clientes com mais de 30 dias sem retorno</h5>
										</div>
									</div>
								</a>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-12">
						<h4>Os dados a seguir são referentes a data de <b><span id="date_hoje"></span></b></h4>
					</div>
					
					<div class="col-lg-3 col-6 col-xxl-3">
						<a href="calendario">
							<div class="card widget-music-category">
								<div class="card-body">
									<h2 class="text-primary mb-4" id="servicos_hoje"></h2>
									<h4>Total de Serviços<!--<span id="servicos_todos">0</span>--></h4>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-6 col-xxl-3">
						<a href="calendario">
							<div class="card widget-music-category">
								<div class="card-body">
									<h2 class="text-primary mb-4" id="servicos_pendentes">0</h2>
									<h4>Serviços Pendetes hoje</h4>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-6 col-xxl-3">
						<a href="calendario">
							<div class="card widget-music-category">
								<div class="card-body">
									<h2 class="text-primary mb-4" id="servicos_finalizados">0</h2>
									<h4>Serviços Concluídos</h4>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-6 col-xxl-3">
						<a href="calendario">
							<div class="card widget-music-category">
								<div class="card-body">
									<h2 class="text-primary mb-4" id="servicos_em_andamento">0</h2>
									<h4>Serviços em Andamento</h4>
								</div>
							</div>
						</a>
					</div>
				</div>
				
				  <?php 
                        $user_level = get_user_level();
				
					if($user_level == 'a'){ ?>
						<div class="row">
							<div class="col-xl-3 col-sm-6">
								<div class="card stat-widget-six">
									<div class="card-body">
										<div class="media">
											<div class="media-body">
											<a href="cadastro-cliente"><h4 class="mt-0 mb-1">Novo Cliente</h4></a>
												</div>
											<a href="cadastro-cliente" >
												<div class="icon bg-primary">
													<span><i class="fa fa-user-plus"></i></span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-6">
								<div class="card stat-widget-six">
									<div class="card-body">
										<div class="media">
											<div class="media-body">
											<a href="cadastro-servico"><h4 class="mt-0 mb-1">Novo Serviço</h4></a>
											</div>
											<a href="cadastro-serico" >
												<div class="icon bg-primary">
													<span><i class="fa fa-plus"></i></span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-6">
								<div class="card stat-widget-six">
									<div class="card-body">
										<div class="media">
											<div class="media-body">
											   <a href="cadastro-produto"><h4 class="mt-0 mb-1">Novo Produto</h4></a>
											</div>
											 <a href="cadastro-produto" >
												<div class="icon bg-primary">
													<span><i class="fa fa-plus"></i></span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-sm-6">
								<div class="card stat-widget-six">
									<div class="card-body">
										<div class="media">
											<div class="media-body">
												<a href="calendario"><h4 href="calendario" class="mt-0 mb-1">Calendario</h4></a>
												</div>
											<a href="calendario" >
												<div class="icon bg-primary">
													<span><i class="fa fa-calendar"></i></span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							
						<?php } ?>
                </div>
				
				<div class="row" >
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header pb-4">
                                <h4 class="card-title mt-2"> Atividades para Hoje</h4>
                              
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive">
                                    <table class="table recent-order-list-table table-responsive-fix-big">
                                        <thead>
                                            <tr style="background: #efefef;">
                                                <th>#No</th>
                                                <th>Serviço</th>
                                                <th>Pet</th>
                                                <th>Horário pra Começar</th>
                                                <th>Valor</th>
                                                <th>Funcionário</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="opens_box">
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <!-- Modal to Event Details -->
        <div id="calendarModal" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" style="background: #3ab9da;">
                    <h2 style="color: #fff;">Detalhes do Agendamento</h2> <button type="button" class="close" data-dismiss="modal" style="color: #fff;opacity: 1;">×</button>
                    </div>
                    <div id="modalBody" class="modal-body">
                    <div id="modalWhen" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID"/>
                    <div class="modal-footer">
                    <button id="comecar" style="display:none;" onclick="alteraStatus('comecar')" class="btn btn-start">Iniciar Serviço</button>
                    <button id="finalizar" style="display:none;" onclick="alteraStatus('finalizar')" class="btn btn-close">Finalizar Serviço</button>
                    <button type="submit" class="btn btn-danger" id="deleteButton">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--**********************************
            Footer start
        ***********************************-->
       <?php include('includes/common/footer.php'); ?>
        <!--**********************************
            Footer end
        ***********************************-->

        
        <!--**********************************
            Right sidebar start
        ***********************************-->
        <?php //include('includes/common/right-sidebar.php'); ?>
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
	<script src="includes/dashboard/get_index_valores.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="js/jquery.mask.js"></script>

    <script>
        function get_lista_pet(){
	
	var idCliente = $("#id_page").val();
	
	$.ajax({
     url:"includes/dashboard/get_open_service",
     method:"GET",
     dataType:'JSON',
     data:{id:idCliente},
		success:function(response){

		var status = response.status;
		var lista_pet = response.data;
        var lista_pets2 , lista_pets = "";
        var status_type = "";
		
	  if(status == "SUCCESS") {
		
		
		for(var a = 0; a < lista_pet.length; a++){
			client_id = lista_pet[a].client_id;
			client_name = lista_pet[a].client_name;
			client_pic = lista_pet[a].client_pic;
			pet_name = lista_pet[a].pet_name;
			price = lista_pet[a].price;
			short_dec = lista_pet[a].short_dec;
			start_date = lista_pet[a].start_date;
            status = lista_pet[a].status;
            foto = lista_pet[a].foto;
            id_pet = lista_pet[a].id_pet;
            foto_pet = lista_pet[a].foto_pet;
            id_service = lista_pet[a].id_service;
            textColor = lista_pet[a].textColor;
            background = lista_pet[a].background;
            foto_funcionario = lista_pet[a].foto_funcionario;
            id_funcionario = lista_pet[a].id_funcionario;
            nome_funcionario = lista_pet[a].nome_funcionario;

            foto_pet = foto_pet +'?' + (new Date()).getTime();
            foto_funcionario = foto_funcionario +'?' + (new Date()).getTime();
            
            
            /*if(status == 'Pendente'){
                status_type = 'label-light';
                color = '#222';
            } else if(status == 'Em Andamento') {
                status_type = 'label-warning';
                color = '#fff';
            } else {
                status_type = 'label-success';
                color = '#fff';
            } */
            
            lista_pets2 += `<tr>
                <td>`+id_service+`</td>
                <td class="text">`+short_dec+`</td>
                <td><a class="single_link" href="pet-`+id_pet+`"><img class="avatar_table" src="`+foto_pet+`" /> <span class="text-pale-sky">`+pet_name+`</a> </span>
                </td>
                <td>`+start_date+`</td>
                <td><span class="text-pale-sky">`+price+`</span></td>
                <td><a target="_blank" class="single_link" href="funcionario-`+id_funcionario+`"><img class="avatar_table" src="`+foto_funcionario+`" /> <span class="text-pale-sky">`+nome_funcionario+`</span></a>              
                </td>
                <td><a style="cursor:pointer;" class="start_servico" name="`+id_service+`" ><span style="background:`+background+`;color:`+textColor+`" class="label label label-rounded ">`+status+`</a></span>
                </td>
            </tr>`;

			}
      		$('#opens_box').html(lista_pets2);
            
              
            
            $(".start_servico").click(function(){
                id = this.name;
                $.ajax({
                    url:"includes/calendario/get_eventos_single",
                    method:"POST",
                    dataType:'JSON',
                    data:{id:id},
                        success:function(response){

                        var event = response[0];
                       
                        
                        var id, id_client , start , end , status_, title

                        id = event.id;
                        id_client = event.id_client;
                        title = event.title;
                        start = event.start;
                        end = event.end;
                        status_ = event.status_;
                        br_start = event.br_start;
                        termina = event.termina;
                        name_client = event.name_client;
                        preco = event.preco;
                        started_at = event.started_at;
                        ended_at = event.ended_at;
                        quem_executou = event.quem_executou;
                        produtos = event.produtos;
                        foto_funcionario = event.foto_funcionario;
                        nome_funcionario = event.nome_funcionario;
                        id_funcionario = event.id_funcionario;

                        if(produtos == false){
                            produtos = "-";
                        }

                        if(nome_funcionario != null){
                            nome_funcionario = nome_funcionario
                        } else {
                            nome_funcionario = 'N/A';
                        }

                        pet_taxi = event.pet_taxi;
                        endereco = event.endereco;
                        foto_cliente = event.foto_cliente;

                        if(pet_taxi == 1){
                            tem_taxi = 'Sim';
                            end_taxi ='<span style="background: #d8d8d8;padding: 3px;">'+endereco+'</span>'
                        } else {
                            tem_taxi = 'Não';
                            end_taxi = '';
                        }

                        termina = termina.split(" ");
                        termina_hora = termina[1];
                        termina_data = termina[0];

                        termina_data = termina_data.split("-");
                        termina_data = (termina_data[2] + "/" + termina_data[1] + "/" + termina_data[0]);
                        termina_final = termina_data + " " + termina_hora;

                        started_at = started_at.split(" ");
                        started_hora = started_at[1];
                        started_data = started_at[0];

                        started_data = started_data.split("-");
                        started_data = (started_data[2] + "/" + started_data[1] + "/" + started_data[0]);
                        started_data_final = started_data + " " + started_hora;

                        ended_at = ended_at.split(" ");
                        ended_hora = ended_at[1];
                        ended_data = ended_at[0];

                        ended_data = ended_data.split("-");
                        ended_data = (ended_data[2] + "/" + ended_data[1] + "/" + ended_data[0]);
                        ended_final = ended_data + " " + ended_hora;

                        br_start_dummy = br_start.split(" ");
                        br_start_hora = br_start_dummy[1];


                        if(status_ == "Pendente"){
                            $('#comecar').show();
                            $('#finalizar').hide();
                        }
                        else if(status_ == "Em Andamento"){
                            $('#finalizar').show();
                            $('#comecar').hide();
                        }
                        else{
                            $('#comecar').hide();
                            $('#finalizar').hide();
                        }

                        if(quem_executou == null){
                            quem_executou = "";
                        }

                            var event_content = "";
                            
                            event_content = `<div class="profile-personal-info">
                                <h3 class="mb-5"><strong>Agendamento</strong><span style="float:right;font-size:20px;"><strong>`+br_start+`</strong></span></h3>
                                <span><h1 style="text-align: center;margin-bottom: 45px;">`+title+`</h1></span>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Cliente</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><a target="_blank" class="single_link" href="cliente-`+id_client+`"><span><img class="avatar_table" src="`+foto_cliente+`" alt="Avatar" height="30" width="30"></a><span>` +name_client+`</span></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Funcionário</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><a target="_blank" class="single_link" href="cliente-`+id_funcionario+`"><span><img class="avatar_table" src="`+foto_funcionario+`" alt="Avatar" height="30" width="30"></a><span>` +nome_funcionario+`</span></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Serviço</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>`+title+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Hora Inicio</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span style="font-weight: 600;">`+br_start_hora+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Hora Fim</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span style="font-weight: 600;">`+termina_hora+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Valor</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span style="font-weight: 600;">R$`+preco+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Começou ás</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>`+started_data_final+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Terminou ás</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>`+ended_final+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Executado por:</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>`+quem_executou+`</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-3">
                                        <h5 class="f-w-500"><strong>Peti Taxi:</strong> <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><strong>`+tem_taxi+`: </strong> </span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    
                                    <div class="col-12"><span>`+end_taxi+`</span>
                                    </div>
                                </div>
                            </div>`


                            event_content2 = '<div class="body user_activity" style="text-align: left;">'+
                                                '<div class="sl-content">'+
                                                    '<h2>Agendamento</h2>'+
                                                '</div>'+
                                            '<br>'+
                                            '<div class="streamline b-accent">'+	
                                            '<div class="sl-item">'+
                                                    '<div class="sl-content">'+
                                                        '<h4 class="m-b-0">Cliente</h4>'+
                                                        '<h5>'+name_client+'</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<br>'+
                                            '<div class="sl-item">'+
                                                    '<div class="sl-content">'+
                                                        '<h4 class="m-b-0">Serviços &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; Produtos Utilizados</h4>'+
                                                        '<h5>'+title+' &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; ' + produtos + '</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<br>'+
                                            '<div class="streamline b-accent">'+
                                            '<div class="sl-item">'+
                                                    '<div class="sl-content">'+
                                                        '<h4 class="m-b-0">Começa em &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; Começou em</h4>'+
                                                        '<h5>'+br_start+'&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'+ started_data_final +'</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<br>'+
                                            '<div class="streamline b-accent">'+
                                            '<div class="sl-item">'+
                                                    '<div class="sl-content">'+
                                                        '<div style="text-align:left;"><h5 class="m-b-0">Termina em &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; Terminou em</h5></div>'+
                                                        '<h5>'+termina_final +'&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'+ ended_final +'</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                                
                                            '</div>'+
                                            '<br>'+
                                            '<div class="streamline b-accent">'+
                                                '<div class="sl-item">'+
                                                    '<div class="sl-content">'+
                                                        '<h4 class="m-b-0">Preço:</h4>'+
                                                        '<h5>'+preco+'</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            
                                            '<br>'+
                                            
                                            '<div id="quem_executou" class="streamline b-accent">'+
                                                '<div class="sl-item">'+
                                                    '<div class="sl-content">'+
                                                        '<h4 class="m-b-0">Quem Executou:</h4>'+
                                                        '<h5>'+quem_executou+'</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="row mb-4">'+
                                                '<div class="col-3">'+
                                                    '<h5 class="f-w-500"><strong>Peti Taxi:</strong> <span class="pull-right">:</span></h5>'+
                                                '</div>'+
                                                '<div class="col-9"><span><strong>'+tem_taxi+': </strong>'+end_taxi+'</span>'+
                                            '</div>'+
                                            '</div>'+
                                            
                                        '</div></div>';
                            
                            endtime = event.end;
                            starttime = event.start;
                            var mywhen = starttime + ' - ' + endtime;
                            $('#modalTitle').html(title);
                            $('#modalWhen').html(event_content);
                            $('#eventID').val(id);
                            $('#calendarModal').modal();
                    }
                    });
            });

			
    	} else {
            $('#opens_box').html('');  
        }
    }
    }); 

  }
  
  get_lista_pet();

  function alteraStatus(acao){ // add event
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#eventID').val();
         
		toastr.options = {"positionClass": "toast-top-full-width"}
       
       $.ajax({
        url: "includes/calendario/alteraStatus",
       data: {
        eventID:eventID,
        acao:acao
       },
            type: "POST",
            dataType:'JSON',
			success: function(response) {
			status = response.status;
			status_message = response.status_txt;
			
			if(acao == "finalizar"){
				fullname = response.fullname;
				foto = response.foto;

				imagem = foto +'?' + (new Date()).getTime()
				
				zap = response.zap;
				zap = zap.replace("(", "");
				zap = zap.replace(")", "");
				zap = zap.replace("-", "");
				zap = zap.replace(" ", "");

				toastr.success("Serviço finalizado com sucesso!", 'Sucesso');

				$('#calendarModal').modal('hide');
				information = '<div class="user-info">'+
                        '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
							'<h4><strong>'+fullname+'</strong></h4>'+
							'<h5>O serviço foi finalizado! Deseja enviar uma mensagem no whatsapp do cliente?</h5>'+
							'<h5>Telefone Cliente</h5>'+
							'<span><input class="phone" value="'+response.zap+'" type="text" style="margin-bottom: 10px;width:100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="phone_message_cliente" name="phone_message_cliente"></input></span>'+
							'<br><span><textarea type="text" id="zap_message" name="zap_message" class="form-control" >Querido(a), seu pet está pronto! Espero que goste do nosso serviço, muito obrigada pela confiança!</textarea></span>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, Enviar!',
					cancelButtonText: 'Não Obrigado',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {
						zap_message = $('#zap_message').val();
						phone_message_cliente = $('#phone_message_cliente').val();
						phone_message_cliente = phone_message_cliente.replace("(", "");
						phone_message_cliente = phone_message_cliente.replace(")", "");
						phone_message_cliente = phone_message_cliente.replace("-", "");
						phone_message_cliente = phone_message_cliente.replace(" ", "");
						
						if(zap_message != ''){
							
							if(phone_message_cliente != ''){
								window.open('https://api.whatsapp.com/send?phone=55'+phone_message_cliente+'&text='+zap_message+' ','_blank',true);
							} else {
								toastr.error('Erro!', "Oops, Digite o telefone do cliente!");
								$('#calendarModal').modal('hide');
							}
							
						} else {
							toastr.error('Erro!', "Oops, Digite uma mensagem para o cliente!");
							$('#calendarModal').modal('hide');
						}
						

						toastr.success("Serviço finalizado com sucesso! Redirecionando...", 'Sucesso');
						$('#calendarModal').modal('hide');
					
					},
					allowOutsideClick: false			  
				});
			}
			else{
                toastr.success("Serviço iniciado com sucesso!", 'Sucesso');
                $('#calendarModal').modal('hide');
            }
            
            get_lista_pet();
           }
       });
       
   }

   $('#deleteButton').on('click', function(e){ // delete event clicked
       // We don't want this to act as a link so cancel the link action
       e.preventDefault();
       doDelete(); //send data to delete function
   });
   
   function doDelete(){  // delete event 
       toastr.options = {"positionClass": "toast-top-full-width"}
       $("#calendarModal").modal('hide');
       var eventID = $('#eventID').val();

       $.ajax({
           url: 'includes/controller/pet/delete_event',
           type: "POST",
           dataType:'JSON',
           data: {
                IdEvento:eventID
           },
          
           success: function(response) {					
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                if(status == "SUCCESS") {
                      setTimeout(function(){
                        $(".loading").hide();
                        toastr.success(status_txt, 'Sucesso');
                            get_lista_pet();
                      }, 100);

                  } else {
                           $(".loading").hide();
                          
                           toastr.error(status_txt, 'Error');
                  }
               
           }
       });
   }
 
    
    </script>


</body>

</html>