<?php 
 
include('../common/util.php'); 

$db = new db(); 

$db->query('SELECT tl.*, tc.nome_empresa from tb_local tl 
LEFT JOIN tb_client tc ON tl.id_client = tc.id '); 
$db->execute();

$result = $db->resultset(); 



if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$descricao = $row["descricao"];
		$nome_empresa = $row["nome_empresa"];
		$foto = 'assets/images/nopet.jpg';
		
		$response['data'][] = array(
			"id"=>$id,
			"nome_empresa"=>$nome_empresa,
			"descricao"=>$descricao,
			"botao"=>'<a style="margin-right: 5px;" class="single_link btn btn-primary btn-xs" id="'.$row['id'].'" href="localizacao-'.$row['id'].'">
			<i class="icon-pencil f-s-16"></i></a>&nbsp;<button onclick="RemoveItem('.$row['id'].',\''.$row['descricao'].'\',\''.$foto.'\')" class="btn btn-danger" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-17"></i></button>'
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>