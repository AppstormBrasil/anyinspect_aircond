<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from tb_arso'); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		

		/*$response['data'][] = array(
			"id"=>$row['id'],
			"name"=>$name,
			"foto"=>$foto,
			"cpf"=>$row['cpf'],
			"rg"=>$row['rg'],
			"phone"=>$row['phone'],
			"zap"=>$row['phone2'],
			"email"=>$row['email'],
			"neighbor"=>$row['neighbor'],
			"city"=>$row['city'],
			"insta_cliente"=>$row['insta_cliente'],
			//"all_pets"=>$all_pets,
			"botao"=>'<a style="margin-right: 5px;" class="single_link btn btn-light btn-xs" id="'.$row['id'].'" href="subcontrato-'.$id.'">
			<i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('.$row['id'].',\''.$name.'\',\''.$foto.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
		); */
	 } 
	 	
	 	$response['data'] = $result;
	 	$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>