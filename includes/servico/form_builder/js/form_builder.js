$(function(){

    $('#titulo_formulario').on('keyup', function() {
        if (this.value.length > -1) {
         $('#titulo_formulario_user_card').html(this.value);
    }});

    $('#tipo_formulario').on('keyup', function() {
        if (this.value.length > -1) {
         $('#tipo_formulario_user_card').html(this.value);
    }});
   

    //If loading a saved form from your db, put the ID here. Example id is "1".
    var formID = $('#id_form').val();

    //Adds new field with animation
    $("#add-field a").click(function() {
        event.preventDefault();
        $(addField($(this).data('type'))).appendTo('#form-fields').hide().slideDown('fast');
        $('#form-fields').sortable();
        
        $('#form-fields').focus();
                     $toElement      = "#form-fields",
                     $focusElement   =  "#form-fields",
                     $offset         = 1 * 0 || 0,
                     $speed          = 1000 * 1 || 500;

        
        $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
        
    /*$('html, body').animate({
        scrollTop: $($toElement).offset().top + $(window).height()
        }, $speed);

        if ($focusElement) $($focusElement).focus();*/
    });

    //Removes fields and choices with animation
    $("#sjfb").on("click", ".delete", function() {
        if (confirm('Tem certeza que deseja deletar?')) {
            var $this = $(this);
            $this.parent().slideUp( "slow", function() {
                $this.parent().remove()
            });
        }
    });

    //Makes fields required
    $("#sjfb").on("click", ".toggle-required", function() {
        requiredField($(this));
    });

    //Makes choices selected
    $("#sjfb").on("click", ".toggle-selected", function() {
        selectedChoice($(this));
    });

    //Adds new choice to field with animation
    $("#sjfb").on("click", ".add-choice", function() {
        $(addChoice()).appendTo($(this).prev()).hide().slideDown('fast');
        $('.choices ul').sortable();
    });

    //Saving form
   
    loadForm(formID);

});

function convert_type(fieldType){
    
    switch (fieldType) {
        case 'text':
            return 'Texto'
        break;
        case 'number':
            return 'Numero'
        break;
        case 'date':
            return 'Data'
        break;
        case 'time':
            return 'Horario'
        break;
        case 'textarea':
            return 'Texto Longo'
        break;
        case 'select':
            return 'Seleção Dropbox'
        break;
        case 'radio':
            return 'Seleção Única'
        break;
        case 'checkbox':
            return 'Seleção Multiplas'
        break;
        case 'agree':
            return 'Aceito dos Termos'
        break;
        case 'section':
            return 'Sessão'
        break;
        case 'signature_box':
            return 'Assinatura'
        break;
       
       
        }
}

//Add field to builder
function addField(fieldType) {

    var hasRequired, hasChoices;
    var includeRequiredHTML = '';
    var includeChoicesHTML = '';
    var bg_field = '';
    var icon_title = '';

    switch (fieldType) {
        case 'text':
            hasRequired = true;
            hasChoices = false;
            break;
        case 'textarea':
            hasRequired = true;
            hasChoices = false;
            break;
        case 'select':
            hasRequired = true;
            hasChoices = true;
            break;
        case 'radio':
            hasRequired = true;
            hasChoices = true;
            break;
        case 'checkbox':
            hasRequired = false;
            hasChoices = true;
            break;
        case 'agree':
            //required "agree to terms" checkbox
            hasRequired = false;
            hasChoices = false;
            break;
        case 'section':
            //required "agree to terms" checkbox
            hasRequired = false;
            hasChoices = false;
            break;
        case 'number':
            //required "agree to terms" checkbox
            hasRequired = true;
            hasChoices = false;
            break;
        case 'date':
            //required "agree to terms" checkbox
            hasRequired = true;
            hasChoices = false;
            break;
        case 'time':
            //required "agree to terms" checkbox
            hasRequired = true;
            hasChoices = false;
            break;
        case 'signature_box':
            //required "agree to terms" checkbox
            hasRequired = false;
            hasChoices = false;
            break;
    }

    if (hasRequired) {
        includeRequiredHTML = '' +
            '<label>Obrigatório? ' +
            '<input class="toggle-required" type="checkbox">' +
            '</label>'
    }

    if (hasChoices) {
        includeChoicesHTML = '' +
            '<div class="choices">' +
            '<ul></ul>' +
            //'<button type="button" class="add-choice">Adicionar Opção</button>' +
            '<a href="javascript:void(0);" class="add-choice" role="button" aria-expanded="false"><i class="ti-plus"></i> Adicionar Opção </a>'+
            '</div>'
    }

    if(fieldType == 'section'){
        bg_field = 'style="background: #18998d;color: #fff;padding: 5px;"';
    }
    
    if(fieldType == 'radio'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-arrow-down-drop-circle-outline"></i>';
    }
    if(fieldType == 'checkbox'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-checkbox-marked"></i>';
    }
    if(fieldType == 'text'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-format-text"></i>';
    }
    if(fieldType == 'number'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-format-text"></i>';
    }
    if(fieldType == 'date'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-calendar"></i>';
    }
    if(fieldType == 'time'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-clock"></i>';
    }
    if(fieldType == 'textarea'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-format-size"></i>';
    }
    if(fieldType == 'signature_box'){
        icon_title = '<i style="font-size: 23px;" class="mdi mdi-pen"></i>';
    }
    return '' +
        '<div '+bg_field+' class="form-group field" data-type="' + fieldType + '">' +
        //'<button type="button"  class="delete"><i class="zmdi zmdi-home"></i></button>' +
        '<a href="javascript:void(0);" class="delete" role="button" aria-expanded="false"><i class="ti ti-trash"></i></a>'+
        '<h4>Tipo : '+icon_title+' ' + convert_type(fieldType) + ' </h4>' +
        '<label>Título:' +
        '<input type="text" class="field-label form-control">' +
        '</label>' +
        includeRequiredHTML +
        includeChoicesHTML +
        '</div>'
}

