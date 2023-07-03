<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$db = new db(); 

$db->query('SELECT * from tb_package WHERE id =:id'); 
$db->bind(':id', $id); 	
$db->execute();
$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {

		$foto = $row['foto'];
		if ($foto != ""){
			$foto = 'images/upload/pacotes/'.$foto;
		}else{
			$foto = "images/noimage.png" ;
		} 

		$id = $row["id"];
		$nome = $row["nome"];
		$valor = $row["valor"];
		$data_cadastro = $row["data_cadastro"];
	
		
		$arr['data'] = array(
			"id"=>$row['id'],
			"nome"=>$row['nome'],
			"valor"=>$row['valor'],
			"validade"=>$row['validade'],
			"quantidade_usos"=>$row['quantidade_usos'],
			"foto"=>$foto,
			"data_cadastro"=>$row['data_cadastro']
		);
	 } 
		
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($arr);
	 	exit(0);


} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>