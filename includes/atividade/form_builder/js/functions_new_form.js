/**
 * Simple Jquery Form Builder (SJFB)
 * Copyright (c) 2015 Brandon Hoover, Hoover Web Development LLC (http://bhoover.com)
 * http://bhoover.com/simple-jquery-form-builder/
 * SJFB may be freely distributed under the included MIT license (license.txt).
 */

$(function(){

    $('#titulo_formulario').on('keyup', function() {
        if (this.value.length > -1) {
         $('#titulo_formulario_user_card').html(this.value);
    }});

    $('#tipo_formulario').on('keyup', function() {
        if (this.value.length > -1) {
         $('#tipo_formulario_user_card').html(this.value);
    }});
   

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

                  $('html, body').animate({
                    scrollTop: $($toElement).offset().top + $offset
                  }, $speed);

                  if ($focusElement) $($focusElement).focus();
    });

    //Removes fields and choices with animation
    $("#sjfb").on("click", ".delete", function() {
        if (confirm('Are you sure?')) {
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
    //$("#sjfb").submit(function(event) {
    



    
    /*});*/


});

function convert_type(fieldType){
    
    switch (fieldType) {
        case 'text':
            return 'Texto'
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
       
        }
}

//Add field to builder
function addField(fieldType) {

    var hasRequired, hasChoices;
    var includeRequiredHTML = '';
    var includeChoicesHTML = '';

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
            '<a href="javascript:void(0);" class="add-choice" role="button" aria-expanded="false"><i class="flaticon-add"></i> Adicionar Opção </a>'+
            '</div>'
    }

    return '' +
        '<div class="form-group field" data-type="' + fieldType + '">' +
        //'<button type="button"  class="delete"><i class="zmdi zmdi-home"></i></button>' +
        '<a href="javascript:void(0);" class="delete" role="button" aria-expanded="false"><i class="flaticon-delete"></i></a>'+
        '<h4>Tipo : ' + convert_type(fieldType) + '</h4>' +
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
        '<a href="javascript:void(0);" class="delete delete_options" role="button" aria-expanded="false"><i class="flaticon-delete"></i></a>'+
        '</li>'
}

