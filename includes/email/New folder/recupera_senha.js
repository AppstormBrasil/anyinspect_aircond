function recupera_senha() {
	$(".loading").show();
	email = $('#email').val();
	
	if(email != ''){
		$.ajax({
	  url:  "includes/email/ola.php",
	  type : 'POST',
	  data:{
		  email:email
	  },
      success: function(response){
      var json = JSON.parse(response);
      status = json.status;
      status_message = json.status_txt;
			if(status  == 'SUCCESS') {
				$(".loading").hide();
				$(".alert-danger-func").hide();
				$(".alert-success").show();
				$(".success_txt").html(status_message);
            } else {
				$(".loading").hide();
				$(".alert-danger").hide();
				$(".alert-danger").fadeIn();
				$(".error_txt").html(status_message);
            }
			}
		});
		
	} else {
		$(".loading").hide();
		$(".alert-success").hide();
		$(".alert-danger").hide();
		$(".alert-danger").fadeIn();
		$(".error_txt").html('Por favor inserir um e-mail');
	}
	
    
}