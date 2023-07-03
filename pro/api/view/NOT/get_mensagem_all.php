<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$someArray = [];
if($id > 0){ 
 	 $db->query("SELECT IdMensagem, IdMorador, mensagem,
      DATE_FORMAT(data_envio,'%d/%m/%Y %H:%i:%s') as data_envio,
      DATE_FORMAT(data_leitura,'%d/%m/%Y %H:%i:%s') as data_leitura,
      status
      from tb_mensagem
      WHERE IdMorador ='$id' ORDER BY data_envio DESC"); 
 } else { 
  	 $arr['status'] = 'ERROR'; 
	 $arr['status_txt'] = 'Nenhuma informação disponível'; 
	 echo json_encode($arr);
 } 
$db->execute();
$result = $db->resultset(); 

$i = 1; 

if($result){ 
	 
	 foreach ($result as $row ) {
		
		$mensagem = $row['mensagem'];
		$mensagem = substr($mensagem, 0, 33);
		$my_size = strlen($mensagem);
		if($my_size > 21){
			$mensagem = substr($mensagem, 0, 21)."...";
		}
		if($mensagem != ''){
			$first_char = substr($mensagem, 0, 1);
		} else {
			$first_char = 'M';
		}

		$status = $row['status'];
			if($status == 0){
			$font_weight = '600';
		} else{
			$font_weight = '300';
		}
		
		$status_morador =  $row['status'];
		if($status_morador == 0){
			$is_new = '<a href="#/mensagem/'.$row['IdMensagem'].' "><div class="message_type_yellow fr small message_type">Novo</div></a>';
		} else {
			$is_new = '';
		}

	 
		array_push($someArray, [
		'IdMensagem' => $row['IdMensagem'],
		'IdMorador'   => $row['IdMorador'],
		'mensagem'   => $mensagem,
		'data_envio' => $row['data_envio'],
		'imagem' => 'img/mail.png',
		'tipo_mensagem' => 'Mensagem',
		'link' => '#/mensagem/'.$row['IdMensagem'].'',
		'message_type' => 'message_type_red',
		'cm_bg' => 'cm-bg-grey',
		'first_char' => $first_char,
		'font_weight' => $font_weight,
		'id' => $i,
		'is_new'=> $is_new
		]);
		
		$i++;
	}
} else { 
 	 	 $someArray = [];
} 

 
		 
echo json_encode($someArray);		 

 ?>