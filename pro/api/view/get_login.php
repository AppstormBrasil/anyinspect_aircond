<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
//$_GET = json_decode(file_get_contents('php://input'), true);
$db = new db(); 

if(isset($_GET['email'])){ $email = $_GET['email'];} else { $email  = '';} 
if(isset($_GET['device_type'])){ $device_type = $_GET['device_type'];} else { $device_type  = '';} 
$password = trim($_GET['password']);	
$password = md5($password);

if($email != ""){ 
  $db->query('SELECT 
  pt.id,
  pt.name,
  pt.foto,
  pt.qr_code,
  pt.type,
  pt.type2,
  pt.sign
  FROM tb_team pt
  WHERE pt.email = :email  AND pt.password = :password'); 
  $db->bind(':email', $email);
  $db->bind(':password', $password);
 
} else { 
  	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Não foi possível encontrar o usuário'; 
	echo json_encode($arr);
	exit(0);
 } 
 function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
	$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 $myArray = [];
	 foreach($result as $row) { 
		$id = $row["id"];
		$foto = $row["foto"];
		if ($foto != ""){
			$foto = prod_path."/images/upload/funcionarios/".$foto;
		}else{
			$foto = prod_path."/images/nouser.png" ;
		}
		
		array_push($myArray, [
			'id' => $row['id'],
			'name' => $row['name'],
			'type' => $row['type'],
			'type2' => $row['type2'],
			'qr_code'   => $row['qr_code'],
			'sign'   => $row['sign'],
			'foto'   => $foto
		]);		 
	 } 
		  $myArray['status'] = 'SUCCESS';
		  $myArray['status_txt'] = 'Login realizado com Sucesso!'; 
		  echo json_encode($myArray);
		$ip = "";
		$ip_city = "";
		$ip = get_client_ip();
		if($ip > 7){
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
			if(isset($details->city)){
				$ip_city = $details->city;
			} else {
				$ip_city = '';
			}
			
		} 
		  $db->query('INSERT INTO tb_user_login ( id_usuario,ip,ip_city,date_login,device_type ) VALUES (:id_usuario,:ip,:ip_city,:date_login,:device_type)'); 
		  $db->bind(':id_usuario',$id); 
		  $db->bind(':ip',$ip); 
		  $db->bind(':ip_city',$ip_city);
		  $db->bind(':date_login',$created_at);
		  $db->bind(':device_type',$device_type); 
		  $db->execute();
	 	 exit(0);
} else { 
		$arr['status'] = 'ERROR'; 
	 	$arr['status_txt'] = 'Login ou Senha inválidos'; 
	 	echo json_encode($arr);
		exit(0);
	 	 } 

 ?>