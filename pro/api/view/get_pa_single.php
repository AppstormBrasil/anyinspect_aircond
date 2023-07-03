<?php

  include('../common/util.php');
  $row = json_decode(file_get_contents('php://input'), true);

  $id_booking = $_GET['id_booking'];
  $id_element = $_GET['id_element'];

  $database = new db();
  $database->query('SELECT * FROM tb_pa tp
  					WHERE tp.id_booking = :id_booking AND tp.id_element = :id_element');
  $database->bind(':id_booking', $id_booking);
  $database->bind(':id_element', $id_element);


  $result = $database->resultset();
	if($result){
		$i = 0;
		$target = "";
		$target_value = "";
		$src_img = "";
		foreach($result as $row) {

			$id = $row['id']; 
			$id_element = $row["id_element"];
			$id_booking = $row["id_booking"];
			$what_at = $row["what_at"];
			$why_at = $row["why_at"];
			$how_at = $row["how_at"];
			$resp_at = $row["resp_at"];
			$where_at = $row["where_at"];
			$when_at = $row["when_at"];
			$cost_at = $row["cost_at"];
			
			$response['pa'] = array(
				"id"=>$id,
				"id_element"=> $id_element,
				"id_booking"=> $id_booking,
				"what_at"=> $what_at,
				"why_at"=> $why_at,
				"how_at"=> $how_at,
				"resp_at"=> $resp_at,
				"where_at"=> $where_at,
				"when_at"=> $when_at,
				"cost_at"=> $cost_at,
			);

			$i++;

		}
		$response['status'] = "SUCCESS";
		echo json_encode($response);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! Nenhuma informacao!";
		echo json_encode($arr);
	}


exit(0);

?>
