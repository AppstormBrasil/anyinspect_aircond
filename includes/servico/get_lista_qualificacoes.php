<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT tsq.* 
FROM tb_service_qual tsq
WHERE tsq.id_service = :id  "); 
$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		$foto = "assets/images/noimage.png" ;

		if($row['desc_qual'] != ''){
			$response['data'][] = array(
				"id"=>$row['id'],
				"id_service"=>$row['id_service'],
				"desc_qual"=>$row['desc_qual'],
				"foto"=>$foto,
				
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