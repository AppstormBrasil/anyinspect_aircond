<?php
include('../../common/util.php');

if(trim(@$_POST['id']) != ""){
    //$IdEmpresa =  get_id_empresa();
	
	$IdEmpresa =  1;

	$id = $_POST['id'];
	$max_file_size = 1024*10000;
	$path = "../../../documento/agenda/".$IdEmpresa."/".$id."/";
	$path2 = "images/documento/".$IdEmpresa."/".$id."/";
	$msg = "";


    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }


	foreach ($_FILES as $f) {
		
		
	
		$name = $f['name'];
		
		$ext = explode('.',$name);
		if($ext[1] != 'pdf'){
			$arr['status_message'] = "Somente arquivo PDF permitido";
			$arr['status'] = "ERROR";
			echo json_encode($arr);
			exit(0);
		}
		
		
		if ($f['error'] == 0) {
			if ($f['size'] > $max_file_size) {
        $arr['status_message'] = "Foto maior que 10MB";
        $arr['status'] = "ERROR";
        echo json_encode($arr);
        exit(0);
			} else {
				//$name = gerarCod().'.jpg';
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
                            //$sql = "UPDATE tb_admin_form_agenda SET documento = :documento WHERE IdformAgenda = :IdformAgenda ";
                            $db->query("UPDATE tb_admin_form_agenda SET documento = :documento WHERE IdformAgenda = :IdformAgenda ");
                            $db->bind(':documento', $name);
							$db->bind(':IdformAgenda', $id);
                            if($db->execute()){
							
							
							  $last_id = $db->lastInsertId(); 
							  
                              $arr['status'] = "SUCCESS";
                              $arr['status_txt'] = "Imagem atualizada com sucesso!";
							
							  $path = "../../../documento/agenda/".$IdEmpresa."/".$id."/".$name;
							  
							  $arr['anexo_form'] = $path;
							  $arr['anexo_id'] = $id;
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

             $arr['status_message'] = "Não foi possível atualizar a imagem , verifique o se o tamanho está abaixo de  1,5Mb";
              $arr['status'] = "ERROR";
              echo json_encode($arr);
              exit(0);
		}
	}
}

?>
