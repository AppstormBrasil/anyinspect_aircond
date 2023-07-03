<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$db = new db(); 

$db->query('SELECT * from tb_services WHERE id =:id'); 
$db->bind(':id', $id); 	
$db->execute();
$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$short_dec = $row["short_dec"];
		$est_time = $row["est_time"];
		$price = $row["price"];
		$description = $row["description"];
		$foto = $row["foto"];
		
		if ($foto != ""){
			$foto = 'images/upload/servicos/'.$foto;
		 }else{
			$foto = "images/noimage.png" ;
		 } 
		
		$arr['data'] = array(
			"id"=>$row['id'],
			"short_dec"=>$row['short_dec'],
			"est_time"=>$row['est_time'],
			"price"=>$row['price'],
			"geo_location"=>$row['geo_location'],
			"signature"=>$row['signature'],
			"signature_exec"=>$row['signature_exec'],
			"qr_check_in"=>$row['qr_check_in'],
			"flow_approve"=>$row['flow_approve'],
			"image_require"=>$row['image_require'],
			"image_single"=>$row['image_single'],
			"categoria"=>$row['categoria'],
			"description"=>$description,
			"foto"=>$foto
		);
	 } 
		
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($arr);
	 	exit(0);


} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>