<?php
//set_time_limit(144000);

ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
set_time_limit(0);

date_default_timezone_set("Brazil/East"); 
include("../excel_reader.php");
include("connection.php");
//include('../../common/util.php'); 
$data_cadastro = date('Y-m-d  H:i:s'); 
$excel = new PhpExcelReader;
//$excel->read('upload_atividades_ago_.xls');
$excel->read('ativos.xls');
$sheet = $excel->sheets[0];
$db = new db(); 


function br_to_usa($date){

	if($date == ''){
		return "";
	} else {
		$date = explode("/",$date);
		if(sizeof($date) == 3){
			return substr($date[2],0,4).'-'.$date[1].'-'.$date[0].' '.substr($date[2],5,9);
		} else {
			return "";
		}
	}
}
  
function get_id_cliente($nota){
	
	$db = new db(); 
	$db->query("SELECT tc.idcliente
	FROM tb_cliente tc
	WHERE tc.clinota = '".$nota."' ");
	$db->execute();
	$result = $db->resultset();
	if($result){
		$id_cliente = $result[0]['idcliente'];
	} else {
		$id_cliente = "";
	} 
	return $id_cliente; 
}



function check_categoria(){
	$db = new db(); 
	$db->query("SELECT ts.*
	FROM tb_subcategoria ts ");
	//WHERE ts.subdescricao = '$categoria' 
	$db->execute();
	$result_categoria = $db->resultset();
	return $result_categoria;
}



function insert_database($descricao){
		$db = new db();
		$db->query('INSERT INTO tb_local (id_client, descricao) VALUES (:id_client, :descricao ');
		$db->bind(':id_client', '5');
		$db->bind(':descricao', $descricao); 
		$db->execute();  
	
	 
}

// id, id_client, descricao, category, model, register, obs, data_create, foto, qrcode, local, lat, lon, validade, responsavel, fabricante, capacidade, tipo, type_pai, id_depende
$x = 3;
$total = "";
while($x <= $sheet['numRows']) {

	if(isset($sheet['cells'][$x][1])) {
		$id = isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : "";
		$descricao = isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : "";
		$model = isset($sheet['cells'][$x][3]) ? $sheet['cells'][$x][3] : "";
		$tag = isset($sheet['cells'][$x][4]) ? $sheet['cells'][$x][4] : "";
		$serie = isset($sheet['cells'][$x][5]) ? $sheet['cells'][$x][5] : "";
		$local = isset($sheet['cells'][$x][6]) ? $sheet['cells'][$x][6] : "";
		$acao = isset($sheet['cells'][$x][7]) ? $sheet['cells'][$x][7] : "";
		$fabricante = isset($sheet['cells'][$x][8]) ? $sheet['cells'][$x][8] : "";
		$capacidade = isset($sheet['cells'][$x][9]) ? $sheet['cells'][$x][9] : "";
		$tipo = isset($sheet['cells'][$x][10]) ? $sheet['cells'][$x][10] : "";
		$category = isset($sheet['cells'][$x][11]) ? $sheet['cells'][$x][11] : "";
		$id_client = isset($sheet['cells'][$x][12]) ? $sheet['cells'][$x][12] : "";
		
		$descricao = utf8_encode($descricao);

		
		$db->query('INSERT INTO tb_clients_ativo (descricao, model, register, fabricante, capacidade, tipo , category , id_client, qrcode) 
					VALUES (:descricao, :model, :register, :fabricante, :capacidade, :tipo, :category, :id_client, :qrcode)');
		$db->bind(':descricao', $descricao);
		$db->bind(':model', $model);
		$db->bind(':register', $serie);
		$db->bind(':fabricante', $fabricante);
		$db->bind(':capacidade', $capacidade);
		$db->bind(':tipo', $tipo);
		$db->bind(':category', $category);
		$db->bind(':id_client', $id_client);
		$db->bind(':qrcode', $descricao);
		$db->execute();  
	}
	$x++;
}




$ftime = time();



$arr['status'] = 'SUCCESS';
$arr['status_txt'] = 'Atualizacao Atividades realizada com Sucesso!' ;
echo json_encode($arr);


exit(0);

?>
