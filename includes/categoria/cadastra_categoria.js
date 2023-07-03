 toastr.options = {"positionClass": "toast-top-full-width"};
 
 $('#tempo_estimado').mask('00:00');
 $('#preco_sugerido').mask('000.000.000.000.000,00', {reverse: true});

	function salvarCategoria(){
		var description = $("#description").val();
		
		if(description == ""){
			toastr.error('Error!', 'Digite a Categoria');
			return false;
		}
		
		$.ajax({
			url: "includes/categoria/cadastra_categoria", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                description : description
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							toastr.success('Sucesso!', status_txt);
							//location.reload();
							//$('#lista_product').data.reload();
							var table = $('#lista_ativos').DataTable();
							table.ajax.reload();
						}, 100); 
						
						$("#description").val("");
					} else {
						$(".loading").hide(); 
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){
					toastr.error('Erro!', 'Não foi possível cadastrar este item se o problema persistir entre em contato com o Administrador')
					
				} 
			});
		}
		
