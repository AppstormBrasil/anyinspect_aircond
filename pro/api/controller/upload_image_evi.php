<?php
include('../common/util.php'); 

if(trim(@$_POST['id']) != ""){
  //$id_companie = get_id_empresa();
  $id_companie = $_POST['id_companie'];
	$id = $_POST['id'];
	$i = $_POST['i'];
	$last_id = $_POST['last_id'];
  $max_file_size = 1024*10000;
  sleep(2); 
  $now = new DateTime();
  $file_name =  $now->getTimestamp();   
  $file_name =   $file_name.'.png';
  $path = "../../admin/images/upload/evidence//img/".$last_id.'/userevi/' ;
  
  //$path = "../../admin/images/upload/atividade/ev/$id_booking/img/$id_imagem/" ;
	$msg = "";

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

	foreach ($_FILES as $f) {
		$name = $f['name'];
		if ($f['error'] == 0) {
			if ($f['size'] > $max_file_size) {
        $arr['status_message'] = "Foto maior que 10MB";
        $arr['status'] = "ERROR";
        echo json_encode($arr);
        exit(0);
			} else {
        if(move_uploaded_file($f["tmp_name"], $path.$file_name) == false) {
            $arr['status_message'] = "Não foi possível atualizar a foto";
            $arr['status'] = "ERROR";
            echo json_encode($arr);
            exit(0);
        } else {
            
          try{
              $db = new db();
              $db->query('UPDATE tb_book_detail SET img_ev'.$i.' = :img_evi  WHERE id = :id ');
              $db->bind(':img_evi', $file_name);
              $db->bind(':id', $id); 		 
              if($db->execute()){
                $arr['status'] = "SUCCESS";
                $arr['status_txt'] = "Imagem atualizada com sucesso!";
              } 
              else {
                $arr['status'] = "ERROR";
                $arr['status_txt'] = "Ocorreu algum erro ao salvar esta imagem , entre em contato com o administrador";
              }
              //$db->endTransaction();
            }
            catch(PDOException $e){
              $arr['status'] = "ERROR";
              $arr['status_txt'] = $e->getMessage();
            }  
          echo json_encode($arr);
        }
      }

        } else {
              $arr['status_message'] = "Não foi possível atualizar a foto";
              $arr['status'] = "ERROR";
              echo json_encode($arr);
              exit(0);
		}
	}
}

?>
