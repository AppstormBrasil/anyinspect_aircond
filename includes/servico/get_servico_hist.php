<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT pt.comission , pbd.id_quem_executou , ps.id as id_servico, ps.short_dec ,  pb.status , 
	pb.id_client , pc.name as nome_cliente  , pc.foto as foto_cliente , pbd.started_at , pbd.ended_at , 
	pbd.service_name , pbd.price , round(((pbd.price * pt.comission) /100 ) ,2) as total_comission ,   
	pbd.info_extra , pt.id as id_funcionario ,  pt.name as nome_funcionario , pt.foto as foto_funcionario

FROM tb_booking pb
LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id 
LEFT JOIN tb_client pc ON pb.id_client = pc.id 
LEFT JOIN tb_services ps ON ps.id = pbd.service_name 
LEFT JOIN tb_team_service tts ON ps.id = tts.id_service 
LEFT JOIN tb_team pt ON pt.id = tts.id_team"); 

//$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$id_funcionario = $row["id_funcionario"];
		$nome_funcionario = $row["nome_funcionario"];
		$foto_funcionario = $row["foto_funcionario"];


		
		 if($row['status'] == "Pendente"){
			$color = '#efefef';
			$textColor = "#111";
		} else if($row['status'] == "Em Andamento"){
			$color = '#f1c951';
			$textColor = "#111";
		} else if($row['status'] == "Finalizado"){
			$color = '#18998d';
			$textColor = "#fff";
		}  else if($row['status'] == "Concluído"){
			$color = '#8bc34a';
			$textColor = "#fff";
		} else if($row['status'] == "Cancelado"){
			$color = '#F44336';
			$textColor = "#fff";
		} else {
			$color = '#0275d8';
			$textColor = "#FFF";
		}

		$foto_cliente = $row['foto_cliente'];
		if ($foto_cliente != ""){
		   $foto_cliente = 'images/pet/upload/clientes/'.$foto_cliente;
		}else{
		   $foto_cliente = "assets/images/nouser.png" ;
		} 

		if ($foto_funcionario != ""){
			$foto_funcionario = "images/pet/upload/funcionarios/".$foto_funcionario ;
		}else{
			$foto_funcionario = "images/nouser.png" ;
		}

		/*
		if ($foto_pet != ""){
			$foto_pet = "images/upload/pets/".$foto_pet ;
		}else{
			$foto_pet = "assets/images/nouser.png" ;
		}
		*/
		

		$response['data'][] = array(
			"id_servico"=>$row['id_servico'],
			"short_dec"=>$row['short_dec'],
			"status"=>$row['status'],
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"started_at"=>usa_to_br_date_time($row['started_at']),
			"ended_at"=>usa_to_br_date_time($row['ended_at']),
			"service_name"=>$row['service_name'],
			"price"=>$row['price'],
			"total_comission"=>$row['total_comission'],
			"info_extra"=>utf8_encode($row['info_extra']),
			"background"=>$color,
			"color"=>$textColor,
			"foto_cliente"=>$foto_cliente,
			"nome_funcionario"=>$nome_funcionario,
			"foto_funcionario"=>$foto_funcionario,
			"id_funcionario"=>$id_funcionario,
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