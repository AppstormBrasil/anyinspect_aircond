<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
if(isset($_GET['user_id'])){ $IdMorador = $_GET['user_id'];} else { $IdMorador  = '';}

if($id > 0){ 
    $db->query("SELECT tae.IdEnquete, tae.titulo_enquete, tae.descricao_enquete, tae.IdCondominio, tae.opc1 , tae.opc2 , tae.opc3 , tae.opc4, taer.IdMorador ,
	DATE_FORMAT(tae.data_start,'%d/%m/%Y %H:%i:%s') as data_start, 
	DATE_FORMAT(tae.data_end,'%d/%m/%Y %H:%i:%s') as data_end,
	DATE_FORMAT(tae.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro, 
	DATE_FORMAT(tae.data_envio,'%d/%m/%Y %H:%i:%s') as data_envio, 
	DATE_FORMAT(taer.data_resposta,'%d/%m/%Y %H:%i:%s') as data_resposta,
	taer.resposta , taer.status_leitura
	FROM tb_admin_enquete tae
	LEFT JOIN tb_admin_enquete_resp taer ON taer.IdEnquete = tae.IdEnquete
	WHERE tae.IdEnquete = ".$id." AND taer.IdMorador = ".$IdMorador."
	");
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 
	  $someArray = [];
	 foreach($result as $row) {
		$IdCondominio = $row["IdCondominio"];
		$IdEnquete = $row["IdEnquete"];
		$IdMorador = $row["IdMorador"];
		$status_leitura = $row["status_leitura"];
		$resposta = $row["resposta"];
		$status_check1 = "";
		$status_check2 = "";
		$status_check3 = "";
		$status_check4 = "";
		
		if($resposta != ''){
			
			if($row['opc1'] == $resposta){
				$status_check1 = 'Checked';
			} else {
				$status_check1 = 'Disabled';
			}
			
			if($row['opc2'] == $resposta){
				$status_check2 = 'Checked';
			} else {
				$status_check2 = 'Disabled';
			}
			if($row['opc3'] == $resposta){
				$status_check3 = 'Checked';
			} else {
				$status_check3 = 'Disabled';
			}
			if($row['opc4'] == $resposta){
				$status_check4 = 'Checked';
			} else {
				$status_check4 = 'Disabled';
			}

		}

		array_push($someArray, [
		'IdEnquete'   => $row['IdEnquete'],
		'IdCondominio'   => $row['IdCondominio'],
		'titulo_enquete'   => $row['titulo_enquete'],
		'descricao_enquete'   => $row['descricao_enquete'],
		'data_start' => $row['data_start'],
		'data_envio' => $row['data_envio'],
		'data_end' => $row['data_end'],
		'opc1' => $row['opc1'],
		'opc2' => $row['opc2'],
		'opc3' => $row['opc3'],
		'opc4' => $row['opc4'],
		'data_resposta' => $row['data_resposta'],
		'resposta' => $row['resposta'],
		'status_check1' => $status_check1,
		'status_check2' => $status_check2,
		'status_check3' => $status_check3,
		'status_check4' => $status_check4
		]);
		
	 } 
	 	 echo json_encode($someArray);
		 
		 if($status_leitura == 0){
			$db->query('UPDATE tb_admin_enquete_resp SET data_leitura = :data_leitura , status_leitura = :status_leitura WHERE IdEnquete = :IdEnquete AND IdMorador = :IdMorador ');
			$db->bind(':data_leitura', $created_at); 
			$db->bind(':status_leitura', 1); 
			$db->bind(':IdEnquete', $id);
			$db->bind(':IdMorador', $IdMorador); 		 
			$db->execute();
			exit(0);
			 
		 }
		 
	 	 exit(0);
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel';
	 	 echo json_encode($arr);
	 	 } 
?>