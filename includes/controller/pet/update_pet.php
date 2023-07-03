<?php 
 
include('../../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}

 if(isset($_POST['nome_pet'])){ $nome_pet = $_POST['nome_pet'];} else {$nome_pet = '';}
 if(isset($_POST['sexo_pet'])){ $sexo_pet = $_POST['sexo_pet'];} else {$sexo_pet = '';} 
 if(isset($_POST['raca_pet'])){ $raca_pet = $_POST['raca_pet'];} else {$raca_pet = '';} 
 if(isset($_POST['porte_pet'])){ $porte_pet = $_POST['porte_pet'];} else {$porte_pet = '';}
 if(isset($_POST['hair_pet'])){ $hair_pet = $_POST['hair_pet'];} else {$hair_pet = '';} 
 if(isset($_POST['mood_pet'])){ $mood_pet = $_POST['mood_pet'];} else {$mood_pet = '';}
  if(isset($_POST['obs_pet'])){ $obs_pet = $_POST['obs_pet'];} else {$obs_pet = '';}
 if(isset($_POST['dt_nasc_pet'])){ $dt_nasc_pet = $_POST['dt_nasc_pet'];} else {$dt_nasc_pet = '';}

 $dt_nasc_pet = br_to_usa($dt_nasc_pet);
 
 $db->query('UPDATE tb_clients_pet SET name = :name , gender = :gender, mood = :mood, hair = :hair, breed = :breed, size = :size,dt_nasc = :dt_nasc, obs = :obs WHERE id = :id_pet ');
 
 $db->bind(':id_pet', $id); 
 $db->bind(':name', $nome_pet); 
 $db->bind(':gender', $sexo_pet); 
 $db->bind(':breed', $raca_pet); 
 $db->bind(':size', $porte_pet);
 $db->bind(':mood', $mood_pet); 
 $db->bind(':hair', $hair_pet); 
 $db->bind(':obs', $obs_pet); 
 $db->bind(':dt_nasc', $dt_nasc_pet);

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