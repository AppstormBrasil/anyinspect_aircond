<?php

  include('../common/util.php');
  $row = json_decode(file_get_contents('php://input'), true);

  $id_booking = $_GET['id_booking'];
  $id_element = $_GET['id_element'];

  $database = new db();
  $database->query('SELECT * FROM tb_book_evidence tbe
  					WHERE tbe.id_booking = :id_booking AND tbe.id_element = :id_element AND type_ev = :type_ev ORDER BY tbe.id DESC ');
  $database->bind(':id_booking', $id_booking);
  $database->bind(':id_element', $id_element);
  $database->bind(':type_ev', 'img');


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
			$type_ev = $row["type_ev"];
			$imagem = $row["value"];
			

			if ($imagem != ""){
				$imagem = prod_path."images/upload/atividade/ev/$id_booking/img/$id_element/".$imagem ;

				$response['img'][] = array(
					"id"=>$id,
					"id_element"=> $id_element,
					"id_booking"=> $id_booking,
					"type_ev"=> $type_ev,
					"imagem"=> $imagem,
					
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
