<?php
 include('../../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 $IdEmpresa = get_id_empresa();
 $id = $_POST['id'];




 $database->query('DELETE  FROM tb_admin_form_agenda WHERE IdformAgenda = :IdformAgenda ');
 $database->bind(':IdformAgenda', $id);
 //$database->bind(':IdEmpresa', $id_empresa);
 if($database->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Ítem removido com sucesso !";
	echo json_encode($arr);
	$path = "../../../agenda/".$IdEmpresa."/".$id."/";
	$files = glob( $path . '*', GLOB_MARK );
	if(file_exists($path)){
    	foreach( $files as $file ){
            //unlink( $file );  ;      
        }
	} else {
		//echo 'nao existe pasta';
	}

	//$file = "includes/cliente/file_uploader/server/files/".$id_cliente."/".$file ;
	//unlink($file);
	 


 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro ao deletar este ítem se o problema persistir entrar em conato com o Administrador";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
