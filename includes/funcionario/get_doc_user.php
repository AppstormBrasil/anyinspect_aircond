<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$id = $_POST["id"];
$db = new db(); 

$db->query("SELECT ttd.* , 
DATEDIFF(ttd.data_expira , NOW() ) as dias_expira , 
DATE_FORMAT( ttd.data_expira ,'%d/%m/%Y') as data_expira 
FROM tb_team_doc ttd
WHERE ttd.id = :id "); 
$db->bind(':id', $id);
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	$response['status'] = 'SUCCESS';
	$response['documento'] = $result;
	$response['status_txt'] = 'Nenhuma informacao disponivel'; 
	echo json_encode($result);
		exit(0);
} else { 
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	$response[] = array();
	echo json_encode($response);
} 

 ?>