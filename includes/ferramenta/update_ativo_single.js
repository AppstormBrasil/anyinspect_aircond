
function update_ativo(id){
	var id_cliente = $("#id_page").val();
	var descricao = $("#descricao").val();
	var category = $("#category").val();
	var model = $("#model").val();
	var register = $("#register").val();
	var obs = $("#obs").val();
	var local = $("#local").val();
	var validade = $("#validade").val();
	var calibracao = $("#calibracao").val();
	var responsavel = $("#responsavel").val();
	var fabricante = $("#fabricante").val();
	var capacidade = $("#capacidade").val();
	var tipo = $("#tipo").val();
	var list_pai = $("#list_pai").val();
	var base = $("#base").val();

	var type_pai = $("#type_pai").val();

    var checkbox = $('[name="type_pai"]');
    if (checkbox.is(':checked'))
    {
        type_pai = '1';
    }else
    {
        type_pai = '0';
    }
    $.ajax({
         url: "includes/ferramenta/update_ativo", 
		 type : 'POST', 
		 dataType: 'JSON',
        data: {
				id : id,
                id_cliente : id_cliente, 
                descricao : descricao, 
                category : category, 
                model : model, 
                register : register, 
				obs : obs,
				local:local,
				validade:validade,
				calibracao:calibracao,
				responsavel:responsavel,
				fabricante:fabricante,
				capacidade:capacidade,
				tipo:tipo,
				type_pai:type_pai,
				list_pai:list_pai,
				base:base
			},
                success: function(response){
                var json = response; 
                var status = json.status; 
                status_txt = json.status_txt;
                if(status == 'SUCCESS') {
					toastr.success(status_txt, 'Sucesso!');
					get_ativo_info();
                } else { 
                    $(".loading").hide(); 
                    $(".alert-success").hide(); 
                    $(".alert-danger").hide(); 
                    $(".alert-danger").fadeIn(); 
                    $(".error_txt").html(status_txt); 
                } 
            } 
    });
    
}


function deletePet(id_pet){
	information = '<div class="user-info">'+
						'<div class="image"><img  style="width: 96px;" class="user_pic" src="assets/images/favicon.png" alt="Arquivo"></div>'+
						'<div class="detail">'+
							'<h5>Você tem  certeza que deseja remover este Pet ?</h5>'+
						'</div>'+
					'</div>';
	
	swal({
		html: information,
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, remover!',
		cancelButtonText: 'Cancelar',
		showLoaderOnConfirm: true,
		  
		preConfirm: function() {
		  return new Promise(function(resolve) {
			 $.ajax({
				   url: "includes/controller/pet/delete_pet", 
				   type: 'POST',
				   dataType: "json",
				   data: {
					id_pet : id_pet
				}
			 })
			 .done(function(response){
				var json = response;
				var status = json.status;
				status_txt = json.status_txt;
				swal.close(); 
				$('#row_pet_'+id_pet).remove();
				toastr.success(status_txt, 'Sucesso');  
			   
			 })
			 .fail(function(){
				 toastr.error('Ocorreu algum erro ao deletar , se o problema persistir entrar em contato com o Administrador !', 'Error');  
				 
			 });
		  });
		},
		allowOutsideClick: true			  
	});	
	
}


