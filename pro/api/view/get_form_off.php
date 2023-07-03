<?php
 include('../common/util.php');
	
 $IdUser = $_GET['IdUser'];
 $type = $_GET['type'];


 $db = new db();
 $db->query('SELECT * FROM tb_services ');
 //$db->bind(':id', $id);
 //$row = $db->single();
 $result = $db->resultset(); 

 if($result != ''){
    $i = 0;
        foreach($result as $row) {

            $id = $row["id"];
            $conteudo_formulario = $row['conteudo_formulario'];

            $response['data'][] = array(
                "id"=>$id,
			    "conteudo_formulario"=>$conteudo_formulario,
            );
	
            $i++;

        }


    
    $response['status'] = "SUCCESS";	
	echo json_encode($response);
	exit(0);
    
    
    //echo json_encode($arr);

     //echo $row['conteudo_formulario'];
 } else {

 }

