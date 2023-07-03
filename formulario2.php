<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '403';</script>";
		exit(0);
	}
?>	
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link rel="stylesheet" href="css/formio.full.min.css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->


    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->

    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
    
</head>

<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include('includes/common/nav-header.php'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->
	
        <!--**********************************
            Header start
        ***********************************-->
		<?php include('includes/common/header.php'); ?>
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('includes/common/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
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
                    <div class="col-12">
                        <div class="loader" id="loader" style="display:none;"></div>
                        
                       
                        <div class="row builder-section" style="display:none;">
                        <div class="col-12">
                            <h3 class="text-center text-muted">The <a href="https://github.com/formio/formio.js" target="_blank">Form Builder</a> allows you to build a <select class="form-control" id="form-select" style="display: inline-block; width: 150px;"><option value="form">Form</option><option value="wizard">Wizard</option><option value="pdf">PDF</option></select></h3>
                            <div class="well" style="background-color: #fdfdfd;">
                            <div id="builder"></div>
                            <button id="saveform" class="btn btn-primary">Save Form</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h3 class="text-center text-muted">as JSON Schema</h3>
                            <div class="well jsonviewer">
                            <pre id="json"></pre>
                            </div>
                        </div>
                        </div>
                        <div class="row builder-section" style="display:none;">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h3 class="text-center text-muted">which <a href="https://github.com/formio/ngFormio" target="_blank">Renders as a Form</a> in your Application</h3>
                            <div id="formio" class="well"></div>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <div class="row builder-section" style="display:none;">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h3 class="text-center text-muted">which creates a Submission JSON</h3>
                            <div class="well jsonviewer">
                            <pre id="subjson"></pre>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
       <?php include('includes/common/footer.php'); ?>
        <!--**********************************
            Footer end
        ***********************************-->

        
        <!--**********************************
            Right sidebar start
        ***********************************-->
        <?php //include('includes/common/right-sidebar.php'); ?>
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    
    <script src="js/formio.full.min.js"></script>
    
   
    <script>
        toastr.options = {"positionClass": "toast-top-full-width"};
    var subJSON = document.getElementById('subjson');
    var loader = document.getElementById('loader');
    var builderInstance = null;
    var builder = null;
    var form = {};

    var loading = function(loading) {
    loader.setAttribute('style', loading ? 'display: inherit;' : 'display:none;');
    }

    


document.body.querySelectorAll('.builder-section').forEach(function(section) {
        section.setAttribute('style', 'display:inherit');
        });
    createBuilder();



    document.getElementById('saveform').addEventListener('click', function() {
    form.title = 'titulo';
    form.name = _.camelCase(form.title).toLowerCase();
    form.path = form.name;
    form.components = builderInstance.schema.components;
    form.data = builderInstance.schema.data;
    //var projectUrl = document.getElementById('projectUrl').value;

    loading(true);

    var new_data = JSON.stringify(form);
    
    $.ajax({
            method: "POST",
            url: 'includes/servico/form_builder/sjfb-update-new-form',
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
                loading(false);
              
            }
        });
      

    /*(new Formio(projectUrl)).saveForm(form).then(function(saved) {
        alert('Form ' + saved._id + ' was created!');
        loading(false);
    }).catch(function(err) { alert(err.message || err); loading(false); }); */
    

});

    var onForm = function(form) {
    form.on('change', function() {
        subJSON.innerHTML = '';
        subJSON.appendChild(document.createTextNode(JSON.stringify(form.submission, null, 4)));
    });
    };

    var setDisplay = function(display) {
    form.display = display;

    //console.log(setDisplay)

    builder.setDisplay(display).then(function(instance) {
        builderInstance = instance;
        var jsonElement = document.getElementById('json');
        var formElement = document.getElementById('formio');
        instance.on('saveComponent', function(event) {
        var schema = instance.schema;

        console.log(instance.schema)

        jsonElement.innerHTML = '';
        formElement.innerHTML = '';
        jsonElement.appendChild(document.createTextNode(JSON.stringify(schema, null, 4)));
        Formio.createForm(formElement, schema).then(onForm);
        });
    
        instance.on('editComponent', function(event) {
        console.log('editComponent', event);
        });
        
        instance.on('updateComponent', function(event) {
        jsonElement.innerHTML = '';
        jsonElement.appendChild(document.createTextNode(JSON.stringify(instance.schema, null, 4)));
        
            console.log(event)
    
    });
        
        instance.on('deleteComponent', function(event) {
        jsonElement.innerHTML = '';
        jsonElement.appendChild(document.createTextNode(JSON.stringify(instance.schema, null, 4)));
        });
        
        Formio.createForm(formElement, instance.schema).then(onForm);
    });
    };

    function createBuilder () {

    currentDisplay = 'form';
    //var projectUrl = document.getElementById('projectUrl').value;
    //console.log(projectUrl)
    //var projectUrl = 'https://examples.form.io/example';
    
    $.ajax({
     url:"includes/atividade/load_form",
	 method:"GET",
	 dataType:'json',
     data:{form_id:1},
		success:function(response){

		var status = response.status;
		//var components = response.components;

        components = JSON.parse(response.conteudo_formulario);
        console.log(components.components)

        builder = new Formio.FormBuilder(document.getElementById("builder"), {
        display: 'form',
        _id: '2',
        name: "teste",
        path: "",
        title: "teste",
        components: components.components
        }, {
        //baseUrl: projectUrl
        });

        setDisplay('form');

        builder.submission = {
            data: {
            textField: 'Joe',
            textField1: 'Smith'
            }
        };
		
        
    }
    }); 
    

    }; 

    // Handle the form selection.
    var formSelect = document.getElementById('form-select');
    formSelect.addEventListener("change", function() {
        setDisplay(this.value);
    });
    </script>


</body>

</html>