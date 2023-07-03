<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');

$id_event = $_POST["id_event"];

$price_taxi = $_POST["price_taxi"];
$has_taxi = $_POST["has_taxi"];
$obs_adr = $_POST["obs_adr"];

if($has_taxi == 1){
	if($obs_adr != ''){
		$obs_adr = $obs_adr;
	} else {
		$obs_adr = '';
	}
	$pet_taxi = 1;
} else {
	$obs_adr = '';
	$price_taxi = 0;
	$pet_taxi = 0;
}


$db = new db();

$db->query("UPDATE tb_book_detail SET pet_taxi = :pet_taxi , endereco = :endereco , price_taxi = :price_taxi  WHERE id_booking = :id_booking ");
$db->bind(':pet_taxi', $pet_taxi);
$db->bind(':endereco', $obs_adr);
$db->bind(':price_taxi', $price_taxi);
$db->bind(':id_booking', $id_event);

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