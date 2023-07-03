<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("m");
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>

<div class="container-fluid">
    <div id="box_tabela" class="row">
        <style>
            .transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {color: #000000;}
            .dataTables_filter{display:none;}
            table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
            table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
            .dt-buttons{margin-bottom: 20px;float: right;}
            .btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;}
        </style>
        <div class="col-xl-12" >
            <div class="card m-b-0">
                <div class="card-header" style="padding:15px;">
                    <h4 class="card-title">Histórico de Serviços</h4>
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
                                <th>Funcionário</th>
                                <th>Valor</th>
                                <th>Status</th>
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

<script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script>
function get_lista_resposta(){
var table = $('#lista_comissao').DataTable({
  ajax: {
    url: 'includes/servico/get_servico_hist.php'
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
                return '<a  href="#cliente-'+row.id_client+'" class="single_link"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_cliente+'</a>';
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
           "data": 'funcionario',
           "render": function (data, type, row, meta) {
                var img = row.foto_funcionario + '?' + (new Date()).getTime();
                nome_funcionario = row.nome_funcionario;
                if(nome_funcionario != null){
                    nome_funcionario = nome_funcionario;
               
              } else {
                nome_funcionario = "0";
              }
                return '<a  href="#funcionario-'+row.id_funcionario+'" class="single_link"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+nome_funcionario+'</a>';
			  }		
      },
      { 
          "targets": 5 , 
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
          "targets": 6 , 
          "data": 'status',
           "render": function (data, type, row, meta) {

            status = row.status;
            
            if(status == 'Pendente'){
                status_type = 'label-light'
            } else if(status == 'Em Andamento') {
                status_type = 'label-warning'
            } else {
                status_type = 'label-success'
            }
          
            return '<span style="color:'+row.color+';background:'+row.background+'" class="label label-rounded '+status_type+'">'+status+'</span>';
          }
          
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
                messageTop: '<h2>Lista de Produtos</h2>',
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

</script>