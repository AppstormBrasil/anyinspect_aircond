<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$db = new db(); 

$db->query('SELECT * from tb_prod_shooping WHERE id =:id'); 
$db->bind(':id', $id); 	
$db->execute();
$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$titulo = $row["titulo"];
		$categoria = $row["categoria"];
		$preco = $row["preco"];
		$qtd = $row["qtd"];
		$descricao = $row["descricao"];
		$tipo = $row["tipo"];
		$foto = $row["foto"];

		if ($foto != ""){
		   $foto = 'images/upload/produtos_loja/'.$foto;
		}else{
		   $foto = "images/noimage.png" ;
		} 

		$arr['data'] = array(
			"id"=>$row['id'],
			"titulo"=>$row['titulo'],
			"categoria"=>$row['categoria'],
			"valor"=>$row['preco'],
			"qtd"=>$row['qtd'],
			"descricao"=>$row['descricao'],
			"tipo"=>$row['tipo'],
			"foto"=>$foto
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