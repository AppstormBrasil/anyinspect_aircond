<?php 
 
include('../../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

$db = new db(); 

$db->query('SELECT * from pet_client where id = "'.$id_cliente.'"'); 
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
		$data_nascimento = $row["data_nascimento"];
		$foto = $row["foto"];
		$obs = $row["obs"];
		
		$data_nascimento = usa_to_br($data_nascimento);
		$data_nascimento = trim($data_nascimento);

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
			"rg"=>$row['rg'],
			"data_nascimento"=>$data_nascimento,
			"foto"=>$row['foto'],
			"obs"=>$row['obs']
		);
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