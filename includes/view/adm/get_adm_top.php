<?php

include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$IdCondominio = get_id_empresa();
$IdMorador = get_current_id();

    $arr = array();
    
    $query = 'SELECT 	
              COUNT(*) AS total_visitas,
              COUNT(CASE WHEN DATE(tv.data_prevista) = CURDATE() THEN 1 END) AS visitas_hoje
              #COUNT(CASE WHEN ativa = "1" THEN 1 END) AS ocupadas
              FROM tb_visitantes tv WHERE IdCondominio = '.$IdCondominio.' AND  tv.status <> 2 ';
    $db = new db(); 
    $db->query($query); 

    $db->execute();
    
    $result = $db->resultset(); 
    
    $response = array();
    if($result){ 
        $i = 0; 
        foreach($result as $row) {
            $arr['portaria_top_dash'] = array(
                "total_visitas"=>$row['total_visitas'],
                "visitas_hoje"=>$row['visitas_hoje']
            );
        }	
        $arr['status'] = 'SUCCESS';
        echo json_encode($arr);
        //die();

    } else {
        $arr['status'] = 'ERROR';
        echo json_encode($arr);
        //die();
    }


    
       
          
?>
