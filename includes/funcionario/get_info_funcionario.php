<?php 
 
include('../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_funcionario = $id;

$db = new db(); 

$db->query('SELECT tt.* ,  DATE_FORMAT( tt.data_admicao ,"%d/%m/%Y") as data_admicao  from tb_team tt where tt.id = "'.$id_funcionario.'"'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$foto = $row['foto'];
		if ($foto != ""){
			$foto = 'images/upload/funcionarios/'.$foto;
		}else{
			$foto = "assets/images/nouser.png" ;
		} 
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
		$data_nascimento = $row["born"];
		$info_extra = $row["info_extra"];
		$comissao = $row["comission"];
		$type2 = $row["type2"];

		$data_admicao = $row["data_admicao"];
		$local_nascimento = $row["local_nascimento"];
		$cargo = $row["cargo"];
		$base = $row["base"];
		$sign = $row["sign"];

		
		
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
			"type"=>$row['type'],
			"type2"=>$row['type2'],
			"data_nascimento"=>$data_nascimento,
			"info_extra"=>$row['info_extra'],
			"foto"=>$foto,
			"comissao"=>$comissao,
			"data_admicao"=>$data_admicao,
			"local_nascimento"=>$local_nascimento,
			"cargo"=>$cargo,
			"base"=>$base,
			"sign"=>$sign
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