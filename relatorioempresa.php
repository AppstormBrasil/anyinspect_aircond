<!DOCTYPE html>
<html lang="pt">
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
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Relatório</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="includes/atividade/style.css">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/datepicker/jquery.datetimepicker.min.css">
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
    
</head>
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
<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include('includes/common/nav-header.php'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
		<?php include('includes/common/header.php'); ?>
        <!--**********************************
            Header end
        ***********************************-->
        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('includes/common/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid" >

            <div class="row">


            <div itemprop="sharedContent" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">


                <h3><strong class="title_form">Título</strong></h3>
                <br>
               
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
                            <td colspan="5" valign="top">Nome:<span class="client_name"></span></td>
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
                
                <h5><strong>3 – RESPONSÁVEL TÉCNICO:</strong></h5>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="61%">Nome:<span class="nome_funcionario"></span></td>
                            <td valign="top" width="39%">Identificação:<span class="cpf_funcionario"></span></td>
                        </tr>
                        <tr>
                            <td valign="top" width="39%">Telefone:<span class="telefone_funcionario"></span></td>
                            <td valign="top" width="61%">CREA:</td>
                        </tr>
                       
                    </tbody>
                </table>
                                
                <h5><strong>4- RELAÇÃO DOS AMBIENTES CLIMATIZADOS</strong></h5>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:80px;width:100%">
                    <tbody id="table_results">
                        
                    </tbody>
                </table>
                
                
                </div>

            </div>
               
              
            </div>
            <!-- #/ container -->
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


        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
            Footer start
        ***********************************-->
       <?php include('includes/common/footer.php'); ?>
        <!--**********************************
            Footer end
        ***********************************-->
        <!--**********************************
            Right sidebar start
        ***********************************-->
        <?php include('includes/common/filter-sidebar.php'); ?>
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
    <!--<script src="js/jq-signature.min.js"></script>
    <script src="js/signature_pad.min.js"></script>-->
    <script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/qrcode.min.js"></script>
    <script>
        toastr.options = {"positionClass": "toast-top-full-width"};

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

        //$('#boxcanvas_colab').html('<canvas id="signature-pad" class="signature-pad" width='+size_width+' height=150 ></canvas>')
        //$('#boxcanvas_cli').html('<canvas id="signature-pad-cli" class="signature-pad-cli" width='+size_width+' height=150 ></canvas>')
        
        $("#get_dates").click(function(){
            get_info_gerais();
            get_relatorio_empresa();
        });

        setTimeout(function(){ 
            get_lista_empresa();
	    }, 1000);
        
        

        function get_relatorio_empresa() {
        //var id_atividade = $("#id_atividade").val();
        //var id_form = $("#id_form").val();
        var id_clientt = $("#id_clientt").val();
        var start_date = $("#date_timepicker_start").val();
        var end_date = $("#date_timepicker_end").val();
        $(".id_form").html('<h1>'+start_date+'</h1>');
        
        
        $('#table_results').html('');

        $.ajax({

        url:"includes/atividade/get_relatorio_empresa_date",
        method:"POST",
        dataType: 'JSON',
        data:{
            id_client:id_clientt,                
            start_date:start_date,                
            end_date:end_date                
        },
            success:function(response){

                var check_result = "";
                    var id_ = "";
                    var c_type = "";
                    var j = 1;
                    var bg_section = "";
                    var data = response.data;

                    check_result += '<tr>'+
                        '<td valign="top" width="30%" ><strong>Local</strong></td>'+
                        '<td valign="top" width="30%" style="text-align: center;"><strong>Equipamento</strong></td>'+
                        '<td valign="top" width="20%" style="text-align: center;"><strong>Tag</strong></td>'+
                        '<td valign="top" width="20%" style="text-align: center;"><strong>Status</strong></td>'+
                        
                    '</tr>';

                    for(var i = 0; i < data.length; i++){
                        check_result += '<tr>'+
                            '<td valign="top" width="30%">'+data[i].local_ativo+'</td>'+
                            '<td valign="top" width="30%" style="text-align: center;">'+data[i].ativo+'</td>'+
                            '<td valign="top" width="20%" style="text-align: center;">'+data[i].qrcode+'</td>'+
                            '<td valign="top" width="20%" style="text-align: center;"><a target="_blank" href="atividade-'+data[i].bookingid+'-'+data[i].id_form+' ">'+data[i].status+'</a></td>'+
                        '</tr>';
                        
                    }

                    $('#table_results').html(check_result);

            }
        }); 




    }
        
        
        function get_info_gerais(){
           
            var id_clientt = $("#id_clientt").val();
            $.ajax({
            //url:"includes/calendario/get_eventos_single",
            url:"includes/atividade/get_info_cliente",
            method:"POST",
            dataType: 'JSON',
            data:{
                id_clientt:id_clientt
                          
            },
                success:function(response){

                var empresa = response.empresa;
                var cliente = response.cliente;
                var comissao = response.comission;
                var comission_total = 0;

                var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
                var foto_cliente = cliente.foto_cliente +'?' + (new Date()).getTime();
                //var foto_funcionario = content.foto_funcionario +'?' + (new Date()).getTime();
                //var nome_funcionario_exec = content.nome_funcionario_exec;

                //$('.title_form').html(content.desc_service);
                $('.client_name').html(' <strong>'+cliente.nome_empresa+'</strong>');
                $('.client_address').html(' <strong>'+cliente.endereco_cliente+'</strong>');
                $('.client_number').html(' <strong>'+cliente.num_cliente+'</strong>');
                $('.client_complemento').html(' <strong></strong>');
                $('.client_neighb').html(' <strong>'+cliente.bairro_cliente+'</strong>');
                $('.client_city').html(' <strong>'+cliente.cidade_cliente+'</strong>');
                $('.client_uf').html(' <strong>'+cliente.estado_cliente+'</strong>');
                $('.client_phone').html(' <strong>'+cliente.nome_empresa+'</strong>');
                $('.client_email').html(' <strong>'+cliente.email_cliente+'</strong>');
                


                var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'

						
                $(".logo_empresa").html('<img  style="width:100%;height:60px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
                $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
                $("#nome_empresa").html(empresa.nome_empresa);
                $("#email_empresa").html(empresa.email);
                
                $("#cidade_empresa").html(empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep);
                $("#cep_empresa").html(empresa.cep);
                $("#telefone_empresa").html(empresa.phone);
                //$("#foto_funcionario").html(funcionario.foto_funcionario);
                $("#nome_cliente").html(cliente.nome_empresa);
                $("#email_cliente").html(cliente.email_cliente);
                $("#endereco_cliente").html(cliente.endereco_cliente + ' , ' + cliente.bairro_cliente + ' , nº' + cliente.num_cliente);
                $("#cidade_cliente").html(cliente.cidade_cliente+' - '+ cliente.estado_cliente+' '+cliente.cep_cliente);
                $("#foto_cliente").html('<img  style="width:50px;height:50px;float:right;" class="avatar_logo" src="'+foto_cliente+'" alt="">');

               
               
                
                }
            }); 
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
</body>
</html>