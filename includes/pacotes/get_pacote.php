<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from tb_package'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$nome = $row["nome"];
		$valor = $row["valor"];
		$data_cadastro = $row["data_cadastro"];
		

		$response['data'][] = array(
			"id"=>$row['id'],
			"nome"=>$row['nome'],
			"valor"=>$row['valor'],
			"data_cadastro"=>$row['data_cadastro'],
			 "botao"=>'<a href="pacote-'.$id.'">
			 <button class="btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button>
			 </a>&nbsp;<button onclick="RemoveItem('.$row['id'].',\''.$row['nome'].'\')" class="btn btn-danger" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-17"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		 echo json_encode($response);
	 	 exit(0);
} else { 
		 $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>