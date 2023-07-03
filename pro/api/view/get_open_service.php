<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$_GET = json_decode(file_get_contents('php://input'), true);
if(isset($_GET['IdUser'])){ $id = $_GET['IdUser'];} else { $id  = '';}
if(isset($_GET['type'])){ $type = $_GET['type'];} else { $type  = '';}
$id_cliente = $id;

$db = new db(); 

if($type == 'a' || $type == 'g' ){ 
	$db->query("SELECT pbf.id_fun , pb.id as id_service, pb.start_date , 
	pb.status , pc.name as client_name , pc.phone , pc.id as client_id , pc.foto as client_pic  , pc.foto , pbd.price , ps.short_dec , pt.name as nome_funcionario , pt.id as id_funcionario , pcb.id as id_bolt , pcb.name_bolt as name_bolt , pcb.foto as foto_bolt , pbd.price_taxi , pbd.pet_taxi , tcba.description as category_bolt , pbd.priority
	FROM tb_booking pb 
	LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id
	LEFT JOIN tb_book_func pbf ON pbf.id_booking = pb.id
	LEFT JOIN tb_services ps ON ps.id = pbd.service_name
	LEFT JOIN tb_client pc ON pb.id_client = pc.id
	LEFT JOIN tb_team pt ON pt.id = pbf.id_fun
	LEFT JOIN tb_clients_bolt pcb ON pb.id_client = pcb.id_client    
	LEFT JOIN tb_cat_barco tcba ON pcb.category_bolt = tcba.id 
	WHERE DATE(pb.start_date) = CURDATE() GROUP BY pbd.id_booking"); 


} else {

	$db->query("SELECT pbf.id_fun , pb.id as id_service, pb.start_date , 
	pb.status , pc.name as client_name , pc.phone , pc.id as client_id , pc.foto as client_pic  , pc.foto , pbd.price , ps.short_dec , pt.name as nome_funcionario , pt.id as id_funcionario , pcb.id as id_bolt , pcb.name_bolt as name_bolt , pcb.foto as foto_bolt , pbd.price_taxi , pbd.pet_taxi , tcba.description as category_bolt , pbd.priority
	FROM tb_booking pb 
	LEFT JOIN tb_book_detail pbd ON pbd.id_booking = pb.id
	LEFT JOIN tb_book_func pbf ON pbf.id_booking = pb.id
	LEFT JOIN tb_services ps ON ps.id = pbd.service_name
	LEFT JOIN tb_client pc ON pb.id_client = pc.id
	LEFT JOIN tb_team pt ON pt.id = pbf.id_fun
	LEFT JOIN tb_clients_bolt pcb ON pb.id_client = pcb.id_client    
	LEFT JOIN tb_cat_barco tcba ON pcb.category_bolt = tcba.id 
	WHERE (pbf.id_fun = :id OR pt.name = 'Todos' )  AND DATE(pb.start_date) = CURDATE() GROUP BY pbd.id_booking "); 


	$db->bind(':id', $id);
	$db->execute();


}


$db->execute();
$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$start_date = usa_to_br_date_time($row['start_date']);
		$status = $row["status"];
		$id_service = $row["id_service"];
		$client_name = $row["client_name"];
		$client_id = $row["client_id"];
		$client_pic = $row["client_pic"];
		$price = $row["price"];
		$foto = $row["foto"];
		$name_bolt = $row['name_bolt'];
		$id_bolt = $row['id_bolt'];
		$foto_bolt = $row['foto_bolt'];
		$short_dec = $row['short_dec'];
		$price_taxi = $row['price_taxi'];
		$pet_taxi = $row['pet_taxi'];
		$nome_cliente = $row['client_name'];
		$category_bolt = $row['category_bolt'];
		$priority = $row['priority'];

		if($pet_taxi == '0'){
			$pet_taxi_dum = '';
		} else {
			$pet_taxi_dum = 'Sim';
		}

		if ($foto_bolt != ""){
			$foto_bolt = prod_path."images/upload/barcos/".$foto_bolt ;
		}else{
			$foto_bolt =prod_path. "images/nouser.png" ;
		}


		
		if ($foto != ""){
			$foto = prod_path."images/upload/clientes/".$foto ;
		}else{
			$foto = prod_path."app/images/profile.jpg" ;
		}
		
		
		if($status == 'Pendente'){
			$status_type = 'status_pendente';
		} else if($status == 'Em Andamento') {
			$status_type = 'status_andamento';
		}  else if($status == 'Cancelado') {
			$status_type = 'status_cancelado';
		} else if($status == 'Deletado') {
			$status_type = 'status_deletado';
		} else if($status == 'Aprovado') {
			$status_type = 'status_aprovado';
		} else if($status == 'Reprovado') {
			$status_type = 'status_reprovado';
		}else {
			$status_type = 'status_finalizado';
		}

		$the_status = '<span class="fr small message_type '.$status_type.'">'.$status.'</a></span>';

		$response['data'][] = array(
			"start_date"=>$start_date,
			"status"=>$status,
			"id_service"=>$id_service,
			"client_name"=>$client_name,
			"client_id"=>$client_id,
			"client_pic"=>$client_pic,
			"price"=>$price,
			"short_dec"=>$short_dec,
			"name_bolt"=>$name_bolt,
			"foto"=>$foto,
			"id_bolt"=>$id_bolt,
			"foto_bolt"=>$foto_bolt,
			"category_bolt"=>$category_bolt,
			"pet_taxi"=>$pet_taxi_dum,
			"price_taxi"=>$price_taxi,
			"btn_status"=>$the_status,
			"priority"=>$priority,
			
		);
		$i++;
	} 
	 	$response['status'] = 'SUCCESS';
	 	$response['total'] = $i;
		echo json_encode($response);
	 	exit(0);
} else { 
		 $arr['status'] = 'ERROR'; 
		 $arr['data'] = []; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>