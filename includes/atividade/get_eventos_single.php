<?php

  include('../common/util.php');

  if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
  $db = new db(); 

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
	$db->query("SELECT tbt.id as id_funcionario , tbt.name as nome_funcionario , tbt.foto as foto_funcionario
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


$db->query("SELECT bd.id_pet ,  tbteam.id as id_funcionario , tbteam.name as nome_funcionario , tbteam.cpf as cpf_funcionario , tbteam.phone as telefone_funcionario, 
tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, 
pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
bd.id_quem_executou as quem_executou, bd.endereco , 
ps.short_dec, tbt.foto as foto_quem_executou , tbt.name as nome_funcionario_exec , tbt.id as id_quem_executou , 
DATE_FORMAT(b.start_date ,'%d/%m/%Y %H:%i:%s') as date_reage_inicial , 
DATE_FORMAT(bd.started_at ,'%d/%m/%Y %H:%i:%s') as started_at , 
DATE_FORMAT(bd.ended_at ,'%d/%m/%Y %H:%i:%s') as ended_at , 
ps.est_time as est_time , TIME_TO_SEC(TIMEDIFF(bd.ended_at,bd.started_at)) as tempo_realizado ,
tca.id as id_ativo , tca.descricao , tca.foto as foto_ativo , tca.model as modelo_ativo, tca.capacidade as capacidade_ativo, tca.fabricante as fabricante_ativo, tca.qrcode as qrcode_ativo, tca.register as register_ativo, bd.price_taxi , bd.pet_taxi , tca.local as local_ativo , tca.lat as lat_ativo , tca.lon as lon_ativo , 
pc.name as nome_cliente , tcba.description as category , 
tcli.name as responsavel_cliente  , tcli.phone as phone_cliente , tcli.email as email_cliente , tcli.zip as cep_cliente , 
tcli.street as endereco_cliente , tcli.number as num_cliente , tcli.neighbor as bairro_cliente , 
tcli.complemento as complemento_cliente , tcli.city as cidade_cliente , tcli.state_ as estado_cliente , tcli.nome_empresa , tcli.lat as lat_cliente , tcli.lon as lon_cliente , 
ps.geo_location, ps.signature, ps.signature_exec, ps.flow_approve, ps.image_require, ps.categoria , tl.descricao as desc_local 
FROM tb_booking b 
LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
LEFT JOIN tb_client pc on b.id_client = pc.id 
LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
LEFT JOIN tb_client tcli ON b.id_client = tcli.id 
LEFT JOIN tb_category tcba ON tca.category = tcba.id 
LEFT JOIN tb_local tl ON tl.id = tca.local 
LEFT JOIN tb_services ps ON ps.id = bd.service_name WHERE bd.id_booking  = :id ");
$db->bind(':id', $id);
$result = $db->resultset();
  



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
			$descricao = $row['descricao'];
			$id_ativo = $row['id_ativo'];
			$foto_ativo = $row['foto_ativo'];
			$short_dec = $row['short_dec'];
			$price_taxi = $row['price_taxi'];
			$pet_taxi = $row['pet_taxi'];
			$nome_cliente = $row['nome_cliente'];
			$category = $row['category'];
			$foto_quem_executou = $row['foto_quem_executou'];
			$nome_funcionario_exec = $row['nome_funcionario_exec'];

			if ($foto_cliente != ""){
				$foto_cliente = "images/upload/clientes/".$foto_cliente ;
			}else{
				$foto_cliente = "images/nouser.png" ;
			}
			
			if ($foto_quem_executou != ""){
				$foto_funcionario = "images/upload/funcionarios/".$foto_quem_executou ;
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
			} else if($row['status'] == "Concluído"){
				$color = '#18998d';
				$textColor = "#fff";
			} else {
				$color = '#0275d8';
				$textColor = "#FFF";
			}
			
			$tempo_realizado = $row['tempo_realizado'];
			$started_at = $row['started_at'];

			if($started_at == "0000-00-00 00:00:00"){
				$started_at = "-";
			} else {
				$started_at = $started_at;
			}
			
			$ended_at = $row['ended_at'];
			if($ended_at == "0000-00-00 00:00:00"){
				$ended_at = "-";
				$tempo_realizado = "-";
			} else {
				$ended_at = $ended_at;
				$tempo_realizado =  gmdate('H:i:s', $tempo_realizado);
			}


		
			$service_name = $row['service_name'];
			$preco = $row['price'];
			$time_block = $row['time_block'];
			$est_time = $row['est_time'];
			

			

			$response[] = array(
				"id"=>$id_evento,
				"title"=>$id_client.'-['.$descricao.' <b>'.$category.'</b> ] '.$pet_taxi_dum.'-'.$nome_cliente,
				"desc_service"=>$short_dec,
				"textColor"=> $textColor,
				"color"=>$color,
				'br_start'=>usa_to_br_date_time($row['start_date']),
				"start"=>$start_date,
				"end"=>$end_date,
				"termina"=>$end_date,
				"status_"=>$status,
				"id_client"=>$id_client,
				"nome_funcionario_exec"=>$nome_funcionario_exec,
				"started_at"=>$started_at,
				"ended_at"=>$ended_at,
				"preco"=>$preco,
				"info_extra"=>$info_extra,
				"time_block"=>$time_block,
				"quem_executou"=>$nome_funcionario,
				"produtos"=>'prod1',
				"nome_funcionario"=>$nome_funcionario,
				"endereco"=>$endereco,
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
				"descricao"=>$descricao,
				"price_taxi"=>$price_taxi,
				"category"=>$category,
				"id_quem_executou"=>$row['id_quem_executou'],
				"local_ativo"=>$row['desc_local'],
				"desc_ativo"=>$row['descricao'],
				"modelo_ativo"=>$row['modelo_ativo'],
				"capacidade_ativo"=>$row['capacidade_ativo'],
				"fabricante_ativo"=>$row['fabricante_ativo'],
				"register_ativo"=>$row['register_ativo'],
				"qrcode_ativo"=>$row['qrcode_ativo'],
				"lat_ativo"=>$row['lat_ativo'],
				"lon_ativo"=>$row['lon_ativo'],
				"tempo_realizado"=>$tempo_realizado,
				"cpf_funcionario"=>$row['cpf_funcionario'],
				"telefone_funcionario"=>$row['telefone_funcionario'],


			);

			$response['cliente'] = array(
				"name_client"=>$name_client,
				"foto_cliente"=>$foto_cliente,
				"signature"=>$row['signature'],
				"signature_exec"=>$row['signature_exec'],
				"flow_approve"=>$row['flow_approve'],
				"image_require"=>$row['image_require'],
				"categoria"=>$row['categoria'],
				"responsavel_cliente"=>$row['responsavel_cliente'],
				"phone_cliente"=>$row['phone_cliente'],
				"email_cliente"=>$row['email_cliente'], 
				"cep_cliente"=>$row['cep_cliente'], 
				"endereco_cliente"=>$row['endereco_cliente'], 
				"num_cliente"=>$row['num_cliente'], 
				"bairro_cliente"=>$row['bairro_cliente'], 
				"complemento_cliente"=>$row['complemento_cliente'], 
				"cidade_cliente"=>$row['cidade_cliente'], 
				"estado_cliente"=>$row['estado_cliente'], 
				"nome_empresa"=>$row['nome_empresa'], 
				"lat_cliente"=>$row['lat_cliente'],
				"lon_cliente"=>$row['lon_cliente'],
			
			);
			
			$response['config'] = array(
				"geo_location"=>$row['geo_location'],
				"signature"=>$row['signature'],
				"signature_exec"=>$row['signature_exec'],
				"flow_approve"=>$row['flow_approve'],
				"image_require"=>$row['image_require'],
				"categoria"=>$row['categoria'],
			
			);
		}

		
		
		$db->query('SELECT * from tb_companie'); 
		$db->execute();
		$result = $db->single(); 

		$foto_empresa = $result['foto'];
		if ($foto_empresa != ""){
			$foto_empresa = 'images/upload/empresa/'.$foto_empresa;
		}else{
			$foto_empresa = "assets/images/noimage.png" ;
		} 



		$response['empresa'] = array(
			"id"=>$result['id'],
			"nome_empresa"=>$result['nome_empresa'],
			"email"=>$result['email'],
			"phone"=>$result['phone'],
			"cep"=>$result['cep'],
			"endereco"=>$result['endereco'],
			"bairro"=>$result['bairro'],
			"number"=>$result['number'],
			"cidade"=>$result['cidade'],
			"estado"=>$result['estado'],
			"foto_empresa"=>$foto_empresa
		);

		$db->query("SELECT tt.name  , tt.email , tt.cpf , tt.rg , tt.type , ttq.desc_qual , ttq.numero_qual , tt.phone 
		FROM tb_team tt
		LEFT JOIN tb_team_qual ttq ON tt.id = ttq.id_func  
		WHERE tt.type2 = '1' AND ttq.desc_qual = 'CREA'"); 
		$db->execute();
		$resp_tec = $db->single(); 
		$response['resp_tecnico'] = $resp_tec;
		
		
		echo json_encode($response);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! E-mail ou Senha inválidos!";
		echo json_encode($arr);
	}


exit(0);

?>
