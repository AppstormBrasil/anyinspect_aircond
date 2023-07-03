<?php include('includes/common/check_permission.php');
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
    .dt-buttons{margin-bottom: 20px;float: right;}
    .btn {padding: 0.3rem 1.0rem;border-radius: 5px;}
    table thead{background: #f3f3f3;}
</style>
        <div class="col-xl-12" >
            <div class="card ttransparent-card m-b-0">
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_ativos" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Ativo</th>
                                    <th>Modelo</th>
                                    <th>Nº Série</th>
                                    <th>Local</th>
                                    <th>Check-list</th>
                                    <!--<th>Validade</th>-->
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
function get_lista_ativos(){

var table = $('#lista_ativos').DataTable({
  ajax: {
    url: 'includes/cliente/get_ativos',
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
        "width": "3%", 
        "data": 'id'	
      },
      { 
          "targets": 1 , 
          //"width": "10%",
          "data": 'nome_client',
          "width": "25%",
          "render": function (data, type, row, meta) {
                        var foto_client = row.foto_client + '?' + (new Date()).getTime();
                        return '<a class="single_link" href="#cliente-'+row.id_client+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+row.foto_client+'" />'+row.nome_client+'</a>';
			  }	
          
      },
      { 
          "targets":2 ,
          "width": "20%",
           "data": 'descricao',
			"render": function (data, type, row, meta) {
						  var foto_ativo = row.foto_ativo + '?' + (new Date()).getTime();
						  //return '<a  href="#ativo-'+row.id+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+foto_ativo+'" />'+row.descricao+'</a>';
						  return '<a class="single_link" href="#ativo-'+row.id+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+foto_ativo+'" />'+row.descricao+'</a>';
			  }		   
      },
      { 
          "targets":3 , 
          "data": 'model',
          "width": "8%"
          
      },
      { 
          "targets":4, 
          "data": 'register',
          "width": "8%"
          
      },
      { 
          "targets":5, 
          "data": 'local',
          "width": "15%"
          
      },
      { 
          "targets":6, 
          "data": 'short_dec',
          "width": "8%", 
          
      },  
      /*{ 
          "targets":7, 
          "data": 'data_validade',
          "width": "8%", 
          
      },*/
      
        {
        "targets":7,
        "width": "15%",
        "data": 'botao',
        "className": "text-right"
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
        messageTop: '<h2>Lista de Aeronaves</h2>',
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
    $('#lista_ativos thead th').each(function () {
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
     $('#lista_ativos').DataTable().search($(this).val()).draw(); 
  }); 
function RemoveItem(productId,nome,imagem){
    information = '<div class="user-info">'+
                        '<div class="image"><a class="waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
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
                   url: 'includes/ativo/delete_ativo',
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
                toastr.error('Erro ao deletar!', 'Sucesso');  
             });
          });
        },
        allowOutsideClick: false			  
    });	
}   

get_lista_ativos();
    </script>

