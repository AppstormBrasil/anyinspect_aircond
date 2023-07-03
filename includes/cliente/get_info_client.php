<?php 
 
include('../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

$db = new db(); 

$db->query('SELECT * from tb_client where id = "'.$id_cliente.'"'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$name = $row["name"];
		$gender = $row["gender"];
		$email = $row["email"];
		$phone = $row["phone"];
		$phone2 = $row["phone2"];
		$zip = $row["zip"];
		$street = $row["street"];
		$number = $row["number"];
		$complemento = $row["complemento"];
		$neighbor = $row["neighbor"];
		$city = $row["city"];
		$state = $row["state_"];
		$cpf = $row["cpf"];
		$rg = $row["rg"];
		$validade_contrato = $row["venc_contrato"];
		$foto = $row["foto"];
		$obs = $row["obs"];
		$insta_cliente = $row["insta_cliente"];
		$lat = $row["lat"];
		$lon = $row["lon"];
		$razao_social = $row["razao_social"];
		
		$validade_contrato = usa_to_br($validade_contrato);
		$validade_contrato = trim($validade_contrato);

		if ($foto != ""){
			$foto = "images/upload/clientes/".$foto ;
		}else{
			$foto = "images/noimage.png" ;
		}

		$response['data'][] = array(
			"name"=>$row['name'],
			"gender"=>$row['gender'],
			"email"=>$row['email'],
			"phone"=>$row['phone'],
			"phone2"=>$row['phone2'],
			"zip"=>$row['zip'],
			"street"=>$row['street'],
			"number"=>$row['number'],
			"complemento"=>$row['complemento'],
			"neighbor"=>$row['neighbor'],
			"city"=>$row['city'],
			"state"=>$row['state_'],
			"cpf"=>$row['cpf'],
			"cnpj"=>$row['cnpj'],
			"nome_empresa"=>$row['nome_empresa'],
			"rg"=>$row['rg'],
			"validade_contrato"=>$validade_contrato,
			"obs"=>$row['obs'],
			"insta_cliente"=>$row['insta_cliente'],
			"lat"=>$row['lat'],
			"lon"=>$row['lon'],
			"foto"=>$foto,
			"razao_social"=>$razao_social
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
		 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		 $arr['data'][] = array();
	 	 echo json_encode($arr);
	 	 } 

 ?>