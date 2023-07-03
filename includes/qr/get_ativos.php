<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

ul li {
	list-style: none;
    float: left;	
}

div {
  font-family: "Courier New", Times, serif;
}


</style>



<?php 
header('Content-Type: text/html; charset=utf-8');
include('../common/util.php'); 
require_once('qrlib.php');
$db = new db(); 


$db->query('SELECT tcb.* , tcat.* from 
tb_clients_bolt tcb
LEFT JOIN tb_cat_barco  tcat ON tcb.category_bolt = tcat.id
');

$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0;
	 $response = array();
	 $output = "";
	 $output .= '<table style="width:100%">';
	 
	 $output .=  '<tbody>';
	

	 foreach($result as $row) {

		$category = $row['description'];
		$model_bolt = $row['model_bolt'];
		$register_bolt = $row['register_bolt'];
		$name_bolt = $row['name_bolt'];
		$id = $row['id'];
		
		
		$qrCodeName = "imagem_qrcode_{$row['id']}.png";

		QRcode::png("MIR-".$row['id'], $qrCodeName, "L", 5, 5);

		$output .= '<tr>';
		$output .= '<th scope="row"><div style="float: left;border-right: 1px solid gray;">'. "<img  src='{$qrCodeName}'>".'</div>
					<div style="float:left;padding:10px;">
					<div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;" >Embarcação: '.$row['name_bolt'].'</div>
					<div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;" >Modelo: '.$row['name_bolt'].'</div>
					<div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;" >Nº de Série: '.$row['register_bolt'].'</div>
					<div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;margin-top: 30px;font-size: 20px;" >Tag Ativo: MIR-'.$row['id'].'</div>
					</div></th>';

	
		$output .= '</tr>';
			
		$i++;
		} 
		 
		$output .= '</tbody>';
		$output .= '</table>';
	 
		echo $output;


	 	 exit(0);
} else { 
 	 	 
		 $response['status'] = 'ERROR'; 
	 	 $response['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 //echo json_encode($response);
	 	 } 

 ?>