<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$someArray = [];
if($id > 0){ 
 	 $db->query("SELECT IdPost, IdMorador, retirado_por, descricao,
      DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_retirada,'%d/%m/%Y %H:%i:%s') as data_retirada,
      status,qr_code_post
      from tb_post
      WHERE IdMorador ='$id' ORDER BY data_cadastro DESC"); 
 } else { 
  	  echo json_encode($someArray);
	 exit(0);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 
	
	 foreach ($result as $row) {
		$descricao = $row['descricao'];
		$descricao = substr($descricao, 0, 33);
		$my_size = strlen($descricao);
		
		$status_retirada = $row['status'];
		$status = $row['status'];
		if($status_retirada == 1 ){
			$status_retirada = 'Aguardando Retirada';
			$cm_bg = 'cm-bg-red';
		} else if($status_retirada == 2 ){
			$status_retirada = 'Retirado';
			$cm_bg = 'cm-bg-green';
		} else {
			$status_retirada = 'Aguardando Retirado';
			$cm_bg = 'cm-bg-gray';
		}
		
		if($my_size > 30){
			$descricao = substr($descricao, 0, 33)."...";
		}
		if($descricao != ''){
			$first_char = substr($descricao, 0, 1);
		} else {
			$first_char = 'O';
		}
		array_push($someArray, [
		'IdMorador'   => $row['IdMorador'],
		'IdPost'   => $row['IdPost'],
		'retirado_por'   => $row['retirado_por'],
		'qr_code_post' => $row['qr_code_post'],
		'descricao' => $descricao,
		'data_envio' => $row['data_envio'],
		'data_retirada' => $row['data_retirada'],
		'status' => $status,
		'message_type' => $status_retirada,
		'cm_bg' => 'cm-bg-gray',
		'first_char' => $first_char,
		'id' => $i
		]);
	
		$i++;
	}
	
		 echo json_encode($someArray);
	 	 exit(0);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>