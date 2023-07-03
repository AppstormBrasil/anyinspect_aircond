<?php

include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$db = new db(); 
 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}

if($id > 0){ 
    $db->query("SELECT tr.tipo_reclamacao, tr.descricao, tr.IdCondominio, tr.IdReclamacao, tr.imagem , tr.anexo ,  tr.status , tr.obs ,
	DATE_FORMAT(tr.data_cadastro,'%d/%m/%Y %H:%i:%s') as data_cadastro, 
	DATE_FORMAT(tr.data_resolucao,'%d/%m/%Y %H:%i:%s') as data_resolucao
	FROM tb_reclamacao tr
	WHERE tr.IdReclamacao = ".$id."
	");
 } 
$db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 
	  $someArray = [];
	 foreach($result as $row) {
		$IdCondominio = $row["IdCondominio"];
		$IdReclamacao = $row["IdReclamacao"];
		$imagem = $row["imagem"];
		$documento = $row["anexo"];

		if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = prod_path."/images/ocorrencia/".$IdCondominio."/".$IdReclamacao."/".$imagem ;
		}else{
			$imagem = '' ;
		}

		if ($documento != ""){
			$documento_url = prod_path."/documento/ocorrencia/".$IdCondominio."/".$IdReclamacao."/".$documento ;
			$documento_img = prod_path."/images/pdf_img.png" ;
		}else{
			$documento_img = prod_path."/images/noimage.jpg" ;
			$documento_url = "";
		}

		array_push($someArray, [
		'IdCondominio'   => $row['IdCondominio'],
		'IdReclamacao'   => $row['IdReclamacao'],
		'tipo_reclamacao'   => $row['tipo_reclamacao'],
		'descricao' => $row['descricao'],
		'data_cadastro' => $row['data_cadastro'],
		'data_resolucao' => $row['data_resolucao'],
		'status' => $row['status'],
		'obs' => $row['obs'],
		'imagem' => $imagem,
		'img_responde' => prod_path."/images/sindico.jpg",
		'documento_img' => $documento_img,
		'documento_url' => $documento_url
		]);
	 
		
	 } 
	 	 echo json_encode($someArray);
		 
		 /*$db->query('UPDATE tb_admin_envia_comunicado SET data_leitura = :data_leitura, status_morador = :status_morador WHERE IdEnviaComunicado = :IdEnviaComunicado ');
	     $db->bind(':data_leitura', $created_at); 
	     $db->bind(':status_morador', 1); 
	     $db->bind(':IdEnviaComunicado', $id); 
	     if($db->execute()){ 
			exit(0);
	     } else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao salvar'; 
	 	 echo json_encode($arr);
	 	 } */
		 
		 
	 	 exit(0);
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel';
	 	 echo json_encode($arr);
	 	 }
?>