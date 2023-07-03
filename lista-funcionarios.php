<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		//echo "<script>window.location.href = '#403';</script>";
		//exit(0);
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
            <div class="card m-b-0">
                <div class="card-header" style="padding:15px;">
                    <h4 class="card-title">Lista de Funcionários</h4>
                    <a class="float-right btn btn-primary btn-xs" href="#cadastro-funcionario" type="button"><span>Novo Funcionário</span></a>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_funcionarios" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_funcionarios" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Bairro</th>
                                    <th>Cidade</th>
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


function get_lista_funcionario(){
var table = $('#lista_funcionarios').DataTable({
  ajax: {
    url: 'includes/funcionario/get_funcionarios',
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
           "data": 'name',
           "render": function (data, type, row, meta) {
                        var img = row.foto + '?' + (new Date()).getTime();
                        return '<a class="single_link" href="#funcionario-'+row.id+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.name+'</a>';
            }		
      },
      {
          "targets": 2,
          "data": 'cpf'
      },
      
      
      { 
          "targets": 3 , 
          "data": 'rg'
          
      },
      { 
          "targets": 4 , 
          "data": 'phone'
          
      },
      { 
          "targets": 5 , 
          "data": 'email'
          
      },
      { 
          "targets": 6 , 
          "data": 'neighbor'
          
      },
      {
        "targets": 7,
        "data": 'city'
        },
		{
        "targets": 8,
        "data": 'botao'
        },

      { "orderable": false, "targets": 1 },
   ],
  "createdRow": function( row, data, dataIndex ) {
      $(row).addClass( 'row_'+data.id );
  },
  dom: 'Blfrtip',
  "lengthMenu": [[25, 50,100,- 1], [25,50, 100, "Todos"]],  
  "pageLength": 25, 
  buttons: [
             {
                extend: 'print',
                orientation: 'landscape',
                messageTop: '<h2>Lista de Funcionários</h2>',
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


$("#search_funcionarios").on("input", function (e) {
    e.preventDefault();
    $('#lista_funcionarios').DataTable().search($(this).val()).draw(); 
});

setTimeout(function(){

$('#lista_funcionarios thead th').each(function () {
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





function go_to_page(id){
      window.location.href = "#funcionario-"+id+" ";
}

function RemoveItem(productId,nome,imagem){
    information = '<div class="user-info">'+
                        '<div class="image"><a class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja realmente remover este Funcionário?</h5>'+
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
                   url: 'includes/funcionario/delete_funcionario',
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
                toastr.error('Algo deu errado !', 'Error');  
             });
          });
        },
        allowOutsideClick: false			  
    });	
}
get_lista_funcionario();

</script>
