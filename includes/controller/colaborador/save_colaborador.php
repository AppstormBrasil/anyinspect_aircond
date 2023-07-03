 <?php 

 include('../../common/util.php'); 
 $created_at = date('Y-m-d  H:i:s'); 
 $db = new db(); 
 $IdCondominio = get_id_empresa();

 
  if(isset($_POST['nome'])){ $nome = $_POST['nome'];} else {$nome = '';} 
  if(isset($_POST['funcao'])){ $funcao = $_POST['funcao'];} else {$funcao = '';}
  if(isset($_POST['tipo'])){ $tipo = $_POST['tipo'];} else {$tipo = '';}  
  if(isset($_POST['email'])){ $email = $_POST['email'];} else {$email = '';} 
  if(isset($_POST['telefone1'])){ $telefone1 = $_POST['telefone1'];} else {$telefone1 = '';} 
  if(isset($_POST['telefone2'])){ $telefone2 = $_POST['telefone2'];} else {$telefone2 = '';} 
  if(isset($_POST['cep'])){ $cep = $_POST['cep'];} else {$cep = '';} 
  if(isset($_POST['endereco'])){ $endereco = $_POST['endereco'];} else {$endereco = '';} 
  if(isset($_POST['numero'])){ $numero = $_POST['numero'];} else {$numero = '';} 
  if(isset($_POST['bairro'])){ $bairro = $_POST['bairro'];} else {$bairro = '';} 
  if(isset($_POST['cidade'])){ $cidade = $_POST['cidade'];} else {$cidade = '';} 
  if(isset($_POST['estado'])){ $estado = $_POST['estado'];} else {$estado = '';} 
  if(isset($_POST['pais'])){ $pais = $_POST['pais'];} else {$pais = '';} 
  if(isset($_POST['cpf'])){ $cpf = $_POST['cpf'];} else {$cpf = '';} 
  if(isset($_POST['rg'])){ $rg = $_POST['rg'];} else {$rg = '';} 
  if(isset($_POST['portador'])){ $portador = $_POST['portador'];} else {$portador = '';} 
  if(isset($_POST['cnh'])){ $cnh = $_POST['cnh'];} else {$cnh = '';}
  if(isset($_POST['data_nascimento'])){ $data_nascimento = $_POST['data_nascimento'];} else {$data_nascimento = '';}
  if(isset($_POST['obs'])){ $obs = $_POST['obs'];} else {$obs = '';}




  $db->query("SELECT email FROM tb_admin_colaborador WHERE email = '".$email."' "); 
  $db->execute();
  $result = $db->resultset(); 
  if($result){ 
	$i = 0; 
	foreach($result as $row) {
		if($row != ''){
			$arr['status'] = 'ERROR'; 
			$arr['status_txt'] = 'Este e-mail ja existe por favor escolher outro e-mail'; 
			echo json_encode($arr);
			exit(0);
		}
	}
} else {
	$start_password = 'Bemvindo!123' ;
	$senha = md5($start_password);
   
	$qrcode_colaborador = sprintf("%06d", mt_rand(1, 999999));
  
    $db->query('INSERT INTO tb_admin_colaborador 
	(IdCondominio,nome,email,senha,telefone1,telefone2,telefone3,rg,cpf,cnh,funcao,cep,endereco,numero,bairro,cidade,estado,pais,status,data_cadastro,data_nascimento,portador,tipo,qrcode_colaborador) 
	VALUES (:IdCondominio, :nome, :email, :senha, :telefone1, :telefone2 ,:telefone3, :rg, :cpf, :cnh, :funcao, :cep, :endereco, :numero, :bairro, :cidade, :estado, :pais, :status, :data_cadastro, :data_nascimento, :portador, :tipo, :qrcode_colaborador)'); 
		$db->bind(':IdCondominio', $IdCondominio); 
		$db->bind(':nome', $nome); 
		$db->bind(':email', $email); 
		$db->bind(':senha', $senha); 
		$db->bind(':telefone1', $telefone1);
		$db->bind(':telefone2', $telefone2);
		$db->bind(':telefone3', '');
		$db->bind(':rg', $rg);
		$db->bind(':cpf', $cpf);
		$db->bind(':cnh', $cnh);
		$db->bind(':funcao', $funcao);
		$db->bind(':cep', $cep);
		$db->bind(':endereco', $endereco); 
		$db->bind(':numero', $numero); 
		$db->bind(':bairro', $bairro); 
		$db->bind(':cidade', $cidade); 
		$db->bind(':estado', $estado);
		$db->bind(':pais', $pais);
		$db->bind(':status', 1);
		$db->bind(':data_cadastro', $created_at);
		$db->bind(':data_nascimento', $data_nascimento);
		$db->bind(':portador', $portador);
		$db->bind(':tipo', $tipo);
		$db->bind(':qrcode_colaborador', $qrcode_colaborador);
		
		if($db->execute()){ 
			  $last_id = $db->lastInsertId(); 
			 $arr['status'] = 'SUCCESS';
			 $arr['last_id'] = $last_id;
			 echo json_encode($arr);
			 exit(0);
		} else { 
			  $arr['status'] = 'ERROR'; 
			 $arr['status_txt'] = 'Erro ao salvar'; 
			 echo json_encode($arr);
			 exit(0);
			 } 
}
 

 
  ?>