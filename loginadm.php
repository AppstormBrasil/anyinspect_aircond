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
            <div class="row justify-content-between h-100" style="background: #2f4260db;">
                <div class="col-xl-6">
                    <div class="login-info">
                    <h1><span style="color:#ffffff">Mirante</span><span style="color:#c7c7c7;">Marina</span></h1>
                        <h2 style="color:#ffffff!important">Gestão para seu negócio</h2>
                        <p style="color:#ffffff!important" class="mb-5">Tenha a controle do seu negócio na palma das suas mãos</p>
                        <h5 style="color:#ffffff!important" >Contato: (12) 98316-9778</h5>
                        <h5 style="color:#ffffff!important">Email: <span>contato@appstorm.com.br</span></h5>
                    </div>
                </div>
                <div class="col-xl-4 p-0">
                    <div class="form-input-content bg-white login-form">
                        <div class="card" style="box-shadow: 0 0rem 0rem rgba(255, 255, 255, 0.1);">
                            <div class="card-body">
                                <div class="logo text-center">
                                    <a href="login">
                                       
                                        <img src="images/empresa/logo.png">
                                    </a>
                                </div>
                                <h4 class="text-center mt-4">Acessar Sistema</h4>
                                <form class="mt-5 mb-5 form-pet-login" action="javascript:login_pet();" method="get">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required value="SuperAdmin@SuperAdmin.com" >
                                    </div>
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required value="SuperAdmin">
                                    </div>
									
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div class="form-check p-l-0">
                                                <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                <label class="form-check-label ml-3" for="basic_checkbox_1">Lembrar</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 text-right"><a href="esqueceu-senha">Esqueceu a senha ?</a>
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
                                    <input type="hidden" name="ip" id="ip"  class="form-control" value="0">
                                    <input type="hidden" name="ip_city" id="ip_city"  class="form-control" value="0">
                                </form>
                                
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
    <script src="includes/funcionario/login_admin.js"></script>
</body>

</html>