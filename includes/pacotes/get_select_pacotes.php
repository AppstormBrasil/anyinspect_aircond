<?php 
 
include('../common/util.php'); 

$db = new db(); 

if(!isset($_POST['searchTerm'])){
	$db->query('SELECT * from tb_package order by `nome`');  
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT * from tb_package  where `nome` like "%'.$search.'%" order by `nome` ');  
}

//$db->query('SELECT * from tb_product order by `desc`'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		 
		$response[] = array(
			"id"=>$row['id'],
			"nome"=>$row['nome'],
			"valor"=>$row['valor'],
			"data_cadastro"=>$row['data_cadastro']
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