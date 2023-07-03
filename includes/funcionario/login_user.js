// ------------- SALVAR INFO USER -------------------------------
if($(".form-ativo-login").length > 0){
	var validate = $(".form-ativo-login").validate({
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
				email:{required: true, email: true} ,
				pwd:{
					required:true,
				  },
			} ,
			messages: {
				email:{
					required:"Por favor digite um email válido",
					equal: "digite Validado",
					email: "Por favor digite um email válido.",
				  } ,
				  pwd:{
					required:"Campo Obrigatório",
					//equal: "digite Validado"
					}
				
				
				
			}
	});

	$(".hide-prompts").on("click",function(){
		validate.resetForm();
	});
}


function login_user() {
	$(".loading").show();
	email = $("#email").val();
	password = $("#password").val();
	ip =  $("#ip").val();
	ip_city =  $("#ip_city").val();
	
	if((email == "") || (password == "")){
		alert("Por favor, digite um e-mail ou senha!");
		return false;
	}
	
    $.ajax({
	  url:  "includes/funcionario/login_user",
	  type : 'GET',
	  dataType:'JSON',
	  data:{
		email:email,
		password:password,
		ip : ip,
		ip_city : ip_city
	  },
      success: function(data){
	  var json = data;
	  user_info = json.info;
      status = json.status;
	  status_message = json.status_txt;
	  page_redirect = json.page_redirect;
			if(status  == 'SUCCESS') {
				$(".loading").hide();

				var _x19a01m31da , _x19a01m31dc , _x19a01m31de, page_redirect

				_x19a01m31da = json._x19a01m31da; 
				_x19a01m31dc = json._x19a01m31dc; 
				_x19a01m31de = json._x19a01m31de;
				_x19a01m31db = json._x19a01m31db;

				createCookie("_x19a01m31da", _x19a01m31da, 2);
				createCookie("_x19a01m31dc", _x19a01m31dc, 2);
				createCookie("_x19a01m31de", _x19a01m31de, 2);
				createCookie("_x19a01m31db", _x19a01m31de, 2);
				
				db.setItem("_x19a01m31da", _x19a01m31da, 2);
				db.setItem("_x19a01m31dc", _x19a01m31dc, 2);
				db.setItem("_x19a01m31de", _x19a01m31de, 2);
				db.setItem("_x19a01m31db", _x19a01m31db, 2);

				db.setItem("user_info", JSON.stringify(user_info), 2);

				$(".alert-danger_user").hide();
				$(".alert-success_user").show();
				$(".success_txt").html(status_message);

				$('.form-condominio-login input[type="email"]').val('');
				$('.form-condominio-login input[type="password"]').val('');
				$('.form-condominio-login input[type="text"]').val('');

				page_redirect = page_redirect;
				window.history.pushState('', '', '/#home');
				setTimeout(function(){
				  location.reload()

	           }, 150);
			
            } else {
				$(".alert-success").hide();
				$(".alert-danger").hide();
				$(".alert-danger").fadeIn();
				$(".error_txt").html(status_message);
				setTimeout(function(){
				$(".loading").hide();
				}, 150);
            }
			}
		});
}




