<?php include('includes/common/check_permission.php'); ?>
<div class="container-fluid">
    <div id="box_tabela" class="row">
        <style>
            .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {
                color: #abafb3;
                border-bottom: 6px solid #f3f6f9;
                background: white!important;
            }

            .transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {
                color: #ffffff;
            }

            .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {
                color: #000000!important;
            }
            .dataTables_filter{display:none;}
            table.dataTable.no-footer {
                border-bottom: 1px solid #dddfe1;
            }

            .dt-buttons{   
                margin-bottom: 20px;
                float: right;
            }
        </style>
        <div class="col-xl-12" >
            <div class="card transparent-card m-b-0">
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">Lista de Clientes com mais de 30 dias sem retorno</h4>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_clientes" class="display" style="width:100%">
                            <thead style="background: #7f63f4;color: white;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Whatsapp</th>
                                    <th>E-mail</th>
                                    <th>Última Visita</th>
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

<script>
function get_lista_resposta(){
var table = $('#lista_clientes').DataTable({
  ajax: {
    url: 'includes/view/pet/get_clientes_back',
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
           "data": 'name'	
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
          "data": 'start_date'
          
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
                messageTop: '<h2>Lista de Clientes com mais de 30 dias sem retorno</h2>',
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
     $('#lista_clientes').DataTable().search($(this).val()).draw(); 
  });

get_lista_resposta();
</script>
