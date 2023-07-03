<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

if(isset($_GET['id'])){ 

	$code = $_GET['id'];
	$db->query("SELECT tca.descricao , tca.foto as foto_ativo, tca.id as id_ativo , tcat.description as categoria , tca.local ,   tcat.id , tcl.foto as foto_client , tcl.name as nome_client , tcl.id as id_client , tcl.phone as phone_client , tl.descricao as descricao_local , DATE_FORMAT(tca.validade,'%d/%m/%Y' ) as data_validade , tca.model , tca.register , tcl.nome_empresa , tca.patrimonio, tca.sn, tca.pn, tca.calibracao , DATE_FORMAT(tca.calibracao,'%d/%m/%Y' ) as calibracao , tca.tipo 
	FROM tb_tooling tca
	LEFT JOIN tb_client tcl ON tcl.id = tca.id_client
	LEFT JOIN tb_category tcat ON tcat.id = tca.category 
	LEFT JOIN tb_local tl ON tl.id = tca.local WHERE qrcode like '%".$code."%' "); 
	
  }else{ 

	$response['status'] = 'ERROR'; 
	$response['status_txt'] = 'Nenhuma informacao disponivel'; 
	$response[] = array();
	echo json_encode($response);


}
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
		$patrimonio = $row["patrimonio"];
		$sn = $row["sn"];
		$pn = $row["pn"];
		$calibracao = $row["calibracao"];
		$tipo = $row["tipo"];

		
		
		if ($foto_client != ""){
			$foto_client = "images/upload/clientes/".$foto_client ;
		}else{
			$foto_client = "images/nouser.png" ;
		}
		
		if ($foto_ativo != ""){
			$foto_ativo = "images/upload/ferramenta/".$foto_ativo ;
		}else{
			$foto_ativo = "images/noimage.png" ;
		}

		$response[] = array(
			"id"=>$id_ativo,
			"id_client"=>$id_client,
			"descricao"=>$descricao,
			"nome_client"=>$nome_client,
			"categoria"=>$categoria,
			"local"=>$descricao_local,
			"model"=>$model,
			"register"=>$register,
			"foto_ativo"=>$foto_ativo,
			"foto_client"=>$foto_client,
			"data_validade"=>$data_validade,
			"patrimonio"=>$patrimonio,
			"tipo"=>$tipo,
			"sn"=>$sn,
			"pn"=>$pn,
			"calibracao"=>$calibracao,
			"botao"=>'<a style="margin-right: 5px;" class="btn btn-primary btn-xs" id="'.$id_ativo.'" href="ferramenta-'.$id_ativo.'">
			<i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('.$id_ativo.',\''.$descricao.'\',\''.$foto_ativo.'\')" id="'.$id_ativo.'" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
	 } 
	 	 $response['status'] = 'SUCCESS';
		 echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $response['status'] = 'ERROR'; 
	 	 $response['status_txt'] = 'Nenhuma informacao disponivel'; 
		 $response[] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>