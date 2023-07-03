jQuery("#form-local").validate({
    rules: {
        "nova_descricao": {
            required: !0
        }
    },
    messages: {
        "nova_descricao": {
			  required: "Campo obrigatório",
			  minlength: "O título deve conter pelo menos três caracteres"
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

		
	function CadastroLocal(){
		var descricao = $("#nova_descricao").val();
		var id_client = $("#id_client").val();
		
		$.ajax({
			url: "includes/local/cadastra_local", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                descricao : descricao, 
                id_client : id_client, 

               
			},
				success: function(response){
					var status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt); 
							toastr.success('Sucesso! Redirecionando....', status_txt)
							window.setTimeout( function(){
								window.location.href = '#localizacao-'+last_id+'';
							}, 1000 );
							
						}, 100); 
					} else {
						$(".loading").hide(); 
						$(".alert-success").hide(); 
						$(".alert-danger").hide(); 
						$(".alert-danger").fadeIn(); 
						$(".error_txt").html(status_txt); 
					} 
				},
				error:function(response){
					alert("Erro!");
					console.log(response);
				} 
			});
		}