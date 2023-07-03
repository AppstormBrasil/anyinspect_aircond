<?php 
 
include('../common/util.php'); 

$db = new db(); 


if(!isset($_GET['id_cliente'])){
	$id_cliente = '';
} else {
	$id_cliente = $_GET['id_cliente'];
}



if(!isset($_POST['searchTerm'])){
	$db->query('SELECT * from tb_clients_ativo WHERE id_client = '.$id_cliente.' order by descricao');  
	
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT * from tb_clients_ativo where descricao like "%'.$search.'%" AND id_client = '.$id_cliente.' order by descricao');  

}

$db->execute();

$result = $db->resultset(); 

$response = array();
$response[] = array(
	"id"=>0,
	"name_bolt"=>'N/A',
	"foto"=>'assets/images/noimage.png'
);

if($result){
	 $i = 0;
	 foreach($result as $row) {

		 $foto = $row['foto'];
		 if ($foto != ""){
			$foto = 'images/upload/ativos/'.$foto;
		 }else{
			$foto = "assets/images/noimage.png" ;
		 } 
		 
		$response[] = array(
			"id"=>$row['id'],
			"name_bolt"=>$row['descricao'],
			"foto"=>$foto
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