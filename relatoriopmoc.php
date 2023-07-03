<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("M");
    $year = date("Y");
    $user_level = get_user_level();
    if($user_level != 'a'){ 
        echo "<script>window.location.href = '#403';</script>";
        exit(0);
    } 
    $id_atividade = $_GET['id'];
    $id_form = $_GET['form'];
?>
<link rel="stylesheet" href="includes/atividade/style.css">

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


                    <div id="sharedContent" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">
                            <h3><strong class="title_form">PLANO DE MANUTENÇÃO, OPERAÇÃO E CONTROLE – PMOC</strong></h3>
                            
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height:80px;margin-bottom:20px;">
                                <tbody>
                                
                                    <tr>
                                        <td valign="top" width="30%" class="logo_empresa"></td>
                                        <td valign="top" width="40%" class="text-center endereco_empresa"></td>
                                        <td valign="top" width="30%" class="text-center "><div class="id_form" style="width: 50%;float: left;"></div><div style="float:right;" id="qrcode"></div></td>
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
                            <h5><strong>2 – INFORMAÇÕES DO EQUIPAMENTO:</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height: 78px;margin-bottom:20px;">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="61%">Equipamento:<span class="desc_ativo"></span></td>
                                        <td valign="top" width="19%">Modelo:<span class="modelo_ativo"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="61%">Nº de Série:<span class="register_ativo"></span></td>
                                        <td valign="top" width="39%">Capacidade:<span class="capacidade_ativo"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="61%">Tag:<span class="qrcode_ativo"></span></td>
                                        <td valign="top" width="39%">Localização:<span class="local_ativo"></span></td> 
                                    </tr>
                                    <tr>
                                        <td valign="top" width="61%">Fabricante:<span class="fabricante_ativo"></span></td>
                                        <td valign="top" width="39%"></td> 
                                    </tr>
                                </tbody>
                            </table>
                            <h5><strong>3 – RESPONSÁVEL TÉCNICO:</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;margin-bottom:20px;">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="61%">Nome:<span class="nome_resp"></span></td>
                                        <td valign="top" width="39%">Identificação:<span class="cpf_resp"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="39%">Telefone:<span class="telefone_resp"></span></td>
                                        <td valign="top" width="61%">CREA:<span class="num_qual_resp"></span></td>
                                    </tr>
                                
                                </tbody>
                            </table>        
                            <h5><strong>4 – Plano de Manutenção e Controle</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:80px; height: 400px;width:100%">
                                <tbody id="table_results">
                                    
                                </tbody>
                            </table>
                            <table cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:20px; width: 100%;">
                                <tbody style="border: 1px solid white;">
                                    <tr>
                                        <td valign="top" width="33%" id="sig_exec"></td>
                                        <td valign="top" width="2%"></td>
                                        <td valign="top" width="33%" id="sig_resp"></td>
                                        <td valign="top" width="2%"></td>
                                        <td valign="top" width="33%" id="sig_client" style="text-align: center;"></td>
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
               
                    <input type="hidden" id="id_atividade" value="<?=$id_atividade?>" />
                    <input type="hidden" id="id_form" value="<?=$id_form?>" />
                    <input type="hidden" name="current_status" id="current_status">
                    <input type="hidden" name="flow_approve" id="flow_approve">
                    <input type="hidden" name="geo_location" id="geo_location">
                    <input type="hidden" name="image_require" id="image_require">
                    <input type="hidden" name="signature" id="signature">
                    <input type="hidden" name="signature_exec" id="signature_exec">

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

    <script src="js/jq-signature.min.js"></script>
    <script src="js/signature_pad.min.js"></script>
    <script src="js/qrcode.min.js"></script>
    <script>
        var qrcode = new QRCode("qrcode", {
            text: 'Anyinspect',
            width: 50,
            height: 50,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });

        var id_atividade = $("#id_atividade").val();
        var id_form = $("#id_form").val();

        var size_heigh = $(window).height();
        var size_width = $('.invoice-info-card').width() - 20;

        $('#boxcanvas_colab').html('<canvas id="signature-pad" class="signature-pad" width='+size_width+' height=150 ></canvas>')
        $('#boxcanvas_cli').html('<canvas id="signature-pad-cli" class="signature-pad-cli" width='+size_width+' height=150 ></canvas>')
  
        function get_info_gerais(){
           

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
                var resp_tecnico = response.resp_tecnico;
                var config = response.config;
                var content = response[0];
                var comissao = response.comission;
                var comission_total = 0;

                var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
                var foto_cliente = cliente.foto_cliente +'?' + (new Date()).getTime();
                var foto_funcionario = content.foto_funcionario +'?' + (new Date()).getTime();
                var nome_funcionario_exec = content.nome_funcionario_exec;

                $('.title_form').html(content.desc_service);
                $('.data_atividade').html(' <strong>'+content.br_start+'</strong>');
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
                $(".id_form").html('<h2>PMOC</h2><h2>'+content.id+'</h2>');
                
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

                $(".desc_ativo").html(' <strong>'+desc_ativo+'</strong>');
                $(".modelo_ativo").html(' <strong>'+modelo_ativo+'</strong>');
                $(".register_ativo").html(' <strong>'+register_ativo+'</strong>');
                $(".capacidade_ativo").html(' <strong>'+capacidade_ativo+'</strong>');
                $(".fabricante_ativo").html(' <strong>'+fabricante_ativo+'</strong>');
                $(".qrcode_ativo").html(' <strong>'+qrcode_ativo+'</strong>');
                $(".local_ativo").html(' <strong>'+local_ativo+'</strong>');
                
                $(".nome_resp").html(' <strong>'+resp_tecnico.name+'</strong>');
                $(".cpf_resp").html(' <strong>'+resp_tecnico.cpf+'</strong>');
                $(".telefone_resp").html(' <strong>'+resp_tecnico.phone+'</strong>');
                $(".num_qual_resp").html(' <strong>'+resp_tecnico.numero_qual+'</strong>');

                if(content.qrcode_ativo != null ){
                    qrcode.makeCode(content.qrcode_ativo);
                }
                
                
                $("#status_atividade").html('<span><a style="cursor:pointer;" class="start_servico" name="'+content.id+'" ><span style="background:'+content.color+';color:'+content.textColor+'" class="label label label-rounded ">'+content.status_+'</a></span>');
                $("#id_at").html('ID #'+content.id);
               
						
                $("#foto_empresa").html('<img  style="width:50px;height:50px;float: left;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
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
                $("#foto_cliente").html('<img  style="width:50px;height:50px;float:right;" class="avatar_logo" src="'+foto_cliente+'" alt="">');

                $("#flow_approve").val(config.flow_approve);
                $("#geo_location").val(config.geo_location);
                $("#image_require").val(config.image_require);
                $("#signature").val(config.signature);
                $("#signature_exec").val(config.signature_exec);
                
                

               
                
                if(content.ended_at == '00/00/0000 00:00:00'){
                    $("#atividade_tempo").html('');
                } else {
                    $("#atividade_tempo").html(content.tempo_realizado);
                }
               
                $("#current_status").val(content.status_);

                if(content.id_quem_executou == null){
                    $("#executado_por").html('-');
                } else {
                    $("#executado_por").html('<a href="#funcionario-'+content.id_quem_executou+'" ><img style="width: 25px;height:25px;float: left;margin-right: 5px;" class="rounded-circle" src="'+foto_funcionario+'" alt="'+nome_funcionario_exec+'"><p class="mb-0">'+nome_funcionario_exec+'</p></a>');
                }

                
                if(content.status_ == 'Pendente'){
                    $("#atividade_iniciada").html('<button id="comecar" style="" onclick="alteraStatus(`comecar`)" class="btn-xs btn btn-start">Iniciar Atividade</button>');
                    $("#atividade_finalizada").html('-');
                    $("#atividade_tempo").html('-');
                } 
                
                if(content.status_ == 'Em Andamento'){
                    $("#atividade_finalizada").html('<button id="finalizar" style="" onclick="alteraStatus(`finalizar`)" class="btn-xs btn btn-close">Finalizar Serviço</button>');
                }

                var status_det = $('#current_status').val();
                generateForm(id_form,content.status_)
               
                
                }
            }); 
        }

    
