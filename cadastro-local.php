
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>
<style>
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 3px 10px;
        border-bottom: 1px solid #e4e4e4!important;
    }
    .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {
        background: white!important;
    }
    .transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {
        color: #464a53;
        border-bottom: 1px solid #e4e4e4;
        background: #f9f9f9;
    }
    .market-capital.table>tbody>tr>td, .reaction-btns a, .wallet-card .form-control {
        color: #000000!important;
    }
    .dataTables_filter{display:none;}
    table.dataTable.no-footer {
        border-bottom: 1px solid #ffffff;
    }
    
    .dt-buttons{   
        margin-bottom: 20px;
        float: right;
    }
    .btn {
        padding: 0.3rem 1.0rem;
        font-size: 1.6rem;
        border-radius: 5px;
    }

    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid #e4e4e4;
        background: #f9f9f9;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form class="forms-card" id="form-local" action="javascript:CadastroLocal();" method="post" style="width:100%;">
                <div class="card card-body">
                    <h4 class="card-title">Cadastro Local</h4>
                    
                    <div class="basic-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Descrição: <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="local" id="local" class="form-control" placeholder="" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Responsável: </label>
                                        <div class="input-group">
                                            <input type="text" name="responsavel" id="responsavel" class="form-control" placeholder=""  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Latitude: </label>
                                        <div class="input-group">
                                            <input type="text" name="lat" id="lat" class="form-control" placeholder=""  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Longitude: </label>
                                        <div class="input-group">
                                            <input type="text" name="lon" id="lon" class="form-control" placeholder=""  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4>Endereço</h2>
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="text-label">Cep</label>
                                                <input onBlur="pesquisacep(this.value);" type="text" name="cep" id="cep" class="zip form-control" placeholder="Cep">
                                            </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="text-label">Endereço</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="endereco" name="endereco"  placeholder="Endereço" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Numero</label>
                                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Número">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Complemento</label>
                                            <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Complemento" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-label">Bairro</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="bairro" name="bairro"  placeholder="Bairro" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent" >  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-label">Cidade</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="cidade" name="cidade"  placeholder="Cidade" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent" >  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-label">Estado</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-right-0" id="estado" name="estado"  placeholder="Estado" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-transparent" >  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Salvar</button>  
                                </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xl-12" >
                    <div class="card  m-b-0">
                        <div class="card-header" style="background: white;padding:15px;">
                            <h4 class="card-title">Localização</h4>
                        </div>
                        <div class="card-body p-0">
                        <div class="event-sideber-search">
                                <form action="#" method="post" class="chat-search-form">
                                    <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                                    <i class="fa fa-search"></i>
                                </form>
                            </div>
                            
                            <div class="table-responsive" style="background: white;padding: 10px;">
                                <table class="table table-padded market-capital table-responsive-fix-big" id="lista_localizacao" class="display" style="width:100%">
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
<script src="includes/local/cadastro_local.js"></script>
<script src="js/get_cep.js"></script>
	
<script>

function get_lista_local(){

var table = $('#lista_localizacao').DataTable({
  ajax: {
    url: 'includes/local/get_local',
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
           "data": 'descricao',
			"render": function (data, type, row, meta) {
						  var descricao = row.descricao;
						  return descricao;
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
     $('#lista_localizacao').DataTable().search($(this).val()).draw(); 
  });


};

setTimeout(function(){ 
    get_lista_local() 
}, 100);


</script>