//Make builder field required
function requiredField($this) {
    if (!$this.parents('.field').hasClass('required')) {
        //Field required
        $this.parents('.field').addClass('required');
        $this.attr('checked','checked');
    } else {
        //Field not required
        $this.parents('.field').removeClass('required');
        $this.removeAttr('checked');
    }
}

function selectedChoice($this) {
    if (! $this.parents('li').hasClass('selected')) {

        //Only checkboxes can have more than one item selected at a time
        //If this is not a checkbox group, unselect the choices before selecting
        if ($this.parents('.field').data('type') != 'checkbox') {
            $this.parents('.choices').find('li').removeClass('selected');
            $this.parents('.choices').find('.toggle-selected').not($this).removeAttr('checked');
        }

        //Make selected
        $this.parents('li').addClass('selected');
        $this.attr('checked','checked');

    } else {

        //Unselect
        $this.parents('li').removeClass('selected');
        $this.removeAttr('checked');

    }
}

//Builder HTML for select, radio, and checkbox choices
function addChoice() {
    return '' +
        '<li>' +
        '<label>Opção: ' +
        '<input type="text" class="choice-label">' +
        '</label>' +
        '<label>Selecionado? ' +
        '<input class="toggle-selected" type="checkbox">' +
        '</label>' +
        //'<button type="button" class="delete">Deletar Escolha</button>' +
        '<a href="javascript:void(0);" class="delete delete_options" role="button" aria-expanded="false"><i class="ti ti-trash"></i></a>'+
        '</li>'
}

//Loads a saved form from your db into the builder
function loadForm(formID) {
    $.getJSON('includes/servico/form_builder/form_edit_load?form_id=' + formID, function(response) {
        if (response) {
            //go through each saved field object and render the builder

            //conteudo_formulario = response.conteudo_formulario;

            var titulo_formulario = response.titulo_formulario;
            var tipo_formulario = response.tipo_formulario;
            var imagem = response.imagem;
            var conteudo_formulario = JSON.parse(response.conteudo_formulario);

            $.each( conteudo_formulario, function( k, v ) {
                //Add the field
                $(addField(v['type'])).appendTo('#form-fields').hide().slideDown('fast');
                var $currentField = $('#form-fields .field').last();

                //Add the label
                $currentField.find('.field-label').val(v['label']);

                //Is it required?
                if (v['req']) {
                    requiredField($currentField.find('.toggle-required'));
                }

                //Any choices?
                if (v['choices']) {
                    $.each( v['choices'], function( k, v ) {
                        //add the choices
                        $currentField.find('.choices ul').append(addChoice());

                        //Add the label
                        $currentField.find('.choice-label').last().val(v['label']);

                        //Is it selected?
                        if (v['sel']) {
                            selectedChoice($currentField.find('.toggle-selected').last());
                        }
                    });
                }

            });

            $('#titulo_formulario').val(titulo_formulario);
            $('#tipo_formulario').val(tipo_formulario);

            $('#titulo_formulario_user_card').html(titulo_formulario);
            $('#tipo_formulario_user_card').html(tipo_formulario);
            $("#user_avatar").attr("src", imagem); 

            $('#form-fields').sortable();
            $('.choices ul').sortable();
        }
    });
}