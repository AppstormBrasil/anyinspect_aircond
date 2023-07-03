<?php
include('../common/util.php'); 

$DataCadastro = date('Y-m-d H:i:s');

$id_prod = $_POST["id_prod"];
$nome = $_POST["nome"];
$tipo_prod = $_POST["tipo_prod"];
$preco_prod = $_POST["preco_prod"];
$quantidade = $_POST["quantidade"];


$database = new db();

$database->query("INSERT INTO tb_variante_prod ( id_prod_venda, nome, tipo, preco, qtd, data_atualizacao)     
		VALUES (:id_prod, :nome, :tipo_prod, :preco_prod, :quantidade, :data_atualizacao )");

$database->bind(':id_prod', $id_prod);
$database->bind(':nome', $nome);
$database->bind(':tipo_prod', $tipo_prod);
$database->bind(':preco_prod', $preco_prod);
$database->bind(':quantidade', $quantidade);
$database->bind(':data_atualizacao', $DataCadastro);

if($database->execute()){
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