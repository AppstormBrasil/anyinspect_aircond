$('.money').mask('000.000.000.000.000,00', {reverse: true});
function get_info_produto(){
	var idProduto = $("#id_page").val();
	$.ajax({
     url:"includes/produto/get_info_produto",
	 method:"GET",
	 dataType: 'JSON',
     data:{id:idProduto},
		success:function(response){
		var status = response.status;
		var lista_prod = response.data[0];
			if(status == "SUCCESS") {
				valor = lista_prod.value;
				valor = valor.replace(".", ",");
				qtd = lista_prod.qtd;
				$('#produto').val(lista_prod.desc);
				$('#base').val(lista_prod.base);
				$('#valor').val(valor);
				$('#qtd').val(qtd);
				$('#tipo').html(lista_prod.type);
				$('#validade').val(lista_prod.validade);
				$('#min_qtd').val(lista_prod.min_qtd);
				
				$('#tipo').select2();
				if(lista_prod.foto != ""){
					$("#image_produto").attr('src', lista_prod.foto +'?' + (new Date()).getTime());
				}
			} else {
				window.location.href = '#404';
			}
		}
    }); 

  }
  
