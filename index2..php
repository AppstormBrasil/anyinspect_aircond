<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/datepicker/jquery.datetimepicker.min.css">

    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
    
</head>
<style>
.select2-container .select2-selection--single {height:45px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 43px!important;font-size: 16px;}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}

.widget-music-category h2 {
    font-size: 3.5rem;
    font-weight: 700;
}

@keyframes blink {  
  0% { color: black; }
  50% { color:red; }
  100% { color:#E91E63; }
}
@-webkit-keyframes blink {
  0% { color: black; }
  50% { color:red; }
  100% { color:#E91E63; }
}
.blink {
  -webkit-animation: blink 1s linear infinite;
  -moz-animation: blink 1s linear infinite;
  animation: blink 1s linear infinite;
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


                   <!--<div class="col-lg-2" style="padding-left: 0px;padding-right: 0px;">
                  
                        <div class="col-lg-12">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#009688 0%,#5ea29c 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center ">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_hoje">0</h2>
                                            <h5 class=" text-white">Atividades</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					
                        <div class="col-lg-12">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#1e3547 0%,#3b5b75 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_pendentes">0</h2>
                                            <h5 class=" text-white">Pendentes</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					
                        <div class="col-lg-12">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#009688 0%,#5ea29c 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center ">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_em_andamento">0</h2>
                                            <h5 class=" text-white">Andamento</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					
                        <div class="col-lg-12">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#1e3547 0%,#3b5b75 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center ">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_finalizados">0</h2>
                                            <h5 class=" text-white">Finalizadas</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div> -->
				
					
            
				  
                <div class="col-lg-12">

                <div class="row">
                    
                        <div class="col-lg-3">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#009688 0%,#5ea29c 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center ">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_hojes">Nova Atividade</h2>
                                            <h5 class=" text-white">Atividades</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					
                        <div class="col-lg-3">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#1e3547 0%,#3b5b75 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_pendentes">0</h2>
                                            <h5 class=" text-white">Pendentes</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					
                        <div class="col-lg-3">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#009688 0%,#5ea29c 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center ">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_em_andamento">0</h2>
                                            <h5 class=" text-white">Andamento</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					
                        <div class="col-lg-3">
                            <a href="calendario">
                                <div class="card widget-music-category">
                                    <div class="card-body" style="background: linear-gradient(135deg,#1e3547 0%,#3b5b75 100%);padding: 1.5rem;border-radius: 4px;">
                                    <div class="media align-items-center ">
                                        <img class="mr-3" width="50" src="assets/images/icons/24.png" alt="">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-2 text-white" id="servicos_finalizados">0</h2>
                                            <h5 class=" text-white">Finalizadas</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="border-bottom-1 pb-3 d-sm-flex justify-content-between align-items-center">
                                    <div class="bg-white">
                                        <h3 class="">Acompanhamento Diário</h3>
                                    </div>
                                    <!--<div class="avatar-group my-3 my-sm-0">
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile1.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                    </div> -->
                                </div>
                                <div class="row mt-4 align-items-center">
                                    <div class="col-3"><span class="text-muted f-s-12">Finalizados</span>
                                        <h2 class="text-primary compl_act" >0</h2>
                                    </div>
                                    <div class="col-3" id="atrasados"><span class="text-muted f-s-12 blink">Atrasadas</span>
                                        <h2 class="text-muted">0</h2>
                                    </div>
                                    <div class="col-lg-6" id="percent_act">
                                        <h6 class="mt-4">0% Complete</h6>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width:0%; height:6px;" role="progressbar"><span class="sr-only">0% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="border-bottom-1 pb-3 d-sm-flex justify-content-between align-items-center">
                                    <div class="bg-white">
                                        <h3 class="">Plano de Ação</h3>
                                    </div>
                                    <!--<div class="avatar-group my-3 my-sm-0">
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile1.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                        <span class="avatar"><img width="35" src="assets/images/avatar/userprofile.jpg" class="rounded-circle w-35px" alt=""> </span>
                                    </div>-->
                                </div>
                                <div class="row mt-4 align-items-center">
                                    <div class="col-3"><span class="text-muted">Finalizadas</span>
                                        <h2 class="">0</h2>
                                    </div>
                                    <div class="col-3"><span class="text-muted">Atrasadas</span>
                                        <h2 class="">0</h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="mt-4">0% Completo</h6>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-info" style="width:0%; height:6px;" role="progressbar"><span class="sr-only">0% Completo</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card forms-card">
                            <div class="card-body">
								<h4 class="card-title">Agendar Atividade</h4>
                                <div class="basic-form">
									<div class="card-box">
										<div class="row">

										<div class="col-12" style="float: left;">
											<div class="event-sideber-search">
												<form action="#" method="post" class="chat-search-form">
													<input id="search_funcionarios" type="search" class="form-control" placeholder="Procurar">
													<i class="fa fa-search"></i>
												</form>
											</div>
										</div>   
										
										
										<div class="row" id="list_funcionarios"></div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>  
                
                
                
                </div>

                    <div class="card">
                        <div class="card-header pb-4">
                            <h4 class="card-title mt-2"> Atividades para Hoje</h4>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table recent-order-list-table table-responsive-fix-big">
                                    <thead>
                                        <tr>
                                            <th>#No</th>
                                            <th>Atividade</th>
                                            <th>Ativo</th>
                                            <th>Horário de Início</th>
                                            <th>Local</th>
                                            <th>Funcionário</th>
                                            <th>Transporte</th>
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
        </div>
    
            <!-- #/ container -->

        <!--**********************************
            Content body end
        ***********************************-->
        <!-- Modal to Event Details -->
        <div id="calendarModal" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 style="color: #111;">Detalhes da Atividade</h2> <button type="button" class="close" data-dismiss="modal" style="color: #111;opacity: 1;">×</button>
                    </div>
                    <div id="modalBody" class="modal-body">
                    <div id="modalWhen" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID"/>
                    <input type="hidden" id="eventFunc"/>
                    <div class="modal-footer">
                    <button id="comecar" style="display:none;" onclick="alteraStatus('comecar')" class="btn btn-start">Iniciar Atividade</button>
                    <button id="finalizar" style="display:none;" onclick="alteraStatus('finalizar')" class="btn btn-close">Finalizar Atividade</button>
                    <button id="concluido" style="display:none;" onclick="alteraStatus('concluido')" class="btn btn-conc">Aprovar</button>
			        <button id="reprovar" style="display:none;" onclick="alteraStatusReprovado('reprovar')" class="btn btn-danger">Reprovar</button>
                    
                    </div>
                </div>
            </div>
        </div>
        

        <div id="ModalAddInfo" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 style="color: #111;">Adicionar Informação</h2> <button type="button" class="close" data-dismiss="modal" style="color: #111;opacity: 1;">×</button>
                    </div>
                    <div id="modalBodyInfo" class="modal-body">
                    <div id="modalWhenInfo" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID"/>
                    <input type="hidden" id="eventFunc"/>
                    <div class="modal-footer">
                    <button style="display:none;" onclick="adicionaInformacao('id')" class="btn btn-close">Adicionar Informação</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="ModalAddTime" class="modal fade">
            <div class="modal-dialog" style="max-width:660px!important;">
                <div class="modal-content">
                    <div class="modal-header" >
                    <h2 style="color: #111;">Alterar Horario </h2> <button type="button" class="close" data-dismiss="modal" style="color: #111;opacity: 1;">×</button>
                    </div>
                    <div id="modalBodyTime" class="modal-body">
                    <div id="modalWhenTime" style="margin-top:5px;"></div>
                    </div>
                    <input type="hidden" id="eventID"/>
                    <input type="hidden" id="eventFunc"/>
                    <div class="modal-footer">
                    <button style="display:none;" onclick="adicionaInformacao('id')" class="btn btn-close">Adicionar Informação</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="ModalEditServico" class="modal fade">
            <div class="modal-dialog" >
                <div class="modal-content modal-content-edit" style="width:98%;background:#f9f9f9;margin-left: 5px;">

				</div>
            </div>
        </div>

        <input type="hidden" id="time_est_edit"/>
		<input type="hidden" id="start_inicial"/>
		<input type="hidden" id="end_inicial"/>


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
        <?php include('includes/common/right-sidebar.php'); ?>
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
	<script src="includes/dashboard/dash_1.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script> 

    <?php include('includes/modal/nova-agenda-dash.php'); ?>

    <script>
    //get_funcionarios()
    function get_funcionarios(){
        $.ajax({
        url:"includes/calendario/get_funcionarios",
        method: "POST",
        dataType : 'JSON',
        data: {
            
        },
        success:function(response){
            list_funcionarios = "";
            for (i = 0; i < response.length; i++) {
            list_funcionarios += '<div id="'+response[i].id+'" class="col-sm-4 col-xl-2 ">'+
                                            '<div id="'+response[i].id+'" class="cards ">'+
                                                '<div id="'+response[i].id+'" class="card-body ">'+
                                                    '<div id="'+response[i].id+'" class="text-center ">'+
                                                        '<img style="cursor: pointer;" data-foto="'+response[i].foto+'" data-nome="'+response[i].name+'" id="'+response[i].id+'" width="128" height="128" src="'+response[i].foto+'" class="rounded-circle new_booking" alt="">'+
                                                        '<h4 id="'+response[i].id+'" class="mt-4 ">'+response[i].name+'</h4>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
            }

            $('#list_funcionarios').html(list_funcionarios)

            $('.new_booking').on('click', function(e){
                e.preventDefault();
                var id = this.id;
                var foto = $(this).attr("data-foto");
                var nome = $(this).attr("data-nome");

                foto_avatar = $(this).data("foto")
                $("#id_funcionario").val(id);
                $('#time_atividade_box').hide();
                $('#horarios_disponiveis').hide();

                $("#my_Services").empty();
                $("#my_Services").val('').trigger('change');
                $("#clientes").empty();
                $("#clientes").val('').trigger('change');
                $("#tempo_estimado").val('');
                $('#obs').val('');
                $('#startTimeencaixe').val('');
                $('#startTime_dummy').val('');
                $('#startTime').val('');
                $('#preco').val('');
                $('#tempo_estimado_div').hide();
                $('#preco_div').hide();
                $('#createEventModal #startTime').val('');
                $('#createEventModal').modal('toggle');
                var func_avatar = '<div class="col-1" style="float: left;">'+
                '<a target="_blank" href="funcionario-'+id+' "><span><img style="width: 50px;height: 50px;" class="avatar_table" src="'+foto+'" alt="Avatar" height="50" width="50"></a>'+
                '</div>'+
                '<div class="col-9" style="margin-left: 21px;">'+
                    '<h3>'+nome+'</h3></span><span>Colaborador</span>'+
                '</div>';

                $('#funcionario_avatar').html(func_avatar);
                
                setTimeout(function(){
                    get_serv();
                },200)

            }); 
            
        }
        

    });
    }
    
    function get_open_service(){
	
	var idCliente = $("#id_page").val();
	
	$.ajax({
     url:"includes/dashboard/get_open_eventos",
     method:"GET",
     dataType:'JSON',
     data:{id:idCliente},
		success:function(response){

		var status = response.status;
        var lista_atividades = response.data;
        
        var lista_bolt , lista_atividadess , per = "";
        var status_type = "";

        
		
	  if(status == "SUCCESS") {
        
        for(var a = 0; a < lista_atividades.length; a++){
			client_id = lista_atividades[a].client_id;
			client_name = lista_atividades[a].client_name;
			client_pic = lista_atividades[a].client_pic;
			ativo = lista_atividades[a].ativo;
			preco = lista_atividades[a].preco;
			desc_service = lista_atividades[a].desc_service;
			br_start = lista_atividades[a].br_start;
            status_ = lista_atividades[a].status_;
            foto = lista_atividades[a].foto;
            id_ativo = lista_atividades[a].id_ativo;
            foto_ativo = lista_atividades[a].foto_ativo;
            id = lista_atividades[a].id;
            textColor = lista_atividades[a].textColor;
            color = lista_atividades[a].color;
            foto_funcionario = lista_atividades[a].foto_funcionario;
            id_funcionario = lista_atividades[a].id_funcionario;
            nome_funcionario = lista_atividades[a].nome_funcionario;
            foto_ativo = foto_ativo +'?' + (new Date()).getTime();
            foto_funcionario = foto_funcionario +'?' + (new Date()).getTime();
            func_list = lista_atividades[a].func_list;
            pet_taxi = lista_atividades[a].pet_taxi;
            if(pet_taxi == 1){
                pet_taxi = 'Sim';
            } else {
                pet_taxi = 'Não'
            }
       
            lista_bolt += `<tr>
                <td>`+id+`</td>
                <td class="text">`+desc_service+`</td>
                <td><a  href="ativo-`+id_ativo+`"><img class="avatar_table" src="`+foto_ativo+`" /> <span class="text-pale-sky">`+ativo+`</a> </span>
                </td>
                <td>`+br_start+`</td>
                <td><span class="text-pale-sky">`+preco+`</span></td>
                <td>`+func_list+`</a>              
                <td>`+pet_taxi+`</a>              
                </td>
                <td><a style="cursor:pointer;" class="start_servico" name="`+id+`" ><span style="background:`+color+`;color:`+textColor+`" class="label label label-rounded ">`+status_+`</a></span>
                </td>
            </tr>`;

			}
      		$('#opens_box').html(lista_bolt);
            
            
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
                            title = event.desc_service;
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
                            foto_ativo = event.foto_ativo;
                            nome_funcionario = event.nome_funcionario;
                            id_funcionario = event.id_funcionario;
                            id_ativo = event.id_ativo;
                            ativo = event.ativo;
                            info_extra = event.info_extra;
                            Info_list = event.Info_list;
                            func_list = event.func_list;
                            start_dateReage = event.start_dateReage;
                            est_time = event.est_time;
                            valor_frete = event.valor_frete;
                            category = event.category;
                            price_taxi = event.price_taxi;
                            id_form = event.id_form;
                            
                            pet_taxi = event.pet_taxi;
                            endereco = event.endereco;
                            foto_cliente = event.foto_cliente;

                            if(pet_taxi == 1){
                                tem_taxi = 'Sim <strong>[' + 'R$'+price_taxi+']</strong>';
                                end_taxi ='<span>'+endereco+'</span>'
                            } else {
                                tem_taxi = 'Não';
                                end_taxi = '';
                            }

                            var informacao_adicional = "";

                            if (info_extra == "") {
                                informacao_adicional = Info_list;
                            }else{
                                informacao_adicional = '<span >'+info_extra+'</span>'+Info_list+'';
                            }
                            
                            if(produtos == false){
                                produtos = "-";
                            }
                            
                            if(nome_funcionario != null){
                                nome_funcionario = nome_funcionario
                            } else {
                                nome_funcionario = 'N/A';
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
                            
                            var event_content = "";
                            var cancel_btn = "";
                            $('#time_est_edit').val(est_time);
                            
                            if(quem_executou == null){
                                quem_executou = "";
                            }
                            
                        
                            var edit_pet  = "", edit_client = "" , edit_funcionario = "" , edit_servico = "", edit_valor = "" , edit_pet_taxi = "" , edit_endereco = "" , edit_info_adicional = "";

                            if(status_ == "Pendente"){
                                $('#comecar').show();
                                $('#finalizar').hide();
                                cancel_btn = '<button id="editarservice_open" style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;color:#000;" class="btn btn-light">Reagendar</button><button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;border-color: #F44336;" type="submit" class="btn btn-danger calncelserico" id="calncelserico" >Cancelar Serviço</button><button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #222222;color: #fff;border-color: #222222;" type="submit" class="btn btn-danger delete_service" id="delete_service" >Deletar Serviço</button>';

                                edit_pet = '<i class="edit_pet icon-pencil f-s-16"></i>';
                                edit_prioridade = '<i class="edit_prioridade icon-pencil f-s-16"></i>';
                                edit_client = '<i class="edit_client icon-pencil f-s-16"></i>';
                                edit_funcionario = '<i class="edit_funcionario icon-pencil f-s-16"></i>';
                                edit_servico = '<i class="edit_servico icon-pencil f-s-16"></i>';
                                edit_valor = '<i class="edit_valor icon-pencil f-s-16"></i>';
                                edit_pet_taxi = '<i class="edit_pet_taxi icon-pencil f-s-16"></i>';
                                edit_endereco = '';
                                edit_info_adicional = '<i class="edit_info_adicional icon-pencil f-s-16"></i>';
                                
                            }
                            else if(status_ == "Em Andamento"){
                                $('#finalizar').show();
                                $('#comecar').hide();
                                cancel_btn = '<button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;border-color: #F44336;" type="submit" class="btn btn-danger calncelserico" id="calncelserico" >Cancelar Serviço</button>';
                                $('#concluido').hide();
                                $('#reprovar').hide();
                            
                            }
                            else if(status_ == "Cancelado"){
                                cancel_btn = '<button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;" class="btn " >Cancelado</button>';
                                $('#comecar').hide();
                                $('#finalizar').hide();
                                $('#concluido').hide();
                                $('#reprovar').hide();
                            
                            } else if(status_ == "Finalizado"){
                                cancel_btn = '<button style="font-size: 11px;padding: 2px 5px 3px 5px;margin-left: 10px;background: #F44336;color: #fff;" class="btn " >Cancelado</button>';
                                $('#comecar').hide();
                                $('#finalizar').hide();
                                $('#concluido').show();
                                $('#reprovar').show();
                            
                            } else if(status_ == "Concluído"){
                                
                                $('#comecar').hide();
                                $('#finalizar').hide();
                                $('#concluido').hide();
                                $('#reprovar').hide();
                            
                            } else {
                                $('#comecar').hide();
                                $('#finalizar').hide();
                            }
                                
                            event_content = `<div class="profile-personal-info">
                                            <h3 class="mb-5"><strong>Agendamento</strong>
                                            <span><strong>`+br_start+`</strong>
                                            `+cancel_btn+`
                                            </span></h3>
                                            <span><a href="atividade-`+id+`-`+id_form+`" ><h2 style="margin-bottom: 45px;">Serviço: `+title+`</h2></a></span>
                                            
                                            <div style="display:none;" class="form-group" id="time_atividade_box_edit" >
                                                    <div class="row" id="start_funcionario_box" style="font-weight:700;">
                                                        
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="form-group">
                                                                <span>Início</span>
                                                                <input style="cursor:pointer;" readonly required id="startTime_edit" name="startTime_edit" type="text" class="form-control datetimepicker_inicio" placeholder="Hora Início ">
                                                                <input id="startTime_dummy_edit" name="startTime_dummy_edit" type="hidden" >
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="form-group">
                                                                <span>Termino</span>
                                                                <input style="cursor:pointer;" readonly required id="endTime_edit" name="endTime_edit" type="text" class="timepicker_ form-control datetimepicker_termino" placeholder="Hora Fim ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="form-group" style="margin-top:20px">
                                                                <button style="width:100%;background: #a8cfb8;color: #074822;" id="editar_servico"  class="save_edit btn">Salvar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Ativo/Equipamento </strong> `+edit_pet+` <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8" id="name_pet_edit"><a target="_blank" href="ativo-`+id_ativo+`"><span  ><img class="avatar_table" src="`+foto_ativo+`" alt="Avatar" height="30" width="30"></a><span><strong>` +title+`</strong></span>[`+category+`] </span>
                                                </div>
                                            </div>    

                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Cliente</strong> `+edit_client+` <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8" id="name_client_edit" ><a target="_blank" href="cliente-`+id_client+`"><span><img class="avatar_table" src="`+foto_cliente+`" alt="Avatar" height="30" width="30"></a><span style="margin-right: 10px;">` +name_client+`</span></span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Funcionário</strong> `+edit_funcionario+` <span class="pull-right">:</span></h5>
                                                </div>
                                                <div style="margin-left: 10px;" id="name_funcionario_edit">`+func_list+`</div>
                                                
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Serviço</strong> `+edit_servico+`<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8" ><span id="servico_name_edit">`+title+`</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Hora Inicio</strong> <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span style="font-weight: 600;">`+br_start_hora+`</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Hora Fim</strong> <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span style="font-weight: 600;">`+termina_hora+`</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Valor</strong> `+edit_valor+`<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span style="font-weight: 600;">R$`+preco+`</span>
                                                </div>
                                            </div>
                                            <div style="display:none;" class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Começou ás</strong> <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>`+started_data_final+`</span>
                                                </div>
                                            </div>
                                            <div style="display:none;" class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Terminou ás</strong> <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>`+ended_final+`</span>
                                                </div>
                                            </div> 
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Executado por:</strong> <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>`+quem_executou+`</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong> Transporte:</strong> `+edit_pet_taxi+` <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span id="pet_taxi_edit">`+tem_taxi+`  </span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Endereço:</strong>  `+edit_endereco+` <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span id="pet_endereco_edit" >`+end_taxi+`</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <h5 class="f-w-500"><strong>Informações Adicionais:</strong> `+edit_info_adicional+`<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span id="info_adicional_edit" >`+info_extra+`: </span>
                                                </div>
                                            </div>
                                        </div>`

    endtime = event.endtime;
    starttime = event.starttime
    if(status_ == 'Finalizado'){

		var mywhen = starttime + ' - ' + endtime;
		$('#modalTitle').html(title);
		$('#modalWhen').html(event_content);
		$('#eventID').val(id);
		$('#eventFunc').val(id_funcionario);
		$('#calendarModal').modal();
		$('#editarservice_open').hide();
	
	} 
	else if(status_ == 'Cancelado'){

		var mywhen = starttime + ' - ' + endtime;
		$('#modalTitle').html(title);
		$('#modalWhen').html(event_content);
		$('#eventID').val(id);
		$('#eventFunc').val(id_funcionario);
		$('#calendarModal').modal();
		$('#editarservice_open').hide();
	} 
	else {


		var mywhen = starttime + ' - ' + endtime;
		$('#modalTitle').html(title);
		$('#modalWhen').html(event_content);
		$('#eventID').val(id);
		$('#eventFunc').val(id_funcionario);
		$('#calendarModal').modal();
		$('#editarservice_open').show();
		
	}

	$('#editarservice_open').on('click', function(e){ 
		e.preventDefault();
		edit_time(); //send data to delete function
	});

	$('.calncelserico').on('click', function(e){ 
		e.preventDefault();
		doCancel(); 
    });
    
    $('.delete_service').on('click', function(e){ 
		e.preventDefault();
		doDelete(); 
    });

    $('.edit_pet').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();

        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Ativo </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Ativo/Equipamento</label>'+
                    '<div class="input-group">'+
                        '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente_edit" name="pet_cliente_edit" required></select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $('#pet_cliente_edit').select2({
			ajax: {
				url: 'includes/calendario/get_ativos_from_client?id_cliente='+id_client+'',
				type : 'POST',
				dataType : 'JSON',
				delay: 600,
				data: function (params) {
						return {
						searchTerm: params.term // search term
					}
			},
				dropdownParent: "#createEventModal",
				processResults: function (data) {
					var results = [];
					$.each(data, function (i, v) {
						var o = {};
						o.id = v.id;
						o.name = v.name_bolt;
						o.foto = v.foto;
						results.push(o);
					});
					return {results: results};
			},
			cache: false
			},
				escapeMarkup: function (markuppet) { 
				return markuppet;
				},
				minimumInputLength: 0,
				templateResult: formatpetresult,
				templateSelection: formatpetresult,
			});

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var choose_pet = $('#pet_cliente_edit').select2('data');
                
                if(choose_pet.length == 0 ){
                    toastr.error('Ops!Escolha a Ativo', 'Error');  
                    return;
                }
                
                let id_event = $('#id_edit').val();
                let name = choose_pet[0].name;
                let foto = choose_pet[0].foto;
                let id = choose_pet[0].id;
                var campo = 'id_pet';
                var valor_campo = id;
                var interface = 'name_pet_edit';
                var valor_interface = '<a target="_blank" href="ativo-'+valor_campo+'"><span><img class="avatar_table" src="'+foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name+'</strong></span>';
                var database = 'tb_book_detail';
                edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });


    $('.edit_client').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Cliente </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                
                '<div class="col-lg-12">'+
                    '<div class="form-group">'+
                        '<label class="text-label">Cliente</label>'+
                        '<div class="input-group">'+
                            '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="cliente_edit" name="cliente_edit" required></select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                
                '<div class="col-lg-12">'+
                    '<div class="form-group">'+
                        '<label class="text-label">Ativo</label>'+
                        '<div class="input-group">'+
                            '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente_edit" name="pet_cliente_edit" required></select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<input type="hidden" id="id_edit" value="'+id+'" />'+
                '</div>'+

            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        $('#pet_cliente_edit').select2();

        $('#cliente_edit').select2({
            ajax: {
              url: 'includes/calendario/get_clientes',
              type : 'POST',
              dataType: 'JSON',
              delay: 200,
              data: function (params) {
                    return {
                      searchTerm: params.term // search term
                    };
              },
            
                    processResults: function (data, page) {
                        var results = [];
                        $.each(data, function (i, v) {
                            var o = {};
                            o.id = v.id;
                            o.name = v.name;
                            o.phone = v.phone;
                            o.street = v.street;
                            o.number = v.number;
                            o.neighbor = v.neighbor;
                            o.complemento = v.complemento;
                            o.city = v.city;
                            o.state_ = v.state_;
                            o.foto = v.foto;
                            o.zip = v.zip;
                            o.ativo = v.ativo;
                            o.all_pets = v.all_pets;
                            o.valor_frete = v.valor_frete;
                            results.push(o);
    
                        });
    
                        return {
                            results: results
                        };
                    },
                    cache: true
                  },
              escapeMarkup: function (markup) { 
                    return markup;
                },
                minimumInputLength: 0,
              templateResult: formatcre,
              templateSelection: formatcse,
          });
        
        
        $('#cliente_edit').on('select2:select', function (e) {
                id_cliente = $('#cliente_edit').val();
                $('#pet_cliente_edit').select2({
                ajax: {
                    url: 'includes/calendario/get_ativos_from_client?id_cliente='+id_cliente+'',
                    type : 'POST',
                    dataType : 'JSON',
                    delay: 300,
                    data: function (params) {
                            return {
                            searchTerm: params.term // search term
                        }
                },
                    dropdownParent: "#createEventModal",
                    processResults: function (data) {
                        var results = [];
                        $.each(data, function (i, v) {
                            var o = {};
                            o.id = v.id;
                            o.name = v.name_bolt;
                            o.foto = v.foto;
                              results.push(o);
                        });
                        return {results: results};
                },
                cache: false
                },
                    escapeMarkup: function (markuppet) { 
                    return markuppet;
                    },
                    minimumInputLength: 0,
                    templateResult: formatpetresult,
                    templateSelection: formatpetresult,
                });
        });
        
        $('.update_event').on('click', function(e){ 
            e.preventDefault();

            var choose_pet = $('#pet_cliente_edit').select2('data');
            var choose_client = $('#cliente_edit').select2('data');
            let id_event = $('#id_edit').val();

            if(choose_client.length == 0){
                toastr.error('Ops!Escolha o cliente', 'Error');  
                return;
            } else if(choose_pet.length == 0 ){
                toastr.error('Ops!Escolha a Ativo', 'Error');  
                return;
            }
            
            let name_client = choose_client[0].name;
            let foto_client = choose_client[0].foto;
            let id_client = choose_client[0].id;
            var campo_client = 'id_client';
            var valor_campo_client = id_client;
            var interface_client = 'name_client_edit';
            var valor_interface_client = '<a target="_blank" href="cliente-'+valor_campo+'"><span><img class="avatar_table" src="'+foto_client+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name_client+'</strong></span>';
            var database_client = 'tb_booking';

            let name = choose_pet[0].name;
            let foto = choose_pet[0].foto;
            let id = choose_pet[0].id;
            var campo = 'id_ativo';
            var valor_campo = id;
            var interface = 'name_pet_edit';
            var valor_interface = '<a target="_blank" href="ativo-'+valor_campo+'"><span><img class="avatar_table" src="'+foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+name+'</strong></span>';
            var database = 'tb_book_detail';
                
            if(id_client != ''){
                if(valor_campo != ''){ } else {
                    toastr.error('Erro!', "Oops, escolha a opção!");
                    return;
                }
        
                information = '<div class="user-info">'+
                                '<div class="detail">'+
                                    '<h4><strong>Confirmação</strong></h4>'+
                                    '<h5>Você deseja realmente editar?</h5>'+
                                '</div>'+
                            '</div>';
            
                        swal({
                            html: information,
                            showCancelButton: true,
                            confirmButtonColor: '#3ab9da',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, Confirmar!',
                            cancelButtonText: 'Não Obrigado',
                            showLoaderOnConfirm: true,
                            
                            preConfirm: function() {
                                $.ajax({
                                    url: 'includes/calendario/editar_evento',
                                    type: "POST",
                                    dataType: 'JSON',
                                    data: {
                                        id_event:id_event,
                                        campo:campo_client,
                                        valor_campo:valor_campo_client,
                                        database:database_client								
                                    },
                                    
                                    success: function(response) {					
                                            var json = response;
                                            status = json.status;
                                            status_txt = json.status_txt;
                                            if(status == "SUCCESS") {
                                                setTimeout(function(){
                                                    $(".loading").hide();
                                                    $('#'+interface_client+'').html(valor_interface_client);
                                                    $.ajax({
                                                        url: 'includes/calendario/editar_evento',
                                                        type: "POST",
                                                        dataType: 'JSON',
                                                        data: {
                                                            id_event:id_event,
                                                            campo:campo,
                                                            valor_campo:valor_campo,
                                                            database:database								
                                                        },
                                                        
                                                        success: function(response) {					
                                                                var json = response;
                                                                status = json.status;
                                                                status_txt = json.status_txt;
                                                                if(status == "SUCCESS") {
                                                                    setTimeout(function(){
                                                                        $(".loading").hide();
                                                                        toastr.success(status_txt, 'Sucesso');
                                                                        $("#ModalEditServico").modal('hide');
                                                                        $('#'+interface+'').html(valor_interface);
                                                                        
                                                                    }, 100);
                                                
                                                                } else {
                                                                    $(".loading").hide();
                                                                    toastr.error(status_txt, 'Error');
                                                                }
                                                        }
                                                    });
       
                                                }, 100);
                            
                                            } else {
                                                    $(".loading").hide();
                                                    toastr.error(status_txt, 'Error');
                                            }
                                    }
                                });
                            
                            },
                            allowOutsideClick: true			  
                        });
            }
            
        });

           
        
    });

    $('.edit_funcionario').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();

        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Funcionário </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Funcionário</label>'+
                    '<div class="input-group">'+
                        //'<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="pet_cliente_edit" name="pet_cliente_edit" required></select>'+
                        '<select style="" id="lista_funcionario_filtro_edit" name="lista_funcionario_filtro_edit[]" required multiple="multiple"></select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $('#lista_funcionario_filtro_edit').select2({
            ajax: {
              url: 'includes/calendario/get_funcionarios_filtro',
              type : 'POST',
              dataType: 'JSON',
              delay: 10,
              data: function (params) {
                    return {
                      searchTerm: params.term // search term
                    };
              },
            
                processResults: function (data, page) {
                    var resultsfun = [];
                    $.each(data, function (i, v) {
                        var o = {};
                        o.id = v.id;
                        o.name = v.name;
                        o.foto = v.foto;
                        o.phone = v.phone;
                        resultsfun.push(o);
    
                    });
    
                    return {
                        results: resultsfun
                    };
                },
                cache: true
                },
              escapeMarkup: function (markupfun) { return markupfun;},
              minimumInputLength: 0,
              minimumResultsForSearch: -1,
              templateResult: filfunresult,
              templateSelection: filfunselec,
            });

            function filfunresult(data) {
                var markupfun = "";
                if(data.loading){
                    markupfun = "Procurando";
                }
                else if (data.id == undefined) {
                    markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="cadastro-funcionario" >Cadastrar Funcionario</a>';
                    return;
                } else {
                    var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
                }
                
                return markupfun;
            }
            function filfunselec(data) {
                var markupfun = "";
                if(data.loading){
                    markupfun = "Procurando";
                }
                else if (data.id == undefined) {
                    markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="cadastro-funcionario" >Cadastrar Funcionario</a>';
                    return;
                } else {
                    var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
                }
                
                return markupfun;
            }

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var choose_pet = $('#lista_funcionario_filtro_edit').select2('data');
                
                if(choose_pet.length == 0 ){
                    toastr.error('Ops!Escolha o Funcionário', 'Error');  
                    return;
                }
                var valor_interface = ""; 
                var id_funcionario = "";
                id_funcionario = $('#lista_funcionario_filtro_edit').val();
                for(let i = 0; i < choose_pet.length; i = i + 1 ) {
                    valor_interface += '<a target="_blank" href="ativo-'+choose_pet[i].id+'"><span><img class="avatar_table" src="'+choose_pet[i].foto+'" alt="Avatar" height="30" width="30"></a><span><strong>'+choose_pet[i].name+'</strong></span>';

                }
                
                let id_event = $('#id_edit').val();
                var interface = 'name_funcionario_edit';
                $.ajax({
                    url: 'includes/calendario/editar_evento_funcionario',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        id_event:id_event,
                        id_funcionario:id_funcionario								
                    },
                    success: function(response) {					
                            var json = response;
                            status = json.status;
                            status_txt = json.status_txt;
                            if(status == "SUCCESS") {
                                setTimeout(function(){
                                    $(".loading").hide();
                                    toastr.success(status_txt, 'Sucesso');
                                    $("#ModalEditServico").modal('hide');
                                    $('#'+interface+'').html(valor_interface);
                                }, 100);
            
                            } else {
                                $(".loading").hide();
                                toastr.error(status_txt, 'Error');
                            }
                    }
                });
            });
        
        
    });

    $('.edit_servico').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Serviço </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Serviço</label>'+
                    '<div class="input-group">'+
                        '<select style="width: 100%;height:70px;border: 1px solid #dddfe1;" id="tipo_servico_edit" name="tipo_servico_edit" required></select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $("#tipo_servico_edit").val('').trigger('change');
        
        $('#tipo_servico_edit').select2({
				
            ajax: {
            url: 'includes/calendario/get_services',
            data:{id_team:id_funcionario},
            dataType : 'JSON',
            delay: 250,
            processResults: function (data, page) {
            var resultsfun = [];
            $.each(data, function (i, v) {
                var o = {};
                o.id = v.id;
                o.short_dec = v.short_dec;
                o.foto = v.foto;
                o.phone = v.phone;
                o.get_open_days = v.get_open_days;
                o.est_time = v.est_time;
                o.price = v.price;
                o.est_time_min = v.est_hour_min;
                resultsfun.push(o);

            });

            return {
                results: resultsfun
            };
            },
            cache: true
            },
            escapeMarkup: function (markupfun) { return markupfun;},
            minimumInputLength: 0,
            minimumResultsForSearch: -1,
            templateResult: servicesearch,
            templateSelection: servicesearch,
                    
        });

        function servicesearch(data) {
            var markupfun = "";
            if(data.loading){
                markupfun = "Procurando";
            }
            if (data.id == 'none') {
                return 'Nenhum Serviço atribuído <a target="_blank" style="float: right;" class="btn btn-primary btn-sm" href="funcionario-'+id_team +'" >Atribuir Serviço</a>';
            } else {
                var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.short_dec +' </span>';
            }
            
            return markupfun;
        }



            $('.update_event').on('click', function(e){ 
                e.preventDefault();
                var choose_pet = $('#tipo_servico_edit').select2('data');
                if(choose_pet.length == 0 ){
                    toastr.error('Ops!Escolha o Serviço', 'Error');  
                    return;
                }
                let id_event = $('#id_edit').val();
                let name = choose_pet[0].short_dec;
                //let foto = choose_pet[0].foto;
                let id = choose_pet[0].id;
                var campo = 'service_name';
                var valor_campo = id;
                var interface = 'servico_name_edit';
                var valor_interface = name;
                var database = 'tb_book_detail';

               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });
    

    $('.edit_valor').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Valor </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Valor Serviço</label>'+
                    '<div class="input-group">'+
                       '<input type="text" style="width: 100%;height: 45px;border:1px solid #dddfe1;padding-left:5px;font-weight: 800;font-size: 15px;" id="valor_edit" name="valor_edit" required></input>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        
        $('#valor_edit').mask('000.000.000.000.000,00', {reverse: true});
            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var valor_edit = $('#valor_edit').val();
                
                if(valor_edit == '' ){
                    toastr.error('Ops!Digite o valor Serviço', 'Error');  
                    return;
                }
                
                let id_event = $('#id_edit').val();
                var campo = 'price';
                var valor_campo = valor_edit;
                var interface = 'servico_name_edit';
                var valor_interface = '<span style="font-weight: 600;">R$'+valor_edit+'</span>';
                var database = 'tb_book_detail';

               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });

    $('.edit_pet_taxi').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Fete </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+

                '<div class="col-lg-12">'+
					'<div class="form-group">'+
						'<div class="form-check">'+
							'<input name="pet_taxi_" id="pet_taxi_" class="form-check-input styled-checkbox" type="checkbox">'+
							'<label name="pet_taxi_" for="pet_taxi_" class="form-check-label">Fete</label>'+
							'<input name="has_taxi_edit" id="has_taxi_edit" type="hidden">'+
						'</div>'+
					'</div>'+
					'<div id="endereco_cliente_edit" style="display:none;" class="form-group">'+
						'<label class="text-label">Endereço</label>'+
						'<div class="input-group">'+
							'<textarea type="text" id="obs_adr_edit" name="obs_adr_edit" class="form-control" >'+endereco+'</textarea>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="text-label" style="margin-top: 15px;">Valor Transporte:</label>'+
							'<div class="input-group">'+
							'<input id="price_taxi_edit" name="price_taxi_edit" value="'+price_taxi+'" type="text" class="form-control" placeholder="Valor Transporte ">'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+


            '</div>'+

            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        $('#price_taxi_edit').mask('000.000.000.000.000,00', {reverse: true});
        
        setTimeout(function(){ 
            $("#pet_taxi_").click(function(){
                var checkbox_edir = $('[name="pet_taxi_"]');
                if (checkbox_edir.is(':checked'))
                {
                    $('#endereco_cliente_edit').show();
                    $('#has_taxi_edit').val(1);
                }else
                {
                    $('#endereco_cliente_edit').hide();
                    $('#has_taxi_edit').val(0);
                }
            });
         }, 300);
       
            $('.update_event').on('click', function(e){ 
                
                let id_event = $('#id_edit').val();
                var has_taxi_edit = $('#has_taxi_edit').val();
                var obs_adr_edit = $('#obs_adr_edit').val();
                var price_taxi_edit = $('#price_taxi_edit').val();
               
                var checkbox_edir = $('[name="pet_taxi_"]');
                if (checkbox_edir.is(':checked'))
                {
                    var pet_taxi_edit = '<span>Sim <strong>[R$'+price_taxi_edit+']</strong>  </span>';
                    var pet_endereco_edit = obs_adr_edit;

                }else
                {
                    var pet_taxi_edit = '<span>Não </span>';
                    var pet_endereco_edit = '';
                    
                } 

                e.preventDefault();
                $.ajax({
                    url: 'includes/calendario/editar_evento_taxi',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        id_event:id_event,
                        has_taxi:has_taxi_edit,								
                        obs_adr:obs_adr_edit,								
                        price_taxi:price_taxi_edit,								
                    },
                    success: function(response) {					
                            var json = response;
                            status = json.status;
                            status_txt = json.status_txt;
                            if(status == "SUCCESS") {
                                setTimeout(function(){
                                    $(".loading").hide();
                                    toastr.success(status_txt, 'Sucesso');
                                    $("#ModalEditServico").modal('hide');
                                    $('#pet_taxi_edit').html(pet_taxi_edit);
                                    $('#pet_endereco_edit').html(pet_endereco_edit);
                                }, 100);
            
                            } else {
                                $(".loading").hide();
                                toastr.error(status_txt, 'Error');
                            }
                    }
                });
            });
    });

    $('.edit_info_adicional').on('click', function(e){ 
        e.preventDefault();
        $('#ModalEditServico').modal();
       
        var my_change = 
            '<div class="modal-header" >'+
                    '<h2>Alterar Informação Adicional </h2> <button type="button" class="close" data-dismiss="modal" >×</button>'+
            '</div>'+
            '<div id="modalBodyTime" class="modal-body">'+
                '<div class="form-group">'+
                    '<label class="text-label">Informação Adicional</label>'+
                    '<div class="input-group">'+
                       '<textarea type="text" id="obs_extra_edit" name="obs_extra_edit" class="form-control" >'+info_extra+'</textarea>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="id_edit" value="'+id+'" />'+
            '<input type="hidden" id="field_edit" value="pet_cliente_edit"/>'+
            '<input type="hidden" id="title_edit" value="pet" />'+
            '<div class="modal-footer">'+
            '<button class="update_event btn btn-close">Editar</button>'+
            '</div>';
        $('.modal-content-edit').html(my_change);
        

            $('.update_event').on('click', function(e){ 
                e.preventDefault();

                var obs_extra_edit = $('#obs_extra_edit').val();

                let id_event = $('#id_edit').val();
                var campo = 'info_extra';
                var valor_campo = obs_extra_edit;
                var interface = 'info_adicional_edit';
                var valor_interface = obs_extra_edit;
                var database = 'tb_book_detail';

               edit_event(id_event,campo,valor_campo,interface,valor_interface,database);
            });
        
        
    });



        function edit_time(){
	
        $('#time_atividade_box_edit').show();
        $(".timepicker_").mask('00:00');
        const now = moment()
        now.format("HH:mm:ss") // 13:00:00
        $.datetimepicker.setLocale('pt');
        jQuery('.datetimepicker_inicio').datetimepicker({
            format:'d/m/Y H:i',
            inline:false,
            todayButton:true,
            lang:'pt',
            step: 5,
            scrollInput: false,
            defaultTime:now.format("HH:mm:ss"),
            onSelectTime:function(dp,$input){
                var min_to_sum = parseFloat($('#time_est_edit').val());
                var time_est_edit = $('#time_est_edit').val()
                var min_to_sum = moment.duration(time_est_edit).asMinutes();
                var date1 = new Date(dp);
                date1.setMinutes(date1.getMinutes() + min_to_sum);

                var horas = date1.getHours();
                if(horas <= 9){
                    horas = '0'+horas;
                }
                var minutos = date1.getMinutes();
                if(minutos <= 9){
                    minutos = '0'+minutos;
                }
                var hora_final = horas+':'+minutos;
                $('#endTime_edit').val(hora_final)
            
    
            }

        });

        
        jQuery('.timepicker_').datetimepicker({
            timepicker: true,
            datepicker:false,
            format:'H:i',
            inline:false,
            autoclose: true,
            todayButton:true,
            lang:'pt',
            step: 5,
            scrollInput: false,
            minDate:0,
            //defaultTime:'07:00',
        });

        $('.save_edit').on('click', function(e){ // delete event clicked
        // We don't want this to act as a link so cancel the link action
            e.preventDefault();
            save_editar_servico(); //send data to delete function
        });


    }

    $('.save_edit').on('click', function(e){ 
        e.preventDefault();
        save_editar_servico(); 
    });

    function formatcre(data) {

        $('#pet_cliente').val('');
        $("#pet_cliente").val('').trigger('change');
        var markup = "";


        if(data.loading){
            markup = "Procurando";
        }
        else if (data.id == undefined) {
            markup = 'Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_cliente_modal" >Cadastrar Cliente</a>';
            
                        
        } else {
            endereco = data.street+' nº'+data.number+','+data.neighbor+' - '+data.city;
            $('#obs_adr').val(endereco);
            $('#price_taxi').val(data.valor_frete);
            var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +'[' +data.all_pets+']</span>';
        }
        return markup;
        }

        function formatcse(data) {
        var markup = "";
        if(data.loading){
            markup = "Procurando";
        }
        else if (data.id == undefined) {
            //markup = 'Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_cliente_modal" >Cadastrar Cliente</a>';
            
        } else {
            endereco = data.street+' nº'+data.number+','+data.neighbor+' - '+data.city;
            $('#obs_adr').val(endereco);
            $('#price_taxi').val(data.valor_frete);
            var markup = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +'[' +data.all_pets+']</span>';
        }
        return markup;
        }

    function save_editar_servico(){
        

        var startTime = $('#startTime_edit').val();
        var endTime = $('#endTime_edit').val();
        var eventIDedit = $('#eventID').val();

        var start_inicial = $('#start_inicial').val();
        var end_inicial = $('#end_inicial').val();
    
        if(startTime != ''){ } else {
            toastr.error('Erro!', "Oops, preencha a data e horário Inicial!");
            return;
        }

        if(endTime != ''){} else {
            toastr.error('Erro!', "Oops, preencha a data e horário final!");
            return;
        }

        information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>Confirmação</strong></h4>'+
                            '<h5>Você deseja realmente reagendar?</h5>'+
                        '</div>'+
                    '</div>';
    
                swal({
                    html: information,
                    showCancelButton: true,
                    confirmButtonColor: '#18998d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Reagendar!',
                    cancelButtonText: 'Não Obrigado',
                    showLoaderOnConfirm: true,
                    
                    preConfirm: function() {
                        $.ajax({
                            url: 'includes/calendario/editar_agendamento',
                            type: "POST",
                            dataType: 'JSON',
                            data: {
                                startTime:startTime,
                                endTime:endTime,
                                eventIDedit:eventIDedit,								
                                start_inicial:start_inicial	,							
                                end_inicial:end_inicial								
                            },
                            
                            success: function(response) {					
                                    var json = response;
                                    status = json.status;
                                    status_txt = json.status_txt;
                                    if(status == "SUCCESS") {
                                        setTimeout(function(){
                                            $(".loading").hide();
                                            toastr.success(status_txt, 'Sucesso');
                                            $("#calendarModal").modal('hide');
                                            //$("#EditTime").modal('hide');
                                                  
                                        }, 100);
                    
                                    } else {
                                            $(".loading").hide();
                                            toastr.error(status_txt, 'Error');
                                    }
                            }
                        });
                    
                    },
                    allowOutsideClick: true			  
                });
                        
    } 
   
   $('#deleteButton').on('click', function(e){ // delete event clicked
       // We don't want this to act as a link so cancel the link action
       e.preventDefault();
       doDelete(); //send data to delete function
   });

   function doDelete(){  
    toastr.options = {"positionClass": "toast-top-full-width"}
   
    var eventID = $('#eventID').val();
        
    
    information = '<div class="user-info">'+
                     '<div class="detail">'+
                         '<h4><strong>Confirmação</strong></h4>'+
                         '<h5>Você deseja realmente deletar este serviço?</h5>'+
                     '</div>'+
                 '</div>';
 
             swal({
                 html: information,
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Sim, Deletar!',
                 cancelButtonText: 'Não Obrigado',
                 showLoaderOnConfirm: true,
                 
                 preConfirm: function() {
                     $.ajax({
                         url: 'includes/calendario/delete_event',
                         type: "POST",
                         dataType: 'JSON',
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
                                      $("#calendarModal").modal('hide');
                                    }, 100);
              
                                } else {
                                         $(".loading").hide();
                                        toastr.error(status_txt, 'Error');
                                }
                         }
                     });
                 
                 },
                 allowOutsideClick: true			  
             });
}

