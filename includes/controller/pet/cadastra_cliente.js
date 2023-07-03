 toastr.options = {"positionClass": "toast-top-full-width"}
 
 $("#car_plate").mask('SSS-9999');
 $('.cpf').mask('000.000.000-00');
 $('.cnpj').mask('99.999.999/9999-99');
 $('.data').mask('99/99/9999');
 $(".zip").mask('99999-999');
 $(".time").mask('00:00');
 $('.phone').mask('(00) 00000-0009');

jQuery("#form-cliente").validate({
    rules: {
        "nome_cliente": {
            required: !0
        }
    },
    messages: {
        "nome_cliente": {
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

function adicionaPet(){
		var num_pets = $("#num_pets").val();
		var num_pets = parseInt(num_pets);
		var num_pets = num_pets + 1;
		
		var newElement = '<br><div class="row"><div class="col-lg-8"><div class="form-group"><label class="text-label">Nome Pet <span style="color:red;">*</span></label><input type="text" name="nome_pet' + num_pets + '" id="nome_pet' + num_pets + '" class="form-control" placeholder="Nome Pet" required ></div></div><div class="col-lg-4"><div class="form-group"><label class="text-label">Gênero <span style="color:red;">*</span></label><select id="sexo_pet' + num_pets + '" name="sexo_pet' + num_pets + '" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required ><option disabled selected value="none"></option><option value="m">Macho</option><option value="f">Fêmea</option></select></div></div></div><div class="row"><div class="col-lg-4"><div class="form-group"><label class="text-label">Raça <span style="color:red;">*</span></label><select id="raca_pet' + num_pets + '" name="raca_pet' + num_pets + '" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required ></select></div></div><div class="col-lg-4"><div class="form-group"><label class="text-label">Porte <span style="color:red;">*</span></label><select id="porte_pet' + num_pets + '" name="porte_pet' + num_pets + '" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required ><option disabled selected value="none"></option><option value="p">Pequeno</option><option value="m">Médio</option><option value="g">Grande</option></select></div></div><div class="col-lg-4"><div class="form-group"><label class="text-label">Comprimento do Corte</label><select id="hair_pet' + num_pets + '" name="hair_pet' + num_pets + '" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required ><option disabled selected value="none"></option><option value="c">Curto</option><option value="m">Médio</option><option value="l">Longo</option></select></div></div></div><div class="row"><div class="col-lg-4"><div class="form-group"><label class="text-label">Comportamento do Pet</label><select id="mood_pet' + num_pets + '" name="mood_pet' + num_pets + '" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required ><option disabled selected value="none"></option><option value="c">Calmo</option><option value="a">Agressivo</option></select></div></div><div class="col-lg-4"><div class="form-group"><label class="text-label">Data de Nascimento</label><input type="text" name="dt_nasc_pet' + num_pets + '" id="dt_nasc_pet' + num_pets + '" class="data form-control" placeholder="Data de Nascimento do Pet" ></div></div><div class="col-lg-4"><div class="form-group"><label class="text-label">Observação</label><textarea type="text" name="obs_pet' + num_pets + '" id="obs_pet' + num_pets + '" class="form-control" placeholder="Observação do Pet"></textarea></div></div></div>';
		$('#pets').append(newElement);
		$('.data').mask('99/99/9999');
		$("#num_pets").val(num_pets);
		
		$('#raca_pet' + num_pets).select2({
        ajax: {
          url: 'includes/view/pet/get_breeds',
          type : 'json',
          delay: 250,
          processResults: function (data) {
			      return {results: data};
			    },
			    cache: true
			  },
		  templateResult: function(data) {
			return data.breed;
		  },
		  templateSelection: function(data) {
			return data.breed;
		  },
      });
	  
	   $('#corte_pet' + num_pets).select2({
        ajax: {
          url: 'includes/view/pet/get_cuts',
          type : 'json',
          delay: 250,
          processResults: function (data) {
			      return {results: data};
			    },
			    cache: true
			  },
		  templateResult: function(data) {
			return data.cut;
		  },
		  templateSelection: function(data) {
			return data.cut;
		  },
      });
	  
	  $('#porte_pet' + num_pets).select2();
	  $('#sexo_pet' + num_pets).select2();
	  $('#mood_pet' + num_pets).select2();
	  $('#hair_pet' + num_pets).select2();
	}
		
	function cadastraCli(){
		var nome_cliente = $("#nome_cliente").val();
		var sexo = $("#sexo").val();
		var email = $("#email").val();
		var telefone1 = $("#telefone1").val();
		var telefone2 = $("#telefone2").val();
		var cep = $("#cep").val();
		var endereco = $("#endereco").val();
		var numero = $("#numero").val();
		var complemento = $("#complemento").val();
		var bairro = $("#bairro").val();
		var cidade = $("#cidade").val();
		var estado = $("#estado").val();
		var cpf = $("#cpf").val();
		var rg = $("#rg").val();
		var data_nascimento = $("#data_nascimento").val();
		var obs = $("#obs").val();
		
		var numero_de_pets = $("#num_pets").val();
		var numero_de_pets = parseInt(numero_de_pets);
		
		var nome_pet_array = [];
		var sexo_pet_array = [];
		var raca_pet_array = [];
		var porte_pet_array = [];
		var corte_pet_array = [];
		var hair_pet_array = [];
		var mood_pet_array = [];
		var dt_nasc_pet_array = [];
		var observacao_pet_array = [];
		
		i = 1;
		while (i <= numero_de_pets) {
			var nome_pet = $("#nome_pet" + i).val();
			var sexo_pet = $("#sexo_pet" + i).val();
			var raca_pet = $("#raca_pet" + i).val();
			var porte_pet = $("#porte_pet" + i).val();
			var corte_pet = $("#corte_pet" + i).val();
			var hair_pet = $("#hair_pet" + i).val();
			var mood_pet = $("#mood_pet" + i).val();
			var dt_nasc_pet = $("#dt_nasc_pet" + i).val();
			var observacao_pet = $("#obs_pet" + i).val();
			
			nome_pet_array.push(nome_pet);
			sexo_pet_array.push(sexo_pet);
			raca_pet_array.push(raca_pet);
			porte_pet_array.push(porte_pet);
			corte_pet_array.push(corte_pet);
			hair_pet_array.push(hair_pet);
			mood_pet_array.push(mood_pet);
			dt_nasc_pet_array.push(dt_nasc_pet);
			observacao_pet_array.push(observacao_pet);
			
			i++;
		}
		
		$.ajax({
			url: "includes/controller/pet/cadastra-cliente", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
                nome_cliente : nome_cliente, 
                sexo : sexo, 
                email : email, 
                telefone1 : telefone1, 
                telefone2 : telefone2, 
                cep : cep, 
                endereco : endereco, 
                numero : numero, 
                complemento : complemento, 
                bairro : bairro, 
                cidade : cidade, 
                estado : estado, 
                cpf : cpf, 
                rg : rg, 
                data_nascimento : data_nascimento, 
                obs : obs, 
                nome_pet_array : nome_pet_array, 
                sexo_pet_array : sexo_pet_array, 
                raca_pet_array : raca_pet_array, 
                porte_pet_array : porte_pet_array,
				corte_pet_array : corte_pet_array,
				hair_pet_array : hair_pet_array,
				mood_pet_array : mood_pet_array,
                dt_nasc_pet_array : dt_nasc_pet_array,
				observacao_pet_array : observacao_pet_array
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					id_cliente = response.id_cliente;
					
					if(status == 'SUCCESS') {
						setTimeout(function(){ 
							$(".loading").hide(); 
							$(".alert-danger").hide(); 
							$(".alert-success").show(); 
							$(".success_txt").html(status_txt);
							window.setTimeout( function(){
								 window.location.href = "cliente-" + id_cliente;
							}, 1000 );
							toastr.success('Sucesso!', status_txt);
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