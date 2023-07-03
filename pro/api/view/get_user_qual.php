<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
//$_GET = json_decode(file_get_contents('php://input'), true);
$db = new db(); 

$_GET = json_decode(file_get_contents('php://input'), true);
if(isset($_GET['IdUser'])){ $IdUser = $_GET['IdUser'];} else { $IdUser  = '';} 
  
  $db->query('SELECT ttq.* 
  FROM tb_team_qual ttq
  WHERE tt.id = :IdUser'); 
  $db->bind(':IdUser', $IdUser);

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

	 	 exit(0);
} else { 
		$arr['status'] = 'ERROR'; 
	 	$arr['status_txt'] = 'Login ou Senha inválidos'; 
	 	echo json_encode($arr);
		exit(0);
	 	 } 

 ?>