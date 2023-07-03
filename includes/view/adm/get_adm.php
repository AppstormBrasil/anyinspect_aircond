<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
$IdEmpresa =  get_id_empresa();

$db->query(
	'SELECT 
	COUNT(*) AS total_residencia,
	COUNT(CASE WHEN ativa = "0" THEN 1 END) AS desocupadas,
	COUNT(CASE WHEN ativa = "1" THEN 1 END) AS ocupadas
	FROM tb_morador_residencia WHERE IdCondominio ='. $IdEmpresa .' '); 



$db->execute();
$result = $db->resultset(); 

if($result){ 
	 $i = 0; 
	 foreach($result as $row) { 
		  $arr['response'][] = $row; 
		  
		
		} 
	 	 $arr['status'] = 'SUCCESS';
	 	 
	 	
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informação disponível'; 
	 	 
}

$db->query('SELECT COUNT(*) AS total_reclamacoes FROM tb_reclamacao WHERE IdCondominio ='.$IdEmpresa.'  AND status = 1 ');
$db->execute();
$result2 = $db->resultset(); 
if($result2){ 
	$i = 0; 
	foreach($result2 as $row) { 
		 $arr['response'][] = $row; 
	   } 
		 $arr['status'] = 'SUCCESS';
		 
		
} else { 
		  $arr['status'] = 'ERROR'; 
		 $arr['status_txt'] = 'Nenhuma informação disponível'; 
		 
}

$arr2 = array();
$IdCondominio =  get_id_empresa();
    $query2 = 'SELECT 	
              COUNT(*) AS total_reclamacoes
              FROM tb_reclamacao tr WHERE tr.IdCondominio = '.$IdCondominio.' AND  tr.status <> 2 ';
    $db = new db(); 
    $db->query($query2); 

    $db->execute();
    
    $result2 = $db->resultset(); 
    
    $response2 = array();
    if($result2){ 
        $i = 0; 
        foreach($result2 as $row) {
            $arr['portaria_top_dash_reclamacoes'] = array(
                "total_reclamacoes"=>$row['total_reclamacoes']
            );
        }	
        $arr['status'] = 'SUCCESS';
        
        //die();

    } else {
        $arr['status'] = 'ERROR';
        echo json_encode($arr);
       
    }
    
		


echo json_encode($arr);


 ?>