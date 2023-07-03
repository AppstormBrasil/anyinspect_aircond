<?php
include('../common/util.php');

if(trim(@$_POST['id']) != ""){

	$id = $_POST['id'];
	$max_file_size = 1024*10000;
	$path = "../../images/form/".$id."/";
	$path2 = "images/form/".$id."/";
	$msg = "";


    if (!file_exists("../../images/form/".$id."/")) {
        mkdir("../../images/form/".$id."/", 0777, true);
    }

    $file_name = gerarCod();

	foreach ($_FILES as $f) {
		$name = $f['name'];
		if ($f['error'] == 0) {
			if ($f['size'] > $max_file_size) {
        $arr['status_message'] = "Foto maior que 10MB";
        $arr['status'] = "ERROR";
        echo json_encode($arr);
        exit(0);
			} else {
                      $name = $file_name.'.jpg';
                      $new_name = $name;
                     if(move_uploaded_file($f["tmp_name"], $path.$new_name) == false) {
                          $arr['status_message'] = "Não foi possível atualizar a foto";
                          $arr['status'] = "ERROR";
                          echo json_encode($arr);
                          exit(0);
                      } else {

                        try{
                            $db = new db();
                            $db->beginTransaction();
                            $sql = "UPDATE formulario SET imagem = :imagem WHERE IdFormulario = '$id' ";
                            $db->query($sql);
                            $db->bind(':imagem', $name);
                            if($db->execute()){
                              $arr['status'] = "SUCCESS";
                              $arr['status_txt'] = "Imagem atualizada com sucesso!";
                              echo json_encode($arr);
                            } 
                            else {
                              $arr['status'] = "ERROR";
                              $arr['status_txt'] = "Ocorreu algum erro ao salvar seus dados , entre em contato com o administrador";
                              echo json_encode($arr);
                            }
                            $db->endTransaction();
                          }
                          catch(PDOException $e){
                            print_r($e->getMessage());
                          }  
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
