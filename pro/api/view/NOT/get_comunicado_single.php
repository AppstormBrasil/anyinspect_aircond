<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

if($id > 0){ 
    $db->query("SELECT tact.titulo, tact.descricao, tact.IdCondominio, taec.IdComunicadoTemplate, tact.imagem , tact.documento , taec.data_leitura , 
	DATE_FORMAT(taec.data_start,'%d/%m/%Y %H:%i:%s') as data_start, 
	DATE_FORMAT(taec.data_end,'%d/%m/%Y %H:%i:%s') as data_end,
	DATE_FORMAT(taec.data_envio,'%d/%m/%Y %H:%i:%s') as data_envio
	FROM tb_admin_envia_comunicado taec
	LEFT JOIN tb_morador tm ON taec.IdMorador = tm.IdMorador
	LEFT JOIN tb_admin_comunicado_template tact ON tact.IdComunicadoTemplate = taec.IdComunicadoTemplate
	WHERE taec.IdEnviaComunicado = ".$id."
	

	");
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 
	 $someArray = [];
	 $data_leitura = "";
	 foreach($result as $row) {
		$IdCondominio = $row["IdCondominio"];
		$IdComunicadoTemplate = $row["IdComunicadoTemplate"];
		$imagem = $row["imagem"];
		$documento = $row["documento"];
		$data_leitura = $row["data_leitura"];

		if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = prod_path."/images/comunicado/".$IdCondominio."/".$IdComunicadoTemplate."/".$imagem ;
		}else{
			$imagem = '' ;
		}

		if ($documento != ""){
			$documento_url = prod_path."/documento/comunicado/".$IdCondominio."/".$IdComunicadoTemplate."/".$documento ;
			$documento_img = prod_path."/images/pdf_img.png" ;
		}else{
			$documento_img = prod_path."/images/noimage.jpg" ;
			$documento_url = "";
		}

		array_push($someArray, [
		'IdCondominio'   => $row['IdCondominio'],
		'titulo'   => $row['titulo'],
		'titulo'   => $row['titulo'],
		'descricao' => $row['descricao'],
		'data_start' => $row['data_start'],
		'data_end' => $row['data_end'],
		'data_envio' => $row['data_envio'],
		'formulario_imagem' => $imagem,
		'formulario_anexo_imagem' => $documento_img,
		'formulario_anexo_url' => $documento_url
		]);
	 
		
	 } 
	 	 echo json_encode($someArray);
		 
		  if($data_leitura == '0000-00-00 00:00:00'){
			 $db->query('UPDATE tb_admin_envia_comunicado SET data_leitura = :data_leitura, status_morador = :status_morador WHERE IdEnviaComunicado = :IdEnviaComunicado ');
			 $db->bind(':data_leitura', $created_at); 
			 $db->bind(':status_morador', 1); 
			 $db->bind(':IdEnviaComunicado', $id); 
			 $db->execute();
		  }


		 
	 	 exit(0);
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel';
	 	 echo json_encode($arr);
	 	 } 
?>