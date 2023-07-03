<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT ps.id as id_servico, ps.short_dec ,  pb.status , pb.id_client , pc.name as nome_cliente  , pc.foto as foto_cliente , 
DATE_FORMAT(pbd.started_at ,'%d/%m/%Y %H:%i:%s') as started_at , 
DATE_FORMAT(pbd.ended_at ,'%d/%m/%Y %H:%i:%s') as ended_at , 
DATE_FORMAT(pb.start_date ,'%d/%m/%Y %H:%i:%s') as start_date , pb.id as id_book , 
pbd.service_name , pbd.price , pbd.info_extra ,  pb.forma_pagamento , tcb.descricao , tcb.foto as foto_ativo , tcb.qrcode , pb.id_group , 
DATE_FORMAT(pb.start_date,'%d/%m/%Y %H:%i:%s' ) as inicio_service , TIME_TO_SEC(TIMEDIFF(pbd.ended_at,pbd.started_at)) as total_gasto , tcb.id as id_ativo , ta.iata 
FROM tb_booking pb
LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id 
LEFT JOIN tb_client pc ON pb.id_client = pc.id  
LEFT JOIN tb_clients_ativo tcb ON tcb.id = pbd.id_pet  
LEFT JOIN tb_aeroportos ta ON ta.id = pbd.aeroporto  
LEFT JOIN tb_services ps ON ps.id = pbd.service_name WHERE pc.id = :id AND pb.status <> 'Deletado' GROUP BY pb.id"); 
$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 $foto_cliente = $row['foto_cliente'];
		 $descricao = $row['descricao'];
		 $foto_ativo = $row['foto_ativo'];

		 if ($foto_ativo != ""){
			$foto_ativo = 'images/upload/ativos/'.$foto_ativo;
		 }else{
			$foto_ativo = "assets/images/noimage.png" ;
		 } 
		 
		 
		 if ($foto_cliente != ""){
			$foto_cliente = 'images/upload/clientes/'.$foto_cliente;
		 }else{
			$foto_cliente = "assets/images/nouser.png" ;
		 } 

		 $started_at = $row['started_at'];
		 $ended_at = $row['ended_at'];
		 
		 if($started_at == '00/00/0000 00:00:00'){
			$started_at = '';
		 } else {
			$started_at = $started_at; 
		 }
		 
		 if($ended_at == '00/00/0000 00:00:00'){
			$ended_at = '';
			$hora_total_gasto = '';
		 } else {
			$ended_at = $ended_at; 
			$hora_total_gasto =  gmdate('H:i:s', $row["total_gasto"]);
		 }

		$response['data'][] = array(
			"id_servico"=>$row['id_servico'],
			"id_book"=>$row['id_book'],
			"short_dec"=>$row['short_dec'],
			"status"=>$row['status'],
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"foto_ativo"=>$foto_ativo,
			"started_at"=>$started_at,
			"ended_at"=>$ended_at,
			"service_name"=>$row['service_name'],
			"price"=>$row['price'],
			"info_extra"=>$row['info_extra'],
			"start_date"=>$row['start_date'],
			"status_pagamento"=>$row['forma_pagamento'],
			"descricao"=>$row['descricao'] ,
			"inicio_service"=>$row['inicio_service'],
			"qrcode"=>$row['qrcode'],
			"id_group"=>$row['id_group'],
			"id_ativo"=>$row['id_ativo'],
			"aeroporto"=>$row['iata'],
			"hora_total_gasto"=>$hora_total_gasto
		);
	 } 
		  
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
		 $arr['data'] = [];
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>