function alteraStatusReprovado(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#eventID').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/noimage.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Digite o Motivo!</h5>'+
							'<br><span><textarea rows="4" type="text" id="repprove_message" name="repprove_message" class="form-control" ></textarea></span>'+
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

                       var repprove_message =  $('#repprove_message').val();
                       if(repprove_message == ''){
                        toastr.success("Digite a Justificativa!", 'Ops'); 
                        return;
                       }
                        
                        $.ajax({
                            url: "includes/calendario/repprove_event",
                           data: {
                            eventID:eventID,
                            acao:acao,
                            id_funcionario:id_funcionario,
                            repprove_message:repprove_message
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;

                                    toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
                                    $('#calendarModal').modal('hide');
                                 }
                           });


					
					},
					allowOutsideClick: true			  
                });

       
       
       
   }

function doCancel(){  
    toastr.options = {"positionClass": "toast-top-full-width"}
   
    var eventID = $('#eventID').val();
        
    
    information = '<div class="user-info">'+
                     '<div class="detail">'+
                         '<h4><strong>Confirmação</strong></h4>'+
                         '<h5>Você deseja realmente cancelar este serviço?</h5>'+
                     '</div>'+
                 '</div>';
 
             swal({
                 html: information,
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Sim, Cancelar!',
                 cancelButtonText: 'Não Obrigado',
                 showLoaderOnConfirm: true,
                 
                 preConfirm: function() {
                     $.ajax({
                         url: 'includes/calendario/cancel_event',
                         type: "POST",
                         dataType: 'JSON',
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
                                      $("#calendarModal").modal('hide');
                                    }, 100);
              
                                } else {
                                         $(".loading").hide();
                                        toastr.error(status_txt, 'Error');
                                }
                         }
                     });
                 
                 },
                 allowOutsideClick: true			  
             });
    }
  
            }
            });
        });

			
    	} else {
            $('#opens_box').html('');  
        }
    }
    }); 

  }
  
  get_open_service();

    function alteraStatus(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#eventID').val();
	var id_funcionario = $('#eventFunc').val();
         
	   toastr.options = {"positionClass": "toast-top-full-width"}
       
       $.ajax({
        url: "includes/calendario/alteraStatus",
       data: {
        eventID:eventID,
		acao:acao,
		id_funcionario:id_funcionario
       },
			type: "POST",
			dataType: 'JSON',
			success: function(response) {
			status = response.status;
			status_message = response.status_txt;
			
			if(acao == "concluido"){
				fullname = response.fullname;
				foto = response.foto;

				imagem = foto +'?' + (new Date()).getTime();
				
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
							'<br><span><textarea type="text" id="zap_message" name="zap_message" class="form-control" ></textarea></span>'+
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
                                var string_zap = 'https://wa.me/55'+phone_message_cliente+'/?text='+zap_message+' ';

                                window.open(string_zap+' ','_blank');

								//window.open('https://api.whatsapp.com/send?phone=55'+phone_message_cliente+'&text='+zap_message+' ','_blank');
							} else {
								toastr.error('Erro!', "Oops, Digite o telefone do cliente!");
								$('#calendarModal').modal('hide');

							}
							
						} else {
							toastr.error('Erro!', "Oops, Digite uma mensagem para o cliente!");
							$('#calendarModal').modal('hide');

						}
						

						toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
						$('#calendarModal').modal('hide');
					
					
					},
					allowOutsideClick: true			  
                });
                
                $('.phone').mask('(00) 00000-0009');
				$('#concluido').show();
                $('#reprovar').show();
                $('#finalizar').hide();
				
			}
			else{
                toastr.success("Serviço iniciado com sucesso!", 'Sucesso');
                $('#calendarModal').modal('hide');
				setTimeout(function(){ 
                    get_open_service();
                    get_valores();
                 }, 100);
			}
			
			

           }
       });
       
   }

   function alteraStatusReprovado(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#eventID').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/noimage.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Digite o Motivo!</h5>'+
							'<br><span><textarea rows="4" type="text" id="repprove_message" name="repprove_message" class="form-control" ></textarea></span>'+
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

                       var repprove_message =  $('#repprove_message').val();
                       if(repprove_message == ''){
                        toastr.success("Digite a Justificativa!", 'Ops'); 
                        return;
                       }
                        
                        $.ajax({
                            url: "includes/calendario/repprove_event",
                           data: {
                            eventID:eventID,
                            acao:acao,
                            id_funcionario:id_funcionario,
                            repprove_message:repprove_message
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;
                                    get_open_service();
                                    get_valores();
                                    toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
                                    $('#calendarModal').modal('hide');
                                    $('#concluido').hide();
                                    $('#reprovar').hide();
                                 }
                           });
					
					},
					allowOutsideClick: true			  
                });

       
       
       
   }

   $('#deleteButton').on('click', function(e){ // delete event clicked
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
                            get_open_service();
                            get_valores();
                      }, 100);

                  } else {
                           $(".loading").hide();
                          
                           toastr.error(status_txt, 'Error');
                  }
           }
       });
   }
   function adicionarInfo(id , info_extra){
            var ModalAddInfom = "";

            ModalAddInfom = `<div class="modals">
                        <div class="form-group">
                        <label class="text-label">Digite a anotação desejada</label>
                            <input type="text" value="`+info_extra+ `"  name="Newinfo_extra" id="Newinfo_extra" class="form-control" required="" >
                        <button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="addInformacao(`+id+`)">Salvar</button>                        
                        </div>

                     </div>`
            $('#modalWhenInfo').html(ModalAddInfom);
            $('#ModalAddInfo').modal();
   }

   function addInformacao(id){
    var Newinfo_extra = $("#Newinfo_extra").val();

        $.ajax({
           url: 'includes/calendario/cadastra_infoextra.php',
           type: "POST",
           dataType:'JSON',
           data: {
                id : id,
                Newinfo_extra : Newinfo_extra
           },
           success: function(response) {                    
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                if(status == "SUCCESS") {
                      setTimeout(function(){
                        $(".loading").hide();
                        toastr.success(status_txt, 'Sucesso');
                      }, 100);

                  } else {
                           $(".loading").hide();
                          
                           toastr.error(status_txt, 'Error');
                  }
               
           }
       });
   }

