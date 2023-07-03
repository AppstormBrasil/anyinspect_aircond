<?php
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

$myArray = [];
$someArray = [];
$i = 1; 
$status_morador = "";
if($id > 0){ 
	// GETTING ALL UNREAD COMUNICADOS
	
	$sql = "SELECT tact.* , COUNT(tact.titulo) as total_comunicado 
	FROM tb_admin_envia_info taec
	LEFT JOIN tb_morador tm ON taec.IdMorador = tm.IdMorador
	LEFT JOIN tb_admin_info_template tact ON tact.IdComunicadoTemplate = taec.IdComunicadoTemplate
	WHERE taec.IdMorador = ".$id." AND taec.status_morador = 0
    group by tact.tipo
	ORDER BY taec.data_envio DESC ";

	
	$db->query($sql);
 } 
 
 
 $db->execute();
 $result = $db->resultset(); 
 $total_comunicados = [];
 if($result){ 
 
	 foreach($result as $row) {
		
		$total_comunicado =  $row['total_comunicado'];
		
		array_push($total_comunicados, [
			'tipo' => $row['tipo'],
			'total_comunicado' => $total_comunicado
		]);
		
		//$total_comunicado = $total_comunicado + $total_comunicado;
	 } 

} else {
	$total_comunicado = 0;	
}

  // GETTING ALL UNREAD MESSAGES
 
 	 $db->query("SELECT COUNT(tm.IdMensagem) as total_mensagem
      from tb_mensagem tm
      WHERE tm.IdMorador ='$id' AND tm.status = 0 ORDER BY tm.data_envio DESC "); 
	  $db->execute();
	  $result_mensagem = $db->resultset(); 



	  if($result_mensagem != ''){
		foreach($result_mensagem as $row) {
			$total_mensagem =  $row['total_mensagem'];
			
		}
	  } else {
		$total_mensagem = 0;
	  }


	  // GETTING ALL UNREAD RECLAMACAO RESPONSE
 
 	 $db->query("SELECT COUNT(tr.Idreclamacao) as total_reclamacao
      from tb_reclamacao tr
      WHERE tr.IdMorador ='$id' AND tr.status = 1 "); 
	  $db->execute();
	  $result_reclamacao = $db->resultset(); 



	  if($result_reclamacao != ''){
		foreach($result_reclamacao as $row) {
			$total_reclamacao=  $row['total_reclamacao'];
		}
	  } else {
		$total_reclamacao = 0;
	  }

	 // GETTING ALL UNREAD RECLAMACAO RESPONSE

	 //GETTING ALL ENQUETE RESPONSE
	 
	 $db->query("SELECT COUNT(taer.IdEnquete) as  total_enquete
	 FROM tb_admin_enquete tae
	 LEFT JOIN tb_admin_enquete_resp taer ON taer.IdEnquete = tae.IdEnquete
	 WHERE taer.status_leitura = '0' AND taer.IdMorador = ".$id." 	");
	 
	 $db->execute();
	 $result_enquete = $db->resultset(); 


	 if($result_enquete != ''){
		foreach($result_enquete as $row) {
			$total_enquete =  $row['total_enquete'];
		}
	  } else {
		$total_enquete = 0;
	  } 
	  

	 $total_new_messages = 0 + $total_mensagem  ;

	 $arr['total_new_messages'] = $total_new_messages;
	 $arr['total_reclamacao'] = $total_reclamacao;
	 $arr['total_enquete'] = $total_enquete;
	 $arr['total_mensagens'] = $total_comunicados;

   echo json_encode($arr);

?>