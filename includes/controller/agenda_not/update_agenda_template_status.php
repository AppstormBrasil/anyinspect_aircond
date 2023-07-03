<?php 
 
include('../../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['IdformAgenda'])){ $IdformAgenda = $_POST['IdformAgenda'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }
 
 if(isset($_POST['new_status'])){ $new_status = $_POST['new_status'];} else {$new_status = '';}

 $db->query('UPDATE tb_admin_form_agenda SET status = :status , data_atualizacao = :data_atualizacao  WHERE IdformAgenda = :IdformAgenda ');
 
 $db->bind(':status', $new_status);
 $db->bind(':data_atualizacao', $data_atualizacao); 
 $db->bind(':IdformAgenda', $IdformAgenda); 

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