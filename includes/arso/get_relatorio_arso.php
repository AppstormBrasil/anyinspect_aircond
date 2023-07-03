<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT * FROM tb_arso "); 

$result = $db->resultset(); 
if($result){

	$response['arso'] = $result;

	
	 
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

		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response[] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>