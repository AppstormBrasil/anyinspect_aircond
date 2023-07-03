<?php 
 
include('../../common/util.php'); 

$db = new db(); 

$db->query('SELECT * from tb_services order by short_dec'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 
		$response[] = array(
			"id"=>$row['id'],
			"short_dec"=>$row['short_dec'],
			"est_time"=>$row['est_time'],
			"price"=>$row['price']
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