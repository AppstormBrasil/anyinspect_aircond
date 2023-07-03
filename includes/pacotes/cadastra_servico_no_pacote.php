<?php 
 
include('../common/util.php'); 
$db = new db(); 

$id_pacote = $_POST['id_pacote'];
$id_service = $_POST['servico'];
$data_atualizacao = date('Y-m-d  H:i:s'); 



$db->query("SELECT id FROM tb_package_service WHERE id_package = :id_pacote AND id_service = :id_service ");
$db->bind(':id_pacote', $id_pacote);
$db->bind(':id_service', $id_service);

$db->execute();

$result = $db->resultset();

if ($result) {
	$arr['status'] = 'ERROR'; 
    $arr['status_txt'] = 'Serviço já cadastrado'; 
    echo json_encode($arr);
        exit(0);
}else{

	$db->query("INSERT INTO tb_package_service (id_package, id_service, data_cadastro) 
		VALUES (:id_pacote, :id_service, :data_atualizacao)");

	$db->bind(':id_pacote', $id_pacote);
	$db->bind(':id_service', $id_service);
	$db->bind(':data_atualizacao', $data_atualizacao);


	if($db->execute()){
    $arr['status'] = 'SUCCESS';
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
    }
    $database->endTransaction();

}

?>