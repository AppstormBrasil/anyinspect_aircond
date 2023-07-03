<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from tb_services'); 
$db->execute();

$result = $db->resultset(); 


if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$short_dec = $row["short_dec"];
		$est_time = $row["est_time"];
		$price = $row["price"];
		$foto = $row["foto"];

		if ($foto != ""){
			$foto = 'images/upload/servicos/'.$foto;
		 }else{
			$foto = "images/noimage.png" ;
		 } 
		

		$response['data'][] = array(
			"id"=>$row['id'],
			"short_dec"=>$short_dec,
			"est_time"=>$est_time,
			"foto"=>$foto,
			"price"=>$row['price'],
			"botao"=>'<a  href="servico-'.$row['id'].'" class="single_link btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger" onclick="RemoveItem('.$row['id'].',\''.$short_dec.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
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