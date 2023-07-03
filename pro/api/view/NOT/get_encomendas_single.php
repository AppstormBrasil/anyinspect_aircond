<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

if($id > 0){ 
    $db->query("SELECT IdPost, IdMorador, retirado_por, descricao,
      DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_retirada,'%d/%m/%Y %H:%i:%s') as data_retirada,
      status,qr_code_post
      from tb_post
      WHERE IdPost = ".$id."
	");
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 
	  $someArray = [];
	 foreach($result as $row) {
		$descricao = $row['descricao'];
		$descricao = substr($descricao, 0, 33);
		$my_size = strlen($descricao);
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
		'status' => $row['status'],
		'message_type' => 'message_type_gray',
		'cm_bg' => 'cm-bg-grey',
		'first_char' => $first_char,
		'id' => $i
		]);
	 
		
	 } 
	 	 echo json_encode($someArray);
		 
	
		 
	 	 exit(0);
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel';
	 	 echo json_encode($arr);
	 	 }
?>