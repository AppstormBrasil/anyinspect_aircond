<?php
include('../common/util.php'); 

require_once('../email/PHPMailerAutoload.php');

//require __DIR__ . '/../vendor/autoload.php';
require_once('../vendor/autoload.php');
use Minishlink\WebPush\WebPush;
 
		
	$apiKeys = array(
		'VAPID' => array(
			'subject' => null,
			'publicKey' => 'BMPVQVgOVhIw7XzIAj-LMJztv-7IUBMTTuTBm3AWs135sOy_hRtJ7GutB-AAxOZPSEcNHsekE9iFhQjYrublIaw',
			'privateKey' => 'MVkKiVPVGA9eJ6H-XK-srC6cRE3-O2xbVEAwFhSii3I', // in the real world, this would be in a secret file
		),
	);

$currentDate = date('Y-m-d H:i:s');
$data_cadastrobr = date('d-m-Y  H:i:s'); 
$prod_path = 'https://app.anyinspect.com.br/';
$startTime = $_POST["startTime"].':00';
$endTime = $_POST["endTime"].':00';
$clientes = $_POST["clientes"];
$tipo_servico = $_POST["tipo_servico"];
$preco = $_POST["preco"];
$info_extra = $_POST["obs"];
$prioridade = $_POST["prioridade"];



$has_func = 0;


if(isset($_POST['id_funcionario'])){
	$id_funcionario = $_POST["id_funcionario"];
	$id_funcionario_ = $_POST["id_funcionario"];
	//$id_funcionario_ = implode (", ", $id_funcionario);
	$has_func = 0;
} else {
	$id_funcionario_ = get_current_id();
	$has_func = 0;
}


if($info_extra != ''){
	$info_extra = utf8_decode($info_extra);
} else {
	$info_extra = '';
}


