<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>		
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
<style>
.select2-container .select2-selection--single {height:50px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height:50px!important}
.select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 2px!important}
.select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}
.container-fluid {width: 90%;}
</style>
<?php $id = $_GET['id']; ?>

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


<input type="hidden" id="id_certificado" name="id_certificado" value="<?php echo $id ?>" />
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card forms-card">
                <div class="card-body">
                    <h4 class="no-print card-title">Certificado Colaborador</h4>
                    <div class="basic-form">
                        <button onclick="window.print();" id="print" type="buttom" class="no-print btn btn-light">Imprimir</button>
                        <form id="form-cliente" action="javascript:EdditarCertificado();" method="post" style="width:100%;">
                            
                            <div class="row">
                                <div id="box_desc" style="display:none;" class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Descrição Certificado <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="descricao" id="descricao" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">

                                <table cellspacing="1" cellpadding="0" class="responsive" style="width:100%;height:80px;margin-bottom:20px;">
                                    <tbody>
                                        <tr>
                                            <td valign="top" width="30%" class="logo_empresa"></td>
                                            <td valign="top" width="40%" class="text-center endereco_empresa"></td>
                                            <!--<td valign="top" width="30%" class="text-center id_form">Data<h2><?=$data_relatorio?></h2></td>-->
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                  <br><br><br>
                                    <div id="conteudo" class="summernote"></div>
                                    <br>

                                    <table cellspacing="1" cellpadding="0" class="responsive" style=" margin-bottom:20px; width: 100%;">
                                        <tbody style="border: 1px solid white;">
                                            <tr>
                                                <td valign="top" width="33%" id="dateCertificado"></td>
                                                <td valign="top" width="2%"></td>
                                                <td valign="top" width="33%" id=""></td>
                                                <td valign="top" width="2%"></td>
                                                <td valign="top" width="33%" id="" style="text-align: center;"></td>
                                            </tr>
                                            <tr>
                                            <td valign="top" width="33%" id="signature_func" style="text-align: center;"></td>
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
                                                <td valign="top" width="33%" style="border-top: 1px solid #222;">Gestor Responsável</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    
                                    <button id="box_save" style="width:100%;display:none;" type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                            
                            <br>

                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>

    

</div>
<script src="assets/plugins/summernote/js/summernote.min.js"></script>
<script>
$('.data').mask('99/99/9999');
 

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


get_information()
 function get_information(){
    id_certificado = $('#id_certificado').val();
    $.ajax({
      url:  "includes/certificados/get_certificado_team",
      type: 'GET',
      dataType:"json",
      data: {id: id_certificado},
      success:function(response)
      {
        var conteudo = response.data.conteudo;
        var descricao = response.data.descricao;
        var empresa = response.empresa;
        var responsavel = response.responsavel;
        var data = response.data.data;

        $("#dateCertificado").html("Data: " + data);
   
        $('.summernote').html(conteudo);
        $('#descricao').val(descricao);

        var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
        var info_empresa_top = '<h6>'+empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number + empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep +'</h6>'+'<h6>Tel:'+empresa.phone+' E-mail:'+empresa.email+'</h6>'
        $(".logo_empresa").html('<img  style="width:55%;height:50px;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
        $(".endereco_empresa").html('<h4>'+empresa.nome_empresa+'</h4>'+info_empresa_top );
        $(".nome_responsavel").html(responsavel.name);
        $("#signature_resp").html('<img src="'+responsavel.sign+'" alt="Responsável" />');
        
        $("#edit_certifica").click(function(e){ 
            e.preventDefault();
            $(".summernote").summernote({
                height: 350,
                minHeight: null,
                maxHeight: null,
                focus: !1
            })
            $(".summernote").summernote("code", conteudo);
            $('#box_desc').show();
            $('#box_save').show();
        });

       
      
      
      }
    });
  
  
    
  }

  $('.sidebar-right-trigger').on('click', function() {
        $('.sidebar-right').toggleClass('show');
    });
    //$('#lista_base').select2();
    $('#lista_colaboradores').select2();

  get_funcionario_filter();
	function get_funcionario_filter(){
		
        $('#lista_colaboradores').select2({
        ajax: {
          url: 'includes/funcionario/get_lista_funcionarios',
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
				markupfun = 'Nenhum Funcionario Cadastrado <a style="float: right;" class="single_lnk btn btn-primary btn-sm" href="#cadastro-treinamento" >Cadastrar Treinamento</a>';
				return;
			} else {
				var markupfun = '<span>'+ data.name+' </span>';
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
				var markupfun = '<span>'+data.name +'</span>';
			}
			
			return markupfun;
		}
	}


function EdditarCertificado(){
    
        var id_certificado = $('#id_certificado').val();
		var descricao = $("#descricao").val();
        var conteudo = $('#conteudo').summernote('code');

		$.ajax({
			url: "includes/certificados/update-certificado", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                descricao : descricao, 
                conteudo : conteudo, 
                id : id_certificado
                
			},
				success: function(response){
					var status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
                            $(".summernote").summernote("destroy");
                            $('#box_desc').hide();
                            $('#box_save').hide();
							toastr.success('Sucesso!', status_txt);
						}, 300); 
					} else {
						$(".loading").hide(); 
						toastr.error('Error!', status_txt);
					} 
				},
				error:function(response){
					alert("Erro!");
					console.log(response);
				} 
			});
		}


        function apply_filter(e){
            $('.sidebar-right-trigger').click();
            //var show_atividades = $('#show_atividades').val();
            var data_inicial = $('#data_inicial').val();
            
            var id_certificado = $('#id_certificado').val();
            var descricao = $("#descricao").val();
            var id_colaborador = $("#lista_colaboradores").val();
            var conteudo = $('#conteudo').summernote('code');

            $.ajax({
                url: "includes/certificados/save-certificado", 
                type : 'POST', 
                dataType: 'JSON',
                data: {
                    descricao : descricao, 
                    conteudo : conteudo, 
                    id : id_certificado,
                    id_colaborador:id_colaborador,
                    data_inicial: data_inicial,
                    
                },
                    success: function(response){
                        var status = response.status; 
                        status_txt = response.status_txt;
                        last_id = response.last_id;
                        
                        if(status == 'SUCCESS') {
                            setTimeout(function(){ 
                                $(".loading").hide(); 
                                $(".summernote").summernote("destroy");
                                $('#box_desc').hide();
                                $('#box_save').hide();
                                $('#data_inicial').val('');
                                $('#lista_colaboradores').empty('');
                                toastr.success('Sucesso!', status_txt);
                            }, 300); 
                        } else {
                            $(".loading").hide(); 
                            toastr.error('Error!', status_txt);
                        } 
                    },
                    error:function(response){
                        alert("Erro!");
                        console.log(response);
                    } 
                });




        }

</script>
