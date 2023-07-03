$('#nome').on('keyup', function() {
    if (this.value.length > -1) {
    $('#nome_left').html(this.value);
 }});
 toastr.options = {"positionClass": "toast-top-full-width"}
 
 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $('.rg').mask('99.999.999-9');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');
 $('.rg').mask('99.999.999-9'); 

jQuery(".form-morador").validate({
    rules: {
        "nome": {
            required: !0
        },
        "email": {
          required: true,
          email : true
      }
    },
    messages: {
        "nome": {
			  required: "Campo obrigatório",
			  minlength: "O título deve conter pelo menos três caracteres"
        },
        "email": {
          required: "Campo obrigatório"
          }

    },

    ignore: [],
    errorClass: "invalid-feedback animated fadeInUp",
    errorElement: "div",
    errorPlacement: function(e, a) {
        jQuery(a).parents(".form-group > div").append(e)
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-valid")
    }

});

function save_colaborador(){
	nome = $("#nome").val();
  funcao = $("#funcao").val();
  email = $("#email").val();
  telefone1 = $("#telefone1").val();
  telefone2 = $("#telefone2").val();
  cep = $("#cep").val();
  endereco = $("#endereco").val();
  numero = $("#numero").val();
  bairro = $("#bairro").val();
  cidade = $("#cidade").val();
  estado = $("#estado").val();
  pais = 'Brasil'
  cpf = $("#cpf").val();
  rg = $("#rg").val();
  cnh = $("#cnh").val();
  data_nascimento = $("#data_nascimento").val();
  portador = $("#portador").val();
  
  obs = $("#obs").val();
    
    $.ajax({
        url: "includes/controller/colaborador/save_colaborador", 
        type : 'POST', 
        dataType: 'JSON',
        data: { 
          nome:nome,
          funcao:funcao,
          email:email,
          telefone1:telefone1,
          cep:cep,
          endereco:endereco,
          numero:numero,
          bairro:bairro,
          cidade:cidade,
          estado:estado,
          pais:pais,
          cpf:cpf,
          rg:rg,
          cnh:cnh,
          data_nascimento:data_nascimento,
          portador:portador,
          telefone2:telefone2,
          obs:obs
        },
               success: function(response){ 
               var json = response; 
               status = json.status; 
               status_txt = json.status_txt;
               IdVisitante = json.last_id;
               last_id = json.last_id;
               if(status == 'SUCCESS') { 
                   page_direct = 'editar-funcionario-'+last_id;
                   setTimeout(function(){
                       toastr.success(status_txt, 'Sucesso');
                       window.location.href = page_direct;
                     }, 100); 
               } else { 
                   $(".loading").hide(); 
                   $(".alert-success").hide(); 
                   $(".alert-danger").hide(); 
                   $(".alert-danger").fadeIn(); 
                   $(".error_txt").html(status_txt); 
               } 
           } 
   });

	
}

id = $("#id_usuario").val();

//UPLOAD IMAGE

    $("#carregar_imagem").click(function(){
        $("#ufile_imagem").click();
    });

  $("#ufile_imagem").change(function(){
	var file = event.target.files;
	$("#load_img").show();
	$(".progress-user").css("width", "0px");
	$("#status_img").html("0%");

	var reader = new FileReader();
	reader.onload = function(e){
        $("#image_avatar").attr("src", e.target.result);
	}
	reader.readAsDataURL(this.files[0]);

	var data = new FormData();
    
    $.each(file, function(key, value)
	{
    var id = $('#id_page').val();
	  data.append(key, value);
	  data.append("id", id);
	});
	//toastr.options = {"positionClass": "toast-top-full-width"}

	$.ajax({
	  xhr: function() {
		var xhr = new window.XMLHttpRequest();
		xhr.upload.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  //$("#status_img").html(percentInt + "%");
		  }
		}, false);
		xhr.addEventListener("progress", function(evt){
		  if (evt.lengthComputable) {
		  var percentComplete = evt.loaded / evt.total;
		  var percentInt = parseInt(percentComplete * 100);
		  $(".progress-user").css("width", percentInt+"%");
		  $("#status_img").html(percentInt + "%");


		  }
		}, false);
		return xhr;
	  },
	  type: 'POST',
    url:  "includes/controller/colaborador/save_comunicado_template_image",
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
        if (status.indexOf("ERROR") == -1) {
          setTimeout(function(){
            $('#status_img').fadeOut();
            $('.progress-user').fadeOut();
            toastr.success(status_message, 'Sucesso');
          }, 400);
        } else {
          setTimeout(function(){
            $('#status_img').fadeOut();
            $('progress-user').fadeOut();
            toastr.error(status_message, 'Error');
          }, 400);


        }

	  }
	});
  });

  ////END UPLOAD IMAGE



function send_enquete_users(){
    $.ajax({
        url: "includes/controller/enquete/save_enquete", 
        type : 'POST', 
        data: { 
            titulo_enquete:titulo_enquete,
            descricao_enquete:descricao_enquete,
            opc1:opc1,
            opc2:opc2,
            opc3:opc3,
            opc4:opc4
        },
               success: function(response){ 
               var json = response; 
               status = json.status; 
               status_txt = json.status_txt;
               IdVisitante = json.last_id;
               if(status == 'SUCCESS') { 
                   setTimeout(function(){
                       toastr.success(status_txt, 'Sucesso');
                     }, 100); 
               } else { 
                   $(".loading").hide(); 
                   $(".alert-success").hide(); 
                   $(".alert-danger").hide(); 
                   $(".alert-danger").fadeIn(); 
                   $(".error_txt").html(status_txt); 
               } 
           } 
   });
}