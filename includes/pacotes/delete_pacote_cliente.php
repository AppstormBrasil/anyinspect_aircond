<?php
 include('../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 $id_package = $_POST['id_package'];
 $id_cliente = $_POST['id_cliente'];

 $database->query('DELETE FROM tb_package_client 
 					WHERE id_cliente = :id_cliente AND id_package = :id_package ');
 
 $database->bind(':id_cliente', $id_cliente);
 $database->bind(':id_package', $id_package);

 if($database->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Ítem removido com sucesso !";
	echo json_encode($arr);
	exit(0);


 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro ao deletar este ítem se o problema persistir entrar em conato com o Administrador";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
