<?php
include('../common/util.php'); 

$descricao = $_POST["descricao"];
$conteudo = $_POST["conteudo"];
$id_colaborador = $_POST["id_colaborador"];
$data_inicial = $_POST["data_inicial"];

$data_inicial = explode("/", $data_inicial);
$data_inicial = $data_inicial[2]."-".$data_inicial[1]."-".$data_inicial[0];

$database = new db();

$database->query("INSERT INTO tb_certificado_team (descricao , conteudo, data, id_colaborador) VALUES (:descricao , :conteudo, :data_inicial, :id_colaborador)");
$database->bind(':descricao', $descricao);
$database->bind(':conteudo', $conteudo);
$database->bind(':data_inicial', $data_inicial);
$database->bind(':id_colaborador', $id_colaborador);
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