<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s');
$send_at = date('d/m/Y  H:i:s'); 
$db = new db(); 
$_POST = json_decode(file_get_contents('php://input'), true);

$IdUser = $_POST['IdUser'];
$id_booking = $_POST['eventID'];
$qrCodeMessage = $_POST['qrCodeMessage'];

	 
	$db->query('UPDATE tb_book_detail SET qr_checkin = :qr_checkin  WHERE id_booking = :id_booking ');
	$db->bind(':qr_checkin', $qrCodeMessage); 
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