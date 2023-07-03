<?php

include('../common/util.php'); 
$db = new db();

$id_team_service = $_POST["id"];
$new_comission = $_POST["new_comission"];

if ($new_comission == "") {
 	$arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Insira uma comissão'; 
	 	 echo json_encode($arr); 
 }else{

 $db->query('UPDATE  tb_team_service SET `comission` =:new_comission WHERE id =:id_team_service');
 $db->bind(':id_team_service', $id_team_service); 
 $db->bind(':new_comission', $new_comission); 

 if($db->execute()){
	 	$arr['status'] = 'SUCCESS';
	 	$arr['status_txt'] = 'Atualizado com Sucesso'; 
	 	echo json_encode($arr);
	 	exit(0);
	}else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 }
}	 	  



?>