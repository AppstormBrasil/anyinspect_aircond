<?php
 include('../common/util.php');
 $db = new db();
 $data_cadastro = date('Y-m-d  H:i:s');

  $id = $_POST['id'];
 $db->query('DELETE FROM formulario WHERE IdFormulario = :IdFormulario');
 $db->bind(':IdFormulario', $id);
 if($db->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Formulário removido com sucesso !";
	echo json_encode($arr);
 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro! Ocorreu algum erro , se o problema persistir entre em contato com o Administrador!";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
