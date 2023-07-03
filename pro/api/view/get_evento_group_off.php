<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
//$_GET = json_decode(file_get_contents('php://input'), true);
if(isset($_GET['IdUser'])){ $id = $_GET['IdUser'];} else { $id  = '';}
if(isset($_GET['type'])){ $type = $_GET['type'];} else { $type  = '';}
//if(isset($_GET['id_group'])){ $id_group = $_GET['id_group'];} else { $id_group  = '';}
$id_cliente = $id;

//if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
//$id_cliente = $id;

$db = new db(); 

$db->query("SELECT bd.id_pet ,  tbteam.id as id_funcionario , tbteam.name as nome_funcionario , 
tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, 
pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
bd.id_quem_executou as quem_executou, bd.endereco , 
ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial , ps.est_time as est_time , 
tca.id as id_ativo , tca.descricao as ativo , tca.foto as foto_ativo , bd.price_taxi , bd.pet_taxi , 
pc.name as nome_cliente ,pc.nome_empresa ,  tcba.description as category , ps.id as id_form , b.id_group , tca.qrcode , pc.phone as phone_cliente , pc.email as email_cliente , pc.zip as cep_cliente , 
pc.street as endereco_cliente , pc.number as num_cliente , pc.neighbor as bairro_cliente , 
pc.complemento as complemento_cliente , pc.city as cidade_cliente , pc.state_ as estado_cliente 
FROM tb_booking b 
LEFT JOIN tb_book_detail bd on b.id = bd.id_booking LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
LEFT JOIN tb_client pc on b.id_client = pc.id 
LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
LEFT JOIN tb_category tcba ON tca.category = tcba.id 
LEFT JOIN tb_services ps ON ps.id = bd.service_name
WHERE b.status NOT IN('Deletado' , 'Concluído')  ORDER BY b.start_date" ); 
//$db->bind(':id_grupo', $id_group);
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
$i = 0;
$is_conc = 0;

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
		$short_dec = $row['short_dec'];
		$foto_cliente = $row['foto_cliente'];
		$ativo = $row['ativo'];
		$id_ativo = $row['id_ativo'];
		$foto_ativo = $row['foto_ativo'];
		$short_dec = $row['short_dec'];
		$nome_cliente = $row['nome_empresa'];
		$category = $row['category'];
		$id_form = $row['id_form'];
		$id_group = $row['id_group'];
		$qrcode = $row['qrcode'];
	

		if($id_ativo == 0){
			$ativo = 'N/A';
			$foto_ativo = '';
		} else {
			if ($foto_ativo != ""){
				$foto_ativo = prod_path."images/upload/ativos/".$foto_ativo ;
			}else{
				$foto_ativo = prod_path."images/noimage.png" ;
			}
		}

		if ($foto_cliente != ""){
			$foto_cliente = prod_path."images/upload/clientes/".$foto_cliente ;
		}else{
			$foto_cliente = prod_path."images/nouser.png" ;
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
			$is_conc ++;
		} else if($row['status'] == "Deletado"){
			$color = '#0e0e0e';
			$textColor = "#fff";
		} else if($row['status'] == "Concluído"){
			$color = '#8bc34a';
			$textColor = "#fff";
			$is_conc ++;
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

		$response['data'][] = array(
			"id"=>$id_evento,
			"desc_service"=>$short_dec,
			"textColor"=> $textColor,
			"color"=>$color,
			'br_start'=>usa_to_br_date_time($row['start_date']),
			"status_"=>$status,
			"id_client"=>$id_client,
			"name_client"=>$name_client,
			"nome_funcionario"=>$nome_funcionario,
			"endereco"=>$endereco,
			"foto_cliente"=>$foto_cliente,
			"id_funcionario"=>$id_funcionario,
			"id_ativo"=>$id_ativo,
			"ativo"=>$ativo,
			"nome_cliente"=>$nome_cliente,
			"id_form"=>$id_form,
			"qrcode"=>$qrcode,
			"phone_cliente"=>$row['phone_cliente'],
			"email_cliente"=>$row['email_cliente'], 
			"cep_cliente"=>$row['cep_cliente'], 
			"endereco_cliente"=>$row['endereco_cliente'], 
			"num_cliente"=>$row['num_cliente'], 
			"bairro_cliente"=>$row['bairro_cliente'], 
			"complemento_cliente"=>$row['complemento_cliente'], 
			"cidade_cliente"=>$row['cidade_cliente'], 
			"estado_cliente"=>$row['estado_cliente'], 
			"id_group"=>$row['id_group'], 

			
		);
	
		$i++;
	}

	
	//$per = ($is_conc/$i) * 100; 
	//$per = intval($per); 
	//$response['per'] = $per;	
	//$response['total_dia'] = $i;	
	//$response['is_conc'] = $is_conc;	
	
	
	
	//$response['status'] = "SUCCESS";	
	echo json_encode($response);
	exit(0);


} else {
	$response['status'] = "ERROR";
	$response['status_txt'] = "Erro! E-mail ou Senha inválidos!";
	echo json_encode($response);
}

 ?>