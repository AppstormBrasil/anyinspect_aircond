<?php
include('../../common/util.php');
	
$IdEmpresa = 1;
$IdUsuario = 1;

$form_data = array_merge($_POST, (array) json_encode(file_get_contents('php://input')));
//$titulo_formulario = $form_data['titulo_formulario']; 
//$tipo_formulario = $form_data['tipo_formulario'];
$titulo_formulario = 'TESTE1'; 
$tipo_formulario = 'TESTE2'; 
$IdFormulario = $form_data['IdFormulario'];
$conteudo_formulario =  $form_data['conteudo_formulario'];

update_result($IdEmpresa,$IdUsuario,$titulo_formulario,$tipo_formulario,$conteudo_formulario,$IdFormulario);

function update_result($IdEmpresa,$IdUsuario,$titulo_formulario,$tipo_formulario,$conteudo_formulario,$IdFormulario){

	$date_now = date('Y-m-d H:i:s');
    $IdEmpresa = $IdEmpresa;
    $IdUsuario = $IdUsuario;
    $titulo_formulario = $titulo_formulario;
    $tipo_formulario = $tipo_formulario;
    $conteudo_formulario = $conteudo_formulario;
    $IdFormulario = $IdFormulario;
	
	$db = new db();
    $db->query('UPDATE tb_service_resp SET data = :data WHERE id = :id ');
	$db->bind(':data', $conteudo_formulario);
    $db->bind(':id', $IdFormulario);
    
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

