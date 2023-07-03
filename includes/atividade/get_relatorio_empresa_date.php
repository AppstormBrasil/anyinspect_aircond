<?php

  include('../common/util.php');


//$IdEvento = $_POST['IdEvento'];

$database = new db();
$id_client = $_POST['id_client'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

if(isset($_POST['start_date'])){ 
	$start_date = br_to_usa_month($_POST['start_date']);
} 
else {$start_date = '';

}

if(isset($_POST['end_date'])){ 
	$end_date = br_to_usa_month($_POST['end_date']);
} 
else {$end_date = '';

}

//$start_date = '2021-04-01';
//$end_date = '2021-04-15';


$database->query("SELECT bd.id_pet , tbteam.id as id_funcionario , tbteam.name as nome_funcionario , tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, 
pc.name, pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, 
bd.id_quem_executou as quem_executou, bd.endereco , ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial , ps.est_time as est_time , 
tca.id as id_ativo , tca.descricao as ativo , tca.foto as foto_ativo ,  pc.nome_empresa as nome_cliente , 
tcba.description as category , tca.qrcode ,tl.descricao as local_ativo , ps.id as id_form  
FROM tb_booking b 
LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id 
LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id 
LEFT JOIN tb_client pc on b.id_client = pc.id 
LEFT JOIN tb_clients_ativo tca ON bd.id_pet = tca.id 
LEFT JOIN tb_category tcba ON tca.category = tcba.id 
LEFT JOIN tb_services ps ON ps.id = bd.service_name 
LEFT JOIN tb_local tl ON tl.id = tca.local 
WHERE (DATE(b.start_date) BETWEEN '$start_date' AND '$end_date' ) AND b.status <> 'Deletado' AND b.id_client = :id_client GROUP BY b.id ORDER BY b.start_date" ); 
$database->bind(':id_client', $id_client);


  $result = $database->resultset();
	if($result){
		$i = 0;

		foreach($result as $row) {
			$arr['data'][$i] = $row;
			$i++;

		}
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
