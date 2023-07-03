<?php

include('../common/util.php');
	


$IdUsuario = 1;


$form_data = array_merge($_POST, (array) json_encode(file_get_contents('php://input')));


$titulo_formulario = $form_data['titulo_formulario']; 
$tipo_formulario = $form_data['tipo_formulario'];
$conteudo_formulario =  $form_data['conteudo_formulario'];
insert_result($IdUsuario,$titulo_formulario,$tipo_formulario,$conteudo_formulario);

function insert_result($IdUsuario,$titulo_formulario,$tipo_formulario,$conteudo_formulario){

	$date_now = date('Y-m-d H:i:s');
    
    $IdUsuario = $IdUsuario;
    $titulo_formulario = $titulo_formulario;
    $tipo_formulario = $tipo_formulario;
    $conteudo_formulario = $conteudo_formulario;
    $status_formulario = 1;
	
	$db = new db();

	$db->query('INSERT INTO formulario (IdUsuario,titulo_formulario,tipo_formulario,conteudo_formulario,data_cadastro,data_atualizacao,status_formulario) VALUES ( :IdUsuario, :titulo_formulario, :tipo_formulario, :conteudo_formulario, :data_cadastro, :data_atualizacao, :status_formulario)');
	
	$db->bind(':IdUsuario', $IdUsuario);
	$db->bind(':titulo_formulario', $titulo_formulario);
	$db->bind(':tipo_formulario', $tipo_formulario);
	$db->bind(':conteudo_formulario', $conteudo_formulario);
	$db->bind(':data_cadastro', $date_now);
    $db->bind(':data_atualizacao', $date_now);
    $db->bind(':status_formulario', $status_formulario);
    
    if($db->execute()){ 
        $lastInsertId = $db->lastInsertId();
        $arr['lastInsertId'] = $lastInsertId; 
        $arr['status'] = 'SUCCESS';
        $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
        echo json_encode($arr);
   } else {
        $arr['status'] = 'ERROR';
        $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
   }
	
}

