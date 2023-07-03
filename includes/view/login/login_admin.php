<?php
 session_start();
  include('../common/connection.php'); 
	
  $email = trim($_GET['email']);
  $password = trim($_GET['password']);	
  $password = md5($password);	


  
  $db = new db();
  $db->query('SELECT 
  tm.IdMorador ,
  tm.IdResidencia,
  tm.nome,
  tm.email,
  tm.telefone1,
  tm.telefone2,
  tm.telefone3,
  tm.cpf,
  tm.rg,
  tm.parentesco,
  tm.qrcode_morador,
  tm.imagem as imagem_morador,
  tm.data_cadastro,
  tmr.IdResidencia,
  tmr.apt,
  tmr.bloco,
  tmr.numero,
  tmr.rua
  tmr.imagem as imagem_residencia,
  tmv.IdMoradorVeiculo,
  tmv.tipo as tipo_veiculo,
  tmv.placa
  tmv.qrcode_veiculo,
  tmv.data_cadastro as data_cadastro_veiculo
  tmr.tipo as tipo_residencia  
  					FROM tb_morador tm 
					INNER JOIN tb_morador_residencia tmr ON tm.IdResidencia = tmr.IdRedidencia
					INNER JOIN tb_morador_veiculo tmv ON tm.IdMorador = tmv.IdMorador 					
					WHERE tm.email = :email  AND tm.senha = :password');
  $db->bind(':email', $email);
  $db->bind(':password', $password);
  $row = $db->single();

  if($row != ''){

	$id_usuario = $row['id_usuario'];
	$id_empresa = $row['id_empresa'];
	$email = $row['email'];
	$nome_empresa = $row['nome_empresa'];
	$nome = $row['nome'];
	$tipo_usuario = $row['tipo_usuario'];
	
	$arr['_x75a544a545'] = $id_usuario; // ID
	$arr['_x75a554b545'] = $nome; // COMPANY
	$arr['_x75a554c545'] = $id_empresa; // USER_NAME
	$arr['_x75a554d545'] = $nome_empresa; // COMPANY
	$arr['tipo_usuario'] = $tipo_usuario; // ID
	
	//$info = array($email, $empresa , $responsavel);	
	

	//$arr['info'] = $info; 
	$_SESSION['user_session'] = $id_usuario;
	$_SESSION['user_session_id'] = $nome_empresa;
	$arr['status'] = "SUCCESS";
	
	//$database->query('UPDATE m_usuario SET signin_count = :signin_count WHERE id = :id_usuario ');
	//$database->bind(':signin_count', $signin_count);
	//$database->bind(':id_usuario', $id_usuario);
	
	
	$arr['status_txt'] = "Sucesso ! Redirecionando...";
	//$arr['page_direct'] = "dashboard"; 
	
	echo json_encode($arr);
	exit(0);
	
 
 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro! E-mail ou Senha inválidos!";
	echo json_encode($arr);
	
	
 
 } 
exit(0);

?>
