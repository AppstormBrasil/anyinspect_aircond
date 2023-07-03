<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);

//if(isset($_GET['IdUser'])){ $id = $_GET['IdUser'];} else { $id  = '';}


$db = new db(); 

$db->query("SELECT 
			tc.nome_empresa , tc.email , tc.phone , tc.endereco , tc.bairro , tc.number , tc.cidade , tc.foto
			FROM tb_companie tc"); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$email = $row["email"];
		$phone = $row["phone"];
		$foto = $row["foto"];
		$nome_empresa = $row["nome_empresa"];
		$endereco = $row["endereco"];
		$bairro = $row["bairro"];
		$cidade = $row["cidade"];
		$number = $row["number"];
		
		
		if ($foto != ""){
			$foto = prod_path."images/upload/empresa/".$foto ;
		}else{
			$foto = prod_path."app/images/profile.jpg" ;
		}

		$response['data'][] = array(
			"email"=>$email,
			"phone"=>$phone,
			"foto"=>$foto,
			"nome_empresa"=>$nome_empresa,
			"endereco"=>$endereco,
			"bairro"=>$bairro,
			"cidade"=>$cidade,
			"number"=>$number,
		);
		$i++;
	 
		} 
		 $response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = []; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>