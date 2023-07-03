<?php
 include('../common/util.php');
 $date_create = date('Y-m-d  H:i:s');
 $last_date = date('d/m/Y  H:i:s');

 $id_companie = get_id_empresa();
 $user_id = get_current_id();
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
      $arr['last_date'] =  $last_date;
      $arr['last_id'] =  $last_id;
      $arr['status_txt'] = 'Salvo com sucesso!' ;
      echo json_encode($arr);
      exit(0);
  }      

exit(0);


?>
