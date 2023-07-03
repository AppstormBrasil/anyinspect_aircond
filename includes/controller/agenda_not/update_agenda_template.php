<?php 
 
include('../../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_POST['id'])){ 
		$IdformAgenda = $_POST['id'];
} 
else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro ao salvar'; 
	echo json_encode($arr);
}


 if(isset($_POST['titulo'])){ $titulo = $_POST['titulo'];} else {$titulo = '';} 
 if(isset($_POST['descricao'])){ $descricao = $_POST['descricao'];} else {$descricao = '';}
 
 $status = 1;


	 $db->query('UPDATE tb_admin_form_agenda SET titulo = :titulo, descricao = :descricao ,  data_atualizacao = :data_atualizacao WHERE IdformAgenda = :IdformAgenda ');
	 $db->bind(':titulo', $titulo); 
	 $db->bind(':descricao', $descricao); 
	 $db->bind(':data_atualizacao', $data_atualizacao); 
	 $db->bind(':IdformAgenda', $IdformAgenda); 
if($db->execute()){ 
 	 	 $last_id = $db->lastInsertId(); 
		  $arr['status'] = 'SUCCESS';
		  $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao salvar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>