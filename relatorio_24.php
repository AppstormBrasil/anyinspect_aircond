<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("M");
    $year = date("Y");
    $user_level = get_user_level();
    if($user_level != 'a'){ 
        echo "<script>window.location.href = '#403';</script>";
        exit(0);
    } 
?>

<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }

    .remove_comment_line , .remove_img , .edit_image_ , .save_comment_{
        display: none !important;
    }

    body {
        background:#fff;
    }

}

tr ,td{padding:5px;}



input[type=radio]:disabled:checked+label::after {
    background-color: rgba(0, 0, 0, .26)!important;
}

</style>
            <div class="container-fluid" >

            <div class="row">

            <?php $id = $_GET['id']; ?>
            <input type="hidden" id="id_grupo" name="id_grupo" value="<?php echo $id ?>" />
            <div itemprop="sharedContent" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">

          
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height:80px;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="30%" class="logo_empresa"></td>
                            <td valign="top" width="40%" class="text-center endereco_empresa"></td>
                            <td valign="top" width="30%" class="text-center id_form"></td>
                        </tr>
                        
                    </tbody>
                </table>

                <h5><strong>1 – INFORMAÇÕES DO CLIENTE:</strong></h5>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height: 97px;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td colspan="4" valign="top">Nome:<span class="client_name"></span></td>
                            <td  valign="top">Data:<span class="data_atividade"></span></td>
                        </tr>
                        <tr>
                            <td colspan="4" valign="top" width="81%">Endereço:<span class="client_address"></span></td>
                            <td valign="top" width="19%">N.º:<span class="client_number"></span></td>
                        </tr>
                        <tr>
                            <td valign="top" width="23%">Complemento:<span class="client_complemento"></span></td>
                            <td valign="top" width="24%">Bairro:<span class="client_neighb"></span></td>
                            <td colspan="2" valign="top" width="33%">Cidade:<span class="client_city"></span></td>
                            <td valign="top" width="19%">UF:<span class="client_uf"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="top" width="47%">Telefone:<span class="client_phone"></span></td>
                            <td colspan="2" valign="top" width="53%">Email:<span class="client_email"></span></td>
                        </tr>
                    </tbody>
                </table>
                
                <!--<h5><strong>3 – RESPONSÁVEL TÉCNICO:</strong></h5>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="61%">Nome:<span class="nome_funcionario"></span></td>
                            <td valign="top" width="39%">Identificação:<span class="cpf_funcionario"></span></td>
                        </tr>
                        <tr>
                            <td valign="top" width="39%">Telefone:<span class="telefone_funcionario"></span></td>
                            <td valign="top" width="61%" >CREA:<span class="certifica_funcionario"></span></td>
                        </tr>
                       
                    </tbody>
                </table> -->
                                
                <!--<h5><strong>4- RELAÇÃO DOS AMBIENTES CLIMATIZADOS</strong></h5>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%">
                    <tbody id="table_results">
                        
                    </tbody>
                </table> -->

              
                
                </div>

            </div>
               
              
            </div>
            <!-- #/ container -->

            <div id="rel_ativi">
            </div>

        
        </div>

        <!-- Default Size -->
        <div class="modal fade" id="EditImage" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                
                                <button style="float:right;" type="button" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Fechar</button>
                            </div>
                                <form class="form novo_equipamento_form" id="validate_form_imagem" role="form" style="width: 100%;">
                                    <div class="cards">
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div style="text-align:center;margin: auto;" class="js-signature" data-width="500" data-height="500"  data-line-color="#bc0000" data-auto-fit="false"></div>
                                                <div class="col-md-12">
                                                   <!-- <a style="width:100%;color:#fff;" class="no-print btn btn-brand btn-elevate" value="submit">Salvar</a>
                                                    
                                                    <button id="clearBtn" class="btn btn-default" >Limpar</button>
                                                    <button id="saveBtn2" class="btn btn-success" >Salvar</button> -->
                                                    <input type="hidden" name="save_remote_data" id="save_remote_data">
                                                    <input type="hidden" name="imagem_anexo_dummy" id="imagem_anexo_dummy">
                                                    <input type="hidden" name="id_imagem" id="id_imagem">
                                                    <input type="hidden" name="image_name" id="image_name">
                                                    <input type="hidden" name="type_" id="type_">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    
                    
                    </div>
                </div>
            </div>
        </div>
        <style>
        .has-error{position:relative!important;}

        </style>

    <script src="js/qrcode.min.js"></script>
    <script>
        jQuery('#date_timepicker_start').datetimepicker({
            timepicker: false,
            datepicker:true,
            format:'d/m/Y',
            inline:false,
            autoclose: true,
            todayButton:true,
            lang:'pt',
            step: 5,
            scrollInput: false,
            //minDate:0,
            //defaultTime:'07:00',
        });

         jQuery('#date_timepicker_end').datetimepicker({
            timepicker: false,
            datepicker:true,
            format:'d/m/Y',
            inline:false,
            autoclose: true,
            todayButton:true,
            lang:'pt',
            step: 5,
            scrollInput: false,
            //minDate:0,
            //defaultTime:'07:00',
        });
        
        var id_atividade = $("#id_atividade").val();
        var id_form = $("#id_form").val();

        var size_heigh = $(window).height();
        var size_width = $('.invoice-info-card').width() - 20;

       
        get_info_gerais();
        get_relatorio_empresa();

        function get_relatorio_empresa() {
        //var id_atividade = $("#id_atividade").val();
        //var id_form = $("#id_form").val();
        var id_grupo = $("#id_grupo").val();
        //var start_date = $("#date_timepicker_start").val();
        //var end_date = $("#date_timepicker_end").val();
        $(".id_form").html('<h2>#</h2><h2>'+id_grupo+'</h2>');
        
        
        $('#table_results').html('');

        $.ajax({

        url:"includes/atividade/get_relatorio_empresa_grupo",
        method:"POST",
        dataType: 'JSON',
        data:{
            id_grupo:id_grupo             
        },
            success:function(response){

                var check_result = "";
                    var id_ = "";
                    var c_type = "";
                    var j = 1;
                    var bg_section = "";
                    var data = response.data;
                    var result_all = response.result_all;

                    var date_reage_inicial = data[0].date_reage_inicial;

                    $('.data_atividade').html(' <strong>'+date_reage_inicial+'</strong>');

                    var total_fixo = 0;
                    var total_flutuante = 0;
                    var total_area_clima = 0;
                    var total_carga = 0;
                    

                    check_result += '<tr class="text-center">'+
                        '<td valign="top" width="20%" ><strong>Tipo Atividade</strong></td>'+
                        '<td colspan="2" valign="top" width="7%" ><strong>Ocupantes<br> Fixos  &nbsp;&nbsp;&nbsp;&nbsp;  Flutuantes</strong></td>'+
                        '<td valign="top" width="30%" ><strong>Local</strong></td>'+
                        '<td valign="top" width="3%" ><strong>Área Climatizada</strong></td>'+
                        '<td valign="top" width="3%" ><strong>Carga Térmica</strong></td>'+
                        '<td valign="top" width="30%" style="text-align: center;"><strong>Tag</strong></td>'+
                        '<td valign="top" width="30%" style="text-align: center;"><strong>Tipo</strong></td>'+
                        //'<td valign="top" width="20%" style="text-align: center;"><strong>Status</strong></td>'+
                        
                    '</tr>'
                    

                    for(var i = 0; i < data.length; i++){
                        check_result += '<tr class="text-center">'+
                            '<td valign="top" width="20%">'+data[i].tipo+'</td>'+
                            '<td valign="top" width="7%">'+data[i].num_fixo+'</td>'+
                            '<td valign="top" width="7%">'+data[i].num_flutuante+'</td>'+
                            '<td valign="top" width="3%">'+data[i].local_ativo+'</td>'+
                            '<td valign="top" width="3%">'+data[i].area_climatizada+'</td>'+
                            '<td valign="top" width="3%">'+data[i].carga_termica+'</td>'+
                            '<td valign="top" width="30%" style="text-align: center;"><a class="single_link" href="#ativo-'+data[i].id_ativo+' ">'+data[i].qrcode+'</td>'+
                            '<td valign="top" width="30%" style="text-align: center;">'+data[i].tipo_ativo+'</td>'+
                            //'<td valign="top" width="20%" style="text-align: center;"><a target="_blank" href="atividade-'+data[i].bookingid+'-'+data[i].id_form+' ">'+data[i].status+'</a></td>'+
                        '</tr>';

                        total_fixo += parseInt(data[i].num_fixo);
                        total_flutuante += parseInt(data[i].num_flutuante);
                        total_area_clima += parseFloat(data[i].area_climatizada);
                        total_carga += parseFloat(data[i].carga_termica);
                                              
                    }

                    total_area_clima = total_area_clima.toFixed(2);
                    total_carga = total_carga.toFixed(2);
                    check_result += '<tr class="text-center">'+
                            '<td valign="top" width="20%"><strong>Total</strong></td>'+
                            '<td valign="top" width="7%">'+total_fixo+'</td>'+
                            '<td valign="top" width="7%">'+total_flutuante+'</td>'+
                            '<td valign="top" width="3%">-</td>'+
                            '<td valign="top" width="3%">'+total_area_clima+'</td>'+
                            '<td valign="top" width="3%">'+total_carga+'</td>'+
                            '<td valign="top" width="30%" style="text-align: center;">-</td>'+
                            '<td valign="top" width="30%" style="text-align: center;">-</td>'+
                            //'<td valign="top" width="20%" style="text-align: center;"><a target="_blank" href="atividade-'+data[i].bookingid+'-'+data[i].id_form+' ">'+data[i].status+'</a></td>'+
                        '</tr>';
                    

                    $('#table_results').html(check_result);
               
                    for(var i = 0; i < result_all.length; i++){
                        id_atividade = result_all[i].id_atividade;
                        formID = result_all[i].formID;
                        generate_all_activities(id_atividade,formID) ;
                    }

            }
        }); 




    }
        
        
