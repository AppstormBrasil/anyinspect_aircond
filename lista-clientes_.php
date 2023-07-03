<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '403';</script>";
		exit(0);
	}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - lista clientes</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Custom Stylesheet -->
   <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
   <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
   <link href="css/style-full.css" rel="stylesheet">
   <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

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
	<div id="main-wrapper">
         <?php include('includes/common/nav-header.php'); ?>
        <?php include('includes/common/header.php'); ?>
        <?php include('includes/common/sidebar.php'); ?>
        <div class="content-body">
            <div class="container-fluid">
                <div id="box_tabela" class="row">
                    <style>
                        .dataTables_filter{display:none;}
                        .dt-buttons{margin-bottom: 20px;float: right;}
                        .btn {padding: 0.3rem 1.0rem;font-size: 1.2rem;border-radius: 5px;}
                    </style>
                    <div class="col-xl-12" >
                        <div class="card ttransparent-card m-b-0">
                            <div class="card-header" style="padding:15px;">
                                <h4 class="card-title">Lista de Clientes</h4>
                                <button class="float-right btn btn-primary btn-xs" onclick="go_to_page_single()" type="button"><span>Novo Cliente</span></button>
                            </div>
                            <div class="card-body p-0">
                            <div class="event-sideber-search">
									<form action="#" method="post" class="chat-search-form">
										<input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
										<i class="fa fa-search"></i>
									</form>
								</div>
                                <div class="table-responsive" style="padding: 10px;">
									<table class="table table-padded market-capital table-responsive-fix-big" id="lista_pet" class="display" style="width:100%">
                                        <thead>
                                            <tr>
												<th>ID</th>
                                                <th>Nome</th>
                                                <th>Telefone</th>
												<th>Whatsapp</th>
                                                <th>E-mail</th>
												<th>Bairro</th>
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
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <?php include('includes/common/footer.php'); ?>
        <?php include('includes/common/right-sidebar.php'); ?>
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>

    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script> 
    <script src="assets/plugins/tables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/tables/buttons.flash.min.js"></script>
    <script src="assets/plugins/tables/jszip.min.js"></script>
    <script src="assets/plugins/tables/pdfmake.min.js"></script>
    <script src="assets/plugins/tables/vfs_fonts.js"></script>
    <script src="assets/plugins/tables/buttons.html5.min.js"></script>
    <script src="assets/plugins/tables/buttons.print.min.js"></script>

    <script>

toastr.options = {"positionClass": "toast-top-full-width"}
function get_lista_resposta(){

var table = $('#lista_pet').DataTable({
  ajax: {
    url: 'includes/cliente/get_client',
  },
  language: {
      "lengthMenu": "Mostrar  _MENU_ linhas registros",
      "zeroRecords": "Nenhum resultado encontrado",
      "info": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
      "infoEmpty": "Nenhum dado disponível",
      "infoFiltered": "(Filtrado de _MAX_ registros no total)",
      "sSearch":       "Procurar:",
      "oPaginate": {
          "sFirst":    "Primeiro",
          "sPrevious": "Anterior",
          "sNext":     "Seguinte",
          "sLast":     "Último"
      }
}   ,
  
  columnDefs: [ 
      { 
        "targets": 0 , 
        "data": 1,
        "width": "3%", 
        "data": 'id'	
      },
      { 
          "targets": 1 ,
           "data": 'name',
			"render": function (data, type, row, meta) {
						  var img = row.foto + '?' + (new Date()).getTime();
						  return '<a class="single_link" href="cliente-'+row.id+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.name+'</a>';
			  }		   
      },
      { 
          "targets": 2 , 
          "data": 'phone'
          
      },
	  { 
          "targets": 3 , 
          "data": 'zap'
          
      },
      { 
          "targets": 4 , 
          "data": 'email'
          
      },
      { 
          "targets": 5 , 
          "data": 'neighbor'
          
      },
      
		{
        "targets": 6,
        "data": 'botao',
        "className": "text-right"
        },

      { "orderable": false, "targets": 1 },
   ],
  "createdRow": function( row, data, dataIndex ) {
      $(row).addClass( 'row_'+data.id );
  },
  dom: 'Bfrtip',
  buttons: [
             {
                extend: 'print',
                orientation: 'landscape',
                messageTop: '<h2>Lista de Clientes</h2>',
                columns: ':not(.select-checkbox)',
                orientation: 'landscape',
                text: 'Imprimir',
                className: 'btn btn-primary' 
            },
            {
                extend: 'excel',
                className: 'btn btn-primary'
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary'
            }
        ],

  "deferRender": true
});

};

$("#search_clientes").on("input", function (e) {
      e.preventDefault();
     $('#lista_pet').DataTable().search($(this).val()).draw(); 
  }); 

  
function RemoveItem(productId,nome,imagem){
    information = '<div class="user-info">'+
                        '<div class="image"><a class="waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h5>Você deseja remover este Cliente ?</h5>'+
                            '<h4><strong>'+nome+'</strong></h4>'+
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
                   url: 'includes/cliente/delete_client',
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
                 swal('Oops...', 'Erro ao deletar!', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
}  
  
function go_to_page_single(){
      window.location.href = "cadastro-cliente";
}
get_lista_resposta();
    </script>

</body>
</html>