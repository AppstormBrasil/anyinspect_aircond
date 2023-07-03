function login_pet() {
	$(".loading").show();
	email = $("#email").val();
	password = $("#password").val();
	
	if((email == "") || (password == "")){
		alert("Por favor, digite um e-mail ou senha!");
		return false;
	}
	
    $.ajax({
	  url:  "includes/view/pet/login_pet",
	  type : 'GET',
	  dataType:'JSON',
	  data:{
		email:email,
		password:password
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

              setTimeout(function(){
					window.location.href = page_redirect;
	           }, 150);
			
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




