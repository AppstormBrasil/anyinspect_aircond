<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT pb.id , pbd.id_quem_executou , ps.id as id_servico, ps.short_dec ,  pb.status , pb.id_client , 
tc.name as nome_cliente  , tc.foto as foto_cliente , tc.id as id_pe ,
DATE_FORMAT(pbd.started_at ,'%d/%m/%Y %H:%i:%s') as started_at , 
DATE_FORMAT(pbd.ended_at ,'%d/%m/%Y %H:%i:%s') as ended_at , 
DATE_FORMAT(pb.start_date ,'%d/%m/%Y %H:%i:%s') as inicio_service , 
pbd.service_name , pbd.info_extra , pbd.price as volor_servico , 
pc.comission as total_comission, 
ps.price , tts.comission , round((tts.comission * pbd.price)/100,2) as comissao_funcionario , concat('R$ ', format((tts.comission * pbd.price)/100, 2)) as valor_pagar ,
TIME_TO_SEC(TIMEDIFF(pbd.ended_at,pbd.started_at)) as total_gasto
FROM tb_book_detail pbd
LEFT JOIN tb_booking pb ON pb.id = pbd.id_booking
LEFT JOIN tb_services ps ON ps.id = pbd.service_name
LEFT JOIN tb_team pt ON pt.id = pbd.id_funcionario
LEFT JOIN tb_book_func pbf ON pbf.id_booking = pb.id
LEFT JOIN tb_comission pc ON pc.id_func = pbf.id_fun 
LEFT JOIN tb_team_service tts on tts.id_service = pbd.service_name
LEFT JOIN tb_client tc ON pb.id_client = tc.id
WHERE pbf.id_fun = :id  
GROUP BY pb.id "); 
$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		$valor_pagar = $row['valor_pagar'];
		 $foto_cliente = $row['foto_cliente'];
		 $ended_at = $row['ended_at'];
		 $started_at = $row['started_at'];
	 	$status = $row['status'];
		 if ($foto_cliente != ""){
			$foto_cliente = 'images/upload/clientes/'.$foto_cliente;
		 }else{
			$foto_cliente = "assets/images/nouser.png" ;
		 } 		 
		 if($status == 'Finalizado'){
			if($valor_pagar != ""){
				$valor_pagar = $valor_pagar;
			 } else {
				$valor_pagar = 0;
			 }
		 } else {
			$valor_pagar = 0;
		 }

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
		$response[] = array(
			"id_servico"=>$row['id_servico'],
			"short_dec"=>$row['short_dec'],
			"status"=>$row['status'],
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"foto_cliente"=>$foto_cliente,
			"started_at"=>$started_at,
			"ended_at"=>$ended_at,
			"service_name"=>$row['service_name'],
			"price"=>$row['price'],
			"total_comission"=>$valor_pagar,
			"info_extra"=>$row['info_extra'],
			"inicio_service"=>$row['inicio_service'],
			"hora_total_gasto"=>$hora_total_gasto
		);
	 } 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>