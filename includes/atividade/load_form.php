<?php
 include('../common/util.php');
	
 $id = $_GET['form_id'];


 $db = new db();
 $db->query('SELECT ts.conteudo_formulario , tsr.data 
            FROM tb_services ts
            LEFT JOIN tb_service_resp tsr ON tsr.id_book = ts.id
            WHERE ts.id = :id  ');
 $db->bind(':id', $id);
 $row = $db->single();

 if($row != ''){

    //$id = $row["id"];
    $conteudo_formulario = $row['conteudo_formulario'];
    $data = $row['data'];
    /*$response[] = array(
        "conteudo_formulario"=>$conteudo_formulario,
    );*/

    $arr['conteudo_formulario'] = $conteudo_formulario;
    $arr['data'] = $data;

    
    
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

