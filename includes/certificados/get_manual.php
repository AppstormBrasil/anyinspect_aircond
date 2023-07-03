<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$id = $_GET["id"];

$db->query("SELECT tm.*
FROM tb_manuais tm WHERE tm.id = :id "); 
$db->bind(':id', $id);
$db->execute();

// id, pub, rev, data_eff, descricao, tipo, ref_fabricante, empresa

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$pub = $row["pub"];
		$rev = $row["rev"];
		$data_eff = $row["data_eff"];
		$descricao = $row["descricao"];
		$tipo = $row["tipo"];
		$ref_fabricante = $row["ref_fabricante"];
		$empresa = $row["empresa"];
		$link = $row["link"];
		$obs = $row["obs"];

		$filename = "../../images/upload/manuais/".$id."/".$id.".pdf" ;
	
		if (file_exists($filename)) {
			$link_file = "images/upload/manuais/".$id."/".$id.".pdf" ;
		} else {
			$link_file = "";
		}

	

		$response['data'] = array(
			"id"=>$id,
			"pub"=>$pub,
			"rev"=>$rev,
			"data_eff"=>$data_eff,
			"descricao"=>$descricao,
			"tipo"=>$tipo,
			"ref_fabricante"=>$ref_fabricante,
			"empresa"=>$empresa,
			"link_file"=>$link_file,
			"link"=>$link,
			"obs"=>$obs
		);
	 } 
	 	 $response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $response['status'] = 'ERROR'; 
	 	 $response['status_txt'] = 'Nenhuma informacao disponivel'; 
		 $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>