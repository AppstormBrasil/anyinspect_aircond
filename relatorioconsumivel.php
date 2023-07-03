<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("M");
    $year = date("Y");
    $data_relatorio = date('d/m/Y'); 
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

table {
    border-color:#FFF;
    border: 0;
}

table, th, td {
  border-collapse: collapse;
}

.has-error{position:relative!important;}
.sidebar-right.show {
    right: 0;
    z-index: 999;
    width: 40rem;
    height: 100%;
    margin-top: 0px;
}

</style>
        <div class="container-fluid" >
            <div class="row">
            <div id="relatorio" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height:80px;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="30%" class="logo_empresa"></td>
                            <td valign="top" width="40%" class="text-center endereco_empresa"></td>
                            <td valign="top" width="30%" class="text-center id_form">Data Relatório<h2><?=$data_relatorio?></h2></td>
                        </tr>
                        
                    </tbody>
                </table>

                <h4><strong class="title_form">CONTROLE DE CONSUMÍVEIS</strong></h4>
                <br>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="20%">Base:<span ></span></td>
                            <td valign="top" width="79%" class="base_list"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="20%">Responsável:<span></span></td>
                            <td valign="top" width="79%" ><span class="nome_responsavel"></span></td>
                        </tr>
                       
                    </tbody>
                </table>               
                <h5><strong>Ferramentas com <span class="dias_a_vencer"></span> dias para vencer</strong></h5>
                <table border="1" cellspacing="0" cellpadding="0" class="responsive" style=" margin-bottom:80px; height:auto;width:100%">
                    <tr>
                        <td valign="top" width="5%"><strong>Nº</strong></td>
                        <td valign="top" width="20%"><strong>BASE</strong></td>
                        <td valign="top" width="20%"><strong>ITEM</strong></td>
                        <td valign="top" width="33%"><strong>PN</strong></td>
                        <td valign="top" width="2%"><strong>LOTE</strong></td>
                        <td valign="top" width="2%"><strong>QUANTIDADE</strong></td>
                        <td valign="top" width="2%"><strong>VENCIMENTO</strong></td>
                        <td valign="top" width="2%"><strong>DIAS</strong></td>
                       
                    </tr>
                    <tbody id="table_results">
                        
                    </tbody>
                </table>

                <table cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:20px; width: 100%;">
                    <tbody style="border: 1px solid white;">
                        <tr>
                            <td valign="top" width="33%" id=""></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" id=""></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" id="signature_resp" style="text-align: center;"></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td valign="top" width="33%" ></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" ></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" style="border-top: 1px solid #222;">Responsável Técnico</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
                <input type="hidden" id="days" value="<?=$days?>" />
            </div>
            <!-- #/ container -->
            <?php include('includes/common/right-sidebar-filter.php'); ?>
        
        </div>
      
        <style>


        </style>

<script src="js/jspdf.debug.js"></script>
    
<script>
    var base = new Array('CUR','GRU','REC'); 
    var lista_base = base;
    var days = 30;

    function generatePDF() {

        $('.sidebar-right-trigger').click();
        var doc = new jsPDF('p', 'pt', 'a4');
        doc.internal.scaleFactor = 1.5
        var options = {
            pagesplit: true,
            format: 'JPEG',
            "background": '#fff',
        };
        doc.setLineWidth(0.2);
        doc.addHTML($('#relatorio'), options ,  function() {
        doc.save("teste.pdf");
        });

}

    $('.base_list').html(lista_base);
    $('.dias_a_vencer').html(days);
    get_info_calibracao(lista_base,days);
    $('.sidebar-right-trigger').on('click', function() {
        $('.sidebar-right').toggleClass('show');
    });
    $('#lista_base').select2();
    $('#dias_vencer').on('change', function() {
        var check_value = this.value;
        if(check_value == 'Outro'){
            $('#box_other').show();
        } else {
            $('#box_other').hide();
            $('#dias_vencer_custom').val('');
        } 
    });
            

function get_info_calibracao(lista_base,days){
    
    $.ajax({
    url:"includes/produto/get_relatorio_consumivel",
    method:"GET",
    dataType: 'JSON',
    data:{
        days:days,
        base:lista_base
                    
    },
        success:function(response){

        var empresa = response.empresa;
        var responsavel = response.responsavel;
        var consumiveis = response.consumiveis;
        var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
        var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'
        $(".logo_empresa").html('<img  style="width:100%;height:70px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
        $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
        $(".nome_responsavel").html(responsavel.name);
        $("#signature_resp").html('<img style="width:100%;" src="'+responsavel.sign+'" alt="Responsável" />');

        var text_list = "";
        lista_base.forEach(function(el){
            text_list += '<b>'+el+'</b> - ';
        })
        const text_val = text_list.slice(0,-2);
        $('.dias_a_vencer').html(days);
        $('.base_list').html(text_val);
            if(consumiveis){
            check_result = "";
            consumiveis.forEach(function(el){
                
                check_result += '<tr style="height:15px;">'+
                '<td valign="top" width="5%">'+el.i+'</td>'+
                '<td valign="top" width="50%">'+el.base+'</td>'+
                '<td valign="top" width="50%">'+el.desc+'</td>'+
                '<td valign="top" width="10%">'+el.pn+'</td>'+
                '<td valign="top" width="10%">'+el.lote+'</td>'+
                '<td valign="top" width="10%">'+el.qtd+'</td>'+
                '<td valign="top" width="10%">'+el.validade+'</td>'+
                '<td valign="top" width="10%">'+el.dias_expira+'</td>'+
                '</tr>';
        });

        $('#table_results').html(check_result);
        }
        }
    }); 
}



function apply_filter(e){
    $('.sidebar-right-trigger').click();
    var lista_base = $('#lista_base').val();
    if(lista_base.length == 0){
        var base = new Array('CUR','GRU','REC'); 
        lista_base = base;
    } else {
        lista_base = $('#lista_base').val(); 
    }
    if($('#dias_vencer_custom').val() != ''){
        days = $('#dias_vencer_custom').val();
    } else {
        days = $('#dias_vencer').val();
    }
    get_info_calibracao(lista_base,days);

}

</script>
