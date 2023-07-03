<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$id_cliente = $_POST["id_cliente"];
$descricao = $_POST["descricao"];
$category = $_POST["category"];
$database = new db();

$database->query("INSERT INTO tb_clients_ativo (id_client, descricao, category, data_create) VALUES (:id_client, :descricao, :category, :data_create)");

$database->bind(':id_client', $id_cliente);
$database->bind(':descricao', $descricao);
$database->bind(':category', $category);
$database->bind(':data_create', $current_date);

if($database->execute()){
    
    $last_id = $database->lastInsertId(); 
    $qrcode_number = str_pad($last_id, 4, 0, STR_PAD_LEFT);

    $qrcode = 'TAG-'.$qrcode_number;

    $database->query('UPDATE tb_clients_ativo SET qrcode = :qrcode WHERE id = :id ');
    $database->bind(':qrcode', $qrcode); 
    $database->bind(':id', $last_id); 
    $database->execute();


    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    $arr['last_id'] = $last_id;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>