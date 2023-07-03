<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
//$_GET = json_decode(file_get_contents('php://input'), true);
$db = new db(); 

$_GET = json_decode(file_get_contents('php://input'), true);
if(isset($_GET['IdUser'])){ $IdUser = $_GET['IdUser'];} else { $IdUser  = '';} 
  
  $db->query('SELECT 
  tt.id,
  tt.name,
  tt.foto,
  tt.qr_code,
  tt.type,
  tt.type2,
  tt.sign,
  tt.email,
  tt.phone,
  tt.data_admicao
  FROM tb_team tt
  WHERE tt.id = :IdUser'); 
  $db->bind(':IdUser', $IdUser);

$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 $myArray = [];
	 foreach($result as $row) { 
		$id = $row["id"];
		$foto = $row["foto"];
		if ($foto != ""){
			$foto = prod_path."/images/upload/funcionarios/".$foto;
		}else{
			$foto = prod_path."/images/nouser.png" ;
		}

		$response['data'][] = array(
			'id' => $row['id'],
			'name' => $row['name'],
			'type' => $row['type'],
			'type2' => $row['type2'],
			'qr_code'   => $row['qr_code'],
			'sign'   => $row['sign'],
			'email'   => $row['email'],
			'phone'   => $row['phone'],
			'data_admicao'   => $row['data_admicao'],
			'foto'   => $foto
		);		 
	 } 

	 $db->query('SELECT ttq.* , DATEDIFF(ttq.validade_qual , NOW() ) as dias_expira , DATE_FORMAT( ttq.validade_qual ,"%d/%m/%Y") as validade_qual 
				FROM tb_team_qual ttq
				WHERE ttq.id_func = :IdUser'); 
				$db->bind(':IdUser', $IdUser);

				$result2 = $db->resultset(); 
				if($result2){ 
					foreach($result2 as $row) {
						
						$dias_expira = $row['dias_expira'];
						if($dias_expira > 60){
							$status = 'text-primary';
						} else if($dias_expira > 15){
							$status = 'text-warning';
						} else {
							$status = 'text-danger';
							
						}
						$response['qual'][] = array(
							'id' => $row['id'],
							'desc_qual' => $row['desc_qual'],
							'tipo_qual' => $row['tipo_qual'],
							'validade_qual' => $row['validade_qual'],
							'numero_qual'   => $row['numero_qual'],
							'data_cadastro'   => $row['data_cadastro'],
							'horaria_qual'   => $row['horaria_qual'],
							'local_qual'   => $row['local_qual'],
							'dataini_qual'   => $row['dataini_qual'],
							'datafim_qual'   => $row['datafim_qual'],
							'dias_expira'   => $row['dias_expira'],
							'status'   => $status
						);	
					}
					
				}
	 
	 			$db->query('SELECT ttd.* , DATEDIFF(ttd.data_expira , NOW()) as dias_expira , DATE_FORMAT( ttd.data_expira ,"%d/%m/%Y") as data_expira 
				FROM tb_team_doc ttd 
				WHERE ttd.id_func = :IdUser ORDER BY ttd.descricao '  ); 
				$db->bind(':IdUser', $IdUser);
				$result2 = $db->resultset(); 
				if($result2){ 
					foreach($result2 as $row) {
						$data_expira = $row['data_expira'];
						$dias_expira = $row['dias_expira'];
						if($dias_expira > 60){
							$status = 'text-primary';
						} else if($dias_expira > 15){
							$status = 'text-warning';
						} else {
							$status = 'text-danger';
						}

						if($data_expira == '00/00/0000'){
							$data_expira = '';
							$dias_expira = '';
						}

						$response['habil'][] = array(
							'id' => $row['id'],
							'descricao' => $row['descricao'],
							'valor' => $row['valor'],
							'data_expira' => $data_expira,
							'dias_expira' => $dias_expira,
							'status'   => $status
						);	
					}
				}

				$db->query('SELECT tlu.* 
				FROM tb_link_util tlu '); 
				$result2 = $db->resultset(); 
				if($result2){ 
					foreach($result2 as $row) {
						$response['links'][] = array(
							'id' => $row['id'],
							'descricao' => $row['descricao'],
							'link' => $row['link']
						);	
					}
				}

	 	  $response['status'] = 'SUCCESS';
		  $response['status_txt'] = 'Login realizado com Sucesso!'; 
		  echo json_encode($response);
	 	 exit(0);
} else { 
		$arr['status'] = 'ERROR'; 
	 	$arr['status_txt'] = 'Login ou Senha inválidos'; 
	 	echo json_encode($arr);
		exit(0);
	 	 } 

 ?>