<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 

 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
 if(isset($_POST['produtos'])){ $produtos = $_POST['produtos'];} else {$produtos = '';}
 

 	$db->query("SELECT id FROM tb_service_prod WHERE id_service = :id_service AND id_product = :id_product ");
	$db->bind(':id_service', $id);
	$db->bind(':id_product', $produtos);
	$db->execute();
	$result = $db->single(); 
	$id_res = $result['id'];

 
 if($id_res > 0){
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Produto já Cadastrado!'; 
		echo json_encode($arr);
		exit(0);
  
  } else {
		
	$db->query("INSERT INTO tb_service_prod (id_service, id_product) VALUES (:id_service, :id_product)");
	$db->bind(':id_service', $id);
	$db->bind(':id_product', $produtos);
	$db->execute();


 $arr['status'] = 'SUCCESS';
 $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
 echo json_encode($arr);
 exit(0);

  }

  
 

 
exit;

 ?>