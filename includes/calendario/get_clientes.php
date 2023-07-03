<?php 
 
include('../common/util.php'); 

$db = new db(); 


function get_barco_list($id_client){
	 
	$the_bolts = "";
	$the_cat = "";
	$response = array();
	$db = new db(); 
	$db->query("SELECT pcp.descricao as name_bolt , pb.description , pcp.id
				FROM tb_clients_ativo pcp
				LEFT JOIN tb_category pb ON pb.id = pcp.category 
				WHERE pcp.id_client = ".$id_client." ");  

	$db->execute();
	$result = $db->resultset();
	foreach($result as $row) {

		$description = $row['description'];
		if($description <> ''){
			$the_cat = '<small>('.$row['description'].')  </small> ' ;
		}
		$the_bolts .= '<strong>'.$row['name_bolt'].'</strong> '.$the_cat;


	} 
	
	return $the_bolts;

}

if(!isset($_POST['searchTerm'])){
	$db->query('SELECT tc.id, tc.name , tc.phone , tc.street , tc.number , tc.neighbor , tc.complemento , tc.city , tc.state_ , tc.foto , tc.zip , tc.nome_empresa
				FROM tb_client tc
				LEFT JOIN tb_clients_ativo tca ON tc.id = tca.id_client 
				GROUP BY tc.name order by tc.name ');  
}
else{
	$search = $_POST['searchTerm'];

	$db->query('SELECT tc.id, tc.name , tc.phone , tc.street , tc.number , tc.neighbor , tc.complemento , tc.city , tc.state_ , tc.foto , tc.zip , tc.nome_empresa
				FROM tb_client tc
				LEFT JOIN tb_clients_ativo tca ON tc.id = tca.id_client 
				WHERE tc.name like "%'.$search.'%" OR tc.phone like "%'.$search.'%" OR tc.id like "%'.$search.'%" OR tc.nome_empresa like "%'.$search.'%" 
				GROUP BY tc.name order by tc.name ');  
}


$db->execute();
$result = $db->resultset();
$all_pets = "";
if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$foto = $row['foto'];
		$id_client = $row['id'];
			
		if ($foto != ""){
			$foto = 'images/upload/clientes/'.$foto;
		}else{
			$foto = "assets/images/nouser.png" ;
		} 

		if($id_client != ''){
			$all_pets = "";
		}
	 
		$response[] = array(
			"id"=>$row['id'],
			"name"=>$row['nome_empresa'],
			"phone"=>$row['phone'],
			"street"=>$row['street'],
			"number"=>$row['number'],
			"neighbor"=>$row['neighbor'],
			"complemento"=>$row['complemento'],
			"city"=>$row['city'],
			"state_"=>$row['state_'],
			"zip"=>$row['zip'],
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