<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');
$_POST = json_decode(file_get_contents('php://input'), true);
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$clientes = $_POST["clientes"];
$pet_cliente = $_POST["pet_cliente"];
$tipo_servico = $_POST["tipo_servico"];
$preco = $_POST["preco"];
$has_taxi = $_POST["has_taxi"];
$obs_adr = $_POST["obs_adr"];
$info_extra = $_POST["info_extra"];
$id_funcionario = $_POST["id_funcionario"];
$price_taxi = $_POST["price_taxi"];
$priority = $_POST["prioridade"];

$id_funcionario_ = implode (", ", $id_funcionario);

if($has_taxi == 1){

	if($obs_adr != ''){
		$obs_adr = $obs_adr;
		//$obs_adr = $obs_adr;
	} else {
		$obs_adr = '';
	}
	
} else {
	$obs_adr = '';
	$price_taxi = 0;
}

if($info_extra != ''){
	$info_extra = $info_extra;
} else {
	$info_extra = '';
}

$startTime = br_to_usa_date_time2($startTime).':00';
$endTime = br_to_usa_date_time2($endTime).':00';

$status = "Pendente";

$database = new db();

$database->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:clientes, :startTime, :endTime, :status, :currentDate,:status_pagamento)");
$database->bind(':startTime', $startTime);
$database->bind(':endTime', $endTime);
$database->bind(':clientes', $clientes);
$database->bind(':status', $status);
$database->bind(':currentDate', $currentDate);
$database->bind(':status_pagamento', 'Não');

if($database->execute()){
    $last_id = $database->lastInsertId(); 
	
	$database->query("INSERT INTO tb_book_detail (id_booking, id_pet, service_name, price ,info_extra ,pet_taxi , endereco,price_taxi,id_funcionario,priority) VALUES (:last_id, :pet_cliente, :tipo_servico, :preco,:info_extra,:pet_taxi,:endereco,:price_taxi,:id_funcionario,:priority)");
	$database->bind(':pet_cliente', $pet_cliente);
	$database->bind(':last_id', $last_id);
	$database->bind(':preco', $preco);
	$database->bind(':tipo_servico', $tipo_servico);
	$database->bind(':info_extra', $info_extra);
	$database->bind(':pet_taxi', $has_taxi);
	$database->bind(':endereco', $obs_adr);
	$database->bind(':price_taxi', $price_taxi);
	$database->bind(':id_funcionario', $id_funcionario_);
	$database->bind(':priority', $priority);
	if($database->execute()){

		foreach ($id_funcionario as $value) {
			$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
			$database->bind(':id_booking', $last_id);
			$database->bind(':id_fun', $value);
			$database->execute();
			//echo "$value <br>";
		}

		$arr['status'] = 'SUCCESS';
		$arr['last_id'] = $last_id;
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