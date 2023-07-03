<?php 
 
include('../common/util.php'); 

$db = new db(); 
if(!isset($_POST['searchTerm'])){
	$db->query('SELECT id, name , foto , phone from tb_team order  by FIELD(name, "Todos" ) DESC , name ' );  
}
else{
	$search = $_POST['searchTerm'];
	$db->query('SELECT id, name , foto , phone from tb_team where  `name` like "%'.$search.'%"   order  by FIELD(name, "Todos" ) DESC , name ');  
}

$db->execute();
$result = $db->resultset();

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$id = $row['id'];
		$foto = $row['foto'];
		$name = $row['name'];
		$name = explode(" ", $name, 2);
		//print_r($name);
		if(isset($name[1])){
			$short_name = $name[0].' '.substr($name[1], 0, 1);
		} else {
			$short_name = $name[0];
		}

		$get_open_days = get_open_days($id);
		$get_hour_time = get_hour_time($id);
		$selectConstraint = get_constraint_time($id);

		  $businnes = array(
			'dow' => array(0,1),
			'start'   => '07:00',
			'end'   => '18:00',

			);


			
		if ($foto != ""){
			$foto = 'images/upload/funcionarios/'.$foto;
		}else{
			$foto = "assets/images/nouser.png" ;
		} 

				 
		$response[] = array(
			"id"=>$row['id'],
			"resourceId"=>$row['id'],
			"name"=>$row['name'],
			"title"=>$short_name,
			"phone"=>$row['phone'],
			"foto"=>$foto,
			"businessHours"=>  $get_hour_time,
			"selectConstraint" =>$selectConstraint
			
			
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
		  

function get_open_days($id_team){
	$number_list =  array(0,1,2,3,4,5,6);
	$db = new db(); 
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

	}

	return $number_list;
}

function get_hour_time($id_team){
	$db = new db(); 
	$db->query("SELECT *
				FROM tb_jornada_trabalho
				WHERE id_func =:id_func ORDER BY dia_semana"); 
	$db->bind(':id_func', $id_team);			
	$db->execute();
	$response = array();
	$result2 = $db->resultset(); 
	if($result2){
		$i = 0;
		$work_days = "";
		foreach($result2 as $row) {
			$response[] = array(
				"dow"=>[(int)$row['dia_semana']],
				"start"=>$row['hora_inicio'],
				"end"=>$row['hora_termino'],
			);
		}

	}

	return $response;
}

function get_constraint_time($id_team){
	$db = new db(); 
	$db->query("SELECT *
				FROM tb_jornada_trabalho
				WHERE id_func =:id_func ORDER BY dia_semana"); 
	$db->bind(':id_func', $id_team);			
	$db->execute();
	$response = array();
	$result2 = $db->resultset(); 
	if($result2){
		$i = 0;
		$work_days = "";
		foreach($result2 as $row) {
			$response[] = array(
				"start"=>$row['hora_inicio'],
				"end"=>$row['hora_termino'],
			);
		}

	}

	return $response;
}
		

 ?>