<?php
include('../../common/util.php'); 
$database = new db();
$tipo_servico = $_POST["tipo_servico"];
$tempo_estimado = $_POST["tempo_estimado"];
$preco_sugerido = $_POST["preco_sugerido"];


if(isset($_POST['produtos'])){ $produtos = $_POST['produtos'];} else {$produtos = '';}



$database->query("INSERT INTO pet_services (short_dec, est_time, price) VALUES (:tipo_servico, :tempo_estimado, :preco_sugerido)");
$database->bind(':tipo_servico', $tipo_servico);
$database->bind(':tempo_estimado', $tempo_estimado);
$database->bind(':preco_sugerido', $preco_sugerido);
//$database->bind(':produtos', $produtos);

if($database->execute()){
    $last_id = $database->lastInsertId(); 

    if($produtos != ''){
        foreach($produtos as $row) {
            $database->query("INSERT INTO tb_service_prod (id_service, id_product) VALUES (:id_service, :id_product)");
            $database->bind(':id_service', $last_id);
            $database->bind(':id_product', $row);
            $database->execute();
        }
    }

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