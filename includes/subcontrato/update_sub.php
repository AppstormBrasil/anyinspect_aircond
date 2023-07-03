<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id_sub'])){ $id_sub = $_POST['id_sub'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }
 

 if(isset($_POST['nome_cliente'])){ $nome_cliente = $_POST['nome_cliente'];} else {$nome_cliente = '';}
 if(isset($_POST['sexo'])){ $sexo = $_POST['sexo'];} else {$sexo = '';} 
 if(isset($_POST['email'])){ $email = $_POST['email'];} else {$email = '';} 
 if(isset($_POST['telefone1'])){ $telefone1 = $_POST['telefone1'];} else {$telefone1 = '';} 
 if(isset($_POST['telefone2'])){ $telefone2 = $_POST['telefone2'];} else {$telefone2 = '';} 
 if(isset($_POST['cep'])){ $cep = $_POST['cep'];} else {$cep = '';} 
 if(isset($_POST['endereco'])){ $endereco = $_POST['endereco'];} else {$endereco = '';} 
 if(isset($_POST['numero'])){ $numero = $_POST['numero'];} else {$numero = '';} 
 if(isset($_POST['complemento'])){ $complemento = $_POST['complemento'];} else {$complemento = '';} 
 if(isset($_POST['bairro'])){ $bairro = $_POST['bairro'];} else {$bairro = '';} 
 if(isset($_POST['cidade'])){ $cidade = $_POST['cidade'];} else {$cidade = '';} 
 if(isset($_POST['estado'])){ $estado = $_POST['estado'];} else {$estado = '';} 
 if(isset($_POST['cpf'])){ $cpf = $_POST['cpf'];} else {$cpf = '';} 
 if(isset($_POST['data_nascimento'])){ $data_nascimento = $_POST['data_nascimento'];} else {$data_nascimento = '';}
 if(isset($_POST['obs'])){ $obs = $_POST['obs'];} else {$obs = '';}
 if(isset($_POST['lat'])){ $lat = $_POST['lat'];} else {$lat = '';}
 if(isset($_POST['lon'])){ $lon = $_POST['lon'];} else {$lon = '';}
 if(isset($_POST['insta_cliente'])){ $insta_cliente = $_POST['insta_cliente'];} else {$insta_cliente = '';}
 if(isset($_POST['valor_frete'])){ $valor_frete = $_POST['valor_frete'];} else {$valor_frete = '';}
 if(isset($_POST['cnpj'])){ $cnpj = $_POST['cnpj'];} else {$cnpj = '';}
 if(isset($_POST['nome_empresa'])){ $nome_empresa = $_POST['nome_empresa'];} else {$nome_empresa = '';}
 if(isset($_POST['validade_contrato'])){ $validade_contrato = $_POST['validade_contrato'];} else {$validade_contrato = '';}
 if(isset($_POST['funcao'])){ $funcao = $_POST['funcao'];} else {$funcao = '';}
 if(isset($_POST['certificado'])){ $certificado = $_POST['certificado'];} else {$certificado = '';}
 if(isset($_POST['prox_auditoria'])){ $prox_auditoria = $_POST['prox_auditoria'];} else {$prox_auditoria = '';}
 if(isset($_POST['ult_auditoria'])){ $ult_auditoria = $_POST['ult_auditoria'];} else {$ult_auditoria = '';}


 if($validade_contrato != ''){
	$validade_contrato = br_to_usa($validade_contrato);
 } else {
	$validade_contrato = '0000-00-00';
 }

 if($prox_auditoria != ''){
	$prox_auditoria = br_to_usa($prox_auditoria);
 } else {
	$prox_auditoria = '0000-00-00';
 }

 if($ult_auditoria != ''){
	$ult_auditoria = br_to_usa($ult_auditoria);
 } else {
	$ult_auditoria = '0000-00-00';
 }
 
 
 $db->query('UPDATE tb_subcontrato SET name = :name , gender = :gender , email = :email , phone = :phone , phone2 = :phone2 , zip = :zip , street = :street, number = :number, complemento = :complemento,neighbor = :neighbor, city = :city, state_ = :estado, cpf = :cpf, venc_contrato = :venc_contrato,obs = :obs , lat = :lat , lon = :lon , insta_cliente = :insta_cliente  , valor_frete = :valor_frete , cnpj = :cnpj , nome_empresa = :nome_empresa , funcao = :funcao , certificado = :certificado , prox_auditoria = :prox_auditoria , ult_auditoria = :ult_auditoria WHERE id = :id_sub ');
 

 $db->bind(':name', $nome_cliente); 
 $db->bind(':gender', $sexo); 
 $db->bind(':email', $email); 
 $db->bind(':phone', $telefone1); 
 $db->bind(':phone2', $telefone2);
 $db->bind(':zip', $cep); 
 $db->bind(':street', $endereco);
 $db->bind(':number', $numero);
 $db->bind(':complemento', $complemento);
 $db->bind(':neighbor', $bairro);
 $db->bind(':city', $cidade);
 $db->bind(':estado', $estado);
 $db->bind(':cpf', $cpf);
 $db->bind(':venc_contrato', $validade_contrato);
 $db->bind(':obs', $obs);
 $db->bind(':lat', $lat);
 $db->bind(':lon', $lon);
 $db->bind(':insta_cliente', $insta_cliente);
 $db->bind(':valor_frete', $valor_frete);
 $db->bind(':cnpj', $cnpj);
 $db->bind(':nome_empresa', $nome_empresa);
 $db->bind(':funcao', $funcao);
 $db->bind(':certificado', $certificado);
 $db->bind(':prox_auditoria', $prox_auditoria);
 $db->bind(':ult_auditoria', $ult_auditoria);
 $db->bind(':id_sub', $id_sub); 

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