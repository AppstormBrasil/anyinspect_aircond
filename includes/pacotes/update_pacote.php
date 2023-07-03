<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }
 

 if(isset($_POST['nome'])){ $nome = $_POST['nome'];} else {$nome = '';}
 if(isset($_POST['valor'])){ $valor = $_POST['valor'];} else {$valor = '';} 
 if(isset($_POST['quantidade_usos'])){ $quantidade_usos = $_POST['quantidade_usos'];} else {$quantidade_usos = '';} 
 if(isset($_POST['validade'])){ $validade = $_POST['validade'];} else {$validade = '';} 

 
 $db->query('UPDATE tb_package SET nome = :nome , valor = :valor , quantidade_usos = :quantidade_usos  , validade = :validade
 	WHERE id = :id ');
 
 $db->bind(':nome', $nome); 
 $db->bind(':valor', $valor); 
 $db->bind(':quantidade_usos', $quantidade_usos); 
 $db->bind(':validade', $validade); 
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