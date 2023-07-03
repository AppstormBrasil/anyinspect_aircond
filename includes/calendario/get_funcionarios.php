<?php 
 
include('../common/util.php'); 

$db = new db(); 


//$db->query('SELECT id, name, cpf, rg, phone, email, neighbor, city , foto from tb_team');  

if(!isset($_POST['searchTerm'])){
	$db->query('SELECT id, name , foto , phone from tb_team order by name');  
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT id, name , foto , phone from tb_team where  `name` like "%'.$search.'%"   order by name');  
}



$db->execute();
$result = $db->resultset();

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$foto = $row['foto'];
			
		if ($foto != ""){
			$foto = 'images/upload/funcionarios/'.$foto;
		}else{
			$foto = "assets/images/nouser.png" ;
		} 
		 
		$response[] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"phone"=>$row['phone'],
			"foto"=>$foto,
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