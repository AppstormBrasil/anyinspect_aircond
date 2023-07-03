<?php 
 
include('../common/util.php'); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
$db = new db(); 

$db->query("SELECT MONTH(pb.start_date) as mes ,  YEAR(pb.start_date) as ano ,  SUM(pbd.price) as valor 
FROM tb_booking pb
LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id 
LEFT JOIN tb_client pc ON pb.id_client = pc.id  
WHERE pc.id = :id
GROUP BY YEAR(pb.start_date), MONTH(pb.start_date)  "); 
$db->bind(':id', $id);
$db->execute();


$result = $db->resultset(); 

if($result){
	 $i = 0;
	 $response = array();
	 foreach($result as $row) {
		$response['data'][] = array(
			"id"=>$i,
			"mes"=>get_nome_mes_completo($row['mes']),
			"valor"=>$row['valor'],
			"mes_num"=>$row['mes'],
			"ano"=>$row['ano'],
			"status"=> 'Aberto',

			
		);

		$i++;
	 } 
		  
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
		 $arr['data'] = [];
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>