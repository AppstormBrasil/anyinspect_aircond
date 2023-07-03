<?php
 include('../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 $IdEvento = $_POST['IdEvento'];

 $database->query('DELETE FROM tb_booking WHERE id = :idEvento ');
 $database->bind(':idEvento', $IdEvento);

 if($database->execute()){
	
	$database->query('DELETE FROM tb_book_detail WHERE id_booking = :idEvento ');
	$database->bind(':idEvento', $IdEvento);
	
	 if($database->execute()){
		$arr['status'] = "SUCCESS";
		$arr['status_txt'] = "Ítem removido com sucesso !";

		$database->query('DELETE FROM tb_comission WHERE id_booking = :idEvento ');
		$database->bind(':idEvento', $IdEvento);
		$database->execute();
	 

		echo json_encode($arr);
		exit(0);
	}
 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro ao deletar este ítem se o problema persistir entrar em conato com o Administrador";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
