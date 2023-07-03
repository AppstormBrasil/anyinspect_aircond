<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$database = new db();
$created_at = date('Y-m-d  H:i:s'); 
$id = $_POST["id"];
$descricao = $_POST["descricao"];
$valor = $_POST["valor"];
$data_expira = $_POST["data_expira"];


if($data_expira == ""){

}else{
	$data_expira = br_to_usa($data_expira);
}

 $database->query('UPDATE tb_team_doc SET descricao = :descricao , valor = :valor, data_expira = :data_expira, data_cadastro = :data_cadastro  WHERE id = :id ');

 $database->bind(':descricao', $descricao);
 $database->bind(':valor', $valor);
 $database->bind(':data_expira', $data_expira);
 $database->bind(':data_cadastro', $data_atualizacao);
 $database->bind(':id', $id);

 if($database->execute()){
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