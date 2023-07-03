<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$IdCondominio = get_id_empresa();
$db = new db(); 

$db->query('SELECT * FROM tb_admin_colaborador WHERE IdCondominio ='. $IdCondominio .' '); 
$db->execute();

$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 foreach($result as $row) { 
		$id = $row["IdColaborador"];
		$data_cadastro = br_month3($row['data_cadastro']);
		$imagem = $row["imagem"];

		if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = "images/colaborador/".$IdCondominio."/".$id."/".$imagem ;
		}else{
			$imagem = "images/noimage.jpg" ;
		}
		
		$response['data'][] = array(
			"IdColaborador"=>$row['IdColaborador'],
			"nome"=>$row['nome'],
			"email"=>$row['email'],
			"funcao"=>$row['funcao'],
			"telefone1"=>$row['telefone1'],
			"imagem"=>$imagem,
			"status"=>$row['status']
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>