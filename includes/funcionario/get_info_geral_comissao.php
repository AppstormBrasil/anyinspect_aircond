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
	$foto_empresa = "assets/images/nouser.png" ;
} 



$response['empresa'] = array(
	"id"=>$result['id'],
	"nome_empresa"=>$result['nome_empresa'],
	"email"=>$result['email'],
	"phone"=>$result['phone'],
	"cep"=>$result['cep'],
	"endereco"=>utf8_encode($result['endereco']),
	"bairro"=>$result['bairro'],
	"number"=>$result['number'],
	"cidade"=>$result['cidade'],
	"estado"=>$result['estado'],
	"foto_empresa"=>$foto_empresa
);


$db->query('SELECT * from tb_team where id = "'.$id_funcionario.'" '); 
$db->execute();
$result_f = $db->single(); 
$foto_funcionario = $result_f['foto'];
if ($foto_funcionario != ""){
	$foto_funcionario = 'images/upload/funcionarios/'.$foto_funcionario;
}else{
	$foto_funcionario = "assets/images/nouser.png" ;
} 


$response['funcionario'] = array(
	"id"=>$result_f['id'],
	"name"=>$result_f['name'],
	"email"=>$result_f['email'],
	"phone"=>$result_f['phone'],
	"cpf"=>$result_f['cpf'],
	"rg"=>$result_f['rg'],
	"foto_funcionario"=>$foto_funcionario,
	"zip"=>$result_f['zip'],
	"street"=>$result_f['street'],
	"neighbor"=>$result_f['neighbor'],
	"city"=>$result_f['city'],
	"state_"=>$result_f['state_'],
	"number"=>$result_f['number'],
	"complemento"=>$result_f['complemento']
);



$db->query("SELECT pc.comission , pc.save_date , ps.short_dec
FROM tb_comission pc
LEFT JOIN tb_book_detail pbd ON pc.id_booking = pbd.id_booking
LEFT JOIN tb_services ps ON pbd.service_name = ps.id
WHERE pc.save_date like '%$date%' AND id_func = $id_funcionario "); 

$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 $comissao_total = 0;
	 foreach($result as $row) {
	
		$comission = $row["comission"];
		$save_date = $row["save_date"];
		$short_dec = $row["short_dec"];
		
		$save_date = usa_to_br_date_time($save_date);
		$save_date = trim($save_date);

		$comissao_total += $comission;
		$response['comission'][] = array(
			"comission"=>$row['comission'],
			"save_date"=>$save_date,
			"short_dec"=>$short_dec		
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
} 
		  
echo json_encode($response);

 ?>