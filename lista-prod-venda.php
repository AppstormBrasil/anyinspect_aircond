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
 <style>       
    table.dataTable tbody th, table.dataTable tbody td {padding: 3px 10px;border-bottom: 1px solid #e4e4e4!important;}
    .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {background: white!important;}
    .transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {color: #464a53;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
    .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {color: #000000!important;}
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
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">Lista de Produtos à venda</h4>
                    <button class="float-right btn btn-primary btn-xs" onclick="go_to_page_single()" type="button"><span>Novo Produto</span></button>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_product" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome do Produto</th>
                                    <th>Categoria</th>
                                    <th>Valor</th>
                                    <th>Estoque</th>
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
    url: 'includes/loja/get-list-prod-venda.php',
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
          "data": 'titulo',
      "render": function (data, type, row, meta) {
              var img = row.foto + '?' + (new Date()).getTime();
              return '<a class="single_link" href="venda_produto-'+row.id+'" ><img style="width: 30px;border-radius: 20%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.titulo+'</a>';
            }
      },
      { 
          "targets": 2 , 
          "data": 'categoria',
          "width": "-30%", 
          
      },
      { 
          "targets": 3 , 
          "data": 'preco',
          "width": "-30%", 
          
      },
      { 
          "targets": 4 , 
          "data": 'qtd',
          "width": "-30%", 
          
      },
	  { 
          "targets": 5 , 
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

$("#search_produtos").on("input", function (e) {
      e.preventDefault();
     $('#lista_product').DataTable().search($(this).val()).draw(); 
  }); 
    function go_to_page_single(){
      window.location.href = "cadastro-prod-venda";
}

function RemoveItem(id,titulo){
    information = '<div class="user-info">'+
                        '<div class="detail">'+
                            '<h4><strong>'+titulo+'</strong></h4>'+
                            '<h5>Você deseja realmente remover este Produto?</h5>'+
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
                   url: 'includes/loja/delete-prod-venda.php',
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
                //$('.row_'+id).remove();
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