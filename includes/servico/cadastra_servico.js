 $('#tempo_estimado').mask('00:00');
 $('#preco_sugerido').mask('000.000.000.000.000,00', {reverse: true});
	function salvarServico(){
		var tipo_servico = $("#tipo_servico").val();
		var tempo_estimado = $("#tempo_estimado").val();
		var description = $("#description").val();
		var preco_sugerido = $("#preco_sugerido").val();
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
			url: "includes/servico/cadastra-servico", 
			type : 'POST', 
			dataType:"JSON",
			data: {
                tipo_servico : tipo_servico,
				tempo_estimado : tempo_estimado,
				preco_sugerido : preco_sugerido,
				description : description,
			},
				success: function(response){
					var status = response.status; 
					status_txt = response.status_txt;
					last_id = response.last_id;
					if(status == 'SUCCESS') {
							$(".loading").hide(); 
							toastr.success('Sucesso!', status_txt)
							window.setTimeout( function(){
								window.location.href = "#servico-" + last_id;
							}, 300 );
						$("#tipo_servico").val("");
						$("#tempo_estimado").val("");
						$("#preco_sugerido").val("");
						$("#description").val("");
		
					} else {
						$(".loading").hide(); 
						toastr.error('Sucesso!', status_txt)
					} 
				},
				error:function(response){
					toastr.error('Erro!', 'Não foi possível cadastrar este item se o problema persistir entre em contato com o Administrador')
				} 
		});
	}