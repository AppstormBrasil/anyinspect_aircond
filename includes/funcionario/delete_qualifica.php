<?php
include('../common/util.php');

$database = new db();
$id = $_POST["id"];

$database->query('DELETE  FROM tb_team_qual WHERE id = :id ');
$database->bind(':id', $id);

if($database->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Ítem removido com sucesso !";
	echo json_encode($arr);
	exit(0);


 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro ao deletar este ítem se o problema persistir entrar em conato com o Administrador";
	echo json_encode($arr);
	exit(0);
 }
exit(0);


?>