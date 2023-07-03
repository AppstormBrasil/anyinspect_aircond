<?php
include('../../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');

$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$clientes = $_POST["clientes"];
$pet_cliente = $_POST["pet_cliente"];
$tipo_servico = $_POST["tipo_servico"];
$preco = $_POST["preco"];
$has_taxi = $_POST["has_taxi"];
$obs_adr = $_POST["obs_adr"];
$info_extra = $_POST["obs"];

if($has_taxi == 1){
	if($obs_adr != ''){
		$obs_adr = utf8_decode($obs_adr);
	} else {
		$obs_adr = '';
	}
	
} else {
	$obs_adr = '';
}

if($info_extra != ''){
	$info_extra = utf8_decode($info_extra);
} else {
	$info_extra = '';
}

$startTime = br_to_usa_date_time2($startTime);
$endTime = br_to_usa_date_time2($endTime);

$status = "";
$status = "Pendente";

$database = new db();

$database->query("INSERT INTO pet_booking (id_client, start_date, end_date, status, data_cadastro) VALUES (:clientes, :startTime, :endTime, :status, :currentDate)");
$database->bind(':startTime', $startTime);
$database->bind(':endTime', $endTime);
$database->bind(':clientes', $clientes);
$database->bind(':status', $status);
$database->bind(':currentDate', $currentDate);

if($database->execute()){
    $last_id = $database->lastInsertId(); 
	
	$database->query("INSERT INTO pet_book_detail (id_booking, id_pet, service_name, price ,info_extra ,pet_taxi , endereco) VALUES (:last_id, :pet_cliente, :tipo_servico, :preco,:info_extra,:pet_taxi,:endereco)");
	$database->bind(':pet_cliente', $pet_cliente);
	$database->bind(':last_id', $last_id);
	$database->bind(':preco', $preco);
	$database->bind(':tipo_servico', $tipo_servico);
	$database->bind(':info_extra', $info_extra);
	$database->bind(':pet_taxi', $has_taxi);
	$database->bind(':endereco', $obs_adr);
	if($database->execute()){

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