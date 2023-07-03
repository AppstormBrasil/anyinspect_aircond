<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT ttq.* , tt.name , tt.foto ,  DATEDIFF(ttq.validade_qual , NOW() ) as dias_expira , DATE_FORMAT( ttq.validade_qual ,'%d/%m/%Y') as validade_qual 
FROM tb_team_qual ttq
LEFT JOIN tb_team tt ON tt.id = ttq.id_func ORDER BY DATEDIFF(ttq.validade_qual , NOW()) "); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 

	 // id, id_func, desc_qual, tipo_qual, validade_qual, numero_qual, data_cadastro, horaria_qual, local_qual, dataini_qual, datafim_qual, name, dias_expira, validade_qual

	 foreach($result as $row) {
		$id_func = $row["id_func"];
		$desc_qual = $row["desc_qual"];
		$name = $row["name"];
		$tipo_qual = $row["tipo_qual"];
		$validade_qual = $row["validade_qual"];
		$dias_expira = $row["dias_expira"];
		$foto = $row["foto"];

		if ($foto != ""){
			$foto = "images/upload/funcionarios/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

		$response['data'][] = array(
			"id_func"=>$id_func,
			"name"=>$name,
			"desc_qual"=>$desc_qual,
			"tipo_qual"=>$tipo_qual,
			"validade_qual"=>$validade_qual,
			"dias_expira"=>$dias_expira,
			"foto"=>$foto,
			
		);
	 } 
	 	 //$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response[] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>