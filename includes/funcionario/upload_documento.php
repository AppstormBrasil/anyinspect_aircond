<?php
include('../common/util.php');
$db = new db(); 

$date = date('Y-m-d  H:i:s');



$name = $_FILES['upload_file']['name'];



$id = $_POST['id'];
$nome_documento_new = $_POST['nome_documento_new'];

$ext = pathinfo($name, PATHINFO_EXTENSION);
$nome_arquivo = $id.'.'.$ext;
$max_file_size = 1024*10000;
$path = '../../images/upload/documentos/'.$id.'/';
$link = 'https://dnataoffice.anyinspect.com.br/images/upload/documentos/'.$id.'/'.$nome_arquivo;
	
	
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

                    
					$database = new db();
					$database->query("INSERT INTO tb_docs(id_team, description, link, date_register)VALUES (:id_team, :description, :link, :date_register)"); 
					$database->bind(':id_team', $id);
                    $database->bind(':description', $nome_documento_new);
                    $database->bind(':link', $link);
                    $database->bind(':date_register', $date);
					if($database->execute()){
						$last_id = $database->lastInsertId(); 
						$arr['status_message'] = "Arquivo Atualizado com Sucesso";
						$arr['last_id'] = $last_id;
						$arr['link'] = $link;
						$arr['nome_documento_new'] = $nome_documento_new;
						$arr['status'] = "SUCCESS";
					} else {
						$arr['status_message'] = "Não foi possível atualizar o arquivo";
						$arr['status'] = "ERROR";
						echo json_encode($arr);
					}

					
                    echo json_encode($arr);

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
