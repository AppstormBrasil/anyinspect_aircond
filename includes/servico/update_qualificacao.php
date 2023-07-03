<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 

 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
 if(isset($_POST['qual_desc'])){ $qual_desc = $_POST['qual_desc'];} else {$qual_desc = '';}
 

 	$db->query("SELECT id FROM tb_service_qual WHERE id_service = :id_service AND desc_qual = :desc_qual ");
	$db->bind(':id_service', $id);
	$db->bind(':desc_qual', $qual_desc);
	$db->execute();
	$result = $db->single(); 
	$id_res = $result['id'];

 
 if($id_res > 0){
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Qualificação já Cadastrada!'; 
		echo json_encode($arr);
		exit(0);
  
  } else {
		
	$db->query("INSERT INTO tb_service_qual (id_service, desc_qual) VALUES (:id_service, :desc_qual)");
	$db->bind(':id_service', $id);
	$db->bind(':desc_qual', $qual_desc);
	$db->execute();
	$last_id = $db->lastInsertId(); 


 $arr['status'] = 'SUCCESS';
 $arr['last_id'] = $last_id;
 $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
 echo json_encode($arr);
 exit(0);

  }

  
 

 
exit;

 ?>