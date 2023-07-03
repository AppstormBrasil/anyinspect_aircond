 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $('.rg').mask('99.999.999-9');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');
 $('.rg').mask('99.999.999-9');

function update_pet_id(id){
	var name_bolt = $("#name_bolt_"+id).val();
	var category_bolt = $("#category_bolt_"+id).val();
	var model_bolt = $("#model_bolt_"+id).val();
	var register_bolt = $("#register_bolt_"+id).val();
	var register_bolt = $("#register_bolt_"+id).val();
	var obs_bolt = $("#obs_bolt_"+id).val();
	//var category_bolt_txt = $("#category_bolt_"+id).val();
	var cat = $("#category_bolt_"+id);

	category_bolt_txt = cat[0].selectedOptions[0].innerText;
	
    $.ajax({
         url: "includes/barco/update_barco", 
		 type : 'POST', 
		 dataType: 'JSON',
        data: {
				id : id,
                name_bolt : name_bolt, 
                category_bolt : category_bolt, 
                model_bolt : model_bolt, 
                register_bolt : register_bolt, 
				obs_bolt : obs_bolt
			},
                success: function(response){
                var json = response; 
                var status = json.status; 
                status_txt = json.status_txt;

                if(status == 'SUCCESS') {
                    setTimeout(function(){
                        toastr.success(status_txt, 'Sucesso!');
						$("#name_bolt__"+id+" ").html(name_bolt);
						$("#category_bolt__"+id+"").html(category_bolt_txt);
						$("#model_bolt__"+id+"").html(model_bolt);
						$("#register_bolt__"+id+"").html(register_bolt);
						$("#obs_bolt__"+id+"").html(obs_bolt);
						$("#barco_"+id+"").modal('hide');
                    }, 10); 
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
							'<h5>Você tem  certeza que deseja remover este ítem ?</h5>'+
						'</div>'+
					'</div>';
	
	swal({
		html: information,
		showCancelButton: true,
		confirmButtonColor: '#18998d',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, remover!',
		cancelButtonText: 'Cancelar',
		showLoaderOnConfirm: true,
		  
		preConfirm: function() {
		  return new Promise(function(resolve) {
			   
			 $.ajax({
				   url: "includes/barco/delete_barco", 
				   type: 'POST',
				   dataType: "json",
				   data: {
					id_pet : id_pet
				}
			 })
			 .done(function(response){
				var json = response;
				status = json.status;
				status_txt = json.status_txt;
				swal.close(); 
				$('#row_pet_'+id_pet).remove();
				toastr.success(status_txt, 'Sucesso');  
			   
			 })
			 .fail(function(){
				 toastr.success('Ocorreu algum erro ao deleta , se o problema persistir entrar em contato com o Administrador !', 'Sucesso');  
			 });
		  });
		},
		allowOutsideClick: true			  
	});	
	
}



