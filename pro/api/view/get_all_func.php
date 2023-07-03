<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

$db = new db(); 
$db->query("SELECT * FROM tb_team ORDER BY FIELD(name, 'Todos' ) DESC , name  "); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$foto = $row["foto"];
		
		if ($foto != ""){
			$foto = prod_path."images/upload/funcionarios/".$foto ;
		}else{
			$foto = prod_path."pro/images/profile.jpg" ;
		}

		$response['data'][] = array(
			"id"=>$id,
			"name"=>$name,
			"foto"=>$foto
			
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = []; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>