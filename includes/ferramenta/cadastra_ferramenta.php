<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$descricao = $_POST["descricao"];
$local = $_POST["local"];
$patrimonio = $_POST["patrimonio"];
$sn = $_POST["sn"];
$pn = $_POST["pn"];
$calibracao = $_POST["calibracao"];
$vencimento = $_POST["vencimento"];
$tipo = $_POST["tipo"];


$database = new db();

$database->query("INSERT INTO tb_tooling (descricao, local, patrimonio, sn, pn, calibracao, validade , data_create, tipo) 
VALUES (:descricao, :local, :patrimonio, :sn, :pn, :calibracao, :validade , :data_create, :tipo)");
$database->bind(':descricao', $descricao);
$database->bind(':local', $local);
$database->bind(':patrimonio', $patrimonio);
$database->bind(':sn', $sn);
$database->bind(':pn', $pn);
$database->bind(':calibracao', $calibracao);
$database->bind(':validade', $vencimento);
$database->bind(':data_create', $current_date);
$database->bind(':tipo', $tipo);

if($database->execute()){
    
    $last_id = $database->lastInsertId(); 
    

    if($patrimonio == ''){
        $qrcode_number = str_pad($last_id, 4, 0, STR_PAD_LEFT);
    } else {
        $qrcode_number = $patrimonio;
    }

    $qrcode = 'TAG-'.$qrcode_number;

    $database->query('UPDATE tb_tooling SET qrcode = :qrcode WHERE id = :id ');
    $database->bind(':qrcode', $qrcode); 
    $database->bind(':id', $last_id); 
    $database->execute();


    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    $arr['last_id'] = $last_id;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>