<?php 
 
include('../../common/util.php'); 
$data_cadastro = date('Y-m-d  H:i:s'); 
$db = new db(); 
$IdCondominio = get_id_empresa();
 
if(isset($_POST['titulo'])){ $titulo = $_POST['titulo'];} else {$titulo = '';} 
if(isset($_POST['descricao'])){ $descricao = $_POST['descricao'];} else {$descricao = '';} 
$status = 1;

$db->query('INSERT INTO tb_admin_form_agenda (IdCondominio,titulo,descricao,data_cadastro,data_atualizacao,status) VALUES (:IdCondominio,:titulo, :descricao, :data_cadastro, :data_atualizacao, :status)'); 
$db->bind(':IdCondominio', $IdCondominio); 
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