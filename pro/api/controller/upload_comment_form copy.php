<?php
 include('../common/util.php');
 $date_create = date('Y-m-d  H:i:s');

 $user_id = 1;
 $id_element = $_POST["id_element"];
 $id_booking = $_POST["id_booking"];
 $value = $_POST["comment"];


$database = new db();
  $database->query('SELECT tbe.id FROM tb_book_evidence tbe
  					WHERE tbe.id_element = :id_element AND tbe.type_ev =:type_ev AND tbe.id_booking = :id_booking ');
  $database->bind(':id_element', $id_element);
  $database->bind(':type_ev', 'txt');
  $database->bind(':id_booking', $id_booking);
  $result = $database->resultset();
  if($result){
        foreach($result as $row) {
          $id_ev = $row['id'];  
        }

        $database->query('UPDATE tb_book_evidence SET id_booking = :id_booking , id_element = :id_element ,  type_ev = :type_ev , value = :value ,  date_create = :date_create , user_id = :user_id WHERE id = :id ');
        $database->bind(':id_booking', $id_booking);
        $database->bind(':id_element', $id_element);
        $database->bind(':type_ev', 'txt');
        $database->bind(':value', $value);
        $database->bind(':date_create', $date_create);
        $database->bind(':user_id', $user_id);
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
    $database->query("INSERT INTO tb_book_evidence (id_booking, id_element, type_ev, value, date_create, user_id) 
			VALUES (:id_booking , :id_element, :type_ev, :value, :date_create,:user_id)");
		$database->bind(':id_booking', $id_booking);
		$database->bind(':id_element', $id_element);
		$database->bind(':type_ev', 'txt');
		$database->bind(':value', $value);
		$database->bind(':date_create', $date_create);
		$database->bind(':user_id', $user_id);

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




 /*$database = new db();

// UPDATE CLIENTE

$database->query('UPDATE formulario_anexo SET descricao_arquivo = :descricao_arquivo ,  comentario = :comentario , image_mark = :image_mark WHERE IdFormularioAnexo = :IdFormularioAnexo ');
$database->bind(':descricao_arquivo', $descricao_arquivo);
$database->bind(':comentario', $comentario);
$database->bind(':image_mark', $image_mark);
$database->bind(':IdFormularioAnexo', $IdFormularioAnexo);

if($database->execute()){ 
     $last_id = $database->lastInsertId(); 
     $arr['status'] = 'SUCCESS';
     $arr['status_txt'] = 'Atualizaçao realizada com sucesso!' ;
     echo json_encode($arr);
     exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
} */



exit(0);


?>
