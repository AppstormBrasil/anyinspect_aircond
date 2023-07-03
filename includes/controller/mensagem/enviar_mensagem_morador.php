<?php 
 
include('../../common/util.php'); 
$data_cadastro = date('Y-m-d  H:i:s'); 
$db = new db(); 
$IdCondominio = get_id_empresa();
$IdUsuario = get_current_id();

if(isset($_POST['id_morador'])){ 
	$id_morador = $_POST['id_morador'];
}

else {
$arr['status'] = 'ERROR'; 
$arr['status_txt'] = 'Erro ao salvar'; 
echo json_encode($arr);
}

 if(isset($_POST['mensagem'])){ $mensagem = $_POST['mensagem'];} else {$mensagem = '';} 
 if(isset($_POST['id_morador'])){ $id_morador = $_POST['id_morador'];} else {$id_morador = '';} 
 $status = 0;

	 $db->query('INSERT INTO tb_mensagem (IdMorador,IdUsuario,mensagem,data_envio,status) VALUES (:IdMorador,:IdUsuario, :mensagem, :data_envio, :status)'); 
	 $db->bind(':IdMorador', $id_morador); 
	 $db->bind(':IdUsuario', $IdUsuario); 
	 $db->bind(':mensagem', $mensagem); 
	 $db->bind(':data_envio', $data_cadastro); 
	 $db->bind(':status', $status); 
if($db->execute()){ 
 	 	 $last_id = $db->lastInsertId(); 
	 	 $arr['status'] = 'SUCCESS';
		  $arr['last_id'] = $last_id;
		  $arr['data_envio'] = usa_to_br_date_time($data_cadastro);
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao salvar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>