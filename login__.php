﻿
<?php
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

    <div class="login-bg2 h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-between h-100" >
                <div class="col-xl-6">
                    <!--<div class="login-info">
                    <h1><span style="color:#1e3547">Any</span><span style="color:#1ea59a;">inspect</span></h1>
                        <h2 style="color:#1e3547!important">Gestão para seu negócio</h2>
                        <p style="color:#1e3547!important" class="mb-5">Tenha a controle do seu negócio na palma das suas mãos</p>
                        <h5 style="color:#1e3547!important" >Contato: (12) 98316-9778</h5>
                        <h5 style="color:#1e3547!important">Email: <span>contato@appstorm.com.br</span></h5>
                    </div> -->
                </div>
                <div class="col-xl-6 p-0">
				
					<div class="col-xl-6" style="top:10%;">
						<div class="form-input-content bg-white login-form" style="border-radius: 5px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo text-center">
                                    <div href="login">
                                        <img style="width:200px;" src="images/empresa/logo.png"><br>
                                        <img style="width:100px;" src="images/empresa/logo_any.png">
                                        <!--<h3><span style="color:#1e3547">Any</span><span style="color:#1ea59a;">inspect</span></h3>-->
                                    </div>
                                </div>
                                
                                <form class="mt-5 mb-5 form-ativo-login" action="javascript:login_user();" >
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required value="adm@adm.com" >
                                    </div>
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="password" id="password" name="pwd" class="form-control" placeholder="Senha" required value="teste123" >
                                    </div>
									
                                    <div class="form-row">
                                        
                                        <div class="form-group col-md-12 text-center"><a href="esqueceu-senha">Esqueceu a senha ?</a>
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
                                    <a id="login_click" class="single_link" href="index">teste</a>
                                </form>
                                
                            </div>
                        </div>
                    </div>
					</div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="includes/funcionario/login_user.js"></script>
