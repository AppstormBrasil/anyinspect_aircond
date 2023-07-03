<!DOCTYPE html>
<html lang="pt">
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
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_manuais" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_manuais" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Pub</th>
                                    <th>Rev</th>
                                    <th>Data Eff</th>
                                    <th>Descrição</th>
                                    <th>Tipo</th>
                                    <th>Ref.Fabricante</th>
                                    <th>Empresa</th>
                                    <th>Link</th>
                                    <th>Ação</th>
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

var table = $('#lista_manuais').DataTable({
  ajax: {
    url: 'includes/manuais/get_ativos',
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
        "targets": 0 , 
        "data": 1,
        "width": "3%", 
        "data": 'id'	
      },
      { 
          "targets": 1 ,
          "width": "15%",
           "data": 'pub',
   
      },
      { 
          "targets": 2 , 
          "data": 'rev',
          "width": "5%"
          
      },
      { 
          "targets": 3 , 
          "data": 'data_eff',
          "width": "10%"
          
      },
      { 
          "targets": 4 , 
          "data": 'descricao',
          "width": "15%", 
      },  
      { 
          "targets": 5 , 
          "data": 'tipo',
          "width": "8%",
      },
      { 
          "targets": 6 , 
          //"width": "10%",
          "data": 'ref_fabricante',
          "width": "5%",
      },
        {
        "targets": 7,
        "width": "5%",
        "data": 'empresa',
        "className": "text-right"
        },
        {
        "targets": 8,
        "width": "5%",
        "data": 'link',
        "render": function (data, type, row, meta) {
            var id = row.id;
            if(row.link == ''){
                return  '';
            } else {
                return  '<a style="margin-right: 5px;" class="btn btn-light btn-xs" target="_blank" href="'+row.link+'"><i class="icon-eye f-s-16"></i></a>';
            }
            
          }
        },
        {
        "targets": 9,
        "width": "5%",
        "data": 'id',
        "render": function (data, type, row, meta) {
            var id = row.id;
            return  '<a style="margin-right: 5px;" class="single_link btn btn-light btn-xs" id="1" href="manual/'+row.id+'"><i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('+row.id+',`'+row.descricao+'`)" id="1" type="button"><i class="icon-trash f-s-16"></i></button>';
          }
        },
        

      { "orderable": false, "targets": 1 },
   ],
  "createdRow": function( row, data, dataIndex ) {
      $(row).addClass( 'row_'+data.id );
  },
  dom: 'Blfrtip',
  "pageLength": 25, 
  buttons: [
    {
        extend: 'print',
        orientation: 'landscape',
        messageTop: '<h2>Lista de Manuais</h2>',
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
    $('#lista_manuais thead th').each(function () {
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

$("#search_manuais").on("input", function (e) {
      e.preventDefault();
     $('#lista_manuais').DataTable().search($(this).val()).draw(); 
  }); 

  
function RemoveItem(productId,nome){
    information = '<div class="user-info">'+
                        '<div class="image"><a class="waves-effect waves-block"></a></div>'+
                        '<div class="detail">'+
                            '<h5>Você deseja remover este Ativo ?</h5>'+
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
                   url: 'includes/manuais/delete_manual',
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
                 toastr.error('Erro ao deletar!', 'Error');  
             });
          });
        },
        allowOutsideClick: false			  
    });	
}  

get_lista_resposta();
</script>