function alteraHorario(id , br_start_hora, termina_hora, start_dateReage, id_funcionario){

            var ModalAltTime = "";
            ModalAltTime = `<div class="modals">
                        <div class="form-group">
                        <label class="text-label">Horario de inicio</label>
                            <input type="text" value="`+br_start_hora+ `"  name="nome" id="Newhora_Inicio" class="form-control timepicker_ " required="" >
                        <label class="text-label">Horario de finalização</label>
                            <input type="text" value="`+termina_hora+ `" name="nome"  id="Newhora_termino" class="form-control timepicker_" required="" >
                        <label class="text-label">Data</label>
                            <input type="text" value="`+start_dateReage+ `" name="nome"  id="Newstarted_data" class="form-control  " required="" >
                        <button style="width:100%; margin-top: 30px " id="save-team-service" class="btn btn-primary" type="button"  onclick="AlterarTime(`+id+`,`+id_funcionario+`)">Salvar</button>                        
                        </div>

                     </div>`


            $('#modalWhenTime').html(ModalAltTime);
            $('#ModalAddTime').modal();

            $(".timepicker_").mask('00:00');
            $(".datepicker_").mask('00/00/0000');


                jQuery('.timepicker_').datetimepicker({
                  timepicker: true,
                  datepicker:false,
                  format:'H:i',
                  inline:false,
                  autoclose: true,
                  todayButton:true,
                  lang:'pt',
                  step: 5,
                  scrollInput: false,
                  minDate:0,
                  defaultTime:'07:00',
                  onSelectTime:function(dp,$input){
                   var min_to_sum = parseInt($('#serduracao').val());
                   var date1 = new Date(dp);

                   date1.setMinutes(date1.getMinutes() + min_to_sum);
                    var horas = date1.getHours();
                    if(horas <= 9){
                        horas = '0'+horas;
                    }

                    var minutos = date1.getMinutes();
                    if(minutos <= 9){
                        minutos = '0'+minutos;
                    }
                    var hora_final = horas+':'+minutos;
                    $('#hora_final_agenda').val(hora_final)

                 }
                }); 

   }

   function AlterarTime(id, id_funcionario){

        var Newhora_Inicio = $("#Newhora_Inicio").val();
        var Newhora_termino = $("#Newhora_termino").val();
        var Newstarted_data = $("#Newstarted_data").val(); 

        $.ajax({
           url: 'includes/calendario/altera_horario.php',
           type: "POST",
           dataType:'JSON',
           data: {
                id : id,
                id_funcionario : id_funcionario,
                Newhora_Inicio : Newhora_Inicio,
                Newhora_termino : Newhora_termino,
                Newstarted_data : Newstarted_data
           },
           success: function(response) {                    
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                if(status == "SUCCESS") {
                      setTimeout(function(){
                        $(".loading").hide();
                        toastr.success(status_txt, 'Sucesso');
                      }, 100);

                  } else {
                    $(".loading").hide();
                    toastr.error(status_txt, 'Error');
                  }
               
           }
       });
   }

   function formatpetresult(data) {
		var markuppet = "";
		if(data.loading){
			markuppet = "Procurando";
		} else if (data.id == undefined) {
			markuppet = '<span>Nenhum Cliente Cadastrado <a class="btn btn-primary btn-sm" data-toggle="modal" href="#novo_pet_modal" >Cadastrar Ativo</a></span>';
			return
		} else {
			var markuppet = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> <strong>'+ data.name +'</strong> </span>';
		}
		return markuppet;
	}
	function formatpetselect(data) {
		var markuppetsel = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> '+ data.name +'</span>';
		return markuppetsel;
    }
    
    function edit_event(id_event,campo,valor_campo,interface,valor_interface,database){
        
        if(valor_campo != ''){ } else {
            toastr.error('Erro!', "Oops, escolha a opção!");
            return;
        }

        information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>Confirmação</strong></h4>'+
                            '<h5>Você deseja realmente editar?</h5>'+
                        '</div>'+
                    '</div>';
    
                swal({
                    html: information,
                    showCancelButton: true,
                    confirmButtonColor: '#3ab9da',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Confirmar!',
                    cancelButtonText: 'Não Obrigado',
                    showLoaderOnConfirm: true,
                    
                    preConfirm: function() {
                        $.ajax({
                            url: 'includes/calendario/editar_evento',
                            type: "POST",
                            dataType: 'JSON',
                            data: {
                                id_event:id_event,
                                campo:campo,
                                valor_campo:valor_campo,
                                database:database								
                            },
                            
                            success: function(response) {					
                                    var json = response;
                                    status = json.status;
                                    status_txt = json.status_txt;
                                    if(status == "SUCCESS") {
                                        setTimeout(function(){
                                            $(".loading").hide();
                                            toastr.success(status_txt, 'Sucesso');
                                            $("#ModalEditServico").modal('hide');
                                            $('#'+interface+'').html(valor_interface);
                                            get_open_service();
                                            get_valores();
                                        
                                        }, 100);
                    
                                    } else {
                                            $(".loading").hide();
                                            toastr.error(status_txt, 'Error');
                                    }
                            }
                        });
                    
                    },
                    allowOutsideClick: true			  
                });
                        
    } 
    </script>


</body>

</html>