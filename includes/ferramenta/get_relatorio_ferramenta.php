<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$days = $_GET["days"];

$extra_where = "";
$extra_where_tipo = "";
if(isset($_GET["base"])){
	  $lista_base = $_GET["base"];
	  $inside_value = "";
	  if($lista_base[0] == 'ALL'){
		$extra_where = '';
	  } else {
		foreach($lista_base as $row) {
			$inside_value .= "'$row'," ;
			//echo $inside_value;
		}

		$inside_value = substr($inside_value,0,-1);

		$extra_where = 'AND tl.base IN('.$inside_value.') ';
	  }
  
  } else {
   $has_func = "";  
   $extra_where = " ";
}

if(isset($_GET["tipo"])){
	  $lista_tipo = $_GET["tipo"];
	  $inside_value_tipo = "";
	  if($lista_tipo[0] == 'ALL'){
		$extra_where_tipo = '';
	  } else {
		foreach($lista_tipo as $row) {
			$inside_value_tipo .= "'$row'," ;
			//echo $inside_value;
		}

		$inside_value_tipo = substr($inside_value_tipo,0,-1);

		$extra_where_tipo = 'tl.tipo IN('.$inside_value_tipo.') ';
	  }
  
  } else {
   $has_func = "";  
   $extra_where_tipo = " ";
}

$db = new db(); 

$db->query("SELECT tl.id , tl.foto, tl.descricao , tl.register , tl.tipo , tl.patrimonio , tl.pn , tl.base , tlo.descricao as descricao_local ,  DATEDIFF(tl.validade , NOW() ) as dias_expira , DATE_FORMAT( tl.calibracao ,'%d/%m/%Y') as calibracao , DATE_FORMAT( tl.validade ,'%d/%m/%Y') as validade 
FROM tb_tooling tl
LEFT JOIN tb_local tlo ON tl.local = tlo.id
WHERE $extra_where_tipo $extra_where  ORDER BY DATEDIFF(tl.validade , NOW()) "); 

$result = $db->resultset(); 
if($result){
	 $i = 1; 
	 foreach($result as $row) {
		$id = $row["id"];
		$descricao = $row["descricao"];
		$register = $row["register"];
		$tipo = $row["tipo"];
		$patrimonio = $row["patrimonio"];
		$pn = $row["pn"];
		$base = $row["base"];
		$descricao_local = $row["descricao_local"];
		$dias_expira = $row["dias_expira"];
		$calibracao = $row["calibracao"];
		$validade = $row["validade"];
		$foto = $row["foto"];
		

		if ($foto != ""){
			$foto = "images/upload/ferramenta/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

		if($dias_expira < $days){
			$response['ferramentas'][] = array(
				"id"=>$id,
				"descricao"=>$descricao,
				"register"=>$register,
				"tipo"=>$tipo,
				"patrimonio"=>$patrimonio,
				"pn"=>$pn,
				"base"=>$base,
				"descricao_local"=>$descricao_local,
				"dias_expira"=>$dias_expira,
				"calibracao"=>$calibracao,
				"validade"=>$validade,
				"i"=>$i,
				
			);
		}

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

		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response[] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>