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
    $days = $_GET['id'];
   
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


            <div itemprop="sharedContent" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height:80px;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="30%" class="logo_empresa"></td>
                            <td valign="top" width="40%" class="text-center endereco_empresa"></td>
                            <td valign="top" width="30%" class="text-center id_form">Data Relatório<h2><?=$data_relatorio?></h2></td>
                        </tr>
                        
                    </tbody>
                </table>

                <h3><strong class="title_form">Controle de Treinamentos MNT</strong></h3>
                <br>               
                <h5><strong>Menos de <?=$days?> dias</strong></h5>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:80px; height:auto;width:100%">
                    <tr>
                        <td valign="top" width="33%"><strong>Descrição</strong></td>
                        <td valign="top" width="20%"><strong>Colaborador</strong></td>
                        <td valign="top" width="33%"><strong>Cargo</strong></td>
                        <td valign="top" width="2%"><strong>Data</strong></td>
                       
                    </tr>
                    <tbody id="table_results">
                        
                    </tbody>
                </table>

                
                </div>

            </div>
               
                <input type="hidden" id="days" value="<?=$days?>" />
            </div>
            <!-- #/ container -->
        </div>


        <style>
        .has-error{position:relative!important;}

        </style>


    <script>



        var days = $("#days").val();
  
        function get_info_treinamento(){
            $.ajax({
            url:"includes/treinamento/get_relatorio_treinamentos",
            method:"GET",
            dataType: 'JSON',
            data:{
                days:days
                          
            },
                success:function(response){
                var empresa = response.empresa;
                var treinamentos = response.treinamentos;
                var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
                var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'
		
                $(".logo_empresa").html('<img  style="width:100%;height:70px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
                $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
                if(treinamentos){
                    check_result = "";
                    treinamentos.forEach(function(el){
                        console.log(el)
                        check_result += '<tr style="height:15px;">'+
                        '<td valign="top" width="50%">'+el.desc_qual+'</td>'+
                        '<td valign="top" width="10%">'+el.name+'</td>'+
                        '<td valign="top" width="10%">'+el.cargo+'</td>'+
                        '<td valign="top" width="10%">'+el.validade_qual+'</td>'+
                        '</tr>';
                });

                $('#table_results').html(check_result);
                }
                }
            }); 
        }

get_info_treinamento();

</script>
