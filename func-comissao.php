<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("m");
    $user_level = get_user_level();
    if($user_level != 'a'){ 
        echo "<script>window.location.href = '#403';</script>";
        exit(0);
    } 
    $id = $_GET['id'];
    $month = $_GET['month'];
?>
<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
<body>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card invoice-info-card" style="margin: auto;">
                <div class="card-header text-center">
                    <h4>Informações de Pagamento</h4><h1 class="mb-5">SETEMBRO - 2021</h1>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6 col-xl-9">
                            <div class="invoice-info-left">
                                <div class="distributors">
                                    <div class="mb-4">
                                    <span id="foto_empresa" > </span>
                                        <h4 id="nome_empresa" class="text-primarys mb-2" style="padding-top:20px;" ></h4>
                                        <a id="email_empresa"  class="text-muted"></a>
                                    </div>
                                    <div  style="margin-top:20px;" class="mb-4">
                                        <h5 id="endereco_empresa"></h5>
                                        <h5 id="cidade_empresa"></h5>
                                        <h5 id="cep_empresa" ></h5>
                                    </div>
                                    <div class="mb-4">
                                        <h5 id="telefone_empresa">Telefone: <span class="text-muted"></span></h5>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 ">
                            <div class="invoice-info-right">
                                    <div class="mb-4">
                                    <span id="foto_funcionario"><img  style="width:65px;height:65px;float: left;" class="avatar_table" src="assets/images/nouser.png" alt=""> </span>
                                        <h4 id="nome_funcionario" class="text-primarys mb-2" style="padding-top:20px;" ></h4>
                                        <a id="email_funcionario"  class="text-muted"></a>
                                    </div>
                                    <div  style="margin-top:20px;" class="mb-4">
                                        <h5 id="endereco_funcionario"></h5>
                                        <h5 id="cidade_funcionario"></h5>
                                        <h5 id="cep_funcionario" ></h5>
                                    </div>
                                    <div class="mb-4">
                                        <h5 id="telefone_funcionario">Telefone: <span class="text-muted"></span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 col-xl-12 mb-12">
                    </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table invoice-details-table" style="min-width: 500px;">
                                    <thead>
                                        <tr>
                                            <th>Serviço</th>
                                            <th>Data</th>
                                            <th class="text-center">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_comissao">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end my-4">
                                <button onclick="window.print();" class="btn btn-primary btn-sl-lg mr-3 no-print" style="color:#222;background: #f9f9f9;border-color: #d2d2d2;">Imprimir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="data" value="<?=$month?>" />
    <input type="hidden" id="id_func" value="<?=$id?>" />
</div>

    <script>
        function get_info_gerais(){
            var data = $("#data").val();
            var id_func = $("#id_func").val();

            $.ajax({
            url:"includes/funcionario/get_info_geral_comissao",
            method:"GET",
            dataType: 'JSON',
            data:{
                id:id_func,
                month:data
            
            },
                success:function(response){

                var empresa = response.empresa;
                var funcionario = response.funcionario;
                var comissao = response.comission;
                var comission_total = response.comission_total.comissao_total;

                var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
                var foto_funcionario = funcionario.foto_funcionario +'?' + (new Date()).getTime();
                var id_funcionario = funcionario.id;

						
                $("#foto_empresa").html(empresa.foto_empresa);
                $("#nome_empresa").html(empresa.nome_empresa);
                $("#email_empresa").html(empresa.email);
                $("#endereco_empresa").html(empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.numero);
                $("#cidade_empresa").html(empresa.cidade+' - '+ empresa.estado);
                $("#cep_empresa").html(empresa.cep);
                $("#telefone_empresa").html(empresa.phone);
                //$("#foto_funcionario").html(funcionario.foto_funcionario);
                $("#nome_funcionario").html(funcionario.name);
                $("#email_funcionario").html(funcionario.email);
                $("#endereco_funcionario").html(funcionario.street + ' , ' + funcionario.neighbor + ' , nº' + funcionario.number);
                $("#cidade_funcionario").html(funcionario.city+' - '+ funcionario.state_);
                $("#cep_funcionario").html(funcionario.zip);
                $("#telefone_funcionario").html(funcionario.phone);
                $("#foto_empresa").html('<img  style="width:65px;height:65px;float: left;" class="avatar_table" src="'+foto_empresa+'" alt="">');
                $("#foto_funcionario").html('<a class="single_link" href="#funcionario-'+id_funcionario+'"><img  style="width:65px;height:65px;float: left;" class="avatar_table" src="'+foto_funcionario+'" alt=""></a>');
                lista_comissao = "";
                total_pagar = 0;

                for(var a = 0; a < comissao.length; a++){
                        short_dec = comissao[a].short_dec;
                        save_date = comissao[a].save_date;
                        comission = comissao[a].comission;
                    lista_comissao += '<tr>'+
                                        '<td>'+short_dec+'</td>'+
                                        '<td>'+save_date+'</td>'+
                                        '<td class="text-center">R$ <span>'+comission+'</span></td>'+
                                    '</tr>';
                    }

                    lista_comissao += '<tr>'+
                                            '<td></td>'+
                                            '<td class="text-center" style="font-weight: 700;font-size: 18px;float: right;">Total á Pagar</td>'+
                                            '<td class="text-center" style="font-weight: 700;font-size: 18px;">R$ <span>'+comission_total+'</span>'+
                                            '</td>'+
                                        '</tr>';

                    $('#table_comissao').html(lista_comissao); 
                }
            }); 
        }

        get_info_gerais();
       
    </script>
</body>
</html>