<?php 
 
	include('../common/util.php'); 
	$data_atualizacao = date('Y-m-d  H:i:s'); 
	$_POST = json_decode(file_get_contents('php://input'), true);
	$db = new db(); 
	
	$started_at = "";
	$ended_at = "";

	if(isset($_POST['eventID'])){ $eventID = $_POST['eventID'];} else {$eventID = '';}
	if(isset($_POST['days_revisao'])){ $days_revisao = $_POST['days_revisao'];} else {$days_revisao = '';}
	if(isset($_POST['id_funcionario'])){ $id_funcionario = $_POST['id_funcionario'];} else {$id_funcionario = '';}
	if(isset($_POST['id_bolt'])){ $id_bolt = $_POST['id_bolt'];} else {$id_bolt = '';}
	if(isset($_POST['id_client'])){ $id_client = $_POST['id_client'];} else {$id_client = '';}

	if($id_funcionario != ''){
		$IdFunc = $id_funcionario;
	} else {
		$IdFunc = 0;
    }


    $db->query('SELECT ts.short_dec , ts.id , ts.est_time , ts.price from tb_services ts where ts.short_dec = :short_dec');
    $db->bind(':short_dec', 'Revisão'); 
    $db->execute();

    $result = $db->resultset();
    $has_revisao = 0;
    foreach($result as $row) {
        $id_service = $row["id"];
        $est_time_revisao = $row["est_time"];
        $price = $row["price"];
        $has_revisao = 1;								
    }
		
		

		$start_date_revisao_ =  date('Y-m-d', strtotime(' + '.$days_revisao.' days'));
		$start_date_revisao =  date('Y-m-d 07:00:00', strtotime(' + '.$days_revisao.' days'));
		$time = [  '07:00:00', ".$est_time_revisao."	]; 
		$sum = strtotime('00:00:00'); 
		$totaltime = 0; 
		foreach( $time as $element ) { 
			$timeinsec = strtotime($element) - $sum; 
			$totaltime = $totaltime + $timeinsec; 
		} 
		$h = intval($totaltime / 3600); 
		  
		$totaltime = $totaltime - ($h * 3600); 
		$m = intval($totaltime / 60); 
		$s = $totaltime - ($m * 60); 
		
		if($h < 9){
			$h = '0'.$h;
		}
		if($m < 9){
			$m = '0'.$m;
		}
		if($s < 9){
			$s = '0'.$s;
		}
		

		$end_date_revisao =  $start_date_revisao_.' '."$h:$m:$s";


        $db->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:id_client, :start_date, :end_date, :status, :data_cadastro,:status_pagamento)");
        $db->bind(':id_client', $id_client);
        $db->bind(':start_date', $start_date_revisao);
        $db->bind(':end_date', $end_date_revisao);
        $db->bind(':status', 'Pendente');
        $db->bind(':data_cadastro', $data_atualizacao);
        $db->bind(':status_pagamento', 'Não');

        if($db->execute()){
            $id_booking = $db->lastInsertId(); 
            $db->query("INSERT INTO tb_book_detail (id_booking, id_pet, service_name, price ,id_funcionario,priority) VALUES (:id_booking, :id_pet, :service_name, :price,:id_funcionario,:priority)");
            $db->bind(':id_booking', $id_booking);
            $db->bind(':id_pet', $id_bolt);
            $db->bind(':service_name', $id_service);
            $db->bind(':price', $price);
            $db->bind(':id_funcionario', '3'); 
            $db->bind(':priority', 'Normal'); 
            
            if($db->execute()){
                $db->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
                $db->bind(':id_booking', $id_booking);
                $db->bind(':id_fun', '3');
                
                if($db->execute()){
                    $arr['status'] = 'SUCCESS';
                    $arr['last_id'] = $id_booking;
                    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
                    echo json_encode($arr);
                    exit(0);
                }

            }
        }
        
      

		exit;
		
    
    ?>