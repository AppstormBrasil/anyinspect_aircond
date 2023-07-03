<?php 
 
include('../../common/util.php'); 

$db = new db(); 


if(!isset($_GET['id_cliente'])){
	$id_cliente = '';
} else {
	$id_cliente = $_GET['id_cliente'];
}



if(!isset($_POST['searchTerm'])){
	$db->query('SELECT id, name , foto , mood from tb_clients_pet WHERE id_client = '.$id_cliente.' order by name');  
	
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT id, name , foto , mood from tb_clients_pet where name like "%'.$search.'%" AND id_client = '.$id_cliente.' order by name');  

}

$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 
		$mood = $row['mood'];
		if($mood == 'c'){
			$mood = 'Calmo';
		} else if($mood == 'a'){
			$mood = 'Agressivo';
		} else {
			$mood = '';
		}

		 $foto = $row['foto'];
		 if ($foto != ""){
			$foto = 'images/upload/pets/'.$foto;
		 }else{
			$foto = "assets/images/nopet.png" ;
		 } 
		 
		$response[] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"foto"=>$foto,
			"mood"=>$mood
		);
	 } 
	 	 //$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 
		 $response['status'] = 'ERROR'; 
	 	 $response['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($response);
	 	 } 

 ?>