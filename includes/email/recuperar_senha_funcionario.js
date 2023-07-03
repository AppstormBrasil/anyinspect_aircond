// ------------- SALVAR INFO USER -------------------------------
if($("#validate_form").length > 0){
	var validate = $("#validate_form").validate({
			errorClass:"has-error",
			validClass:"has-success",
			errorElement:"span",
			ignore: [],
			errorPlacement: function(error,element){
				$(element).after(error);
				$(element).parents(".form-group").addClass("has-error");
			},
			highlight: function(element, errorClass){
				$(element).parents(".form-group").removeClass("has-success").addClass(errorClass);

			},
			unhighlight: function(element, errorClass, validClass){
				$(element).parents(".form-group").removeClass(errorClass).addClass(validClass);

			},
			rules: {
					
					email: {required : true, email : true}
					
			},					
			 messages: {
			  email: "Por favor digite um email válido",
			 
			}
	});

	$(".hide-prompts").on("click",function(){
		validate.resetForm();
	});
}

function nova_senha() {
	$(".loading").show();
	email = $("#email").val();
    $.ajax({
	  url:  "includes/email/recuperar_senha_funcionario",
	  type : 'GET',
	  dataType: "json",
	  data:{
		email:email
	  },
      success: function(data){

	  var json = data;
	  user_info = json.info;
      status = json.status;
	  status_message = json.status_txt;
	  page_redirect = 'login';
			if(status  == 'SUCCESS') {
				$(".loading").hide();
				$(".alert-danger").hide();
				$(".alert-success").show();
				$(".success_txt").html(status_message);

				$('.form_recupera_page input[type="email"]').val('');


				page_redirect = page_redirect;

              setTimeout(function(){
					window.location.href = page_redirect;
	           }, 3000);
			
            } else {
				$(".alert-success").hide();
				$(".alert-danger").hide();
				$(".alert-danger").fadeIn();
				$(".error_txt").html(status_message);
				setTimeout(function(){
					$(".loading").hide();
				}, 300);
            }
			}
		});
}




