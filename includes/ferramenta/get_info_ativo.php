<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

$db = new db(); 

$db->query("SELECT tca.descricao as descricao , tca.* , tc.name as nome_cliente , tc.foto as foto_cliente , 
tc.foto as foto_cliente , tca.type_pai ,  tca.id_depende , 
tc.id as id_cliente , tl.lat , tl.lon , tl.id as id_local, tl.cep, tl.endereco, tl.cidade, tl.estado, tl.bairro, tl.complemento, tl.numero ,
tc.nome_empresa , DATE_FORMAT(tca.validade ,'%d/%m/%Y') as validade ,  DATE_FORMAT(tca.calibracao ,'%d/%m/%Y') as calibracao , 
tt.name as nome_funcionario , tt.id as id_funcionario , tca.base 
FROM tb_tooling tca
LEFT JOIN tb_client tc ON tc.id = tca.id_client
LEFT JOIN tb_local tl ON tca.local = tl.id
LEFT JOIN tb_team tt ON tca.responsavel = tt.id 
WHERE tca.id = ".$id." "); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		 $foto = $row['foto'];
		 $responsavel = $row['responsavel'];
		 $id_funcionario = $row['id_funcionario'];
		 
		 $foto_cliente = $row['foto_cliente'];
		 if ($foto != ""){
			$foto = 'images/upload/ativos/'.$foto;
		 }else{
			$foto = "assets/images/noimage.png" ;
		 } 

		 if ($foto_cliente != ""){
			$foto_cliente = 'images/upload/clientes/'.$foto_cliente;
		 }else{
			$foto_cliente = "assets/images/nouser.png" ;
		 } 
		
		
		$response['data'] = $row;
		$response['data']['foto_ativo'] = $foto; 
		$response['data']['foto_cliente'] = $foto_cliente; 
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