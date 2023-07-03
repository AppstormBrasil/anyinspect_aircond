<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>

<div class="container-fluid">
    <div id="box_tabela" class="row">
        <style>
            .dt-buttons{margin-bottom: 20px;float: right;}
            .btn {padding: 0.3rem 1.0rem;font-size: 12px;border-radius: 5px;line-height: 15px;}
            tbody td {
                padding: 0px 0px!important;
                font-size: 12px;
            }
            table.dataTable thead th, table.dataTable tfoot th {
                font-weight: 600;
                color: #6b6b6b;
            }
            .dataTables_wrapper .dataTables_filter input {
                display:none;
            }
        </style>
        <div class="col-xl-12" >
            <div class="card ttransparent-card m-b-0">
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">AERONAVE - PRCNC</h4>
                    <button class="float-right btn btn-primary btn-xs" href="#cadastro-cliente" type="button"><span>Novo Ítem</span></button>
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
                                    <th>Item</th>
                                    <th>Task</th>
                                    <th>Descrição</th>
                                    <th>Frequencia</th>
                                    <th>DAYS/FHC/FC</th>
                                    <th>Execução</th>
                                    <th>Próx.Execução</th>
                                    <th>Remaining</th>
                                    <th>MainHour</th>
                                    <th>Valor</th>
                                    <th>OS</th>
                                    <th>Empresa</th>
                                    <th>Doc</th>
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

var table = $('#lista_clientes').DataTable({
  ajax: {
    url: 'includes/prcnc/get_prcnc',
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
lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
"iDisplayLength": 25,
  
  columnDefs: [ 
      { 
        "targets": 0 , 
        "data": 1,
        "width": "15%", 
        "data": 'item',
        "render": function (data, type, row, meta) {
                    var remain = row.remain;
                    var item = row.item;
                    if(remain != ''){
                        if(remain > 0){
                            return '<span style="color:#fff;border-radius: 50%;padding: 5px;margin-right: 5px;" class="label label-rounded label-success"></span>'+item;
                        } else {
                            return '<span style="color:#fff;border-radius: 50%;padding: 5px;margin-right: 5px;" class="label label-rounded label-danger"></span>'+item;
                        }
                    } else {

                    }
                    return item;
        }		
      },
      { 
          "targets": 1 ,
          "width": "25%",
           "data": 'task' 
      },
      { 
          "targets": 2 , 
          //"width": "10%",
          "data": 'task_description',
          "width": "45%",
          
      },
      { 
          "targets": 3 , 
          "data": 'frequencia',
          "width": "3%", 
          
      },
	  { 
          "targets": 4 , 
          "data": 'days',
          "width": "3%", 
          
      },
      { 
          "targets": 5 , 
          "data": 'exec',
          "width": "3%", 
          
      },
      { 
          "targets": 6 , 
          "data": 'next_exec',
          "width": "5%", 
                    
      },
      { 
          "targets": 7 , 
          "data": 'remain',
          "width": "3%", 
                    
      },
      { 
          "targets": 8 , 
          "data": 'hh',
          "width": "3%", 
                    
      },
      { 
          "targets": 9 , 
          "data": 'price',
          "width": "3%", 
                    
      },
      { 
          "targets": 10 , 
          "data": 'order_',
          "width": "5%", 
                    
      },
      { 
          "targets": 11 , 
          "data": 'company',
          "width": "5%", 
                    
      },
      { 
          "targets": 12 , 
          "data": 'doc',
          "width": "5%", 
                    
      },
      
    {
    "targets": 13,
    "data": 'botao',
    "className": "text-right",
    "width": "3%", 
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
                messageTop: '<h2>Lista de Clientes</h2>',
                columns: ':not(.select-checkbox)',
                orientation: 'landscape',
                text: 'Imprimir',
                className: 'btn btn-light' 
            },
            {
                extend: 'excel',
                className: 'btn btn-light'
            },
            {
                extend: 'pdf',
                className: 'btn btn-light'
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
                        '<div class="image"><a class="waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="images/noimage.png" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h5>Você deseja atualizar esta Task ?</h5>'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<br><h4><strong>Frequencia</strong></h4>'+
                                '<span><input id="date_status" class="datetimepicker_new" value="" type="text" style="margin-bottom: 10px;width:100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" ></input></span>'+
                            '<br>'+
                            '<br><h4><strong>DAYS/FH/FC</strong></h4>'+
                                '<span><input id="date_status" class="datetimepicker_new" value="" type="text" style="margin-bottom: 10px;width:100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" ></input></span>'+
                            '<br>'+
                                
                        '</div>'+
                    '</div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Salvar!',
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

