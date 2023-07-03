<?php 
 
include('../../common/connection.php'); 
require_once('../email/PHPMailerAutoload.php');
//require_once('config.php');
$created_at = date('Y-m-d  H:i:s'); 
//$prod_path = 'https://app.anyinspect.com.br/';
$prod_path = 'http://localhost:8080/anyinspect/';
 
$_POST = json_decode(file_get_contents('php://input'), true);
$db = new db(); 

$email = trim($_GET['email']);

 if($email != ""){ 
  
  $db->query('SELECT tt.email,tt.id,tt.name FROM tb_team tt WHERE tt.email = :email'); 
  $db->bind(':email', $email);
  $result = $db->single();					
  //$result = $db->resultset();
  if($result){
	$new_pass = sprintf("%06d", mt_rand(1, 999999));
	$new_token = sprintf("%06d", mt_rand(1, 999999));
	$senha = md5($new_pass);
	$token = md5($new_token);
	$email = $result["email"];
	$IdUsuario = $result["id"];
	$nome = $result["name"];
	
	$db->query('UPDATE tb_team SET pass_temp = :pass_temp , token_temp = :token_temp WHERE id = :id AND email = :email ');
	$db->bind(':pass_temp', $senha);
	$db->bind(':token_temp', $token);
	$db->bind(':id', $IdUsuario);
	$db->bind(':email', $email);

	if($db->execute()){ 
		 $arr['status'] = 'SUCCESS';
		 $arr['senha'] = $new_pass;
		 $arr['status_txt'] = 'Sua nova senha foi enviada para o e-mail solicitado!' ;
		 
		 function send_mail($email,$nome,$new_pass,$prod_path,$token){
  
		$boxEmail = '<div style="background-color:#f0f0f0;padding:15px">
			  <table style="width:100%;max-width:600px;background-color:#ffffff;border:none;margin:0 auto;padding:0;color:#666666;font-family:Helvetica,Aria,sans-serif" cellspacing="0">
				<tbody>
				  <tr>
					<td style="padding:20px;text-align:center">
					  <p>
						<a href="'.$prod_path.'" target="_blank" >
						  <img src="'.$prod_path.'images/empresa/logo.png" class="CToWUd">
						</a>
					  </p>
					  <h2 style="font-weight:bold">'.$nome.'</h2>
					<p style="color:#222;">Voçê está recebendo seu login e senha de Acesso!
					</p>
					<br>
					<p style="color:#222;">
						Login:<br> <strong>'.$email.'</strong>
						<br><br>
						Senha:<br> <strong style="font-size:25px;">'.$new_pass.'</strong>
						<br><br>
						<span style="color:#222;" >Click no Link para confirmar: </span><br> <strong>'.$prod_path.'token/validatetoken?id='.$token.'</strong>
						<br><br>
					   </p><br><br>
						<p style="color:#222;">
						<small style="color:#777777;font-size:11px">
						Seu login e senha são de uso <strong>INDIVIDUAL</strong>, em hipótese alguma poderão ser compartilhados.<br>
						</small>
						</p>
					</td>
				  </tr>
				</tbody>
			  </table>
			</div>';

			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'mail.anyinspect.com.br';
			$mail->SMTPAuth = true;
			$mail->Username = 'contato@anyinspect.com.br';
			$mail->Password = 'agoravai123';
			$mail->SMTPSecure = 'true';
			$mail->Port = 587;
            $mail->setFrom('contato@anyinspect.com.br', utf8_decode('Recuperação de Senha'));
            //$mail->addReplyTo('contato@bulltraders.club', 'Nao Responder');
      	    $mail->AddAddress($email,utf8_decode($nome));
            //$mail->addAttachment('local_do_anexo/arquivo.extenção', 'NomeAmigavel.extenção');
      
            $mail->isHTML(true);
            $mail->Subject = utf8_decode('Anynspect');
            $mail->Body = utf8_decode($boxEmail);
            $mail->AltBody = utf8_decode('Credenciais de acesso');
      
            if(!$mail->send()) {
               $arr['status'] = 'ERROR';
               $arr['status_txt'] = 'Erro: ' . $mail->ErrorInfo;
               echo json_encode($arr);
               exit() ;
            } else {
				$arr['status'] = 'SUCCESS';
				 //$arr['senha'] = $new_pass;
				 $arr['status_txt'] = 'Sua nova senha foi enviada para o e-mail solicitado!' ;
				 echo json_encode($arr);
			} 
		}
		 

			send_mail($email,$nome,$new_pass,$prod_path,$token);
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
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'E-mail não encontrado' ;
	echo json_encode($arr);
 }
 
 

 ?>