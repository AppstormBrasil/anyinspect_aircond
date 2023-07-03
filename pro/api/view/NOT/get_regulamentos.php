<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
$id = 2; 

if($id > 0){
 	 $db->query("SELECT td.* ,  
      DATE_FORMAT(td.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro,
      DATE_FORMAT(td.data_atualizacao,'%d/%m/%Y %H:%i:%s') as data_atualizacao
      FROM tb_admin_documento_template td
      WHERE td.IdCondominio ='$id' "); 
 } else { 
  	 $someArray = [];
	 echo json_encode($someArray);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 $someArray = [];
	 foreach ($result as $row) {
		
		$IdCondominio = $row["IdCondominio"];
		$IdComunicadoTemplate = $row["IdComunicadoTemplate"];
		$imagem = $row["imagem"];
		$documento = $row["documento"];
		
		$titulo = $row['titulo'];
		$my_size = strlen($titulo);
		if($my_size > 21){
			$titulo = substr($titulo, 0, 21)."...";
		}
		
		if($titulo != ''){
			$first_char = substr($titulo, 0, 1);
		} else {
			$first_char = 'O';
		}
		
		if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = prod_path."/images/documento/".$IdCondominio."/".$IdComunicadoTemplate."/".$imagem ;
		}else{
			$imagem = '' ;
		}

		if ($documento != ""){
			$documento_url = prod_path."/documento/documento/".$IdCondominio."/".$IdComunicadoTemplate."/".$documento ;
			$documento_img = prod_path."/images/pdf_img.png" ;
		}else{
			$documento_img = prod_path."/images/noimage.jpg" ;
			$documento_url = "";
		}
	 
		array_push($someArray, [
		'IdCondominio'   => $row['IdCondominio'],
		'IdComunicadoTemplate'   => $row['IdComunicadoTemplate'],
		'titulo'   => $titulo,
		'descricao' => $row['descricao'],
		'data_cadastro' => $row['data_cadastro'],
		'data_atualizacao' => $row['data_atualizacao'],
		'imagem' => $imagem,
		'documento_img' => $documento_img,
		'documento_url' => $documento_url,
		'tipo_mensagem' => 'Regulamento',
		'message_type' => 'message_type_yellow',
		'cm_bg' => 'cm-bg-yellow',
		'first_char' => $first_char,
		'id' => $i
		]);
		$i++;
	}
	
	echo json_encode($someArray);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>