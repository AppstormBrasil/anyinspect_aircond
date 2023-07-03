<?php
include('../common/util.php'); 
$_POST = json_decode(file_get_contents('php://input'), true);
if(trim(@$_POST['eventID']) != ""){
  //$id_companie = get_id_empresa();
	$id = $_POST['eventID'];
  



  $db = new db();
  $db->query('UPDATE tb_book_detail SET img_ev1 = "" , img_ev2 = "" , img_ev3 = "" ,img_ev4 = "" , img_ev5 = "" , img_ev6 = ""  WHERE id = :id ');
  $db->bind(':id', $id); 		 
 
  if($db->execute()){
    $arr['status'] = "SUCCESS";
    $arr['status_txt'] = "Imagem atualizada com sucesso!";
  } else {
    $arr['status'] = "ERROR";
    $arr['status_txt'] = "Ocorreu algum erro ao salvar esta imagem , entre em contato com o administrador";
  }
  echo json_encode($arr);
  
} else {
  $arr['status'] = "ERROR";
  $arr['status_txt'] = "Ocorreu algum erro ao salvar esta imagem , entre em contato com o administrador";
  echo json_encode($arr);
}
  
?>
