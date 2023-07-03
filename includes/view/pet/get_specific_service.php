<?php 
 
include('../../common/util.php'); 

$db = new db(); 

$tipo_servico = $_POST["tipo_servico"];

$db->query('SELECT * from tb_services where id = '.$tipo_servico.' order by short_dec'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		$response = array(
			"id"=>$row['id'],
			"est_time"=>$row['est_time'],
			"price"=>$row['price'],
			"produtos"=>''
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