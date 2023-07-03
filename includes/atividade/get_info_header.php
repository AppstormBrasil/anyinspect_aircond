<?php 
 
include('../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
if(isset($_GET['month'])){ $month = $_GET['month'];} else { $month  = '';}
$id_funcionario = $id;
//$date = date("Y-m");
$month = sprintf("%02d", $month);
$date = date("Y-".$month."");
$db = new db(); 

$db->query('SELECT * from tb_companie'); 
$db->execute();
$result = $db->single(); 

$foto_empresa = $result['foto'];
if ($foto_empresa != ""){
	$foto_empresa = 'images/upload/empresa/'.$foto_empresa;
}else{
	$foto_empresa = "assets/images/noimage.png" ;
} 



$response['empresa'] = array(
	"id"=>$result['id'],
	"nome_empresa"=>$result['nome_empresa'],
	"email"=>$result['email'],
	"phone"=>$result['phone'],
	"cep"=>$result['cep'],
	"endereco"=>$result['endereco'],
	"bairro"=>$result['bairro'],
	"number"=>$result['number'],
	"cidade"=>$result['cidade'],
	"estado"=>$result['estado'],
	"foto_empresa"=>$foto_empresa
);


$db->query('SELECT * from tb_client where id = "'.$id_funcionario.'" '); 
$db->execute();
$result_f = $db->single(); 
$foto_cliente = $result_f['foto'];
if ($foto_cliente != ""){
	$foto_cliente = 'images/upload/clientes/'.$foto_cliente;
}else{
	$foto_cliente = "assets/images/nouser.png" ;
} 


$response['funcionario'] = array(
	"id"=>$result_f['id'],
	"name"=>$result_f['name'],
	"email"=>$result_f['email'],
	"phone"=>$result_f['phone'],
	"cpf"=>$result_f['cpf'],
	"rg"=>$result_f['rg'],
	"foto_funcionario"=>$foto_cliente,
	"zip"=>$result_f['zip'],
	"street"=>$result_f['street'],
	"neighbor"=>$result_f['neighbor'],
	"city"=>$result_f['city'],
	"state_"=>$result_f['state_'],
	"number"=>$result_f['number'],
	"complemento"=>$result_f['complemento']
);


$db->query("SELECT  pb.id as id_book , 
pbd.id_quem_executou , ps.id as id_servico, 
ps.short_dec ,  pb.status , pb.id_client , pc.name as nome_cliente  , pc.foto as foto_cliente , 
pb.start_date as started_at , pb.end_date as ended_at , pbd.service_name ,pbd.price , 
round(((pbd.price * pt.comission) /100 ) ,2) as total_comission ,   pbd.info_extra ,  
pt.id as id_funcionario ,  pt.name as nome_funcionario , pt.foto as foto_funcionario , 
pb.forma_pagamento , pb.status_pagamento , tca.id as id_bolt , tca.descricao , tca.foto as foto_ativo , pbd.price_taxi , pbd.pet_taxi ,
DATE_FORMAT(pb.start_date ,'%d/%m/%Y %H:%i:%s') as start_date ,
DATE_FORMAT(pb.end_date ,'%d/%m/%Y %H:%i:%s') as end_date 
FROM tb_booking pb
LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id 
LEFT JOIN tb_client pc ON pb.id_client = pc.id 
LEFT JOIN tb_clients_ativo tca ON pbd.id_pet = tca.id 
LEFT JOIN tb_services ps ON ps.id = pbd.service_name 
LEFT JOIN tb_team pt ON pt.id = pbd.id_quem_executou
WHERE pc.id = $id_funcionario AND pb.start_date like '%$date%' "); 


$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 $comissao_total = 0;
	 foreach($result as $row) {
	
		$valor = $row["price"];
		$save_date = $row["end_date"];
		$short_dec = $row["short_dec"];
		$descricao = $row["descricao"];
		$foto_ativo = $row["foto_ativo"];
		$status = $row["status"];

		if($row['status'] == "Pendente"){
			$color = '#efefef';
			$textColor = "#111";
		} else if($row['status'] == "Em Andamento"){
			$color = '#f1c951';
			$textColor = "#111";
		} else if($row['status'] == "Cancelado"){
			$color = '#F44336';
			$textColor = "#fff";
		} else if($row['status'] == "Finalizado"){
			$color = '#18998d';
			$textColor = "#fff";
		} else if($row['status'] == "Deletado"){
			$color = '#0e0e0e';
			$textColor = "#fff";
		} else if($row['status'] == "Concluído"){
			$color = '#8bc34a';
			$textColor = "#fff";
		} else if($row['status'] == "Reprovado"){
			$color = '#E91E63';
			$textColor = "#fff";
		} else {
			$color = '#0275d8';
			$textColor = "#FFF";
		}

		$foto_ativo = $row['foto_ativo'];
		 if ($foto_ativo != ""){
			$foto_ativo = 'images/upload/ativos/'.$foto_ativo;
		 }else{
			$foto_ativo = "assets/images/noimage.png" ;
		 }
		
		//$save_date = usa_to_br_date_time($save_date);
		$save_date = trim($save_date);

		$comissao_total += $valor;
		$response['comission'][] = array(
			"comission"=>$valor,
			"save_date"=>$save_date,
			"short_dec"=>$short_dec,		
			"descricao"=>$descricao,		
			"foto_ativo"=>$foto_ativo,		
			"color"=>$color,	
			"color"=>$color,	
			"textColor"=>$textColor	,	
			"status"=>$status		
		);
	 }
	 
	 $comissao_total = number_format($comissao_total,2);

	 $response['comission_total'] = array(
		"comissao_total"=>$comissao_total		
	);
	 


} else { 
	$response['status'] = 'ERROR'; 
	$response['status_txt'] = 'Nenhuma informacao disponivel'; 
	$response['data'][] = array();
	$response['comission'] = array();
	$response['comission_total'][] = array();
} 
		  
echo json_encode($response);

 ?>