<?php
 include('../common/util.php');
 $date_create = date('Y-m-d  H:i:s');

 $user_id = 1;
 $id_element = $_POST["id_element"];
 $id_booking = $_POST["id_booking"];
 $value = $_POST["comment"];


$database = new db();

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
    $arr['date_create'] =  $date_create;
    $arr['status_txt'] = 'Salvo com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
  $arr['status'] = 'ERROR';
  $arr['status_txt'] = 'Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
  exit(0);
}

?>
