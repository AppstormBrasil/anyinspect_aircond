<?php
 include('../common/util.php');
 $date_now = date('Y-m-d H:i:s');
 $db = new db();

$_PUT = json_decode(file_get_contents('php://input'), true);
$alldatasig = $_PUT['alldatasig'];
$status = 1;

if (empty($alldatasig)) {
  $arr['status'] = 'ERROR';
  $arr['status_txt'] = 'Nenhuma Assinatura encontrada!' ;
  echo json_encode($arr);
} else {

foreach ($alldatasig as $key => $value) {
 
  $IdFormulario = $value['IdFormulario'];
  $IdUsuario = $value['IdUsuario'];
  $IdEvento = $value['IdEvento'];
  $campo = $value['campo'];
  $valor = $value['valor'];

  $db->query("SELECT fr.campo
  FROM formulario_resposta fr 
  WHERE fr.campo = :campo AND fr.IdEvento = :IdEvento ");
  $db->bind(':campo', $campo);
  $db->bind(':IdEvento', $IdEvento);
  $result = $db->resultset();
  //$response = array();

  if (empty($result)) {

    $db->query('INSERT INTO formulario_resposta (IdUsuario,IdFormulario,IdEvento,campo,sign_value,data_cadastro,data_atualizacao) VALUES ( :IdUsuario, :IdFormulario, :IdEvento, :campo, :sign_value, :data_cadastro, :data_atualizacao)');
    $db->bind(':IdUsuario', $IdUsuario);
    $db->bind(':IdFormulario', $IdFormulario);
    $db->bind(':IdEvento', $IdEvento);
    $db->bind(':campo', $campo);
    $db->bind(':sign_value', $valor);
    $db->bind(':data_cadastro', $date_now);
    $db->bind(':data_atualizacao', $date_now);
      
      if($db->execute()){ 
        $arr['status'] = "SUCCESS";
        $arr['status_txt'] = "Assinatura salva com sucesso!";
     } else {
          $arr['status'] = 'ERROR';
          $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     }

     //echo json_encode($arr);
     //exit(0);
  
  } else {
    
    $db->query('UPDATE formulario_resposta SET sign_value = :sign_value , data_atualizacao = :data_atualizacao , IdUsuario = :IdUsuario WHERE IdEvento = :IdEvento AND campo = :campo');
    $db->bind(':sign_value', $valor);
    $db->bind(':data_atualizacao', $date_now);
    $db->bind(':IdUsuario', $IdUsuario);
    $db->bind(':IdEvento', $IdEvento);
    $db->bind(':campo', $campo);
    
    if($db->execute()){ 
      $arr['status'] = "SUCCESS";
      $arr['status_txt'] = "Imagem atualizada com sucesso!";
    } else {
      $arr['status'] = 'ERROR';
      $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
    }

    

  }

}



echo json_encode($arr);
exit(0);

}

?>
