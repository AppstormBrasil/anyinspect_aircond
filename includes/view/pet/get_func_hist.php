<?php 
 
include('../../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT pt.comission , pbd.id_quem_executou , ps.id as id_servico, ps.short_dec ,  pb.status , pb.id_client , pc.name as nome_cliente  , pc.foto as foto_cliente , pcp.id as id_pet , 
pcp.name as nome_pet , pcp.foto as foto_pet ,  pbd.started_at , pbd.ended_at , pbd.service_name , 
pbd.price , round(((pbd.price * pt.comission) /100 ) ,2) as total_comission ,   pbd.info_extra , pbd.pet_taxi
FROM pet_booking pb
LEFT JOIN pet_book_detail pbd ON pbd.id_booking = pb.id 
LEFT JOIN pet_client pc ON pb.id_client = pc.id 
LEFT JOIN pet_clients_pet pcp ON pcp.id_client = pc.id 
LEFT JOIN pet_services ps ON ps.id = pbd.service_name 
LEFT JOIN pet_team pt ON pt.id = pbd.id_quem_executou
WHERE pt.id = :id  "); 
$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		 $foto_pet = $row['foto_pet'];
		 if ($foto_pet != ""){
			$foto_pet = 'images/pet/upload/pets/'.$foto_pet;
		 }else{
			$foto_pet = "assets/images/nouser.png" ;
		 } 
		
		$response[] = array(
			"id_servico"=>$row['id_servico'],
			"short_dec"=>$row['short_dec'],
			"status"=>$row['status'],
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"foto_cliente"=>$row['foto_cliente'],
			"id_pet"=>$row['id_pet'],
			"nome_pet"=>$row['nome_pet'],
			"foto_pet"=>$foto_pet,
			"started_at"=>$row['started_at'],
			"ended_at"=>$row['ended_at'],
			"service_name"=>$row['service_name'],
			"price"=>$row['price'],
			"total_comission"=>$row['total_comission'],
			"info_extra"=>utf8_encode($row['info_extra']),
			"pet_taxi"=>$row['pet_taxi']
		);
	 } 
		  
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>