<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$id_cliente = $_POST["id_cliente"];
$nome = $_POST["nome"];




$database = new db();

$database->query("INSERT INTO tb_clients_pet (id_client, name, data_cadastro) VALUES (:id_client, :nome, :current_date)");

$database->bind(':id_client', $id_cliente);
$database->bind(':nome', $nome);
$database->bind(':current_date', $current_date);

if($database->execute()){
    $last_id = $database->lastInsertId(); 

    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>