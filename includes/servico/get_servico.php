<?php 
 
include('../common/util.php'); 

$db = new db(); 

if(!isset($_POST['searchTerm'])){
	$db->query('SELECT * from tb_services order by `short_dec`');  
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT * from tb_services  where `short_dec` like "%'.$search.'%" order by `short_dec` ');  
}

//$db->query('SELECT * from tb_product order by `desc`'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$foto = $row['foto'];
			
		if ($foto != ""){
			$foto = 'images/upload/produtos/'.$foto;
		}else{
			$foto = "images/noimage.png" ;
		} 
		 
		$response[] = array(
			"id"=>$row['id'],
			"short_dec"=>$row['short_dec'],
			"price"=>$row['price'],
			"est_time"=>$row['est_time'],
			"foto"=>$foto
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