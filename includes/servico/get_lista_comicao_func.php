<?php 

include('../common/util.php'); 


if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} 
else {$id_funcionario = '';}


$db = new db(); 

$db->query("SELECT tbs.id, tbs.id_team, tbs.id_service, tbs.comission, ts.short_dec 
			FROM tb_team_service tbs
			LEFT JOIN tb_services ts on  ts.id = tbs.id_service
			WHERE tbs.id_team =:id_funcionario
");

$db->bind(':id_funcionario', $id_funcionario);

$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		
		$response[] = array(
			"id"=>$row['id'],
			"id_team"=>$row['id_team'],
			"id_service"=>$row['id_service'],
			"comission"=>$row['comission'],
			"short_dec"=>$row['short_dec']
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