<?php
include('../../common/util.php');

if(trim(@$_POST['id']) != ""){
    //$IdEmpresa =  get_id_empresa();
	
  $IdEmpresa = get_id_empresa();

	$id = $_POST['id'];
	$max_file_size = 1024*10000;
	$path = "../../../images/colaborador/".$IdEmpresa."/".$id."/";
	$path2 = "images/colaborador/".$IdEmpresa."/".$id."/";
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
                            $db->beginTransaction();
                            $sql = "UPDATE tb_admin_colaborador SET imagem = :imagem WHERE IdColaborador = :IdColaborador ";
                            $db->query($sql);
                            $db->bind(':imagem', $name);
						              	$db->bind(':IdColaborador', $id);
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

             $arr['status_message'] = "Não foi possível atualizar a imagem , verifique o se o tamanho está abaixo de  1,5Mb";
              $arr['status'] = "ERROR";
              echo json_encode($arr);
              exit(0);
		}
	}
}

?>
