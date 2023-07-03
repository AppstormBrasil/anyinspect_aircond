<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

function get_embarcacao_list($id_client){
	 
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

$db->query('SELECT pcp.name_bolt as name_bolt , pb.description , pcp.id , pcp.foto as foto_bolt, tc.foto as foto_client , tc.name as nome_client , tc.id as id_client , tc.phone as phone_client , tc.phone as whatsapp
FROM tb_clients_bolt pcp
LEFT JOIN tb_cat_barco pb ON pb.id = pcp.category_bolt 
LEFT JOIN tb_client tc ON tc.id = pcp.id_client'); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$id_client = $row["id_client"];
		$name_bolt = $row["name_bolt"];
		$nome_client = $row["nome_client"];
		$phone_client = $row["phone_client"];
		$whatsapp = $row["whatsapp"];
		$foto_bolt = $row["foto_bolt"];
		$foto_client = $row["foto_client"];
		
		if ($foto_client != ""){
			$foto_client = "images/upload/clientes/".$foto_client ;
		}else{
			$foto_client = "images/nouser.png" ;
		}
		
		if ($foto_bolt != ""){
			$foto_bolt = "images/upload/barcos/".$foto_bolt ;
		}else{
			$foto_bolt = "images/nouser.png" ;
		}

		$response['data'][] = array(
			"id"=>$id,
			"id_client"=>$id_client,
			"name_bolt"=>$name_bolt,
			"nome_client"=>$nome_client,
			"phone_client"=>$phone_client,
			"whatsapp"=>$whatsapp,
			"foto_bolt"=>$foto_bolt,
			"foto_client"=>$foto_client,
			"botao"=>'<a style="margin-right: 5px;" class="btn btn-primary btn-xs" id="'.$row['id'].'" href="barco-'.$id.'">
			<i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('.$row['id'].',\''.$name_bolt.'\',\''.$foto_bolt.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
	 } 
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