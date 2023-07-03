<?php
 include('../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 $id = $_POST['id'];

 $database->query('DELETE FROM tb_prod_shooping WHERE id = :id ');
 $database->bind(':id', $id);

 if($database->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Ítem removido com sucesso !";
	echo json_encode($arr);
	
	$database->query('DELETE FROM tb_variante_prod WHERE id_prod_venda = :id ');
	$database->bind(':id', $id);
	$database->execute();
	
	exit(0);
 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro ao deletar este ítem se o problema persistir entrar em conato com o Administrador";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
