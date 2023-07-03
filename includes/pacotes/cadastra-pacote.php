<?php

include('../common/util.php'); 

$data_cadastro = date('Y-m-d H:i:s');
$nome = $_POST["nome"];
$valor = $_POST["valor"];
$quantidade_usos = $_POST["quantidade_usos"];
$validade = $_POST["validade"];

$database = new db();


$database->query("INSERT INTO tb_package (nome, valor, quantidade_usos , data_cadastro,validade) 
					VALUES (:nome, :valor, :quantidade_usos ,  :data_cadastro,:validade)");
$database->bind(':nome', $nome);
$database->bind(':valor', $valor);
$database->bind(':valor', $valor);
$database->bind(':quantidade_usos', $quantidade_usos);
$database->bind(':data_cadastro', $data_cadastro);
$database->bind(':validade', $validade);

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
?>