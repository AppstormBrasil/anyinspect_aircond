<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
 if(isset($_GET['email'])){ $email = $_GET['email'];} else { $email  = '';} 
   $password = trim($_GET['password']);	
   $password = md5($password);	

if($email != ""){ 
  
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
  tmr.rua,
  tmr.imagem as imagem_residencia,
  tmv.IdMoradorVeiculo,
  tmv.tipo as tipo_veiculo,
  tmv.placa,
  tmv.qrcode_veiculo,
  tmv.data_cadastro as data_cadastro_veiculo,
  tmr.tipo as tipo_residencia  
  					FROM tb_morador tm 
					LEFT OUTER JOIN tb_morador_residencia tmr ON tm.IdResidencia = tmr.IdResidencia
					LEFT OUTER JOIN tb_morador_veiculo tmv ON tm.IdMorador = tmv.IdMorador 					
					WHERE tm.email = :email  AND tm.senha = :password'); 
					
					
  //$db->query('SELECT * FROM tb_morador tm WHERE tm.email = :email  AND tm.senha = :password');					
  $db->bind(':email', $email);
  $db->bind(':password', $password);
  //$row = $db->single();					
 
 //$db->execute();
 } else { 
  	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Nenhuma informação disponível'; 
	echo json_encode($arr);
	exit(0);
 } 
 //$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 foreach($result as $row) { 
	 	 $arr['response'][] = $row; 
	 } 
	 	 $arr['status'] = 'SUCCESS';
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
		$arr['status'] = 'ERROR'; 
	 	$arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	echo json_encode($arr);
		exit(0);
	 	 } 

 ?>