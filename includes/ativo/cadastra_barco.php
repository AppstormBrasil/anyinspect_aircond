<?php
include('../../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$id_cliente = $_POST["id_cliente"];
$nome_pet = $_POST["nome_pet"];
$raca_pet = $_POST["raca_pet"];
$sexo_pet = $_POST["sexo_pet"];
$porte_pet = $_POST["porte_pet"];
$hair_pet = $_POST["hair_pet"];
$mood_pet = $_POST["mood_pet"];
$obs_pet = $_POST["obs_pet"];
$dt_nasc_pet = $_POST["dt_nasc_pet"];

if($dt_nasc_pet != ''){
    $dt_nasc_pet = br_to_usa($dt_nasc_pet);
} else {
    $dt_nasc_pet = '0000-00-00 00:00:00';
}



$database = new db();

$database->query("INSERT INTO pet_clients_pet (id_client, name, breed, gender, mood, size, hair, dt_nasc, obs, data_cadastro) VALUES (:id_client, :nome_pet, :breed, :gender, :mood, :size, :hair, :dt_nasc_pet, :obs, :current_date)");

$database->bind(':id_client', $id_cliente);
$database->bind(':nome_pet', $nome_pet);
$database->bind(':breed', $raca_pet);
$database->bind(':gender', $sexo_pet);
$database->bind(':size', $porte_pet);
$database->bind(':hair', $hair_pet);
$database->bind(':mood', $mood_pet);
$database->bind(':obs', $obs_pet);
$database->bind(':dt_nasc_pet', $dt_nasc_pet);
$database->bind(':current_date', $current_date);

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