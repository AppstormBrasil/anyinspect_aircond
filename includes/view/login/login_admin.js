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
							
					} ,
                     messages: {
					  email: "Por favor digite um email válido",
					 
					}
            });

            $(".hide-prompts").on("click",function(){
                validate.resetForm();
            });
        }

function get_login() {
	/////////////// INFORMAÇÕES PESSOAIS //////////////
		email = $("#email").val();
		password = $("#password").val();
		
        //ip =  $("#ip").val();
        //ip_city =  $("#ip_city").val();
        $(".loading").show();
		$.ajax({
			url:  "includes/login/login",
			type : 'GET',
			dataType: 'JSON',
            data: {
				email : email,
				password : password

			},
			success: function(response){
				var json = JSON.parse(response);
				status = json.status;
				status_message = json.status_txt;
				tipo_usuario = json.tipo_usuario;

				if(tipo_usuario != 'administrador'){
					page_direct = 'lista-atividades';
				} else {
					page_direct = 'dashboard';
				}

              
				if(status == "SUCCESS") {
				setTimeout(function(){
					$(".loading").hide();
					$(".alert-success").show();
				    $(".alert-danger").hide();
				    $(".alert-success").fadeIn();
				    $(".error_txt").html(status_message);
                    
					$('#validate_form input[type="email"]').val('');
                    $('#validate_form input[type="password"]').val('');
					$('#validate_form input[type="text"]').val('');

					var _x75a544a545 , _x75a554b545 , _x75a554c545 , _x75a554d545
                    _x75a544a545 = json._x75a544a545; //ID
                    _x75a554b545 = json._x75a554b545; //COMPANY
                    _x75a554c545 = json._x75a554c545; //USER_NAME
					_x75a554d545 = json._x75a554d545; //USER_NAME
					
                    
                     $(".alert-danger_user").hide();
					 $(".alert-success_user").show();
					 $(".success_txt").html(status_message);
					 createCookie("_x75a544a545", _x75a544a545, 2);
					 createCookie("_x75a554b545", _x75a554b545, 2);
                     createCookie("_x75a554c545", _x75a554c545, 2);
					 createCookie("_x75a554d545", _x75a554d545, 2);
					 
                     db.setItem("_x75a544a545", _x75a544a545, 2);
					 db.setItem("_x75a554b545", _x75a554b545, 2);
                     db.setItem("_x75a554c545", _x75a554c545, 2);
					 db.setItem("_x75a554d545", _x75a554d545, 2);
                    
					 setTimeout(function(){
                        window.location.href = page_direct;
                     }, 100);

				}, 100);

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


	function createCookie(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
      }

	  function getLocalStorage() {
		try {
			if(window.localStorage) return window.localStorage;
		}
		catch (e) {
			return undefined;
		}
	}

	var db = getLocalStorage();
	var current_path = "";


}

