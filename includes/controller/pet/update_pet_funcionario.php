<?php 
 
include('../../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 

if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} else {$id_funcionario = '';}
 if(isset($_POST['nome'])){ $nome = $_POST['nome'];} else {$nome = '';}
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
 if(isset($_POST['rg'])){ $rg = $_POST['rg'];} else {$rg = '';}
 if(isset($_POST['data_nascimento'])){ $data_nascimento = $_POST['data_nascimento'];} else {$data_nascimento = '';}
 if(isset($_POST['info_extra'])){ $info_extra = $_POST['info_extra'];} else {$info_extra = '';}
 if(isset($_POST['comissao'])){ $comissao = $_POST['comissao'];} else {$comissao = '';}
 

 $data_nascimento = br_to_usa($data_nascimento);
 
 $db->query('UPDATE pet_team SET name = :name , gender = :gender , email = :email , phone = :phone , phone2 = :phone2 , zip = :zip , street = :street, number = :number, complemento = :complemento,neighbor = :neighbor, city = :city, state_ = :estado, cpf = :cpf, rg = :rg, born = :data_nascimento,info_extra = :info_extra, updated_at = :updated_at, comission = :comission WHERE id = :id_funcionario ');
 
 $db->bind(':id_funcionario', $id_funcionario); 
 $db->bind(':name', $nome); 
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
 $db->bind(':rg', $rg);
 $db->bind(':data_nascimento', $data_nascimento);
 $db->bind(':info_extra', $info_extra);
 $db->bind(':updated_at', $data_atualizacao);
 $db->bind(':comission', $comissao);

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