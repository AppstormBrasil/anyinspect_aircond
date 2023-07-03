<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 

 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
 if(isset($_POST['tool_id'])){ $tool_id = $_POST['tool_id'];} else {$tool_id = '';}
 

 	$db->query("SELECT id FROM tb_service_tool WHERE id_service = :id_service AND id_tool = :id_tool ");
	$db->bind(':id_service', $id);
	$db->bind(':id_tool', $tool_id);
	$db->execute();
	$result = $db->single(); 
	$id_res = $result['id'];

 
 if($id_res > 0){
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Produto já Cadastrado!'; 
		echo json_encode($arr);
		exit(0);
  
  } else {
		
	$db->query("INSERT INTO tb_service_tool (id_service, id_tool) VALUES (:id_service, :id_tool)");
	$db->bind(':id_service', $id);
	$db->bind(':id_tool', $tool_id);
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