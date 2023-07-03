<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("m");
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
    <title>Anynspect</title>
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
                <div id="box_tabela" class="row">
                    <style>
                    .dataTables_filter{display:none;}
                    .dt-buttons{float:right;margin-bottom:10px;}
                      /* .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {background: white!important;}
                        .transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {color: #000000;}
                        .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {color: #000000!important;border-top: .1rem solid rgba(120, 130, 140, .13);}
                        .dataTables_filter{display:none;}
                        table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
                        table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
                        .dt-buttons{margin-bottom: 20px;float: right;}
                        .btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;} */
                    </style>
                    <div class="col-xl-12" >
                        <div class="card m-b-0">
                            <div class="card-header" style="padding:15px;">
                                <h4 class="card-title">Serviços em Aberto</h4>
                            </div>
                            <div class="card-body p-0">
                            <div class="event-sideber-search">
									<form action="#" method="post" class="chat-search-form">
										<input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
										<i class="fa fa-search"></i>
									</form>
								</div>
                                <div class="table-responsive" style="padding: 10px;">
									<table class="table table-padded market-capital table-responsive-fix-big" id="lista_comissao" class="display" style="width:100%">
                                     <div class="table-responsive" style="padding: 10px;">
                                        <thead>
                                            <tr>
                                            <th>Cliente</th>
                                            <th>Serviço</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                            <th>Valor</th>
                                            <th>Status</th>
                                            <th>Forma Pagamento</th>
                                            <!--<th>Entregue</th>-->
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
        <!--**********************************
            Content body end
        ***********************************-->
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
    <script src="js/jquery.mask.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>                        
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/plugins/tables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/tables/buttons.flash.min.js"></script>
    <script src="assets/plugins/tables/jszip.min.js"></script>
    <script src="assets/plugins/tables/pdfmake.min.js"></script>
    <script src="assets/plugins/tables/vfs_fonts.js"></script>
    <script src="assets/plugins/tables/buttons.html5.min.js"></script>
    <script src="assets/plugins/tables/buttons.print.min.js"></script>
    <script>

toastr.options = {"positionClass": "toast-top-full-width"};
function get_lista_resposta(){


var table = $('#lista_comissao').DataTable({
  ajax: {
    url: 'includes/servico/get_servico_hist_status_todos'
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
           "data": 'funcionario',
           "render": function (data, type, row, meta) {
                var img = row.foto_cliente + '?' + (new Date()).getTime();
                return '<a  href="cliente-'+row.id_client+'" target="_blank"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_cliente+'</a>';
			  }		
      },

      { 
          "targets": 1 , 
          "data": 'short_dec',
          
      },
      { 
          "targets": 2 , 
          "data": 'started_at'
          
      },
      { 
          "targets": 3 , 
          "data": 'ended_at'
          
      },
      
      { 
          "targets": 4 , 
          "data": 'price',
           "render": function (data, type, row, meta) {
            price = row.price;
              if(price != null){
                price = price;
               
              } else {
                price = 0;
              }
              return 'R$' + price;
           }
        },
         { 
          "targets": 5 , 
          "data": 'status',
           "render": function (data, type, row, meta) {

            status = row.status;
            
            if(status == 'Pendente'){
                status_type = 'label-light'
            } else if(status == 'Em Andamento') {
                status_type = 'label-warning'
            } else if(status == 'Cancelado') {
                status_type = 'label-cancel'
            } else {
                status_type = 'label-success'
            }
          
            return '<span style="color:'+row.color+';background:'+row.background+'" class="label label-rounded '+status_type+'">'+status+'</span>';
          }
          
      },
         { 
          "targets": 6 , 
          "data": 'forma_pagamento',
           "render": function (data, type, row, meta) {
            forma_pagamento = row.forma_pagamento;

            let acao1 , acao2 , acao3 , acao4 , acao5 , acao , acao6
            let bg
            
            bg = 'style="background:white;color:#222"';
            
            if(forma_pagamento == 'Boleto'){
                acao1 = 'selected';	
                bg = 'style="background:white;color:#222"';
            }
            if(forma_pagamento == 'Cartão Crédito') {
                acao2 = 'selected';	
                bg = 'style="background:#3ab9da;color:#fff;border-color:#3ab9da"';
            } 
            
            if(forma_pagamento == 'Cartão Débido') {
                acao3= 'selected';
                bg = 'style="background:#3F51B5;color:#fff;border-color:#3F51B5"';					
            } 
            if(forma_pagamento == 'Cheque') {
                acao4 = 'selected';	
                bg = 'style="background:grey;color:#fff;border-color:grey"';					
            } 
            if(forma_pagamento == 'Dinheiro') {
                acao5 = 'selected';	
                bg = 'style="background:#18998d;color:#fff;border-color:#18998d"';					
            } 
            if(forma_pagamento == 'Devendo') {
                acao6 = 'selected';	
                bg = 'style="background:#F44336;color:#fff;border-color:#F44336"';					
            } 
            
            return '<select '+bg+' onchange="getval(this);" id="'+row.id_book+'" class="sel_ocor_'+row.id_book+'">'+
                        '<option value=""></option>'+
                        '<option '+acao1+' value="Boleto">Boleto</option>'+
                        '<option '+acao2+' value="Cartão Crédito">Cartão Crédito</option>'+
                        '<option '+acao3+' value="Cartão Débido">Cartão Débido</option>'+
                        '<option '+acao4+' value="Cheque">Cheque</option>'+
                        '<option '+acao5+' value="Dinheiro">Dinheiro</option>'+
                        '<option '+acao6+' value="Devendo">Devendo</option>'+
                    '</select>';
          }
          
      },
         /*{ 
          "targets": 7 , 
          "data": 'status_pagamento',
           "render": function (data, type, row, meta) {

            status_pagamento =  row.status_pagamento;

            let acao1 , acao2 , acao3 , acao4 , acao5 , acao , acao6
            let bg
            
            bg = 'style="background:white;color:#222"';
            if(status_pagamento == 'Sim'){
                acao1 = 'selected';	
                bg = 'style="background:white;color:#222"';
            }
            if(status_pagamento == 'Não') {
                acao2 = 'selected';	
                bg = 'style="background:white;color:#222"';
            } 
            

            
            return '<select '+bg+' onchange="getvalfinal(this);" id="'+row.id_book+'" class="sel_ocor_pag'+row.id_book+'">'+
                        '<option value=""></option>'+
                        '<option '+acao1+' value="Sim">Sim</option>'+
                        '<option '+acao2+' value="Não">Não</option>'+
                    '</select>';
          }
          
      }, */
      

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
                messageTop: '<h2>Lista de Produtos</h2>',
                columns: ':not(.select-checkbox)',
                orientation: 'landscape',
                text: 'Imprimir',
                className: 'btn btn-primary btn-sl-sm' 
            },
            {
                extend: 'excel',
                className: 'btn btn-primary btn-sl-sm'
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary btn-sl-sm'
            }
        ],

  "deferRender": true
});


        $('#table_tub thead th').each(function () {
        var title = $(this).text();
        $(this).html(title+' <input type="text" class="col-search-input" placeholder="' + title + '" />');
        });
        
        table.columns().every(function () {
            var table = this;
            $('input', this.header()).on('keyup change', function () {
                if (table.search() !== this.value) {
                        table.search(this.value).draw();
                }
            });
        });
        
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $('input, select', table.column(colIdx).header()).on('click', function(e) {
                    e.stopPropagation();
                });
        });


};

