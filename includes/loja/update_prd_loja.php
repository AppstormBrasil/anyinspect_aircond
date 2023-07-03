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
 

 if(isset($_POST['titulo'])){ $titulo = $_POST['titulo'];} else {$titulo = '';}
 if(isset($_POST['valor'])){ $valor = $_POST['valor'];} else {$valor = '';} 
 if(isset($_POST['categoria'])){ $categoria = $_POST['categoria'];} else {$categoria = '';} 
 if(isset($_POST['qtd'])){ $qtd = $_POST['qtd'];} else {$qtd = '';} 
 if(isset($_POST['descricao'])){ $descricao = $_POST['descricao'];} else {$descricao = '';} 
 if(isset($_POST['tipo'])){ $tipo = $_POST['tipo'];} else {$tipo = '';} 


 
 $db->query('UPDATE tb_prod_shooping SET titulo = :titulo , preco = :preco , categoria = :categoria,
 	qtd = :qtd, descricao = :descricao, tipo = :tipo, data_update = :data_atualizacao
 	WHERE id = :id ');
 
 $db->bind(':titulo', $titulo); 
 $db->bind(':preco', $valor); 
 $db->bind(':categoria', $categoria); 
 $db->bind(':qtd', $qtd); 
 $db->bind(':descricao', $descricao); 
 $db->bind(':tipo', $tipo);
 $db->bind(':id', $id);
 $db->bind(':data_atualizacao', $data_atualizacao);

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