function insert_repeat_date($startTime,$endTime){
	$currentDate = date('Y-m-d H:i:s');
	$clientes = $_POST["clientes"];
	$tipo_servico = $_POST["tipo_servico"];
	$preco = $_POST["preco"];
	$info_extra = $_POST["obs"];
	$has_func = 0;
	//$has_chose_fun = $_POST["has_chose_fun"];
	$prioridade = $_POST["prioridade"];

	if(isset($_POST['id_funcionario'])){
		$id_funcionario_ = $_POST["id_funcionario"];
		//$id_funcionario_ = implode (", ", $id_funcionario);
		$has_func = 1;
	} else {
		$id_funcionario_ = get_current_id();
		$has_func = 0;
	}


	if($info_extra != ''){
		$info_extra = $info_extra;
	} else {
		$info_extra = '';
	}

	//$obs_adr = $_POST["obs_adr"];

	if(!isset($_POST['ativo'])){
		$ativo = 0;
		$status = "Pendente";
		$database = new db();
		$database->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:clientes, :startTime, :endTime, :status, :currentDate,:status_pagamento)");
		$database->bind(':clientes', $clientes);
		$database->bind(':startTime', $startTime);
		$database->bind(':endTime', $endTime);
		$database->bind(':status', $status);
		$database->bind(':currentDate', $currentDate);
		$database->bind(':status_pagamento', 'Não');

		if($database->execute()){
			$last_id = $database->lastInsertId(); 
			$database->query("INSERT INTO tb_book_detail (id_booking, service_name, price , info_extra, id_funcionario,id_pet) 
				VALUES (:last_id, :tipo_servico, :preco,:info_extra, :id_funcionario,:id_pet)");
			$database->bind(':last_id', $last_id);
			$database->bind(':tipo_servico', $tipo_servico);
			$database->bind(':preco', $preco);
			$database->bind(':info_extra', $info_extra);
			$database->bind(':id_funcionario', $id_funcionario_);
			$database->bind(':id_pet', $ativo);

			if($database->execute()){
				if($has_func == 1 ){
					//foreach ($id_funcionario as $value) {
						$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
						$database->bind(':id_booking', $last_id);
						$database->bind(':id_fun', $id_funcionario_);
						$database->execute();
						//echo "$value <br>";
					//}
				} else {
					$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
						$database->bind(':id_booking', $last_id);
						$database->bind(':id_fun', $id_funcionario_);
						$database->execute();
				}

			}

		} else {
			$arr['status'] = 'ERROR';
			$arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
			exit(0);
		}
	} else {
		$ativo = $_POST["ativo"];
		foreach ($ativo as $atv) {
			
			
			$status = "";
			$status = "Pendente";
			$database = new db();
			$database->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:clientes, :startTime, :endTime, :status, :currentDate,:status_pagamento)");
			$database->bind(':clientes', $clientes);
			$database->bind(':startTime', $startTime);
			$database->bind(':endTime', $endTime);
			$database->bind(':status', $status);
			$database->bind(':currentDate', $currentDate);
			$database->bind(':status_pagamento', 'Não');

			if($database->execute()){
				$last_id = $database->lastInsertId(); 
				$database->query("INSERT INTO tb_book_detail (id_booking, service_name, price , info_extra, id_funcionario,id_pet) 
					VALUES (:last_id, :tipo_servico, :preco,:info_extra, :id_funcionario,:id_pet)");
				$database->bind(':last_id', $last_id);
				$database->bind(':tipo_servico', $tipo_servico);
				$database->bind(':preco', $preco);
				$database->bind(':info_extra', $info_extra);
				$database->bind(':id_funcionario', $id_funcionario_);
				$database->bind(':id_pet', $atv);

				if($database->execute()){
					if($has_func == 1 ){
						//foreach ($id_funcionario_ as $value) {
							$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
							$database->bind(':id_booking', $last_id);
							$database->bind(':id_fun', $id_funcionario_);
							$database->execute();
							//echo "$value <br>";
						//}
					} else {
						$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
							$database->bind(':id_booking', $last_id);
							$database->bind(':id_fun', $id_funcionario_);
							$database->execute();
					}

				
					
				
				
				}

			} else {
				$arr['status'] = 'ERROR';
				$arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
				exit(0);
			}


		}
	
	
	
	}
	

	} 






	if(!isset($_POST['ativo'])){
		$ativo = 0;
		$status = "";
		$status = "Pendente";
		$database = new db();
		$database->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:clientes, :startTime, :endTime, :status, :currentDate,:status_pagamento)");
		$database->bind(':clientes', $clientes);
		$database->bind(':startTime', $startTime);
		$database->bind(':endTime', $endTime);
		$database->bind(':status', $status);
		$database->bind(':currentDate', $currentDate);
		$database->bind(':status_pagamento', 'Não');

		if($database->execute()){
			$last_id = $database->lastInsertId(); 
			$database->query("INSERT INTO tb_book_detail (id_booking, service_name, price , info_extra, id_funcionario,id_pet) 
				VALUES (:last_id, :tipo_servico, :preco,:info_extra, :id_funcionario,:id_pet)");
			$database->bind(':last_id', $last_id);
			$database->bind(':tipo_servico', $tipo_servico);
			$database->bind(':preco', $preco);
			$database->bind(':info_extra', $info_extra);
			$database->bind(':id_funcionario', $id_funcionario_);
			$database->bind(':id_pet', $ativo);

			if($database->execute()){
				if($has_func == 1 ){
					//foreach ($id_funcionario as $value) {
						$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
						$database->bind(':id_booking', $last_id);
						$database->bind(':id_fun', $id_funcionario_);
						$database->execute();
						//echo "$value <br>";
					//}
				} else {
					$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
						$database->bind(':id_booking', $last_id);
						$database->bind(':id_fun', $id_funcionario_);
						$database->execute();
				}

			}

			/*if(isset($_POST['has_multiple'])){
				$has_multiple = $_POST["has_multiple"];
			
				foreach($has_multiple as $itens){
					
					$item_dummy = explode(" ",$itens);
			
					$startTime_ = $item_dummy[1].' '.$item_dummy[2];
					$endTime_ = $item_dummy[1].' '.$item_dummy[4];
			
					$startTime = br_to_usa_date_time2($startTime_);
					$endTime = br_to_usa_date_time2($endTime_);
					
					insert_repeat_date($startTime,$endTime);
				
			
				}
			
			} */

		} else {
			$arr['status'] = 'ERROR';
			$arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
			exit(0);
		}

		


	} else {
		$ativo = $_POST["ativo"];

		foreach ($ativo as $atv) {
			
			
			$status = "";
			$status = "Pendente";
			$database = new db();
			$database->query("INSERT INTO tb_booking (id_client, start_date, end_date, status, data_cadastro,status_pagamento) VALUES (:clientes, :startTime, :endTime, :status, :currentDate,:status_pagamento)");
			$database->bind(':clientes', $clientes);
			$database->bind(':startTime', $startTime);
			$database->bind(':endTime', $endTime);
			$database->bind(':status', $status);
			$database->bind(':currentDate', $currentDate);
			$database->bind(':status_pagamento', 'Não');

			if($database->execute()){
				$last_id = $database->lastInsertId(); 
				$database->query("INSERT INTO tb_book_detail (id_booking, service_name, price , info_extra, id_funcionario,id_pet) 
					VALUES (:last_id, :tipo_servico, :preco,:info_extra, :id_funcionario,:id_pet)");
				$database->bind(':last_id', $last_id);
				$database->bind(':tipo_servico', $tipo_servico);
				$database->bind(':preco', $preco);
				$database->bind(':info_extra', $info_extra);
				$database->bind(':id_funcionario', $id_funcionario_);
				$database->bind(':id_pet', $atv);

				if($database->execute()){
					if($has_func == 1 ){
						//foreach ($id_funcionario as $value) {
							$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
							$database->bind(':id_booking', $last_id);
							$database->bind(':id_fun', $id_funcionario_);
							$database->execute();
							//echo "$value <br>";
						//}
					} else {
						$database->query("INSERT INTO tb_book_func (id_booking, id_fun) VALUES (:id_booking, :id_fun)");
							$database->bind(':id_booking', $last_id);
							$database->bind(':id_fun', $id_funcionario_);
							$database->execute();
					}

				
				}

			} else {
				$arr['status'] = 'ERROR';
				$arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
				exit(0);
			}


		}

	}

		if(isset($_POST['has_multiple'])){
			$has_multiple = $_POST["has_multiple"];
		
			foreach($has_multiple as $itens){
				
				$item_dummy = explode(" ",$itens);
		
				$startTime_ = $item_dummy[1].' '.$item_dummy[2];
				$endTime_ = $item_dummy[1].' '.$item_dummy[4];
		
				$startTime = br_to_usa_date_time2($startTime_);
				$endTime = br_to_usa_date_time2($endTime_);
				
				insert_repeat_date($startTime,$endTime);
			
		
			}
		
		} 
	
	
		$arr['status'] = 'SUCCESS';
		$arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
		echo json_encode($arr);
	
		
		
		
		
		
		
		
		
		
		
		
		
		exit;

		$email = "";

		$db = new db(); 
		$db->query('SELECT id,foto,email,name,authToken,contentEncoding,endpoint,publicKey FROM tb_team WHERE id ='. $id_funcionario_ .' '); 
		$db->execute();
		$result = $db->resultset(); 
		$response = array();
		$email = "";
		if($result){ 
			$i = 0; 
			foreach($result as $row) {
			$email = $row['email'];
			$recebe_email = 1;
			$recebe_sms = 1;
			$nome = $row['name'];

			$imagem = $row['foto'];
			$id = $row['id'];
			$nome_colaborador = $row['name'];

			if ($imagem != ""){
				$imagem = "images/upload/funcionario".$id."/".$imagem ;
			}else{
				$imagem = "images/nouser.png" ;
			}

			$authToken = $row['authToken'];
			$contentEncoding = $row['contentEncoding'];
			$endpoint = $row['endpoint'];
			$publicKey = $row['publicKey'];


			$i++;
			}
		} else {

			$arr['email'] = '';
			$arr['nome'] = '';
		}
		
		$email = "";

		if($email != ""){
				
			if($recebe_email == 1){
				function send_mail($email,$nome,$nome_colaborador,$tipo_servico,$data_cadastrobr,$prod_path,$imagem){		
					$boxEmail = '<div style="background-color:#f0f0f0;padding:15px">
					<table style="width:100%;max-width:600px;background-color:#ffffff;border:none;margin:0 auto;padding:0;color:#666666;font-family:Helvetica,Aria,sans-serif" cellspacing="0">
					  <tbody>
						<tr>
						  <td style="padding:7px 5px 5px 5px;text-align:right;background-repeat:no-repeat;background-position:center;background-color:#009688;background-image:url("'.$prod_path.'assets/images/header_email.png")" background="#009688">
							<a href="#" style="margin-right:5px" target="_blank" data-saferedirecturl="">
							<img src="'.$prod_path.'assets/images/facebook.png" class="CToWUd"></a>
							<a href="#" style="margin-right:5px" target="_blank" >
							<img src="'.$prod_path.'assets/images/googleplus.png" class="CToWUd"></a>
							<a href="#" target="_blank"  class="CToWUd"></a>
						  </td>
						</tr>
						<tr>
						  <td style="padding:20px;text-align:center">
							<p>
							  <a href="'.$prod_path.'" target="_blank" >
								<img src="'.$prod_path.'assets/images/logo.png" class="CToWUd">
							  </a>
							</p>
							<h2 style="font-weight:bold">Olá</h2>
						  
						  <br>
						  <p>
							  <image src="'.$imagem.'" width="25px" height="25px" style="border-radius:50%;" /><h4>'.$nome_colaborador.'</h4> você acaba de receber uma atividade para ser executada:
							  <br> 
							  <strong>Data:</strong><br>
							  '.$tipo_servico.'
							  <br><br>
							  <strong>Cliente:</strong><br><br>
							  '.$tipo_servico.' <br><br>	
							  <strong>Local:</strong><br><br>
							  '.$tipo_servico.' <br><br>	
							  <strong>Atividade:</strong><br><br>
							  '.$tipo_servico.'						

						  </p><br>
							  
						  <p>
							<small style="color:#777777;font-size:11px">
							 Em caso de dúvidas entre em contato: contato@anyinspect.com.br
							</small>
						  </p>
						  </td>
						</tr>
						<tr><td style="height:5px;background-repeat:no-repeat;background-position:center;background-color:#009688;background-image:url("'.$prod_path.'assets/images/header_email.png")" background="#009688"></td></tr>
					  </tbody>
					</table>
				  </div>';
					

					$mail = new PHPMailer;
					$mail->isSMTP();
					$mail->Host = 'mail.anyinspect.com.br';
					$mail->SMTPAuth = true;
					$mail->Username = 'contato@anyinspect.com.br';
					$mail->Password = 'agoravai123';
		//           $mail->SMTPSecure = 'tls';
					$mail->SMTPSecure = 'false';
					$mail->Port = 587;
			  
					$mail->setFrom('contato@anyinspect.com.br', utf8_decode('Nova Mensagem'));
					//$mail->addReplyTo('contato@bulltraders.club', 'Nao Responder');
					$mail->AddAddress($email,utf8_decode($nome));
					//$mail->addAttachment('local_do_anexo/arquivo.extenção', 'NomeAmigavel.extenção');
			  
					$mail->isHTML(true);
					$mail->Subject = utf8_decode('Anyinspect');
					$mail->Body = utf8_decode($boxEmail);
					$mail->AltBody = utf8_decode('Nova Mensagem');
			  
					if(!$mail->send()) {
					   $arr['status'] = 'ERROR';
					   $arr['status_email'] = 'Erro: ' . $mail->ErrorInfo;
					   $arr['status_txt'] = 'Não foi possível enviar o E-mail';
					   echo json_encode($arr);
					   //exit() ;
					} 
					
				}	
			send_mail($email,$nome,$nome_colaborador,$tipo_servico,$data_cadastrobr,$prod_path,$imagem);
		
		}
	
	if($recebe_sms == 1 ){
		if($authToken != ''){
		$apiKeys = array(
			'VAPID' => array(
				'subject' => null,
				'publicKey' => 'BMPVQVgOVhIw7XzIAj-LMJztv-7IUBMTTuTBm3AWs135sOy_hRtJ7GutB-AAxOZPSEcNHsekE9iFhQjYrublIaw',
				'privateKey' => 'MVkKiVPVGA9eJ6H-XK-srC6cRE3-O2xbVEAwFhSii3I', // in the real world, this would be in a secret file
			),
			);
			$message = $mensagem;
			if($endpoint != ""){
				$send_push = 1;
			} else if($authToken != ""){
				$send_push = 1;
			} else if($publicKey != ""){
				$send_push = 1;
			} else {
				$send_push = 0;
			}

				$webPush = new WebPush($apiKeys);
				$res = $webPush->sendNotification($endpoint, $message, $publicKey, $authToken, true);

		   
		}
		
	}

		exit(0);
	}


?>