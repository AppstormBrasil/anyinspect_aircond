<?php 
 
 include('../common/util.php'); 

if(isset($_GET['id_team'])){ $id_team = $_GET['id_team'];} else {$id_team = '';}
$db = new db(); 

$db->query('SELECT ts.* 
			FROM tb_services ts 
			LEFT JOIN tb_team_service tts ON tts.id_service = ts.id
			#WHERE tts.id_team = :id_team
			ORDER by ts.short_dec'); 
$db->bind(':id_team', $id_team);			
$db->execute();
$response = array();
$result = $db->resultset(); 
if($result){
	 $i = 0;
	 foreach($result as $row) {
		$foto = $row['foto'];
		$est_time = $row['est_time'];
		$get_open_days = get_open_days($id_team);

		$est_hour_min = hourMinute2Minutes($est_time);

		
		if ($foto != ""){
			$foto = "images/upload/servicos/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}
		$response[] = array(
			"id"=>$row['id'],
			"short_dec"=>$row['short_dec'],
			"est_time"=>$row['est_time'],
			"price"=>$row['price'],
			"est_hour_min"=>$est_hour_min,
			"foto"=>$foto,
			"get_open_days"=>$get_open_days
		);
	 }
	 
	 
	 /*$db->query("SELECT id_func, GROUP_CONCAT(dia_semana ORDER BY dia_semana ASC SEPARATOR ', ') as dias_semana
				FROM tb_jornada_trabalho
				WHERE id_func =:id_func
				GROUP BY id_func"); 
	$db->bind(':id_func', $id_team);			
	$db->execute();
	$response = array();
	$result2 = $db->resultset(); 
	if($result2){
		$i = 0;
		foreach($result2 as $row) {
			$dias_semana = $row['dias_semana'];
		}
	} */

			//$response['dias_semana'] = $dias_semana;

	 	 //$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
	$response[] = array(
		"id"=>'none'
	);
	echo json_encode($response);
} 

function get_open_days($id_team){

	$number_list =  array(0,1,2,3,4,5,6);
	//$number_list =  array('0','1','2','3','4','5','6');

	$db = new db(); 
	/*$db->query("SELECT id_func, GROUP_CONCAT(dia_semana ORDER BY dia_semana ASC SEPARATOR ',') as work_days
				FROM tb_jornada_trabalho
				WHERE id_func =:id_func
				GROUP BY id_func"); */
	$db->query("SELECT dia_semana as work_days
				FROM tb_jornada_trabalho
				WHERE id_func =:id_func"); 
	$db->bind(':id_func', $id_team);			
	$db->execute();
	$response = array();
	$result2 = $db->resultset(); 
	if($result2){
		$i = 0;
		$work_days = "";
		foreach($result2 as $row) {
			$work_days = (int)$row['work_days'];
			if (in_array($work_days, $number_list)) 
			{
				unset($number_list[array_search($work_days,$number_list)]);
			}
		}

		//print_r($number_list);
		
	}

	//$str = implode (",", $number_list);
	

	return $number_list;
}

 ?>