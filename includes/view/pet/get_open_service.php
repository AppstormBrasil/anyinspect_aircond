<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

$db = new db(); 

$db->query('SELECT pb.id as id_service, pcp.id as id_pet , pcp.foto as foto_pet , pb.start_date , pb.status , pc.name as client_name , pc.phone , pc.id as client_id , pc.foto as client_pic  , pc.foto , pbd.price , ps.short_dec , pcp.name as pet_name
FROM pet_booking pb 
LEFT JOIN pet_book_detail pbd ON pbd.id_booking = pb.id
LEFT JOIN pet_services ps ON ps.id = pbd.service_name
LEFT JOIN pet_client pc ON pb.id_client = pc.id
LEFT JOIN pet_clients_pet pcp ON pbd.id_pet = pcp.id
WHERE DATE(pb.start_date) = CURDATE()  '); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$start_date = usa_to_br_date_time($row['start_date']);
		$status = $row["status"];
		$id_service = $row["id_service"];
		$client_name = $row["client_name"];
		$client_id = $row["client_id"];
		$client_pic = $row["client_pic"];
		$price = $row["price"];
		$short_dec = $row["short_dec"];
		$id_pet = $row["id_pet"];
		$pet_name = $row["pet_name"];
		$foto_pet = $row["foto_pet"];
		$foto = $row["foto"];

		if ($foto != ""){
			$foto = "images/pet/upload/clientes/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}
		
		if ($foto_pet != ""){
			$foto_pet = "images/upload/pets/".$foto_pet ;
		}else{
			$foto_pet = "images/nouser.png" ;
		}

		$response['data'][] = array(
			"start_date"=>$start_date,
			"status"=>$status,
			"id_service"=>$id_service,
			"client_name"=>$client_name,
			"client_id"=>$client_id,
			"client_pic"=>$client_pic,
			"price"=>$price,
			"short_dec"=>$short_dec,
			"pet_name"=>$pet_name,
			"foto"=>$foto,
			"id_pet"=>$id_pet,
			"foto_pet"=>$foto_pet
			
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>