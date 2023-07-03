<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$id = $_GET["id"];

$db->query("SELECT tc.*
FROM tb_certificado_team tc WHERE tc.id = :id "); 
$db->bind(':id', $id);
$db->execute();

// id, pub, rev, data_eff, descricao, tipo, ref_fabricante, empresa

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$descricao = $row["descricao"];
		$conteudo = $row["conteudo"];
		$id_colaborador = $row['id_colaborador'];
		$data = $row['data'];
		$data = usa_to_br($data);

		$response['data'] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"id_colaborador"=>$id_colaborador,
			"data"=>$data,
			"conteudo"=>$conteudo,
		);
	 } 

	 	$db->query('SELECT * from tb_companie'); 
		$db->execute();
		$result = $db->single(); 

		$foto_empresa = $result['foto'];
		if ($foto_empresa != ""){
			$foto_empresa = 'images/upload/empresa/'.$foto_empresa;
		}else{
			$foto_empresa = "assets/images/noimage.png" ;
		} 
		$response['empresa'] = array(
			"id"=>$result['id'],
			"nome_empresa"=>$result['nome_empresa'],
			"email"=>$result['email'],
			"phone"=>$result['phone'],
			"cep"=>$result['cep'],
			"endereco"=>$result['endereco'],
			"bairro"=>$result['bairro'],
			"number"=>$result['number'],
			"cidade"=>$result['cidade'],
			"estado"=>$result['estado'],
			"foto_empresa"=>$foto_empresa
		);

		// GET RESP NAME

		$db->query('SELECT tt.name , tt.sign from tb_team tt WHERE tt.type2 = 1'); 
		$db->execute();
		$result = $db->single(); 
		$response['responsavel'] = array(
			"name"=>$result['name'],
			"sign"=>$result['sign'],

		);



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