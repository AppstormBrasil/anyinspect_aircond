<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>
<style>
    .dataTables_filter{display:none;}
    .dt-buttons{margin-bottom: 20px;float: right;}
    .btn {padding: 0.3rem 1.0rem;border-radius: 5px;}
    table thead{background: #f3f3f3;}
</style>

<div class="container-fluid">
    <div id="box_tabela" class="row">
        <div class="col-xl-12" >
            <div class="card ttransparent-card m-b-0">
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">Lista de Treinamentos</h4>
                    <a class="btn btn-primary btn-xs single_link" href="#relatoriotreinamento-15" type="button"><span>Relatório 15 dias</span></a>
                    <a class="btn btn-primary btn-xs single_link" href="#relatoriotreinamento-30" type="button"><span>Relatório 30 dias</span></a>
                    <a class="btn btn-primary btn-xs single_link" href="#relatoriotreinamento-60" type="button"><span>Relatório 60 dias</span></a>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_treinamentos" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_treinamentos" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Treinamento</th>
                                    <th>Colaborador</th>
                                    <th>Data Vencimento</th>
                                    <th>Dias</th>
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

get_lista_treinamento();
function get_lista_treinamento(){

var table = $('#lista_treinamentos').DataTable({
  ajax: {
    url: 'includes/treinamento/get_lista_treinamentos',
  },
  language: {
      "lengthMenu": " _MENU_ ",
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
  },
  pageLength: 30,   
  columnDefs: [ 
      { 
          "targets": 0 , 
          "data": 'desc_qual',  
      },
      { 
          "targets": 1 ,
          "width": "25%",
           "data": 'name',
			"render": function (data, type, row, meta) {	  
                var foto = row.foto;
                return '<a  class="single_link" href="#funcionario-'+row.id_func+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+foto+'" />'+row.name+'</a>';
			  }		   
      },
      { 
          "targets": 2 , 
          "data": 'validade_qual',
          "width": "15%"
          
      },
      { 
          "targets": 3 , 
          "data": 'dias_expira',
          "width": "10%"
          
      },
      //{ "orderable": true, "targets": 3 },

    
   ],
  "createdRow": function( row, data, dataIndex ) {
      //$(row).addClass( 'row_'+data.id );
  },
  dom: 'Blfrtip',
  "pageLength": 25, 
  buttons: [
    {
        extend: 'print',
        orientation: 'landscape',
        messageTop: '<h2>Lista de Treinamentos</h2>',
        columns: ':not(.select-checkbox)',
        orientation: 'landscape',
        text: 'Imprimir',
        className: 'btn btn-primary' 
    },
    {
        extend: 'excel',
        className: 'btn btn-primary',
        charset: 'UTF-8',
        bom: true,
    },
    {
        extend: 'pdf',
        className: 'btn btn-primary',
        charset: 'UTF-8',
        bom: true,
    },
    {
        extend: 'csv',
        className: 'btn btn-primary',
        charset: 'UTF-8',
        bom: true,
    }
    ],

  "deferRender": true
});

setTimeout(function(){
$('#lista_treinamentos thead th').each(function () {
    var title = $(this).text();
    if(title == 'Ação'){
       
    } else {
        $(this).html(title+' <input type="text" class="col-search-input" placeholder="' + title + '" />');
    }
  
    
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
}, 500);


};

$("#search_treinamentos").on("input", function (e) {
      e.preventDefault();
     $('#lista_treinamentos').DataTable().search($(this).val()).draw(); 
  }); 


</script>
