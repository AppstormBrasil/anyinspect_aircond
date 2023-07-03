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
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">Lista de Ferramentas (Saída)</h4>
                </div>
                
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_clientes" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="table-responsive" style="background: white;padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_ferramentas" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Base</th>
                                    <th>Descrição</th>
                                    <th>Localização</th>
                                    <th>Patrimônio</th>
                                    <th>Calibracao</th>
                                    <th>Vencimento</th>
                                    <th>Dias</th>
                                    <th>Tipo</th>
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

<?php include('includes/modal/tooling-historic.php'); ?>

<script>
function get_lista_resposta(){

var table = $('#lista_ferramentas').DataTable({
  ajax: {
    url: 'includes/ferramenta/get_ferramentas_out',
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
        "width": "3%", 
        "data": 'base'	
      },
      { 
          "targets": 2 ,
          "width": "25%",
           "data": 'descricao',
			"render": function (data, type, row, meta) {
						  var foto_ativo = row.foto_ativo + '?' + (new Date()).getTime();
						  return '<a  class="single_link" href="#ferramenta-'+row.id+'" ><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+foto_ativo+'" />'+row.descricao+'</a>';
			  }		   
      },
      { 
          "targets": 3 , 
          "data": 'local',
          "width": "15%"
          
      },
      { 
          "targets": 4 , 
          "data": 'patrimonio',
          "width": "10%"
          
      },
      { 
          "targets": 5 , 
          "data": 'calibracao',
          "width": "8%", 
          "render": function (data, type, row, meta) {
            var calibracao = row.calibracao;
            if(calibracao == '00/00/0000'){
                calibracao = '';
            } else {
                calibracao = calibracao;
            }

            return  calibracao;
          }
          
      },  
      { 
          "targets": 6 , 
          "data": 'data_validade',
          "width": "8%",
          "render": function (data, type, row, meta) {
            var data_validade = row.data_validade;
            if(data_validade == '00/00/0000'){
                data_validade = '';
            } else {
                data_validade = data_validade;
            }

            return  data_validade;
          }   
      },
      { 
          "targets": 7 , 
          "data": 'data_validade_',
          "width": "5%",
          "render": function (data, type, row, meta) {
            var data_validade = row.data_validade;
            var data_validade_ = row.data_validade.split("/");
            if(data_validade == '00/00/0000'){
                return '';
            } else {
                data_val_now = data_validade_[1]+'/'+data_validade_[0]+'/'+data_validade_[2];
                var today = moment().format('MM/DD/YYYY');
                var a = moment(today,'M/D/YYYY'); 
                var b = moment(data_val_now,'M/D/YYYY'); 
                var diffDays = b.diff(a, 'days');
                if(diffDays > 0){
                    diffDays = '<span style="color:#fff;background:undefined" class="label label-rounded label-success">'+diffDays+'</span>';
                } else if(diffDays > 0 && diffDays < 15) {
                    diffDays = '<span style="color:#fff;background:undefined" class="label label-rounded label-warning">'+diffDays+'</span>';
                } else {
                    diffDays = '<span style="color:#fff;background:undefined" class="label label-rounded label-danger">'+diffDays+'</span>';
                }
            }
                return diffDays;
            }	
          
      },
      { 
          "targets": 8 , 
          "data": 'tipo',
          "width": "10%"
          
      },
    {
    "targets": 9,
    "width": "10%",
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
        messageTop: '<h2>Lista de Ferramentas</h2>',
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


$("#search_clientes").on("input", function (e) {
      e.preventDefault();
     $('#lista_ferramentas').DataTable().search($(this).val()).draw(); 
  }); 

setTimeout(function(){
    $('#lista_ferramentas thead th').each(function () {
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
  
  
        function go_to_page_single(){
            window.location.href = "cadastro-embarcacao";
        }

        get_lista_resposta();

        function searchToolingOut(id_tooling){
            var table = "";

            $.ajax({
                url: 'includes/ferramenta/get_single_tooling_out',
                type: 'POST',
                dataType:"json",
                data: {
                    id_tooling : id_tooling
                }
             })
             .done(function(response){
                $("#tableToolingOut").html(null);
                
                if(response.length > 0){
                    response.forEach(function(row){

                        if(row.acao == 1){
                            var acao = "Entrada";
                        }else{
                            var acao = "Saída";
                        }

                        table += '<tr>' +
                        '<td>' + row.colaborador.name + '</td>' +
                        '<td>' + row.data_acao + '</td>' +
                        '<td>' + acao + '</td>' +
                        '<td>' + row.destino + '</td>' +
                        '<td>' + row.os_number + '</td>' +
                        '<td>' + row.obs + '</td>' +
                        '</tr>';
                    });

                    $("#tableToolingOut").html(table);
                }
                
                $("#historico_ferramenta").modal();
             })
             .fail(function(){
                 swal('Oops...', 'Erro ao pegar informações!', 'error');
             });
        }

</script>
