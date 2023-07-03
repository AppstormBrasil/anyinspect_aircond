<?php

  include('../common/util.php');
   $row = json_decode(file_get_contents('php://input'), true);
   
   $id_booking = $row['id'];

  $database = new db();
  $database->query('SELECT * FROM tb_book_evidence tbe
  					WHERE tbe.id_booking = :id_booking AND id_element = :id_element LIMIT 1');
  $database->bind(':id_booking', $id_booking);
  $database->bind(':id_element', 'sig_cli');


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
				
				$response['box'][] = array(
					"box_"=>'image_box_'.$id_element
				);
			
				if ($value != ""){
					
					/*if($id_element == 'sig_colab'){
						$src_img_sig = prod_path."images/upload/atividade/ev/$id_booking/img/sig_colab/".$value ;
						$target_img_sig = 'image_form_'.$id_element ;

						$response['img_sign'][] = array(
							"target_img"=>'box_sig_colab',
							"src_img"=>$src_img_sig,						
						);
					} */
					
					if($id_element == 'sig_cli'){
						$src_img_sig = prod_path."images/upload/atividade/ev/$id_booking/img/sig_cli/".$value ;
						$target_img_sig = 'image_form_'.$id_element ;
						
						$response['img_sign'][] = array(
							"target_img"=>'box_sig_cli',
							"src_img"=>$src_img_sig,						
						);
					}


					
					/*$src_img = "images/upload/atividade/ev/$id_element/".$value ;
					$target_img = 'image_form_'.$id_element ;

					$response['img_elements'][] = array(
						"target_img"=>$target_img,
						"src_img"=>$src_img,						
					);*/
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
