<?php 
 
include('../../common/util.php'); 

$db = new db(); 


if(!isset($_POST['searchTerm'])){
	$db->query('SELECT id, name , phone , street , number , neighbor , complemento , city , state_ , foto , zip from pet_client order by name');  
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT id, name , phone , street , number , neighbor , complemento , city , state_ , foto , zip from pet_client where name like "%'.$search.'%" OR phone like "%'.$search.'%" order by name');  
}


$db->execute();
$result = $db->resultset();

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$foto = $row['foto'];
			
		if ($foto != ""){
			$foto = 'images/pet/upload/clientes/'.$foto;
		}else{
			$foto = "assets/images/nouser.png" ;
		} 
		 
		$response[] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"phone"=>$row['phone'],
			"street"=>$row['street'],
			"number"=>$row['number'],
			"neighbor"=>$row['neighbor'],
			"complemento"=>$row['complemento'],
			"city"=>$row['city'],
			"state_"=>$row['state_'],
			"zip"=>$row['zip'],
			"foto"=>$foto
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