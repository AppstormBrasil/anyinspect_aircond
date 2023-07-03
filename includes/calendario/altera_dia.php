<?php 
 
	include('../common/util.php'); 
	$data_atualizacao = date('Y-m-d  H:i:s'); 
	$db = new db(); 
	
	$started_at = "";
	$ended_at = "";
	
	$IdFunc = get_current_id();

	if(isset($_POST['start_final'])){ $start_final = $_POST['start_final'];} else {$start_final = '';}
	if(isset($_POST['end_final'])){ $end_final = $_POST['end_final'];} else {$end_final = '';}

	$startTime = br_to_usa_date_time2($start_final);
    $endTime = br_to_usa_date_time2($end_final);
	

	if(isset($_POST['id'])){ 
		$id = $_POST['id'];

		$db->query('UPDATE tb_booking SET start_date = :start_date, end_date = :end_date WHERE id = :id ');
 
		$db->bind(':start_date', $startTime);
		$db->bind(':end_date', $endTime);
		$db->bind(':id', $id); 
		
		if($db->execute()){
			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Atualizado com Sucesso'; 
			echo json_encode($arr);
			exit(0);
		} else {
			
		}

	} else {
		$arr['status'] = 'ERROR'; 
	 	$arr['status_txt'] = 'Erro ao Atualizar'; 
	 	echo json_encode($arr);
	}
	


 ?>