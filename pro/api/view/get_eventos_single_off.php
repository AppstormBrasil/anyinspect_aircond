<?php

  include('../common/util.php');
  //$_POST = json_decode(file_get_contents('php://input'), true);
  if(isset($_GET['IdUser'])){ $IdUser = $_GET['IdUser'];} else {$IdUser = '';}
  if(isset($_GET['type'])){ $type = $_GET['type'];} else {$type = '';}
  $db = new db(); 


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
				$foto_funcionario = prod_path."images/upload/funcionarios/".$foto_funcionario ;
			}else{
				$foto_funcionario = prod_path."images/nouser.png" ;
			}
			$dummy_func .= '<span><a target="_blank" href="funcionario-'.$row['id_funcionario'].'"><span><img class="avatar_table" src="'.$foto_funcionario.'" alt="Avatar" height="30" width="30"></a><span>'.$nome_funcionario.'</span></span>';
		}
	}
	
	return $dummy_func;

}

$db->query('SELECT * from tb_companie'); 
$db->execute();
$result_cliente = $db->single(); 

$foto_empresa = $result_cliente['foto'];
if ($foto_empresa != ""){
	$foto_empresa = prod_path.'images/upload/empresa/'.$foto_empresa;
}else{
	$foto_empresa = prod_path."assets/img/noimage.png" ;
} 


/*$response['data'][] = array(
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
); */

