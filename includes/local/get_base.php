<?php 
 
include('../common/util.php'); 

$db = new db(); 

$db->query('SELECT * FROM tb_base '); 
$db->execute();

$result = $db->resultset(); 

// id, descricao, sigla, numero, filial, data

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$descricao = $row["descricao"];
		$sigla = $row["sigla"];
		$numero = $row["numero"];
		$filial = $row["filial"];
				
		$response[] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"sigla"=>$sigla,
			"numero"=>$numero,
			"filial"=>$filial			
		);
	 } 
	 	//$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>