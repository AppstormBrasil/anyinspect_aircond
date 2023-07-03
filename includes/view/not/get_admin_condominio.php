<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
 if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$IdCondominio = $id; 
if($id > 0){ 
 	 $db->query('SELECT IdCondominio,email,senha,cnpj,telefone1,telefone2,telefone3,cep,endereco,numero,bairro,cidade,estado,pais,tipo_condomino,data_cadastro,imagem,status,qrcode_condominio FROM tb_admin_condominio WHERE IdCondominio ='. $id .' '); 
 } else { 
  	 $db->query('SELECT IdCondominio,email,senha,cnpj,telefone1,telefone2,telefone3,cep,endereco,numero,bairro,cidade,estado,pais,tipo_condomino,data_cadastro,imagem,status,qrcode_condominio FROM tb_admin_condominio '); 
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 foreach($result as $row) { 
	 	 $arr['response'][] = $row; 
	 } 
	 	 $arr['status'] = 'SUCCESS';
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informaзгo disponнvel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>