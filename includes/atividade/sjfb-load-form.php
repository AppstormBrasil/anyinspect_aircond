<?php
 include('../common/util.php');
	
 $id = $_GET['form_id'];


 $db = new db();
 $db->query('SELECT * FROM tb_services WHERE id = :id  ');
 $db->bind(':id', $id);
 $row = $db->single();

 if($row != ''){

    $id = $row["id"];
    $arr['conteudo_formulario'] = $row['conteudo_formulario'];

    
    
    echo json_encode($arr);

     //echo $row['conteudo_formulario'];
 } else {

 }

