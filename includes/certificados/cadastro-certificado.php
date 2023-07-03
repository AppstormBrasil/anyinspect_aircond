<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');


$descricao = $_POST["descricao"];
$conteudo = $_POST["conteudo"];


$database = new db();

$database->query("INSERT INTO tb_certificado (descricao , conteudo) VALUES (:descricao , :conteudo)");
$database->bind(':descricao', $descricao);
$database->bind(':conteudo', $conteudo);
if($database->execute()){
    $last_id = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
	$arr['last_id'] = $last_id;
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