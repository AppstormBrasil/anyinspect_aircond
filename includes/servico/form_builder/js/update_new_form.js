     if($("#sjfb").length > 0){
            var validate = $("#sjfb").validate({
                    errorClass:"has-error",
                    validClass:"has-success",
                    errorElement:"span",
                    ignore: [],
                    errorPlacement: function(error,element){
                        $(element).after(error);
                        $(element).parents(".form-group").addClass("has-error");
                    },
                    highlight: function(element, errorClass){
                        $(element).parents(".form-group").removeClass("has-success").addClass(errorClass);

                    },
                    unhighlight: function(element, errorClass, validClass){
                        $(element).parents(".form-group").removeClass(errorClass).addClass(validClass);

                    },
                    rules: {
							email: {required : true, email : true}
					} ,
                     messages: {
					  email: "Por favor digite um email válido",
					 
					}
            });

            $(".hide-prompts").on("click",function(){
                validate.resetForm();
            });
        }
    function save_form() {
        //Loop through fields and save field data to array
        var fields = [];

        $('.field').each(function() {

            var $this = $(this);

            //field type
            var fieldType = $this.data('type');

            //field label
            var fieldLabel = $this.find('.field-label').val();

            //field required
            var fieldReq = $this.hasClass('required') ? 1 : 0;

            //check if this field has choices
            if($this.find('.choices li').length >= 1) {

                var choices = [];

                $this.find('.choices li').each(function() {

                    var $thisChoice = $(this);

                    //choice label
                    var choiceLabel = $thisChoice.find('.choice-label').val();

                    //choice selected
                    var choiceSel = $thisChoice.hasClass('selected') ? 1 : 0;

                    choices.push({
                        label: choiceLabel,
                        sel: choiceSel
                    });

                });
            }

            fields.push({
                type: fieldType,
                label: fieldLabel,
                req: fieldReq,
                choices: choices
            });

        });
        var IdFormulario = $('#id_form').val();
        var frontEndFormHTML = '';
        var data = JSON.stringify([{"name":"formID","value":IdFormulario},{"name":"formFields","value":fields}]);

        var new_data = JSON.stringify(fields);
        
        titulo_formulario = $('#titulo_formulario').val();
        tipo_formulario = $('#tipo_formulario').val();

        $.ajax({
            method: "POST",
            url: 'includes/servico/form_builder/sjfb-update-new-form',
            data: {
                conteudo_formulario : new_data,
                titulo_formulario : titulo_formulario,
                tipo_formulario : tipo_formulario,
                IdFormulario : IdFormulario,
            },
            dataType: 'json',
            success: function (response) {
                $("html, body").animate({ scrollTop: 0 }, "fast");
                toastr.options = {"positionClass": "toast-top-full-width"}
                status = response.status;
                status_message = response.status_txt;
                generateForm(IdFormulario,'Em Andamento');
                
                toastr.success(status_message, 'Sucesso');
                lastInsertId = response.lastInsertId;
              
            }
        });
    }



