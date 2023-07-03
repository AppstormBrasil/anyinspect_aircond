<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT DISTINCT(ttq.desc_qual) 
FROM tb_team_qual ttq "); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$desc_qual = $row["desc_qual"];
		$response[] = array(
			"desc_qual"=>$desc_qual,
		);
	 } 
	 	 //$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response[] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>