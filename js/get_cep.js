function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
            $("#numero").val("");
            $("#pais").val("");
            $("#complemento").val("");
            $("#lat").val("");
            $("#lon").val("");

    }

    function meu_callbacks(conteudo) {
        if (!("erro" in conteudo))
		{

			if(conteudo.logradouro != null){
				//document.getElementById('address').value=(conteudo.logradouro);
                $("#endereco").val(conteudo.logradouro);
                $("#endereco-error").hide();
                $(".lab_address").css("color" , "#54667a");

			}

			if(conteudo.bairro != null){
                $("#bairro").val(conteudo.bairro);
                $("#bairro-error").hide();
                $(".lab_neighbor").css("color" , "#54667a");
			}

			if(conteudo.localidade != null){
                 $("#cidade").val(conteudo.localidade);
                 $("#cidade-error").hide();
                $(".lab_city").css("color" , "#54667a");
			}
			if(conteudo.uf != null){
                $('#estado').val(conteudo.uf);
                $("#estado-error").hide();
                $(".lab_stati").css("color" , "#54667a");
			}
        
      get_lat_log(conteudo);
        $('#country').val('Brasil');

		    $(".error_cep").hide();
            $(".error_cep_txt_user").html("");
            $(".load_cep").hide();
                     $('#number').focus();
                     $toElement      = "#numero",
                     $focusElement   =  "#numero",
                     $offset         = 1 * 0 || 0,
                     $speed          = 1000 * 1 || 500;

                  $('html, body').animate({
                    scrollTop: $($toElement).offset().top + $offset
                  }, $speed);

                  if ($focusElement) $($focusElement).focus();

        } //end if.
        else {
            limpa_formulário_cep();
					$(".cep_error_txt").fadeIn();
					$(".cep_error_txt").html("CEP não encontrado.");
          $(".load_cep").hide();
			}
		}

    function get_lat_log(conteudo){
      console.log(conteudo);

      logradouro = conteudo.logradouro;
      bairro = conteudo.bairro;
      localidade = conteudo.localidade;
      uf = conteudo.uf;

      ad_final = logradouro+','+bairro+','+localidade+','+uf;
      ad_final = removeAcento(ad_final);

      console.log(ad_final)
      
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://locationiq.org/v1/search.php?key=5073c64ffbe054&q="+ad_final+"&format=json",
        "method": "GET"
      }
      
      
      
      $.ajax(settings).done(function (response) {

        if(response.error){
          console.log(response);
        } else {
          lat = response[0].lat
          lon = response[0].lon
          $('#lat').val(lat);
          $('#lon').val(lon);
        }
          
      });
    }


    function removeAcento (text)
    {       
        text = text.toLowerCase();                                                         
        text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
        text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
        text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
        text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
        text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
        text = text.replace(new RegExp('[Ç]','gi'), 'c');
        return text;                 
    }

		function pesquisacep(valor) {
			$(".load_cep").show();
            var cep = valor.replace(/\D/g, '');
			if (cep != "") {
				var validacep = /^[0-9]{8}$/;
				if(validacep.test(cep)) {
					var script = document.createElement('script');
					script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callbacks';
					document.body.appendChild(script);

				}
				else {
					limpa_formulário_cep();
					$(".error_cep").fadeIn();
					$(".error_cep_txt_user").html("Formato de CEP inválido.");
          $(".load_cep").hide();
				}
			}
			else {
				limpa_formulário_cep();
			}
		};
