<!DOCTYPE html>
<html lang="pt" class="h-100" id="login-page2">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Gestão para seu Negócio</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
    
</head>

<?php
    
    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    $ip = "";
    $ip_city = "";
    $ip = get_client_ip();

    if($ip > 7){
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        $ip_city = $details->city;
    } 
?>
<body class="h-100">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div class="login-bg2 h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-between h-100" >
                <div class="col-xl-6">
                </div>
                <div class="col-xl-6 p-0">
				
					<div class="col-xl-6" style="top:10%;">
						<div class="form-input-content bg-white login-form" style="border-radius: 5px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo text-center">
                                    <div href="login">
                                        <img style="width:40px;" src="images/empresa/logo.png">
                                        <h3><span style="color:#1e3547">Any</span><span style="color:#1ea59a;">inspect</span></h3>
                                    </div>
                                </div>
                                
                                 <form id="validate_form" class="mt-5 mb-5 form-pet-login" action="javascript:nova_senha();" method="get">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required value="" >
                                    </div>
                                    
                                    <div class="form-row">
                                        
                                        <div class="form-group col-md-12 text-center"><a href="login">Lembrei minha senha ! Fazer Login</a>
                                        </div>
                                    </div>
                                    <div class="text-center mb-4 mt-4">
                                        <button type="submit" class="btn btn-primary">Acessar</button>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class=""><img class="loading" src="assets/images/loading.gif" alt="" style="margin:auto;width:110px;display:none;"></div>
										<div style="display:none;text-align: center;center;width: 100%;" class="alert alert-success alert-success alert-success-func alert-dismissible" role="alert">
											<span class="success_txt" ></span>
										</div>
										<div style="display:none;text-align: center;center;width: 100%;" class="alert alert-danger alert-danger-func alert-dismissible" role="alert">
												<span class="error_txt" ></span>
										</div>
                                    </div>
                                    <input type="hidden" name="ip" id="ip"  class="form-control" value="<?=$ip ?>">
                                    <input type="hidden" name="ip_city" id="ip_city"  class="form-control" value="<?= $ip_city ?>">
                                </form>
                                
                            </div>
                        </div>
                    </div>
					</div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="assets/plugins/common/common.min.js"></script>
    <!-- Custom script -->
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>

    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="includes/email/recuperar_senha_funcionario.js"></script>
</body>

</html>