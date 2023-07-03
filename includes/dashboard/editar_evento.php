<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');

$id_event = $_POST["id_event"];
$campo = $_POST["campo"];
$valor_campo = $_POST["valor_campo"];
$database = $_POST["database"];

if($database == 'tb_book_detail'){
	$the_id = 'id_booking';
} else {
	$the_id = 'id';
}


$db = new db();

$db->query("UPDATE ".$database." SET ".$campo." = :campo  WHERE ".$the_id." = :id ");

$db->bind(':campo', $valor_campo);

if($database == 'tb_book_detail'){
	$db->bind(':id', $id_event);
} else {
	$db->bind(':id', $id_event);
}



if($db->execute()){
	
	$arr['status'] = 'SUCCESS';
	$arr['status_txt'] = 'Atualizado com sucesso!' ;
	echo json_encode($arr);
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro ao atualizar!' ;
	echo json_encode($arr);
}




//$db->endTransaction();

exit(0);


?>