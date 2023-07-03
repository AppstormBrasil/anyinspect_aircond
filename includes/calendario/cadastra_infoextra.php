<?php
include('../common/util.php'); 
$database = new db();
$id_booking = $_POST["id"];
$Newinfo_extra = $_POST["Newinfo_extra"];

$DataCadastro = date('Y-m-d H:i:s');



$database->query("INSERT INTO tb_info_adicional_service (id_booking, Info_adicional, data_cadastro) 
                VALUES (:id_booking, :Newinfo_extra, :DataCadastro)");

$database->bind(':id_booking', $id_booking);
$database->bind(':Newinfo_extra', $Newinfo_extra);
$database->bind(':DataCadastro', $DataCadastro);


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