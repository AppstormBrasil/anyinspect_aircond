<?php 
	include('../../common/util.php'); 

	$db = new db(); 
	
	$img = $_POST['image'];
	$id_funcionario = $_POST['id_func'];
	
    $folderPath = "../../../images/pet/upload/funcionarios/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
  
    //print_r($fileName);
		
	$db->query('UPDATE pet_team SET foto = :foto WHERE id = :id ');
 
	$db->bind(':foto', $fileName);
	$db->bind(':id', $id_funcionario);
	
	if($db->execute()){
		$arr['status'] = 'SUCCESS';
		$arr['status_txt'] = 'Atualizado com Sucesso'; 
		echo "Sucesso! Você será redirecionado de volta....";
		header( "Refresh:3; url=http://localhost/Agendazy/pet-lista-funcionario-detalhado.php?id=$id_funcionario", true, 303);
		exit(0);
	}
	else { 
 	 	$arr['status'] = 'ERROR'; 
	 	$arr['status_txt'] = 'Erro ao Atualizar'; 
	 	echo json_encode($arr);
	} 

 ?>