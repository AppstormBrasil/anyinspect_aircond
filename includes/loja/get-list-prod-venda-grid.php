<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

$db = new db(); 

$db->query('SELECT * from tb_prod_shooping'); 
$db->execute();

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id = $row["id"];
		$titulo = $row["titulo"];
		$categoria = $row["categoria"];
		$preco = $row["preco"];
		$foto = $row["foto"];
		$qtd = $row["qtd"];

		$foto = $row["foto"];
		if ($foto != ""){
			$foto = "images/upload/produtos/".$foto ;
		}else{
			$foto = "images/noimage.png" ;
		}
		

		$response['data'][] = array(
			"id"=>$row['id'],
			"foto"=>$foto,
			"titulo"=>$row['titulo'],
			"categoria"=>$row['categoria'],
			"preco"=>"R$".$row['preco'],
			"qtd"=>$row['qtd'],
			"botao"=>'<a href="venda_produto-'.$id.'">
			 <button class="btn btn-primary" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button>
			 </a>&nbsp;<button onclick="RemoveItem('.$row['id'].',\''.$row['titulo'].'\')" class="btn btn-danger" id="'.$row['id'].'" type="button"><i class="icon-trash f-s-17"></i></button>'
		);
	 } 
	 	 $arr['status'] = 'SUCCESS';
		 echo json_encode($response);
	 	 exit(0);
} else { 
		 $response['data'] = array();
	 	 echo json_encode($response);
	 	 } 

 ?>