<?php
include('../common/util.php');
$db = new db(); 

$date = date('Y-m-d  H:i:s');

$name = $_FILES['name']['name'];
$id = $_POST['id'];

$ext = pathinfo($name, PATHINFO_EXTENSION);
$nome_arquivo = $id.'.'.$ext;
$max_file_size = 1024*10000;
$path = '../../images/upload/manuais/'.$id.'/';

	
	
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
		sleep(3);
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
				if(move_uploaded_file($f["tmp_name"], $path.$nome_arquivo) == false) {
				  $arr['status_message'] = "Não foi possível atualizar o arquivo";
				  $arr['status'] = "ERROR";
				  echo json_encode($arr);
				  exit(0);
			  } else {

                    $arr['status_message'] = "Arquivo Atualizado com Sucesso";
                    $arr['status'] = "SUCCESS";
                    echo json_encode($arr);

                   /* $s_update_var = "UPDATE  users SET comp_doc =  '$nome_arquivo' WHERE  id = '$id_usuario' "  ;
                        $conexao->SetSQL($s_update_var);
                        $q_get_var = $conexao->Consultar();
                        if($q_get_var != ''){
                            $arr['status_message'] = "Arquivo Atualizado com Sucesso";
                            $arr['status'] = "SUCCESS";
                            $arr['nome_arquivo_rg'] = $nome_arquivo;
                                echo json_encode($arr);

                        } else {
                            $arr['status_message'] = "Não foi possível atualizar o arquivo";
                            $arr['status'] = "ERROR";
                            echo json_encode($arr);
                            exit(0);
                        } */



                }
			}
		} else {
      $arr['status_message'] = "Não foi possível atualizar o arquivo";
      $arr['status'] = "ERROR";
      echo json_encode($arr);
      exit(0);
		}
	}


?>
