<?php
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$base64img = $_POST['base64'];
$id = $_POST['id'];

$path = '../../../images/pet/upload/pets/';

$name = $id.'.jpg';
$new_name = $name;

/*if (!file_exists($path)) {
    mkdir($path, 0777, true);
}*/
//$user_name = 'Felipe';
 

//$path = "images/users/".$user_name."/";
//$path2 = "images/users/".$user_name."/";

//$path = "images/users/";
//$path2 = "images/users/";

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

saveImage($base64img,$path,$id,$new_name);

try{
    $db = new db();
    $db->query('UPDATE pet_clients_pet SET foto = :imagem  WHERE id = :id ');
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

function saveImage($base64img,$path,$id,$new_name){
    //define('UPLOAD_DIR', '../uploads/');
    $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);
    $data = base64_decode($base64img);
    //$file = UPLOAD_DIR . $order_num.'.jpg';
    $file = $path.$new_name;
    file_put_contents($file, $data);
}


?>