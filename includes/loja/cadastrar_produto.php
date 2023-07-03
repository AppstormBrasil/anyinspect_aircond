<?php
include('../common/util.php'); 

$DataCadastro = date('Y-m-d H:i:s');

$titulo = $_POST["titulo"];
$categoria = $_POST["categoria"];
$tipo = $_POST["tipo"];
$qtd = $_POST["qtd"];
$descricao = $_POST["descricao"];
$valor = $_POST["valor"];



$database = new db();

$database->query("INSERT INTO tb_prod_shooping ( titulo, categoria, tipo, qtd, descricao, preco, data_update) 
		VALUES (:titulo, :categoria, :tipo, :qtd, :descricao,  :valor, :DataCadastro )");

$database->bind(':titulo', $titulo);
$database->bind(':categoria', $categoria);
$database->bind(':tipo', $tipo);
$database->bind(':qtd', $qtd);
$database->bind(':descricao', $descricao);
$database->bind(':valor', $valor);
$database->bind(':DataCadastro', $DataCadastro);

if($database->execute()){
	$last_id = $database->lastInsertId(); 
	$arr['status'] = 'SUCCESS';
	$arr['id_prod'] = $last_id;
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