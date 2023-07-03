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
                                        <td colspan="1" valign="top">#<span class="atividade_id_`+id_atividade+`"></span></td>
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
                            <h5><strong>2 – INFORMAÇÕES DO EQUIPAMENTO:</strong></h5>
                            <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height: 78px;margin-bottom:20px;">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="61%">Equipamento:<span class="desc_ativo_`+id_atividade+`"></span></td>
                                        <td valign="top" width="19%">Modelo:<span class="modelo_ativo_`+id_atividade+`"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="61%">Nº de Série:<span class="register_ativo_`+id_atividade+`"></span></td>
                                        <td valign="top" width="39%">Capacidade:<span class="capacidade_ativo_`+id_atividade+`"></span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" width="61%">Tag:<span class="qrcode_ativo_`+id_atividade+`"></span></td>
                                        <td valign="top" width="39%">Localização:<span class="local_ativo_`+id_atividade+`"></span></td> 
                                    </tr>
                                    <tr>
                                        <td valign="top" width="61%">Fabricante:<span class="fabricante_ativo_`+id_atividade+`"></span></td>
                                        <td valign="top" width="39%"></td> 
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
                            <h5><strong id="nome_atividade_relatorio">4 – Plano de Manutenção e Controle</strong></h5>
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
    url:"includes/servico/get_info_empresa",
    method:"POST",
    dataType: 'JSON',
    data:{
        id:formID
                    
    },
        success:function(response){

        var empresa = response.empresa;
        var cliente = [];
        var config = response.config;
        var content = response[0];
        var service_name = response.service_name.short_dec;
        var comission_total = 0;

        var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();

        var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'

        $(".logo_empresa").html('<img  style="width:100%;height:70px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
        $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
        $("#nome_empresa").html(empresa.nome_empresa);
        $("#email_empresa").html(empresa.email);
        $("#cidade_empresa").html(empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep);
        $("#cep_empresa").html(empresa.cep);
        $("#telefone_empresa").html(empresa.phone);
        $("#nome_atividade_relatorio").html('4 - '+service_name);


            generateForm_view(formID,'Pendente',id_atividade)
        }
    }); 
}

function generateForm_view(formID,status_det,id_atividade) {

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

                
                //call_lista_atividades(id_form,id_atividade);

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