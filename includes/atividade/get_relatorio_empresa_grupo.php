<?php

  include('../common/util.php');


//$IdEvento = $_POST['IdEvento'];

$database = new db();
$id_grupo = $_POST['id_grupo'];


$database->query("SELECT bd.id_pet , tbteam.id as id_funcionario , tbteam.name as nome_funcionario , tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, 
pc.name, pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
bd.id_quem_executou as quem_executou, bd.endereco , ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial , ps.est_time as est_time , 
tca.id as id_ativo , tca.descricao as ativo , tca.foto as foto_ativo ,  pc.nome_empresa as nome_cliente , 
tcba.description as category , tca.qrcode ,tl.descricao as local_ativo , ps.id as id_form , tca.tipo as tipo_ativo ,  tl.tipo, tl.num_fixo, tl.num_flutuante, tl.area_climatizada, tl.carga_termica   
FROM tb_booking b 
LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
LEFT JOIN tb_client pc on b.id_client = pc.id 
LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
LEFT JOIN tb_category tcba ON tca.category = tcba.id 
LEFT JOIN tb_services ps ON ps.id = bd.service_name 
LEFT JOIN tb_local tl ON tl.id = tca.local 
WHERE b.status <> 'Deletado' AND b.id_group = :id_group ORDER BY b.start_date" ); 
$database->bind(':id_group', $id_grupo);
  $result = $database->resultset();
	if($result){
		$i = 0;

		foreach($result as $row) {
			$arr['data'][$i] = $row;
			$i++;

		}
		
		$database->query("SELECT b.id_group , bd.id as id_atividade , ps.id as formID 
		FROM tb_booking b 
		LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
		LEFT JOIN tb_services ps ON ps.id = bd.service_name
		WHERE b.status <> 'Deletado' AND b.id_group = :id_group ORDER BY b.start_date" ); 
		$database->bind(':id_group', $id_grupo);
		$result_all = $database->resultset();
		
		$arr['result_all'] = $result_all;
		
		$arr['status'] = "SUCCESS";
		echo json_encode($arr);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! Nenhuma informacao!";
		echo json_encode($arr);
	}


exit(0);

?>
