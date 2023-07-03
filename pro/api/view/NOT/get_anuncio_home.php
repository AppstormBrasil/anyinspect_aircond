<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
 	 $db->query('SELECT * FROM tb_admin_anuncio '); 

 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 $myArray = [];
	 foreach($result as $row) { 
		$IdCondominio = $row["IdCondominio"];
		$IdAnuncio = $row["IdAnuncio"];
		$Tipo = $row["Tipo"];
		$Titulo = $row["Titulo"];
		$Descricao = $row["Descricao"];
		$imagem = $row["imagem"];
		if ($imagem != ""){
			$imagem = prod_path."/images/anuncio/".$IdCondominio."/".$IdAnuncio."/".$imagem ;
		}else{
			$imagem = prod_path."/images/noimage.jpg" ;
		}
		
		array_push($myArray, [
		'IdAnuncio' => $row['IdAnuncio'],
		'Tipo' => $row['Tipo'],
		'Titulo' => $Titulo,
		'Descricao' => $Descricao,
		'IdCondominio'   => $row['IdCondominio'],
		'imagem' => $imagem
		
		]);
	 
	 } 
	 	 echo json_encode($myArray);
	 	 exit(0);
	} else { 
 	 	 $myArray = [];
	 	 echo json_encode($myArray);
	 	 } 

 ?>