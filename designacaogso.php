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
    $id = $_GET['id'];

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
        font-size: 1.3rem;
        font-family: "sans-serif", sans-serif;
        /*font-family: "Courier New", sans-serif;*/
        border: 0;
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
<input type="hidden" value="<?=$id?>" id="id_user" />
        <div class="container-fluid" >
            <div class="row">
            <div id="relatorio" class="post-content" style="background:white;padding:10px;margin:auto;margin-bottom: 20px;width: 1280px;">
                <table cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height:80px;margin-bottom:20px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="30%" class="logo_empresa"></td>
                            <td valign="top" width="40%" class="text-center endereco_empresa"></td>
                            <td valign="top" width="30%" class="text-center id_form">Data<h2><?=$data_relatorio?></h2></td>
                        </tr>
                        
                    </tbody>
                </table>
                
                <div style="margin-top: 100px;" class="text-center">
                <p >Por meio da presente, a RM DNATA designa ao senhor: </p>
                <h2><strong id="nome_colaborador"></strong></h2>
                <p>Para que possa efetuar as funções de: </p>
                <h4><strong>Gestor do Sistema de Gerenciamento de Segurança Operacional</strong></h4>
                <p style="margin-top: 30px;">Como <strong>Gestor do SGSO</strong> o mencionado funcionário está autorizado para realizar as seguintes funções:</p>
                

                </div>
                

                <table cellspacing="1" cellpadding="0" class="responsive" style="width:100%;margin-top:40px;margin-bottom:80px;">
                    <tbody>
                        <tr>
                            <td valign="top">a) Coordenar a implementação, manutenção e integração do SGSO em todas as áreas da organização de manutenção, em conformidade com os requisitos aplicáveis;</td>
                        </tr>
                        <tr>
                            <td valign="top">b) Facilitar a identificação de perigos e a análise de riscos à segurança operacional;</td>
                        </tr>
                        <tr>
                            <td valign="top">c) Monitorar a efetividade dos controles de risco à segurança operacional;</td>
                        </tr>
                        <tr>
                            <td valign="top">d) Formalizar junto ao Gestor Responsável a necessidade de alocação de recursos demandados para implementação, manutenção e melhoria contínua do SGSO;</td>
                        </tr>
                        <tr>
                            <td valign="top">e) Planejar e facilitar a promoção da segurança operacional em todas as áreas da organização de manutenção;</td>
                        </tr>
                        <tr>
                            <td valign="top">f) Relatar regularmente ao Gestor Responsável sobre o desempenho do SGSO e qualquer necessidade de melhoria;</td>
                        </tr>
                        <tr>
                            <td valign="top">g) Assessorar o Gestor Responsável no exercício de suas responsabilidades relacionadas ao gerenciamento da segurança operacional, fornecendo subsídios para a tomada de decisões.</td>
                        </tr>
                       
                       
                    </tbody>
                </table>               
                <p>Todas as funções deverão ser realizadas de acordo com os procedimentos estabelecidos no MOM da Empresa.</p>
               

                <table cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:20px; width: 100%;">
                    <tbody style="border: 1px solid white;">
                        <tr>
                        <td valign="top" width="33%" id="signature_resp" style="text-align: center;"></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" id=""></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" id="signature_resp" style="text-align: center;"></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td valign="top" width="33%" >Funcionário Designado</td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" ></td>
                            <td valign="top" width="2%"></td>
                            <td valign="top" width="33%" style="border-top: 1px solid #222;">Gestor Responsável</td>
                        </tr>
                    </tbody>
                </table>
            
            </div>
            
            </div>
               
            </div>
            <!-- #/ container -->
            <?php include('includes/common/right-sidebar-filter-colab.php'); ?>
        
        </div>
      
        <style>


        </style>

<script src="js/jspdf.debug.js"></script>
    
