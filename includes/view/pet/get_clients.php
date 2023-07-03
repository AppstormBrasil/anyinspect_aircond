<?php 
 
include('../../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

if(!isset($_GET['searchTerm'])){ 
	echo 'tem search';
} else {
	echo 'nao tem search';
}

$db = new db(); 

$db->query('SELECT id, name , phone , street , number , neighbor , complemento , city , state_ , foto from pet_client'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$name = $row["name"];
		$id = $row["id"];

		$foto = $row['foto'];
			
		if ($foto != ""){
			$foto = 'images/pet/upload/clientes/'.$imagem;
		}else{
			$foto = "assets/images/no_image.png" ;
		} 
		

		$response['data'][] = array(
			"name"=>$row['id'],
			"name"=>$row['name'],
			"name"=>$row['phone'],
			"name"=>$row['street'],
			"name"=>$row['number'],
			"name"=>$row['neighbor'],
			"name"=>$row['complemento'],
			"name"=>$row['city'],
			"name"=>$row['state_'],
			"name"=>$foto
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