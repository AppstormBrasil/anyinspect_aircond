<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT tt.* , tst.* 
FROM tb_service_tool tst
LEFT JOIN tb_tooling tt ON tst.id_tool = tt.id
WHERE tst.id_service = :id  "); 
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
		
		if($row['descricao'] != ''){
			$response['data'][] = array(
				"id_service"=>$row['id_service'],
				"id_serv_prod"=>$row['id'],
				"id_product"=>$row['id_tool'],
				"desc"=>$row['descricao'],
				"value"=>$row['patrimonio'],
				"type"=>$row['descricao'],
				"qtd_fracionada"=>$row['qtd'],
				"qtd"=>$row['qtd'],
				"validade"=>$row['descricao'],
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