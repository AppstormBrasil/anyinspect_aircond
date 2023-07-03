<?php 

include('../common/util.php'); 


if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} 
else {$id_funcionario = '';}
$db = new db(); 
$db->query("SELECT ttd.* , DATE_FORMAT( ttd.data_expira ,'%d/%m/%Y') as data_expira ,  DATEDIFF(ttd.data_expira , NOW() ) as dias_expira 
FROM tb_team_doc ttd WHERE ttd.id_func =:id_funcionario ORDER BY DATEDIFF(ttd.data_expira , NOW() ) DESC, ttd.descricao");
$db->bind(':id_funcionario', $id_funcionario);
$db->execute();
$result = $db->resultset(); 

if($result){

	 $i = 0;
	 $response = array();
	 foreach($result as $row) {

		$data_expira = $row['data_expira'];
		$dias_expira = $row['dias_expira'];
		
		if($data_expira == '00/00/0000'){
			$data_expira = 'N/A';
			$dias_expira = 'N/A';
		} else {
			$data_expira = $data_expira;
			$dias_expira = $dias_expira;
		}

		$response[] = array(
			"id"=>$row['id'],
			"id_func"=>$row['id_func'],
			"descricao"=>$row['descricao'],
			"valor"=>$row['valor'],
			"data_expira"=>$data_expira,
			"data_cadastro"=>$row['data_cadastro'],
			"dias_expira"=>$dias_expira
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