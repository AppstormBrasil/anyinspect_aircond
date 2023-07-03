<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$days = $_GET["days"];

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

$db->query("SELECT tp.id , tp.foto, tp.desc , tp.pn , tp.lote,  tp.local , tp.type , tp.qtd , tp.validade , tp.base ,  DATEDIFF(tp.validade , NOW() ) as dias_expira , DATE_FORMAT( tp.validade ,'%d/%m/%Y') as validade 
FROM tb_product tp $extra_where
ORDER BY DATEDIFF(tp.validade , NOW()) "); 

$result = $db->resultset(); 
if($result){
	 $i = 1; 
	 foreach($result as $row) {
		$id = $row["id"];
		$desc = $row["desc"];
		$type = $row["type"];
		$qtd = $row["qtd"];
		$validade = $row["validade"];
		$base = $row["base"];
		$dias_expira = $row["dias_expira"];
		$foto = $row["foto"];
		$local = $row["local"];
		$pn = $row["pn"];
		$lote = $row["lote"];
		

		if ($foto != ""){
			$foto = "images/upload/ferramenta/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

		if($dias_expira < $days){
			$response['consumiveis'][] = array(
				"id"=>$id,
				"desc"=>$desc,
				"pn"=>$pn,
				"lote"=>$lote,
				"local"=>$local,
				"type"=>$type,
				"qtd"=>$qtd,
				"base"=>$base,
				"dias_expira"=>$dias_expira,
				"validade"=>$validade,
				"foto"=>$foto,
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