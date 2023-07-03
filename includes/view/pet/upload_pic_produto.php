<?php
include('../../common/util.php');

if(trim(@$_POST['id']) != ""){
  $IdEmpresa =  get_id_empresa();
	$id = $_POST['id'];
	$max_file_size = 1024*10000;
    $path = '../../../images/upload/produtos/';

  
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
				//$name = gerarCod().'.jpg';
                      $name = $id.'.jpg';
                      $new_name = $name;
                     if(move_uploaded_file($f["tmp_name"], $path.$new_name) == false) {
                          $arr['status_message'] = "Não foi possível atualizar a foto";
                          $arr['status'] = "ERROR";
                          echo json_encode($arr);
                          exit(0);
                      } else {

                        try{
                            $db = new db();
                            $db->query('UPDATE tb_product SET foto = :imagem  WHERE id = :id ');
                            $db->bind(':imagem', $name);
                            $db->bind(':id', $id); 		 
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
                            //$db->endTransaction();
                          }
                          catch(PDOException $e){
                            $arr['status'] = "ERROR";
                            $arr['status_txt'] = $e->getMessage();
                            echo json_encode($arr);
                            print_r($e->getMessage());
                          }  
                        
                        
                       // $arr['status'] = "SUCCESS";
                       // $arr['status_txt'] = "Imagem atualizada com sucesso!";
                       // echo json_encode($arr);




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
