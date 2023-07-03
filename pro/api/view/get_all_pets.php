<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
//$_GET = json_decode(file_get_contents('php://input'), true);

if(isset($_GET['id_cliente'])){ $id_cliente = $_GET['id_cliente'];} else { $id_cliente  = '';}
$db = new db(); 

$db->query('SELECT tclib.* , tcb.id as id_cat , tcb.description as categoria 
from tb_clients_bolt tclib
LEFT JOIN tb_cat_barco tcb ON tclib.category_bolt = tcb.id
where id_client = "'.$id_cliente.'"'); 

$db->bind(':id_client', $id_cliente);
$db->execute();



$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$foto = $row['foto'];
		if ($foto != ""){
		   $foto = prod_path.'images/upload/barcos/'.$foto;
		}else{
		   $foto = prod_path."assets/images/nopet.png" ;
		} 
		
	   $response['data'][] = array(
		   "id"=>$row['id'],
		   "name_bolt"=>$row['name_bolt'],
		   "categoria"=>$row['categoria'],
		   "foto"=>$foto
	   );
	
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = []; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>