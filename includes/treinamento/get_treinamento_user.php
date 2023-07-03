<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$id = $_POST["id"];
$db = new db(); 

$db->query("SELECT ttq.* , 
DATEDIFF(ttq.validade_qual , NOW() ) as dias_expira , 
DATE_FORMAT( ttq.validade_qual ,'%d/%m/%Y') as validade_qual ,
DATE_FORMAT( ttq.datafim_qual ,'%d/%m/%Y') as datafim_qual ,
DATE_FORMAT( ttq.dataini_qual ,'%d/%m/%Y') as dataini_qual 


FROM tb_team_qual ttq
WHERE id = :id "); 
$db->bind(':id', $id);
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	$response['status'] = 'SUCCESS';
	$response['qualifica'] = $result;
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