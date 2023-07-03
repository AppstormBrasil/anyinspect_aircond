<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/datepicker/jquery.datetimepicker.min.css">
    
    <link rel="stylesheet" href="js/leaf/leaflet.css" />

    
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css?v1.2" rel="stylesheet">
    <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    
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
            <div class="content-body" id="miniaresult"></div> 
        <!--**********************************
            Footer start
        ***********************************-->
       <?php include('includes/common/footer.php'); ?>
        <!--**********************************
            Footer end
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
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="js/leaf/leaflet.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script> 
    <script src="assets/plugins/tables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/tables/buttons.flash.min.js"></script>
    <script src="assets/plugins/tables/jszip.min.js"></script>
    <script src="assets/plugins/tables/pdfmake.min.js"></script>
    <script src="assets/plugins/tables/vfs_fonts.js"></script>
    <script src="assets/plugins/tables/buttons.html5.min.js"></script>
    <script src="assets/plugins/tables/buttons.print.min.js"></script>

    <script src="js/webcam.min.js"></script>
	
	<script src="js/highchart/highcharts.js"></script>
	<script src="js/highchart/heatmap.js"></script>
    <script src="js/highchart/series-label.js"></script>
    <script src="js/highchart/exporting.js"></script>
	<script src="js/highchart/export-data.js"></script>
	<script src="js/highchart/accessibility.js"></script>
	<script src="js/highchart/drilldown.js"></script>
	<script src="assets/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>

    <script src="js/ajax.js"></script>
    <script>
    toastr.options = {"positionClass": "toast-top-full-width"}
    </script>
</body>

</html>