<script>
    
    var lista_colaborador = new Array(''); 
    var show_atividades = 0
    var data_inicial = "";
    var data_final = "";
    $('.data').mask('99/99/9999');

    jQuery('.datetimepicker_inicio').datetimepicker({
        timepicker: false, 
        format:'d/m/Y',
		  inline:false,
          todayButton:true,
          autoclose: true,
		  lang:'pt',
		  step: 5,
		  scrollInput: false,
          defaultTime:'07:00' ,
         
	 });
    
    
    function generatePDF() {
        $('.sidebar-right-trigger').click();
        var doc = new jsPDF('p', 'pt', 'a4');
        doc.internal.scaleFactor = 2.2
        var options = {
            pagesplit: false,
            format: 'JPEG',
            "background": '#fff',
        };
        doc.setLineWidth(0.2);
        doc.addHTML($('#relatorio'), options ,  function() {
        doc.save("Designacaogso.pdf");
        });
    }

    
    
    get_info_calibracao(lista_colaborador,show_atividades,data_inicial,data_final);
    
    $('.sidebar-right-trigger').on('click', function() {
        $('.sidebar-right').toggleClass('show');
    });
    //$('#lista_base').select2();
    $('#lista_colaborador').select2();

    $(".show_atividades").change(function() {
        if(this.checked) {
            $('#box_other').show();
            $('#show_atividades').val(1);
        } else {
            $('#box_other').hide();
            $('#data_inicial').val('');
            $('#data_final').val('');
            $('#show_atividades').val(0);
        }
    });
    
    /*$('#dias_vencer').on('change', function() {
        var check_value = this.value;
        if(check_value == 'Outro'){
            $('#box_other').show();
        } else {
            $('#data_inicial').hide();
            $('#data_final').val('');
        } 
    }); */
            

