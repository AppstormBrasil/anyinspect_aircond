<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 

 if(isset($_POST['id_produto'])){ $id_produto = $_POST['id_produto'];} else {$id_produto = '';}
 if(isset($_POST['produto'])){ $produto = $_POST['produto'];} else {$produto = '';}
 if(isset($_POST['valor'])){ $valor = $_POST['valor'];} else {$valor = '';} 
 if(isset($_POST['tipo'])){ $tipo = $_POST['tipo'];} else {$tipo = '';} 
 if(isset($_POST['qtd'])){ $qtd = $_POST['qtd'];} else {$qtd = '';} 
 if(isset($_POST['validade'])){ $validade = $_POST['validade'];} else {$validade = '';} 
 if(isset($_POST['base'])){ $base = $_POST['base'];} else {$base = '';} 
 if(isset($_POST['min_qtd'])){ $min_qtd = $_POST['min_qtd'];} else {$min_qtd = '';} 
 
 $validade = br_to_usa($validade);

 
 
 $db->query('UPDATE tb_product SET `desc` = :produto, value = :valor, type = :tipo , qtd = :qtd , validade = :validade , base =:base , min_qtd =:min_qtd WHERE id = :id_produto');
 $db->bind(':produto', $produto); 
 $db->bind(':valor', $valor); 
 $db->bind(':tipo', $tipo); 
 $db->bind(':qtd', $qtd); 
 $db->bind(':validade', $validade); 
 $db->bind(':base', $base); 
 $db->bind(':min_qtd', $min_qtd); 
 $db->bind(':id_produto', $id_produto); 

 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 
	 $db->query("INSERT INTO tb_product_hist (id_produto,id_usuario,tipo,qtd,validade,valor,data_atualizacao) VALUES (:id_produto,:id_usuario,:tipo,:qtd,:validade,:valor,:data_atualizacao)");
	 
	 $db->bind(':id_produto', $id_produto); 
	 $db->bind(':id_usuario', $IdUsuario); 
	 $db->bind(':tipo', $tipo); 
	 $db->bind(':qtd', $qtd); 
	 $db->bind(':validade', $validade); 
	 $db->bind(':valor', $valor);
	 $db->bind(':data_atualizacao', $data_atualizacao);
	 $db->execute();
	 
	 
	 
	 
	 
	 
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>