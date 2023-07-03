<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s');
$send_at = date('d/m/Y  H:i:s'); 
$db = new db(); 
$_POST = json_decode(file_get_contents('php://input'), true);

$IdUser = $_POST['IdUser'];
$id_booking = $_POST['eventID'];
$start_lat = $_POST['gps_lat'];
$start_lon = $_POST['gps_lon'];

	 
	$db->query('UPDATE tb_book_detail SET start_lat = :start_lat , start_lon = :start_lon , data_start_lat = :data_start_lat WHERE id_booking = :id_booking ');
	$db->bind(':start_lat', $start_lat); 
	$db->bind(':start_lon', $start_lon); 
	$db->bind(':data_start_lat', $created_at);
	$db->bind(':id_booking', $id_booking);
	 
	if($db->execute()){ 
		$arr['status'] = 'SUCCESS'; 
		$arr['status_txt'] = 'Registrado com Sucesso'; 
		echo json_encode($arr);
		exit(0);
	} else { 
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Erro ao salvar'; 
		echo json_encode($arr);
} 
exit(0);

 ?>