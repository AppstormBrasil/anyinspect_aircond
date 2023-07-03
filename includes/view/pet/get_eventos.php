<?php

  include('../../common/util.php');

  $db = new db(); 
  $db->query('SELECT b.id as bookingid, b.id_client, pc.name, pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.id_pet, bd.started_at, bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, bd.id_quem_executou, pett.name as quem_executou , bd.pet_taxi , bd.endereco from pet_booking b 
  LEFT JOIN pet_book_detail bd on b.id = bd.id_booking 
  LEFT JOIN pet_team pett on bd.id_quem_executou = pett.id
  LEFT JOIN pet_client pc on b.id_client = pc.id');

  $result = $db->resultset();
  
  $response = array();
  
	if($result){
		foreach($result as $row) {
			$id_evento = $row['bookingid'];
			$id_client = $row['id_client'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$status = $row['status'];
			$name_client = $row['name'];
			$quem_executou = $row['quem_executou'];
			$pet_taxi = $row['pet_taxi'];
			$endereco = $row['endereco'];
			$info_extra = $row['info_extra'];
			$endereco = utf8_encode($row['endereco']);
			$info_extra = utf8_encode($row['info_extra']);

			//echo $endereco;

			$foto_cliente = $row['foto_cliente'];

			if ($foto_cliente != ""){
				$foto_cliente = "images/pet/upload/clientes/".$foto_cliente ;
			}else{
				$foto_cliente = "images/nouser.png" ;
			}

			
			if($row['status'] == "Pendente"){
				$color = '#9E9E9E';
				$textColor = "#FFF";
			} else if($row['status'] == "Em Andamento"){
				$color = '#FFC107';
				$textColor = "#222";
			} else if($row['status'] == "Finalizado"){
				$color = '#18998d';
				$textColor = "#FFF";
			} else {
				$color = '#0275d8';
				$textColor = "#FFF";
			}
			
			$id_pet = $row['id_pet'];
			$started_at = $row['started_at'];
			$ended_at = $row['ended_at'];
			$service_name = $row['service_name'];
			
			$db->query('SELECT id, short_dec from pet_services where id = '.$service_name);

			$result2 = $db->resultset();
		  
			if($result2){
				/*foreach($result2 as $row2) {
					$service_name = $row2['short_dec'];
					
					//$produtos = $row2['id_products'];
					//$produtos = [1,2,3];
					//$produtos = explode("-", $produtos);
					$produtos = 0;
					$count = count($produtos);
					$i = 0;
					$produto_final = "";
					while($i < $count){
						$db->query('SELECT * from pet_product where id = '.$produtos[$i]); 
						$db->execute();

						$result2 = $db->resultset(); 
						if($result2){
							foreach($result2 as $row2) {
								$produto_final .= $row2['desc'].",";
							}
						}
						$i = $i + 1;
					}
					
					$produto_final = substr($produto_final,0,-1);
				} */
			}
			
			$preco = $row['price'];
			
			$time_block = $row['time_block'];

			$response[] = array(
				"id"=>$id_evento,
				"title"=>$service_name,
				"textColor"=> $textColor,
				"color"=>$color,
				'br_start'=>usa_to_br_date_time($row['start_date']),
				"start"=>$start_date,
				"end"=>$end_date,
				"termina"=>$end_date,
				"status_"=>$status,
				"id_pet"=>$id_pet,
				"id_client"=>$id_client,
				"name_client"=>$name_client,
				"started_at"=>$started_at,
				"ended_at"=>$ended_at,
				"preco"=>$preco,
				"info_extra"=>$info_extra,
				"time_block"=>$time_block,
				"quem_executou"=>$quem_executou,
				//"produtos"=>$produto_final,
				"produtos"=>'prod1',
				"pet_taxi"=>$pet_taxi,
				"endereco"=>$endereco,
				"foto_cliente"=>$foto_cliente
			);
		}

		echo json_encode($response);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! E-mail ou Senha inválidos!";
		echo json_encode($arr);
	}


exit(0);

?>
