<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query("SELECT id, name, cpf, rg, phone, phone2, email, neighbor, city , foto , certificado , funcao ,  nome_empresa , 
DATEDIFF(prox_auditoria , NOW() ) as dias_expira , 
DATE_FORMAT( prox_auditoria ,'%d/%m/%Y') as prox_auditoria ,  
DATE_FORMAT( ult_auditoria ,'%d/%m/%Y') as ult_auditoria
from tb_subcontrato"); 
$db->execute();

$result = $db->resultset(); 

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$cpf = $row["cpf"];
		$rg = $row["rg"];
		$phone = $row["phone"];
		$zap = $row["phone2"];
		$email = $row["email"];
		$neighbor = $row["neighbor"];
		$city = $row["city"];
		$foto = $row["foto"];
		
		if ($foto != ""){
			$foto = "images/upload/subcontratos/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

	

		$response['data'][] = array(
			"id"=>$row['id'],
			"name"=>$name,
			"foto"=>$foto,
			"cpf"=>$row['cpf'],
			"nome_empresa"=>$row['nome_empresa'],
			"rg"=>$row['rg'],
			"phone"=>$row['phone'],
			"zap"=>$row['phone2'],
			"email"=>$row['email'],
			"neighbor"=>$row['neighbor'],
			"city"=>$row['city'],
			"prox_auditoria"=>$row['prox_auditoria'],
			"ult_auditoria"=>$row['ult_auditoria'],
			"dias_expira"=>$row['dias_expira'],
			"certificado"=>$row['certificado'],
			"funcao"=>$row['funcao'],
			//"all_pets"=>$all_pets,
			"botao"=>'<a style="margin-right: 5px;" class="single_link btn btn-light btn-xs" id="'.$row['id'].'" href="subcontrato-'.$id.'">
			<i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('.$row['id'].',\''.$name.'\',\''.$foto.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>