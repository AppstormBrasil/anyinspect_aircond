<?php
include('../common/util.php'); 

$data_cadastro = date('Y-m-d H:i:s');

$produto = $_POST["produto"];
$tipo = $_POST["tipo"];
$valor = $_POST["valor"];
$qtd = $_POST["qtd"];

$database = new db();

$database->query("INSERT INTO tb_product (`desc`, value, type, qtd, data_cadastro) VALUES (:descr, :value, :type, :qtd, :data_cadastro)");
$database->bind(':descr', $produto);
$database->bind(':value', $valor);
$database->bind(':type', $tipo);
$database->bind(':qtd', $qtd);
$database->bind(':data_cadastro', $data_cadastro);

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