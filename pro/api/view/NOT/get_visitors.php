<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 

if($id > 0){
 	 $db->query("SELECT tv.* ,  
      DATE_FORMAT(tv.data_cadastro,'%d/%m/%Y') as data_cadastro,
      DATE_FORMAT(tv.data_visita,'%d/%m/%Y') as data_visita
      FROM tb_visita tv
      WHERE tv.IdMorador ='$id' ORDER BY tv.data_cadastro DESC"); 
 } else { 
  	 $someArray = [];
	 echo json_encode($someArray);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 $someArray = [];
	 $first_char = "";
	 foreach ($result as $row) {
		
		$IdCondominio = $row["IdCondominio"];
		$titulo = $row["titulo"];
		if($titulo != ''){
			$first_char = substr($titulo, 0, 1);
		} else {
			$first_char = 'V';
		}
		$id = $i;
	 
		array_push($someArray, [
		'IdCondominio'   => $row['IdCondominio'],
		'IdVisita'   => $row['IdVisita'],
		'titulo'   => $row['titulo'],
		'data_cadastro' => $row['data_cadastro'],
		'data_visita' => $row['data_visita'],
		'status' => $row['status'],
		'message_type' => 'message_type_green',
		'tipo_mensagem' => 'Visita',
		'first_char' => $first_char,
		'id' => $id
		]);
		
		$i++;
	}
	
	echo json_encode($someArray);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>