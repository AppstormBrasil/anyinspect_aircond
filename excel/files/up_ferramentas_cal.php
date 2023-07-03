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
$excel->read('ferramentas_calibracao.xls');
$sheet = $excel->sheets[0];
$db = new db(); 



function check_local($local){
	
	$db = new db(); 
	$db->query("SELECT tl.id
	FROM tb_local tl
	WHERE tl.descricao = '".$local."' ");
	
	$db->execute();
	$result = $db->resultset();
	if($result){
		$id_cliente = $result[0]['id'];
	} else {
		$id_cliente = "0";
	} 
	return $id_cliente; 
}

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



function insert_database($descricao,$patrimonio,$tipo,$local,$validade,$calibracao){
		$db = new db();

	
		
		$descricao = utf8_encode($descricao);
		$local = utf8_encode($local);
		$local = check_local($local);


		$db->query('INSERT INTO tb_tooling (descricao, patrimonio, tipo,local,validade,calibracao) VALUES (:descricao, :patrimonio, :tipo,:local,:validade,:calibracao) ');
		$db->bind(':descricao', $descricao);
		$db->bind(':patrimonio', $patrimonio); 
		$db->bind(':tipo', $tipo); 
		$db->bind(':local', $local); 
		$db->bind(':validade', $validade); 
		$db->bind(':calibracao', $calibracao); 
		$db->execute();  
	
	 
}

$x = 2;
$total = "";
while($x <= $sheet['numRows']) {

	if(isset($sheet['cells'][$x][1])) {

		$descricao = isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : "";
		$local = isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : "";
		$patrimonio = isset($sheet['cells'][$x][3]) ? $sheet['cells'][$x][3] : "";
		$tipo = isset($sheet['cells'][$x][4]) ? $sheet['cells'][$x][4] : "";
		$validade = isset($sheet['cells'][$x][5]) ? $sheet['cells'][$x][5] : "";
		$calibracao = isset($sheet['cells'][$x][6]) ? $sheet['cells'][$x][6] : "";

		if($validade != ''){
			$validade = br_to_usa($validade);
		} else {
			$validade = '';
		}
		
		if($calibracao != ''){
			$calibracao = br_to_usa($calibracao);
		} else {
			$calibracao = '';
		}
		
		
		
		insert_database($descricao,$patrimonio,$tipo,$local,$validade,$calibracao);

	}
	$x++;
}


$arr['status'] = 'SUCCESS';
$arr['status_txt'] = 'Atualizacao Atividades realizada com Sucesso!' ;
echo json_encode($arr);


exit(0);

?>
