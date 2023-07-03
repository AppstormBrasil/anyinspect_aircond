<?php
include('../common/util.php'); 

$descricao = $_POST["descricao"];
$conteudo = $_POST["conteudo"];
$id = $_POST["id"];

$database = new db();
$database->query('UPDATE tb_certificado SET descricao = :descricao , conteudo = :conteudo WHERE id = :id ');

$database->bind(':descricao', $descricao);
$database->bind(':conteudo', $conteudo);
$database->bind(':id', $id);

if($database->execute()){
    $id_func = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
	$arr['id_funcionario'] = $id_func;
    $arr['status_txt'] = 'Editado realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();


?>