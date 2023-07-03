<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col p-md-0">
            <h4>Olá, <span>Blank Page</span></h4>
        </div>
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Blank Page</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-5">
            <div id="formio"></formio>
            
        </div>
    </div>
</div>

   
<script src="js/formio.full.min.js"></script>
                                  
    
    <script>
        toastr.options = {"positionClass": "toast-top-full-width"};
    
        var data_resp = "";

        $.ajax({
            url:"includes/atividade/load_form",
            method:"GET",
            dataType:'json',
            data:{form_id:1},
            success:function(response){ 
            
            var component = "";
            var status = response.status;
            component = JSON.parse(response.conteudo_formulario);
            data_resp = JSON.parse(response.data);
            Formio.icons = 'fontawesome';
            Formio.createForm(document.getElementById('formio'), {
            readOnly: true,
            renderMode: 'html',
            components:component.components,        
    
          }).then(function(form) {

            form.submission = {
                data:data_resp.data
        };


            form.on('submit', function(submission) {
                var new_data = JSON.stringify(submission);
                
                $.ajax({
                    method: "POST",
                    url: 'includes/servico/form_builder/save_user_resp',
                    data: {
                        conteudo_formulario : new_data,
                        titulo_formulario : 'titulo_formulario',
                        tipo_formulario : 'tipo_formulario',
                        IdFormulario : 1,
                    },
                    dataType: 'json',
                    success: function (response) {
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                        toastr.options = {"positionClass": "toast-top-full-width"}
                        status = response.status;
                        status_message = response.status_txt;
                        //generateForm(IdFormulario,'Em Andamento');
                        
                        toastr.success('Salvo com Sucesso', 'Sucesso');
                        lastInsertId = response.lastInsertId;
                        //loading(false);
                    
                    }
                });

            });
        });
           
            
            
        }
        }); 
    </script>
