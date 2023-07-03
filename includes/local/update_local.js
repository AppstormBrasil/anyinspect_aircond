
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');
 $('.rg').mask('99.999.999-9');


jQuery("#form-local").validate({
    rules: {
        "descricao": {
            required: !0
        }
    },
messages: {
    "descricao": {
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
    



function UpdateLocal(){
	
	var id = $("#id_local").val();
	var cep = $("#cep").val();
	var endereco = $("#endereco").val();
	var numero = $("#numero").val();
	var complemento = $("#complemento").val();
	var bairro = $("#bairro").val();
	var cidade = $("#cidade").val();
	var complemento = $("#complemento").val();
	var estado = $("#estado").val();
	var lat = $("#lat").val();
	var lon = $("#lon").val();
	var responsavel = $("#responsavel").val();
	var descricao = $("#descricao").val();
	var num_fixo = $("#num_fixo").val();
	var num_flutuante = $("#num_flutuante").val();
	var area_climatizada = $("#area_climatizada").val();
	var carga_termica = $("#carga_termica").val();
	var tipo = $("#tipo").val();
	var cliente = $("#cliente").val();
	
	
    $.ajax({
         url: "includes/local/update_local", 
         type : 'POST', 
         dataType: 'JSON',
        data: {
                id : id,
                responsavel : responsavel, 
                descricao : descricao, 
                cep : cep, 
                endereco : endereco, 
                numero : numero, 
                complemento : complemento, 
                bairro : bairro, 
                cidade : cidade, 
                estado : estado, 
                lat : lat, 
                lon : lon,
                num_fixo : num_fixo, 
                num_flutuante : num_flutuante, 
                area_climatizada : area_climatizada, 
                carga_termica : carga_termica,
                cliente : cliente,
                tipo : tipo
			},
                success: function(response){
                var json = response; 
                var status = json.status; 
                status_txt = json.status_txt;

                if(status == 'SUCCESS') {
                    setTimeout(function(){
                        toastr.success(status_txt, 'Sucesso');
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

