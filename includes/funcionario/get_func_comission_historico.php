<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$date = date("Y-m");
$date2 = date("m-Y");

$db = new db(); 

$db->query("SELECT pc.comission, pt.name , pt.foto as foto_funcionario , pt.id as id_funcionario , ps.* , DATE_FORMAT( pbd.ended_at ,'%d/%m/%Y') as ended_at , pb.status
FROM tb_comission pc 
LEFT JOIN tb_team pt ON pc.id_func = pt.id
LEFT JOIN tb_book_detail pbd ON pc.id_booking = pbd.id_booking
LEFT JOIN tb_booking pb ON pb.id = pbd.id_booking
LEFT JOIN tb_services ps ON ps.id = pbd.service_name "); 

 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$funcionario = $row["name"];
		$comission = $row["comission"];
		$id_funcionario = $row["id_funcionario"];
		$short_dec = $row["short_dec"];
		$status = $row["status"];
		$ended_at = $row["ended_at"];

		$foto_funcionario = $row['foto_funcionario'];
		if ($foto_funcionario != ""){
		   $foto_funcionario = 'images/upload/funcionarios/'.$foto_funcionario;
		}else{
		   $foto_funcionario = "images/nouser.png" ;
		} 


		if($row['status'] == "Pendente"){
			$color = '#efefef';
			$textColor = "#111";
		} else if($row['status'] == "Em Andamento"){
			$color = '#f1c951';
			$textColor = "#111";
		} else if($row['status'] == "Finalizado"){
			$color = '#18998d';
			$textColor = "#fff";
		} else if($row['status'] == "Cancelado"){
			$color = '#F44336';
			$textColor = "#fff";
		} else {
			$color = '#0275d8';
			$textColor = "#FFF";
		}

		$response['data'][] = array(
			"funcionario"=>$funcionario,
			"id_funcionario"=>$id_funcionario,
			"comission"=>$comission,
			"foto"=>$foto_funcionario,
			"short_dec"=>$short_dec,
			"date2"=>$date2,
			"ended_at"=>$ended_at,
			"background"=>$color,
			"color"=>$textColor,
			"status"=>$status
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
		   $arr['status'] = 'ERROR'; 
		   $arr['data'] = [];
	 	   $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>