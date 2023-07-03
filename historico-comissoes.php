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
            .dataTables_filter{display:none;}
            table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
            .dt-buttons{margin-bottom: 20px;float: right;}
            .btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;}
        </style>
        <div class="col-xl-12" >
            <div class="card m-b-0">
                <div class="card-header" style="padding:15px;">
                    <h4 class="card-title">Histórico de Comissões</h4>
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
                                <th>Funcionário</th>
                                <th>Serviço</th>
                                <th>Data</th>
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
    <input type="hidden" id="mes_atual" value="<?=$mes?>" />
</div>


<script>
function get_lista_resposta(){
var mes_atual = $('#mes_atual').val();
var table = $('#lista_comissao').DataTable({
  ajax: {
    url: 'includes/funcionario/get_func_comission_historico',
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
                var img = row.foto + '?' + (new Date()).getTime();
                return '<a  href="#func-comissao-'+row.id_funcionario+'-'+mes_atual+'" class="single_link"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.funcionario+'</a>';

			  }		
      },
      { 
          "targets": 1 , 
          "data": 'short_dec',
          /*"render": function (data, type, row, meta) {
              return 'R$' + row.comission;
          }*/
          
      },
      { 
          "targets": 2 , 
          "data": 'ended_at'
          
      },
      { 
          "targets": 3 , 
          "data": 'comission',
           "render": function (data, type, row, meta) {
              return 'R$' + row.comission;
           }
        },
         { 
          "targets": 4 , 
          "data": 'status',
           "render": function (data, type, row, meta) {

            status = row.status;
            background = row.background;
            color = row.color;
            
            if(status == 'Pendente'){
                status_type = 'label-light'
            } else if(status == 'Em Andamento') {
                status_type = 'label-warning'
            } else {
                status_type = 'label-success'
            }
          
            return '<span style="background:'+background+';color:'+color+'" class="label  label-rounded ">'+status+'</span>';
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
