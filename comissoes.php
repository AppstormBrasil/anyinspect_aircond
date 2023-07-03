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
            table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
            table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
            .dt-buttons{margin-bottom: 20px;float: right;}
            .btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;}
        </style>
        <div class="col-xl-12" >
            <div class="card m-b-0">
                <div class="card-header" style="padding:15px;">
                    <h4 class="card-title">Lista de Comissões</h4>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                        <form action="#" method="post" class="chat-search-form">
                            <input id="search_produtos" type="text" class="form-control" placeholder="Procurar">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div>
                        <div class="text-center"><h3>Valores referentes ao mês <span id="mes"><?php echo $mes ?></span></h3></div>
                    </div>
                    <div class="table-responsive" style="padding: 10px;">
                        <table class="table table-padded market-capital table-responsive-fix-big" id="lista_comissao" class="display" style="width:100%">
                            <div class="table-responsive" style="padding: 10px;">
                            <thead>
                                <tr>
                                    <th>Funcionário</th>
                                    <th>Comissão</th>
                                    <th>Data</th>
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
    <input type="hidden" id="mes_atual" value="<?=$mes?>" />
</div>
    <script>
        
        function get_lista_comissao(){

        var mes_atual = $('#mes_atual').val();
        var table = $('#lista_comissao').DataTable({
        ajax: {
            url: 'includes/funcionario/get_pet_comission',
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
                "data": 'funcionario',
                "render": function (data, type, row, meta) {
                        var img = row.foto + '?' + (new Date()).getTime();
                        return '<a class="link_single"  href="#func-comissao-'+row.id+'-'+mes_atual+'  " target="_blank"><img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.funcionario+'</a>';
                    }		
            },
            { 
                "targets": 1 , 
                "data": 'comission',
                "render": function (data, type, row, meta) {
                    return 'R$' + row.comission;
                }
                
            },
            { 
                "targets": 2 , 
                "data": 'date2'
                
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
        };

        $("#search_produtos").on("input", function (e) {
            e.preventDefault();
            $('#lista_comissao').DataTable().search($(this).val()).draw(); 
        }); 
        
        get_lista_comissao();

    </script>
