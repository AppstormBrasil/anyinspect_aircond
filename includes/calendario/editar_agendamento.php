<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$endTime_dummy = explode(' ', $startTime);
$endTime_dummy = $endTime_dummy[0].' '.$endTime;

$eventID = $_POST["eventIDedit"];
$start_inicial = $_POST["start_inicial"];
$end_inicial = $_POST["end_inicial"];

if($start_inicial != ''){
    $start_inicial = br_to_usa_date_time2($start_inicial);
} else {
    $start_inicial = '0000-00-00 00:00:00';
}

$startTime = br_to_usa_date_time2($startTime);
$endTime = br_to_usa_date_time2($endTime_dummy);


$db = new db();

$db->query('UPDATE tb_booking SET start_date = :startTime, end_date = :endTime  WHERE id = :id ');
$db->bind(':startTime', $startTime);
$db->bind(':endTime', $endTime);
$db->bind(':id', $eventID);

if($db->execute()){
	
	$db->query("INSERT INTO tb_log_reag (id_book, from_date, to_date, register_date, id_funcionario) VALUES (:id_book, :from_date, :to_date, :register_date, :id_funcionario)");
		$db->bind(':id_book', $eventID);
		$db->bind(':from_date', $start_inicial);
		$db->bind(':to_date', $startTime);
		$db->bind(':register_date', $currentDate);
		$db->bind(':id_funcionario', $IdUsuario);
		$db->execute();
	$db->execute();
}


$arr['status'] = 'SUCCESS';
$arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
echo json_encode($arr);

//$db->endTransaction();

exit(0);


?>