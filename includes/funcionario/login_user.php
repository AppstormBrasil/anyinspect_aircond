<?php 
 
include('../common/connection.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db();
	
$email = trim($_GET['email']);
$password = trim($_GET['password']);	
$password = md5($password);

$ip = trim($_GET['ip']);
$ip_city = trim($_GET['ip_city']);

 if(isset($_GET['email'])){

		$db->query('SELECT * from tb_team pt WHERE pt.email = :email  AND pt.password = :password'); 
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
			$arr['page_redirect'] = "home"; 
			
			echo json_encode($arr);

			$db->query('INSERT INTO tb_user_login ( id_usuario,ip,ip_city,date_login ) VALUES (:id_usuario,:ip,:ip_city,:date_login)'); 
			$db->bind(':id_usuario',$id); 
			$db->bind(':ip',$ip); 
			$db->bind(':ip_city',$ip_city);
			$db->bind(':date_login',$created_at);
			$db->execute();
				
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