<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
if(isset($_GET['user_id'])){ $user_id = $_GET['user_id'];} else { $user_id  = '';}


if($id > 0){ 
    $db->query("SELECT td.* , taei.IdMorador , taei.data_leitura  , taei.IdEnviaComunicado , 
      DATE_FORMAT(td.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro,
      DATE_FORMAT(td.data_atualizacao,'%d/%m/%Y %H:%i:%s') as data_atualizacao
      FROM tb_admin_info_template td
	  LEFT JOIN tb_admin_envia_info taei ON td.IdComunicadoTemplate = taei.IdComunicadoTemplate
      WHERE td.IdComunicadoTemplate ='$id' ");
	  
	
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 $data_leitura ="";
	 $IdEnviaComunicado = 0;
	  $someArray = [];
	 foreach ($result as $row) {
		
		$IdCondominio = $row["IdCondominio"];
		$IdComunicadoTemplate = $row["IdComunicadoTemplate"];
		$imagem = $row["imagem"];
		$documento = $row["documento"];
		$data_leitura = $row["data_leitura"];
		$IdEnviaComunicado = $row["IdEnviaComunicado"];
		
		if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = prod_path."/images/informacao/".$IdCondominio."/".$IdComunicadoTemplate."/".$imagem ;
		}else{
			$imagem = '' ;
		}

		if ($documento != ""){
			$documento_url = prod_path."/documento/informacao/".$IdCondominio."/".$IdComunicadoTemplate."/".$documento ;
			$documento_img = prod_path."/images/pdf_img.png" ;
		}else{
			$documento_img = prod_path."/images/noimage.jpg" ;
			$documento_url = "";
		}
		$data_cadastro = $row['data_cadastro']; 
		array_push($someArray, [
		'IdCondominio'   => $row['IdCondominio'],
		'IdComunicadoTemplate'   => $row['IdComunicadoTemplate'],
		'titulo'   => $row['titulo'],
		'descricao' => $row['descricao'],
		'data_cadastro' => $row['data_cadastro'],
		'data_atualizacao' => $row['data_atualizacao'],
		'imagem' => $imagem,
		'data_atualizacao' => $row['data_atualizacao'],
		'documento' => $documento,
		'documento_url' => $documento_url,
		'message_type' => 'message_type_yellow',
		'tipo_mensagem' => 'Regulamento'
		]);
		//$someArray[] = $value;
	}
	 	 echo json_encode($someArray);
		 
		 //echo $IdComunicadoTemplate;
		 
		 if($IdEnviaComunicado > 0){
			if($data_leitura == '0000-00-00 00:00:00'){
				$db->query('UPDATE tb_admin_envia_info SET data_leitura = :data_leitura, status_morador = :status_morador WHERE IdEnviaComunicado = :IdEnviaComunicado ');
				$db->bind(':data_leitura', $created_at); 
				$db->bind(':status_morador', 1); 
				$db->bind(':IdEnviaComunicado', $IdEnviaComunicado); 
				$db->execute();
			
			}
		 } else {

			 $db->query('INSERT INTO tb_admin_envia_info (IdComunicadoTemplate,IdMorador,data_envio,status_envio,data_start,data_end,data_leitura,status_morador) VALUES (:IdComunicadoTemplate,:IdMorador,:data_envio,:status_envio,:data_start,:data_end,:data_leitura,:status_morador)'); 
				$db->bind(':IdComunicadoTemplate', $IdComunicadoTemplate); 
				$db->bind(':IdMorador', $user_id);
				$db->bind(':data_envio', $data_cadastro);
				$db->bind(':status_envio', '1');
				$db->bind(':data_start', $created_at);
				$db->bind(':data_end', $created_at);
				$db->bind(':data_leitura', $created_at);
				$db->bind(':status_morador', 1);
				$db->execute();
			
		 }
		 
		 
		 
	 	 exit(0);
	} else { 
 	 	 $someArray[] = "";
	 	 echo json_encode($someArray);
	 	 } 
?>