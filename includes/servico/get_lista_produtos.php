<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT tsp.id as id_serv_prod , tsp.id_product , tsp.id_service , tsp.qtd as qtd_fracionada ,  tp.* 
FROM tb_service_prod tsp
LEFT JOIN tb_product tp ON tp.id = tsp.id_product
WHERE tsp.id_service = :id  "); 
$db->bind(':id', $id);
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
			$foto = "assets/images/noimage.png" ;
		 } 
		
		if($row['desc'] != ''){
			$response['data'][] = array(
				"id_service"=>$row['id_service'],
				"id_serv_prod"=>$row['id_serv_prod'],
				"id_product"=>$row['id_product'],
				"desc"=>$row['desc'],
				"value"=>$row['value'],
				"type"=>$row['type'],
				"qtd_fracionada"=>$row['qtd_fracionada'],
				"qtd"=>$row['qtd'],
				"validade"=>$row['validade'],
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