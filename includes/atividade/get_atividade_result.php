<?php

  include('../common/util.php');

   $IdFormularioResposta = $_GET['IdFormulario'];
   $IdEvento = $_GET['IdEvento'];

  $database = new db();
  $database->query('SELECT * FROM formulario_resposta fr
  					WHERE fr.IdEvento = :IdEvento');
  $database->bind(':IdEvento', $IdEvento);


  $result = $database->resultset();
	if($result){
		$i = 0;

		foreach($result as $row) {
			
			$sign_value = $row['sign_value'];

			$arr['resp_atividade'][$i]['IdFormularioResposta'] = $row['IdFormularioResposta'];
			$arr['resp_atividade'][$i]['campo'] = $row['campo'];
			
			if($sign_value != ''){
				$arr['resp_atividade'][$i]['valor'] = $row['sign_value'];
				
			} else {
				$arr['resp_atividade'][$i]['valor'] = $row['valor'];
				//$arr['resp_atividade'][$i]['campo'] = $row['campo'];
			}
			

			$i++;

		}
		$arr['status'] = "SUCCESS";
		echo json_encode($arr);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! Nenhuma informacao!";
		echo json_encode($arr);
	}


exit(0);

?>
