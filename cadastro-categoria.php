<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>
	
<style>
.table-padded td {padding: 0px 5px!important;font-size:13px;}
.dataTables_filter{display:none;}
table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
table.dataTable thead th, table.dataTable thead td {padding: 10px 15px;background: #f9f9f9;font-size: 12px;font-weight: 500;color: #000;}
.dt-buttons{margin-bottom: 20px;float: right;}
.btn {padding: 0.3rem 1.0rem;font-size: 13px;border-radius: 5px;}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="forms-card">
                <div class="card card-body">
                    <h4 class="card-title">Cadastro de Categoria</h4>
                    <div class="basic-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Categoria: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="description" id="description" class="form-control" placeholder="" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <button type="button" onclick="salvarCategoria()" class="btn btn-primary">Salvar nova categoria</button>  
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="row">
                            <div class="col-xl-12" >
                                <div class="m-b-0">
                                    <div class="card-header" style="background: white;padding:15px;">
                                        <h4 class="card-title">Categorias Cadastrados</h4>
                                    </div>
                                    <div class="card-body p-0">
                                    <div class="event-sideber-search">
                                            <form action="#" method="post" class="chat-search-form">
                                                <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                                                <i class="fa fa-search"></i>
                                            </form>
                                        </div>
                                        
                                        <div class="table-responsive" style="background: white;padding: 10px;">
                                            <table class="table table-padded market-capital table-responsive-fix-big stripe" id="lista_categoria" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Descrição</th>
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
                </div>
            </div>
        </div>      
    </div>
</div>

<script src="includes/categoria/cadastra_categoria.js"></script>
	
<script>

function get_lista_categoria(){

var table = $('#lista_categoria').DataTable({
  ajax: {
    url: 'includes/categoria/get_categoria',
    dataType:'JSON'
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
           "data": 'description',
			"render": function (data, type, row, meta) {
						  var description = row.description;
						  return description;
			  }		   
      },
      
	  { 
        "targets": 2 , 
          "data": 'botao',
          "className": "text-right",
          "width": "30%", 
          
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

$("#search_produtos").on("input", function (e) {
      e.preventDefault();
     $('#lista_categoria').DataTable().search($(this).val()).draw(); 
  });


};

setTimeout(function(){ get_lista_categoria() }, 100);

function RemoveItem(productId,nome,imagem){
    information = '<div class="user-info">'+
                        '<div class="image"><a class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja realmente remover esta Categoria?</h5>'+
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
                   url: 'includes/categoria/delete_categoria',
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
                toastr.error('Algum erro ao deletar', 'Error'); 
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}

function go_to_page_single(){
      window.location.href = "cadastro-categoria";
}

</script>
