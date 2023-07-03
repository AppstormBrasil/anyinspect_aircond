<?php

  include('../common/util.php');
  $_POST = json_decode(file_get_contents('php://input'), true);

  $id_booking = $_GET['id_booking'];
  $id_element = $_GET['id_element'];
  //$id_element ='20-1';

  $database = new db();
  $database->query("SELECT tbe.* , DATE_FORMAT(tbe.date_create ,'%d/%m/%Y %H:%i:%s') as date_create 
  					FROM tb_book_evidence tbe
  					WHERE tbe.id_booking = :id_booking AND id_element = :id_element");
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
			$id_booking = $row['id_booking'];  
			$id_element = $row['id_element'];  
			$type_ev = $row['type_ev']; 
			$value = $row['value'];  
			$date_create = $row['date_create'];  
			$user_id = $row['user_id']; 

			if($type_ev == 'txt'){
				$target = 'comment_'.$id_element;
				$target_value = $value;
				$box_comment = 'text_comment_'.$id_element;

				$response['box'][] = array(
					"box_"=>'text_comment_'.$id_element
				);
				
				$response['comments'][] = array(
					"target"=>'comment_'.$id_element,
					"target_value"=> $value,
					"date_create"=> $date_create,
				);

			} 

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
