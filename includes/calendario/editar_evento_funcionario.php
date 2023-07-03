<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');

$id_event = $_POST["id_event"];
$id_funcionario = $_POST["id_funcionario"];

if(isset($_POST['id_funcionario'])){
	$id_funcionario = $_POST["id_funcionario"];
	$id_funcionario_ = implode (", ", $id_funcionario);
	$has_func = 1;
} else {
	$id_funcionario_ = get_current_id();
	$has_func = 0;
}

$db = new db();

$db->query('DELETE FROM tb_book_func WHERE id_booking = :id_event ');
$db->bind(':id_event', $id_event);
$db->execute();

foreach ($id_funcionario as $value) {
	$db->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
	$db->bind(':id_booking', $id_event);
	$db->bind(':id_fun', $value);
	$db->execute();
	//echo "$value <br>";
}

foreach ($id_funcionario as $value) {
	$db->query("UPDATE tb_book_detail SET id_funcionario = :id_funcionario  WHERE id_booking = :id_booking ");

	//$db->query("INSERT INTO tb_book_detail (id_booking, id_funcionario) VALUES (:id_booking, :id_funcionario)");
	
	$db->bind(':id_funcionario', $value);
	$db->bind(':id_booking', $id_event);
	$db->execute();
	//echo "$value <br>";
}

$arr['status'] = 'SUCCESS';
$arr['status_txt'] = 'Atualizado com sucesso!' ;
echo json_encode($arr);


exit(0);


?>