<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}

 $descricao = $_POST["descricao"];
 //$category = $_POST["category"];
 $model = $_POST["model"];
 $register = $_POST["register"];
 $obs = $_POST["obs"];
 $local = $_POST["local"];
 $validade = $_POST["validade"];
 $fabricante = $_POST["fabricante"];
 $capacidade = $_POST["capacidade"];
 $tipo = $_POST["tipo"];
 $type_pai = $_POST["type_pai"];
 $list_pai = $_POST["list_pai"];
 $id_service = $_POST["id_service"];
 $cond1 = $_POST["cond1"];
 $modelo_cond1 = $_POST["modelo_cond1"];
 $nserie_cond1 = $_POST["nserie_cond1"];
 $cond2 = $_POST["cond2"];
 $modelo_cond2 = $_POST["modelo_cond2"];
 $nserie_cond2 = $_POST["nserie_cond2"];
 $cond3 = $_POST["cond3"];
 $modelo_cond3 = $_POST["modelo_cond3"];
 $nserie_cond3 = $_POST["nserie_cond3"];
 $sn = $_POST["sn"];

/*$cond1 = 'teste1';
$modelo_cond1 = 'teste1';
$nserie_cond1 = 'teste1';
$cond2 = 'teste2';
$modelo_cond2 = 'teste2';
$nserie_cond2 = 'teste2';
$cond3 = 'teste3';
$modelo_cond3 = 'teste3';
$nserie_cond3 = 'teste3';*/


 if($validade != ''){
	$validade = br_to_usa($validade);
 }

 $db->query('UPDATE tb_clients_ativo
  SET 
  descricao = :descricao , 
  model = :model, 
  register = :register, 
  obs = :obs ,
  local = :local ,
  validade = :validade ,
  fabricante = :fabricante , 
  tipo = :tipo , 
  type_pai = :type_pai , 
  id_depende = :id_depende , 
  id_service =:id_service , 
  cond1 =:cond1 ,
  modelo_cond1 =:modelo_cond1 ,
  nserie_cond1 =:nserie_cond1 ,
  cond2 =:cond2 ,
  modelo_cond2 =:modelo_cond2 ,
  nserie_cond2 =:nserie_cond2 ,
  cond3 =:cond3 ,
  modelo_cond3 =:modelo_cond3 ,
  nserie_cond3 =:nserie_cond3 ,
  sn =:sn ,
  capacidade =:capacidade 
  WHERE id = :id ');
 
 
 $db->bind(':descricao', $descricao); 
 $db->bind(':model', $model); 
 $db->bind(':register', $register);
 $db->bind(':obs', $obs); 
 $db->bind(':local', $local); 
 $db->bind(':validade', $validade); 
 $db->bind(':fabricante', $fabricante); 
 $db->bind(':tipo', $tipo); 
 $db->bind(':type_pai', $type_pai); 
 $db->bind(':id_depende', $list_pai); 
 $db->bind(':id_service', $id_service); 
 $db->bind(':cond1', $cond1); 
 $db->bind(':modelo_cond1', $modelo_cond1);
 $db->bind(':nserie_cond1', $nserie_cond1);
 $db->bind(':cond2', $cond2); 
 $db->bind(':modelo_cond2', $modelo_cond2);
 $db->bind(':nserie_cond2', $nserie_cond2);
 $db->bind(':cond3', $cond3); 
 $db->bind(':modelo_cond3', $modelo_cond3);
 $db->bind(':nserie_cond3', $nserie_cond3);
 $db->bind(':sn', $sn);
 $db->bind(':capacidade', $capacidade);
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