function alteraStatus(acao){ 
	var eventID = $('#id_atividade').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/nouser.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                    '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:60px;height:60px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Você tem certeza que deseja executar esta ação!</h5>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim!',
					cancelButtonText: 'Não',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {

                      
                        $.ajax({
                            url: "includes/atividade/alteraStatus",
                           data: {
                            eventID:eventID,
                            acao:acao,
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;
                                    data_criacao = response.data_criacao;
                                    if(status == 'SUCCESS'){
                                        toastr.success(status_message, 'Sucesso');
                                        get_info_gerais()
                                    } else {
                                        toastr.error(status_message, 'Error');
                                    }
                                    
                                }
                           });
					
					},
					allowOutsideClick: true			  
                });

       
       
       
}      

function alteraStatusReprovado(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#id_atividade').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/noimage.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Digite o Motivo!</h5>'+
							'<br><span><textarea rows="4" type="text" id="repprove_message" name="repprove_message" class="form-control" ></textarea></span>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, Enviar!',
					cancelButtonText: 'Não Obrigado',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {

                       var repprove_message =  $('#repprove_message').val();
                       if(repprove_message == ''){
                        toastr.success("Digite a Justificativa!", 'Ops'); 
                        return;
                       }
                        
                        $.ajax({
                            url: "includes/calendario/repprove_event",
                           data: {
                            eventID:eventID,
                            acao:acao,
                            id_funcionario:id_funcionario,
                            repprove_message:repprove_message
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;
                                    get_open_service();
                                    toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
                                    $('#calendarModal').modal('hide');
                                    $('#concluido').hide();
                                    $('#reprovar').hide();
                                 }
                           });
					
					},
					allowOutsideClick: true			  
                });

       
       
       
}      

