<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');

$startTime = $_POST["startTime"].':00';
$endTime = $_POST["endTime"].':00';
$clientes = $_POST["clientes"];
$tipo_servico = $_POST["tipo_servico"];
$preco = $_POST["preco"];
$info_extra = $_POST["obs"];
$has_func = 0;


if(isset($_POST['id_funcionario'])){
	$id_funcionario = $_POST["id_funcionario"];
	$id_funcionario_ = $_POST["id_funcionario"];
	//$id_funcionario_ = implode (", ", $id_funcionario);
	$has_func = 0;
} else {
	$id_funcionario_ = get_current_id();
	$has_func = 0;
}


if($info_extra != ''){
	$info_extra = utf8_decode($info_extra);
} else {
	$info_extra = '';
}


$status = "";
$status = "Pendente";
$database = new db();
$database->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:clientes, :startTime, :endTime, :status, :currentDate,:status_pagamento)");
$database->bind(':clientes', $clientes);
$database->bind(':startTime', $startTime);
$database->bind(':endTime', $endTime);
$database->bind(':status', $status);
$database->bind(':currentDate', $currentDate);
$database->bind(':status_pagamento', 'Não');

if($database->execute()){
    $last_id = $database->lastInsertId(); 
	
	$database->query("INSERT INTO tb_book_detail (id_booking, service_name, price , info_extra, id_funcionario) 
		VALUES (:last_id, :tipo_servico, :preco,:info_extra, :id_funcionario)");
	$database->bind(':last_id', $last_id);
	$database->bind(':tipo_servico', $tipo_servico);
	$database->bind(':preco', $preco);
	$database->bind(':info_extra', $info_extra);
	$database->bind(':id_funcionario', $id_funcionario_);

	if($database->execute()){
		if($has_func == 1 ){
			foreach ($id_funcionario as $value) {
				$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
				$database->bind(':id_booking', $last_id);
				$database->bind(':id_fun', $value);
				$database->execute();
				//echo "$value <br>";
			}
		} else {
			$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
				$database->bind(':id_booking', $last_id);
				$database->bind(':id_fun', $id_funcionario_);
				$database->execute();
		}
		

		$arr['status'] = 'SUCCESS';
		$arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
		echo json_encode($arr);
		exit(0);
	}

} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>