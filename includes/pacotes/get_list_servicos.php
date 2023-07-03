<?php 
 
include('../common/util.php'); 

if(isset($_POST['id_pacote'])){ $id_pacote = $_POST['id_pacote'];} else {$id_pacote = '';}
$db = new db(); 

$db->query("SELECT tps.id, tps.id_package, tps.id_service , ts.short_dec, ts.price
			FROM tb_package_service tps
			LEFT JOIN tb_services ts ON ts.id = tps.id_service
			WHERE id_package = :id_pacote  "); 
$db->bind(':id_pacote', $id_pacote);
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		if($row['short_dec'] != ''){
			$response['data'][] = array(
				"id"=>$row['id'],
				"id_package"=>$row['id_package'],
				"id_service"=>$row['id_service'],
				"short_dec"=>$row['short_dec'],
				"price"=>$row['price'],
				
			);
		}
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