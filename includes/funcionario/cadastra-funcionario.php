<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$nome = $_POST["nome"];
//$sexo = $_POST["sexo"];
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
$cpf = "";
$rg = "";
$data_nascimento = "";
$info_extra = "";
$type = $_POST["type"];

if($data_nascimento == ""){
}else{
	$data_nascimento = br_to_usa($data_nascimento);
}

$database = new db();


$database->query("SELECT pt.id
FROM tb_team pt 
WHERE pt.email like '%$email%'");  

$result = $database->single(); 
$database->execute();
if($result){
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Erro! E-mail ja cadastrado!' ;
    echo json_encode($arr);
    exit(0);
}

$database->query("INSERT INTO tb_team (name, email, password, cpf, rg, created_at, phone, phone2, zip, street, neighbor, city, state_, number, complemento, info_extra, born, type) VALUES (:nome, 
:email, :senha, :cpf, :rg, :current_date, :telefone1, :telefone2, :cep, :endereco, :bairro, :cidade, :estado, :numero, :complemento, :info_extra, :data_nascimento, :type )");
$database->bind(':nome', $nome);
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
    $id_func = $database->lastInsertId(); 
    insert_jornada($id_func);
    $arr['status'] = 'SUCCESS';
	$arr['id_funcionario'] = $id_func;
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();




function insert_jornada($id_func){
         $database = new db();
    for ($i = 0; $i <= 6; $i++) {
        $database->query("INSERT INTO tb_jornada_trabalho (id_func, dia_semana, hora_inicio, hora_termino, pausa_incio, pausa_final) 
        VALUES (:id_func, :dia_semana, :hora_inicio, :hora_termino, :pausa_incio, :pausa_final )");
        $database->bind(':id_func', $id_func);
        $database->bind(':dia_semana', $i);
        $database->bind(':hora_inicio', "07:00:00");
        $database->bind(':hora_termino', "18:00:00");
        $database->bind(':pausa_incio', "12:00:00");
        $database->bind(':pausa_final', "13:00:00");
        $database->execute();
    }



    
}


?>