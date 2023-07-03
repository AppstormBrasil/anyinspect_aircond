<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');
$_POST = json_decode(file_get_contents('php://input'), true);

$short_dec = $_POST["short_dec"];
$est_time = $_POST["est_time"];

$est_time = str_replace(' ', '', $est_time);
$est_time = $est_time.':00';

$price = $_POST["price"];
$produtos = $_POST["produtos"];

$database = new db();

$database->query("INSERT INTO tb_services (short_dec, est_time, price) VALUES (:short_dec, :est_time, :price)");
$database->bind(':short_dec', $short_dec);
$database->bind(':est_time', $est_time);
$database->bind(':price', $price);
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