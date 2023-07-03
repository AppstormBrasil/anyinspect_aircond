jQuery(".form-mensagem").validate({
  rules: {
      "residencia": {
          required: true
      },
      "mensagem":{
        required: true
      }
  },
  messages: {
      "residencia": {
          required: "Campo obrigatório"
      },
      "mensagem": {
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

function save_mensagem_morador() {
  /////////////// INFORMAÇÕES PESSOAIS //////////////
  
  toastr.options = {"positionClass": "toast-top-full-width"}

  
  var mensagem = $('#mensagem').val();
  var id_morador = $('#id_morador').val();

    $(".loading").show();
		$.ajax({
			url:  "includes/controller/mensagem/enviar_mensagem_morador",
            type : 'POST',
            ataType: "json",
            data: {
              id_morador : id_morador,
              mensagem: mensagem

			},
			success: function(response){
				var json = response;
				status = json.status;
				status_message = json.status_txt;
        last_id = json.last_id;
        data_envio = json.data_envio;
        box_mensagem = "";

				if(status == "SUCCESS") {
          toastr.success(status_message, 'Sucesso');
          $("#residencia").val('').trigger('change');
          $("#mensagem").val('');

          box_mensagem += ' <div class="chat-reciver">'+
          '<div class="media single-message">'+
              '<div class="media-body">'+
                  '<p>'+
                      '<span>'+mensagem+'</span>'+
                      '<small style="margin-top: 40px;color: #222;" class="time">'+data_envio+'</small>'+
                  '</p>'+
              '</div>'+
              '<img class="img-fluid" src="assets/images/chat/1.png" alt="placeholder image">'+
          '</div>'+
      '</div>';

         
          $("#chat_area").append(box_mensagem)
      
				} else {
					$(".loading").hide();
          toastr.error(status_message, 'Sucesso')

				}

			}
		});

}
