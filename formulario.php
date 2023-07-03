<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>	

    <link rel="stylesheet" href="css/formio.full.min.css">
    <style>
    .card-header {
        padding: 0.2rem;
    }
    input[type=radio]:checked {
        left: 0px;
        opacity: inherit;
        position: absolute;
    }

    input[type=radio]:not(:checked) {
        left: 0px;
    opacity: inherit;
    position: absolute;
}
    </style>
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
                <div id="formbuilder" style="background: white;padding: 10px;"></div>
                
            </div>
        </div>
    </div>
    
    <script src="js/formio.full.min.js"></script>
    <script>
        Formio.builder(document.getElementById('formbuilder'), {}, {
        icons: 'fontawesome'
        });
    </script>


</body>

</html>