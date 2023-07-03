<?php

  include('../common/util.php');

   $id_booking = $_GET['id_atividade'];

  $database = new db();
  $database->query("SELECT tbe.* , DATE_FORMAT(tbe.date_create ,'%d/%m/%Y %H:%i:%s') as date_create FROM tb_book_evidence tbe
  					WHERE tbe.id_booking = :id_booking");
  $database->bind(':id_booking', $id_booking);


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
					"id"=> $id
				);

			} else {
				// TRATAMENTO DAS IMAGENS
				
				$response['box'][] = array(
					"box_"=>'image_box_'.$id_element
				);
			
				if ($value != ""){
					
					if($id_element == 'sig_colab'){
						$src_img_sig = "images/upload/atividade/ev/$id_booking/sig_colab/".$value ;
						$target_img_sig = 'image_form_'.$id_element ;

						$response['img_sign'][] = array(
							"target_img"=>'box_sig_colab',
							"src_img"=>$src_img_sig,						
						);
					}
					
					if($id_element == 'sig_cli'){
						$src_img_sig = "images/upload/atividade/ev/$id_booking/img/sig_cli/".$value ;
						$target_img_sig = 'image_form_'.$id_element ;
						
						$response['img_sign'][] = array(
							"target_img"=>'box_sig_cli',
							"src_img"=>$src_img_sig,						
						);
					}


					
					$src_img = "images/upload/atividade/ev/$id_booking/img/$id_element/".$value ;
					$target_img = 'image_form_'.$id_element ;

					$response['img_elements'][] = array(
						"target"=>'image_box_'.$id_element,
						"target_img"=>$target_img,
						"src_img"=>$src_img,						
					);
				} 
			
			}
			
		

			/*$response['evidence'][] = array(
				"id"=>$id,
				"id_booking"=>$id_booking,
				"id_element"=>$id_element,
				"type_ev"=>$type_ev,
				"value"=>$value,
				"date_create"=>$date_create,
				"user_id"=>$user_id,
				"target"=>$target,
				"target_value"=>$target_value,
				
			
			); */

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
