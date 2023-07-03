<?php

  include('../common/util.php');

  $db = new db(); 
  $extra_where = "";
  if(isset($_GET["lista_funcionario"])){
		$lista_funcionario = $_GET["lista_funcionario"];
		
		$extra_where .= ' WHERE ';
		foreach($lista_funcionario as $row) {
			
			$extra_where .= ' FIND_IN_SET('.$row.', bd.id_funcionario) OR ';
		}

		$extra_where = substr($extra_where,0,-3);
	
	} else {
	 $has_func = "";  
	 $extra_where = " WHERE b.status <> 'Deletado' GROUP BY b.id";
  }

    function get_info_extra($id_evento){
	$dummy_info = "";
	$db = new db(); 		
	$db->query("SELECT tbc.Info_adicional as Info_adicional
		FROM tb_info_adicional_service tbc 
		WHERE tbc.id_booking = ".$id_evento." ");
	$result = $db->resultset();
	$response = array();
	if($result){
		foreach($result as $row) {
			$Info_adicional = $row['Info_adicional'];
			$dummy_info .= '<span  class="text-pale-sky">'.$Info_adicional.'</span><br>';
		}
	}
	return $dummy_info;
}
 
  function get_funcionarios($id_evento){
	$dummy_func = "";
	$db = new db(); 		
	$db->query("SELECT tbt.id as id_funcionario , tbt.name as nome_funcionario , 
		tbt.foto as foto_funcionario
		FROM tb_book_func tbc 
		LEFT JOIN tb_team tbt on tbc.id_fun = tbt.id
		WHERE tbc.id_booking = ".$id_evento." ");
	$result = $db->resultset();
	$response = array();
	if($result){
		foreach($result as $row) {
			$foto_funcionario = $row['foto_funcionario'];
			$nome_funcionario = $row['nome_funcionario'];
			if ($foto_funcionario != ""){
				$foto_funcionario = "images/upload/funcionarios/".$foto_funcionario ;
			}else{
				$foto_funcionario = "images/nouser.png" ;
			}
			$dummy_func .= '<span><a target="_blank" href="funcionario-'.$row['id_funcionario'].'"><span><img class="avatar_table" src="'.$foto_funcionario.'" alt="Avatar" height="30" width="30"></a><span>'.$nome_funcionario.'</span></span>';
		}
	}
	
	return $dummy_func;

}

 $db->query("SELECT bd.id_pet ,  tbteam.id as id_funcionario , tbteam.name as nome_funcionario , 
	 tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, 
	 pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
	 bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
	 bd.id_quem_executou as quem_executou, bd.endereco , 
	 ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial , ps.est_time as est_time , 
	 tca.id as id_ativo , tca.descricao , tca.foto as foto_ativo , bd.price_taxi , bd.pet_taxi , 
	 pc.name as nome_cliente , tcba.description as category , bd.priority , pc.zip, pc.street, pc.number, pc.neighbor, pc.complemento, pc.city, pc.state_, pc.lat, pc.lon 
	 FROM tb_booking b 
	 LEFT JOIN tb_book_detail bd on b.id = bd.id_booking LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
	 LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id LEFT JOIN tb_client pc on b.id_client = pc.id 
	 LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
	 LEFT JOIN tb_category tcba ON tca.category = tcba.id 
	 LEFT JOIN tb_services ps ON ps.id = bd.service_name 
	 ".$extra_where." "
	 
	);



  $result = $db->resultset();

  //print_r($result);
  
  $response = array();
  
	if($result){
		foreach($result as $row) {
			$id_evento = $row['bookingid'];
			$id_client = $row['id_client'];
			$start_date = $row['start_date'];
			$start_dateReage = $row['date_reage_inicial'];
			$end_date = $row['end_date'];
			$status = $row['status'];
			$name_client = $row['name'];
			$quem_executou = $row['quem_executou'];
			$endereco = $row['endereco'];
			$info_extra = $row['info_extra'];
			$id_funcionario = $row['id_funcionario'];
			$nome_funcionario = $row['nome_funcionario'];
			$foto_funcionario = $row['foto_funcionario'];
			$short_dec = $row['short_dec'];
			$func_list = get_funcionarios($id_evento);
			$Info_list = get_info_extra($id_evento);
			$foto_cliente = $row['foto_cliente'];
			$foto_ativo = $row['foto_ativo'];
			$short_dec = $row['short_dec'];
			$price_taxi = $row['price_taxi'];
			$pet_taxi = $row['pet_taxi'];
			$nome_cliente = $row['nome_cliente'];
			$category = $row['category'];
			$prioridade = $row['priority'];
			$ativo = $row['descricao'];
			$id_ativo = $row['id_ativo'];
			$zip = $row['zip'];
			$street = $row['street'];
			$number = $row['number'];
			$neighbor = $row['neighbor'];
			$complemento = $row['complemento'];
			$city = $row['city'];
			$state_ = $row['state_'];
			$lat = $row['lat'];
			$lon = $row['lon'];

			$endereco_cliente = $street.' '.$number.' '.$neighbor.' '.$complemento.' '.$city.' '.$state_.' '.$zip;

			if ($foto_cliente != ""){
				$foto_cliente = "images/upload/clientes/".$foto_cliente ;
			}else{
				$foto_cliente = "images/nouser.png" ;
			}
			
			if ($foto_funcionario != ""){
				$foto_funcionario = "images/upload/funcionarios/".$foto_funcionario ;
			}else{
				$foto_funcionario = "images/nouser.png" ;
			}

			
			if($pet_taxi == '0'){
				$pet_taxi_dum = '';
			} else {
				$pet_taxi_dum = '- Taxi';
			}

			if ($foto_ativo != ""){
				$foto_ativo = "images/upload/ativos/".$foto_ativo ;
			}else{
				$foto_ativo = "images/nouser.png" ;
			}
			
			if($row['status'] == "Pendente"){
				$color = '#efefef';
				$textColor = "#111";
			} else if($row['status'] == "Em Andamento"){
				$color = '#f1c951';
				$textColor = "#111";
			} else if($row['status'] == "Cancelado"){
				$color = '#F44336';
				$textColor = "#fff";
			} else if($row['status'] == "Finalizado"){
				$color = '#18998d';
				$textColor = "#fff";
			} else if($row['status'] == "Deletado"){
				$color = '#0e0e0e';
				$textColor = "#fff";
			} else if($row['status'] == "Concluído"){
				$color = '#8bc34a';
				$textColor = "#fff";
			} else if($row['status'] == "Reprovado"){
				$color = '#E91E63';
				$textColor = "#fff";
			} else {
				$color = '#0275d8';
				$textColor = "#FFF";
			}
			
			
			$started_at = $row['started_at'];
			$ended_at = $row['ended_at'];
			$service_name = $row['service_name'];
			$preco = $row['price'];
			$time_block = $row['time_block'];
			$est_time = $row['est_time'];

			$response[] = array(
				"id"=>$id_evento,
				"title"=>$id_client.'-['.$ativo.'] -'.$nome_cliente,
				"desc_service"=>$short_dec,
				"textColor"=> $textColor,
				"color"=>$color,
				'br_start'=>usa_to_br_date_time($row['start_date']),
				"start"=>$start_date,
				"end"=>$end_date,
				"termina"=>$end_date,
				"status_"=>$status,
				"id_client"=>$id_client,
				"name_client"=>$name_client,
				"started_at"=>$started_at,
				"ended_at"=>$ended_at,
				"preco"=>$preco,
				"info_extra"=>$info_extra,
				"time_block"=>$time_block,
				"quem_executou"=>$nome_funcionario,
				"produtos"=>'prod1',
				"nome_funcionario"=>$nome_funcionario,
				"endereco"=>$endereco,
				"foto_cliente"=>$foto_cliente,
				"foto_funcionario"=>$foto_funcionario,
				"foto_ativo"=>$foto_ativo,
				"id_funcionario"=>$id_funcionario,
				"start_dateReage" => $start_dateReage,
				"func_list"=>$func_list,
				"Info_list" => $Info_list,
				"resourceId" => $id_funcionario,
				"est_time" => $est_time,
				"pet_taxi"=>$pet_taxi,
				"id_ativo"=>$id_ativo,
				"ativo"=>$ativo,
				"func_list"=>$func_list,
				"price_taxi"=>$price_taxi,
				"category"=>$category,
				"prioridade"=>$prioridade,
				"id_form"=>$service_name,
				"endereco_cliente"=>$endereco_cliente


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
