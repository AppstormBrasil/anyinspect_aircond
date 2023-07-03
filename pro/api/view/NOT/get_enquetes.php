<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$someArray = [];
if($id > 0){ 

		$db->query("SELECT tae.* ,taer.* 
		FROM tb_admin_enquete tae
		LEFT JOIN tb_admin_enquete_resp taer ON taer.IdEnquete = tae.IdEnquete
		WHERE taer.IdMorador = ".$id." ORDER BY tae.data_cadastro DESC	");

 	  /*$db->query("SELECT IdEnquete, IdCondominio, titulo_enquete ,
      DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro,
      status
      from tb_admin_enquete
      WHERE IdCondominio ='2' ORDER BY data_cadastro DESC");  */
 } else { 
  	 $someArray = [];
	 echo json_encode($someArray);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 foreach ($result as $row) {
		$titulo_enquete = $row['titulo_enquete'];
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

		$status = $row['status'];

		$status_leitura = $row['status_leitura'];

		if($status_leitura == 0){
			$font_weight = '600';
			$message_type = 'message_type_blue';
			$cm_bg = 'cm-bg-blue';
			

		} else{
			$font_weight = '300';
			$message_type = 'message_type_gray';
			$cm_bg = 'cm-bg-grey';
		}

		
		array_push($someArray, [
		'IdEnquete'   => $row['IdEnquete'],
		'IdCondominio'   => $row['IdCondominio'],
		'titulo_enquete'   => $row['titulo_enquete'],
		'data_cadastro' => $row['data_cadastro'],
		'status' => $row['status'],
		'message_type' => $message_type,
		'cm_bg' => $cm_bg,
		'first_char' => $first_char,
		'tipo_mensagem' => 'Enquete',
		'font_weight' => $font_weight,
		'id' => $i
		]);
	
		$i++;
	}
	
	echo json_encode($someArray);
	exit;
	 	 $arr['status'] = 'SUCCESS';
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>