<?php
include('../../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$produto = $_POST["produto"];
$tipo = $_POST["tipo"];
$valor = $_POST["valor"];

$database = new db();

$database->query("INSERT INTO pet_product VALUES ('', '', :desc, :value, :type, :current_date, '')");
$database->bind(':desc', $produto);
$database->bind(':value', $valor);
$database->bind(':type', $tipo);
$database->bind(':current_date', $current_date);

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