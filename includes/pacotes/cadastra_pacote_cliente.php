<?php 
 
include('../common/util.php'); 
$data_cadastro = date('Y-m-d  H:i:s'); 
if(isset($_POST['id_pacote'])){ $id_pacote = $_POST['id_pacote'];} else {$id_pacote = '';}
if(isset($_POST['id_cliente'])){ $id_cliente = $_POST['id_cliente'];} else {$id_cliente = '';}

$db = new db(); 

$db->query("SELECT tps.id, tps.id_package, tps.id_service , ts.short_dec, ts.price , tp.quantidade_usos , tp.validade
			FROM tb_package_service tps
			LEFT JOIN tb_services ts ON ts.id = tps.id_service
			LEFT JOIN tb_package tp ON tp.id = tps.id_package
			WHERE tps.id_package = :id_pacote  "); 
$db->bind(':id_pacote', $id_pacote);
$db->execute();

$result = $db->resultset(); 


if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$db->query("INSERT INTO tb_package_client (id_package, id_cliente, id_service, status,total_,data_compra,validade) 
					VALUES (:id_package, :id_cliente, :id_service, :status , :total_, :data_compra,:validade)");
		
		$db->bind(':id_package', $row['id_package']);
		$db->bind(':id_cliente', $id_cliente);
		$db->bind(':id_service', $row['id_service']);
		$db->bind(':status', "Disponivel");
		$db->bind(':total_', $row['quantidade_usos']);
		$db->bind(':data_compra', $data_cadastro);
		$db->bind(':validade', $row['validade']);

		$db->execute();		
	 }  
		$response['status'] = 'SUCCESS';
		$arr['status_txt'] = 'Pacote cadastrado com Sucesso!'; 
		echo json_encode($response);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>