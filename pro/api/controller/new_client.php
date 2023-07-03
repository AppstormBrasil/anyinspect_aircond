<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');
$_POST = json_decode(file_get_contents('php://input'), true);
$name = $_POST["nome_cliente"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$obs = $_POST["obs"];

$database = new db();

$database->query("INSERT INTO tb_client (name, phone, email,obs,data_cadastro) VALUES (:name, :phone, :email, :obs,:data_cadastro)");
$database->bind(':name', $name);
$database->bind(':phone', $phone);
$database->bind(':email', $email);
$database->bind(':obs', $obs);
$database->bind(':data_cadastro', $currentDate);

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