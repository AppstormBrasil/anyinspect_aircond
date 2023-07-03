<?php

  include('../common/connection.php');
  require_once('PHPMailerAutoload.php');
  $email = $_POST["email"];
  
  if($email != ''){
	$database = new Database();
	$database->query('SELECT email,IdUsuario,nome FROM usuario WHERE email = :email  ');
	$database->bind(':email', $email);
	$row = $database->single();

	  if($row != ''){

		$new_pass = sprintf("%06d", mt_rand(1, 999999));
		$senha = md5($new_pass);
		$email = $row["email"];
		$nome = $row["nome"];
		$IdUsuario = $row["IdUsuario"];
		
		$database->query('UPDATE usuario SET senha = :senha WHERE IdUsuario = :IdUsuario ');
		$database->bind(':senha', $senha);
		$database->bind(':IdUsuario', $IdUsuario);

		if($database->execute()){ 
			 $arr['status'] = 'SUCCESS';
			 $arr['senha'] = $new_pass;
			 $arr['status_txt'] = 'Sua nova senha foi enviada para o e-mail solicitado!' ;
			 
			 /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
 
			$enviaFormularioParaNome = $nome;
			$enviaFormularioParaEmail = $email;
			 
			$caixaPostalServidorNome = 'Filtratech - Ambiental';
			$caixaPostalServidorEmail = 'no-reply@filtratech.com.br';
			$caixaPostalServidorSenha = 'Taveira1';
			 
			 
			 
			$mensagemConcatenada = 'Recuperação de Senha'.'<br/>'; 
			$mensagemConcatenada .= '-------------------------------<br/><br/>'; 
			$mensagemConcatenada .= 'Nome: '.$nome.'<br/>'; 
			$mensagemConcatenada .= 'E-mail: '.$email.'<br/>'; 
			$mensagemConcatenada .= 'Assunto: Recuperação de Senha<br/>';
			$mensagemConcatenada .= '-------------------------------<br/><br/>'; 
			$mensagemConcatenada .= 'Mensagem: Sua nova Senha: '.$new_pass.' <br/>';
			$mensagemConcatenada .= 'Acesse o Link abaixo para acessar: <br/>';
			$mensagemConcatenada .= 'http://smartcond.com.br/painel/login <br/>';
			
			$mail = new PHPMailer();
 
			$mail->IsSMTP();
			$mail->SMTPAuth  = true;
			$mail->Charset   = 'utf8_decode()';
			$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
			$mail->Port  = '587';
			$mail->Username  = $caixaPostalServidorEmail;
			$mail->Password  = $caixaPostalServidorSenha;
			$mail->From  = $caixaPostalServidorEmail;
			$mail->FromName  = utf8_decode($caixaPostalServidorNome);
			$mail->IsHTML(true);
			$mail->Subject  = utf8_decode($assunto);
			$mail->Body  = utf8_decode($mensagemConcatenada);
			 
			 
			$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
			 
			if(!$mail->Send()){
			$mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
			}else{
			$mensagemRetorno = 'Formulário enviado com sucesso!';
			}
			 
			 
			 
			 echo json_encode($arr);
			 exit(0);
		} else {
			 $arr['status'] = 'ERROR';
			 $arr['status_txt'] = 'Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
			 exit(0);
		}
		
	 
	 } else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! E-mail não encontrado!";
		echo json_encode($arr);
		
		
	 
	 }  
  }
  
   
exit(0);

?>
