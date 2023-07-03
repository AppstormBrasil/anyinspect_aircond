<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 

if(isset($_POST['bairro'])){ $bairro = $_POST['bairro'];} else {$bairro = '';}
 if(isset($_POST['cep'])){ $cep = $_POST['cep'];} else {$sexo = '';} 
 if(isset($_POST['cidade'])){ $cidade = $_POST['cidade'];} else {$cidade = '';} 
 if(isset($_POST['cnpj'])){ $cnpj = $_POST['cnpj'];} else {$cnpj = '';} 
 if(isset($_POST['email'])){ $email = $_POST['email'];} else {$email = '';} 
 if(isset($_POST['endereco'])){ $endereco = $_POST['endereco'];} else {$endereco = '';} 
 if(isset($_POST['estado'])){ $estado = $_POST['estado'];} else {$estado = '';} 
 if(isset($_POST['facebook'])){ $facebook = $_POST['facebook'];} else {$facebook = '';} 
 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';} 
 if(isset($_POST['info_extra'])){ $info_extra = $_POST['info_extra'];} else {$info_extra = '';} 
 if(isset($_POST['instagram'])){ $instagram = $_POST['instagram'];} else {$instagram = '';} 
 if(isset($_POST['nome_empresa'])){ $nome_empresa = $_POST['nome_empresa'];} else {$nome_empresa = '';} 
 if(isset($_POST['number'])){ $number = $_POST['number'];} else {$number = '';} 
 if(isset($_POST['phone'])){ $phone = $_POST['phone'];} else {$phone = '';}
 if(isset($_POST['website'])){ $website = $_POST['website'];} else {$website = '';}
 if(isset($_POST['whatsapp'])){ $whatsapp = $_POST['whatsapp'];} else {$whatsapp = '';}
 if(isset($_POST['lat'])){ $lat = $_POST['lat'];} else {$lat = '';}
 if(isset($_POST['lon'])){ $lon = $_POST['lon'];} else {$lon = '';}


 $db->query('UPDATE tb_companie SET bairro = :bairro , cep = :cep , cidade = :cidade , cnpj = :cnpj , email = :email , endereco = :endereco , estado = :estado, facebook = :facebook, info_extra = :info_extra,instagram = :instagram, nome_empresa = :nome_empresa, number = :number, phone = :phone, website = :website, whatsapp = :whatsapp WHERE id = :id ');
 

 $db->bind(':bairro', $bairro); 
 $db->bind(':cep', $cep); 
 $db->bind(':cidade', $cidade); 
 $db->bind(':cnpj', $cnpj); 
 $db->bind(':email', $email);
 $db->bind(':endereco', $endereco); 
 $db->bind(':estado', $estado);
 $db->bind(':facebook', $facebook);
 $db->bind(':info_extra', $info_extra);
 $db->bind(':instagram', $instagram);
 $db->bind(':nome_empresa', $nome_empresa);
 $db->bind(':number', $number);
 $db->bind(':phone', $phone);
 $db->bind(':website', $website);
 $db->bind(':whatsapp', $whatsapp);
 $db->bind(':id', 1); 

 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>