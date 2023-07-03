<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}

 $descricao = $_POST["descricao"];
 $category = $_POST["category"];
 $model = $_POST["model"];
 $register = $_POST["register"];
 $obs = $_POST["obs"];
 $local = $_POST["local"];
 $validade = $_POST["validade"];
 $calibracao = $_POST["calibracao"];
 $fabricante = $_POST["fabricante"];
 $capacidade = $_POST["capacidade"];
 $responsavel = $_POST["responsavel"];
 $tipo = $_POST["tipo"];
 $base = $_POST["base"];
 //$type_pai = $_POST["type_pai"];
 //$list_pai = $_POST["list_pai"];

 if($validade != ''){
	$validade = br_to_usa($validade);
 }

 if($calibracao != ''){
	$calibracao = br_to_usa($calibracao);
 }

 $db->query('UPDATE tb_tooling SET descricao = :descricao , model = :model, register = :register, obs = :obs , local = :local , validade = :validade , fabricante = :fabricante , capacidade = :capacidade , category = :category , tipo = :tipo , calibracao = :calibracao , responsavel = :responsavel , base = :base WHERE id = :id ');
 
 $db->bind(':id', $id); 
 $db->bind(':descricao', $descricao); 
 $db->bind(':model', $model); 
 $db->bind(':register', $register);
 $db->bind(':obs', $obs); 
 $db->bind(':local', $local); 
 $db->bind(':validade', $validade); 
 $db->bind(':fabricante', $fabricante); 
 $db->bind(':capacidade', $capacidade); 
 $db->bind(':category', $category); 
 $db->bind(':tipo', $tipo); 
 $db->bind(':base', $base); 
 $db->bind(':responsavel', $responsavel); 
 //$db->bind(':type_pai', $type_pai); 
 //$db->bind(':id_depende', $list_pai); 
 $db->bind(':calibracao', $calibracao); 
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