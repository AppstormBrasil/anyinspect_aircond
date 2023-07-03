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
$prod_path = 'http://localhost:8080/anyinspect/';
$id = 9;

$db = new db(); 
$db->query('SELECT id,email,name,authToken,contentEncoding,endpoint,publicKey,foto FROM tb_team WHERE id ='. $id .' '); 
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

$mensagem = 'teste push aqui';

$recebe_sms = 1;
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
		



?>