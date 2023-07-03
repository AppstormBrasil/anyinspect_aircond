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
    .dt-buttons{margin-bottom: 20px;float: right;}
    .btn {padding: 0.3rem 1.0rem;border-radius: 5px;}
    table thead{background: #f3f3f3;}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xl-12" >
                    <div class="card  m-b-0">
                        <div class="card-header" style="background: white;padding:15px;">
                            <h4 class="card-title">Localização</h4>
                            <a style="margin-bottom:15px;float:right;" class="new_local" ><span style="width:100%;padding:12px;" class="label label-xl btn-primary">Nova Localização</span></a>
                        </div>
                        <div class="card-body p-0">
                        <div class="event-sideber-search">
                                <form action="#" method="post" class="chat-search-form">
                                    <input id="search_localizacao" type="text" class="form-control" placeholder="Procurar">
                                    <i class="fa fa-search"></i>
                                </form>
                            </div>
                            <div class="table-responsive" style="background: white;padding: 10px;">
                                <table class="table table-padded market-capital table-responsive-fix-big" id="lista_localizacao" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Empresa</th>
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
<?php include('includes/modal/novo-local.php'); ?> 
        
<script src="includes/local/cadastro_local.js"></script>
<script src="js/get_cep.js"></script>
	
<script>


get_lista_cliente();

function get_lista_cliente(){
   
   $.ajax({
   url:"includes/cliente/get_client",
   dataType:'JSON',
   method:"GET",
       success:function(response){
           var option = '<option disabled selected value="none"></option>'
           var i;
           for (i = 0; i < response.data.length; i++) {
               option += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
                       
           }
           $('#id_client').html(option);
           
           setTimeout(function(){ 
                $('#id_client').select2();
            }, 100);
		
       }
   }); 
}

function get_lista_local(){
var table = $('#lista_localizacao').DataTable({
  ajax: {
    url: 'includes/local/get_local',
    dataType:'JSON'
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
  "deferRender": true,
  columnDefs: [ 
      { 
        "targets": 0 , 
        "data": 1,
        "width": "3%", 
        "data": 'id'	
      },
      { 
          "targets": 1 ,
           "data": 'nome_empresa',
			"render": function (data, type, row, meta) {
						  var nome_empresa = row.nome_empresa;
						  return nome_empresa;
			  }		   
      },
      { 
          "targets": 2 ,
           "data": 'descricao',
			"render": function (data, type, row, meta) {
						  var descricao = row.descricao;
						  return descricao;
			  }		   
      },
      
	  { 
        "targets": 3 , 
          "data": 'botao',
          "className": "text-right",
          "width": "30%", 
          
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
        messageTop: '<h2>Lista de Subcontratos</h2>',
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

  
});


setTimeout(function(){
$("#search_tube").on("input", function (e) {
e.preventDefault();
$('#lista_clientes').DataTable().search($(this).val()).draw(); 
}); 

$('#lista_localizacao thead th').each(function () {
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

$("#search_localizacao").on("input", function (e) {
      e.preventDefault();
     $('#lista_localizacao').DataTable().search($(this).val()).draw(); 
  });


};

setTimeout(function(){ 
    get_lista_local() 
}, 100);

function RemoveItem(productId,nome,imagem){
    var imagem = 'images/noimage.png'
    information = '<div class="user-info">'+
                        '<div class="image"><a class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja realmente remover esta Raça?</h5>'+
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
                   url: 'includes/local/delete_local',
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
                 swal('Oops...', 'Algum erro ao deletar !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}

$('.new_local').on('click', function(e){ 
        e.preventDefault();
        $('#nova-localizacao').modal();
});

$('#novo_responsavel').select2({
    ajax: {
        url: 'includes/funcionario/get_funcionarios',
        type : 'POST',
        dataType: 'JSON',
        delay: 10,
        data: function (params) {
            return {
                searchTerm: params.term // search term
            };
        },
        processResults: function (data, page) {
            var resultsfun = [];
            $.each(data.data, function (i, v) {
                var o = {};
                o.id = v.id;
                o.name = v.name;
                o.foto = v.foto;
                o.phone = v.phone;
                resultsfun.push(o);

            });

            return {
                results: resultsfun
            };
        },
        cache: true
        },
        escapeMarkup: function (markupfun) { return markupfun;},
        minimumInputLength: 0,
        minimumResultsForSearch: -1,
        templateResult: filfunresult,
        templateSelection: filfunselec,
    });

    function filfunresult(data) {
        var markupfun = "";
        if(data.loading){
            markupfun = "Procurando";
        }
        else if (data.id == undefined) {
            markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="single_link btn btn-primary btn-sm" href="#cadastro-funcionario" >Cadastrar Localização</a>';
            return;
        } else {
            var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
        }
        
        return markupfun;
    }
    function filfunselec(data) {
        var markupfun = "";
        if(data.loading){
            markupfun = "Procurando";
        }
        else if (data.id == undefined) {
            markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm single_link" href="#cadastro-funcionario" >Cadastrar Localização</a>';
            return;
        } else {
            var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' ' +data.phone+'</span>';
        }
        
        return markupfun;
    }
</script>
