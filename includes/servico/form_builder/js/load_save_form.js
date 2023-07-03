




    var formID = $('#id_form').val();
    var at = $('#at').val();
    generateForm(formID);



$( "#save_btn" ).click(function() {
    //$( "form" ).submit();
});


if($("form").length > 0){
            var validate = $("form").validate({
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
            console.log('ainda nao 0')

        }


    $("form").on("submit", function(e){
          console.log(validate.invalid)


    toastr.options = {"positionClass": "toast-top-full-width"}    
       // e.preventDefault();
       var form = $(this).serialize();
        var x = $( this ).serializeArray();
        var output = [];

        x.forEach(function(value) {
        var existing = output.filter(function(v, i) {
            return v.name == value.name;
        });
        if (existing.length) {
            var existingIndex = output.indexOf(existing[0]);
            output[existingIndex].value = output[existingIndex].value.concat(value.value);
        } else {
            if (typeof value.value == 'string')
            value.value = [value.value];
            output.push(value);
        }
        });

        function isEmpty(obj) {
            for(var key in obj) {
                if(obj.hasOwnProperty(key))
                    return false;
            }
            return true;
        }

        if(isEmpty(validate.invalid)) {
            console.log('e vazaio')
            var data = JSON.stringify(output);
                var formID = $('#id_form').val();
                $.ajax({
                method: "POST",
                url: 'includes/form_builder/sjfb-save-result',
                data: {
                    data : data,
                    formID:formID,
                    at:at
                },
                dataType: 'json',
                success: function(response) {
                    status = response.status;
                    status_message = response.status_txt;
                    toastr.success(status_message, 'Sucesso');
                              
                }
            });

        
    
        event.preventDefault();  
        } else {
            console.log('nao e vazaio')
            // Object is NOT empty
        }

       

       

    });

//}





    



