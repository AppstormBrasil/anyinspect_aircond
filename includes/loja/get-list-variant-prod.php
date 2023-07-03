<?php 
 
include('../common/util.php'); 

if(isset($_POST['id_prod'])){ $id_prod = $_POST['id_prod'];} else {$id_prod = '';}
$db = new db(); 

$db->query("SELECT * FROM tb_variante_prod WHERE id_prod_venda = :id_prod  "); 
$db->bind(':id_prod', $id_prod);
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		if($row['nome'] != ''){
			$response['data'][] = array(
				"id"=>$row['id'],
				"nome"=>$row['nome'],
				"tipo"=>$row['tipo'],
				"preco"=>$row['preco'],
				"qtd"=>$row['qtd'],				
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