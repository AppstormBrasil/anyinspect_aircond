 toastr.options = {"positionClass": "toast-top-full-width"};
 
 $('#tempo_estimado').mask('00:00');
 $('#preco_sugerido').mask('000.000.000.000.000,00', {reverse: true});

	function salvarRaca(){
		var raca_pet = $("#raca_pet").val();
		
		if(raca_pet == ""){
			alert("Preencha o campo raça!");
			return false;
		}
		
		$.ajax({
			url: "includes/controller/pet/cadastra-raca", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                raca_pet : raca_pet
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt); 
							toastr.success('Sucesso!', status_txt)
						}, 100); 
						
						$("#raca_pet").val("");
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
		
	function salvarServico(){
		var tipo_servico = $("#tipo_servico").val();
		var tempo_estimado = $("#tempo_estimado").val();
		var preco_sugerido = $("#preco_sugerido").val();
		
		var produtos = $("#produtos").val();
		
		preco_sugerido = preco_sugerido.replace(",", ".");
		preco_sugerido_final = parseFloat(preco_sugerido).toFixed(2);
		
		
		if(tipo_servico == ""){
			toastr.error(status_txt, 'Preencha o campo tipo do serviço!');
			return false;
		}
		
		if(tempo_estimado == ""){
			alert("Preencha o campo tempo estimado!");
			return false;
		}
		if(preco_sugerido == ""){
			alert("Preencha o campo preço sugerido!");
			return false;
		}

		
		
		$.ajax({
			url: "includes/controller/pet/cadastra-servico", 
			type : 'POST', 
			data: {
                tipo_servico : tipo_servico,
				tempo_estimado : tempo_estimado,
				preco_sugerido : preco_sugerido,
				produtos : produtos
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt); 
							toastr.success('Sucesso!', status_txt)
						}, 100); 
						$("#tipo_servico").val("");
						$("#tempo_estimado").val("");
						$("#preco_sugerido").val("");
						$("#produtos").val('').trigger('change');
		
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