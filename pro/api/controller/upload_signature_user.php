<?php
 include('../common/util.php');
 $date_now = date('Y-m-d H:i:s');
 $db = new db();
 $IdUsuario = $_POST["IdUsuario"];
 $valor = $_POST["valor"];
 $status = 1;

    $db->query('UPDATE tb_team SET sign = :sign WHERE id = :IdUsuario ');
    $db->bind(':sign', $valor);
    $db->bind(':IdUsuario', $IdUsuario);
 
    if($db->execute()){ 
      $arr['status'] = "SUCCESS";
      $arr['status_txt'] = "Imagem atualizada com sucesso!";
    } else {
      $arr['status'] = 'ERROR';
      $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
    }

    echo json_encode($arr);
    exit(0);




?>