function get_info_calibracao(lista_colaborador,show_atividades,data_inicial,data_final){
    var id_user = $('#id_user').val();
    $.ajax({
    url:"includes/funcionario/get_relatorio_funcionario",
    method:"GET",
    dataType: 'JSON',
    data:{
        lista_colaborador:lista_colaborador,
        show_atividades:show_atividades,
        data_inicial:data_inicial,
        data_final:data_final,
        id_user:id_user
                    
    },
        success:function(response){

            var empresa = response.empresa;
            var colaborador = response.colaborador;
            var responsavel = response.responsavel;
            var habilitacao = response.habilitacao;
            var treinamento = response.treinamento;
            var profissional = response.profissional;
            var atividades = response.atividades;

            $('#box_atividades').hide();
            $('#table_results_atividades').html('');
            
            
            var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
            var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'
            $(".logo_empresa").html('<img  style="width:100%;height:70px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
            $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
            $(".nome_responsavel").html(responsavel.name);
            $("#signature_resp").html('<img style="width:100%;" src="'+colaborador.sign+'" alt="Responsável" />');

            var info_colab_endereco = '<h6>'+colaborador.street + ' , ' + colaborador.neighbor + ' , nº ' + colaborador.number + ', ' + colaborador.city+' - '+ colaborador.state + ' '+colaborador.zip +'</h6>';

            $("#nome_colaborador").html(colaborador.name);
            $("#endereco_colaborador").html(info_colab_endereco);
            $("#phone_colaborador").html(colaborador.phone);
            $("#phone2_colaborador").html(colaborador.phone2);
            $("#email_colaborador").html(colaborador.email);
            $("#email2_colaborador").html(colaborador.email);
            $("#local_colaborador").html(colaborador.local_nascimento);
            $("#nascimento_colaborador").html(colaborador.data_nascimento);

            if(profissional){
                if(profissional.anac){
                $("#anac_colaborador").html(profissional.anac.valor);
                }
                
                if(profissional.crea){
                    $("#crea_colaborador").html(profissional.crea.valor);
                }
                
                if(profissional.designacao){
                    $("#designacao_colaborador").html(profissional.designacao.valor);
                }
            }

            

            
            $("#licenca_colaborador").html(colaborador.email);
            $("#cargo_colaborador").html(colaborador.cargo);
            
            $("#admissao_colaborador").html(colaborador.data_admicao);
            
            if(habilitacao){
                check_result = "";
                habilitacao.forEach(function(el){
                    check_result += '<tr style="height:15px;">'+
                    '<td valign="top" width="50%">'+el.descricao+'</td>'+
                    '<td valign="top" width="10%">'+el.valor+'</td>'+
                    '<td valign="top" width="10%">'+el.data_expira+'</td>'+
                    '</tr>';
            });
                $('#table_results_habilitacao').html(check_result);
            }
            
            if(treinamento){
                check_result_treinamento = "";
                treinamento.forEach(function(el){
                    
                    check_result_treinamento += '<tr style="height:15px;">'+
                    '<td valign="top">'+el.desc_qual+'</td>'+
                    '<td valign="top">'+el.horaria_qual+'</td>'+
                    '<td valign="top">'+el.local_qual+'</td>'+
                    '<td valign="top">'+el.dataini_qual+'</td>'+
                    '<td valign="top">'+el.datafim_qual+'</td>'+
                    '<td valign="top">'+el.validade_qual+'</td>'+
                    '</tr>';
            });

                $('#table_results_treinamento').html(check_result_treinamento);
            }

            if(show_atividades == 1){
                $('#box_atividades').show();
                if(atividades){
                    check_result_atividade = "";
                    atividades.forEach(function(el){
                        
                        check_result_atividade += '<tr style="height:15px;">'+
                        '<td valign="top">'+el.iata+'-'+el.id_servico+'</td>'+
                        '<td valign="top">'+el.short_dec+'</td>'+
                        '<td valign="top">'+el.nome_cliente+'</td>'+
                        '<td valign="top">'+el.descricao_ativo+'</td>'+
                        '<td valign="top">'+el.started_at+'</td>'+
                        '<td valign="top">'+el.ended_at+'</td>'+
                        '<td valign="top">'+el.status+'</td>'+
                        '</tr>';
                });

                    $('#table_results_atividades').html(check_result_atividade);
                }
            } else {
                $('#box_atividades').hide();
            }
            
            


            
        
        
        
        
        }
    }); 
}

get_funcionario_filter();
	function get_funcionario_filter(){
		$('#lista_colaborador').select2({
        ajax: {
          url: 'includes/calendario/get_funcionarios_filtro',
          type : 'POST',
		  dataType: 'JSON',
          delay: 10,
		  data: function (params) {
				return {
				  searchTerm: params.term // search term
				};
		  },
		
			processResults: function (data, page) {
				var resultsfun = [];
				$.each(data, function (i, v) {
					var o = {};
					o.id = v.id;
					o.name = v.name;
					o.foto = v.foto;
					o.phone = v.phone;
					resultsfun.push(o);

				});

				return {
					results: resultsfun
				};
			},
			cache: true
			},
		  escapeMarkup: function (markupfun) { return markupfun;},
		  minimumInputLength: 0,
		  minimumResultsForSearch: -1,
		  templateResult: filfunresult,
		  templateSelection: filfunselec,
		});
		
		function filfunresult(data) {
			var markupfun = "";
			if(data.loading){
				markupfun = "Procurando";
			}
			else if (data.id == undefined) {
				markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="single_lnk btn btn-primary btn-sm" href="#cadastro-funcionario" >Cadastrar Funcionario</a>';
				return;
			} else {
				var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +' </span>';
			}
			
			return markupfun;
		}
		function filfunselec(data) {
			var markupfun = "";
			if(data.loading){
				markupfun = "Procurando";
			}
			else if (data.id == undefined) {
				markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="btn btn-primary btn-sm" href="#cadastro-funcionario" >Cadastrar Funcionario</a>';
				return;
			} else {
				var markupfun = '<span><img style="height:30px;width:30px;border-radius:25px;" src="'+data.foto+'" class="flag" /> ' + data.id +' - ' + data.name +'</span>';
			}
			
			return markupfun;
		}
	}



function apply_filter(e){
    $('.sidebar-right-trigger').click();
    var show_atividades = $('#show_atividades').val();
    var data_inicial = $('#data_inicial').val();
    var data_final = $('#data_final').val();
    var lista_colaborador = $('#lista_colaborador').val();

    if(lista_colaborador.length == 0){
        var lista_colaborador = new Array(''); 
        lista_colaborador = lista_colaborador;
    } else {
        lista_colaborador = $('#lista_colaborador').val(); 
    }
    
    get_info_calibracao(lista_colaborador,show_atividades,data_inicial,data_final);

}

</script>
