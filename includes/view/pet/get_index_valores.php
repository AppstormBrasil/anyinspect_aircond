<?php 
 
include('../../common/util.php'); 

$data_hoje = date("Y-m-d");
$data_hoje_br = date("d/m/Y");

$db = new db(); 

$db->query("SELECT count(id) as count_id from pet_booking where start_date like '%$data_hoje%'"); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_hoje = $row["count_id"];
	}
	$response['servicos_hoje'] = $servicos_hoje;
}

$db->query("SELECT count(id) as count_id from pet_booking"); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_total = $row["count_id"];
	}
	$response['servicos_total'] = $servicos_total;
}

$db->query("SELECT count(id) as count_id from pet_booking where start_date like '%$data_hoje%' and status ='Pendente'"); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_pendentes_hoje = $row["count_id"];
	}
	$response['servicos_pendentes_hoje'] = $servicos_pendentes_hoje;
}

$db->query("SELECT count(id) as count_id from pet_booking where start_date like '%$data_hoje%' and status ='Finalizado'"); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_finalizados = $row["count_id"];
	}
	$response['servicos_finalizados'] = $servicos_finalizados;
}

$db->query("SELECT count(id) as count_id from pet_booking where start_date like '%$data_hoje%' and status ='Em Andamento'"); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_em_andamento = $row["count_id"];
	}
	$response['servicos_em_andamento'] = $servicos_em_andamento;
}

/*$db->query("SELECT count(id_client) as count_id FROM pet_booking WHERE start_date < DATE_SUB(NOW(), INTERVAL 30 DAY)"); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$clientes_30dias = $row["count_id"];
	}
	$response['clientes_30dias'] = $clientes_30dias;
} */

function get_users_this_month(){
	$db = new db();
	$current_month = date('m');
	$current_day = date('d');
	$current_year = date('Y');
	$prev_month = $current_month - 1;
	
	$db->query("SELECT pc.id 
				FROM pet_booking pb
				LEFT JOIN pet_client pc ON pb.id_client = pc.id
				WHERE ((MONTH(pb.start_date) = ".$current_month." ) AND YEAR(pb.start_date) = ".$current_year.")  
				GROUP BY pc.id
				ORDER BY DAY(pb.start_date)"); 

	$db->execute();
	$result = $db->resultset(); 
	$remove_id = "";
	if($result){
		foreach($result as $row) {
			$id = $row["id"];
			$remove_id .= $id;
			$remove_id .= ',';
		}
	}
	
	$remove_id = substr($remove_id,0,-1);
	
	return $remove_id;
	
}

$get_users_this_month = get_users_this_month();


function get_users_not_back($get_users_this_month){
	
	$db = new db();
	$current_month = date('m');
	$current_day = date('d');
	$current_year = date('Y');
	$prev_month = $current_month - 1;
	
	$db->query("SELECT pb.id
				FROM pet_booking pb
				LEFT JOIN pet_client pc ON pb.id_client = pc.id
				WHERE pc.id NOT IN(".$get_users_this_month.")
				group by pb.id_client"); 

	$db->execute();
	$result = $db->resultset(); 
	$remove_id = "";
	$i = 0;
	if($result){
		foreach($result as $row) {
			//$id += $row["id"];
			$i++;
		}
	}

	return $i;
	
}


$get_users_not_back = get_users_not_back($get_users_this_month);
$response['clientes_30dias'] = $get_users_not_back;

	
if($result){
	$response['status'] = 'SUCCESS';
	$response['data_hoje'] = $data_hoje_br;
	echo json_encode($response);
	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>