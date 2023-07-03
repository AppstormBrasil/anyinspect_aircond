<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT pc.name as nome_cliente  , pc.foto as foto_cliente , tca.id as id_ativo , tca.descricao , tca.foto as foto_ativo , tca.model , pc.id as id_client  , 
DATE_FORMAT(tca.validade,'%d/%m/%Y' ) as data_validade , tca.category as categoria , tca.local , tca.register , tl.descricao  as descricao_local , tca.qrcode 
FROM tb_clients_ativo tca
LEFT JOIN tb_client pc ON tca.id_client = pc.id 
LEFT JOIN tb_category tcat ON tcat.id = tca.category 
LEFT JOIN tb_local tl ON tl.id = tca.local 
WHERE pc.id = :id  "); 
$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		 $foto_ativo = $row['foto_ativo'];
		 if ($foto_ativo != ""){
			$foto_ativo = 'images/upload/ativos/'.$foto_ativo;
		 }else{
			$foto_ativo = "assets/images/noimage.png" ;
		 }

		$local = $row["local"];
		$categoria = $row["categoria"];
		$data_validade = $row["data_validade"];
		 
		
		$response['data'][] = array(
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"foto_cliente"=>$row['foto_cliente'],
			"id_ativo"=>$row['id_ativo'],
			"descricao"=>$row['descricao'],
			"foto_ativo"=>$foto_ativo,
			"local"=>$row['local'],
			"model"=>$row['model'],
			"register"=>$row['register'],
			"categoria"=>$row['categoria'],
			"data_validade"=>$data_validade,
			"descricao_local"=>$row['descricao_local'],
			"qrcode"=>$row['qrcode'],
		);
	 } 
		  
	 
	 	$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
		 $arr['data'] = [];
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  
		  echo json_encode($arr);
	 	 } 

 ?>