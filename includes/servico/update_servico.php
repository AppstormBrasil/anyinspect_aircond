<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }
 

 if(isset($_POST['tipo_servico'])){ $tipo_servico = $_POST['tipo_servico'];} else {$tipo_servico = '';}
 if(isset($_POST['tempo_estimado'])){ $tempo_estimado = $_POST['tempo_estimado'];} else {$tempo_estimado = '';} 
 if(isset($_POST['preco_sugerido'])){ $preco_sugerido = $_POST['preco_sugerido'];} else {$preco_sugerido = '';} 
 if(isset($_POST['geo_location'])){ $geo_location = $_POST['geo_location'];} else {$geo_location = '';} 
 if(isset($_POST['signature'])){ $signature = $_POST['signature'];} else {$signature = '';} 
 if(isset($_POST['signature_exec'])){ $signature_exec = $_POST['signature_exec'];} else {$signature_exec = '';} 
 if(isset($_POST['flow_approve'])){ $flow_approve = $_POST['flow_approve'];} else {$flow_approve = '';} 
 if(isset($_POST['image_require'])){ $image_require = $_POST['image_require'];} else {$image_require = '';} 
 if(isset($_POST['image_single'])){ $image_single = $_POST['image_single'];} else {$image_single = '';} 
 if(isset($_POST['categoria'])){ $categoria = $_POST['categoria'];} else {$categoria = '';} 
 if(isset($_POST['qr_check_in'])){ $qr_check_in = $_POST['qr_check_in'];} else {$qr_check_in = '';} 

 
 $db->query('UPDATE tb_services SET short_dec = :short_dec , est_time = :est_time , price = :price , signature = :signature , geo_location = :geo_location , signature_exec = :signature_exec , flow_approve = :flow_approve , image_require = :image_require , categoria = :categoria , qr_check_in = :qr_check_in , image_single =:image_single  WHERE id = :id ');
 $db->bind(':short_dec', $tipo_servico); 
 $db->bind(':est_time', $tempo_estimado); 
 $db->bind(':price', $preco_sugerido); 
 $db->bind(':signature', $signature); 
 $db->bind(':geo_location', $geo_location); 
 $db->bind(':signature_exec', $signature_exec); 
 $db->bind(':flow_approve', $flow_approve); 
 $db->bind(':image_require', $image_require); 
 $db->bind(':categoria', $categoria); 
 $db->bind(':qr_check_in', $qr_check_in); 
 $db->bind(':image_single', $image_single); 
 $db->bind(':id', $id); 

 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>