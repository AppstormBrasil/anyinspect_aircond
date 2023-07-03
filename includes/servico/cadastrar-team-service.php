<?php
include('../common/util.php');
$data_cadastro = date('Y-m-d H:i:s'); 
$database = new db();
$id_funcionario = $_POST["id_funcionario"];
$servico = $_POST["servico"];
$porComicao = $_POST["porcentagemComicao"];

$database->query("SELECT  tbs.id_team FROM tb_team_service tbs
            WHERE tbs.id_team =:id_team and id_service =:id_service
");

$database->bind(':id_team', $id_funcionario);
$database->bind(':id_service', $servico);

$database->execute();
$result = $database->resultset(); 

if($result){

     $arr['status'] = 'ERROR'; 
         $arr['status_txt'] = 'Serviço já cadastrado'; 
         echo json_encode($arr);
         exit(0);
    }else{
    

$database->query("INSERT INTO tb_team_service (id_team, id_service, comission, data_cadastro) 
		VALUES (:id_funcionario, :servico, :porComicao, :data_cadastro)");

	$database->bind(':id_funcionario', $id_funcionario);
	$database->bind(':servico', $servico);
	$database->bind(':porComicao', $porComicao);
	$database->bind(':data_cadastro', $data_cadastro);



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

}


?>

