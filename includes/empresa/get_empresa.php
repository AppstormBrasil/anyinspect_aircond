<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from tb_companie'); 
$db->execute();
$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {

		$foto = $row["foto"];
		
		if ($foto != ""){
			$foto = "images/upload/empresa/".$foto ;
		}else{
			$foto = "images/noimage.png" ;
		}

		$response['data'] = array(
			"id"=>$row['id'],
			"nome_empresa"=>$row['nome_empresa'],
			"email"=>$row['email'],
			"phone"=>$row['phone'],
			"whatsapp"=>$row['whatsapp'],
			"foto"=>$foto,
			"cnpj"=>$row['cnpj'],
			"cep"=>$row['cep'],
			"endereco"=>$row['endereco'],
			"bairro"=>$row['bairro'],
			"number"=>$row['number'],
			"cidade"=>$row['cidade'],
			"estado"=>$row['estado'],
			"info_extra"=>$row['info_extra'],
			"website"=>$row['website'],
			"facebook"=>$row['facebook'],
			"instagram"=>$row['instagram'],
			"type_companie"=>$row['type_companie']			
		);
	 } 
		
	    $response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $response['status'] = 'ERROR'; 
	 	 $response['status_txt'] = 'Nenhuma informacao disponivel'; 
		 $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>