<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

//if(isset($_GET['IdUser'])){ $id = $_GET['IdUser'];} else { $id  = '';}


$db = new db(); 

$db->query("SELECT 
			ps.id , ps.short_dec , ps.est_time , ps.price , ps.foto
			FROM tb_services ps
			ORDER BY ps.short_dec"); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$short_dec = $row["short_dec"];
		$foto = $row["foto"];
		$est_time = $row["est_time"];
		$price = $row["price"];
		
		if ($foto != ""){
			$foto = prod_path."images/upload/servicos/".$foto ;
		}else{
			$foto = prod_path."images/noimage.png" ;
		}

		$response['data'][] = array(
			"id"=>$id,
			"short_dec"=>$short_dec,
			"foto"=>$foto,
			"price"=>$price,
			"est_time"=>$est_time,
		);
		$i++;
	 
		} 
		 $response['status'] = 'SUCCESS';
		 $response['total_all'] = $i;
		echo json_encode($response);
	 	exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = []; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>