<?php 

include('../common/util.php'); 


if(isset($_POST['id_cliente'])){ $id_cliente = $_POST['id_cliente'];} else {$id_cliente = '';}


$db = new db(); 
$db->query("SELECT tpc.id, tpc.id_package, tpc.id_service , tpc.status ,ts.short_dec , tp.nome , tpc.total_ , DATE_FORMAT(tpc.data_compra ,'%d/%m/%Y') as data_compra , 
DATE_FORMAT(DATE_ADD(tpc.data_compra, INTERVAL tpc.validade DAY) ,'%d/%m/%Y')  as data_vencimento , tp.valor
FROM tb_package_client tpc
LEFT JOIN tb_services ts ON ts.id = tpc.id_service
LEFT JOIN tb_package tp ON tp.id = tpc.id_package
WHERE tpc.id_cliente = :id_cliente  "); 			

$db->bind(':id_cliente', $id_cliente);

$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		
		$response[] = array(
			"id"=>$row['id'],
			"id_package"=>$row['id_package'],
			"id_service"=>$row['id_service'],
			"status"=>$row['status'],
			"short_dec"=>$row['short_dec'],
			"total_"=>$row['total_'],
			"valor"=>$row['valor'],
			"data_compra"=>$row['data_compra'],
			"data_vencimento"=>$row['data_vencimento'],
			"nome"=>$row['nome']
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