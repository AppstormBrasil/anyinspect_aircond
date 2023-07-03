<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT tm.*
FROM tb_certificado tm "); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$descricao = $row["descricao"];
	
		$response['data'][] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"botao"=>'<a  href="editcertificado/'.$row['id'].'" class="single_link btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger" onclick="RemoveItem('.$row['id'].',\''.$descricao.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>