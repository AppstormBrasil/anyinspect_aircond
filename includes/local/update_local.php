<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }

 if(isset($_POST['responsavel'])){ $responsavel = $_POST['responsavel'];} else {$responsavel = '';}
 if(isset($_POST['cep'])){ $cep = $_POST['cep'];} else {$cep = '';} 
 if(isset($_POST['endereco'])){ $endereco = $_POST['endereco'];} else {$endereco = '';} 
 if(isset($_POST['numero'])){ $numero = $_POST['numero'];} else {$numero = '';} 
 if(isset($_POST['complemento'])){ $complemento = $_POST['complemento'];} else {$complemento = '';} 
 if(isset($_POST['bairro'])){ $bairro = $_POST['bairro'];} else {$bairro = '';} 
 if(isset($_POST['cidade'])){ $cidade = $_POST['cidade'];} else {$cidade = '';} 
 if(isset($_POST['estado'])){ $estado = $_POST['estado'];} else {$estado = '';} 
 if(isset($_POST['lat'])){ $lat = $_POST['lat'];} else {$lat = '';}
 if(isset($_POST['lon'])){ $lon = $_POST['lon'];} else {$lon = '';}
 if(isset($_POST['descricao'])){ $descricao = $_POST['descricao'];} else {$descricao = '';}

 if(isset($_POST['tipo'])){ $tipo = $_POST['tipo'];} else {$tipo = '';} 
 if(isset($_POST['num_fixo'])){ $num_fixo = $_POST['num_fixo'];} else {$num_fixo = '';} 
 if(isset($_POST['num_flutuante'])){ $num_flutuante = $_POST['num_flutuante'];} else {$num_flutuante = '';}
 if(isset($_POST['area_climatizada'])){ $area_climatizada = $_POST['area_climatizada'];} else {$area_climatizada = '';}
 if(isset($_POST['carga_termica'])){ $carga_termica = $_POST['carga_termica'];} else {$carga_termica = '';}
 if(isset($_POST['cliente'])){ $cliente = $_POST['cliente'];} else {$cliente = '';}

 
 $db->query('UPDATE tb_local SET descricao = :descricao , id_client = :id_client ,  tipo = :tipo , cep = :cep , endereco = :endereco, numero = :numero, complemento = :complemento,bairro = :bairro, cidade = :cidade, estado = :estado, lat = :lat , lon = :lon , carga_termica = :carga_termica , num_fixo = :num_fixo , num_flutuante = :num_flutuante , area_climatizada = :area_climatizada  WHERE id = :id ');
 $db->bind(':id_client', $cliente); 
 $db->bind(':tipo', $tipo); 
 $db->bind(':descricao', $descricao); 
 $db->bind(':cep', $cep); 
 $db->bind(':endereco', $endereco);
 $db->bind(':numero', $numero);
 $db->bind(':complemento', $complemento);
 $db->bind(':bairro', $bairro);
 $db->bind(':cidade', $cidade);
 $db->bind(':estado', $estado);
 $db->bind(':lat', $lat);
 $db->bind(':lon', $lon);
 $db->bind(':carga_termica', $carga_termica);
 $db->bind(':num_fixo', $num_fixo);
 $db->bind(':num_flutuante', $num_flutuante);
 $db->bind(':area_climatizada', $area_climatizada);
 $db->bind(':id', $id); 

 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>