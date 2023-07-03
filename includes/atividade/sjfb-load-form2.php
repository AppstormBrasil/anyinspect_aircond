<?php
 include('../common/util.php');
	
 $id = $_GET['form_id'];


 $db = new db();
 $db->query('SELECT conteudo_formulario FROM tb_services WHERE id = :id  ');
 $db->bind(':id', $id);
 $row = $db->single();

 if($row != ''){

    //$id = $row["id"];
    $conteudo_formulario = $row['conteudo_formulario'];
    /*$response[] = array(
        "conteudo_formulario"=>$conteudo_formulario,
    );*/

    $arr['conteudo_formulario'] = $row['conteudo_formulario'];

    
    
    echo json_encode($arr);
    
    
    //echo json_encode($row);

     //echo $row['conteudo_formulario'];
 } else {

 }

 //echo json_decode($response);

 //echo $conteudo_formulario[0]["components"];

 //$someArray = var_dump(json_decode($conteudo_formulario, true));

 $someJSON = json_encode($conteudo_formulario, true);
//echo $someJSON;

