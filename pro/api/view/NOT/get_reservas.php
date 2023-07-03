<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$someArray = [];
if($id > 0){ 
 	 $db->query("SELECT IdReclamacao, IdMorador, tipo_reclamacao, descricao,
      DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_resolucao,'%d/%m/%Y %H:%i:%s') as data_resolucao,
      status,imagem
      from tb_reclamacao
      WHERE IdMorador ='$id' ORDER BY data_cadastro DESC"); 
 } else { 
  	  echo json_encode($someArray);
	 exit(0);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 
	
	 foreach ($result as $row) {
		$imagem = $row["imagem"];
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

		if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = prod_path."/images/ocorrencia/".$IdCondominio."/".$IdReclamacao."/".$imagem ;
		}else{
			$imagem = '' ;
		}
		
		array_push($someArray, [
		'IdMorador'   => $row['IdMorador'],
		'IdReclamacao'   => $row['IdReclamacao'],
		'tipo_reclamacao'   => $row['tipo_reclamacao'],
		'descricao' => $descricao,
		'data_envio' => $row['data_envio'],
		'data_resolucao' => $row['data_resolucao'],
		'status' => $row['status'],
		'imagem' => $imagem,
		'message_type' => 'message_type_gray',
		'cm_bg' => 'cm-bg-grey',
		'first_char' => $first_char,
		'id' => $i
		]);
	
		$i++;
	}
	
		 echo json_encode($someArray);
	 	 exit(0);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>