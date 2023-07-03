<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
 if(isset($_GET['email'])){ $email = $_GET['email'];} else { $email  = '';} 
   $password = trim($_GET['password']);	
   $password = md5($password);	

if($email != ""){ 
  
  $db->query('SELECT IdColaborador,IdCondominio,nome,email,telefone1,telefone2,telefone3,rg,cpf,cnh,funcao,cep,endereco,numero,bairro,cidade,estado,pais,status,data_cadastro,qrcode_colaborador , imagem FROM tb_admin_colaborador tc WHERE tc.email = :email  AND tc.senha = :password'); 
					
					
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