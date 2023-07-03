<?php
include('../common/util.php'); 

$description = $_POST["description"];

$database = new db();

$database->query('SELECT description from tb_category WHERE description = "'.$description.'" '); 
$database->execute();
$result = $database->single();


if($result['description'] != ''){
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Ops! Esta categoria já esta cadastrada' ;
    echo json_encode($arr);
    exit(0);
}

$database->query("INSERT INTO tb_category (description) VALUES (:description)");
$database->bind(':description', $description);

if($database->execute()){
    $last_id = $database->lastInsertId(); 

    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     echo json_encode($arr);
     exit(0);
}
$database->endTransaction();
?>