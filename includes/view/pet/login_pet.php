<?php 
 
include('../../common/connection.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db();

				/*$arr['_x19a01m31da'] = "1"; // IdColaborador
				$arr['_x19a01m31db'] = "1"; // IdCondominio
				$arr['_x19a01m31dc'] = "Dener"; // nome_colaborador
				$arr['_x19a01m31dd'] = "Maranatha"; // nome_condominio
				$arr['_x19a01m31de'] = "recepcao"; // tipo_colaborador
				$arr['_x19a01m31df'] = "apto"; // tipo_residencia
				$arr['_x19a01m31dh'] = "funcionario"; // user_type
				
				$arr['status'] = "SUCCESS";
				$arr['status_txt'] = 'Login realizado com Sucesso!'; 
				$arr['info'] = "qualquer info";
				$arr['page_redirect'] = "index"; 
				
				echo json_encode($arr);
				
				exit;*/
				

$email = trim($_GET['email']);
$password = trim($_GET['password']);	
$password = md5($password);

 if(isset($_GET['email'])){

		$db->query('SELECT * from pet_team pt WHERE pt.email = :email  AND pt.password = :password'); 
		$db->bind(':email', $email);
		$db->bind(':password', $password);
		$db->execute();
		$result = $db->resultset(); 

		if($result){ 
			foreach($result as $row) {
				$id = $row['id'];
				$name = $row['name'];
				$tipo = $row['type'];

				$arr['_x19a01m31da'] = $id; // IdColaborador
				$arr['_x19a01m31dc'] = $name; // nome_colaborador
				$arr['_x19a01m31de'] = $tipo; // tipo_colaborador
				$arr['_x19a01m31db'] = "1"; // IdCondominio
			}
			
			$info = array("nome"=>$name, "tipo"=>$tipo);
			
			$_SESSION['user_session'] = $name;
			$_SESSION['user_session_id'] = $tipo;
			$arr['status'] = "SUCCESS";
			$arr['status_txt'] = 'Login realizado com Sucesso!'; 
			$arr['info'] = $info;
			$arr['page_redirect'] = "index"; 
			
			echo json_encode($arr);
				
		} else { 
			$arr['status'] = 'ERROR'; 
			$arr['status_txt'] = 'Usuário não encontrado ou desativado'; 
			echo json_encode($arr);
		}

 } else { 
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'E-mail inválido'; 
	echo json_encode($arr);
} 
 
 

 ?>