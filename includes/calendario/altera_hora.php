<?php 
 
	include('../common/util.php'); 
	$data_atualizacao = date('Y-m-d  H:i:s'); 
	$db = new db(); 
	
	$started_at = "";
	$ended_at = "";
	
	$IdFunc = get_current_id();

	if(isset($_POST['eventID'])){ $eventID = $_POST['eventID'];} else {$eventID = '';}
	if(isset($_POST['acao'])){ $acao = $_POST['acao'];} else {$acao = '';}
	
	$db->query('SELECT pb.id_client, pc.phone2, pc.name from tb_booking pb INNER JOIN tb_client pc ON pb.id_client = pc.id where pb.id = :eventID');
	$db->bind(':eventID', $eventID); 
	$db->execute();

	$result = $db->resultset();
	 foreach($result as $row) {
		$zap = $row["phone2"];
		$fullname = $row["name"];
	 }
	 
	if($acao == "comecar"){
		$acao = "Em Andamento";
		$started_at = $data_atualizacao;
		
		$db->query('UPDATE tb_booking SET status = :acao WHERE id = :eventID');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':acao', $acao);
		
		if($db->execute()){
			$db->query('UPDATE tb_book_detail SET started_at = :started_at, id_quem_executou = :id_quem_executou WHERE id_booking = :eventID ');
 
			$db->bind(':eventID', $eventID);
			$db->bind(':started_at', $started_at);
			$db->bind(':id_quem_executou', $IdFunc); 
			
			if($db->execute()){
				$arr['status'] = 'SUCCESS';
				$arr['status_txt'] = 'Atualizado com Sucesso'; 
				echo json_encode($arr);
				exit(0);
			}
		}
	}
	else if($acao == "finalizar"){
		$acao = "Finalizado";
		$ended_at = $data_atualizacao;
		
		$db->query('SELECT price from tb_book_detail where id_booking = :eventID');
		$db->bind(':eventID', $eventID); 
		$db->execute();

		$result = $db->resultset();
		foreach($result as $row) {
			$price = $row["price"];
		}
		
		$db->query('SELECT comission from tb_team where id = :IdFunc');
		$db->bind(':IdFunc', $IdFunc); 
		$db->execute();

		$result = $db->resultset();
		foreach($result as $row) {
			$comissao = $row["comission"];
		}
		
		$comissao = $comissao / 100;
		
		$comission = $price * $comissao;
		 
		$db->query('INSERT into tb_comission (id_func, id_booking, comission) VALUES (:IdFunc, :eventID, :comission)');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':IdFunc', $IdFunc);
		$db->bind(':comission', $comission);
		
		if($db->execute()){
		}
		
		$db->query('UPDATE tb_booking SET status = :acao WHERE id = :eventID ');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':acao', $acao);
		
		if($db->execute()){
		}
		
		$db->query('UPDATE tb_book_detail SET ended_at = :ended_at WHERE id_booking = :eventID ');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':ended_at', $ended_at);
		
		if($db->execute()){
			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Atualizado com Sucesso'; 
			$arr['zap'] = $zap;
			$arr['fullname'] = $fullname;
			echo json_encode($arr);
			exit(0);
		}
	}
	else{
		$arr['status'] = 'ERROR';
		$arr['status_txt'] = 'Erro!'; 
		echo json_encode($arr);
		exit(0);
	}

 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso';
	 $arr['fullname'] = $fullname;	 
	 echo json_encode($arr);
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>