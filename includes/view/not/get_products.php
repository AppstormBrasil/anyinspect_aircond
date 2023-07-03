<?php 
 
include('../../common/util.php'); 

$db = new db(); 

$db->query('SELECT * from tb_product order by `desc`'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 
		$response[] = array(
			"id"=>$row['id'],
			"desc"=>$row['desc'],
			"value"=>$row['value'],
			"type"=>$row['type']
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