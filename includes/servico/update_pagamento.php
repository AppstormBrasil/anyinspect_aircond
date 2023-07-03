<?php 
 
include('../common/util.php'); 
$data_atualizacao = date('Y-m-d  H:i:s'); 
$db = new db(); 


 if(isset($_POST['id'])){ $id = $_POST['id'];} else {
	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro no ID Found'; 
	echo json_encode($arr);
	exit(0);
 }
 

 if(isset($_POST['forma_pagamento'])){ $forma_pagamento = $_POST['forma_pagamento'];} else {$forma_pagamento = '';}

 
 $db->query('UPDATE tb_booking SET forma_pagamento = :forma_pagamento WHERE id = :id ');


 $db->bind(':forma_pagamento', $forma_pagamento); 
 $db->bind(':id', $id); 

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