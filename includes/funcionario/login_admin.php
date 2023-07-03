<?php 
 
include('../common/connection.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db();
	
$email = trim($_GET['email']);
$password = trim($_GET['password']);	

 if(isset($_GET['email'])){


		if($email == 'SuperAdmin@SuperAdmin.com' && $password == 'SuperAdmin'){
			
			$arr['_x19a01m31da'] = '0'; // IdColaborador
			$arr['_x19a01m31dc'] = 'SuperAdmin'; // nome_colaborador
			$arr['_x19a01m31de'] = 'a'; // tipo_colaborador
			$arr['_x19a01m31db'] = "1"; // IdCondominio
		
			$info = array("nome"=>'SuperAdmin', "tipo"=>'a');

			$_SESSION['user_session'] = 'SuperAdmin';
			$_SESSION['user_session_id'] = 'a';
			$arr['status'] = "SUCCESS";
			$arr['status_txt'] = 'Login realizado com Sucesso!'; 
			$arr['info'] = $info;
			$arr['page_redirect'] = "index"; 

			echo json_encode($arr);
		} else {
			$arr['status'] = 'ERROR'; 
			$arr['status_txt'] = 'E-mail ou login inválido'; 
			echo json_encode($arr);
		}
	

 } else { 
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'E-mail inválido'; 
	echo json_encode($arr);
} 
 
 

 ?>