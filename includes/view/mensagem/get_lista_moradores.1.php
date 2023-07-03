<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$IdCondominio =  get_id_empresa(); 
$db = new db(); 
 


	$db->query('SELECT tm.*, tmr.IdCondominio , tmr.IdResidencia , tmr.tipo_residencia,tmr.sigla,tmr.numero as numero_residencia ,tmr.situacao,
	tmr.qrcode_residencia , tmr.imagem 
	FROM tb_morador tm
	LEFT OUTER JOIN tb_morador_residencia tmr ON tmr.IdResidencia = tm.IdResidencia
	WHERE tm.IdCondominio = '.$IdCondominio.' 
	GROUP BY tmr.IdResidencia LIMIT 50');
  


$db->execute();
$result = $db->resultset(); 
$response = array();
$arr = array();
$i = 0; 
//$data = array();
foreach($result as $row) { 
	$IdCondominio = $row['IdCondominio'];
		  $IdResidencia = $row['IdResidencia'];
		  $tipo_residencia = $row['tipo_residencia'];
			$nome_residencia = $row['sigla'];
			$nome = $row['nome'];
		  $numero_residencia = $row['numero_residencia'];
			$qrcode_residencia = $row['qrcode_residencia'];
			$telefone_morador = $row['telefone1'];
		  $situacao = $row['situacao'];
		  $email = $row['email'];
	  
		  $imagem = $row['imagem'];

		  if ($imagem != ""){
	 		$imagem = "images/residencia/".$IdCondominio."/".$IdResidencia."/".$imagem ;
		  }else{
			$imagem = "images/noimage.jpg" ;
		  }
			 
		  $arr['lista_moradores'][$i]['nome'] = $nome;
		  $arr['lista_moradores'][$i]['IdResidencia'] = $IdResidencia;
		  $arr['lista_moradores'][$i]['tipo_residencia'] = $tipo_residencia;
		  $arr['lista_moradores'][$i]['nome_residencia'] = $nome_residencia;
		  $arr['lista_moradores'][$i]['numero_residencia'] = $numero_residencia;
		  $arr['lista_moradores'][$i]['situacao_residencia'] = $situacao;
		  $arr['lista_moradores'][$i]['qrcode_residencia'] = $qrcode_residencia;
		  $arr['lista_moradores'][$i]['imagem'] = $imagem;
		  $arr['lista_moradores'][$i]['telefone_morador'] = $telefone_morador;
		  $arr['lista_moradores'][$i]['full_name'] = $tipo_residencia." - ".$numero_residencia;
		  $arr['lista_moradores'][$i]['email'] = $email;
		  $arr['lista_moradores'][$i]['lista_moradores'] = get_moradores($IdResidencia,$IdCondominio);

		$i++; 
}

$arr['status'] = 'SUCCESS';
	 	 echo json_encode($arr);


 function get_moradores($IdResidencia,$IdCondominio){
	$db = new db(); 
	
	$db->query('SELECT * 
	FROM tb_morador tm
	WHERE IdResidencia = '.$IdResidencia.' LIMIT 1');
 
 	$db->execute();
	$result2 = $db->resultset(); 
	$response2 = array();
	if($result2){ 
		$i = 0; 
		$imagem = "";
		foreach($result2 as $row) { 
			
			$IdResidencia = $row['IdResidencia'];
			$imagem = $row['imagem'];
			$nome_morador = $row['nome'];
			$tipo_morador = $row['tipo'];
			$IdMorador = $row['IdMorador'];

			if ($imagem != ""){
				$imagem = "images/morador/".$IdCondominio."/".$IdResidencia."/".$imagem ;
				
			}else{
				
				$imagem = "images/nouser.png" ;
			}

			if($nome_morador != " "){
				$arr[$i]['nome_morador'] =  $row['nome'];
			} else {
				$arr[$i]['nome_morador'] = "";
			}

			if($tipo_morador != " "){
				$arr[$i]['tipo_morador'] =  $row['tipo'];
			} else {
				$arr[$i]['tipo_morador'] = "";
			}

			if($IdMorador != " "){
				$arr[$i]['IdMorador'] =  $row['IdMorador'];
			} else {
				$arr[$i]['IdMorador'] = "";
			}
			$arr[$i]['imagem_morador'] =  $imagem;



			$i++; 
	}
	return $arr;
	}
	
	
}
 
 
 ?>