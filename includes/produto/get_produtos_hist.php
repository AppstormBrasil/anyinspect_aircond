<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
if(isset($_GET['id'])){ $id = $_GET['id'];} 
else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	$response['data'] = array();
	echo json_encode($response);
}

$db = new db(); 

$db->query("SELECT tp.desc , tp.foto as foto_produto ,  pte.name as nome_funcionario , pte.foto as foto_usuario ,  
DATE_FORMAT(tph.data_atualizacao ,'%d/%m/%Y %H:%i:%s') as data_atualizacao_ ,  tph.* 
FROM tb_product_hist tph
LEFT JOIN tb_product tp ON tp.id = tph.id_produto
LEFT JOIN tb_team pte ON pte.id = tph.id_usuario
WHERE tph.id_produto = :id"); 
$db->bind(':id', $id); 

$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$desc = $row["desc"];
		$valor = $row["valor"];
		$qtd = $row["qtd"];
		$tipo = $row["tipo"];
		$data_atualizacao = $row["data_atualizacao"];
		$foto_produto = $row["foto_produto"];
		$validade = $row["validade"];
		$nome_funcionario = $row["nome_funcionario"];

		$foto_usuario = $row["foto_usuario"];
		if ($foto_usuario != ""){
			$foto_usuario = "images/upload/funcionarios/".$foto_usuario ;
		}else{
			$foto_usuario = "images/noimage.png" ;
		}

		$validade = usa_to_br($validade);
		$validade = trim($validade);

	
		$response['data'][] = array(
			"id"=>$row['id'],
			"desc"=>$row['desc'],
			"nome_funcionario"=>$row['nome_funcionario'],
			"qtd"=>$row['qtd'],
			"valor"=>"R$".$row['valor'],
			"validade"=>$validade,
			"tipo"=>$tipo,
			"data_atualizacao"=>$row['data_atualizacao_'],
			"foto_usuario"=>$foto_usuario
		);
	 }
	 	 $arr['status'] = 'SUCCESS';
		 echo json_encode($response);
	 	 exit(0);
} else { 
		 $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>