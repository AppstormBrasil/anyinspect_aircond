<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 


$days = $_GET["days"];
$db = new db(); 

$db->query("SELECT ttq.* , tt.name , tt.foto , tt.cargo ,   DATEDIFF(ttq.validade_qual , NOW() ) as dias_expira , DATE_FORMAT( ttq.validade_qual ,'%d/%m/%Y') as validade_qual 
FROM tb_team_qual ttq
LEFT JOIN tb_team tt ON tt.id = ttq.id_func ORDER BY DATEDIFF(ttq.validade_qual , NOW()) "); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 

	 foreach($result as $row) {
		$id_func = $row["id_func"];
		$desc_qual = $row["desc_qual"];
		$name = $row["name"];
		$tipo_qual = $row["tipo_qual"];
		$validade_qual = $row["validade_qual"];
		$dias_expira = $row["dias_expira"];
		$foto = $row["foto"];
		$cargo = $row["cargo"];

		if ($foto != ""){
			$foto = "images/upload/funcionarios/".$foto ;
		}else{
			$foto = "images/nouser.png" ;
		}

		if($validade_qual == '00/00/0000'){

		} else {
			if($dias_expira < $days){
				$response['treinamentos'][] = array(
					"id_func"=>$id_func,
					"name"=>$name,
					"desc_qual"=>$desc_qual,
					"tipo_qual"=>$tipo_qual,
					"validade_qual"=>$validade_qual,
					"cargo"=>$cargo,
					"dias_expira"=>$dias_expira,
					"foto"=>$foto,
					
				);
			}
		}

		

		
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

	 	 //$arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
		  $response[] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>