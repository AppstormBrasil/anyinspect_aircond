<?php 
error_reporting(0);

include('../common/util.php'); 
require_once('email/PHPMailerAutoload.php');
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);
$db = new db(); 
$prod_path = 'https://residencialaltosdaserra6.com.br/adm/'; 
if(isset($_GET['email'])){ $email = $_GET['email'];} else { $email  = '';} 

  if($email != ""){ 
  
  $db->query('SELECT tm.email,tm.IdMorador,tm.nome FROM tb_morador tm WHERE tm.email = :email'); 
  $db->bind(':email', $email);
  $result = $db->single();					
  //$result = $db->resultset();
  if($result){
	$new_pass = sprintf("%06d", mt_rand(1, 999999));
	$senha = md5($new_pass);
	$email = $result["email"];
	$IdMorador = $result["IdMorador"];
	$nome = $result["nome"];
	
	$db->query('UPDATE tb_morador SET senha = :senha WHERE IdMorador = :IdMorador AND email = :email ');
	$db->bind(':senha', $senha);
	$db->bind(':IdMorador', $IdMorador);
	$db->bind(':email', $email);

	if($db->execute()){ 
		 $arr['status'] = 'SUCCESS';
		 $arr['senha'] = $new_pass;
		 $arr['status_txt'] = 'Sua nova senha foi enviada para o e-mail solicitado!' ;

		 function send_mail($user_email,$user_name,$pass,$prod_path){

            
		$boxEmail = '<div style="background-color:#f0f0f0;padding:15px">
			  <table style="width:100%;max-width:600px;background-color:#ffffff;border:none;margin:0 auto;padding:0;color:#666666;font-family:Helvetica,Aria,sans-serif" cellspacing="0">
				<tbody>
				  <tr>
					<td style="padding:7px 5px 5px 5px;text-align:right;background-repeat:no-repeat;background-position:center;background-color:#1d6acc;background-image:url("'.$prod_path.'assets/images/header_email.png")" background="#1d6acc">
					  <a href="#" style="margin-right:5px" target="_blank" data-saferedirecturl="">
					  <img src="'.$prod_path.'assets/images/facebook.png" class="CToWUd"></a>
					  <a href="#" style="margin-right:5px" target="_blank" >
					  <img src="'.$prod_path.'assets/images/googleplus.png" class="CToWUd"></a>
					  <a href="#" target="_blank"  class="CToWUd"></a>
					</td>
				  </tr>
				  <tr>
					<td style="padding:20px;text-align:center">
					  <p>
						<a href="'.$prod_path.'" target="_blank" >
						  <img src="'.$prod_path.'assets/images/logo.png" class="CToWUd">
						</a>
					  </p>
					  <h2 style="font-weight:bold">'.$user_name.'</h2>
					<p>Voçê está recebendo seu login e senha de Acesso!
					</p>
					<br>
					<p>
						Login:<br> <strong>'.$user_email.'</strong>
						<br><br>
						Senha:<br> <strong>'.$pass.'</strong>
						<br><br>
					</p><br><br>
					<p>
					  <small style="color:#777777;font-size:11px">
					   Seu login e senha são de uso <strong>INDIVIDUAL</strong>, em hipótese alguma poderão ser compartilhados.<br>
					  </small>
					</p>
					</td>
				  </tr>
				  <tr><td style="height:5px;background-repeat:no-repeat;background-position:center;background-color:#1d6acc;background-image:url("'.$prod_path.'assets/images/header_email.png")" background="#1d6acc"></td></tr>
				</tbody>
			  </table>
			</div>';
			
			$mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'mail.residencialaltosdaserra6.com.br';
            $mail->SMTPAuth = true;
            $mail->Username = 'contato@residencialaltosdaserra6.com.br';
            $mail->Password = '@dminR&svi';
//           $mail->SMTPSecure = 'tls';
            $mail->SMTPSecure = 'false';
            $mail->Port = 587;
      
            $mail->setFrom('contato@residencialaltosdaserra6.com.br', utf8_decode('Recuperação de Senha'));
            //$mail->addReplyTo('contato@bulltraders.club', 'Nao Responder');
      	    $mail->AddAddress($user_email,utf8_decode($user_name));
            //$mail->addAttachment('local_do_anexo/arquivo.extenção', 'NomeAmigavel.extenção');
      
            $mail->isHTML(true);
            $mail->Subject = utf8_decode('Altos da Serra VI');
            $mail->Body = utf8_decode($boxEmail);
            $mail->AltBody = utf8_decode('Credenciais de acesso');
      
            if(!$mail->send()) {
               $arr['status'] = 'ERROR';
               $arr['status_txt'] = 'Erro: ' . $mail->ErrorInfo;
               echo json_encode($arr);
               exit() ;
            } 
	}
		 

			send_mail($email,$nome,$new_pass,$prod_path);
		 
		
		 
		 echo json_encode($arr);
		 exit(0);
	
	
	
	} else {
		$arr['status'] = 'ERROR';
		$arr['senha'] = $new_pass;
		$arr['status_txt'] = 'Erro ao recuperar sua senha , caso o problema persista por favor entrar em contato com a administração!' ;
		echo json_encode($arr);
		exit(0);
	}
   
   } else {
		$arr['status'] = 'ERROR';
		$arr['status_txt'] = 'Este e-mail ainda não está Cadastrado' ;
		echo json_encode($arr);
		exit(0);
   }
 
 
 
 
 } else {
	echo 'tio aqui';
 }
 ?>