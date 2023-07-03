<?php
 include('../common/util.php');
 $date_register = date('Y-m-d  H:i:s');

 $id_resp_cadastro = 1;
 $id_element = $_POST["id_element"];
 $id_booking = $_POST["id_booking"];
 $what_at = $_POST["what_at"];
 $why_at = $_POST["why_at"];
 $how_at = $_POST["how_at"];
 $resp_at = $_POST["resp_at"];
 $where_at = $_POST["where_at"];
 $when_at = $_POST["when_at"];
 $cost_at = $_POST["cost_at"];


$database = new db();
  $database->query('SELECT tp.id FROM tb_pa tp
  					WHERE tp.id_element = :id_element AND tp.id_booking = :id_booking ');
  $database->bind(':id_element', $id_element);
  $database->bind(':id_booking', $id_booking);
  $result = $database->resultset();
  if($result){
        foreach($result as $row) {
          $id_ev = $row['id'];  
        }


        $database->query('UPDATE tb_pa SET id_booking = :id_booking , id_element = :id_element ,  what_at = :what_at, why_at = :why_at, how_at = :how_at, resp_at = :resp_at, where_at = :where_at, when_at = :when_at, cost_at = :cost_at, date_register = :date_register, id_resp_cadastro = :id_resp_cadastro  WHERE id = :id ');
        $database->bind(':id_booking', $id_booking);
        $database->bind(':id_element', $id_element);
        $database->bind(':what_at', $what_at);
        $database->bind(':why_at', $why_at);
        $database->bind(':how_at', $how_at);
        $database->bind(':resp_at', $resp_at);
        $database->bind(':where_at', $where_at);
        $database->bind(':when_at', $when_at);
        $database->bind(':cost_at', $cost_at);
        $database->bind(':date_register', $date_register);
        $database->bind(':id_resp_cadastro', $id_resp_cadastro);
        $database->bind(':id', $id_ev);
        
        if($database->execute()){ 
            //$last_id = $database->lastInsertId(); 
            $arr['status'] = 'SUCCESS';
            $arr['status_txt'] = 'Atualizaçao realizada com sucesso!' ;
            echo json_encode($arr);
            exit(0);
        } else {
            $arr['status'] = 'ERROR';
            $arr['status_txt'] = 'Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
            exit(0);
        } 
  
} else {
    $database->query("INSERT INTO tb_pa (id_booking, id_element, what_at, why_at, how_at, resp_at, where_at, when_at, cost_at, date_register , id_resp_cadastro , status) 
			VALUES (:id_booking, :id_element, :what_at, :why_at, :how_at, :resp_at, :where_at, :when_at, :cost_at, :date_register , :id_resp_cadastro , :status)");
      $database->bind(':id_booking', $id_booking);
      $database->bind(':id_element', $id_element);
      $database->bind(':what_at', $what_at);
      $database->bind(':why_at', $why_at);
      $database->bind(':how_at', $how_at);
      $database->bind(':resp_at', $resp_at);
      $database->bind(':where_at', $where_at);
      $database->bind(':when_at', $when_at);
      $database->bind(':cost_at', $cost_at);
      $database->bind(':date_register', $date_register);
      $database->bind(':id_resp_cadastro', $id_resp_cadastro);
      $database->bind(':status', 'Pendente');

		if($database->execute()){ 
            $last_id = $database->lastInsertId(); 
            $arr['status'] = 'SUCCESS';
            $arr['status_txt'] = 'Salvo com sucesso!' ;
            echo json_encode($arr);
            exit(0);
        }       


}


$arr['status'] = 'SUCCESS';
echo json_encode($arr);
exit(0);

exit(0);


?>
