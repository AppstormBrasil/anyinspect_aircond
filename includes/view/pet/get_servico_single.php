<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$db = new db(); 

$db->query('SELECT * from pet_services WHERE id =:id'); 
$db->bind(':id', $id); 	
$db->execute();
$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$short_dec = $row["short_dec"];
		$est_time = $row["est_time"];
		$price = $row["price"];
		
		$arr['data'] = array(
			"id"=>$row['id'],
			"short_dec"=>$row['short_dec'],
			"est_time"=>$row['est_time'],
			"price"=>$row['price']
		);
	 } 
		
	 
	 //FUNCTION GET PRODUTOS RELACIONADOS

		$db->query('SELECT * 
					FROM tb_service_prod tsp
					WHERE id_service = :id'); 
	 	$db->bind(':id', $id); 	
		$db->execute();
		$result = $db->resultset(); 
		if($result){
			$i = 0; 
			foreach($result as $row) {
				/*$id = $row["id"];
				$short_dec = $row["short_dec"];
				$est_time = $row["est_time"];
				$price = $row["price"];*/
				
				$arr['data2'][] = array(
					/*"id"=>$row['id'],
					"short_dec"=>$row['short_dec'],
					"est_time"=>$row['est_time'],
					"price"=>$row['price'] */
				);
			} 
		}
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($arr);
	 	exit(0);


	function get_prod_detail($id){
		$db = new db(); 
		$db->query('SELECT * 
					FROM tb_service_prod tsp
					WHERE id_service = :id'); 
	 	$db->bind(':id', $id); 	
		$db->execute();
		$result = $db->single(); 
	}


} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>