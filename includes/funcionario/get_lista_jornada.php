<?php 

include('../common/util.php'); 


if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} 
else {$id_funcionario = '';}


$db = new db(); 

$db->query("SELECT * FROM tb_jornada_trabalho tjt WHERE tjt.id_func =:id_funcionario ORDER BY dia_semana");

$db->bind(':id_funcionario', $id_funcionario);

$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		
		$response[] = array(
			"id"=>$row['id'],
			"id_func"=>$row['id_func'],
			"dia_semana"=>$row['dia_semana'],
			"hora_inicio"=>$row['hora_inicio'],
			"hora_termino"=>$row['hora_termino'],
			"pausa_incio"=>$row['pausa_incio'],
			"pausa_final"=>$row['pausa_final']
		);
	 } 
		  
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
	 	 
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 



?>