<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT pb.start_date, pc.* FROM pet_booking pb
INNER JOIN pet_client pc ON pb.id_client = pc.id
WHERE start_date < DATE_SUB(NOW(), INTERVAL 30 DAY)'); 

$db->execute();

$result = $db->resultset(); 
if($result){
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$phone = $row["phone"];
		$zap = $row["phone2"];
		$email = $row["email"];
		$start_date = $row["start_date"];
		
		$start_date = explode(" ", $start_date);
		$data = $start_date[0];
		$data_final = $data;
		$data_final = explode("-", $data_final);
		$data_final = $data_final[2]."/".$data_final[1]."/".$data_final[0];

		$response['data'][] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"phone"=>$row['phone'],
			"zap"=>$row['phone2'],
			"email"=>$row['email'],
			"start_date"=>$data_final,
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