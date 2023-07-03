<?php 
 
include('../common/util.php'); 

$db = new db(); 

$db->query('SELECT * from tb_category '); 
$db->execute();

$result = $db->resultset(); 


if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$description = $row["description"];
		$foto = 'assets/images/noimage.png';
		
		$response['data'][] = array(
			"id"=>$id,
			"description"=>$description,
			"botao"=>'<a href="produto-'.$id.'">
			</a>&nbsp;<button onclick="RemoveItem('.$row['id'].',\''.$row['description'].'\',\''.$foto.'\')" class="btn btn-danger" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-17"></i></button>'
		);
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