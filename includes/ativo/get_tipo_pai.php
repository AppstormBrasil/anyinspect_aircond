<?php 
 
include('../common/util.php'); 

$db = new db(); 

$db->query('SELECT id, descricao , qrcode , category from tb_clients_ativo WHERE type_pai = 1 order by descricao'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 
		$response[] = array(
			"id"=>$row['id'],
			"descricao"=>$row['descricao'],
			"qrcode"=>$row['qrcode'],
			"category"=>$row['category'],
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