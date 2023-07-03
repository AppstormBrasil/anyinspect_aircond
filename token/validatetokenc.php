<?php 
 error_reporting(E_ALL); ini_set("display_errors", 1);
include('../includes/common/connection.php'); 
//$token = $GET_['id'];

if(isset($_GET['id'])){ $id = $_GET['id'];} else { echo 'Erro ao Ressetar sua senha se o problema persister entre em contato com o administrador'; exit(); } 
 
$db = new db(); 


 if($id != ""){ 
  
  $db->query('SELECT cc.email,cc.Idcliente_colaborador,cc.nome,cc.pass_temp FROM cliente_colaborador cc WHERE cc.token_temp = :token_temp'); 
  $db->bind(':token_temp', $id);
  $result = $db->single();					
  //$result = $db->resultset();
  if($result){
	  
	  
	$senha = $result["pass_temp"];
	$Idcliente_colaborador = $result["Idcliente_colaborador"];
	$email = $result["email"];
	
	$db->query('UPDATE cliente_colaborador SET senha = :senha , token_temp = :token_temp , pass_temp = :pass_temp WHERE Idcliente_colaborador = :Idcliente_colaborador AND email = :email ');
	$db->bind(':senha', $senha);
	$db->bind(':token_temp', '');
	$db->bind(':pass_temp', '');
	$db->bind(':Idcliente_colaborador', $Idcliente_colaborador);
	$db->bind(':email', $email);

	if($db->execute()){ 
		 $arr['status'] = 'SUCCESS';
		 //$arr['senha'] = $new_pass;
		 $arr['status_txt'] = 'Nova senha validada com Sucesso!' ;
		 echo 'Nova senha validada com Sucesso!';
		 echo '<br><br><a href="https://enghealth.net/login">Click aqui para acessar o sistema</a>';
		 exit(0);
	
	} else {
		$arr['status'] = 'ERROR';
		$arr['senha'] = $new_pass;
		$arr['status_txt'] = 'Erro ao recuperar sua senha , caso o problema persista por favor entrar em contato com a administração!' ;
		echo json_encode($arr);
		exit(0);
	}
   

   
   
   } else {
		 echo 'Token não encontrado ou invalido!';
		 echo '<br><br><a href="https://enghealth.net/login">Click aqui para acessar o sistema</a>';
		 exit(0);
		
   }
 
 
 
 
 } else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'E-mail não encontrado' ;
	echo json_encode($arr);
 }
 
 

 ?>