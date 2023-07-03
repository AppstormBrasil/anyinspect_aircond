<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("m");
    $user_level = get_user_level();
    if($user_level != 'a'){ 
        echo "<script>window.location.href = '#403';</script>";
        exit(0);
    } 
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

.invoice-details-table td, .invoice-details-table th {
   padding: 3px 15px 2px 15px;
    font-size: 12px;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card invoice-info-card" style="margin: auto;">
                <div class="card-header text-center" style="background:#f9f9f9;border-bottom:1px solid #f9f9f9;">
                    <h4>FATURA</h4><h1 class="mb-5">Outubro - 2020</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xl-9">
                            <div class="invoice-info-left">
                                <div class="distributorss">
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
                        
                    <div class="col-md-12 col-xl-12 ">
                            <div class="invoice-info-right">
                                    <div >
                                    <span id="foto_funcionario"><img  style="width:125px;"  src="images/inter.png" alt=""> </span>
                                        <h4 class="text-primarys mb-2" >Felipe da Conceição Taveira</h4>
                                        <a id="email_funcionario"  class="text-muted"></a>
                                    </div>
                                    <div  >
                                        <h5>CPF: 335.249.108-90</h5>
                                        <h5>Banco: 077</h5>
                                        <h5>Agência: 0001</h5>
                                        <h5>Conta: 54545625</h5>
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
                                <table style="background: white;" class="table invoice-details-table" style="min-width: 500px;">
                                    <thead>
                                        <tr style="background: #f9f9f9;">
                                            <th>Serviço</th>
                                            <th>Cliente</th>
                                            <th>Funcionário</th>
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
</div>
    <script>
        
        function get_info_gerais(){
            var data = $("#data").val();
            $.ajax({
            url:"includes/empresa/get_fatura_mes",
            method:"GET",
            dataType: 'JSON',
            data:{
                //id:id_func,
                month:data
            
            },
                success:function(response){

                var empresa = response.empresa;
                var funcionario = response.funcionario;
                var comissao = response.fatura;
                var comission_total = response.comission_total.comissao_total;
				var comission_total_ = parseFloat(response.comission_total.comissao_total);
				
				console.log(comission_total)
				
				var valor_final = (comission_total_ + 39.90);
				
				var valorFormatado = Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(valor_final)

				console.log(valorFormatado)
								
				console.log(valor_final)

                var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
                var foto_funcionario = funcionario.foto_funcionario +'?' + (new Date()).getTime();
                var id_funcionario = funcionario.id;

                var foto_appstorm = 'images/appstorm.png'

						
                //$("#foto_empresa").html(empresa.foto_empresa);
                $("#nome_empresa").html('Appstorm');
                $("#email_empresa").html('contato@appstorm.com.br');
                //$("#endereco_empresa").html(empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number);
                $("#cidade_empresa").html('São José dos Campos - SP');
                //$("#cep_empresa").html(empresa.cep);
                $("#telefone_empresa").html('(12) 98316-9778');
                //$("#foto_funcionario").html(funcionario.foto_funcionario);
                
                
                $("#nome_funcionario").html(empresa.nome_empresa);
                $("#email_funcionario").html(empresa.email);
                //$("#endereco_funcionario").html(empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number);
                $("#cidade_funcionario").html(empresa.cidade+' - '+ empresa.estado);
                //$("#cep_funcionario").html(funcionario.zip);
                $("#telefone_funcionario").html(empresa.phone);
                $("#foto_empresa").html('<img  style="width: 100px;height: 75px;float: left;" class="" src="'+foto_appstorm+'" alt="">');
                $("#foto_funcionario").html('<a class="single_link" href="#funcionario-'+id_funcionario+'"><img  style="width:65px;height:65px;float: left;" class="avatar_table" src="'+foto_empresa+'" alt=""></a>');
                lista_comissao = "";
                total_pagar = 0;

                for(var a = 0; a < comissao.length; a++){
                        short_dec = comissao[a].short_dec;
                        data_servico = comissao[a].data_servico;
                        nome_cliente = comissao[a].nome_cliente;
                        nome_funcionario = comissao[a].nome_funcionario;
                        price = comissao[a].price;
                    lista_comissao += '<tr>'+
                                        '<td>'+short_dec+'</td>'+
                                        '<td>'+nome_cliente+'</td>'+
                                        '<td>'+nome_funcionario+'</td>'+
                                        '<td>'+data_servico+'</td>'+
                                        '<td class="text-center">R$ <span>'+price+'</span></td>'+
                                    '</tr>';
                    }

                    lista_comissao += 	'<tr>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                        '</tr>'+
										'<tr>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td class="text-center" style="float: right;">Subtotal Agendamentos(R$0,50)</td>'+
                                            '<td class="text-center" style="font-size: 16px;">R$ <span>'+comission_total+'</span></td>'+
                                        '</tr>'+
										'<tr>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td class="text-center" style="float: right;">3/3 - Licença</td>'+
                                            '<td class="text-center" style="font-size: 16px;">R$ <span>39,90</span></td>'+
                                        '</tr>'+
										'<tr>'+
                                             '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td style="border: none;padding: 10px;"></td>'+
                                            '<td class="text-center" style="padding-bottom: 35px;font-weight: 700;font-size: 18px;float: right;">Total á Pagar</td>'+
                                            '<td class="text-center" style="padding-bottom: 35px;font-weight: 700;font-size: 18px;"><span>'+valorFormatado+'</span></td>'+
                                        '</tr>'

                    $('#table_comissao').html(lista_comissao); 
                }
            }); 
        }
        get_info_gerais();
    </script>
