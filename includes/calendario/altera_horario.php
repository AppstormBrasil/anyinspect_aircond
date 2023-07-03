<?php 
 
include('../common/util.php'); 
$db = new db(); 

 if(isset($_POST['id'])){ $id = $_POST['id'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }
 
$datatime = date('Y-m-d  H:i:s');
$Newhora_Inicio = $_POST["Newhora_Inicio"];
$Newhora_termino = $_POST["Newhora_termino"];
$date = $_POST["Newstarted_data"];
$id_funcionario = $_POST["Newstarted_data"];
$date = explode("/",$date);
$datefinal =  $date[2].'-'.$date[1].'-'.$date[0];
$Inicio_DT = $datefinal." ".$Newhora_Inicio;
$Final_DT = $datefinal." ".$Newhora_termino;


 
 $db->query('UPDATE tb_booking SET start_date = :Inicio_DT , end_date = :Final_DT WHERE id = :id ');
 
 $db->bind(':Inicio_DT', $Inicio_DT); 
 $db->bind(':Final_DT', $Final_DT); 
 $db->bind(':id', $id); 

if($db->execute()){	

	 executa_log($id, $id_funcionario, $datatime);
	

} else { 
	 $arr['status'] = 'ERROR'; 
 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
 	 echo json_encode($arr);
} 

	function executa_log($id, $id_funcionario, $datatime){

	$db = new db();	

	$db->query("INSERT INTO tb_log_reagendamento (id_team, id_book, datatime) VALUES (:id_funcionario, :id, :datatime)");
	$db->bind(':id_funcionario', $id_funcionario);
	$db->bind(':id', $id);
	$db->bind(':datatime', $datatime);

	if($db->execute()){	
	
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 exit(0);

	} else { 
	 $arr['status'] = 'ERROR'; 
 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
 	 echo json_encode($arr);
	} 

	}


 ?>