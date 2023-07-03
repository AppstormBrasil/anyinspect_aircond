<?php 
 
include('../../common/util.php'); 
$data_cadastro = date('Y-m-d  H:i:s'); 
$db = new db(); 
$IdCondominio = get_id_empresa();
 
 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';} 

 

 $db->query('SELECT * FROM tb_admin_form_agenda WHERE IdCondominio ='. $IdCondominio .' AND IdEnquete ='. $IdEnquete .' '); 
 $db->execute();
 $result = $db->resultset(); 
 $response = array();
 $response2 = array();

 if($result){ 
	
 }



	 $db->query('INSERT INTO tb_admin_form_agenda (titulo,descricao,data_cadastro,data_atualizacao,status) VALUES (:titulo, :descricao, :data_cadastro, :data_atualizacao, :status)'); 
	 $db->bind(':titulo', $titulo); 
	 $db->bind(':descricao', $descricao); 
	 $db->bind(':data_cadastro', $data_cadastro); 
	 $db->bind(':data_atualizacao', $data_cadastro); 
	 $db->bind(':status', $status); 
if($db->execute()){ 
 	 	 $last_id = $db->lastInsertId(); 
	 	 $arr['status'] = 'SUCCESS';
	 	 $arr['last_id'] = $last_id;
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao salvar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>