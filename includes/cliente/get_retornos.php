<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

function get_users_this_month(){
	$db = new db();
	$current_month = date('m');
	$current_day = date('d');
	$current_year = date('Y');
	$prev_month = $current_month - 1;

	
	
	$db->query("SELECT pc.id 
				FROM tb_booking pb
				LEFT JOIN tb_client pc ON pb.id_client = pc.id
				WHERE ((MONTH(pb.start_date) >= ".$current_month." ) AND YEAR(pb.start_date) = ".$current_year.")  
				GROUP BY pc.id
				ORDER BY DAY(pb.start_date)"); 



	$db->execute();
	$result = $db->resultset(); 
	$remove_id = "";
	if($result){
		foreach($result as $row) {
			$id = $row["id"];
			$remove_id .= $id;
			$remove_id .= ',';
		}
	}
	
	$remove_id = substr($remove_id,0,-1);
	
	return $remove_id;
	
}

$get_users_this_month = get_users_this_month();


	$db = new db();
	$current_month = date('m');
	$current_day = date('d');
	$current_year = date('Y');
	$prev_month = $current_month - 1;
	
	$db->query("SELECT pb.start_date , pc.id , pc.foto ,  pc.name , phone , email , neighbor , city , ps.short_dec
				FROM tb_booking pb
				LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id
				LEFT JOIN tb_client pc ON pb.id_client = pc.id
				LEFT JOIN tb_services ps ON ps.id = pbd.service_name 
				WHERE pc.id NOT IN(".$get_users_this_month.")
				group by pb.id_client"); 
				
				

	$db->execute();
	$result = $db->resultset(); 
	$remove_id = "";
	$i = 0;
	if($result){
		foreach($result as $row) {
			//$id += $row["id"];
			$i++;
		}
	}


$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$name = $row["name"];
		$phone = $row["phone"];
		$email = $row["email"];
		$neighbor = $row["neighbor"];
		$city = $row["city"];
		$foto = $row["foto"];
		$last_visit = usa_to_br_date_time($row["start_date"]);
		$service = $row["short_dec"];
		
		if ($foto != ""){
			$foto = "images/pet/upload/clientes/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

		$response['data'][] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"last_visit"=>$last_visit,
			"foto"=>$foto,
			"phone"=>$row['phone'],
			"email"=>$row['email'],
			"service"=>$service,
			"neighbor"=>$row['neighbor'],
			"city"=>$row['city'],
			"botao"=>'<a style="margin-right: 5px;" class="btn btn-primary btn-xs" id="'.$row['id'].'" href="cliente-'.$id.'">
			<i class="icon-pencil f-s-16"></i></a><button class="btn btn-danger btn-xs" onclick="RemoveItem('.$row['id'].',\''.$row['name'].'\',\''.$foto.'\')" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>