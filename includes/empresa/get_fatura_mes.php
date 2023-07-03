<?php 
 
include('../common/util.php'); 

//if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
if(isset($_GET['month'])){ $month = $_GET['month'];} else { $month  = '';}
$id_funcionario = 1;
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
	"number"=>'712',
	"cidade"=>$result['cidade'],
	"estado"=>$result['estado'],
	"foto_empresa"=>$foto_empresa
);


$db->query('SELECT * from tb_team where id = "'.$id_funcionario.'" '); 
$db->execute();
$result_f = $db->single(); 
$foto_funcionario = $result_f['foto'];
if ($foto_funcionario != ""){
	$foto_funcionario = 'images/pet/upload/funcionarios/'.$foto_funcionario;
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



$db->query("SELECT DATE_FORMAT(tb.start_date, '%d/%m/%Y %H:%i' ) as data_servico ,  
tc.name as nome_cliente , tc.foto as foto_cliente ,  
tbd.price , tt.name as nome_funcionario , tt.foto as foto_funcionario , ts.short_dec
FROM tb_booking tb
LEFT JOIN tb_client tc ON tb.id_client = tc.id
LEFT JOIN tb_book_detail tbd ON tb.id = tbd.id_booking
LEFT JOIN tb_team tt ON tbd.id_funcionario = tt.id
LEFT JOIN tb_services ts ON tbd.service_name = ts.id
WHERE tb.start_date LIKE '%$date%' "); 


$db->execute();

$result = $db->resultset(); 

//print_r($result);

if($result){
	 $i = 0; 
	 $comissao_total = 0;
	 foreach($result as $row) {
	
		$data_servico = $row["data_servico"];
		$nome_cliente = $row["nome_cliente"];
		$nome_funcionario = $row["nome_funcionario"];
		$price = $row["price"];
		$short_dec = utf8_encode($row["short_dec"]);

		$foto_funcionario = $row['foto_funcionario'];
		if ($foto_funcionario != ""){
			$foto_funcionario = 'images/upload/funcionarios/'.$foto_funcionario;
		}else{
			$foto_funcionario = "assets/images/nouser.png" ;
		} 
		
		$foto_cliente = $row['foto_cliente'];
		if ($foto_cliente != ""){
			$foto_cliente = 'images/upload/clientes/'.$foto_cliente;
		}else{
			$foto_cliente = "assets/images/nouser.png" ;
		} 
		
		//$comissao_total += ($i * 0.50);
		$response['fatura'][] = array(
			"data_servico"=>$row['data_servico'],
			"nome_cliente"=>utf8_encode($nome_cliente),
			"nome_funcionario"=>$nome_funcionario,		
			"short_dec"=>$short_dec,
            //"short_dec"=>'',				
			"price"=>$price	,	
			"foto_funcionario"=>$foto_funcionario,		
			"foto_cliente"=>$foto_cliente		
		);
		
		$i++;
	
	}
	 
	 //$comissao_total = number_format($comissao_total,2);
	 $comissao_total = ((float)$i * 0.50);

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