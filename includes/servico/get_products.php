<?php 
 
include('../common/util.php'); 

$db = new db(); 

if(!isset($_POST['searchTerm'])){
	$db->query('SELECT * from tb_product order by `desc`');  
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT * from tb_product  where `desc` like "%'.$search.'%" order by `desc` ');  
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
			"name"=>$row['desc'],
			"value"=>$row['value'],
			"type"=>$row['type'],
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