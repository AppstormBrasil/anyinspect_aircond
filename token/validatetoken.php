<!DOCTYPE html>
<html lang="pt" class="h-100" id="login-page2">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Gestão para seu Negócio</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../css/style-full.css" rel="stylesheet">
    
</head>

<body class="h-100">
  
    <div class="login-bg2 h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-between h-100" style="background: #fff;">
                <div class="col-xl-12">
			
                    <div class="login-infos" style="text-align: center;">
					<a href="login"> 
						<img src="../images/empresa/logo.png">
					</a>
					<h5><span style="color:#384969">Recuperação</span><span style="color:#384969;"> Senha</span></h5>
					<?php 
						error_reporting(E_ALL); ini_set("display_errors", 1);
						include('../includes/common/connection.php'); 
						$prod_path = 'https://mirantemarina.agendazy.com.br/';

						if(isset($_GET['id'])){ $id = $_GET['id'];} else { echo 'Erro ao Ressetar sua senha se o problema persister entre em contato com o administrador'; exit(); } 
						$db = new db(); 
						if($id != ""){ 
						
							$db->query('SELECT tt.email,tt.id,tt.name,tt.pass_temp FROM tb_team tt WHERE tt.token_temp = :token_temp'); 
							$db->bind(':token_temp', $id);
							$result = $db->single();					
							//$result = $db->resultset();
							if($result){
							
								$senha = $result["pass_temp"];
								$IdUsuario = $result["id"];
								$email = $result["email"];
								
								$db->query('UPDATE tb_team SET password = :password , token_temp = :token_temp , pass_temp = :pass_temp WHERE id = :id AND email = :email ');
								$db->bind(':password', $senha);
								$db->bind(':token_temp', '');
								$db->bind(':pass_temp', '');
								$db->bind(':id', $IdUsuario);
								$db->bind(':email', $email);

								if($db->execute()){ 
									$arr['status'] = 'SUCCESS';
									//$arr['senha'] = $new_pass;
									$arr['status_txt'] = 'Nova senha validada com Sucesso!' ;
									echo '<h4 style="color:#18998d!important">Nova senha validada com Sucesso</h4>';
									echo '<br><a style="background: #2f4260;border-color: #2f4260;color: #fff;padding: 6px;border-radius: 5px;" href="'.$prod_path.'/login">Click aqui para acessar o sistema</a>';
									exit(0);
								
								} else {
									$arr['status'] = 'ERROR';
									$arr['senha'] = $new_pass;
									$arr['status_txt'] = 'Erro ao recuperar sua senha , caso o problema persista por favor entrar em contato com a administração!' ;
									
									echo '<h4 style="color:#F44336!important">Erro ao recuperar sua senha , caso o problema persista por favor entrar em contato com a administração!</h4>';
									echo '<br><a style="background: #2f4260;border-color: #2f4260;color: #fff;padding: 6px;border-radius: 5px;" href="'.$prod_path.'/login">Click aqui para acessar o sistema</a>';
									exit(0);
								}
							
							
							} else {
									echo '<h4 style="color:#F44336!important">Token não encontrado ou inválido!</h4>';
									echo '<br><a style="background: #2f4260;border-color: #2f4260;color: #fff;padding: 6px;border-radius: 5px;" href="'.$prod_path.'/login">Click aqui para acessar o sistema</a>';
									exit(0);
									
							}
						
						
						
						
						} else {
							echo '<h4 style="color:#F44336!important">Erro ao recuperar sua senha , caso o problema persista por favor entrar em contato com a administração!</h4>';
								echo '<br><a style="background: #2f4260;border-color: #2f4260;color: #fff;padding: 6px;border-radius: 5px;" href="'.$prod_path.'/login">Click aqui para acessar o sistema</a>';
								exit(0);
						}
						
						

						?>

						<br><br><br><br>
                        <h5 style="color:#555!important" class="mb-5">Dúvida ou Sugestão ?</h5>
                        <h5 style="color:#555!important" >Contato: (12) 98316-9778</h5>
                        <h5 style="color:#555!important">Email: <span>contato@appstorm.com.br</span></h5>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


</body>

</html>