<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

if(isset($_GET['code'])){ $code = $_GET['code'];} else { $code  = '';}

$db = new db(); 
$db->query("SELECT tc.id as id_cliente ,  tc.name as nome_client , tc.foto as foto_cliente  , tcba.description as categoria , tcb.*
FROM tb_clients_bolt tcb 
LEFT JOIN tb_client tc ON tc.id = tcb.id_client 
LEFT JOIN tb_cat_barco tcba ON tcba.id = tcb.category_bolt
WHERE tcb.qrcode = :code "); 
$db->bind(':code', $code);
$db->execute();

$result = $db->resultset(); 
if($result){

	 $i = 0; 
	 
	 foreach($result as $row) {
		$nome_client = $row["nome_client"];
		$foto_cliente = $row["foto_cliente"];
		$categoria = $row["categoria"];
		$id_cliente = $row["id_cliente"];
		$id = $row["id"];
		$name_bolt = $row["name_bolt"];
		$category_bolt = $row["category_bolt"];
		$model_bolt = $row["model_bolt"];
		$register_bolt = $row["register_bolt"];
		$obs_bolt = $row["obs_bolt"];
		$foto = $row["foto"];
		$qrcode = $row["qrcode"];

		if ($foto_cliente != ""){
			$foto_cliente = prod_path."images/upload/clientes/".$foto_cliente ;
		}else{
			$foto_cliente = prod_path."pro/images/profile.jpg" ;
		}

		if ($foto != ""){
			$foto = prod_path."images/upload/barcos/".$foto ;
		}else{
			$foto = prod_path. "pro/images/profile.jpg" ;
		}
		
	
		$response[] = array(
			"id_cliente"=>$id_cliente,
			"nome_client"=>$nome_client,
			"foto_cliente"=>$foto_cliente,
			"categoria"=>$categoria,
			"id"=>$id,
			"name_bolt"=>$name_bolt,
			"category_bolt"=>$category_bolt,
			"model_bolt"=>$model_bolt,
			"register_bolt"=>$register_bolt,
			"obs_bolt"=>$obs_bolt,
			"foto"=>$foto,
			"qrcode"=>$qrcode,
		);
		$i++;
	 
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