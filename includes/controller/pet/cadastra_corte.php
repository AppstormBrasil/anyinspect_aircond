<?php
include('../../common/util.php'); 

$tipo_corte = $_POST["tipo_corte"];

$database = new db();

$database->query("INSERT INTO pet_cut (description) VALUES (:tipo_corte)");
$database->bind(':tipo_corte', $tipo_corte);

if($database->execute()){
    $last_id = $database->lastInsertId(); 

    $arr['status'] = 'SUCCESS';
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