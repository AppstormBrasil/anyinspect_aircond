<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("m");
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
            <div class="card m-b-0">
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">Histórico de Atividades</h4>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_atividades" class="display" style="width:100%">
                            <div class="table-responsive" style="background: white;padding: 10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Atividade</th>
                                    <th>Data|Hora</th>
                                    <th>Visualizar</th>
                                    <th>Status</th>
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

var table = $('#lista_atividades').DataTable({
  ajax: {
    url: 'includes/dashboard/get_open_eventos_group_all'
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
           "data": 'id_group',
           "render": function (data, type, row, meta) {
                var img = row.foto_cliente + '?' + (new Date()).getTime();
                return '<a  href="#detalhe-grupo-'+row.id_group+'" class="single_link" >#'+row.id_group+'</a>';
			  }		
      },
      { 
          "targets": 1 ,
           "data": 'nome_empresa',
           "render": function (data, type, row, meta) {
                var img = row.foto_cliente + '?' + (new Date()).getTime();
                return '<a  href="#cliente-'+row.id_client+'" class="single_link" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_cliente+'</a>';
			  }		
      },
      { 
          "targets": 2 ,
           "data": 'desc_service',
           "render": function (data, type, row, meta) {
                var img = row.foto_ativo + '?' + (new Date()).getTime();
                desc_service = row.desc_service;
                if(desc_service != null){
                    desc_service = desc_service;
               
              } else {
                desc_service = "-";
              }

                var desc_service = '<strong>('+row.total_groups+')</strong>'+desc_service.substring(0, 20)+'...';
                return desc_service;
			  }		
      },
      { 
          "targets": 3 , 
          "data": 'br_start'
          
      },
      { 
          "targets": 4 , 
          "data": 'id_form',
           "render": function (data, type, row, meta) {
            id_book = row.id_book;
            id_servico = row.id_servico;
              
              return '<i class="mdi mdi-file-document"></i><a href="#detalhe-grupo-'+row.id_group+'" class="single_link" >Relatório</a>';
           }
        },
         { 
          "targets": 5 , 
          "data": 'status_',
           "render": function (data, type, row, meta) {

            status = row.status_;
            
            if(status == 'Pendente'){
                status_type = 'label-light'
            } else if(status == 'Em Andamento') {
                status_type = 'label-warning'
            } else if(status == 'Cancelado') {
                status_type = 'label-danger'
            } else if(status == 'Concluído') {
                status_type = 'label-success'
            } else {
                status_type = 'label-secondary'
            } 
          
            return '<span style="color:'+row.textColor+';background:'+row.background+'" class="label label-rounded '+status_type+'">'+status+'</span>';
          }
          
      },

      { "orderable": false, "targets": 1 },
   ],
  "createdRow": function( row, data, dataIndex ) {
      $(row).addClass( 'row_'+data.id_ativo );
  },
  dom: 'Blfrtip',
  "pageLength": 25, 
  buttons: [
    {
        extend: 'print',
        orientation: 'landscape',
        messageTop: '<h2>Lista de Atividades</h2>',
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


        $('#lista_atividades thead th').each(function () {
        var title = $(this).text();
        $(this).html(title+' <input type="text" class="col-search-input" placeholder="' + title + '" />');
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


};

$("#search_produtos").on("input", function (e) {
      e.preventDefault();
     $('#lista_atividades').DataTable().search($(this).val()).draw(); 
  }); 
get_lista_resposta();


function getval(sel)
{
	let id = sel.id;
	let value = sel.value;
	
	$.ajax({
		   url: 'includes/servico/update_pagamento',
		   type: 'POST',
		   dataType:"JSON",
		   data: {
			id : id,
			forma_pagamento : value
		}
	 })
	 .done(function(response){
		var json = response;
		status = json.status;
		status_txt = json.status_txt;
		let bg_color , font_color
        
        if(value == 'Boleto'){
			bg_color = '#fff';
			font_color = '#222';
		}
		
		
		if(value == 'Cartão Crédito') {
			bg_color = '#3ab9da';
			font_color = '#fff';
		} 
		
		if(value == 'Cartão Débido') {
			bg_color = '#3F51B5';
			font_color = '#fff';
		} 
        
        if(value == 'Cheque') {
			bg_color = 'grey';
			font_color = '#fff';
		} 
        
        if(value == 'Dinheiro') {
			bg_color = '#18998d';
			font_color = '#fff';
		} 
        
        if(value == 'Devendo') {
			bg_color = '#F44336';
			font_color = '#fff';
        } 

		$('.sel_ocor_'+id).css("background-color", bg_color);
			toastr.success(status_txt, 'Sucesso');  
	   
	 })
	 .fail(function(){
		 toastr.error(status_txt, 'Erro');
	 });
	
}

function getvalfinal(sel)
{
	let id = sel.id;
	let value = sel.value;
	
	$.ajax({
		   url: 'includes/servico/update_final',
		   type: 'POST',
		   dataType:"JSON",
		   data: {
			id : id,
			status_pagamento : value
		}
	 })
	 .done(function(response){
		var json = response;
		status = json.status;
		status_txt = json.status_txt;
        
        $('.row_'+id).fadeOut()
		toastr.success(status_txt, 'Sucesso');  
	   
	 })
	 .fail(function(){
		 toastr.error(status_txt, 'Erro');
	 });
	
}

</script>
