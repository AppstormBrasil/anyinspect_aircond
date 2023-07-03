<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$database = new db();
$created_at = date('Y-m-d  H:i:s'); 
$id = $_POST["id"];
$desc_qual = $_POST["desc_qual"];
$tipo_qual = $_POST["tipo_qual"];
$validade_qual = $_POST["validade_qual"];
$numero_qual = $_POST["numero_qual"];
$horaria_qual = $_POST["horaria_qual"];
$local_qual = $_POST["local_qual"];
$dataini_qual = $_POST["dataini_qual"];
$datafim_qual = $_POST["datafim_qual"];


if($validade_qual == ""){

}else{
	$validade_qual = br_to_usa($validade_qual);
}

if($dataini_qual == ""){

}else{
	$dataini_qual = br_to_usa($dataini_qual);
}

if($datafim_qual == ""){

}else{
	$datafim_qual = br_to_usa($datafim_qual);
}

 
 $database->query('UPDATE tb_team_qual SET desc_qual = :desc_qual , tipo_qual = :tipo_qual, validade_qual = :validade_qual, numero_qual = :numero_qual, data_cadastro = :data_cadastro, horaria_qual = :horaria_qual, local_qual = :local_qual, dataini_qual = :dataini_qual, datafim_qual = :datafim_qual  WHERE id = :id ');

 $database->bind(':desc_qual', $desc_qual);
 $database->bind(':tipo_qual', $tipo_qual);
 $database->bind(':validade_qual', $validade_qual);
 $database->bind(':numero_qual', $numero_qual);
 $database->bind(':data_cadastro', $created_at);
 $database->bind(':horaria_qual', $horaria_qual);
 $database->bind(':local_qual', $local_qual);
 $database->bind(':dataini_qual', $dataini_qual);
 $database->bind(':datafim_qual', $datafim_qual);
 $database->bind(':id', $id);

 if($database->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>