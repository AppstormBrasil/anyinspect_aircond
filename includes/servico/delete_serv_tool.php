<?php
 include('../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 $id_tool = $_POST['id_product'];
 $id_service = $_POST['id_service'];


 $database->query('DELETE FROM tb_service_tool WHERE id_tool = :id_tool AND id_service = :id_service ');
 $database->bind(':id_tool', $id_tool);
 $database->bind(':id_service', $id_service);

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
