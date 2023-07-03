<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("m");
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
                                    <th>Cliente</th>
                                    <th>Ativo</th>
                                    <th>Serviço</th>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Relatório</th>
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
    url: 'includes/servico/get_servico_hist_status_todos.php'
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
           "data": 'nome_empresa',
           "render": function (data, type, row, meta) {
                var img = row.foto_cliente + '?' + (new Date()).getTime();
                return '<a  href="#cliente-'+row.id_client+'" class="single_link"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_empresa+'</a>';
			  }		
      },
      { 
          "targets": 1 ,
           "data": 'descricao',
           "render": function (data, type, row, meta) {
                var img = row.foto_ativo + '?' + (new Date()).getTime();
                descricao = row.descricao;
                if(descricao != null){
                    descricao = '<a  href="#ativo-'+row.id_ativo+'" class="single_link"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+descricao+'<small>('+row.qrcode+')</small></a>';
               
              } else {
                descricao = "-";
              }
                return descricao;
			  }		
      },
      { 
          "targets": 2 , 
          "data": 'short_dec',

          "render": function (data, type, row, meta) {
                //var img = row.foto_ativo + '?' + (new Date()).getTime();
                var short_dec = row.short_dec;
                if(short_dec == null || short_dec == 'null'){
                    short_dec = 'N/A';
                } else {
                    short_dec = short_dec.substring(0, 25)+'...';
                
                }
                 
                return '<a  href="#atividade-'+row.id_book+'-'+row.service_name+'" class="single_link">'+short_dec+'</a>';
			  }	
          
      },
      { 
          "targets": 3 , 
          "data": 'started_at'
          
      },
      { 
          "targets": 4 , 
          "data": 'ended_at'
          
      },
      { 
          "targets": 5 , 
          "data": 'price_total',
           "render": function (data, type, row, meta) {
            id_book = row.id_book;
            id_servico = row.id_servico;
              
              return '<i class="mdi mdi-file-document"></i><a href="#relatoriopmoc-'+id_book+'-'+id_servico+'" class="single_link">Relatório</a>';
           }
        },
         { 
          "targets": 6 , 
          "data": 'status',
           "render": function (data, type, row, meta) {
            status = row.status;
            if(status == 'Pendente'){
                status_type = 'label-light'
            } else if(status == 'Em Andamento') {
                status_type = 'label-warning'
            } else {
                status_type = 'label-success'
            }
            return '<span style="color:'+row.color+';background:'+row.background+'" class="label label-rounded '+status_type+'">'+status+'</span>';
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
