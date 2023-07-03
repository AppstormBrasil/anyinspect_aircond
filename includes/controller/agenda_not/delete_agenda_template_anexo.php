<?php
 include('../../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 //$IdEmpresa = get_id_empresa();
 $IdEmpresa = 1;

 $id = $_POST['id'];




 $database->query('UPDATE tb_admin_form_agenda SET documento = "" WHERE IdformAgenda = :IdformAgenda ');
 $database->bind(':IdformAgenda', $id);
 //$database->bind(':IdEmpresa', $id_empresa);
 if($database->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Ítem removido com sucesso !";
	echo json_encode($arr);
	//$path="file_uploader/server/files/".$id_empresa."/".$id_cliente."/".$file;
	//$path = "../../../images/agenda/".$IdEmpresa."/".$id."/*";
	
	$path = "../../../documento/agenda/".$IdEmpresa."/".$id."/";
	
	$files = glob( $path . '*', GLOB_MARK );
	

	
	if(file_exists($path)){
    	foreach( $files as $file ){
            unlink( $file );  ;      
        }
	} else {
		echo 'nao existe pasta';
	}

	//$file = "includes/cliente/file_uploader/server/files/".$id_cliente."/".$file ;
	//unlink($file);
	 


 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro! Ítem ja esta cadastrado!";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
