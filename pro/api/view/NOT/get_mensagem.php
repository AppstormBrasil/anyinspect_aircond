<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
 if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$IdVisitante = $id; 

if($id > 0){ 
 	 $db->query("SELECT IdMensagem, IdMorador, IdUsuario, mensagem,
      DATE_FORMAT(data_envio,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_leitura,'%d/%m/%Y %H:%i:%s') as data_leitura,
      status
      from tb_mensagem
      WHERE IdMorador ='$id' "); 
 } else { 
  	 $arr['status'] = 'ERROR'; 
	 $arr['status_txt'] = 'Nenhuma informação disponível'; 
	 echo json_encode($arr);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 $someArray = [];
	 foreach ($result as $key => $value) {
		//echo $value["IdMensagem"] . ", " . $value["mensagem"] . "<br>";
		$someArray[] = $value;
	}
	
	echo json_encode($someArray);
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>