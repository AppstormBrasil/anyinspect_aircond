<?php
include('../common/util.php'); 

$date_register = date('Y-m-d H:i:s');
$_POST = json_decode(file_get_contents('php://input'), true);
$problem_description = $_POST["problem_description"];
$id_ativo = $_POST["id_ativo"];
$IdUser = $_POST["IdUser"];

$database = new db();


$database->query("INSERT INTO tb_issue (description, id_ativo, IdUser,date_register) VALUES (:description, :id_ativo, :IdUser, :date_register)");
$database->bind(':description', $problem_description);
$database->bind(':id_ativo', $id_ativo);
$database->bind(':IdUser', $IdUser);
$database->bind(':date_register', $date_register);

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