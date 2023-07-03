<?php
include('../../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$nome = $_POST["nome"];
$sexo = $_POST["sexo"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$senha = md5($senha);
$telefone1 = $_POST["telefone1"];
$telefone2 = $_POST["telefone2"];
$cep = $_POST["cep"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$complemento = $_POST["complemento"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cpf = $_POST["cpf"];
$rg = $_POST["rg"];
$data_nascimento = $_POST["data_nascimento"];
$info_extra = $_POST["info_extra"];
$type = "f";

if($data_nascimento == ""){
}else{
	$data_nascimento = br_to_usa($data_nascimento);
}

$database = new db();

$database->query("INSERT INTO pet_team (name, gender, email, password, cpf, rg, created_at, phone, phone2, zip, street, neighbor, city, state_, number, complemento, info_extra, born, type) VALUES (:nome, 
:sexo, :email, :senha, :cpf, :rg, :current_date, :telefone1, :telefone2, :cep, :endereco, :bairro, :cidade, :estado, :numero, :complemento, :info_extra, :data_nascimento, :type )");
$database->bind(':nome', $nome);
$database->bind(':sexo', $sexo);
$database->bind(':email', $email);
$database->bind(':senha', $senha);
$database->bind(':cpf', $cpf);
$database->bind(':rg', $rg);
$database->bind(':telefone1', $telefone1);
$database->bind(':telefone2', $telefone2);
$database->bind(':cep', $cep);
$database->bind(':endereco', $endereco);
$database->bind(':numero', $numero);
$database->bind(':complemento', $complemento);
$database->bind(':bairro', $bairro);
$database->bind(':cidade', $cidade);
$database->bind(':estado', $estado);
$database->bind(':data_nascimento', $data_nascimento);
$database->bind(':current_date', $current_date);
$database->bind(':info_extra', $info_extra);
$database->bind(':type', $type);

if($database->execute()){
    $last_id = $database->lastInsertId(); 

    $arr['status'] = 'SUCCESS';
	$arr['id_funcionario'] = $last_id;
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>