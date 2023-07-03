<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

if($id > 0){ 
    $db->query("SELECT td.* ,  
      DATE_FORMAT(td.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro,
      DATE_FORMAT(td.data_atualizacao,'%d/%m/%Y %H:%i:%s') as data_atualizacao
      FROM tb_admin_info_template td
      WHERE td.IdComunicadoTemplate ='$id' ");
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 
	  $someArray = [];
	 foreach ($result as $row) {
		
		$IdCondominio = $row["IdCondominio"];
		$IdComunicadoTemplate = $row["IdComunicadoTemplate"];
		$imagem = $row["imagem"];
		$documento = $row["documento"];
		
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
	 	 exit(0);
	} else { 
 	 	 $someArray[] = $value;
	 	 echo json_encode($someArray);
	 	 } 
?>