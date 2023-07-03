<?php 
 
	include('../common/util.php'); 
	$data_atualizacao = date('Y-m-d  H:i:s'); 
	$data_atualizacao_br = date('d/m/Y  H:i:s'); 
	
	$db = new db(); 
	
	$started_at = "";
	$ended_at = "";

	if(isset($_POST['eventID'])){ $eventID = $_POST['eventID'];} else {$eventID = '';}
	if(isset($_POST['acao'])){ $acao = $_POST['acao'];} else {$acao = '';}

	//$id_funcionario = $_POST['id_funcionario'];
	/*$c_user = get_current_id();

	if($id_funcionario != ''){
		$IdFunc = $id_funcionario;
	} else {
		$IdFunc = get_current_id();
	} */
	
	$IdFunc = get_current_id();
	
	$db->query('SELECT pb.id_client, pc.phone, pc.name , pc.foto from tb_booking pb INNER JOIN tb_client pc ON pb.id_client = pc.id where pb.id = :eventID');
	$db->bind(':eventID', $eventID); 
	$db->execute();

	$result = $db->resultset();
	 foreach($result as $row) {
		$zap = $row["phone"];
		$foto = $row["foto"];
		$fullname = $row["name"];
		
		if ($foto != ""){
			$foto = "images/pet/upload/clientes/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}
	 }
	 
	if($acao == "comecar"){
		$acao = "Em Andamento";
		$started_at = $data_atualizacao;
		
		$db->query('UPDATE tb_booking SET status = :acao WHERE id = :eventID');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':acao', $acao);
		
		if($db->execute()){
			$db->query('UPDATE tb_book_detail SET started_at = :started_at, id_quem_executou = :id_quem_executou WHERE id_booking = :eventID ');
 
			$db->bind(':eventID', $eventID);
			$db->bind(':started_at', $started_at);
			$db->bind(':id_quem_executou', $IdFunc); 
			
			if($db->execute()){
				$arr['status'] = 'SUCCESS';
				$arr['status_txt'] = 'Atualizado com Sucesso'; 
				$arr['data_criacao'] = $data_atualizacao_br; 
				echo json_encode($arr);
				exit(0);
			}
		}
	}
	else if($acao == "finalizar"){
		$acao = "Finalizado";
		$ended_at = $data_atualizacao;
		
		/*$db->query('SELECT price , service_name from tb_book_detail where id_booking = :eventID');
		$db->bind(':eventID', $eventID); 
		$db->execute();

		$result = $db->resultset();
		foreach($result as $row) {
			$price = $row["price"];
			$id_servico = $row["service_name"];
		}

		substract_estoque($id_servico);



		$db->query("SELECT * FROM tb_team_service tts 
			WHERE tts.id_team =:id_funcionario AND tts.id_service =:id_servico ");

		$db->bind(':id_funcionario', $id_funcionario);
		$db->bind(':id_servico', $id_servico);

		$db->execute();
		$result_tts = $db->resultset(); 

		if($result_tts){
			foreach ($result_tts as $rowts) {
				$comission = $rowts["comission"];

				$comission = ($comission / 100) ;
				$comission_final = ($price * $comission) ;


				$db->query('INSERT into tb_comission (id_func, id_booking, comission,save_date) VALUES (:IdFunc, :eventID, :comission, :save_date)');
				$db->bind(':eventID', $eventID); 
				$db->bind(':IdFunc', $id_funcionario);
				$db->bind(':comission', $comission_final);
				$db->bind(':save_date', $data_atualizacao);
				$db->execute();

			}
		}else{

			$db->query('SELECT * from tb_book_func where id_booking = :id_booking');
			$db->bind(':id_booking', $eventID); 
			$db->execute();
			$result_fun = $db->resultset();
			$num_fun = count($result_fun);
			foreach($result_fun as $row) {
				$id_fun_c = $row["id_fun"];

				$db->query('SELECT comission from tb_team where id = :IdFunc');
				$db->bind(':IdFunc', $id_fun_c); 
				$db->execute();
				$result = $db->resultset();
				foreach($result as $row) {
					$comissao = $row["comission"];
				}
				
				$comissao = ($comissao / 100) ;
				$comission_final = ($price  * $comissao) ;
				
				$db->query('INSERT into tb_comission (id_func, id_booking, comission,save_date) VALUES (:IdFunc, :eventID, :comission, :save_date)');
				$db->bind(':eventID', $eventID); 
				$db->bind(':IdFunc', $id_fun_c);
				$db->bind(':comission', $comission_final);
				$db->bind(':save_date', $data_atualizacao);
				$db->execute();
			}
		} */

		/*Fim comissao*/

		
		$db->query('UPDATE tb_booking SET status = :acao WHERE id = :eventID ');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':acao', $acao);
		
		if($db->execute()){
		}
		
		$db->query('UPDATE tb_book_detail SET ended_at = :ended_at WHERE id_booking = :eventID ');
 
		$db->bind(':eventID', $eventID); 
		$db->bind(':ended_at', $ended_at);
		
		if($db->execute()){
			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Atualizado com Sucesso'; 
			$arr['zap'] = $zap;
			$arr['fullname'] = $fullname;
			$arr['foto'] = $foto;
			echo json_encode($arr);
			exit(0);
		}
	} 
	else if($acao == "concluido"){
		$acao = "Concluído";
		$ended_at = $data_atualizacao;
		
		$db->query('SELECT price , service_name from tb_book_detail where id_booking = :eventID');
		$db->bind(':eventID', $eventID); 
		$db->execute();

		$result = $db->resultset();
		foreach($result as $row) {
			$price = $row["price"];
			$id_servico = $row["service_name"];
		}

		substract_estoque($id_servico);

		/*Verifica comissao*/

		$db->query("SELECT * FROM tb_team_service tts 
			WHERE tts.id_team =:id_funcionario AND tts.id_service =:id_servico ");

		$db->bind(':id_funcionario', $id_funcionario);
		$db->bind(':id_servico', $id_servico);

		$db->execute();
		$result_tts = $db->resultset(); 

		if($result_tts){
			foreach ($result_tts as $rowts) {
				$comission = $rowts["comission"];

				$comission = ($comission / 100) ;
				$comission_final = ($price * $comission) ;


				$db->query('INSERT into tb_comission (id_func, id_booking, comission,save_date) VALUES (:IdFunc, :eventID, :comission, :save_date)');
				$db->bind(':eventID', $eventID); 
				$db->bind(':IdFunc', $id_funcionario);
				$db->bind(':comission', $comission_final);
				$db->bind(':save_date', $data_atualizacao);
				$db->execute();

			}
		}else{

			$db->query('SELECT * from tb_book_func where id_booking = :id_booking');
			$db->bind(':id_booking', $eventID); 
			$db->execute();
			$result_fun = $db->resultset();
			$num_fun = count($result_fun);
			foreach($result_fun as $row) {
				$id_fun_c = $row["id_fun"];

				$db->query('SELECT comission from tb_team where id = :IdFunc');
				$db->bind(':IdFunc', $id_fun_c); 
				$db->execute();
				$result = $db->resultset();
				foreach($result as $row) {
					$comissao = $row["comission"];
				}
				
				$comissao = ($comissao / 100) ;
				$comission_final = ($price  * $comissao) ;
				
				$db->query('INSERT into tb_comission (id_func, id_booking, comission,save_date) VALUES (:IdFunc, :eventID, :comission, :save_date)');
				$db->bind(':eventID', $eventID); 
				$db->bind(':IdFunc', $id_fun_c);
				$db->bind(':comission', $comission_final);
				$db->bind(':save_date', $data_atualizacao);
				$db->execute();
			}
		}

		$db->query('UPDATE tb_booking SET status = :acao WHERE id = :eventID ');
		$db->bind(':eventID', $eventID); 
		$db->bind(':acao', $acao);
		$db->execute();
		
		$db->query('UPDATE tb_book_detail SET ended_at = :ended_at WHERE id_booking = :eventID ');
 		$db->bind(':eventID', $eventID); 
		$db->bind(':ended_at', $ended_at);
		
		if($db->execute()){

			$db->query("INSERT INTO tb_hist_approve (id_booking, id_user, data , status) VALUES (:id_booking, :id_user , :data , :status)");
			$db->bind(':id_booking', $eventID);
			$db->bind(':id_user', $id_funcionario);
			$db->bind(':data', $data_atualizacao);
			$db->bind(':status', 'Aprovado');
			$db->execute();

			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Atualizado com Sucesso'; 
			$arr['zap'] = $zap;
			$arr['fullname'] = $fullname;
			$arr['foto'] = $foto;
			echo json_encode($arr);
			exit(0);
		}
	} else{
		$arr['status'] = 'ERROR';
		$arr['status_txt'] = 'Erro!'; 
		echo json_encode($arr);
		exit(0);
	}

 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso';
	 $arr['fullname'] = $fullname;	
	 $arr['foto'] = $foto;		 
	 echo json_encode($arr);
	 exit(0);
} else { 
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Erro ao Atualizar'; 
		echo json_encode($arr);
}

function substract_estoque($id_servico){
	$db = new db(); 
	$db->query('SELECT * from tb_service_prod tsp where tsp.id_service = :id_service');
	$db->bind(':id_service', $id_servico); 
	$db->execute();

	$result = $db->resultset();
	 foreach($result as $row) {
		$id_product = $row["id_product"];
		$qtd_retirar = $row["qtd"];
	
		$db->query('SELECT tp.qtd as qtd_atual , tp.id as id_prod_change from tb_product tp where tp.id = :id');
		$db->bind(':id', $id_product); 
		$result_prod = $db->single(); 

		if($result_prod){
			$qtd_atual =  $result_prod['qtd_atual'];
			$id_prod_change =  $result_prod['id_prod_change'];
			$qtd_final = $qtd_atual - $qtd_retirar;
			$db->query('UPDATE tb_product SET qtd = :qtd WHERE id = :id ');
			$db->bind(':qtd', $qtd_final);
			$db->bind(':id', $id_prod_change); 
			$db->execute();
			
		}
		
	 }
}

 ?>