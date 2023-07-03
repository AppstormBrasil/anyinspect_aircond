<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$lista_colaborador = $_GET["lista_colaborador"];
$show_atividades = $_GET["show_atividades"];
$data_inicial = $_GET["data_inicial"];
$data_final = $_GET["data_final"];
$id_user = $_GET["id_user"];
$response = array();

$id_funcionario = $id_user;

$extra_where = "";
if(isset($_GET["base"])){
	  $lista_base = $_GET["base"];
	  $inside_value = "";
	  if($lista_base[0] == 'ALL'){
		$extra_where = '';
	  } else {
		foreach($lista_base as $row) {
			$inside_value .= "'$row'," ;
		}

		$inside_value = substr($inside_value,0,-1);
		$extra_where = ' WHERE tp.base IN('.$inside_value.') ';
	  }
  
  } else {
   $has_func = "";  
   $extra_where = " ";
}

$db = new db(); 

$db->query('SELECT tt.name , tt.phone , tt.phone2 , tt.zip , tt.email , 
tt.street , tt.neighbor , tt.city , tt.state_ , tt.number , tt.complemento , tt.sign ,  
tt.born , tt.foto , tt.local_nascimento , tt.cargo , 
DATE_FORMAT( tt.data_admicao ,"%d/%m/%Y") as data_admicao , 
DATE_FORMAT( tt.born ,"%d/%m/%Y") as born  
from tb_team tt where tt.id = "'.$id_funcionario.'"'); 
$db->execute();
$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$foto = $row['foto'];
		if ($foto != ""){
			$foto = 'images/upload/funcionarios/'.$foto;
		}else{
			$foto = "assets/images/nouser.png" ;
		} 
		$name = $row["name"];
		$email = $row["email"];
		$phone = $row["phone"];
		$phone2 = $row["phone2"];
		$zip = $row["zip"];
		$street = $row["street"];
		$number = $row["number"];
		$complemento = $row["complemento"];
		$neighbor = $row["neighbor"];
		$city = $row["city"];
		$state_ = $row["state_"];
		$data_nascimento = $row["born"];
		$data_admicao = $row["data_admicao"];
		$local_nascimento = $row["local_nascimento"];
		$cargo = $row["cargo"];
		$sign = $row["sign"];

		$response['colaborador'] = array(
			"name"=>$name,
			"email"=>$email,
			"phone"=>$phone,
			"phone2"=>$phone2,
			"zip"=>$zip,
			"street"=>$street,
			"number"=>$number,
			"complemento"=>$complemento,
			"neighbor"=>$neighbor,
			"city"=>$city,
			"state"=>$state_,
			"data_nascimento"=>$data_nascimento,
			"foto"=>$foto,
			"data_admicao"=>$data_admicao,
			"local_nascimento"=>$local_nascimento,
			"cargo"=>$cargo,
			"sign"=>$sign
		);
	
	}
}


// GET TEAM DOC
$db->query("SELECT ttd.* ,  DATEDIFF(ttd.data_expira , NOW() ) as dias_expira , DATE_FORMAT( ttd.data_expira ,'%d/%m/%Y') as data_expira 
FROM tb_team_doc ttd WHERE ttd.id_func = $id_funcionario 
ORDER BY ttd.descricao "); 
$result = $db->resultset(); 
if($result){
	$i = 1; 
	foreach($result as $row) {
	$id = $row["id"];
	$descricao = $row["descricao"];
	$valor = $row["valor"];
	$data_expira = $row["data_expira"];

	if($data_expira == '00/00/0000'){
		$data_expira = '';
	}

	if($descricao == 'ANAC' || $descricao == 'anac' || $descricao == 'CREA' || $descricao == 'crea' || $descricao == 'Designação IIO' || $descricao == 'DESIGNAÇÃO IIO'){
		$response['profissional']['anac'] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"valor"=>$valor,
			"data_expira"=>$data_expira,
			"i"=>$i,
			
		);
	}
	
	if($descricao == 'CREA' || $descricao == 'crea' || $descricao == 'Designação IIO' || $descricao == 'DESIGNAÇÃO IIO'){
		$response['profissional']['crea'] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"valor"=>$valor,
			"data_expira"=>$data_expira,
			"i"=>$i,
			
		);
	}
	
	if($descricao == 'Designação IIO' || $descricao == 'DESIGNAÇÃO IIO'){
		$response['profissional']['designacao'] = array(
			"id"=>$id,
			"descricao"=>$descricao,
			"valor"=>$valor,
			"data_expira"=>$data_expira,
			"i"=>$i,
			
		);
	}

	$response['habilitacao'][] = array(
		"id"=>$id,
		"descricao"=>$descricao,
		"valor"=>$valor,
		"data_expira"=>$data_expira,
		"i"=>$i,
		
	);
	$i++;
}

