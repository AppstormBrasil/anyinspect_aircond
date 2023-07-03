<?php
include('../../common/util.php'); 

$raca_pet = $_POST["raca_pet"];

$database = new db();

$database->query("INSERT INTO pet_breeds (description) VALUES (:raca_pet)");
$database->bind(':raca_pet', $raca_pet);

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