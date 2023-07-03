<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT tca.descricao , tca.foto as foto_ativo, tca.id as id_ativo , tcat.description as categoria , tca.local ,   tcat.id , tcl.foto as foto_client , tcl.name as nome_client , tcl.id as id_client , tcl.phone as phone_client , tl.descricao as descricao_local , DATE_FORMAT(tca.validade,'%d/%m/%Y' ) as data_validade , tca.model , tca.register , tcl.nome_empresa , ts.short_dec
FROM tb_clients_ativo tca
LEFT JOIN tb_client tcl ON tcl.id = tca.id_client
LEFT JOIN tb_category tcat ON tcat.id = tca.category 
LEFT JOIN tb_local tl ON tl.id = tca.local 
LEFT JOIN tb_services ts ON ts.id = tca.id_service 

"); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id_ativo = $row["id_ativo"];
		$id_client = $row["id_client"];
		$descricao = $row["descricao"];
		$nome_client = $row["nome_empresa"];
		$phone_client = $row["phone_client"];
		$foto_ativo = $row["foto_ativo"];
		$foto_client = $row["foto_client"];
		$local = $row["local"];
		$categoria = $row["categoria"];
		$descricao_local = $row["descricao_local"];
		$data_validade = $row["data_validade"];
		$model = $row["model"];
		$register = $row["register"];
		$short_dec = $row["short_dec"];
		
		if ($foto_client != ""){
			$foto_client = "images/upload/clientes/".$foto_client ;
		}else{
			$foto_client = "images/nouser.png" ;
		}
		
		if ($foto_ativo != ""){
			$foto_ativo = "images/upload/ativos/".$foto_ativo ;
		}else{
			$foto_ativo = "images/nouser.png" ;
		}

		$response['data'][] = array(
			"id"=>$id_ativo,
			"id_client"=>$id_client,
			"short_dec"=>$short_dec,
			"descricao"=>$descricao,
			"nome_client"=>$nome_client,
			"categoria"=>$categoria,
			"local"=>$descricao_local,
			"model"=>$model,
			"register"=>$register,
			"foto_ativo"=>$foto_ativo,
			"foto_client"=>$foto_client,
			"data_validade"=>$data_validade,
			"botao"=>'<a style="margin-right: 5px;" class="single_link btn btn-primary btn-xs" id="'.$row['id_ativo'].'" href="ativo-'.$id_ativo.'">
			<i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('.$row['id_ativo'].',\''.$descricao.'\',\''.$foto_ativo.'\')" id="'.$id_ativo.'" type="button"><i class="icon-trash f-s-16"></i></button>'
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