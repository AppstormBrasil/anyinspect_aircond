<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from tb_prcnc'); 
$db->execute();

// id, item, task, task_description, frequencia, days, exec, next_exec, remain, hh, price, order_, company, doc

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$item = $row["item"];
		$task = $row["task"];
		$task_description = $row["task_description"];
		$frequencia = $row["frequencia"];
		$days = $row["days"];
		$exec = $row["exec"];
		$next_exec = $row["next_exec"];
		$remain = $row["remain"];
		$hh = $row["hh"];
		$price = $row["price"];
		$order_ = $row["order_"];
		$company = $row["company"];
		$doc = $row["doc"];

		if(strlen($task_description) > 35){
			$task_description = substr($task_description, 0, 35).'...'; 
		}
		
	
		$response['data'][] = array(
			"id"=>$row['id'],
			"item"=>$item,
			"task"=>$task,
			"task_description"=>$task_description,
			"frequencia"=>$frequencia,
			"days"=>$days,
			"exec"=>$exec,
			"next_exec"=>$next_exec,
			"remain"=>$remain,
			"hh"=>$hh,
			"price"=>$price,
			"order_"=>$order_,
			"company"=>$company,
			"doc"=>$doc,
			"botao"=>'<button class="btn btn-primary btn-xs" onclick="RemoveItem('.$row['id'].',\''.$task.'\',\''.$days.'\')" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>