<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

if($id > 0){ 
    $db->query("SELECT IdMensagem, IdMorador, mensagem, data_leitura as data_leituras,
      DATE_FORMAT(data_envio,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_leitura,'%d/%m/%Y %H:%i:%s') as data_leitura,
      status
      from tb_mensagem
      WHERE IdMensagem ='$id' "); 
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 
		$someArray = [];
		$data_leitura = "";

	 foreach ($result as $row ) {
		
		$mensagem = $row['mensagem'];
		$my_size = strlen($mensagem);
		$data_leitura = $row['data_leituras'];
		array_push($someArray, [
		'IdMensagem' => $row['IdMensagem'],
		'IdMorador'   => $row['IdMorador'],
		'mensagem'   => $mensagem,
		'data_envio' => $row['data_envio'],
		'imagem' => 'img/mail.png',
		'tipo_mensagem' => 'Mensagem',
		'link' => '#/mensagem/'.$row['IdMensagem'].'',
		'message_type' => 'message_type_red'
		]);
	}
			echo json_encode($someArray);
			

			if($data_leitura == '0000-00-00 00:00:00'){
				$db->query('UPDATE tb_mensagem SET data_leitura = :data_leitura, status = :status WHERE IdMensagem = :IdMensagem ');
				$db->bind(':data_leitura', $created_at); 
				$db->bind(':status', 1); 
				$db->bind(':IdMensagem', $id); 
				$db->execute();
			
			}
		
			
			
			
			exit(0);
	} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
		 exit(0);
	} 
?>