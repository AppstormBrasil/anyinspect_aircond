<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

if(isset($_GET['qrCodeMessage'])){ $qrCodeMessage = $_GET['qrCodeMessage'];} else { $qrCodeMessage  = '';}
if(isset($_GET['IdUser'])){ $IdUser = $_GET['IdUser'];} else { $IdUser  = '';}
if(isset($_GET['type'])){ $type = $_GET['type']; } else { $type  = '';}

$db = new db(); 
$db->query("SELECT tc.id as id_cliente ,  tc.name as nome_client , tc.foto as foto_cliente  , tcba.description as categoria , tcb.*
FROM tb_clients_ativo tcb 
LEFT JOIN tb_client tc ON tc.id = tcb.id_client 
LEFT JOIN tb_category tcba ON tcba.id = tcb.category
WHERE tcb.qrcode = :qrCodeMessage "); 
$db->bind(':qrCodeMessage', $qrCodeMessage);
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
		$descricao = $row["descricao"];
		$category = $row["category"];
		$model = $row["model"];
		$register = $row["register"];
		$obs = $row["obs"];
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
			"descricao"=>$descricao,
			"category"=>$category,
			"model"=>$model,
			"register"=>$register,
			"obs"=>$obs,
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