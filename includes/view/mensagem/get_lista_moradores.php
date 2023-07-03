<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$IdCondominio =  get_id_empresa(); 
$db = new db(); 
 
 if(isset($_GET['id'])){ 
	 $id = $_GET['id'];
 } else { 
	if($IdCondominio > 0){
		$id = $IdCondominio;
	} else {
		$id  = '';
	} 
	
	
}

if(!isset($_GET['searchTerm'])){ 
	$db->query('SELECT tm.*, tmr.IdCondominio , tmr.IdResidencia , tmr.tipo_residencia,tmr.nome_residencia,tmr.numero as numero_residencia ,tmr.situacao,
	tmr.qrcode_residencia , tmr.imagem 
	FROM tb_morador tm
	LEFT OUTER JOIN tb_morador_residencia tmr ON tmr.IdResidencia = tm.IdResidencia
	WHERE tm.IdCondominio = '.$id.' 
	GROUP BY tmr.IdResidencia LIMIT 50');
  
}else{ 

	$search = $_GET['searchTerm'];
	$sql = "SELECT tm.*, tmr.IdCondominio , tmr.IdResidencia , tmr.tipo_residencia,tmr.nome_residencia,tmr.numero as numero_residencia ,tmr.situacao,
	tmr.qrcode_residencia , tmr.imagem 
	FROM tb_morador tm
	LEFT OUTER JOIN tb_morador_residencia tmr ON tmr.IdResidencia = tm.IdResidencia
	WHERE tm.IdCondominio = ".$id." AND (tm.nome like '%".$search."%' ) GROUP BY tm.IdResidencia  LIMIT 150 ";
	$db->query($sql);
} 

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
			$nome_residencia = $row['nome_residencia'];
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
			 
		  $arr['residencia'][$i]['nome'] = $nome;
		  $arr['residencia'][$i]['IdResidencia'] = $IdResidencia;
		  $arr['residencia'][$i]['tipo_residencia'] = $tipo_residencia;
		  $arr['residencia'][$i]['nome_residencia'] = $nome_residencia;
		  $arr['residencia'][$i]['numero_residencia'] = $numero_residencia;
		  $arr['residencia'][$i]['situacao_residencia'] = $situacao;
		  $arr['residencia'][$i]['qrcode_residencia'] = $qrcode_residencia;
			$arr['residencia'][$i]['imagem'] = $imagem;
			$arr['residencia'][$i]['telefone_morador'] = $telefone_morador;
		  $arr['residencia'][$i]['full_name'] = $tipo_residencia." - ".$numero_residencia;
		  $arr['residencia'][$i]['email'] = $email;
		  $arr['residencia'][$i]['lista_moradores'] = get_moradores($IdResidencia,$IdCondominio);

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