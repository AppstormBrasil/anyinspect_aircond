<?php
include('../common/util.php');

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}

$db = new db(); 
$db->query('SELECT * from tb_companie'); 
$db->execute();
$result = $db->single(); 

$foto_empresa = $result['foto'];
if ($foto_empresa != ""){
    $foto_empresa = 'images/upload/empresa/'.$foto_empresa;
}else{
    $foto_empresa = "assets/images/noimage.png" ;
} 



$response['empresa'] = array(
    "id"=>$result['id'],
    "nome_empresa"=>$result['nome_empresa'],
    "email"=>$result['email'],
    "phone"=>$result['phone'],
    "cep"=>$result['cep'],
    "endereco"=>$result['endereco'],
    "bairro"=>$result['bairro'],
    "number"=>$result['number'],
    "cidade"=>$result['cidade'],
    "estado"=>$result['estado'],
    "foto_empresa"=>$foto_empresa
);

$db->query("SELECT tt.name  , tt.email , tt.cpf , tt.rg , tt.type , ttq.desc_qual , ttq.numero_qual , tt.phone 
FROM tb_team tt
LEFT JOIN tb_team_qual ttq ON tt.id = ttq.id_func  
WHERE tt.type2 = '1' "); 
$db->execute();
$resp_tec = $db->single(); 
$response['resp_tecnico'] = $resp_tec;

$db->query('SELECT short_dec from tb_services WHERE id = '.$id.' '); 
$db->execute();
$service_name = $db->single(); 
$response['service_name'] = $service_name;

echo json_encode($response);
exit(0);

?>