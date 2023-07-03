<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from pet_services'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$short_dec = $row["short_dec"];
		$est_time = $row["est_time"];
		$price = $row["price"];
		

		$response['data'][] = array(
			"id"=>$row['id'],
			"short_dec"=>$row['short_dec'],
			"est_time"=>$est_time,
			"price"=>$row['price'],
			"botao"=>'<button  onclick="go_to_page('.$row['id'].')" class="btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button><button class="btn btn-danger" onclick="RemoveItem('.$row['id'].',\''.$row['short_dec'].'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>