<?php
 include('../../common/util.php');
 $database = new db(); 
 $data_cadastro = date('Y-m-d  H:i:s');

 $IdEmpresa = get_id_empresa();
 $id = $_POST['id'];

 $database->query('UPDATE tb_admin_colaborador SET documento = "" WHERE IdColaborador = :IdColaborador ');
 $database->bind(':IdColaborador', $id);
 if($database->execute()){
	$arr['status'] = "SUCCESS";
	$arr['status_txt'] = "Ítem removido com sucesso !";
	echo json_encode($arr);
	$path = "../../../documento/colaborador/".$IdEmpresa."/".$id."/";
	$files = glob( $path . '*', GLOB_MARK );
	

	if(file_exists($path)){
    	foreach( $files as $file ){
            unlink( $file );  ;      
        }
	} 


 } else {
	$arr['status'] = "ERROR";
	$arr['status_txt'] = "Erro! Ítem ja esta cadastrado!";
	echo json_encode($arr);
	exit(0);
 }
exit(0);
?>
