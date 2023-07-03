<?php 
 
include('../common/util.php'); 

$db = new db(); 

if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
if(isset($_POST['Newhora_Inicio'])){ $Newhora_Inicio = $_POST['Newhora_Inicio'];
} else {$Newhora_Inicio = '';}
if(isset($_POST['Newhora_termino'])){ $Newhora_termino = $_POST['Newhora_termino'];
} else {$Newhora_termino = '';}
if(isset($_POST['Newpausa_incio'])){ $Newpausa_incio = $_POST['Newpausa_incio'];
} else {$Newpausa_incio = '';}
if(isset($_POST['Newpausa_final'])){ $Newpausa_final = $_POST['Newpausa_final'];
} else {$Newpausa_final = '';}


 
 $db->query('UPDATE tb_jornada_trabalho SET hora_inicio = :Newhora_Inicio, 
 	hora_termino = :Newhora_termino, pausa_incio = :Newpausa_incio, 
 	pausa_final = :Newpausa_final   WHERE id = :id ');
 
 $db->bind(':id', $id); 
 $db->bind(':Newhora_Inicio', $Newhora_Inicio); 
 $db->bind(':Newhora_termino', $Newhora_termino); 
 $db->bind(':Newpausa_incio', $Newpausa_incio); 
 $db->bind(':Newpausa_final', $Newpausa_final); 


 if($db->execute()){
	 $arr['status'] = 'SUCCESS';
	 $arr['status_txt'] = 'Atualizado com Sucesso'; 
	 echo json_encode($arr);
	 exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Erro ao Atualizar'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>