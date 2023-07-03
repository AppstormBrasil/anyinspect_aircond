<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
//$_GET = json_decode(file_get_contents('php://input'), true);

$db = new db(); 

if(isset($_GET['id_funcionario'])){ 
    $id_funcionario = $_GET['id_funcionario'];
    $db->query("SELECT * FROM tb_services ts
			LEFT JOIN tb_team_service tts ON ts.id = tts.id_service
			WHERE tts.id_team = $id_funcionario"); 
    
} else { $id_funcionario  = '';
        /*$db->query("SELECT * FROM tb_services ts
			LEFT JOIN tb_team_service tts ON ts.id = tts.id_service
			");*/ 
	   
	    $db->query("SELECT * FROM tb_services ts "); 
    
}


$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["short_dec"];
		$foto = $row["foto"];
		$price = $row["price"];

		$time=$row['est_time'];
		if($time != ''){
		   $timesplit=explode(':',$time);
		   $est_time=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
		}
		
		if ($foto != ""){
			$foto = prod_path."images/upload/servicos/".$foto ;
		}else{
			$foto = prod_path."pro/images/profile.jpg" ;
		}

		$response['data'][] = array(
			"id"=>$id,
			"name"=>$name,
			"foto"=>$foto,
			"price"=>$price,
			"est_time_min"=>$est_time,
			"est_time"=>$row['est_time'],
			
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