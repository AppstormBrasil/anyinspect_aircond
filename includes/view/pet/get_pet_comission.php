<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$date = date("Y-m");

$db = new db(); 

$db->query("SELECT SUM(pc.comission) as comission, pt.name from pet_comission pc 
LEFT JOIN pet_team pt ON pc.id_func = pt.id
LEFT JOIN pet_book_detail pbd ON pc.id_booking = pbd.id_booking
WHERE pbd.ended_at like '%$date%'
 GROUP BY pc.id_func"); 
 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$funcionario = $row["name"];
		$comission = $row["comission"];

		$response['data'][] = array(
			"funcionario"=>$funcionario,
			"comission"=>$comission
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