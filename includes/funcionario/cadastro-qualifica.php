<?php

include('../common/util.php'); 

$database = new db();
$created_at = date('Y-m-d  H:i:s'); 
$id_funcionario = $_POST["id_funcionario"];
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


$database->query(" SELECT desc_qual FROM tb_team_qual ttq
					WHERE  ttq.desc_qual = :desc_qual AND ttq.tipo_qual = :tipo_qual AND ttq.id_func = :id_func");	
$database->bind(':desc_qual', $desc_qual);
$database->bind(':tipo_qual', $tipo_qual);
$database->bind(':id_func', $id_funcionario);
$database->execute();
$result = $database->resultset(); 

if($result){

     $arr['status'] = 'ERROR'; 
         $arr['status_txt'] = 'Qualificação ja cadastrada!!'; 
         echo json_encode($arr);
         exit(0);
    }else{		


$database->query("INSERT INTO tb_team_qual(id_func, desc_qual, tipo_qual, validade_qual,numero_qual, data_cadastro , horaria_qual , local_qual , dataini_qual , datafim_qual)VALUES (:id_func, :desc_qual, :tipo_qual, :validade_qual,:numero_qual, :data_cadastro , :horaria_qual , :local_qual , :dataini_qual , :datafim_qual)"); 

	$database->bind(':id_func', $id_funcionario);
	$database->bind(':desc_qual', $desc_qual);
	$database->bind(':tipo_qual', $tipo_qual);
	$database->bind(':validade_qual', $validade_qual);
	$database->bind(':numero_qual', $numero_qual);
    $database->bind(':data_cadastro', $created_at);
	$database->bind(':horaria_qual', $horaria_qual);
	$database->bind(':local_qual', $local_qual);
	$database->bind(':dataini_qual', $dataini_qual);
	$database->bind(':datafim_qual', $datafim_qual);

	
if($database->execute()){
    $last_id = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
    $arr['last_id'] = $last_id;
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
    }
    $database->endTransaction();

}

?>