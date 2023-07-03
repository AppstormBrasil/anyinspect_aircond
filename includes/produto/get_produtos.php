<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT tp.* , DATE_FORMAT(tp.validade ,'%d/%m/%Y') as validade  
from tb_product tp"); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$id_companie = $row["id_companie"];
		$desc = $row["desc"];
		$value = $row["value"];
		$type = $row["type"];
		$data_cadastro = $row["data_cadastro"];
		$foto = $row["foto"];
		$qtd = $row["qtd"];
		$validade = $row["validade"];
		$base = $row["base"];

		

		$foto = $row["foto"];
		if ($foto != ""){
			$foto = "images/upload/produtos/".$foto ;
		}else{
			$foto = "images/noimage.png" ;
		}

		

		$response['data'][] = array(
			"id"=>$row['id'],
			"id_companie"=>$row['id_companie'],
			"desc"=>$row['desc'],
			"qtd"=>$row['qtd'],
			"base"=>$row['base'],
			"value"=>$row['value'],
			"validade"=>$row['validade'],
			"foto"=>$foto,
			"type"=>$row['type'],
			"data_cadastro"=>$row['data_cadastro'],
			 "botao"=>'<a class="single_link" href="#produto-'.$id.'">
			 <a href="#produto-'.$row['id'].'" class="single_link btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></a>
			 </a>&nbsp;<button onclick="RemoveItem('.$row['id'].',\''.$row['desc'].'\',\''.$foto.'\')" class="btn btn-danger" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-17"></i></button>'
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