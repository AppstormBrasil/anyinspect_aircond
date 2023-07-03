<?php
include('../common/util.php'); 

$current_date = date('Y-m-d H:i:s');
$data_eff = $_POST["data_eff"];
$descricao = $_POST["descricao"];
$empresa = $_POST["empresa"];
$pub = $_POST["pub"];
$ref_fabricante = $_POST["ref_fabricante"]; 
$rev = $_POST["rev"];
$tipo = $_POST["tipo"];
$link = $_POST["link"];
$obs = $_POST["obs"];
$id = $_POST["id"];

$database = new db();
$database->query('UPDATE tb_manuais SET pub = :pub , rev = :rev , data_eff = :data_eff, 
descricao = :descricao, tipo = :tipo, ref_fabricante = :ref_fabricante, empresa = :empresa , link = :link , obs = :obs 
WHERE id = :id ');

$database->bind(':pub', $pub);
$database->bind(':rev', $rev);
$database->bind(':data_eff', $data_eff);
$database->bind(':descricao', $descricao);
$database->bind(':tipo', $tipo);
$database->bind(':ref_fabricante', $ref_fabricante);
$database->bind(':empresa', $empresa);
$database->bind(':link', $link);
$database->bind(':obs', $obs);
$database->bind(':id', $id);

if($database->execute()){
    $id_func = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
	$arr['id_funcionario'] = $id_func;
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