<?php

include('../common/util.php'); 

$database = new db();
$created_at = date('Y-m-d  H:i:s'); 
$id_func = $_POST["id_funcionario"];
$descricao = $_POST["descricao_habilitacao"];
$valor = $_POST["conteudo_habilitacao"];
$data_expira = $_POST["data_expira_habilitacao"];

if($data_expira == ""){

}else{
	$data_expira = br_to_usa($data_expira);
}

$database->query(" SELECT descricao FROM tb_team_doc ttd
					WHERE  ttd.descricao = :descricao AND ttd.valor = :valor AND ttd.id_func = :id_func");	
$database->bind(':descricao', $descricao);
$database->bind(':valor', $valor);
$database->bind(':id_func', $id_func);
$database->execute();
$result = $database->resultset(); 

if($result){

     $arr['status'] = 'ERROR'; 
         $arr['status_txt'] = 'Habilitação ja cadastrada!!'; 
         echo json_encode($arr);
         exit(0);
    }else{		


$database->query("INSERT INTO tb_team_doc(id_func, descricao, valor, data_expira, data_cadastro)VALUES (:id_func, :descricao, :valor, :data_expira, :data_cadastro)"); 

	$database->bind(':id_func', $id_func);
	$database->bind(':descricao', $descricao);
	$database->bind(':valor', $valor);
	$database->bind(':data_expira', $data_expira);
	$database->bind(':data_cadastro', $data_expira);
	
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