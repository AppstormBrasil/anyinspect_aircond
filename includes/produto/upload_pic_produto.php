<?php
include('../common/util.php');

if(trim(@$_POST['id']) != ""){
  $IdEmpresa =  get_id_empresa();
	$id = $_POST['id'];
	$max_file_size = 1024*10000;
  $path = '../../images/upload/produtos/';
  $name = $id.'.jpg';
  
  if (isset($_FILES['upload_file'])) {
      
      $file = $_FILES['upload_file']['tmp_name'];

      if (!file_exists($path)) {
          mkdir($path, 0777, true);
      }

      function imageResize($imageResourceId,$width,$height) {
        $targetWidth =350;
        $targetHeight =350;
        $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
        $whiteBackground = imagecolorallocate($targetLayer, 255, 255, 255); 
        imagefill($targetLayer,0,0,$whiteBackground); // fill the background with white
        imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
        return $targetLayer;
      }
  
  
      if(is_array($_FILES)) {
		
        //$file = $_FILES['image']['tmp_name'];
        //$file = $_FILES['upload_file']['tmp_name'];
            $sourceProperties = getimagesize($file);
            //$fileNewName = time();
            $fileNewName = $name;
        
        
        $folderPath = $path;
            $ext = pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION);
            $imageType = $sourceProperties[2];


            switch ($imageType) {


                case IMAGETYPE_PNG:
                    $imageResourceId = imagecreatefrompng($file); 
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    //imagepng($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                    imagepng($targetLayer,$folderPath. $fileNewName);
                    break;


                case IMAGETYPE_GIF:
                    $imageResourceId = imagecreatefromgif($file); 
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagegif($targetLayer,$folderPath. $fileNewName);
                    break;


                case IMAGETYPE_JPEG:
                    $imageResourceId = imagecreatefromjpeg($file); 
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($targetLayer,$folderPath. $fileNewName);
                    break;


                default:
                    echo "Somente imagens com extensão png ,gif ,jpeg ";
                exit;
                break;
            }
        
        
          try{
            $db = new db(); 
            $db->query('UPDATE tb_product SET foto = :foto  WHERE id = :id ');
            $db->bind(':foto', $name);
            $db->bind(':id', $id); 		 
            if($db->execute()){ 
              $arr['status'] = "SUCCESS";
              $arr['status_txt'] = "Imagem atualizada com sucesso!";
              echo json_encode($arr);
            } else {
            $arr['status'] = "ERROR";
            $arr['status_txt'] = "Ocorreu algum erro ao salvar seus dados , entre em contato com o administrador";
            echo json_encode($arr);
            }

            }
            catch(PDOException $e){
            //print_r($e->getMessage());
            $arr['status_message'] = "Não foi possível atualizar a imagem , verifique o se o tamanho está abaixo de  1,5Mb";
            $arr['status'] = "ERROR";
            echo json_encode($arr);
            exit(0);
          }
        }
      

    } else {
      $arr['status_message'] = "Não foi possível atualizar a imagem , se o problema persistir entre em contato com o Administrador";
      $arr['status'] = "ERROR";
      echo json_encode($arr);
      exit(0);
    }


}

?>
