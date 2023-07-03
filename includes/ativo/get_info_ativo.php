<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

$db = new db(); 

$db->query('SELECT * from tb_companie'); 
$db->execute();
$result_comp = $db->single();






$db->query("SELECT tca.descricao as descricao , tca.* , tc.name as nome_cliente , tc.foto as foto_cliente , 
tc.foto as foto_cliente , tca.type_pai ,  tca.id_depende , tca.id_service , 
tc.id as id_cliente , tl.lat , tl.lon , tl.id as id_local, tl.cep, tl.endereco, tl.cidade, tl.estado, tl.bairro, tl.complemento, tl.numero ,
tc.nome_empresa , DATE_FORMAT(tca.validade ,'%d/%m/%Y') as validade , tt.name as nome_funcionario , tt.id as id_funcionario , ts.short_dec as desc_service,
cond1, modelo_cond1, nserie_cond1, cond2, modelo_cond2, nserie_cond2, cond3, modelo_cond3, nserie_cond3, tl.descricao as localizacao
FROM tb_clients_ativo tca
LEFT JOIN tb_client tc ON tc.id = tca.id_client
LEFT JOIN tb_local tl ON tca.local = tl.id
LEFT JOIN tb_team tt ON tca.responsavel = tt.id 
LEFT JOIN tb_services ts ON tca.id_service = ts.id 

WHERE tca.id = ".$id." "); 
$db->execute();

$result = $db->resultset(); 
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
		
		$foto_empresa = $result_comp["foto"];
		
		if ($foto_empresa != ""){
			$foto_empresa = "images/upload/empresa/".$foto_empresa ;
		}else{
			$foto_empresa = "images/noimage.png" ;
		}
		
		
		$response['data'] = $row;
		$response['data']['foto_ativo'] = $foto; 
		$response['data']['foto_cliente'] = $foto_cliente; 
		$response['data']['foto_empresa'] = $foto_empresa; 
		$response['data']['comp'] = $result_comp;
        //print_r($response);
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