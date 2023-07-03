<?php 

include('../common/util.php'); 


if(isset($_POST['id_tool'])){ $id_tool = $_POST['id_tool'];} 
else {$id_tool = '';}


$db = new db(); 
$db->query("SELECT * FROM tb_tool_doc tdocs WHERE tdocs.id_tooling =:id_tooling ");

$db->bind(':id_tooling', $id_tool);

$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		
		$response[] = array(
			"id"=>$row['id'],
			"description"=>$row['description'],
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