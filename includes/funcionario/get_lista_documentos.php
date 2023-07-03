<?php 

include('../common/util.php'); 


if(isset($_POST['id_team'])){ $id_team = $_POST['id_team'];} 
else {$id_team = '';}


$db = new db(); 

$db->query("SELECT * FROM tb_docs tdocs WHERE tdocs.id_team =:id_team ");

$db->bind(':id_team', $id_team);

$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		
		$response[] = array(
			"id"=>$row['id'],
			"description"=>$row['description'],
			"category"=>$row['category'],
			"link"=>$row['link'],
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