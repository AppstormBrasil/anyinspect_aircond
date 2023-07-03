<?php
include('../common/util.php'); 

$currentDate = date('Y-m-d H:i:s');

$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$endTime_dummy = explode(' ', $startTime);
$endTime_dummy = $endTime_dummy[0].' '.$endTime;
$clientes = $_POST["clientes"];
$tipo_servico = $_POST["tipo_servico"];
$preco = $_POST["preco"];
$info_extra = $_POST["obs_extra"];
$prioridade = $_POST["prioridade"];

$price_taxi = $_POST["price_taxi"];
$id_pet = $_POST["id_ativo"];
$has_taxi = $_POST["has_taxi"];
$obs_adr = $_POST["obs_adr"];

if($has_taxi == 1){
	if($obs_adr != ''){
		$obs_adr = $obs_adr;
	} else {
		$obs_adr = '';
	}
	
} else {
	$obs_adr = '';
	$price_taxi = 0;
}

$has_func = 0;


function insert_repeat_date($startTime,$endTime){
	$currentDate = date('Y-m-d H:i:s');
	$clientes = $_POST["clientes"];
	$tipo_servico = $_POST["tipo_servico"];
	$preco = $_POST["preco"];
	$info_extra = $_POST["obs_extra"];
	$has_func = 0;
	$has_chose_fun = $_POST["has_chose_fun"];
	$prioridade = $_POST["prioridade"];

	if($has_chose_fun != ''){
		$id_funcionario_ = $_POST["id_funcionario"];
		$has_func = 0;
	} else {
		if(isset($_POST['id_funcionario'])){
			$id_funcionario = $_POST["id_funcionario"];
			$id_funcionario_ = implode (", ", $id_funcionario);
			$has_func = 1;
		} else {
			$id_funcionario_ = get_current_id();
			$has_func = 0;
		}
	}

	if($info_extra != ''){
		$info_extra = $info_extra;
	} else {
		$info_extra = '';
	}

	$price_taxi = $_POST["price_taxi"];
	$id_pet = $_POST["id_ativo"];
	$has_taxi = $_POST["has_taxi"];
	$obs_adr = $_POST["obs_adr"];

	if($has_taxi == 1){
		if($obs_adr != ''){
			$obs_adr = $obs_adr;
		} else {
			$obs_adr = '';
		}
		
	} else {
		$obs_adr = '';
		$price_taxi = 0;
	}

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
		
		$database->query("INSERT INTO tb_book_detail (id_booking, id_pet, service_name, price , info_extra, id_funcionario,pet_taxi,endereco,price_taxi,priority) 
			VALUES (:last_id, :id_pet, :tipo_servico, :preco,:info_extra, :id_funcionario,:pet_taxi,:endereco,:price_taxi,:priority)");
		$database->bind(':last_id', $last_id);
		$database->bind(':id_pet', $id_pet);
		$database->bind(':tipo_servico', $tipo_servico);
		$database->bind(':preco', $preco);
		$database->bind(':info_extra', $info_extra);
		$database->bind(':id_funcionario', $id_funcionario_);
		$database->bind(':pet_taxi', $has_taxi);
		$database->bind(':endereco', $obs_adr);
		$database->bind(':price_taxi', $price_taxi);
		$database->bind(':priority', $prioridade);

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
			

		}

	} else {
		//$arr['status'] = 'ERROR';
		//$arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
		//exit(0);
	}


}

$has_chose_fun = $_POST["has_chose_fun"];

if($has_chose_fun != ''){
	$id_funcionario_ = $_POST["id_funcionario"];
	$has_func = 0;
} else {
	if(isset($_POST['id_funcionario'])){
		$id_funcionario = $_POST["id_funcionario"];
		$id_funcionario_ = implode (", ", $id_funcionario);
		$has_func = 1;
	} else {
		$id_funcionario_ = get_current_id();
		$has_func = 0;
	}
}


if($info_extra != ''){
	$info_extra = $info_extra;
} else {
	$info_extra = '';
}

$startTime = br_to_usa_date_time2($startTime);
$endTime = br_to_usa_date_time2($endTime_dummy);

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
	
	$database->query("INSERT INTO tb_book_detail (id_booking, id_pet, service_name, price , info_extra, id_funcionario,pet_taxi,endereco,price_taxi, priority) 
			VALUES (:last_id, :id_pet, :tipo_servico, :preco,:info_extra, :id_funcionario,:pet_taxi,:endereco,:price_taxi, :priority)");
	$database->bind(':last_id', $last_id);
	$database->bind(':id_pet', $id_pet);
	$database->bind(':tipo_servico', $tipo_servico);
	$database->bind(':preco', $preco);
	$database->bind(':info_extra', $info_extra);
	$database->bind(':id_funcionario', $id_funcionario_);
	$database->bind(':pet_taxi', $has_taxi);
	$database->bind(':endereco', $obs_adr);
	$database->bind(':price_taxi', $price_taxi);
	$database->bind(':priority', $prioridade);

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
		

		//$arr['status'] = 'SUCCESS';
		//$arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
		//echo json_encode($arr);
		//exit(0);
	}


	$arr['status'] = 'SUCCESS';
	$arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
	echo json_encode($arr);
		//exit(0);

	if(isset($_POST['has_multiple'])){
		$has_multiple = $_POST["has_multiple"];
	
		foreach($has_multiple as $itens){
			
			$item_dummy = explode(" ",$itens);
	
			$startTime_ = $item_dummy[1].' '.$item_dummy[2];
			$endTime_ = $item_dummy[1].' '.$item_dummy[4];
	
			$startTime = br_to_usa_date_time2($startTime_);
			$endTime = br_to_usa_date_time2($endTime_);
			
			insert_repeat_date($startTime,$endTime);
		
	
		}
	
	} 


} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
//$database->endTransaction();
?>