// GET TEAM CURSOS

// id, id_func, desc_qual, tipo_qual, validade_qual, numero_qual, data_cadastro, horaria_qual, local_qual, dataini_qual, datafim_qual

$db->query("SELECT ttq.* ,  DATEDIFF(ttq.validade_qual , NOW() ) as dias_expira , 
DATE_FORMAT( ttq.validade_qual ,'%d/%m/%Y') as validade_qual ,
DATE_FORMAT( ttq.dataini_qual ,'%d/%m/%Y') as dataini_qual ,
DATE_FORMAT( ttq.datafim_qual ,'%d/%m/%Y') as datafim_qual 
FROM tb_team_qual ttq WHERE ttq.id_func = $id_funcionario 
ORDER BY ttq.desc_qual "); 
$result = $db->resultset(); 

	$i = 1; 
	foreach($result as $row) {
	$id = $row["id"];
	$desc_qual = $row["desc_qual"];
	$tipo_qual = $row["tipo_qual"];
	$validade_qual = $row["validade_qual"];
	$numero_qual = $row["numero_qual"];
	$horaria_qual = $row["horaria_qual"];
	$local_qual = $row["local_qual"];
	$dataini_qual = $row["dataini_qual"];
	$datafim_qual = $row["datafim_qual"];
	$dias_expira = $row["dias_expira"];

	$response['treinamento'][] = array(
		"id"=>$id,
		"desc_qual"=>$desc_qual,
		"tipo_qual"=>$tipo_qual,
		"validade_qual"=>$validade_qual,
		"numero_qual"=>$numero_qual,
		"horaria_qual"=>$horaria_qual,
		"local_qual"=>$local_qual,
		"dataini_qual"=>$dataini_qual,
		"datafim_qual"=>$datafim_qual,
		"dias_expira"=>$dias_expira,
		"i"=>$i,
		
	);
	$i++;
}


	 
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

// GET RESP NAME

$db->query('SELECT tt.name , tt.sign from tb_team tt WHERE tt.type2 = 1'); 
$db->execute();
$result = $db->single(); 
$response['responsavel'] = array(
	"name"=>$result['name'],
	"sign"=>$result['sign'],

);

// GET ATIVIDADES

if($show_atividades == 1){
	$extra_where = "";
$data_inicial = $_GET["data_inicial"];
$data_final = $_GET["data_final"];

if($data_inicial != '' && $data_final != ''){
	$extra_where = "AND (DATE_FORMAT(pbd.started_at ,'%d/%m/%Y') BETWEEN '$data_inicial' AND '$data_final')";
} else if($data_inicial != ''){
	$extra_where = " AND DATE_FORMAT(pbd.started_at ,'%d/%m/%Y') >= '$data_inicial' "; 
} else if($data_inicial != ''){
	$extra_where = " AND DATE_FORMAT(pbd.started_at ,'%d/%m/%Y') <= '$data_final'"; 
} else {
	$extra_where = "";
}

$db->query("SELECT pb.id , pbd.id_quem_executou , ps.id as id_servico, ps.short_dec ,  pb.status , pb.id_client , 
tc.name as nome_cliente  , tc.foto as foto_cliente , tc.id as id_pe ,
DATE_FORMAT(pbd.started_at ,'%d/%m/%Y %H:%i:%s') as started_at , 
DATE_FORMAT(pbd.ended_at ,'%d/%m/%Y %H:%i:%s') as ended_at , 
DATE_FORMAT(pb.start_date ,'%d/%m/%Y %H:%i:%s') as inicio_service , 
pbd.service_name , pbd.info_extra , pbd.price as volor_servico , 
pc.comission as total_comission, 
ps.price , tts.comission , round((tts.comission * pbd.price)/100,2) as comissao_funcionario , concat('R$ ', format((tts.comission * pbd.price)/100, 2)) as valor_pagar ,
TIME_TO_SEC(TIMEDIFF(pbd.ended_at,pbd.started_at)) as total_gasto , ta.iata , tca.descricao as descricao_ativo  
FROM tb_book_detail pbd
LEFT JOIN tb_booking pb ON pb.id = pbd.id_booking
LEFT JOIN tb_services ps ON ps.id = pbd.service_name
LEFT JOIN tb_team pt ON pt.id = pbd.id_funcionario
LEFT JOIN tb_book_func pbf ON pbf.id_booking = pb.id
LEFT JOIN tb_comission pc ON pc.id_func = pbf.id_fun 
LEFT JOIN tb_team_service tts on tts.id_service = pbd.service_name
LEFT JOIN tb_client tc ON pb.id_client = tc.id
LEFT JOIN tb_clients_ativo tca ON tca.id_client = tc.id
LEFT JOIN tb_aeroportos ta ON ta.id = pbd.aeroporto
WHERE pbf.id_fun = :id  $extra_where
GROUP BY pb.id "); 

$db->bind(':id', $id_funcionario);
$db->execute();


$result = $db->resultset(); 
if($result){
	 $i = 0;
	
	 foreach($result as $row) {
		$valor_pagar = $row['valor_pagar'];
		 $foto_cliente = $row['foto_cliente'];
		 $ended_at = $row['ended_at'];
		 $started_at = $row['started_at'];
	 	$status = $row['status'];
		 if ($foto_cliente != ""){
			$foto_cliente = 'images/upload/clientes/'.$foto_cliente;
		 }else{
			$foto_cliente = "assets/images/nouser.png" ;
		 } 		 
		 if($status == 'Finalizado'){
			if($valor_pagar != ""){
				$valor_pagar = $valor_pagar;
			 } else {
				$valor_pagar = 0;
			 }
		 } else {
			$valor_pagar = 0;
		 }

		 if($started_at == '00/00/0000 00:00:00'){
			$started_at = '';
		 } else {
			$started_at = $started_at; 
		 }
		 
		 if($ended_at == '00/00/0000 00:00:00'){
			$ended_at = '';
			$hora_total_gasto = '';
		 } else {
			$ended_at = $ended_at; 
			$hora_total_gasto =  gmdate('H:i:s', $row["total_gasto"]);
		 }
		$response['atividades'][] = array(
			"id_servico"=>$row['id_servico'],
			"iata"=>$row['iata'],
			"short_dec"=>$row['short_dec'],
			"status"=>$row['status'],
			"id_client"=>$row['id_client'],
			"nome_cliente"=>$row['nome_cliente'],
			"foto_cliente"=>$foto_cliente,
			"started_at"=>$started_at,
			"ended_at"=>$ended_at,
			"service_name"=>$row['service_name'],
			"price"=>$row['price'],
			"total_comission"=>$valor_pagar,
			"info_extra"=>$row['info_extra'],
			"inicio_service"=>$row['inicio_service'],
			"descricao_ativo"=>$row['descricao_ativo'],
			"hora_total_gasto"=>$hora_total_gasto
		);
	 }
} 
}




	echo json_encode($response);
	exit(0);
} else { 
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	$response[] = array();
	echo json_encode($response);
} 

 ?>