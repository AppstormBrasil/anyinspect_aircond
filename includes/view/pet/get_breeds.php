<?php 
 
include('../../common/util.php'); 

$db = new db(); 

$db->query('SELECT id, description from pet_breeds order by description'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 
		$response[] = array(
			"id"=>$row['id'],
			"breed"=>$row['description']
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