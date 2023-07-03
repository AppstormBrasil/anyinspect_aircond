<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
if(isset($_POST['final_date_usa'])){ $final_date_usa = $_POST['final_date_usa'];} else { $final_date_usa  = '';}
if(isset($_POST['id_func'])){ $id_func = $_POST['id_func'];} else { $id_func  = '';}
if(isset($_POST['per_max'])){ $per_max = $_POST['per_max'];} else {
	$response['status'] = 'ERROR';
	$response['status_txt'] = 'Erro inesperado tente novamente';
	echo json_encode($response);
	exit(0);
}

$abre = "";
$fecha = "";
function getWeekday($date) {
    return date('w', strtotime($date));
}

$dia_semana =  getWeekday($final_date_usa); // returns 4

// GET OPEN HOURS

$db = new db(); 
$db->query("SELECT * FROM tb_jornada_trabalho WHERE dia_semana =:dia_semana AND id_func =:id_func "); 
$db->bind(':dia_semana', $dia_semana);
$db->bind(':id_func', $id_func);
$db->execute();
$result = $db->resultset(); 

$disabled_time = array();

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$abre = $row["hora_inicio"];
		$fecha = $row["hora_termino"];
		$pausa_incio = $row["pausa_incio"];
		$pausa_final = $row["pausa_final"];
	 } 

} else {
	$response['status'] = 'ERROR';
	$response['status_txt'] = 'Erro inesperado tente novamente';
	echo json_encode($response);
	exit(0);
}
$db = new db(); 
$db->query("SELECT TIME(tb.start_date) as hora_inicio , tbf.id_fun
FROM tb_booking tb 
LEFT JOIN tb_book_func tbf ON tb.id = tbf.id_booking
WHERE tb.start_date LIKE '%$final_date_usa%' AND tbf.id_fun =:id_func ORDER BY tb.start_date"); 
//$db->bind(':final_date_usa', $final_date_usa);
$db->bind(':id_func', $id_func);
$db->execute();
$result = $db->resultset(); 

$disabled_time = array();

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$hora_inicio = $row["hora_inicio"];
		$disabled_time[] =$hora_inicio ;
	 } 

}


$per_max_min = "+".hourMinute2Minutes($per_max)." minutes";
$start = strtotime($abre);

$dummy_date_start = "";
$status_time_start = "";
$end = strtotime($fecha);
$range = array();
$start_dummy = strtotime($abre);
$dummy_date_start = date('H:i:s', $start_dummy);

if (in_array($dummy_date_start, $disabled_time)) { 
	$status_time_start = 'light';
} else {
	$status_time_start = 'success';
}

$data['data'][] = array(
	"time"=> date('H:i', $start_dummy),
	"time_usa"=> date('H:i:s', $start_dummy),
	"status_time"=> $status_time_start,
);

$dummy_date = "";
$status_time = "";

while ($start < $end)
{	
	$start = strtotime($per_max_min,$start);
	
	
	$dummy_date = date('H:i:s', $start);
	
	
	if (in_array($dummy_date, $disabled_time)) { 
		$status_time = 'light';
	} else {
		$status_time = 'success';
	}

	$data['data'][] = array(
		"time"=> date('H:i', $start),
		"time_usa"=> date('H:i:s', $start),
		"status_time"=> $status_time,
		
	);
}

$response['status'] = 'SUCCESS';
$response['data'] = $data;
echo json_encode($response);
exit(0);









 ?>