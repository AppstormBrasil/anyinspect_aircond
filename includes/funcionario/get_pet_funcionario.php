<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT id, name, cpf, rg, phone, email, neighbor, city , foto from tb_team WHERE email <> "felipetaveira@gmail.com" '); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$cpf = $row["cpf"];
		$rg = $row["rg"];
		$phone = $row["phone"];
		$email = $row["email"];
		$neighbor = $row["neighbor"];
		$city = $row["city"];

		$foto = $row["foto"];
		if ($foto != ""){
			$foto = "images/pet/upload/funcionarios/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

		$response['data'][] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"cpf"=>$row['cpf'],
			"rg"=>$row['rg'],
			"phone"=>$row['phone'],
			"email"=>$row['email'],
			"neighbor"=>$row['neighbor'],
			"city"=>$row['city'],
			"foto"=>$foto,
			"botao"=>'<a href="funcionario-'.$id.'">
			<button class="btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button>
			</a><button onclick="RemoveItem('.$row['id'].',\''.$row['name'].'\',\''.$foto.'\')" class="btn btn-danger" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-17"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>