<?php
include('../../common/util.php'); 

$current_date = date('Y-m-d H:i:s');

$nome_cliente = $_POST["nome_cliente"];
$sexo = $_POST["sexo"];
$email = $_POST["email"];
$telefone1 = $_POST["telefone1"];
$telefone2 = $_POST["telefone2"];
$cep = $_POST["cep"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$complemento = $_POST["complemento"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cpf = $_POST["cpf"];
$rg = $_POST["rg"];
$data_nascimento = $_POST["data_nascimento"];
$obs = $_POST["obs"];

if($data_nascimento == ""){
}else{
	$data_nascimento = br_to_usa($data_nascimento);
}

$nome_pet_array = $_POST["nome_pet_array"];
$sexo_pet_array = $_POST["sexo_pet_array"];
$raca_pet_array = $_POST["raca_pet_array"];
$porte_pet_array = $_POST["porte_pet_array"];
$hair_pet_array = $_POST["hair_pet_array"];
$mood_pet_array = $_POST["mood_pet_array"];
$dt_nasc_pet_array = $_POST["dt_nasc_pet_array"];
$observacao_pet_array = $_POST["observacao_pet_array"];

$database = new db();

$database->query("INSERT INTO pet_client (name, gender, cpf, data_nascimento, phone,phone2,email,rg,zip,street,number,neighbor, complemento, city, state_,obs,data_cadastro) VALUES (:nome, :sexo, :cpf, :data_nascimento, :telefone1, :telefone2, :email, :rg, :cep, :endereco, :numero, :bairro, :complemento, :cidade, :estado, :obs, :current_date)");
$database->bind(':nome', $nome_cliente);
$database->bind(':sexo', $sexo);
$database->bind(':email', $email);
$database->bind(':cpf', $cpf);
$database->bind(':rg', $rg);
$database->bind(':telefone1', $telefone1);
$database->bind(':telefone2', $telefone2);
$database->bind(':cep', $cep);
$database->bind(':endereco', $endereco);
$database->bind(':numero', $numero);
$database->bind(':complemento', $complemento);
$database->bind(':bairro', $bairro);
$database->bind(':cidade', $cidade);
$database->bind(':estado', $estado);
$database->bind(':data_nascimento', $data_nascimento);
$database->bind(':current_date', $current_date);
$database->bind(':obs', $obs);

if($database->execute()){
    $last_id = $database->lastInsertId(); 
	
	$i = 0;
	$contador = count($nome_pet_array);
	while($i < $contador){
		if($dt_nasc_pet_array[$i] == ""){
			
		}else{
			$dt_nasc_pet_array[$i] = br_to_usa($dt_nasc_pet_array[$i]);
		}
		
		
		$database->query("INSERT INTO pet_clients_pet (fk_pet_client, name, breed, gender, mood, size, hair, dt_nasc,obs,data_cadastro) VALUES (:last_id, :name, :breed, :gender, :mood, :size, :hair, :dt_nasc, :obs, :data_cadastro)");
		$database->bind(':last_id', $last_id);
		$database->bind(':name', $nome_pet_array[$i]);
		$database->bind(':breed', $raca_pet_array[$i]);
		$database->bind(':gender', $sexo_pet_array[$i]);
		$database->bind(':size', $porte_pet_array[$i]);
		$database->bind(':hair', $hair_pet_array[$i]);
		$database->bind(':mood', $mood_pet_array[$i]);
		$database->bind(':dt_nasc', $dt_nasc_pet_array[$i]);
		$database->bind(':obs', $observacao_pet_array[$i]);
		$database->bind(':data_cadastro', $current_date);
		$i = $i + 1;
		if($database->execute()){
			
		}
	}

    $arr['status'] = 'SUCCESS';
	$arr['id_cliente'] = $last_id;
    $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
    echo json_encode($arr);
    exit(0);
} else {
     $arr['status'] = 'ERROR';
     $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
     exit(0);
}
$database->endTransaction();
?>