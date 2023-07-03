$( document ).ready(function() {
    $("#car_plate").mask('SSS-9999');
	$('.cpf').mask('000.000.000-00');
	$('.cnpj').mask('99.999.999/9999-99');
	$('.data').mask('99/99/9999');
	$('.rg').mask('99.999.999-9');
	$(".zip").mask('99999-999');
	$(".time").mask('00:00');
	$('.phone').mask('(00) 00000-0009');
	$('.rg').mask('99.999.999-9'); 
});

function get_comp_general() {
	
	  id = $("#id_page").val();
    $.ajax({
	  url:  "includes/view/colaborador/get_colaborador",
	  type : 'GET',
	  data:{
		  id:id
	  },
      success: function(data){
      //var json = JSON.parse(response);
	  
	  
			var json = data.response[0];
			

      status = data.status;
      status_message = json.status_txt;
			if(status  == 'SUCCESS') {
				
				IdColaborador = json.IdColaborador;
				IdCondominio = json.IdCondominio;
				bairro = json.bairro;
				cep = json.cep;
				cidade = json.cidade;
				cnh = json.cnh;
				cpf = json.cpf;
				data_cadastro = json.data_cadastro;
				data_nascimento = json.data_nascimento;
				email = json.email;
				endereco = json.endereco;
				estado = json.estado;
				funcao = json.funcao;
				hora_entrada = json.hora_entrada;
				hora_saida = json.hora_saida;
				imagem = json.imagem;
				nome = json.nome;
				numero = json.numero;
				pais = json.pais;
				portador = json.portador;
				qrcode_colaborador = json.qrcode_colaborador;
				rg = json.rg;
				status = json.status;
				telefone1 = json.telefone1;
				telefone2 = json.telefone2;
				telefone3 = json.telefone3;
				tipo = json.tipo;
				obs = json.obs;

				var img_anexo_form = data.response.formulario_anexo_imagem;
				var anexo_form = data.response.formulario_anexo_url;

				$("#image_avatar").attr('src',imagem + '?' + (new Date()).getTime());
					setTimeout(function(){
				  
					$('#bairro').val(bairro);
					$('#cep').html(cep);
					$('#telefone1').val(telefone1);
					$('#telefone2').val(telefone2);
					$('#cep').val(cep);
					$('#endereco').val(endereco);
					$('#numero').val(numero);
					$('#bairro').val(bairro);
					$('#cnh').val(cnh);
					$('#cidade').val(cidade);
					$('#estado').val(estado);
					$('#obs').val(obs);
					
					//if(ativa == 1){
					//	$( "#ativa").prop('checked', true);
					//} 

					$('#cpf').val(cpf);
					$('#rg').val(rg);
					$('#email').val(email);
					$('#portador').val(portador);
					$('#nome').val(nome);
					$('#nome_left').html(nome);

					

					$('#telefone1').val(telefone1);
					$('#telefone2').val(telefone1);
					$('#data_nascimento').val(data_nascimento);

					if(anexo_form != ''){
            $('#remove_anexo').html('<a class="float-right" href="javascript:RemoveItem('+IdColaborador+')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remover Anexo"><i class="fa fa-close color-danger"></i></a>');
            $('#anexo_name').html('<a target="_blank" href="'+anexo_form+'" ><h5 class="m-b-5">Anexo</h5></a><p><a target="_blank" href="'+anexo_form+'" >Arquivos de Apoio</a></p>');
        } else {
            $('#anexo_name').html('<a target="_blank" ><h5 class="m-b-5">Sem Anexo</h5></a><p>Click na imagem para anexar</p>');
        }

					//$('#data_nascimento').val(tipo_residencia).select2();
					
					//$('#tipo').trigger('change');
					//$("#image_residencia").attr('src',imagem_residencia + '?' + (new Date()).getTime());
					
				
				}, 200);
			
            } else {

            }
			}
		});
}

get_comp_general();

var changeCheckbox = document.querySelector('#ativa');
	


//UPLOAD IMAGE

$("#carregar_imagem_residencia").click(function(){
	$("#selected_image").val('1');
	$("#ufile_imagem_residencia").click();
});

  $("#ufile_imagem_residencia").change(function(){

	var id = $('#id_page').val();
	//var id_image = $("#selected_image").val();
	

	var file = event.target.files;
	$(".progress-img-residencia").css("width", "0px");
	$("#status_img_residencia").html("0%");

	var reader = new FileReader();
	reader.onload = function(e){
		$("#image_residencia").attr("src", e.target.result);
	}


	reader.readAsDataURL(this.files[0]);

	var data = new FormData();
	$.each(file, function(key, value)
	{
	  data.append(key, value);
	  data.append("id", id);
	  //data.append("id_image", id_image);
	});
	//toastr.options = {"positionClass": "toast-top-full-width"}

	$.ajax({
	  xhr: function() {
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  //$("#status_img_residencia").html(percentInt + "%");
		  }
		}, false);
		xhr.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  $(".progress-img-residencia").css("width", percentInt+"%");
		  $("#status_img_residencia").html(percentInt + "%");


		  }
		}, false);
		return xhr;
	  },
	  type: 'POST',
    url:  "includes/controller/residencia/upload_residencia_img",
	  data: data,
	  async: true,
	  cache: false,
	  processData: false,
	  contentType: false,
	  success: function(data) {
        var image_path;
        var json = data;
          status = json.status;
          status_message = json.status_message;
          id_pic = json.id_pic;
        if (status == 'SUCCESS') {
          setTimeout(function(){
            $('#status_img_residencia').hide();
            $(".progress-img-residencia").hide();
            toastr.success(status_message, 'Sucesso');
          }, 400);
        } else {
          setTimeout(function(){
            $('#status_img_residencia').hide();
            $(".progress-img-residencia").hide();
            toastr.error(status_message, 'Error');
          }, 400);


        }

	  }
	});
  });

	////END UPLOAD IMAGE
	
	function RemoveItem(id){
		information = '<div class="user-info">'+
												'<div class="image"><img  style="width: 96px;" class="user_pic" src="images/pdf_img.png" alt="Arquivo"></div>'+
												'<div class="detail">'+
														'<h5>Você tem  certeza que deseja remover este arquivo ?</h5>'+
												'</div>'+
										'</div>';
		
		swal({
				html: information,
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, remover!',
				showLoaderOnConfirm: true,
					
				preConfirm: function() {
					return new Promise(function(resolve) {
							 
						 $.ajax({
									 url:  "includes/controller/colaborador/delete_colaborador_anexo",
									 type: 'POST',
									 data: {
										id : id
								}
						 })
						 .done(function(response){
								var json = response;
								status = json.status;
								status_txt = json.status_txt;
								swal.close(); 

								img_anexo_form = 'images/noimage.jpg'
								
								$('#anexo_name').html('<a target="_blank" ><h5 class="m-b-5">Sem Anexo</h5></a><p>Click na imagem para anexar</p>');
								$('#remove_anexo').html('');
								$("#image_anexo").attr('src',img_anexo_form + '?' + (new Date()).getTime());
								toastr.success(status_txt, 'Sucesso');  
							 
						 })
						 .fail(function(){
								 swal('Oops...', 'Something went wrong with ajax !', 'error');
						 });
					});
				},
				allowOutsideClick: false			  
		});	
		
}
  


