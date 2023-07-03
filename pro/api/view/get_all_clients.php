<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

//if(isset($_GET['IdUser'])){ $id = $_GET['IdUser'];} else { $id  = '';}


$db = new db(); 

function get_pet_list($id_client){
	 
	$the_bolts = "";
	$the_cat = "";
	$response = array();
	$db = new db(); 
	$db->query("SELECT pcp.name_bolt as name_bolt , pb.description , pcp.id
				FROM tb_clients_bolt pcp
				LEFT JOIN tb_cat_barco pb ON pb.id = pcp.category_bolt 
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

$db->query("SELECT tc.id, tc.name , tc.foto , tc.street , tc.zip , tc.neighbor , tc.complemento , tc.city , tc.state_ , tc.number , pcp.name_bolt as pet_name , pcp.id_client , tc.valor_frete
FROM tb_client tc 
LEFT JOIN tb_clients_bolt pcp ON tc.id = pcp.id_client
GROUP BY tc.id  
"); 
$db->execute();
$all_pets = "";
$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$foto = $row["foto"];
		$street = $row["street"];
		$zip = $row["zip"];
		$neighbor = $row["neighbor"];
		$complemento = $row["complemento"];
		$city = $row["city"];
		$state_ = $row["state_"];
		$number = $row["number"];
		$id_client = $row['id_client'];

		$final_address = $street.''.$number.''.$neighbor.''.$complemento.''.$zip.''.$city.''.$state_;

		if ($foto != ""){
			$foto = prod_path."images/upload/clientes/".$foto ;
		}else{
			$foto = prod_path."pro/images/profile.jpg" ;
		}

		if($id_client != ''){
			$all_pets = get_pet_list($id_client);
		}
		
		/*if ($foto != ""){
			$foto = prod_path."images/upload/clientes/".$foto ;
		}else{
			$foto = prod_path."pro/images/profile.jpg" ;
		} */

		$response['data'][] = array(
			"id"=>$id,
			"name"=>$name,
			"foto"=>$foto,
			"final_address"=>$final_address,
			"pet_name"=>$row['pet_name'],
			"foto"=>$foto,
			"valor_frete"=>$row['valor_frete'],
			"all_pets"=>$all_pets,
			
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = []; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>