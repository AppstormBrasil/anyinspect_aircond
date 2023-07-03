<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');
$_POST = json_decode(file_get_contents('php://input'), true);

$eventID = $_POST["eventID"];
$database = new db();

$database->query("DELETE FROM tb_services WHERE id = :id");
$database->bind(':id', $eventID);
if($database->execute()){
	$arr['status'] = 'SUCCESS';
	$arr['status_txt'] = 'Remoção realizada com sucesso!' ;
	echo json_encode($arr);
	exit(0);

} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao remover , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>