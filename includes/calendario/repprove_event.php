<?php 
 
	include('../common/util.php'); 
	$data_atualizacao = date('Y-m-d  H:i:s'); 

	
	$db = new db(); 
	
	$started_at = "";
	$ended_at = "";

	if(isset($_POST['eventID'])){ $eventID = $_POST['eventID'];} else {$eventID = '';}
	if(isset($_POST['acao'])){ $acao = $_POST['acao'];} else {$acao = '';}
	if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} else {$id_funcionario = '';}
	if(isset($_POST['repprove_message'])){ $repprove_message = $_POST['repprove_message'];} else {$repprove_message = '';}

	if($id_funcionario != ''){
		$IdFunc = $id_funcionario;
	} else {
		$IdFunc = 0;
	}

	$acao = "Pendente";
	$started_at = $data_atualizacao;
	
	$db->query('UPDATE tb_booking SET status = :acao WHERE id = :eventID');
	$db->bind(':acao', $acao);
	$db->bind(':eventID', $eventID); 
	if($db->execute()){

		if($repprove_message != ''){
			$db->query("INSERT INTO tb_hist_approve (id_booking, id_user, comments , data, status) VALUES (:id_booking, :id_user , :comments , :data, :status)");
			$db->bind(':id_booking', $eventID);
			$db->bind(':id_user', $IdFunc);
			$db->bind(':comments', $repprove_message);
			$db->bind(':data', $data_atualizacao);
			$db->bind(':status', 'Reprovado');
			$db->execute();
		}
		
			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Atualizado com Sucesso'; 
			echo json_encode($arr);
			exit(0);
		
	}

		exit;
	

	

 ?>