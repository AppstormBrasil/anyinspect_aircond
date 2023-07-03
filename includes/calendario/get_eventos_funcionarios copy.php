<?php

  include('../common/util.php');

  $db = new db(); 
  $extra_where = "";
  if(isset($_GET["lista_funcionario"])){
		$lista_funcionario = $_GET["lista_funcionario"];
		
		$extra_where .= ' WHERE ';
		foreach($lista_funcionario as $row) {
			
			$extra_where .= ' FIND_IN_SET('.$row.', bd.id_funcionario) OR ';
		}

		$extra_where = substr($extra_where,0,-3);
	
	} else {
	$has_func = "";  
  }

    function get_info_extra($id_evento){
	$dummy_info = "";
	$db = new db(); 		
	$db->query("SELECT tbc.Info_adicional as Info_adicional
		FROM tb_info_adicional_service tbc 
		WHERE tbc.id_booking = ".$id_evento." ");
	$result = $db->resultset();
	$response = array();
	if($result){
		foreach($result as $row) {
			$Info_adicional = utf8_decode($row['Info_adicional']);
			$dummy_info .= '<span  class="text-pale-sky">'.$Info_adicional.'</span><br>';
		}
	}
	return $dummy_info;
}
 
  function get_funcionarios($id_evento){
	$dummy_func = "";
	$db = new db(); 		
	$db->query("SELECT tbt.id as id_funcionario , tbt.name as nome_funcionario , 
		tbt.foto as foto_funcionario
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
				$foto_funcionario = "images/pet/upload/funcionarios/".$foto_funcionario ;
			}else{
				$foto_funcionario = "images/nouser.png" ;
			}
			$dummy_func .= '<span><a target="_blank" href="funcionario-'.$row['id_funcionario'].'"><span><img class="avatar_table" src="'.$foto_funcionario.'" alt="Avatar" height="30" width="30"></a><span>'.$nome_funcionario.'</span></span>';
		}
	}
	
	return $dummy_func;

}

 $db->query("SELECT tbteam.id as id_funcionario , tbteam.name as nome_funcionario , tbteam.foto as foto_funcionario , b.id as bookingid, b.id_client, pc.name, pc.foto as foto_cliente, b.start_date, b.end_date, b.status, bd.started_at, bd.ended_at, bd.service_name, bd.price, bd.info_extra, bd.time_block, bd.id_quem_executou as quem_executou, bd.endereco , ps.short_dec, DATE_FORMAT(b.start_date ,'%d/%m/%Y') as date_reage_inicial
  
  FROM tb_booking b 
  LEFT JOIN tb_book_detail bd on b.id = bd.id_booking 
  LEFT JOIN tb_team tbt on bd.id_quem_executou = tbt.id
  LEFT JOIN tb_team tbteam on bd.id_funcionario = tbteam.id
  LEFT JOIN tb_client pc on b.id_client = pc.id
  LEFT JOIN tb_services ps ON ps.id = bd.service_name
  ".$extra_where." ");

  $result = $db->resultset();

  //print_r($result);
  
  $response = array();
  
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
			$endereco = utf8_encode($row['endereco']);
			$info_extra = utf8_encode($row['info_extra']);
			$id_funcionario = $row['id_funcionario'];
			$nome_funcionario = $row['nome_funcionario'];
			$foto_funcionario = $row['foto_funcionario'];
			$short_dec = $row['short_dec'];
			$func_list = get_funcionarios($id_evento);
			$Info_list = get_info_extra($id_evento);
			$foto_cliente = $row['foto_cliente'];

			if ($foto_cliente != ""){
				$foto_cliente = "images/pet/upload/clientes/".$foto_cliente ;
			}else{
				$foto_cliente = "images/nouser.png" ;
			}
			
			if ($foto_funcionario != ""){
				$foto_funcionario = "images/pet/upload/funcionarios/".$foto_funcionario ;
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
			} else {
				$color = '#0275d8';
				$textColor = "#FFF";
			}
			
			
			$started_at = $row['started_at'];
			$ended_at = $row['ended_at'];
			$service_name = $row['service_name'];
			$preco = $row['price'];
			$time_block = $row['time_block'];

			$response[] = array(
				"id"=>$id_evento,
				"title"=>$short_dec ,
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
				"preco"=>$preco,
				"info_extra"=>$info_extra,
				"time_block"=>$time_block,
				"quem_executou"=>$quem_executou,
				"produtos"=>'prod1',
				"nome_funcionario"=>$nome_funcionario,
				"endereco"=>$endereco,
				"foto_cliente"=>$foto_cliente,
				"foto_funcionario"=>$foto_funcionario,
				"id_funcionario"=>$id_funcionario,
				"start_dateReage" => $start_dateReage,
				"func_list"=>$func_list,
				"Info_list" => $Info_list,
				"resourceId" => $id_funcionario,


			);
		}

			
		echo json_encode($response);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! E-mail ou Senha inválidos!";
		echo json_encode($arr);
	}

	


exit(0);

?>
