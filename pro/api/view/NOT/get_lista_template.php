<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
$id = 2; 
if(isset($_GET['user_id'])){ $user_id = $_GET['user_id'];} else { $user_id  = '';}
if($id > 0){
	  $db->query("SELECT tafa.* 
      FROM tb_admin_form_agenda tafa
      WHERE tafa.status = 1 ORDER BY  tafa.titulo DESC "); 
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
		
		$IdformAgenda = $row["IdformAgenda"];
		$titulo = $row["titulo"];
		$descricao = $row["descricao"];
		$documento = $row["documento"];
		$imagem = $row["imagem"];
		
		
	 
		array_push($someArray, [
		'IdformAgenda'   => $IdformAgenda,
		'titulo'   => $titulo,
		'descricao'   => $descricao,
		'descricao' => $documento,
		'data_cadastro' => $imagem,
		
		]);
		$i++;
	}
	
	echo json_encode($someArray);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>