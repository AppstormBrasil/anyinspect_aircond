<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);
if(isset($_GET['IdUser'])){ $id = $_GET['IdUser'];} else { $id  = '';}
if(isset($_GET['type'])){ $type = $_GET['type'];} else { $type  = '';}
$id_cliente = $id;

//if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
//$id_cliente = $id;

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
				$foto_funcionario = "images/upload/funcionarios/".$foto_funcionario ;
			}else{
				$foto_funcionario = "images/nouser.png" ;
			}
			$dummy_func .= '<span><a target="_blank" href="funcionario-'.$row['id_funcionario'].'"><span><img class="avatar_table" src="'.$foto_funcionario.'" alt="Avatar" height="30" width="30"></a><span>'.$nome_funcionario.'</span></span>';
		}
	}
	
	return $dummy_func;

}

if($type == 'a' || $type == 'g' || $type == 'r' ){ 
	
	$db->query("SELECT bd.id_pet ,  tbteam.id as id_funcionario , tbteam.name as nome_funcionario , 
	tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, 
	pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
	bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
	bd.id_quem_executou as quem_executou, bd.endereco , 
	ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial , ps.est_time as est_time , 
	tca.id as id_ativo , tca.descricao as ativo , tca.foto as foto_ativo , bd.price_taxi , bd.pet_taxi , 
	pc.name as nome_cliente ,pc.nome_empresa ,  tcba.description as category , ps.id as id_form , b.id_group , 
	(SELECT COUNT(b.id_group) From tb_booking WHERE DATE(b.start_date) = CURDATE() AND b.status NOT IN('Deletado','Concluído')  GROUP BY b.id_group ) as total_groups
	FROM tb_booking b 
	LEFT JOIN tb_book_detail bd on b.id = bd.id_booking LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
	LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
	LEFT JOIN tb_client pc on b.id_client = pc.id 
	LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
	LEFT JOIN tb_category tcba ON tca.category = tcba.id 
	LEFT JOIN tb_services ps ON ps.id = bd.service_name
	WHERE DATE(b.start_date) = CURDATE() AND b.status NOT IN('Deletado','Concluído')  GROUP BY b.id_group ORDER BY b.start_date" ); 
	$db->execute();
	$result = $db->resultset(); 
} else {

	$db->query("SELECT bd.id_pet , tbteam.id as id_funcionario , tbteam.name as nome_funcionario , tbteam.foto as foto_funcionario , 
	b.id as bookingid, b.id_client, pc.name, pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, 
	bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, bd.id_quem_executou as quem_executou, bd.endereco , 
	ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial , ps.est_time as est_time , tca.id as id_ativo , 
	tca.descricao as ativo , tca.foto as foto_ativo , bd.price_taxi , bd.pet_taxi , pc.name as nome_cliente ,pc.nome_empresa , tcba.description as category , ps.id as id_form , 
	b.id_group ,  pbf.id_fun  , tbteam.name , (SELECT COUNT(b.id_group) 
	From tb_booking WHERE (bd.id_funcionario = :id OR tbteam.name = 'Todos' ) AND DATE(b.start_date) = CURDATE() AND b.status NOT IN('Deletado','Concluído') 
	GROUP BY b.id_group ) as total_groups 
	FROM tb_booking b 
	LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
	LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
	LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
	LEFT JOIN tb_book_func pbf ON bd.id_booking = bd.id 
	LEFT JOIN tb_client pc on b.id_client = pc.id 
	LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
	LEFT JOIN tb_category tcba ON tca.category = tcba.id 
	LEFT JOIN tb_services ps ON ps.id = bd.service_name 
	WHERE (bd.id_funcionario = :id OR tbteam.name = 'Todos' ) AND DATE(b.start_date) = CURDATE() AND b.status NOT IN('Deletado','Concluído') 
	GROUP BY b.id_group ORDER BY b.start_date" ); 
	$db->bind(':id', $id);
	$db->execute();
	$result = $db->resultset(); 


}


function get_total_grupo($id_group){
	$db = new db();
	$db->query("SELECT COUNT(b.id_group) as total_groups 
	From tb_booking b 
	WHERE DATE(b.start_date) = CURDATE() AND b.status NOT IN('Deletado') AND b.id_group = :id_group 
	GROUP BY b.id_group " );
	$db->bind(':id_group', $id_group);
	$db->execute();
	$result_ = $db->resultset(); 
	$total_groups = $result_[0]['total_groups'];
	return $total_groups;
}



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
		$foto_funcionario = $row['foto_funcionario'];
		$short_dec = $row['short_dec'];
		//$func_list = get_funcionarios($id_evento);
		//$Info_list = get_info_extra($id_evento);
		$Info_list = "";
		$foto_cliente = $row['foto_cliente'];
		$ativo = $row['ativo'];
		$id_ativo = $row['id_ativo'];
		$foto_ativo = $row['foto_ativo'];
		$short_dec = $row['short_dec'];
		$nome_cliente = $row['nome_empresa'];
		$category = $row['category'];
		$id_form = $row['id_form'];
		$id_group = $row['id_group'];
		$total_groups  = get_total_grupo($id_group);
		

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
		
		if ($foto_funcionario != ""){
			$foto_funcionario = prod_path."images/upload/funcionarios/".$foto_funcionario ;
		}else{
			$foto_funcionario = prod_path."images/nouser.png" ;
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
			"title"=>$id_client.'-['.$ativo.' <b>'.$category.'</b> ]' .$nome_cliente,
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
			//"preco"=>$preco,
			//"info_extra"=>$info_extra,
			//"time_block"=>$time_block,
			//"quem_executou"=>$nome_funcionario,
			//"produtos"=>'prod1',
			"nome_funcionario"=>$nome_funcionario,
			"endereco"=>$endereco,
			"foto_cliente"=>$foto_cliente,
			//"foto_funcionario"=>$foto_funcionario,
			//"foto_ativo"=>$foto_ativo,
			"id_funcionario"=>$id_funcionario,
			"start_dateReage" => $start_dateReage,
			"Info_list" => $Info_list,
			"resourceId" => $id_funcionario,
			"est_time" => $est_time,
			"id_ativo"=>$id_ativo,
			"ativo"=>$ativo,
			//"func_list"=>$func_list,
			"category"=>$category,
			"nome_cliente"=>$nome_cliente,
			"id_form"=>$id_form,
			"id_group"=>$id_group,
			"total_groups"=>$total_groups,
			
		);
	
		$i++;
	}

	
	$per = ($is_conc/$i) * 100; 
	$per = intval($per); 
	$response['per'] = $per;	
	$response['total_dia'] = $i;	
	$response['is_conc'] = $is_conc;	
	
	
	
	$response['status'] = "SUCCESS";	
	echo json_encode($response);
	exit(0);


} else {
	$response['status'] = "ERROR";
	$response['status_txt'] = "Erro! E-mail ou Senha inválidos!";
	echo json_encode($response);
}

 ?>