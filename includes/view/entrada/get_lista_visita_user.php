<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$IdCondominio = get_id_empresa();
$IdMorador = get_current_id();

$db = new db(); 
 
 if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 

 
$IdResidencia = $id; 
if($id > 0){ 
 	 $db->query('SELECT * FROM tb_visitantes WHERE IdCondominio ='. $IdCondominio .' '); 
 } else { 
	$db->query('SELECT * FROM tb_visitantes '); 
 } 
 $db->execute();
$result = $db->resultset(); 
$response = array();
if($result){ 
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["IdMorador"];
		$IdResidencia = $row["IdResidencia"];
        $IdCondominio = $row["IdCondominio"];
        $IdVisitante = $row["IdVisitante"];
        $imagem = $row['imagem'];
        

		if ($imagem != ""){
			$imagem = "images/visitante/".$IdCondominio."/".$IdResidencia."/".$imagem ;
		}else{
			$imagem = "images/nouser2.jpg" ;
        }
		 $response['lista_visitantes'][$i] = array(
             "IdCondominio"=>$row['IdCondominio'],
             "IdMorador"=>$row['IdMorador'],
			 "IdResidencia"=>$row['IdResidencia'],
			 "tipo_visitante"=>$row['tipo_visitante'],
			 "nome_visitante"=>$row['nome_visitante'],
			 "imagem"=>$imagem,
			 "identificacao"=>$row['identificacao'],
			 "email"=>$row['email'],
			 "tipo_veiculo"=>$row['tipo_veiculo'],
			 "placa_veiculo"=>$row['placa_veiculo'],
             "data_entrada"=>br_month3($row['data_entrada']),
             "hora_entrada"=>get_only_time($row['data_entrada']),
			 "qrcode_visitante"=>$row['qrcode_visitante'],
			 "data_cadastro"=>$row['data_cadastro'],
			 "obs"=>$row['obs']
		 );
		 
		$i++; 
	 } 
	 	 $response['status'] = 'SUCCESS';
	 	 echo json_encode($response);
	 	 //exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informação disponível'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>