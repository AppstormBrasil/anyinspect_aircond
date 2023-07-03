<?php

include('../common/util.php'); 

$database = new db();

$id_funcionario = $_POST["id_funcionario"];
$dia_semana = $_POST["dia_semana"];
$horaInicio = $_POST["horaInicio"];
$horafinal = $_POST["horafinal"];
$pausaInicio = $_POST["pausaInicio"];
$pausaFinal = $_POST["pausaFinal"];


$database->query(" SELECT tjt.id_func FROM tb_jornada_trabalho tjt
					WHERE  tjt.id_func = :id_funcionario AND dia_semana = :dia_semana");
	
	$database->bind(':id_funcionario', $id_funcionario);
	$database->bind(':dia_semana', $dia_semana);

$database->execute();
$result = $database->resultset(); 

if($result){

     $arr['status'] = 'ERROR'; 
         $arr['status_txt'] = 'Dia já cadastrado!!'; 
         echo json_encode($arr);
         exit(0);
    }else{		


$database->query("INSERT INTO tb_jornada_trabalho(id_func, dia_semana, hora_inicio, hora_termino, pausa_incio, pausa_final)VALUES (:id_funcionario, :dia_semana, :horaInicio, :horafinal, :pausaInicio, :pausaFinal)"); 

	$database->bind(':id_funcionario', $id_funcionario);
	$database->bind(':dia_semana', $dia_semana);
	$database->bind(':horaInicio', $horaInicio);
	$database->bind(':horafinal', $horafinal);
	$database->bind(':pausaInicio', $pausaInicio);
	$database->bind(':pausaFinal', $pausaFinal);
	

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