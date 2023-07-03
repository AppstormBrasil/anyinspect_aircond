<?php
 include('../common/util.php');
 $date_create = date('Y-m-d  H:i:s');


 
 $id_element = $_POST["id_element"];
 $image_data = $_POST["image_data"];
 $id_booking = $_POST["id_booking"];

 $id_booking = str_replace(' ', '', $id_booking);


$get_ext = explode(";",$image_data);
$get_ext = explode("/",$get_ext[0]);
$ext = $get_ext[1];
$new_id = time();

$image_name =  $new_id.'.'.$ext;
$path = "../../../images/upload/atividade/ev/$id_booking/img/$id_element/" ;

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

$img = $image_data; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
$img = str_replace('data:image/'.$ext.';base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

file_put_contents( $path.$image_name, $data);



$database = new db();
 
 
$database->query("INSERT INTO tb_book_evidence (id_booking, id_element, type_ev, value, date_create, user_id) 
			VALUES (:id_booking , :id_element, :type_ev, :value, :date_create,:user_id)");
		$database->bind(':id_booking', $id_booking);
		$database->bind(':id_element', $id_element);
		$database->bind(':type_ev', 'img');
		$database->bind(':value', $image_name);
		$database->bind(':date_create', $date_create);
		$database->bind(':user_id', '1');

if($database->execute()){ 
    $last_id = $database->lastInsertId(); 
    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Salvo com sucesso!' ;
    echo json_encode($arr);
    exit(0);
}   

function genRandomString() 
{
    $length = 5;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

    $real_string_length = strlen($characters) ;     
    $string="id";

    for ($p = 0; $p < $length; $p++) 
    {
        $string .= $characters[mt_rand(0, $real_string_length-1)];
    }

    return strtolower($string);
}
    
    
exit;
 
 
 
 


?>
