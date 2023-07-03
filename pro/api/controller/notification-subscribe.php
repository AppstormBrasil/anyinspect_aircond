<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s');
$send_at = date('d/m/Y  H:i:s'); 
$db = new db(); 
$_POST = json_decode(file_get_contents('php://input'), true);
$IdUser = $_POST['IdUser'];
$authToken = $_POST['authToken'];
$contentEncoding = $_POST['contentEncoding'];
$endpoint = $_POST['endpoint'];
$publicKey = $_POST['publicKey'];
	 
	 $db->query('UPDATE tb_team SET authToken = :authToken , contentEncoding = :contentEncoding , endpoint = :endpoint , publicKey = :publicKey WHERE id = :id ');
	 $db->bind(':authToken', $authToken); 
	 $db->bind(':contentEncoding', $contentEncoding); 
	 $db->bind(':endpoint', $endpoint);
	 $db->bind(':publicKey', $publicKey);
	 $db->bind(':id', $IdUser); 		 
	 if($db->execute()){ 
		$arr['status'] = 'SUCCESS'; 
		$arr['data_resposta'] = usa_to_br_date_time($created_at);
		echo json_encode($arr);
		exit(0);
	 } else { 
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Erro ao salvar'; 
		echo json_encode($arr);
	 } 
	exit(0);

 ?>