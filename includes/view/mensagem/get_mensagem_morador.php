<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
$IdCondominio =  get_id_empresa(); 
$db = new db(); 
 
if(isset($_GET['IdMorador'])){ 
	$IdMorador = $_GET['IdMorador'];
} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Não foi possivel encontrar a mensagem . Se o problema persistir entrar em contado com a Administração'; 
	echo json_encode($arr);
	exit(0);

}



	$db->query('SELECT tme.* , tm.nome , tm.imagem as imagem_morador , tac.nome , tac.imagem as imagem_funcionario 
	FROM tb_mensagem tme
	LEFT JOIN tb_morador tm ON tm.IdMorador = tme.IdMorador
	LEFT JOIN tb_admin_colaborador tac ON tac.IdColaborador = tme.IdUsuario
	WHERE tm.IdCondominio = '.$IdCondominio.' AND tme.IdMorador = '.$IdMorador.' ');
  


$db->execute();
$result = $db->resultset(); 
$response = array();
$arr = array();
$i = 0; 
//$data = array();
foreach($result as $row) { 
	$IdCondominio = $row['IdCondominio'];
		  $IdMorador = $row['IdMorador'];
		  
		  $imagem_morador = $row['imagem_morador'];

		  if ($imagem_morador != ""){
	 		$imagem_morador = "images/residencia/".$IdCondominio."/".$IdMorador."/".$imagem_morador ;
		  }else{
			$imagem_morador = "images/noimage.jpg" ;
		  }
			 
		  $arr['mensagem'][$i]['nome'] = $row['nome'];
		  $arr['mensagem'][$i]['mensagem'] = $row['mensagem'];
		  $arr['mensagem'][$i]['data_envio'] = usa_to_br_date_time($row['data_envio']);
		  

		$i++; 
}

$arr['status'] = 'SUCCESS';
	 	 echo json_encode($arr);

 
 
 ?>