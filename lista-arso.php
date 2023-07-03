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
                    <h4 class="card-title">Controle Arso</h4>
                    <a class="float-right btn btn-primary btn-xs single_link" href="relatorioarso" type="button"><span>Relatório</span></a>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big stripe" id="lista_clientes" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Designação</th>
                                    <th>Gestor Designado</th>
                                    <th>Representante Designado</th>
                                    <th>Comite Gestor</th>
                                    <th>Comite Tecnico</th>
                                    <th>Supervisores</th>
                                    <th>Arso</th>
                                    <th>PPSP</th>
                                    <!--<th style="text-align:right;">Ação</th>-->
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
    url: 'includes/arso/get_list_arso',
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
}   ,
  
  columnDefs: [ 
      { 
        "targets": 0,
        "data": 'id'	
      },
      { 
          "targets": 1 ,
           "data": 'nome',
            "width": "25%",
      },
      { 
          "targets": 2 , 
          "width": "20%",
          "data": 'designacao',
          
      },
      { 
          "targets": 3 , 
          "data": 'gestor',
          "class": 'text-center'
  
          
      },
	  { 
          "targets": 4 , 
          "data": 'representante',
          "class": 'text-center'
   
          
      },
      { 
          "targets": 5 , 
          "data": 'comite',
          "class": 'text-center'
  
          
      },
      { 
          "targets": 6 , 
          "data": 'tecnico',
          "class": 'text-center'
  
      },
      {
        "targets": 7,
        "data": 'supervisores',
        "class": 'text-center'

      },
      {
        "targets": 8,
        "data": 'arso',
        "class": 'text-center'
      },
      {
        "targets": 9,
        "data": 'ppsp',
        "class": 'text-center'
      },
      

      { "orderable": false, "targets": 1 },
   ],
  "createdRow": function( row, data, dataIndex ) {
      $(row).addClass( 'row_'+data.id );
  },
  dom: 'Blfrtip',
  "pageLength": 25, 
  "lengthMenu": [[25, 50,100,- 1], [25,50, 100, "Todos"]],  
  buttons: [
    {
        extend: 'print',
        orientation: 'landscape',
        messageTop: '<h2>Lista Arso</h2>',
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
$("#search_tube").on("input", function (e) {
e.preventDefault();
$('#lista_clientes').DataTable().search($(this).val()).draw(); 
}); 

$('#lista_clientes thead th').each(function () {
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

$("#search_clientes").on("input", function (e) {
      e.preventDefault();
     $('#lista_clientes').DataTable().search($(this).val()).draw(); 
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
      window.location.href = "cadastro-subcontrato";
}
get_lista_resposta();
</script>
