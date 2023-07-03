<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db(); 
$IdEmpresa =  get_id_empresa();

 if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';} 
$IdColaborador = $id; 
$db->query('SELECT * FROM tb_admin_colaborador WHERE IdColaborador ='. $id .' '); 
 $db->execute();
$result = $db->resultset(); 
if($result){ 
	 $i = 0; 
	 foreach($result as $row) { 
		  $arr['response'][] = $row; 
		  $id = $row["IdCondominio"];
		  $imagem = $row["imagem"];
		  $IdCondominio = $row["IdCondominio"];
		
		 if ($imagem != ""){
			//$img_user = "images/cliente/".$id."/".$imagem ;
			$imagem = "images/colaborador/".$IdEmpresa."/".$IdColaborador."/".$imagem ;
		}else{
			$imagem = "images/noimage.jpg" ;
		}

		$documento = $row["documento"];
		if ($documento != ""){
			$documento_url = "documento/colaborador/".$IdCondominio."/".$id."/".$documento ;
			$documento_img = "images/pdf_img.png" ;
		}else{
			$documento_img = "images/noimage.jpg" ;
			$documento_url = "";
		}

		$arr['response'][$i]['imagem'] = $imagem;
		$arr['response']['formulario_anexo_imagem'] = $documento_img;
		$arr['response']['formulario_anexo_url'] = $documento_url;


		
		} 
	 	 $arr['status'] = 'SUCCESS';
	 	 echo json_encode($arr);
	 	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informação disponível'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>