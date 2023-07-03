<?php 
 
include('../common/util.php'); 

$data_hoje = date("Y-m-d");
$data_hoje_br = date("d/m/Y");
$servicos_total = 0;
$servicos_finalizados = 0;
$map_only = "";
$map_txt = "";

if(isset($_GET['id_grupo'])){ $id_grupo = $_GET['id_grupo'];} else { $id_grupo  = '';}
$id_grupo = $id_grupo;

$db = new db(); 

$db->query("SELECT count(id) as count_id from tb_booking where id_group = :id_grupo  AND status <> 'Deletado'"); 
$db->bind(':id_grupo', $id_grupo);
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_hoje = $row["count_id"];
	}
	$response['servicos_hoje'] = $servicos_hoje;
}

$db->query("SELECT count(id) as count_id from tb_booking where id_group = :id_grupo "); 
$db->bind(':id_grupo', $id_grupo);
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_total = $row["count_id"];
	}
	$response['servicos_total'] = $servicos_total;
}

$db->query("SELECT count(id) as count_id from tb_booking where id_group = :id_grupo and status ='Pendente' AND status <> 'Deletado' ");
$db->bind(':id_grupo', $id_grupo); 
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_pendentes_hoje = $row["count_id"];
	}
	$response['servicos_pendentes_hoje'] = $servicos_pendentes_hoje;
}

$db->query("SELECT count(id) as count_id from tb_booking where id_group = :id_grupo and (status ='Finalizado' OR status ='Concluído') AND status <> 'Deletado'"); 
$db->bind(':id_grupo', $id_grupo);
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_finalizados = $row["count_id"];
	}
	$response['servicos_finalizados'] = $servicos_finalizados;
}

$db->query("SELECT count(id) as count_id from tb_booking where id_group = :id_grupo  and status ='Em Andamento' AND status <> 'Deletado'"); 
$db->bind(':id_grupo', $id_grupo);
$db->execute();
$result = $db->resultset(); 
if($result){
	foreach($result as $row) {
		$servicos_em_andamento = $row["count_id"];
	}
	$response['servicos_em_andamento'] = $servicos_em_andamento;
}


if($servicos_finalizados > 0){
	$per = ($servicos_finalizados/$servicos_total) * 100; 
	$per = intval($per); 
	$response['per'] = $per;
} else {
	$response['per'] = 0;
}



$db->query("SELECT COUNT(b.id) as atrasadas
FROM tb_booking b
WHERE id_group = :id_grupo
AND b.status NOT IN('Finalizado','Concluído')" ); 
$db->bind(':id_grupo', $id_grupo);
$db->execute();

$result = $db->resultset(); 
$i = 0;
$atrasadas = 0;
if($result){
	foreach($result as $row) {
		$atrasadas = $row['atrasadas'];
	}
}

$response['atrasadas'] = $atrasadas;

$db->query("SELECT tt.name as nome_funcionario , tt.foto as foto_funcionario , tt.id as id_funcionario , 
ts.short_dec as desc_atividade , ts.foto as foto_atividade ,  
 tl.cep, tl.endereco , tl.cidade , tl.estado , tl.bairro ,  tl.lat , tl.lon , tc.lat as lat_client, tc.lon as lon_client, tc.zip as zip_client, tc.street as street_client, 
tc.number as number_client, tc.neighbor as neighbor_client, tc.complemento as complemento_client, tc.city as city_client, tc.state_ as state_client, tc.nome_empresa
from tb_booking tb 
left join tb_book_detail tbd ON tb.id = tbd.id_booking
left join tb_client tc ON tc.id = tb.id_client  
left join tb_clients_ativo tca ON tca.id = tbd.id_pet 
left join tb_local tl ON tl.id = tca.local 
left join tb_team tt ON tt.id = tbd.id_funcionario 
left join tb_services ts ON ts.id = tbd.service_name 
where id_group = :id_grupo 
and tb.status  <> 'Deletado' "); 

$db->bind(':id_grupo', $id_grupo);
$db->execute();
$result_map = $db->resultset(); 
if($result_map){

	$map_only = array();
	$map_txt = array();
	$full_address = "";

	foreach($result_map as $row) {
		$lat = floatval($row["lat"]);
		$lon = floatval($row["lon"]);
		
		$lat_client = floatval($row["lat_client"]);
		$lon_client = floatval($row["lon_client"]);
		$zip_client = $row["zip_client"];
		$street_client = $row["street_client"];
		$number_client = $row["number_client"];
		$neighbor_client = $row["neighbor_client"];
		$complemento_client = $row["complemento_client"];
		$city_client = $row["city_client"];
		$state_client = $row["state_client"];
		$desc_atividade = $row["desc_atividade"];
		$nome_empresa = $row["nome_empresa"];



		if($lat == ''){
			$full_address = '<h4>'.$desc_atividade.'</h4><h5>'.$nome_empresa.'</h5>'.$street_client.'-'.$neighbor_client.'-'.$number_client.'-'.$city_client.'-'.$state_client.'-'.$zip_client;
			array_push($map_only, [$lat_client, $lon_client]);
			array_push($map_txt, [$full_address,$lat_client, $lon_client]);
		} else {

			
			array_push($map_only, [$lat, $lon]);
			array_push($map_txt, [$desc_atividade,$lat, $lon]);
		}

		//array_push($locations, $lat, $lon);

		

		

		//$response['map'][] = $lat.','.$lon;
		//$response['map'][] = $lon;
	}
	
}

//print_r($locations);

//array_push($location_final ,$locations);

$response['map_only'] = $map_only;
$response['map_txt'] = $map_txt;

	
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