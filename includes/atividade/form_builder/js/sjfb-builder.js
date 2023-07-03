/**
 * Simple Jquery Form Builder (SJFB)
 * Copyright (c) 2015 Brandon Hoover, Hoover Web Development LLC (http://bhoover.com)
 * http://bhoover.com/simple-jquery-form-builder/
 * SJFB may be freely distributed under the included MIT license (license.txt).
 */

$(function(){

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
    $("#sjfb").submit(function(event) {
        event.preventDefault();

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

        var frontEndFormHTML = '';

        //Save form to db
        //Demo doesn't actually save. Download project files for save
        var data = JSON.stringify([{"name":"formID","value":formID},{"name":"formFields","value":fields}]);
        $.ajax({
            method: "POST",
            url: 'assets/form_builder/sjfb-save',
            data: data,
            dataType: 'json',
            success: function (msg) {
                console.log(msg);
                $('.alert').removeClass('hide');
                $("html, body").animate({ scrollTop: 0 }, "fast");

                //Demo only
                $('.alert textarea').val(JSON.stringify(fields));
            }
        });
    });

    //load saved form
   
    loadForm(formID);

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
            '<a href="javascript:void(0);" class="add-choice" role="button" aria-expanded="false"><i class="material-icons">note_add</i> Adicionar Opção </a>'+
            '</div>'
    }

    return '' +
        '<div class="form-group field" data-type="' + fieldType + '">' +
        //'<button type="button"  class="delete"><i class="zmdi zmdi-home"></i></button>' +
        '<a href="javascript:void(0);" class="delete" role="button" aria-expanded="false"><i class="material-icons">delete_forever</i></a>'+
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
        '<a href="javascript:void(0);" class="delete delete_options" role="button" aria-expanded="false"><i class="material-icons">delete_forever</i></a>'+
        '</li>'
}

//Loads a saved form from your db into the builder
function loadForm(formID) {
    $.getJSON('includes/form_builder/sjfb-load.php?form_id=' + formID, function(data) {
        if (data) {
            //go through each saved field object and render the builder
            $.each( data, function( k, v ) {
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

            $('#form-fields').sortable();
            $('.choices ul').sortable();
        }
    });
}