<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT pb.id as id_book , pt.comission , pbd.id_quem_executou , ps.id as id_servico, 
ps.short_dec ,  pb.status , pb.id_client , pc.name as nome_cliente  , pc.foto as foto_cliente , 
pb.start_date as started_at , pb.end_date as ended_at , pbd.service_name ,pbd.price , 
round(((pbd.price * pt.comission) /100 ) ,2) as total_comission ,   pbd.info_extra ,  
pt.id as id_funcionario ,  pt.name as nome_funcionario , pt.foto as foto_funcionario , 
pb.forma_pagamento , pb.status_pagamento , pcp.id as id_bolt , pcp.name_bolt as pet_name , pcp.foto as foto_bolt , pbd.price_taxi , pbd.pet_taxi 
FROM tb_booking pb
LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id 
LEFT JOIN tb_client pc ON pb.id_client = pc.id 
LEFT JOIN tb_clients_bolt pcp ON pbd.id_pet = pcp.id 
LEFT JOIN tb_services ps ON ps.id = pbd.service_name 
LEFT JOIN tb_team pt ON pt.id = pbd.id_quem_executou "); 

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
		$forma_pagamento = $row['forma_pagamento'];
		$status_pagamento = $row['status_pagamento'];
		$id_book = $row['id_book'];
		$pet_name = $row['pet_name'];
		$id_bolt = $row['id_bolt'];
		$foto_bolt = $row['foto_bolt'];

		
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

		$foto_cliente = $row['foto_cliente'];
		if ($foto_cliente != ""){
		   $foto_cliente = 'images/upload/clientes/'.$foto_cliente;
		}else{
		   $foto_cliente = "assets/images/nouser.png" ;
		} 

		if ($foto_funcionario != ""){
			$foto_funcionario = "images/upload/funcionarios/".$foto_funcionario ;
		}else{
			$foto_funcionario = "images/nouser.png" ;
		}

		if ($foto_bolt != ""){
			$foto_bolt = "images/upload/barcos/".$foto_bolt ;
		}else{
			$foto_bolt = "images/nouser.png" ;
		}

		$pet_taxi = $row['pet_taxi'];

		if($pet_taxi == 1){
			$pet_taxi = 'Sim';
			$price_taxi = 'R$'.$row['price_taxi'];

			$price_total = $row['price_taxi'] + $row['price'];

		} else {
			$pet_taxi = 'Não';
			$price_taxi = 'N/A';
			$price_total = $row['price_taxi'] + $row['price'];
		}

		

		$response['data'][] = array(
			"id_book"=>$row['id_book'],
			"id_servico"=>$row['id_servico'],
			"short_dec"=>$row['short_dec'],
			"status"=>$row['status'],
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"started_at"=>usa_to_br_date_time($row['started_at']),
			"ended_at"=>usa_to_br_date_time($row['ended_at']),
			//"started_at"=>usa_to_br_date_time($row['started_at']),
			//"ended_at"=>usa_to_br_date_time($row['ended_at']),
			"service_name"=>$row['service_name'],
			"price"=>$row['price'],
			"total_comission"=>$row['total_comission'],
			"info_extra"=>$row['info_extra'],
			"background"=>$color,
			"color"=>$textColor,
			"foto_cliente"=>$foto_cliente,
			"nome_funcionario"=>$nome_funcionario,
			"foto_funcionario"=>$foto_funcionario,
			"id_funcionario"=>$id_funcionario,
			"forma_pagamento"=>$forma_pagamento,
			"status_pagamento"=>$status_pagamento,
			"foto_bolt"=>$foto_bolt,
			"pet_name"=>$pet_name,
			"id_bolt"=>$id_bolt,
			"price_total"=>$price_total,
			"pet_taxi"=>$pet_taxi,
			"price_taxi"=>$price_taxi,
		);
	 } 
	 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $response['status'] = 'ERROR'; 
	 	 $response['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($response);
	 	 } 

 ?>