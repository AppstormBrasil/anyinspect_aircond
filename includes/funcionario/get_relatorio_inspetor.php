<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$days = $_GET["days"];

function get_doc($id){
	$db = new db();
	$db->query('SELECT descricao , valor from tb_team_doc ttd WHERE ttd.id_func = '.$id.' '); 
	$db->execute();
	$result = $db->resultset(); 
	if($result){
		$i = 1; 
		$cel = '';
		$gmp = '';
		$cpf = '';
		$avi = '';
		foreach($result as $row) {
			$descricao = $row['descricao'];
			$valor = $row['valor'];
			if($descricao == 'CEL'){
				$cel = 'x';
			} else if($descricao == 'GMP'){
				$gmp = 'x';
			} else if($descricao == 'CPF'){
				$cpf = $valor;
			} else if($descricao == 'AVI'){
				$avi = 'x';
			}

		}
		$response = array(
			"cel"=>$cel,
			"gmp"=>$gmp,
			"cpf"=>$cpf,
			"avi"=>$avi,
		);

		return $response;
	}	
 }

function get_qual($id){
	$db = new db();
	$db->query('SELECT ttq.desc_qual from tb_team_qual ttq WHERE ttq.id_func = '.$id.' '); 
	$db->execute();
	$result = $db->resultset(); 
	if($result){
		$i = 1; 
		$iio = '';
		$ars = '';

		foreach($result as $row) {
			$desc_qual = $row['desc_qual'];
			if($desc_qual == 'IIO'){
				$iio = 'x';
			} else if($desc_qual == 'ARS'){
				$ars = 'x';
			} 
		}
		$response = array(
			"iio"=>$iio,
			"ars"=>$ars
		);
		return $response;
	}	
 }

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
		$extra_where = 'AND tl.base IN('.$inside_value.') ';
	  }
  
  } else {
   $has_func = "";  
   $extra_where = " ";
}

$db = new db(); 

$db->query("SELECT tt.* 
FROM tb_team tt WHERE tt.name <> 'Administrador' ORDER BY tt.name "); 

$result = $db->resultset(); 
if($result){
	 $i = 1; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$sign = $row["sign"];
		$base = $row["base"];
		$cargo = $row["cargo"];
		
		
		$habilitacao = get_doc($id);
		$cel = $habilitacao['cel'];
		$gmp = $habilitacao['gmp'];
		$cpf = $habilitacao['cpf'];
		$avi = $habilitacao['avi'];
		
		$treinamento = get_qual($id);
		$iio = $treinamento['iio'];
		$ars = $treinamento['ars'];

		if($sign == 'null' || $sign == null){
			$sign = '-';
		} else {
			$sign = $sign;
			
		}

		if($name != 'Todos'){
			$response['funcionarios'][] = array(
				"id"=>$id,
				"name"=>$name,
				"sign"=>$sign,
				"base"=>$base,
				"iio"=>$iio,
				"ars"=>$ars,
				"cargo"=>$cargo,
				"avi"=>$avi,
				"cel"=>$cel,
				"gmp"=>$gmp,
				"cpf"=>$cpf,		
			);
	
			$i++;
		}
		
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


	 
	 function get_trei(){
		$db->query('SELECT tt.name , tt.sign from tb_team tt WHERE tt.type2 = 1'); 
		$db->execute();
		$result = $db->single(); 
		$response['responsavel'] = array(
			"name"=>$result['name'],
			"sign"=>$result['sign'],
		   
		);
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