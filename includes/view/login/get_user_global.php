<?php
	
 include('../../common/util.php'); 
 $created_at = date('Y-m-d  H:i:s'); 
 $db = new db(); 

$id = trim($_GET['global_user']);
$db->query('SELECT name , foto from tb_team where id = "'.$id.'"'); 
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
		$response['data'] = array(
			"name"=>$row['name'],
			"foto"=>$foto,
		);
	 } 


	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
		$arr['data'] = array(
			"name"=>'Anonymous',
			"foto"=>'images/noimage.png',
		);   
		$arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 
?>
