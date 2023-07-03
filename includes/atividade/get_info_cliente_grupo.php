<?php

  include('../common/util.php');

  if(isset($_POST['id_grupo'])){ $id_grupo = $_POST['id_grupo'];} else {$id_grupo = '';}
  $db = new db(); 




$db->query("SELECT  
tcli.name as responsavel_cliente  , tcli.phone as phone_cliente , tcli.email as email_cliente , tcli.zip as cep_cliente , 
tcli.street as endereco_cliente , tcli.number as num_cliente , tcli.neighbor as bairro_cliente , 
tcli.complemento as complemento_cliente , tcli.city as cidade_cliente , tcli.state_ as estado_cliente , 
tcli.nome_empresa , tcli.lat as lat_cliente , tcli.lon as lon_cliente , tcli.foto as foto_cliente , tcli.nome_empresa
FROM tb_client tcli
LEFT JOIN tb_booking tb ON tcli.id = tb.id_client 
WHERE tb.id_group  = :id_grupo ");
$db->bind(':id_grupo', $id_grupo);
$result = $db->resultset();

  $response = array();
	if($result){
		foreach($result as $row) {
			$foto_cliente = $row['foto_cliente'];
	
			if ($foto_cliente != ""){
				$foto_cliente = "images/upload/clientes/".$foto_cliente ;
			}else{
				$foto_cliente = "images/nouser.png" ;
			}
		
			$response['cliente'] = array(
				"foto_cliente"=>$foto_cliente,
				"responsavel_cliente"=>$row['responsavel_cliente'],
				"phone_cliente"=>$row['phone_cliente'],
				"email_cliente"=>$row['email_cliente'], 
				"cep_cliente"=>$row['cep_cliente'], 
				"endereco_cliente"=>$row['endereco_cliente'], 
				"num_cliente"=>$row['num_cliente'], 
				"bairro_cliente"=>$row['bairro_cliente'], 
				"complemento_cliente"=>$row['complemento_cliente'], 
				"cidade_cliente"=>$row['cidade_cliente'], 
				"estado_cliente"=>$row['estado_cliente'], 
				"nome_empresa"=>$row['nome_empresa'], 
				"lat_cliente"=>$row['lat_cliente'],
				"lon_cliente"=>$row['lon_cliente'],
			
			);
			
		
		}

		
		
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
		WHERE tt.type2 = '1' AND ttq.desc_qual = 'CREA'"); 
		$db->execute();
		$resp_tec = $db->single(); 
		$response['resp_tecnico'] = $resp_tec;
		
		
		
		echo json_encode($response);
		exit(0);


	} else {
		$arr['status'] = "ERROR";
		$arr['status_txt'] = "Erro! E-mail ou Senha inválidos!";
		echo json_encode($arr);
	}


exit(0);

?>
