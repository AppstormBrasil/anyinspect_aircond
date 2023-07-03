<?php
//set_time_limit(144000);

ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
set_time_limit(0);

date_default_timezone_set("Brazil/East"); 
include("../excel_reader.php");
include("connection.php");
//include('../../common/util.php'); 
$data_cadastro = date('Y-m-d  H:i:s'); 
$excel = new PhpExcelReader;
//$excel->read('upload_atividades_ago_.xls');
$excel->read('prcnc.xls');
$sheet = $excel->sheets[0];
$db = new db(); 

$x = 2;
$total = "";
while($x <= $sheet['numRows']) {

	// item, task, task_description, frequencia, days, exec, next_exec, remain, hh, price, order, company, doc

	if(isset($sheet['cells'][$x][1])) {
		$item = isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : "";
		$task = isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : "";
		$task_description = isset($sheet['cells'][$x][3]) ? $sheet['cells'][$x][3] : "";
		$frequencia = isset($sheet['cells'][$x][4]) ? $sheet['cells'][$x][4] : "";
		$days = isset($sheet['cells'][$x][5]) ? $sheet['cells'][$x][5] : "";
		$exec = isset($sheet['cells'][$x][6]) ? $sheet['cells'][$x][6] : "";
		$next_exec = isset($sheet['cells'][$x][7]) ? $sheet['cells'][$x][7] : "";
		$remain = isset($sheet['cells'][$x][8]) ? $sheet['cells'][$x][8] : "";
		$hh = isset($sheet['cells'][$x][9]) ? $sheet['cells'][$x][9] : "";
		$price = isset($sheet['cells'][$x][10]) ? $sheet['cells'][$x][10] : "";
		$order = isset($sheet['cells'][$x][11]) ? $sheet['cells'][$x][11] : "";
		$company = isset($sheet['cells'][$x][12]) ? $sheet['cells'][$x][12] : "";
		$doc = isset($sheet['cells'][$x][13]) ? $sheet['cells'][$x][13] : "";
		
		$task_description = utf8_encode($task_description);

		
		$db->query('INSERT INTO tb_prcnc (item, task, task_description, frequencia, days, exec, next_exec, remain, hh, price, order_, company, doc) 
					VALUES (:item, :task, :task_description, :frequencia, :days, :exec, :next_exec, :remain, :hh, :price, :order_, :company, :doc)');
		$db->bind(':item', $item);
		$db->bind(':task', $task);
		$db->bind(':task_description', $task_description);
		$db->bind(':frequencia', $frequencia);
		$db->bind(':days', $days);
		$db->bind(':exec', $exec);
		$db->bind(':next_exec', $next_exec);
		$db->bind(':remain', $remain);
		$db->bind(':hh', $hh);
		$db->bind(':price', $price);
		$db->bind(':order_', $order);
		$db->bind(':company', $company);
		$db->bind(':doc', $doc);
		$db->execute();  
	}
	$x++;
}




$ftime = time();



$arr['status'] = 'SUCCESS';
$arr['status_txt'] = 'Atualizacao Atividades realizada com Sucesso!' ;
echo json_encode($arr);


exit(0);

?>