function get_info_gerais(){
    
    var id_grupo =  $("#id_grupo").val();
    $.ajax({
    url:"includes/atividade/get_info_cliente_grupo",
    method:"POST",
    dataType: 'JSON',
    data:{
        id_grupo:id_grupo
                    
    },
        success:function(response){
        var status = response.status;    
        var empresa = response.empresa;
        var cliente = response.cliente;
        var comissao = response.comission;
        var resp_tecnico = response.resp_tecnico;
        var comission_total = 0;
        var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
        var foto_cliente = cliente.foto_cliente +'?' + (new Date()).getTime();
        $('.client_name').html(' <strong>'+cliente.nome_empresa+'</strong>');
        $('.client_address').html(' <strong>'+cliente.endereco_cliente+'</strong>');
        $('.client_number').html(' <strong>'+cliente.num_cliente+'</strong>');
        $('.client_complemento').html(' <strong></strong>');
        $('.client_neighb').html(' <strong>'+cliente.bairro_cliente+'</strong>');
        $('.client_city').html(' <strong>'+cliente.cidade_cliente+'</strong>');
        $('.client_uf').html(' <strong>'+cliente.estado_cliente+'</strong>');
        $('.client_phone').html(' <strong>'+cliente.phone_cliente+'</strong>');
        $('.client_email').html(' <strong>'+cliente.email_cliente+'</strong>');
        
        var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'

        $(".logo_empresa").html('<img  style="width:100%;height:70px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
        $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
        $("#nome_empresa").html(empresa.nome_empresa);
        $("#email_empresa").html(empresa.email);
        $("#cidade_empresa").html(empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep);
        $("#cep_empresa").html(empresa.cep);
        $("#telefone_empresa").html(empresa.phone);
        $("#nome_cliente").html(cliente.nome_empresa);
        $("#email_cliente").html(cliente.email_cliente);
        $("#endereco_cliente").html(cliente.endereco_cliente + ' , ' + cliente.bairro_cliente + ' , nº' + cliente.num_cliente);
        $("#cidade_cliente").html(cliente.cidade_cliente+' - '+ cliente.estado_cliente+' '+cliente.cep_cliente);
        $("#foto_cliente").html('<img  style="width:50px;height:50px;float:right;" class="avatar_logo" src="'+foto_cliente+'" alt="">');
        $(".nome_funcionario").html(' <strong>'+resp_tecnico.name+'</strong>');
        $(".telefone_funcionario").html(' <strong>'+resp_tecnico.phone+'</strong>');
        $(".cpf_funcionario").html(' <strong>'+resp_tecnico.cpf+'</strong>');
        $(".certifica_funcionario").html(' <strong>'+resp_tecnico.numero_qual+'</strong>');

        
        }
    }); 
}

function generate_all_activities(id_atividade,formID){
    
get_atividade_info(id_atividade,formID);


function get_atividade_info(id_atividade,formID){

    var dummy_form = "";

    dummy_form = `<div class="container-fluid" >
                 <div class="row">
                    <div itemprop="sharedContent" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">
                            <h3><strong class="title_form_`+id_atividade+`"></strong><div style="float:right;" id="qrcode_`+id_atividade+`"></div></h3>
                            <br>
                            <h5><strong>1 – INFORMAÇÕES DO CLIENTE:</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height: 97px;margin-bottom:20px;">
                                <tbody>
                                    <tr>
                                        <td colspan="3" valign="top">Data:<span class="client_date_`+id_atividade+`"></span></td>
                                        <td colspan="1" valign="top">Status:<span class="client_status_`+id_atividade+`"></span></td>
                                        <td colspan="1" valign="top">#<span class="atividade_id_`+id_atividade+`">`+id_atividade+`</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" valign="top">Nome:<span class="client_name_`+id_atividade+`"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" valign="top" width="81%">Endereço:<span class="client_address_`+id_atividade+`"></span></td>
                                        <td valign="top" width="19%">N.º:<span class="client_number_`+id_atividade+`"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="23%">Complemento:<span class="client_complemento_`+id_atividade+`"></span></td>
                                        <td valign="top" width="24%">Bairro:<span class="client_neighb_`+id_atividade+`"></span></td>
                                        <td colspan="2" valign="top" width="33%">Cidade:<span class="client_city_`+id_atividade+`"></span></td>
                                        <td valign="top" width="19%">UF:<span class="client_uf_`+id_atividade+`"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" valign="top" width="47%">Telefone:<span class="client_phone_`+id_atividade+`"></span></td>
                                        <td colspan="2" valign="top" width="53%">Email:<span class="client_email_`+id_atividade+`"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <h5><strong>3 – RESPONSÁVEL TÉCNICO:</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;margin-bottom:20px;">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="61%">Nome:<span class="nome_funcionario_`+id_atividade+`"></span></td>
                                        <td valign="top" width="39%">Identificação:<span class="cpf_funcionario_`+id_atividade+`"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="39%">Telefone:<span class="telefone_funcionario_`+id_atividade+`"></span></td>
                                        <td valign="top" width="61%">CREA:</td>
                                    </tr>
                                
                                </tbody>
                            </table>     
                            <h5><strong>4 – Plano de Manutenção e Controle</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:80px; height: 400px;width:100%">
                                <tbody id="table_results_`+id_atividade+`">
                                    
                                </tbody>
                            </table>
                            <table cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:20px; width: 100%;">
                                <tbody style="border: 1px solid white;">
                                    <tr>
                                        <td valign="top" width="33%" id="`+id_atividade+`-sig_exec"></td>
                                        <td valign="top" width="2%"></td>
                                        <td valign="top" width="33%" id="`+id_atividade+`-sig_resp"></td>
                                        <td valign="top" width="2%"></td>
                                        <td valign="top" width="33%" id="`+id_atividade+`-sig_client" style="text-align: center;"></td>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <td valign="top" width="33%" style="border-top: 1px solid #222;">Responsável Execução</td>
                                        <td valign="top" width="2%"></td>
                                        <td valign="top" width="33%" style="border-top: 1px solid #222;">Responsável Técnico</td>
                                        <td valign="top" width="2%"></td>
                                        <td valign="top" width="33%" style="border-top: 1px solid #222;">Cliente</td>
                                    </tr>
                                </tbody>
                            </table>

                           
                            
                        </div>
                    </div>
            </div>`;

    $('#rel_ativi').append(dummy_form);

    $.ajax({
    //url:"includes/calendario/get_eventos_single",
    url:"includes/atividade/get_eventos_single",
    method:"POST",
    dataType: 'JSON',
    data:{
        id:id_atividade
                    
    },
        success:function(response){

        var empresa = response.empresa;
        var cliente = response.cliente;
        var config = response.config;
        var content = response[0];
        var comissao = response.comission;
        var comission_total = 0;

        var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
        var foto_cliente = cliente.foto_cliente +'?' + (new Date()).getTime();
        var foto_funcionario = content.foto_funcionario +'?' + (new Date()).getTime();
        var nome_funcionario_exec = content.nome_funcionario_exec;

        $('.title_form_'+id_atividade).html(content.desc_service);
        $('.client_name_'+id_atividade).html(' <strong>'+cliente.nome_empresa+'</strong>');
        $('.client_address_'+id_atividade).html(' <strong>'+cliente.endereco_cliente+'</strong>');
        $('.client_number_'+id_atividade).html(' <strong>'+cliente.num_cliente+'</strong>');
        $('.client_complemento_'+id_atividade).html(' <strong></strong>');
        $('.client_neighb_'+id_atividade).html(' <strong>'+cliente.bairro_cliente+'</strong>');
        $('.client_city_'+id_atividade).html(' <strong>'+cliente.cidade_cliente+'</strong>');
        $('.client_uf_'+id_atividade).html(' <strong>'+cliente.estado_cliente+'</strong>');
        $('.client_phone_'+id_atividade).html(' <strong>'+cliente.phone_cliente+'</strong>');
        $('.client_email_'+id_atividade).html(' <strong>'+cliente.email_cliente+'</strong>');

        
        
        var desc_ativo = content.desc_ativo;
        var modelo_ativo = content.modelo_ativo;
        var register_ativo = content.register_ativo;
        var qrcode_ativo = content.qrcode_ativo;
        var local_ativo = content.local_ativo;
        var capacidade_ativo = content.capacidade_ativo;
        var fabricante_ativo = content.fabricante_ativo;
        
        if(desc_ativo == "null" || desc_ativo == null){
            desc_ativo = 'N/A';
        }
        if(desc_ativo == "null" || desc_ativo == null){
            desc_ativo = 'N/A';
        }
        
        if(modelo_ativo == "null" || modelo_ativo == null){
            modelo_ativo = 'N/A';
        }
        if(register_ativo == "null" || register_ativo == null){
            register_ativo = 'N/A';
        }
        
        if(qrcode_ativo == "null" || qrcode_ativo == null){
            qrcode_ativo = 'N/A';
        }
        
        if(local_ativo == "null" || local_ativo == null){
            local_ativo = 'N/A';
        }
        
        if(capacidade_ativo == "null" || capacidade_ativo == null){
            capacidade_ativo = 'N/A';
        }
        
        if(fabricante_ativo == "null" || fabricante_ativo == null){
            fabricante_ativo = 'N/A';
        }

        $(".desc_ativo_"+id_atividade).html(' <strong>'+desc_ativo+'</strong>');
        $(".modelo_ativo_"+id_atividade).html(' <strong>'+modelo_ativo+'</strong>');
        $(".register_ativo_"+id_atividade).html(' <strong>'+register_ativo+'</strong>');
        $(".capacidade_ativo_"+id_atividade).html(' <strong>'+capacidade_ativo+'</strong>');
        $(".fabricante_ativo_"+id_atividade).html(' <strong>'+fabricante_ativo+'</strong>');
        $(".qrcode_ativo_"+id_atividade).html(' <strong>'+qrcode_ativo+'</strong>');
        $(".local_ativo_"+id_atividade).html(' <strong>'+local_ativo+'</strong>');
        $(".nome_funcionario_"+id_atividade).html(' <strong>'+content.nome_funcionario+'</strong>');
        $(".cpf_funcionario_"+id_atividade).html(' <strong>'+content.cpf_funcionario+'</strong>');
        $(".telefone_funcionario_"+id_atividade).html(' <strong>'+content.telefone_funcionario+'</strong>');

        if(content.qrcode_ativo != null ){
            //qrcode.makeCode(content.qrcode_ativo);
        }

        
        
        $(".client_date_"+id_atividade).html(' <strong>'+content.br_start+'</strong>');
        $(".client_status_"+id_atividade).html(' <strong>'+content.status_+'</strong>');
       
        
        /*$(".client_status_"+id_atividade).html('<span><a style="cursor:pointer;" class="start_servico" name="'+content.id+'" ><span style="background:'+content.color+';color:'+content.textColor+'" class="label label label-rounded ">'+content.status_+'</a></span>');
        $("#id_at").html('ID #'+content.id);*/
        
                
        /*$("#foto_empresa").html('<img  style="width:50px;height:50px;float: left;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
        $("#nome_empresa").html(empresa.nome_empresa);
        $("#email_empresa").html(empresa.email);
        $("#endereco_empresa").html(empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number);
        $("#cidade_empresa").html(empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep);
        $("#cep_empresa").html(empresa.cep);
        $("#telefone_empresa").html(empresa.phone);
        //$("#foto_funcionario").html(funcionario.foto_funcionario);
        $("#nome_cliente").html(cliente.nome_empresa);
        $("#email_cliente").html(cliente.email_cliente);
        $("#endereco_cliente").html(cliente.endereco_cliente + ' , ' + cliente.bairro_cliente + ' , nº' + cliente.num_cliente);
        $("#cidade_cliente").html(cliente.cidade_cliente+' - '+ cliente.estado_cliente+' '+cliente.cep_cliente);
        $("#foto_cliente").html('<img  style="width:50px;height:50px;float:right;" class="avatar_logo" src="'+foto_cliente+'" alt="">');*/

        //$("#flow_approve").val(config.flow_approve);
        //$("#geo_location").val(config.geo_location);
        //$("#image_require").val(config.image_require);
        //$("#signature").val(config.signature);
        //$("#signature_exec").val(config.signature_exec);
        
               
        generateForm(formID,content.status_,id_atividade)
        
        
        
        }
    }); 
}

function generateForm(formID,status_det,id_atividade) {

$("#sjfb-fields").empty();
    $.getJSON('includes/atividade/sjfb-load-form?form_id=' + formID, function(data) {
        var uniqueID = formID;
        if (data) {
            var titulo_formulario = data.titulo_formulario;
            var tipo_formulario = data.tipo_formulario;
            var imagem = data.imagem;
            var conteudo_formulario = JSON.parse(data.conteudo_formulario);
            var enable_disable = ""; 
            var i = 0;
            var k = 0;

            
            if(conteudo_formulario == null || conteudo_formulario == 'null' ){
                
            } else {
            
                var check_result = "";
                var id_ = "";
                var c_type = "";
                var c_label = "";
                var c_label_final = "";
                var c_period = "";
                var j = 1;
                var bg_section = "";
                var sig_exec = "";
                var sig_resp = "";
                var sig_client = "";

                check_result += '<tr>'+
                    '<td valign="top" width="40%" ><strong>Descrição</strong></td>'+
                    '<td valign="top" width="15%" style="text-align: center;"><strong>Executado</strong></td>'+
                    '<td valign="top" width="15%" style="text-align: center;"><strong>Periodicidade</strong></td>'+
                '</tr>';
               
                

                for(var i = 0; i < conteudo_formulario.length; i++){
                    
                    c_type = conteudo_formulario[i].type;
                    c_label = conteudo_formulario[i].label;
                    var res = c_label.split("@");

                  
                    c_label_final = res[0];
                    c_period = res[1];

                    if(c_period == 'undefined' || c_period == undefined){
                        c_period = ""
                    } else {
                        c_period = c_period;
                    }

                    if(c_type == 'radio'){
                        id_ = conteudo_formulario[i].type+"-sjfb-"+uniqueID+"-"+j;
                    } else if(c_type == 'checkbox'){
                        id_ = conteudo_formulario[i].type+"-sjfb-"+uniqueID+"-"+j;
                    } else {
                        id_ = conteudo_formulario[i].type+"-"+uniqueID+'-'+j;
                    }

                    id_ = id_atividade+'-'+id_;

                   /* if (find_id.indexOf('js-signature') > -1){
                        $('#'+find_id).html('<img src="'+find_valor+'" style="width="100%" " >');
                    }*/

                  
                    
                    if(c_type === 'section'){
                        bg_section = 'background: #c5c5c5;border-color: #c5c5c5;color: #000;font-weight: 600;';
                    } else {
                        bg_section = "";
                    }

                    if(c_type == 'signature_box' || c_label == 'Assinaturas'){
                        
                        if(c_label == 'Responsável Execução'){
                            sig_exec = 'js-signature-'+uniqueID+'-'+j+'';
                            $('#'+id_atividade+'-sig_exec').html('<div id="'+id_atividade+'-js-signature-'+uniqueID+'-'+j+'" ></div>');
                        } else {
                            sig_exec = "";
                        }
                        
                        if(c_label == 'Responsável Técnico'){
                            sig_resp = 'js-signature-'+uniqueID+'-'+j+'';
                            $('#'+id_atividade+'-sig_resp').html('<div id="'+id_atividade+'-js-signature-'+uniqueID+'-'+j+'" ></div>')
                        } else {
                            sig_resp = "";
                        }
                        
                        if(c_label == 'Cliente'){
                            sig_client = 'js-signature-'+uniqueID+'-'+j+'';
                            $('#'+id_atividade+'-sig_client').html('<div id="'+id_atividade+'-js-signature-'+uniqueID+'-'+j+'" ></div>')
                        } else {
                            sig_client = "";
                        }
                        

                    } else {
                        check_result += '<tr style="'+bg_section+'">'+
                        '<td valign="top" width="50%">'+c_label_final+'</td>'+
                        '<td id="'+id_+'" valign="top" width="10%" style="text-align: center;"></td>'+
                        '<td valign="top" width="10%" style="text-align: center;">'+c_period+'</td>'+
                        '</tr>'+
                        '<tr style="display:none;" id="'+id_atividade+'-box_text_comment_'+uniqueID+'-'+j+'" >'+
                            '<td colspan="5" valign="top"><strong>Observações:</strong><div id="text_comment_'+uniqueID+'-'+j+'"></div></td>'+
                        '</tr>'+
                        '<tr style="display:none;" id="'+id_atividade+'-box_image_box_'+uniqueID+'-'+j+'">'+
                            '<td colspan="5" valign="top"><strong>Imagens:</strong><div id="'+id_atividade+'-image_box_'+uniqueID+'-'+j+'"></div></td>'+
                        '</tr>';
                    }

                    j++;
                }
                $('#table_results_'+id_atividade).html(check_result);

                
                call_lista_atividades(id_form,id_atividade);

                function call_lista_atividades(id_form,id) {
                $.ajax({
                    url:  "includes/atividade/get_atividade_result",
                    type : 'GET',
                    data :{
                        IdFormulario:formID,
                        IdEvento:id
                    },
                    success: function(response){
                    var json = JSON.parse(response);
                    var status = json.status;
                
                        if(status  == 'SUCCESS') {
                            
                            var box_atividades = "";
                            id = json.id;
                            var resp_atividade = json.resp_atividade;
                            for(var a = 0; a < resp_atividade.length; a++){
                                var statusdummy = "";
            
                                var find_id = resp_atividade[a].campo
                                var find_valor = resp_atividade[a].valor

                                find_id = id_atividade+'-'+find_id;
                                
                                if (find_valor == null || find_valor == "null"){
                                    
                                }else{
                                    $('#'+find_id).html('<strong>'+find_valor+'</strong>');
                                }
                               
                                
                                /*var rates = document.getElementsByName(find_id);
                                var rate_value;
                                for(var i = 0; i < rates.length; i++){
                                    if(find_valor == rates[i].value){
                                            $("input[name="+find_id+"]").val([find_valor]);
                                        
                                    } 
                                }

                                $('input[name="'+find_id+'[]"]').each(function(){
                                    var res = find_valor.split(",");
                                    for(i = 0; i < res.length; i++) {
                                        if(res[i] == $(this).attr('value')){
                                                $(this).prop( "checked", true );
                                        } 
                                        }
                                });*/
                                
                                
                                
                                if (find_id.indexOf('js-signature') > -1){
                                    if (find_valor == null || find_valor == "null"){
                                  } else {
                                        console.log(find_valor)
                                        $('#'+find_id).html('<img src="'+find_valor+'"  style="width:100%;" " >');
                                    }

                                    
                                      
                                   
                                }
                                if (find_valor == null || find_valor == "null"){

                                }else{
                                    $('#'+find_id).val(find_valor);
                                }
                                
                            }
                        
                        } else {
                            $('#no_item_message').show();
                        }
            
                        }
                    });
            }

            
            
            }

        
        }

    
    });



}

setTimeout(function(){ 


setTimeout(function(){ 
    call_evidences(id_atividade);
}, 500);

function call_evidences(id_atividade) {
    $.ajax({
        url:  "includes/atividade/get_evi_result",
        type : 'GET',
        dataType: 'JSON',
        data :{
            id_atividade:id_atividade,
        },
        success: function(response){
            var status = response.status;
            if(status == 'SUCCESS'){
                var box = response.box;
                var comments = response.comments;
                var images = response.img_elements;
                var img_sign = response.img_sign;

                // OPEN ALL BOX WITH ELEMENTS 
                if(box != null){
                    var box_show = "";
                    for(var a = 0; a < box.length; a++){
                        box_show = box[a].box_;
                        $('#'+id_atividade+'-box_'+box_show).show();
                    }
                }
                
                // ADD ALL SAVED COMMENTS
                if(comments != null){
                    var comments_val = "";
                    var comments_target = "";
                    var date_create = "";
                    var the_cooments = "";

                    for(var a = 0; a < comments.length; a++){
                        comments_target = 'text_'+comments[a].target;
                        comments_val = comments[a].target_value;
                        date_create = comments[a].date_create;
                        id = comments[a].id;
                        the_cooments += '<ul id="ul_'+comments_target+'_'+id+'" class="mt-4 mb-4">';
                        the_cooments += '<li >'+comments_val+'<br><small>'+date_create+'</small></li>';
                        $('#'+comments_target).prepend(the_cooments);
                        the_cooments = "";
                        the_cooments += '</ul>';
                    }
                    

                }
                
                // ADD ALL SAVED IMAGES
                if(images != null){
                    var src_img = "";
                    var target_img = "";
                    var the_images = ""; 
                    
                    for(var b = 0; b < images.length; b++){
                        src_img = images[b].src_img;
                        target_img = images[b].target_img;
                        target = images[b].target;
                        src_img = images[b].src_img;
                        the_images += '<div class="col-2" style="float: left;">'+
                            '<a style="cursor:pointer;" id="'+src_img+'" class="carregar_imagems" >'+
                            '<img id="image_form" src="'+src_img+'" alt="" class="img-fluid"></a>'+
                        '</div>';
                        $('#'+id_atividade+'-'+target).append(the_images);
                        the_images = "";
                    }
                    setTimeout(function(){ 
                        $(".carregar_imagems").click(function(e){
                            src_img = this.id;
                       
                            $("#EditImage").modal();
                            var imgsrc = $( '#image_form').attr( 'src' ); 
                            var imagem_anexo = imgsrc;

                            $('.js-signature').html('<img src="'+src_img+'" >')
                        });
                    }, 1500);
                   
                
                }
                // ADD ALL SIGN
                var src_img_sign = "";
                var target_img_sign = "";
                if(img_sign > 0){
                    for(var c = 0; c < img_sign.length; c++){
                        src_img_sign = img_sign[c].src_img;
                        target_img = img_sign[c].target_img;
                        $('#'+id_atividade+'-'+target_img).html('<img style="width:180px" src="'+src_img_sign+'" />')
                    }
                }
            
            }

        }
    });


}




function fill_canvas(img,target_img) {
    if(target_img == 'box_sig_colab'){
        var canvas = document.getElementById('signature-pad');
    } else {
        var canvas = document.getElementById('signature-pad-cli');
    }
    var context = canvas.getContext('2d');
    var imgPath = img;
    var imgObj = new Image();
    imgObj.src = imgPath;
    var x = 0;
    var y = 0;

    imgObj.onload = function(){
        context.drawImage(imgObj, x, y);
    } 
}

}, 200);

}

function get_lista_empresa(){

    $.ajax({
    url:"includes/cliente/get_client",
    method:"POST",
    dataType: 'JSON',
    success:function(response){
        var option = '<option disabled selected value="none"></option>'
        var i;
        var status = response.status;
            for (i = 0; i < response.data.length; i++) {
                option += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
            }
            $('#id_clientt').html(option);	
            $('#id_clientt').select2();

    }
}); 
}

</script>
