<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

$db = new db(); 

$db->query("SELECT pcp.name as nome_pet , pcp.* , pc.name as nome_cliente , pc.foto as foto_cliente , pc.foto as foto_cliente , pc.id as id_cliente
FROM pet_clients_pet pcp
LEFT JOIN pet_client pc ON pc.id = pcp.id_client
WHERE pcp.id = ".$id." "); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		 $foto = $row['foto'];
		 $foto_cliente = $row['foto_cliente'];
		 if ($foto != ""){
			$foto = 'images/pet/upload/pets/'.$foto;
		 }else{
			$foto = "assets/images/nopet.png" ;
		 } 

		 if ($foto_cliente != ""){
			$foto_cliente = 'images/pet/upload/clientes/'.$foto_cliente;
		 }else{
			$foto_cliente = "assets/images/nouser.png" ;
		 } 
		
		
		$response['data'] = $row;
		$response['data']['foto_pet'] = $foto; 
		$response['data']['foto_cliente'] = $foto_cliente; 
	} 
	 	$response['status'] = 'SUCCESS';

		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>