<?php
include('../common/util.php'); 

require_once('../email/PHPMailerAutoload.php');

$db = new db(); 
$current_date = date('d-m-y');
$current_month = '20'.date('y');

/*$someArray = [];
 $db->query("SELECT * FROM tb_book_group ORDER BY id DESC LIMIT 1"); 

 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 1; 
	 $status_check = "";
	 foreach ($result as $row) {
		$IdSeqGrd = $row['IdSeqGrd'] + 1;
		$IdSeqGrd = sprintf('%04d', $IdSeqGrd);
		$i++;
	}
} else { 
	$someArray = [];
	$IdSeqGrd = '0001';
 } */

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
$prod_path = 'https://demo.anyinspect.com.br/';
$startTime = $_POST["startTime"].':00';
$startTimebra = $_POST["startTime"].':00';
$endTime = $_POST["endTime"].':00';


$startTime = br_to_usa_date_time2($_POST["startTime"]);
$endTime = $_POST["endTime"];

$endTime_dummy = explode(' ', $startTime);
$endTime_dummy = $endTime_dummy[0].' '.$endTime;
$endTime = $endTime_dummy ;
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
					
					
					$boxEmail = '<div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important">
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
					   <tbody>
						  <tr>
							 <td align="center">
								<center style="width:100%">
								   <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif;margin-top:50px;margin-bottom: 50px;" width="512">
									  <tbody>
										 <tr>
											<td bgcolor="#FFFFFF" width="100%" style="background-color:#ffffff;padding:12px;border-bottom:1px solid #ececec">
											   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
												  <tbody>
													 <tr>
														<td align="left" valign="middle"><a style="color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none"><img alt="AnyInspect" border="0" src="'.$prod_path.'images/empresa/anyinspect.png " width="140" style="outline:none;color:#ffffff;display:block;text-decoration:none;font-size:12px" ></a></td>
													 </tr>
												  </tbody>
											   </table>
											</td>
										 </tr>
										 <tr>
											<td align="left">
											   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
												  <tbody>
													 <tr>
														<td width="100%">
														   <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-weight:200">
															  <tbody>
																 <tr>
																	<td align="center" bgcolor="#1ea59a" style="background-color:#1ea59a;padding:20px 48px;color:#ffffff">
																	   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
																		  <tbody>
																			 <tr>
																				<td align="center" width="100%">
																				   <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px"></h1>
																				   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
																					  <tbody>
																						 <tr>
																							<td style="padding:20px 0 0 0">
																							   <table border="0" cellpadding="0" cellspacing="0" align="center" style="font-weight:200">
																								  <tbody>
																									 <tr>
																										<td align="center" valign="middle" style="font-size:16px">
																										   <a style="color:#4c4c4c;white-space:nowrap;display:block;text-decoration:none">
																											  <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
																												 <tbody>
																													<tr>
																													   <td style="border-radius:2px;padding:6px 16px;color:#ffffff;font-size:16px">
																										   <a style="color:#ffffff;white-space:nowrap;display:block;text-decoration:none"> <strong></strong> <h2>NOVA ATIVIDADE</h2> </a></td> </tr> </tbody> </table></a>
																										</td>
																									 </tr>
																								  </tbody>
																							   </table>
																							</td>
																						 </tr>
																					  </tbody>
																				   </table>
																				</td>
																			 </tr>
																		  </tbody>
																	   </table>
																	</td>
																 </tr>
																 <tr>
																	<td align="center" style="padding:20px 0 32px 0">
																	   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
																		  <tbody>
																			 <tr>
																				<td align="left" width="100%">
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:20px;line-height:24px"> <image src="http://localhost:8080/anyinspectair/images/upload/funcionarios/9.jpg" width="25px" height="25px" style="border-radius:50%;" />'.$nome_colaborador.',  você acaba de receber uma atividade para ser executada:</h4>
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:16px;line-height:24px"><a style="color:#4c4c4c;white-space:normal;font-weight:bold;display:inline-block;text-decoration:none">Data:</a> 01/01/2020 ás 07:00</h4>
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:16px;line-height:24px"><a style="color:#4c4c4c;white-space:normal;font-weight:bold;display:inline-block;text-decoration:none">Cliente:</a> Nestle</h4>
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:16px;line-height:24px"><a style="color:#4c4c4c;white-space:normal;font-weight:bold;display:inline-block;text-decoration:none">Local:</a> teste123</h4>
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:16px;line-height:24px"><a style="color:#4c4c4c;white-space:normal;font-weight:bold;display:inline-block;text-decoration:none">Atividade:</a> teste123</h4>
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:16px;line-height:24px"><a style="color:#4c4c4c;white-space:normal;font-weight:bold;display:inline-block;text-decoration:none">Obs:</a> teste123</h4>
																				   <h4 style="padding:0;margin:12px 24px 20px 24px;color:#4c4c4c;font-weight:200;font-size:16px;line-height:24px"><small style="color:#4c4c4c;white-space:normal;text-align:center;display:inline-block;text-decoration:none">Em caso de dúvidas entre em contato: contato@anyinspect.com.br</small></h4>
																					  
																					  
																				   
																					 
																				   </h4>
																				</td>
																			 </tr>
																		  </tbody>
																	   </table>
																	</td>
																 </tr>
															  </tbody>
														   </table>
														</td>
													 </tr>
												  </tbody>
											   </table>
											</td>
										 </tr>
										 <tr>
											<td align="left">
											   <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
												  <tbody>
													 <tr>
														<td align="center" width="100%">
														   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
															  <tbody>
																 <tr>
																	<td align="center" valign="middle" width="100%" style="border-top:1px solid #d9d9d9;padding:16px 0;text-align:center"></td>
																 </tr>
															  </tbody>
														   </table>
														</td>
													 </tr>
													 <tr>
														<td align="center" width="100%">
														   <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
															  <tbody>
																 <tr>
																	<td align="center" style="padding:0 0 8px 0" width="100%"><a><img alt="AnyInspect" border="0"  width="100" src="http://localhost:8080/anyinspectair/images/empresa/anyinspect.png" style="outline:none;color:#ffffff;display:block;text-decoration:none;font-size:12px" ></a>AnyInspect</td>
																 </tr>
																 <tr>
																	<td align="center" width="100%" style="padding:0 0 12px 0;font-size:12px;line-height:16px"><span dir="ltr">© 2021.</span></td>
																 </tr>
															  </tbody>
														   </table>
														</td>
													 </tr>
												  </tbody>
											   </table>
											</td>
										 </tr>
									  </tbody>
								   </table>
								</center>
							 </td>
						  </tr>
					   </tbody>
					</table>
					<img style="outline:none;color:#ffffff;display:block;text-decoration:none;width:1px;border-color:#ececec;border-width:1px;border-style:solid;min-height:1px">
				 </div>';
					
					
					
					/*$boxEmail = '<div style="background-color:#f0f0f0;padding:15px">
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
				  </div>'; */
					

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