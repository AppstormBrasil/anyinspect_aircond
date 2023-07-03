
function update_pet_id(id){
	var nome_pet = $("#nome_novo_pet").val();
	var sexo_pet = $("#sexo_novo_pet").val();
	var raca_pet = $("#raca_novo_pet").val();
	var porte_pet = $("#porte_novo_pet").val();
	var hair_pet = $("#hair_novo_pet").val();
	var mood_pet = $("#mood_novo_pet").val();
	var obs_pet = $("#obs_novo_pet").val();
	var dt_nasc_pet = $("#dt_nasc_novo_pet").val();

    $.ajax({
         url: "includes/controller/pet/update_pet", 
		 type : 'POST', 
		 dataType: 'JSON',
        data: {
				id : id,
                nome_pet : nome_pet, 
                sexo_pet : sexo_pet, 
                raca_pet : raca_pet,
                porte_pet : porte_pet,
				hair_pet : hair_pet,
				mood_pet : mood_pet,
				obs_pet : obs_pet,
                dt_nasc_pet : dt_nasc_pet
			},
                success: function(response){
                var json = response; 
                status = json.status; 
                status_txt = json.status_txt;

                if(status == 'SUCCESS') {
                    setTimeout(function(){
                        toastr.success(status_txt, 'Sucesso!');
						window.setTimeout( function(){
								 location.reload();
						}, 1000 );
                    }, 100); 
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
				status = json.status;
				status_txt = json.status_txt;
				swal.close(); 
				$('#row_pet_'+id_pet).remove();
				
				toastr.success(status_txt, 'Sucesso');  
			   
			 })
			 .fail(function(){
				 swal('Oops...', 'Ocorreu algum erro ao deletar , se o problema persistir entrar em contato com o Administrador !', 'error');
			 });
		  });
		},
		allowOutsideClick: true			  
	});	
	
}


/*function deletePet(id_pet){
	
	swal({
		title: "Tem certeza que deseja deletar?",
		text: "Uma vez deletado, não é possível recuperar as informações.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				url: "includes/controller/pet/delete_pet", 
				type : 'POST', 
				data: {
						id_pet : id_pet
				},
				success: function(response){
					var json = response; 
					status = json.status; 
					status_txt = json.status_txt;

					if(status == 'SUCCESS') {
						swal("Sucesso!", "Informações excluídas! Redirecionando...", "success");
						window.setTimeout( function(){
							location.reload();
						}, 1200 );
					} else { 
						$(".loading").hide(); 
						$(".alert-success").hide(); 
						$(".alert-danger").hide(); 
						$(".alert-danger").fadeIn(); 
						$(".error_txt").html(status_txt); 
					} 
				}
			});
		} else {
			return false;
		}
	});
} */

