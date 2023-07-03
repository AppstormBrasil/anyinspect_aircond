<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$date = date("Y-m");
$date2 = date("m-Y");

$db = new db(); 

$db->query("SELECT SUM(pc.comission) as comission, pt.name , pt.foto , pt.id
FROM tb_comission pc 
LEFT JOIN tb_team pt ON pc.id_func = pt.id
LEFT JOIN tb_book_detail pbd ON pc.id_booking = pbd.id_booking
WHERE pbd.ended_at like '%$date%'
GROUP BY pc.id_func"); 

 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$funcionario = $row["name"];
		$comission = $row["comission"];
		$id = $row["id"];

		$foto = $row['foto'];
		if ($foto != ""){
		   $foto = 'images/upload/funcionarios/'.$foto;
		}else{
		   $foto = "assets/images/nouser.png" ;
		} 

		$response['data'][] = array(
			"funcionario"=>$funcionario,
			"id"=>$id,
			"comission"=>$comission,
			"foto"=>$foto,
			"date2"=>$date2
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = [];
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>