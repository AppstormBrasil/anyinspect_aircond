<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
 
 if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$IdMorador = $id; 
if($id > 0){ 
 	 $db->query('SELECT IdMorador,IdCondominio,IdResidencia,nome,email,senha,telefone1,telefone2,telefone3,cpf,rg,parentesco,qrcode_morador,data_cadastro,imagem ,tipo , recebe_email , recebe_sms 
	 FROM tb_morador WHERE IdMorador ='. $id .' '); 
 }
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 $myArray = [];
	 foreach($result as $row) { 
		$IdCondominio = $row["IdCondominio"];
		$IdMorador = $row["IdMorador"];
		$IdResidencia = $row["IdResidencia"];
		$imagem = $row["imagem"];
		$recebe_email = $row["recebe_email"];
		$recebe_sms = $row["recebe_sms"];

		if ($imagem != ""){
			$imagem = prod_path."/images/morador/".$IdCondominio."/".$IdResidencia."/".$imagem ;
		}else{
			$imagem = prod_path."/images/nouser.png" ;
		}
		

		if($recebe_email == 1){
			$recebe_email = 'checked';
		} else {
			$recebe_email = '';
		}
		
		if($recebe_sms == 1){
			$recebe_sms = 'checked';
		} else {
			$recebe_sms = '';
		}
		
		array_push($myArray, [
		'IdMorador' => $row['IdMorador'],
		'tipo' => $row['tipo'],
		'recebe_email' => $recebe_email,
		'recebe_sms' => $recebe_sms,
		'IdCondominio'   => $row['IdCondominio'],
		'IdResidencia'   => $row['IdResidencia'],
		'nome'   => $row['nome'],
		'email' => $row['email'],
		'telefone1' => $row['telefone1'],
		'qrcode_morador' => $row['qrcode_morador'],
		'imagem' => $imagem
		
		]);
	 
	 	 //$arr['response'][] = $row; 
	 
	 
	 } 
	 	 $arr['status'] = 'SUCCESS';
	 	 echo json_encode($myArray);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informa��o dispon�vel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>