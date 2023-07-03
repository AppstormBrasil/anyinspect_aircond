<?php

  include('../common/util.php');

   $IdUser = $_GET['IdUser'];
  
  $database = new db();
  $database->query('SELECT * FROM formulario_resposta fr ');
  
  $result = $database->resultset();
	if($result){
		$i = 0;

		foreach($result as $row) {

			$sign_value = $row['sign_value'];

			if($sign_value != ''){
				$sign_value = $row['sign_value'];
				//$arr['resp_atividade'][$i]['valor'] = $row['sign_value'];
			} else {
				//$arr['resp_atividade'][$i]['valor'] = $row['valor'];
				$sign_value = $row['valor'];
			}
			
			
			$response['data'][] = array(
				"id"=>$row['IdFormularioResposta'],
				"campo"=>$row['campo'],
				"IdFormulario"=>$row['IdFormulario'],
				"IdEvento"=>$row['IdEvento'],
				"valor"=>$sign_value
			);
			
			
			
			//$arr['resp_atividade'][$i]['IdFormularioResposta'] = $row['IdFormularioResposta'];
			//$arr['resp_atividade'][$i]['campo'] = $row['campo'];

			

			$i++;

		}
		//$arr['status'] = "SUCCESS";
		echo json_encode($response);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! Nenhuma informacao!";
		echo json_encode($arr);
	}


exit(0);

?>
