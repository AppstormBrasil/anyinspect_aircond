/**
 * Simple Jquery Form Builder (SJFB)
 * Copyright (c) 2015 Brandon Hoover, Hoover Web Development LLC (http://bhoover.com)
 * http://bhoover.com/simple-jquery-form-builder/
 * SJFB may be freely distributed under the included MIT license (license.txt).
 */

//generates the form HTML
function generateForm(formID) {

    //empty out the preview area
    $("#sjfb-fields").empty();

    var formID = $('#id_form').val();

    $.getJSON('includes/form_builder/sjfb-load-form?form_id=' + formID, function(data) {
        if (data) {
            //go through each saved field object and render the form HTML

            var titulo_formulario = data.titulo_formulario;
            var tipo_formulario = data.tipo_formulario;
            var imagem = data.imagem;
            var conteudo_formulario = JSON.parse(data.conteudo_formulario);

            $('#titulo_formulario_user_card').html(titulo_formulario);
            $('#tipo_formulario_user_card').html(tipo_formulario);
            $("#user_avatar").attr("src", imagem); 
            i = 0;
            k = 0;
            $.each( conteudo_formulario, function( k, v ) {

                var fieldType = v['type'];
                //Add the field
                $('#sjfb-fields').append(addFieldHTML(fieldType));
                var $currentField = $('#sjfb-fields .sjfb-field').last();

                //Add the label
                $currentField.find('label').text(v['label']);

                //Any choices?
                if (v['choices']) {

                    //var uniqueID = Math.floor(Math.random()*999999)+1;

                    var uniqueID = formID;
                    var name_radio = $currentField.find('label').text(v['label']).prevObject[0].id;
                     
                    $.each( v['choices'], function( k, v ) {


                        if (fieldType == 'select') {
                            var selected = v['sel'] ? ' selected' : '';
                            var choiceHTML = '<option' + selected + '>' + v['label'] + '</option>';
                            $currentField.find(".choices").append(choiceHTML);
                        }

                        else if (fieldType == 'radio') {

                            var selected = v['sel'] ? ' checked' : '';
                            var choiceHTML = '<label class="checkbox control control--radio"><input type="radio" name="radio-' + name_radio + '"' + selected + ' value="' + v['label'] + '"><div class="control__indicator"></div><span>' + v['label'] + '</span></label>';
                            $currentField.find(".choices").append(choiceHTML);
                        }

                        else if (fieldType == 'checkbox') {
                            var selected = v['sel'] ? ' checked' : '';
                            var choiceHTML = '<label class="control control--checkbox" ><input id="ch_'+i+'" type="checkbox" name="checkbox-' + uniqueID + '[]"' + selected + ' value="' + v['label'] + '"><div class="control__indicator" for="ch_'+i+'" ></div><span>' + v['label'] + '</span></label>';
                            $currentField.find(".choices").append(choiceHTML);
                        }
                         i++;
                       
                    });
                

                }

                //Is it required?
                if (v['req']) {
                    if (fieldType == 'text') { $currentField.find("input").prop('required',true).addClass('required-choice') }
                    else if (fieldType == 'textarea') { $currentField.find("textarea").prop('required',true).addClass('required-choice') }
                    else if (fieldType == 'select') { $currentField.find("select").prop('required',true).addClass('required-choice') }
                    else if (fieldType == 'radio') { $currentField.find("input").prop('required',true).addClass('required-choice') }
                    $currentField.addClass('required-field');
                }



            });
        }

        //HTML templates for rendering frontend form fields
        function addFieldHTML(fieldType) {
            k++;
            var uniqueID = formID;
            var rand = formID;
            switch (fieldType) {

                case 'text':
                    return '' +
                        '<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-text form-group">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input name="text-'+uniqueID+'-'+k+'" class="form-control" type="text" id="text-'+uniqueID +'-'+k+'">' +
                        '</div>';

                case 'textarea':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-textarea">' +
                        '<label for="textarea-' + uniqueID + '"></label>' +
                        '<textarea name="textarea-'+ uniqueID +'-'+k+'"  id="textarea-' + uniqueID +'-'+k+'"></textarea>' +
                        '</div>';

                case 'select':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-select">' +
                        '<label for="select-' + uniqueID + '"></label>' +
                        '<select name="select-' + uniqueID +'-'+k+'" id="select-' + uniqueID +'-'+k+'" class="form-control choices choices-select"></select>' +
                        '</div>';

                case 'radio':
                    return '' +
                        '<div id="sjfb-' + uniqueID +'-'+k+'" class="sjfb-field sjfb-radio">' +
                        '<label></label>' +
                        '<div class="choices choices-radio"></div>' +
                        '</div>';

                case 'checkbox':
                    return '' +
                        '<div id="sjfb-checkbox-'+uniqueID +'-'+k+ '" class="sjfb-field sjfb-checkbox">' +
                        '<label class="sjfb-label"></label>' +
                        '<div class="choices choices-checkbox"></div>' +
                        '</div>';

                case 'agree':
                    return '' +
                        '<div id="sjfb-agree-' + uniqueID +'" class="sjfb-field sjfb-agree required-field">' +
                        '<input name="checkbox-' + uniqueID +'-'+k+'" type="checkbox" required>' +
                        '<label></label>' +
                        '</div>'
            }
        }
    });
}

