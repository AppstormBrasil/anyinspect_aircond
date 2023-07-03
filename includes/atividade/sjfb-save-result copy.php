<?php

include('../common/util.php');
	


//$IdUsuario = get_current_id();
$IdUsuario = "1";


$form_data2 = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));
$new_data = json_decode($form_data2['data']);
$new_data2 = json_decode($form_data2['data2']);
$IdFormulario = $form_data2['formID']; 
$IdEvento = $form_data2['at'];

$db = new db();
$db->query('SELECT IdEvento
                    FROM formulario_resposta fr 
                    WHERE fr.IdEvento = :IdEvento ');
$db->bind(':IdEvento', $IdEvento);
$row = $db->single();

if($row != ''){
  $db = new db();
  $db->beginTransaction();
  $db->query('DELETE FROM formulario_resposta WHERE IdEvento = :IdEvento ');
  $db->bind(':IdEvento', $IdEvento);
  $row = $db->execute();
  $db->endTransaction();

  $final_result = "";
  $dummy_model = "";
    foreach ($new_data as $key => $value) {
        $field[$value->name] = $value->value;

        if (count($value->value) > 1){
            foreach ($value->value as $result){
                $final_result .= $result.',';
                
            }
            $final_result = substr($final_result, 0, -1);
        
        } else {
            $final_result = $value->value[0];
        }

        $campo = $value->name;
        $campo = str_replace('[]', '', $campo);
        $valor = $final_result;
        insert_result($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento);

        
    }
    
    //print_r($new_data2);

    foreach ($new_data2 as $key => $value) {
        $field[$value->name] = $value->value;

        if (count($value->value) > 1){
            foreach ($value->value as $result){
                $final_result .= $result.',';
                
            }
            $final_result = substr($final_result, 0, -1);
        
        } else {
            $final_result = $value->value[0];
        }

        $campo = $value->name;
        $campo = str_replace('[]', '', $campo);
        $valor = $value->value;
        
        insert_result2($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento);

        
    }

  
  
 } else {
    $final_result = "";
    $dummy_model = "";
    foreach ($new_data as $key => $value) {
        $field[$value->name] = $value->value;

        if (count($value->value) > 1){
            foreach ($value->value as $result){
                $final_result .= $result.',';
                
            }
            $final_result = substr($final_result, 0, -1);
        
        } else {
            $final_result = $value->value[0];
        }

        $campo = $value->name;
        $campo = str_replace('[]', '', $campo);

        $valor = $final_result;
        insert_result($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento);

        
    }
    


    foreach ($new_data2 as $key => $value) {
        $field[$value->name] = $value->value;

        

        if (count($value->value) > 1){
            foreach ($value->value as $result){
                $final_result .= $result.',';
                
            }
            $final_result = substr($final_result, 0, -1);
        
        } else {
            $final_result = $value->value[0];
        }

        $campo = $value->name;
        $campo = str_replace('[]', '', $campo);

        $valor = $final_result;
        insert_result2($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento);

        
    }




    
 } 



$arr['status'] = 'SUCCESS';
$arr['status_txt'] = 'Atualizado com sucesso!' ;
echo json_encode($arr);

function insert_result($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento){

	$date_now = date('Y-m-d H:i:s');
  $IdUsuario = $IdUsuario;
  $IdFormulario = $IdFormulario;
	$IdEvento = $IdEvento;
  $campo = $campo;
  $valor = $valor;
  $status = 1;
	
	$db = new db();

	$db->query('INSERT INTO formulario_resposta (IdUsuario,IdFormulario,IdEvento,campo,valor,data_cadastro,data_atualizacao) VALUES ( :IdUsuario, :IdFormulario, :IdEvento, :campo, :valor, :data_cadastro, :data_atualizacao)');
	$db->bind(':IdUsuario', $IdUsuario);
	$db->bind(':IdFormulario', $IdFormulario);
	$db->bind(':IdEvento', $IdEvento);
	$db->bind(':campo', $campo);
	$db->bind(':valor', $valor);
	$db->bind(':data_cadastro', $date_now);
  $db->bind(':data_atualizacao', $date_now);
    
    if($db->execute()){ 
   } else {
        $arr['status'] = 'ERROR';
        $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
   }
	
}

function insert_result2($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento){

  $date_now = date('Y-m-d H:i:s');
  $IdUsuario = $IdUsuario;
  $IdFormulario = $IdFormulario;
  $IdEvento = $IdEvento;
  $campo = $campo;
  $valor = $valor;
  $status = 1;
	
	$db = new db();

	$db->query('INSERT INTO formulario_resposta (IdUsuario,IdFormulario,IdEvento,campo,sign_value,data_cadastro,data_atualizacao) VALUES ( :IdUsuario, :IdFormulario, :IdEvento, :campo, :sign_value, :data_cadastro, :data_atualizacao)');
	$db->bind(':IdUsuario', $IdUsuario);
	$db->bind(':IdFormulario', $IdFormulario);
	$db->bind(':IdEvento', $IdEvento);
	$db->bind(':campo', $campo);
	$db->bind(':sign_value', $valor);
	$db->bind(':data_cadastro', $date_now);
  $db->bind(':data_atualizacao', $date_now);
    
    if($db->execute()){ 
   } else {
        $arr['status'] = 'ERROR';
        $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
   }
	
}