get_info_gerais();


function generateForm(formID,status_det) {

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
                //$('#sjfb-fields').append('<p style="padding:5px;margin: 5px;background: #2f4260;" ><span style="color: #fff;font-size: 16px;font-weight: 700;">Check-list </span></p>')
                
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
                    '<td valign="top" width="40%" ><strong>Descrição da atividade</strong></td>'+
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
                    } else {
                        id_ = conteudo_formulario[i].type+"-"+uniqueID+'-'+j;
                    }

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
                            $('#sig_exec').html('<div id="js-signature-'+uniqueID+'-'+j+'" ></div>');
                        } else {
                            sig_exec = "";
                        }
                        
                        if(c_label == 'Responsável Técnico'){
                            sig_resp = 'js-signature-'+uniqueID+'-'+j+'';
                            $('#sig_resp').html('<div id="js-signature-'+uniqueID+'-'+j+'" ></div>')
                        } else {
                            sig_resp = "";
                        }
                        
                        if(c_label == 'Cliente'){
                            sig_client = 'js-signature-'+uniqueID+'-'+j+'';
                            $('#sig_client').html('<div id="js-signature-'+uniqueID+'-'+j+'" ></div>')
                        } else {
                            sig_client = "";
                        }
                        

                    } else {
                        check_result += '<tr style="'+bg_section+'">'+
                        '<td valign="top" width="50%">'+c_label_final+'</td>'+
                        '<td id="'+id_+'" valign="top" width="10%" style="text-align: center;"></td>'+
                        '<td valign="top" width="10%" style="text-align: center;">'+c_period+'</td>'+
                        '</tr>'+
                        '<tr style="display:none;" id="box_text_comment_'+uniqueID+'-'+j+'" >'+
                            '<td colspan="5" valign="top"><strong>Observações:</strong><div id="text_comment_'+uniqueID+'-'+j+'"></div></td>'+
                        '</tr>'+
                        '<tr style="display:none;" id="box_image_box_'+uniqueID+'-'+j+'">'+
                            '<td colspan="5" valign="top"><strong>Imagens:</strong><div id="image_box_'+uniqueID+'-'+j+'"></div></td>'+
                        '</tr>';
                    }

                   
                    
                    /*if(find_valor == rates[i].value){
                            $("input[name="+find_id+"]").val([find_valor]);
                        
                    } */
                    j++;
                }
                $('#table_results').html(check_result);

                
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
            
                                $('#'+find_id).html('<strong>'+find_valor+'</strong>');
                                
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
                                }); */
                                if (find_id.indexOf('js-signature') > -1){
                                    $('#'+find_id).html('<img src="'+find_valor+'"  style="width:100%;" " >');
                                }
                                $('#'+find_id).val(find_valor);
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
                        $('#box_'+box_show).show();
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
                        $('#'+target).append(the_images);
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
                        $('#'+target_img).html('<img style="width:180px" src="'+src_img_sign+'" />')
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

</script>
