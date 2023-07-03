<?php
include('../common/util.php'); 
$database = new db();
$tipo_servico = $_POST["tipo_servico"];
$tempo_estimado = $_POST["tempo_estimado"];
$preco_sugerido = $_POST["preco_sugerido"];
$description = $_POST["description"];


$database->query("INSERT INTO tb_services (short_dec, est_time, price,description) VALUES (:tipo_servico, :tempo_estimado, :preco_sugerido,:description)");
$database->bind(':tipo_servico', $tipo_servico);
$database->bind(':tempo_estimado', $tempo_estimado);
$database->bind(':preco_sugerido', $preco_sugerido);
$database->bind(':description', $description);

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