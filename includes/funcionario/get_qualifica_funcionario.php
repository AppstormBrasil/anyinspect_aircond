<?php 

include('../common/util.php'); 


if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} 
else {$id_funcionario = '';}
$db = new db(); 
$db->query("SELECT ttq.* , DATE_FORMAT( ttq.validade_qual ,'%d/%m/%Y') as validade_qual , DATE_FORMAT( ttq.dataini_qual ,'%d/%m/%Y') as dataini_qual , DATE_FORMAT( ttq.datafim_qual ,'%d/%m/%Y') as datafim_qual
FROM tb_team_qual ttq WHERE ttq.id_func =:id_funcionario ORDER BY ttq.validade_qual DESC");
$db->bind(':id_funcionario', $id_funcionario);

$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$validade_qual = $row['validade_qual'];
		$dataini_qual = $row['dataini_qual'];
		$datafim_qual = $row['datafim_qual'];

		if($validade_qual == '00/00/0000'){
			$validade_qual = 'N/A';
			$validade_qual = 'N/A';
		} else {
			$validade_qual = $validade_qual;
		}

		if($dataini_qual == '00/00/0000'){
			$dataini_qual = 'N/A';
			$dataini_qual = 'N/A';
		} else {
			$dataini_qual = $dataini_qual;
		}

		if($datafim_qual == '00/00/0000'){
			$datafim_qual = 'N/A';
		} else {
			$datafim_qual = $datafim_qual;
		}


		$response[] = array(
			"id"=>$row['id'],
			"id_func"=>$row['id_func'],
			"desc_qual"=>$row['desc_qual'],
			"tipo_qual"=>$row['tipo_qual'],
			"validade_qual"=>$validade_qual,
			"numero_qual"=>$row['numero_qual'],
			"data_cadastro"=>$row['data_cadastro'],
			"horaria_qual"=>$row['horaria_qual'],
			"local_qual"=>$row['local_qual'],
			"dataini_qual"=>$dataini_qual,
			"datafim_qual"=>$datafim_qual
		);
	 } 

	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
	 	 
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 



?>