<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '403';</script>";
		exit(0);
	}
?>
<style>   
    .dataTables_filter{display:none;}
    table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
    .dt-buttons{margin-bottom: 20px;float: right;}
    .btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;}
    table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
</style>
<div class="container-fluid">
    <div id="box_tabela" class="row">
        <div class="col-xl-12" >
            <div class="card m-b-0">
                <div class="card-header" style="padding:15px;">
                    <h4 class="card-title">Lista de Pacotes</h4>
                    <button class="float-right btn btn-primary" onclick="go_to_page_single()" type="button"><span>Novo Pacote</span></button>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_product" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome do pacote</th>
                                    <th>Valor</th>
                                    <th>Data cadastrado</th>
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

<script>
get_lista_produtos();
function get_lista_produtos(){
var table = $('#lista_product').DataTable({
  ajax: {
    url: 'includes/pacotes/get_pacote',
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
          "targets": 1,
          "data": 'nome',
          "width": "3%", 
      },
      { 
          "targets": 2 , 
          "data": 'valor',
          "width": "3%", 
          
      },
      { 
          "targets": 3 , 
          "data": 'data_cadastro',
          "width": "3%", 
          
      },
	  { 
          "targets": 4 , 
          "data": 'botao',
          "className": "text-right",
          "width": "10%", 
          
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
                className: 'btn btn-primary btn-xs' 
            },
            {
                extend: 'excel',
                className: 'btn btn-primary btn-xs'
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary btn-xs'
            }
        ],

  "deferRender": true
});
};

$("#search_produtos").on("input", function (e) {
      e.preventDefault();
     $('#lista_product').DataTable().search($(this).val()).draw(); 
  }); 
    function go_to_page_single(){
      window.location.href = "cadastro-pacote";
}

function RemoveItem(id,nome){
    information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja realmente remover este Pacote?</h5>'+
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
                   url: 'includes/pacotes/delete_pacote',
                   type: 'POST',
                   dataType:"json",
                   data: {
                    id : id
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
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}

</script>
