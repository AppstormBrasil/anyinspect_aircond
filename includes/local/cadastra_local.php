<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$descricao = $_POST["descricao"];
$id_client = $_POST["id_client"];

$database = new db();
$database->query("INSERT INTO tb_local (id_client,descricao,data_cadastro) VALUES (:id_client,:descricao,:data_cadastro)");

$database->bind(':id_client', $id_client);
$database->bind(':descricao', $descricao);
$database->bind(':data_cadastro', $current_date);

if($database->execute()){
    $last_id = $database->lastInsertId(); 

    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    $arr['last_id'] = $last_id ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>