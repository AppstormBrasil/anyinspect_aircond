<?php
include('../common/util.php'); 

if(trim(@$_POST['id']) != ""){
  $id_companie = $_POST['id_companie'];
	$id = $_POST['id'];
	$i = $_POST['i'];

  try{
    $db = new db();
    $db->query('UPDATE tb_pa_task SET img_ev'.$i.' = :img_evi  WHERE id = :id AND id_companie =:id_companie ');

    //echo 'UPDATE tb_pa_task SET img_ev'.$i.'. = :img_evi  WHERE id = :id AND id_companie =:id_companie ';

    $db->bind(':img_evi', '');
    $db->bind(':id', $id); 		 
    $db->bind(':id_companie', $id_companie); 		 
    if($db->execute()){
      $arr['status'] = "SUCCESS";
      $arr['status_txt'] = "Imagem atualizada com sucesso!";
      //echo json_encode($arr);
    } 
    else {
      $arr['status'] = "ERROR";
      $arr['status_txt'] = "Ocorreu algum erro ao salvar esta imagem , entre em contato com o administrador";
      //echo json_encode($arr);
    }
    //$db->endTransaction();
  }
  catch(PDOException $e){
    $arr['status'] = "ERROR";
    $arr['status_txt'] = $e->getMessage();
   
    //echo json_encode($arr);
    //print_r($e->getMessage());
  }  


  $arr['status'] = "SUCCESS";
  $arr['status_txt'] = "Imagem atualizada com sucesso!";
  echo json_encode($arr);
  
}

?>