if($type == 'a' || $type == 'g' || $type == 'r' ){ 
	$db->query("SELECT bd.id_pet ,  tbteam.id as id_funcionario , tbteam.name as nome_funcionario , 
	tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, 
	pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
	bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
	bd.id_quem_executou as quem_executou, bd.endereco , 
	ps.short_dec, tbt.foto as foto_quem_executou , tbt.name as nome_funcionario_exec , tbt.id as id_quem_executou , 
	DATE_FORMAT(b.start_date ,'%d/%m/%Y %H:%i:%s') as date_reage_inicial , 
	DATE_FORMAT(bd.started_at ,'%d/%m/%Y %H:%i:%s') as started_at , 
	DATE_FORMAT(bd.ended_at ,'%d/%m/%Y %H:%i:%s') as ended_at , 
	ps.est_time as est_time , TIME_TO_SEC(TIMEDIFF(bd.ended_at,bd.started_at)) as tempo_realizado ,
	tca.id as id_ativo , tca.descricao , tca.foto as foto_ativo , bd.price_taxi , bd.pet_taxi , tca.local as local_ativo , tl.lat as lat_ativo , tl.lon as lon_ativo , 
	pc.name as nome_cliente , tcba.description as category , 
	tcli.name as responsavel_cliente  , tcli.phone as phone_cliente , tcli.email as email_cliente , tcli.zip as cep_cliente , 
	tcli.street as endereco_cliente , tcli.number as num_cliente , tcli.neighbor as bairro_cliente , 
	tcli.complemento as complemento_cliente , tcli.city as cidade_cliente , tcli.state_ as estado_cliente , tcli.nome_empresa as empresa_cliente , tcli.lat as lat_cliente , tcli.lon as lon_cliente , 
	ps.geo_location, ps.signature, ps.signature_exec, ps.flow_approve, ps.image_require, ps.categoria , ps.qr_check_in ,  ps.image_single  , 
	tl.descricao as desc_local , tca.qrcode ,bd.start_lat , bd.start_lon , bd.qr_checkin , bd.priority , b.id_group 
	FROM tb_booking b 
	LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
	LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
	LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
	LEFT JOIN tb_client pc on b.id_client = pc.id 
	LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
	LEFT JOIN tb_client tcli ON b.id_client = tcli.id 
	LEFT JOIN tb_category tcba ON tca.category = tcba.id 
	LEFT JOIN tb_local tl ON tl.id = tca.local 
	LEFT JOIN tb_services ps ON ps.id = bd.service_name WHERE  b.status NOT IN('Deletado','Concluído') ");
} else {
	$db->query("SELECT bd.id_pet ,  tbteam.id as id_funcionario , tbteam.name as nome_funcionario , 
	tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, 
	pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
	bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
	bd.id_quem_executou as quem_executou, bd.endereco , 
	ps.short_dec, tbt.foto as foto_quem_executou , tbt.name as nome_funcionario_exec , tbt.id as id_quem_executou , 
	DATE_FORMAT(b.start_date ,'%d/%m/%Y %H:%i:%s') as date_reage_inicial , 
	DATE_FORMAT(bd.started_at ,'%d/%m/%Y %H:%i:%s') as started_at , 
	DATE_FORMAT(bd.ended_at ,'%d/%m/%Y %H:%i:%s') as ended_at , 
	ps.est_time as est_time , TIME_TO_SEC(TIMEDIFF(bd.ended_at,bd.started_at)) as tempo_realizado ,
	tca.id as id_ativo , tca.descricao , tca.foto as foto_ativo , bd.price_taxi , bd.pet_taxi , tca.local as local_ativo , tl.lat as lat_ativo , tl.lon as lon_ativo , 
	pc.name as nome_cliente , tcba.description as category , 
	tcli.name as responsavel_cliente  , tcli.phone as phone_cliente , tcli.email as email_cliente , tcli.zip as cep_cliente , 
	tcli.street as endereco_cliente , tcli.number as num_cliente , tcli.neighbor as bairro_cliente , 
	tcli.complemento as complemento_cliente , tcli.city as cidade_cliente , tcli.state_ as estado_cliente , tcli.nome_empresa as empresa_cliente , tcli.lat as lat_cliente , tcli.lon as lon_cliente , 
	ps.geo_location, ps.signature, ps.signature_exec, ps.flow_approve, ps.image_require, ps.categoria , ps.qr_check_in ,  ps.image_single  , 
	tl.descricao as desc_local , tca.qrcode ,bd.start_lat , bd.start_lon , bd.qr_checkin , bd.priority , b.id_group 
	FROM tb_booking b 
	LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
	LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
	LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
	LEFT JOIN tb_client pc on b.id_client = pc.id 
	LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
	LEFT JOIN tb_client tcli ON b.id_client = tcli.id 
	LEFT JOIN tb_category tcba ON tca.category = tcba.id 
	LEFT JOIN tb_local tl ON tl.id = tca.local 
	LEFT JOIN tb_services ps ON ps.id = bd.service_name WHERE (bd.id_funcionario = :IdUser OR tbteam.name = 'Todos' ) AND b.status NOT IN('Deletado','Concluído') ");
	$db->bind(':IdUser', $IdUser);
}



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
			$info_extra = $row['info_extra'];
			$id_funcionario = $row['id_funcionario'];
			$nome_funcionario = $row['nome_funcionario'];
			$foto_funcionario = $row['foto_funcionario'];
			$short_dec = $row['short_dec'];
			$foto_cliente = $row['foto_cliente'];
			$descricao = $row['descricao'];
			$id_ativo = $row['id_ativo'];
			$short_dec = $row['short_dec'];
			$price_taxi = $row['price_taxi'];
			$pet_taxi = $row['pet_taxi'];
			$nome_cliente = $row['nome_cliente'];
			$category = $row['category'];
			$start_lat = $row['start_lat'];
			$start_lon = $row['start_lon'];
			$qr_checkin = $row['qr_checkin'];
			$priority = $row['priority'];
			$id_group = $row['id_group'];
			$est_time = $row['est_time'];

			if($priority == ""){
				$priority = 'Normal';
			} else {
				$priority = $priority;
			}

			if ($foto_cliente != ""){
				$foto_cliente = prod_path."images/upload/clientes/".$foto_cliente ;
			}else{
				$foto_cliente = prod_path."images/noimage.jpg" ;
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
			$service_name = $row['service_name'];

			$nome_empresa = $result_cliente['nome_empresa'];
			$email = $result_cliente['email'];
			$phone = $result_cliente['phone'];
			$cep = $result_cliente['cep'];
			$endereco = $result_cliente['endereco'];
			$bairro = $result_cliente['bairro'];
			$number = $result_cliente['number'];
			$cidade = $result_cliente['cidade'];
			$estado = $result_cliente['estado'];
			$foto_empresa = $foto_empresa;

	

			$response['data'][] = array(
				"id"=>$id_evento,
				"desc_service"=>$short_dec,
				"textColor"=> $textColor,
				"color"=>$color,
				'br_start'=>usa_to_br_date_time($row['start_date']),
				"status_"=>$status,
				"id_client"=>$id_client,
				"info_extra"=>$info_extra,
				"id_ativo"=>$id_ativo,
				"descricao"=>$descricao,
				"category"=>$category,
				"local_ativo"=>$row['desc_local'],
				"lat_ativo"=>$row['lat_ativo'],
				"lon_ativo"=>$row['lon_ativo'],
				"qrcode"=>$row['qrcode'],
				"id_form"=>$service_name,
				"start_lat"=>$start_lat,
				"start_lon"=>$start_lon,
				"qr_checkin"=>$qr_checkin,
				"priority"=>$priority,
				"id_group"=>$id_group,
				"est_time"=>$est_time,

				
				"foto_cliente"=>$foto_cliente,
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
				"nome_cliente"=>$row['nome_cliente'], 
				"lat_cliente"=>$row['lat_cliente'],
				"lon_cliente"=>$row['lon_cliente'],
				"empresa_cliente"=>$row['empresa_cliente'],

				"geo_location"=>$row['geo_location'],
				"signature"=>$row['signature'],
				"signature_exec"=>$row['signature_exec'],
				"flow_approve"=>$row['flow_approve'],
				"qr_check_in"=>$row['qr_check_in'],
				"image_require"=>$row['image_require'],
				"image_single"=>$row['image_single'],

				"nome_empresa"=>$nome_empresa,
				"email"=>$email,
				"phone"=>$phone,
				"cep"=>$cep,
				"endereco"=>$endereco,
				"bairro"=>$bairro,
				"number"=>$number,
				"cidade"=>$cidade,
				"estado"=>$estado,
				"foto_empresa"=>$foto_empresa


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