$("#search_produtos").on("input", function (e) {
      e.preventDefault();
     $('#lista_comissao').DataTable().search($(this).val()).draw(); 
  }); 
get_lista_resposta();


function getval(sel)
{
	let id = sel.id;
	let value = sel.value;
	
	$.ajax({
		   url: 'includes/servico/update_pagamento',
		   type: 'POST',
		   dataType:"JSON",
		   data: {
			id : id,
			forma_pagamento : value
		}
	 })
	 .done(function(response){
		var json = response;
		status = json.status;
		status_txt = json.status_txt;
		let bg_color , font_color
        
        if(value == 'Boleto'){
			bg_color = '#fff';
			font_color = '#222';
            border_color = '#fff';
		}
		
		
		if(value == 'Cartão Crédito') {
			bg_color = '#3ab9da';
			font_color = '#fff';
            border_color = '#3ab9da';
		} 
		
		if(value == 'Cartão Débido') {
			bg_color = '#3F51B5';
			font_color = '#fff';
            border_color = '#3F51B5';
		} 
        
        if(value == 'Cheque') {
			bg_color = 'grey';
			font_color = '#fff';
            border_color = 'grey';
		} 
        
        if(value == 'Dinheiro') {
			bg_color = '#18998d';
			font_color = '#fff';
            border_color = '#18998d';
		} 
        
        if(value == 'Devendo') {
			bg_color = '#F44336';
			font_color = '#fff';
            border_color = '#F44336';
        } 

		$('.sel_ocor_'+id).css("background-color", bg_color);
		$('.sel_ocor_'+id).css("border-color", border_color);
		$('.sel_ocor_'+id).css("color", font_color);
		
        toastr.success(status_txt, 'Sucesso');  
	   
	 })
	 .fail(function(){
		 toastr.error(status_txt, 'Erro');
	 });
	
}

function getvalfinal(sel)
{
	let id = sel.id;
	let value = sel.value;
	
	$.ajax({
		   url: 'includes/servico/update_final',
		   type: 'POST',
		   dataType:"JSON",
		   data: {
			id : id,
			status_pagamento : value
		}
	 })
	 .done(function(response){
		var json = response;
		status = json.status;
		status_txt = json.status_txt;
		/*let bg_color , font_color
        
        if(value == 'Boleto'){
			bg_color = '#fff';
			font_color = '#222';
		}
		
		
		if(value == 'Cartão Crédito') {
			bg_color = '#3ab9da';
			font_color = '#222';
		} 
		
		if(value == 'Cartão Débido') {
			bg_color = '#3F51B5';
			font_color = '#fff';
		} 
        
        if(value == 'Cheque') {
			bg_color = 'grey';
			font_color = '#fff';
		} 
        
        if(value == 'Dinheiro') {
			bg_color = '#18998d';
			font_color = '#fff';
		} 
        
        if(value == 'Devendo') {
			bg_color = '#F44336';
			font_color = '#fff';
        } 

		$('.sel_ocor_'+id).css("background-color", bg_color); */
			toastr.success(status_txt, 'Sucesso');  
	   
	 })
	 .fail(function(){
		 toastr.error(status_txt, 'Erro');
	 });
	
}

</script>

</body>
</html>