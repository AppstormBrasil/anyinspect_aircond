<?php 
include('../common/util.php'); 
$db = new db(); 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 

if($id > 0){
 	 $db->query("SELECT tv.* , tvs.nome_visitante,tvs.identificacao,tvs.qrcode_visitante,tvs.periodo,tvs.IdVisitante,tv.data_visita as data_string,
	  DATE_FORMAT(tvs.data_prevista,'%d/%m/%Y %H:%i:%s') as data_prevista,
      DATE_FORMAT(tv.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro,
      DATE_FORMAT(tv.data_visita,'%d/%m/%Y %H:%i:%s') as data_visita
      FROM tb_visitantes tvs
	  LEFT JOIN tb_visita tv ON tv.IdVisita = tvs.IdVisita
      WHERE tv.IdVisita ='$id' "); 
 } else { 
  	 $someArray = [];
	 echo json_encode($someArray);
 } 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 $someArray = [];
	 foreach ($result as $row) {
		
		$IdCondominio = $row["IdCondominio"];
		$nome_visitante = $row["nome_visitante"];
		if($nome_visitante != ''){
			$nome_visitante_short = substr($nome_visitante, 0, 1);
		} else {
			$nome_visitante_short = '0';
		}
	 
		array_push($someArray, [
		'IdCondominio'   => $row['IdCondominio'],
		'IdVisita'   => $row['IdVisita'],
		'IdVisitante'   => $row['IdVisitante'],
		'titulo'   => $row['titulo'],
		'data_cadastro' => $row['data_cadastro'],
		'data_visita' => $row['data_visita'],
		'status' => $row['status'],
		'message_type' => 'message_type_green',
		'tipo_mensagem' => 'Visita',
		'nome_visitante' => $row['nome_visitante'],
		'nome_visitante_short' => $nome_visitante_short,
		'identificacao' => $row['identificacao'],
		'qrcode_visitante' => $row['qrcode_visitante'],
		'data_prevista' => $row['data_prevista'],
		'periodo' => $row['periodo'],
		'mes_string' => get_mes_string($row['data_string']),
		'dia_string' => $row['data_string'],
		'id' => $i
		]);
		
		$i++;
	}
	

	
	echo json_encode($someArray);
	
} else { 
 	 	 $someArray = [];
	 	 echo json_encode($someArray);
	 	 } 

 ?>