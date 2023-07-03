<?php 
 
include('../common/util.php'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_produto = $id;

$db = new db(); 

$db->query('SELECT * from tb_product where id = "'.$id_produto.'"'); 
$db->execute();

$result = $db->resultset(); 



$option = "";
$option .= "<option disabled>Selecione</option>";
$option .= "<option value='L'>L - Litro</option>";
$option .= "<option value='ML'>ML - Miligrama</option>";
$option .= "<option value='KG'>KG - Quilograma</option>";
$option .= "<option value='UN'>UN - Unidade</option>";
$option .= "<option value='PC'>PC - Peça</option>";
$option .= "<option value='G'>G - Grama</option>";

if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$desc = $row["desc"];
		$base = $row["base"];
		$value = $row["value"];
		$type = $row["type"];
		$option .= "<option selected value='$type'>$type</option>";
		$data_cadastro = $row["data_cadastro"];
		$foto = $row["foto"];
		$validade = $row["validade"];

		$foto = $row["foto"];
		if ($foto != ""){
			$foto = "images/upload/produtos/".$foto ;
		}else{
			$foto = "images/noimage.png" ;
		}

		$validade = usa_to_br($validade);
		$validade = trim($validade);
		
		$response['data'][] = array(
			"desc"=>$row['desc'],
			"qtd"=>$row['qtd'],
			"min_qtd"=>$row['min_qtd'],
			"value"=>$row['value'],
			"validade"=>$validade,
			"type"=>$option,
			"base"=>$base,
			"data_cadastro"=>$row['data_cadastro'],
			"foto"=>$foto
		);
	 } 
	 	$response['status'] = 'SUCCESS';
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	  $arr['status'] = 'ERROR'; 
		  $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $arr['data'][] = array();
	 	  echo json_encode($arr);
	 	 } 

 ?>