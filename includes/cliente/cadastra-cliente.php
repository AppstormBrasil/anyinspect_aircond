<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');
$nome_cliente = $_POST["nome_cliente"];
$email = $_POST["email"];
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
$obs = $_POST["obs"];
$lat = $_POST["lat"];
$lon = $_POST["lon"];
$nome_empresa = $_POST["nome_empresa"];
$cnpj = $_POST["cnpj"];


$database = new db();

$database->query("INSERT INTO tb_client (name, cpf, phone,phone2,email,rg,zip,street,number,neighbor, complemento, city, state_,obs,data_cadastro,lat,lon,cnpj,nome_empresa) VALUES (:nome, :cpf, :telefone1, :telefone2, :email, :rg, :cep, :endereco, :numero, :bairro, :complemento, :cidade, :estado, :obs, :current_date,:lat,:lon,:cnpj,:nome_empresa)");
$database->bind(':nome', $nome_cliente);
$database->bind(':email', $email);
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
$database->bind(':current_date', $current_date);
$database->bind(':obs', $obs);
$database->bind(':lat', $lat);
$database->bind(':lon', $lat);
$database->bind(':cnpj', $cnpj);
$database->bind(':nome_empresa', $nome_empresa);

if($database->execute()){
    $last_id = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
	$arr['id_cliente'] = $last_id;
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com o Administrador!' ;
     exit(0);
}
$database->endTransaction();
?>