<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$nome_cliente = $_POST["nome_novo_cliente"];
$phone_novo_cliente = $_POST["phone_novo_cliente"];

$database = new db();

$database->query("INSERT INTO tb_client (name, phone,data_cadastro) VALUES (:name, :phone, :data_cadastro)");
$database->bind(':name', $nome_cliente);
$database->bind(':phone', $phone_novo_cliente);
$database->bind(':data_cadastro', $current_date);

if($database->execute()){
    $last_id = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
	$arr['id_cliente'] = $last_id;
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