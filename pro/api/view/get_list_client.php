<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

$db = new db(); 

$db->query("SELECT 
			COUNT(pb.id_client) as total_visit , 
			pc.id , pc.foto , pc.name , pc.phone
			FROM tb_client pc
			LEFT OUTER JOIN tb_booking pb ON pc.id = pb.id_client
			GROUP BY pc.id  ORDER BY pc.name"); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$foto = $row["foto"];
		$phone = $row["phone"];
		$total_visit = $row["total_visit"];
		
		if ($foto != ""){
			$foto = prod_path."images/upload/clientes/".$foto ;
		}else{
			$foto = prod_path."pro/images/profile.jpg" ;
		}

		$response['data'][] = array(
			"id"=>$id,
			"name"=>$name,
			"foto"=>$foto,
			"phone"=>$phone,
			"total_visit"=>$total_visit,
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