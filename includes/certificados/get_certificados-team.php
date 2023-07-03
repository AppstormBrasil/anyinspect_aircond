<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT tm.*, tt.id as id_colaborador, tt.name as name_colaborador
FROM tb_certificado_team tm 
INNER JOIN tb_team tt on tm.id_colaborador = tt.id"); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$descricao = $row["descricao"];
		$id_colaborador = $row['id_colaborador'];
		$name_colaborador = $row['name_colaborador'];
	
		$response['data'][] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"id_colaborador" => $id_colaborador,
			"name_colaborador" => $name_colaborador,
			"botao"=>'<a  href="editcertificadoteam/'.$row['id'].'" class="single_link btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger" onclick="RemoveItemTeam('.$row['id'].',\''.$descricao.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
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