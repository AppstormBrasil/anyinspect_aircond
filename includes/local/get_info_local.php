<?php 
 
include('../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

$db = new db(); 

$db->query('SELECT tl.* , tt.name 
			FROM tb_local tl
			LEFT JOIN tb_team tt ON tl.responsavel = tt.id 
			WHERE tl.id = "'.$id_cliente.'"'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {

		$response['data'][] = array(
			"id"=>$row['id'],
			"descricao"=>$row['descricao'],
			"lat"=>$row['lat'],
			"lon"=>$row['lon'],
			"responsavel"=>$row['responsavel'],
			"cep"=>$row['cep'],
			"endereco"=>$row['endereco'],
			"cidade"=>$row['cidade'],
			"complemento"=>$row['complemento'],
			"estado"=>$row['estado'],
			"bairro"=>$row['bairro'],
			"numero"=>$row['numero'],
			"nome_responsavel"=>$row['name'],
			"tipo"=>$row['tipo'],
			"carga_termica"=>$row['carga_termica'],
			"num_fixo"=>$row['num_fixo'],
			"num_flutuante"=>$row['num_flutuante'],
			"area_climatizada"=>$row['area_climatizada'],			
			"id_client"=>$row['id_client']			
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
		 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		 $arr['data'][] = array();
	 	 echo json_encode($arr);
	 	 } 

 ?>