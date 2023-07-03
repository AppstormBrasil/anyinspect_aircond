<?php
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

$myArray = [];
$someArray = [];
$i = 1; 
if($id > 0){ 
	
	// GETTING ALL UNREAD COMUNICADOS

	$db->query("SELECT tact.titulo, tact.descricao, tact.IdCondominio, taec.IdComunicadoTemplate ,tact.imagem , tact.documento , taec.IdEnviaComunicado , 
	DATE_FORMAT(taec.data_envio,'%d/%m/%Y %H:%i:%s') as data_envio,
	DATE_FORMAT(taec.data_start,'%d/%m/%Y %H:%i:%s') as data_start, 
	DATE_FORMAT(taec.data_end,'%d/%m/%Y %H:%i:%s') as data_end , taec.status_morador
	FROM tb_admin_envia_comunicado taec
	LEFT JOIN tb_morador tm ON taec.IdMorador = tm.IdMorador
	LEFT JOIN tb_admin_comunicado_template tact ON tact.IdComunicadoTemplate = taec.IdComunicadoTemplate
	WHERE taec.IdMorador = ".$id." AND taec.status_morador = 0 ORDER BY taec.data_envio DESC ");
 } 
 
 
 $db->execute();
 $result = $db->resultset(); 
 $status_morador = "";
 $total_comunicado = 0;
 if($result){ 
	 foreach($result as $row) {
		$IdCondominio = $row["IdCondominio"];
		$IdComunicadoTemplate = $row["IdComunicadoTemplate"];
		$imagem = $row["imagem"];
		$documento = $row["documento"];

		$mensagem = $row['titulo'];
		$mensagem = substr($mensagem, 0, 33);
		$my_size = strlen($mensagem);
		if($my_size > 21){
			$mensagem = substr($mensagem, 0, 21)."...";
		}
		
		if($mensagem != ''){
			$first_char = substr($mensagem, 0, 1);
		} else {
			$first_char = 'C';
		}
		$status_morador = $row['status_morador'];
			 if($status_morador == 0){
				$font_weight = '600';
			} else{
				$font_weight = '300';
			}

		array_push($myArray, [
			'IdEnviaComunicado' => $row['IdEnviaComunicado'],
			'titulo' => $mensagem,
			'data_envio' => $row['data_envio'],
			'imagem' => $imagem,
			'tipo_mensagem' => 'Comunicado',
			'link' => '#/comunicado/'.$row['IdEnviaComunicado'].'',
			'message_type' => 'message_type_blue',
			'cm_bg' => 'cm-bg-grey',
			'first_char' => $first_char,
			'font_weight' => $font_weight,
			'id' => $i
			]);

			$total_comunicado =  $i;
		$i++;
		
	 } 
	 	 //echo json_encode($myArray);
	 	 //exit(0);
} else { 
	//$myArray = [];

}

  // GETTING ALL UNREAD MESSAGES
 
 	 $db->query("SELECT IdMensagem, IdMorador, mensagem,
      DATE_FORMAT(data_envio,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_leitura,'%d/%m/%Y %H:%i:%s') as data_leitura,
      status
      from tb_mensagem
      WHERE IdMorador ='$id' AND status = 0 ORDER BY data_envio DESC "); 

	  $db->execute();
	  $result_comunicado = $db->resultset(); 
	  if($result_comunicado){ 
	 
		foreach ($result_comunicado as $row ) {
		   
		   $mensagem = $row['mensagem'];
		   $mensagem = substr($mensagem, 0, 33);
		   $my_size = strlen($mensagem);
		   if($my_size > 21){
			   $mensagem = substr($mensagem, 0, 21)."...";
		   }
		   if($mensagem != ''){
			   $first_char = substr($mensagem, 0, 1);
		   } else {
			   $first_char = 'M';
			 }
			 $status = $row['status'];
			 if($status == 0){
				$font_weight = '600';
			} else{
				$font_weight = '300';
			}
		
		   array_push($myArray, [
		   'IdMensagem' => $row['IdMensagem'],
		   'IdMorador'   => $row['IdMorador'],
		   'titulo'   => $mensagem,
		   'data_envio' => $row['data_envio'],
		   'imagem' => 'img/mail.png',
		   'tipo_mensagem' => 'Mensagem',
		   'link' => '#/mensagem/'.$row['IdMensagem'].'',
		   'message_type' => 'message_type_red',
		   'cm_bg' => 'cm-bg-grey',
			'first_char' => $first_char,
			'font_weight' => $font_weight,
		   'id' => $i
		   ]);
		   
		   $i++;
	   }
   } else { 
		//$myArray = [];
	 }
	 

	 /*$db->query("SELECT IdEnquete, IdCondominio, titulo_enquete ,
	 DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro, data_leitura , status_leitura , 
	 status
	 from tb_admin_enquete
	 WHERE IdCondominio ='2' ORDER BY data_cadastro DESC"); */
	 
	 $db->query("SELECT taer.IdEnquete as IdEnqueteResp, tae.titulo_enquete, tae.descricao_enquete, tae.IdCondominio, tae.opc3 , taer.IdMorador ,
	 DATE_FORMAT(tae.data_start,'%d/%m/%Y %H:%i:%s') as data_start, 
	 DATE_FORMAT(tae.data_end,'%d/%m/%Y %H:%i:%s') as data_end,
	 DATE_FORMAT(tae.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro, 
	 DATE_FORMAT(tae.data_envio,'%d/%m/%Y %H:%i:%s') as data_envio, 
	 DATE_FORMAT(taer.data_resposta,'%d/%m/%Y %H:%i:%s') as data_resposta,
	 taer.resposta , taer.status_leitura
	 FROM tb_admin_enquete tae
	 LEFT JOIN tb_admin_enquete_resp taer ON taer.IdEnquete = tae.IdEnquete
	 WHERE taer.status_leitura = '0' AND taer.IdMorador = ".$id." 	");
	 
	 $db->execute();
	 $result_enquete = $db->resultset(); 
	 
	 if($result_enquete){ 
			$i = 1; 
			foreach ($result_enquete as $row) {
				$titulo_enquete = $row['titulo_enquete'];
				$status_leitura = $row['status_leitura'];
				if($status_leitura == 0){
					$font_weight = '600';
				} else{
					$font_weight = '300';
				}
				$my_size = strlen($titulo_enquete);
				if($my_size > 21){
					$titulo_enquete = substr($titulo_enquete, 0, 21)."...";
				}
				
				if($titulo_enquete != ''){
					$first_char = substr($titulo_enquete, 0, 1);
					$first_char = strtoupper($first_char);
				} else {
					$first_char = 'O';
				}

				
				array_push($myArray, [
				'IdEnquete'   => $row['IdEnqueteResp'],
				'IdCondominio'   => $row['IdCondominio'],
				'titulo'   => $row['titulo_enquete'],
				'data_cadastro' => $row['data_cadastro'],
				'data_envio' => $row['data_envio'],
				'status' => $row['status_leitura'],
				'link' => '#/enquete/'.$row['IdEnqueteResp'].'',
				'message_type' => 'message_type_gray',
				'cm_bg' => 'cm-bg-grey',
				'first_char' => $first_char,
				'tipo_mensagem' => 'Enquete',
				'font_weight' => $font_weight,
				'id' => $i
				]);
			
				$i++;
			}
	 }


   echo json_encode($myArray);

?>