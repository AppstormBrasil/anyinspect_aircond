<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s');
$date_now = date('Y-m-d H:i:s');
$send_at = date('d/m/Y  H:i:s'); 
$db = new db(); 
$_PUT = json_decode(file_get_contents('php://input'), true);
$alldata = $_PUT['alldata'];
$IdUsuario = $_PUT['IdUsuario'];
$alldatasig = $_PUT['alldatasig'];
$allcomment = $_PUT['allcomment'];

if (empty($alldata)) {
} else {
  
$new_data = json_decode($alldata[0]['data']);
$IdFormulario = $alldata[0]['formID']; 
$IdEvento = $alldata[0]['at'];
$db = new db();
$db->query('SELECT IdEvento
                    FROM formulario_resposta fr 
                    WHERE fr.IdEvento = :IdEvento ');
$db->bind(':IdEvento', $IdEvento);
$row = $db->single();

if($row != ''){
  $db = new db();
  $db->beginTransaction();
  $db->query('DELETE FROM formulario_resposta WHERE IdEvento = :IdEvento ');
  $db->bind(':IdEvento', $IdEvento);
  $row = $db->execute();
  $db->endTransaction();


  $dummy_model = "";
    foreach ($new_data as $key => $value) {
        $field[$value->name] = $value->value;
        if (count($value->value) > 1){
            $final_result = "";
            foreach ($value->value as $result){
                $final_result .= $result.',';
                
            }
            $final_result = substr($final_result, 0, -1);
        
        } else {
            $final_result = $value->value[0];
        }

        $campo = $value->name;
        $campo = str_replace('[]', '', $campo);
        $valor = $final_result;

        insert_result($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento);

        
    }

  
 } else {
    $dummy_model = "";
    foreach ($new_data as $key => $value) {
        $field[$value->name] = $value->value;

        if (count($value->value) > 1){
            
          $final_result = "";
          
          foreach ($value->value as $result){
                $final_result .= $result.',';
            }
            $final_result = substr($final_result, 0, -1);
        
        } else {
            $final_result = $value->value[0];
        }
        $campo = $value->name;
        $valor = $final_result;
        insert_result($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento);

        
    }
 } 
}

// SYNC SIGNATURES 
$alldatasig = $_PUT['alldatasig'];
//$alldatasig = [];

if (empty($alldatasig)) {
  } else {
  
  foreach ($alldatasig as $key => $value) {
   
    $IdFormulario = $value['IdFormulario'];
    $IdUsuario = $value['IdUsuario'];
    $IdEvento = $value['IdEvento'];
    $campo = $value['campo'];
    $valor = $value['valor'];
  
    $db->query("SELECT fr.campo
    FROM formulario_resposta fr 
    WHERE fr.campo = :campo AND fr.IdEvento = :IdEvento ");
    $db->bind(':campo', $campo);
    $db->bind(':IdEvento', $IdEvento);
    $result = $db->resultset();
    //$response = array();
  
    if (empty($result)) {
  
      $db->query('INSERT INTO formulario_resposta (IdUsuario,IdFormulario,IdEvento,campo,sign_value,data_cadastro,data_atualizacao) VALUES ( :IdUsuario, :IdFormulario, :IdEvento, :campo, :sign_value, :data_cadastro, :data_atualizacao)');
      $db->bind(':IdUsuario', $IdUsuario);
      $db->bind(':IdFormulario', $IdFormulario);
      $db->bind(':IdEvento', $IdEvento);
      $db->bind(':campo', $campo);
      $db->bind(':sign_value', $valor);
      $db->bind(':data_cadastro', $date_now);
      $db->bind(':data_atualizacao', $date_now);
        
        if($db->execute()){ 
          $arr['status'] = "SUCCESS";
          $arr['status_txt'] = "Assinatura salva com sucesso!";
       } else {
            $arr['status'] = 'ERROR';
            $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
       }
  
       //echo json_encode($arr);
       //exit(0);
    
    } else {
      
      $db->query('UPDATE formulario_resposta SET sign_value = :sign_value , data_atualizacao = :data_atualizacao , IdUsuario = :IdUsuario WHERE IdEvento = :IdEvento AND campo = :campo');
      $db->bind(':sign_value', $valor);
      $db->bind(':data_atualizacao', $date_now);
      $db->bind(':IdUsuario', $IdUsuario);
      $db->bind(':IdEvento', $IdEvento);
      $db->bind(':campo', $campo);
      if($db->execute()){ 
      } 
  
    }
  
  }
  
  }

  // UPLOAD STATS

  $alldatastat = $_PUT['alldatastat'];

if (empty($alldatastat)) {
    //$arr['status'] = 'ERROR';
    //$arr['status_txt'] = 'Nenhuma Assinatura encontrada!' ;
    //echo json_encode($arr);
  } else {
  
    foreach ($alldatastat as $key => $value) {
        $start_lat = $value['start_lat'];
        $start_lon = $value['start_lon'];
        $qr_check_in = $value['qr_check_in'];
        $id = $value['id'];
        $status = $value['status_'];

        update_book_det($start_lat,$start_lon,$qr_check_in,$id);
        update_book_stat($status,$id);
       
    }

}

$arr['status'] = "SUCCESS";
$arr['status_txt'] = "Atividades atualizadas com sucesso!";
echo json_encode($arr);

function update_book_det($start_lat,$start_lon,$qr_check_in,$id){
    $_PUT = json_decode(file_get_contents('php://input'), true);
    $IdUsuario = $_PUT['IdUsuario'];
    $db = new db(); 
    $db->query('UPDATE tb_book_detail SET start_lat = :start_lat , start_lon = :start_lon , start_lon = :start_lon , id_quem_executou = :id_quem_executou , qr_checkin = :qr_checkin  WHERE id = :id');
    $db->bind(':start_lat', $start_lat);
    $db->bind(':start_lon', $start_lon);
    $db->bind(':id_quem_executou', $IdUsuario);
    $db->bind(':qr_checkin', $qr_check_in);
    $db->bind(':id', $id);
    $db->execute();
}

function update_book_stat($status,$id){
    $_PUT = json_decode(file_get_contents('php://input'), true);
    $IdUsuario = $_PUT['IdUsuario'];
    $db = new db(); 
    $db->query('UPDATE tb_booking SET status = :status WHERE id = :id');
    $db->bind(':status', $status);
    $db->bind(':id', $id);
    $db->execute();
   
}


function insert_result($IdUsuario,$IdFormulario,$campo,$valor,$IdEvento){

  $date_now = date('Y-m-d H:i:s');
  $IdUsuario = $IdUsuario;
  $IdFormulario = $IdFormulario;
  $IdEvento = $IdEvento;
  $campo = $campo;
  $valor = $valor;
  $status = 1;
	
	$db = new db();

	$db->query('INSERT INTO formulario_resposta (IdUsuario,IdFormulario,IdEvento,campo,valor,data_cadastro,data_atualizacao) VALUES ( :IdUsuario, :IdFormulario, :IdEvento, :campo, :valor, :data_cadastro, :data_atualizacao)');
	$db->bind(':IdUsuario', $IdUsuario);
	$db->bind(':IdFormulario', $IdFormulario);
	$db->bind(':IdEvento', $IdEvento);
	$db->bind(':campo', $campo);
	$db->bind(':valor', $valor);
	$db->bind(':data_cadastro', $date_now);
  $db->bind(':data_atualizacao', $date_now);
    
    if($db->execute()){ 
       /*$db = new db();
        $status = 1;
        $db->query('UPDATE tb_activity SET status = :status WHERE id = :IdEvento');
        $db->bind(':status', $status);
        $db->bind(':IdEvento', $IdEvento);
        if($db->execute()){

         } */ 

        //$lastInsertId = $db->lastInsertId(); 
        /*$arr['status'] = 'SUCCESS';
        $arr['status_txt'] = 'Cadastro realizado com sucesso!' ;
        echo json_encode($arr);*/
   } else {
        $arr['status'] = 'ERROR';
        $arr['status_txt'] = 'Erro! Erro ao salvar , se o problema persistir entre em contato com nosso suporte!' ;
   }
	
}


















exit;

$has_dup = "";

foreach($alldata as $row) {

	$Idtubulacao = $row['IdTubulacao'];
	$IdUsuario = $row['Idcliente_colaborador'];
	$Setor = $row['Setor'];
	$Dataregistro = $row['Dataregistro'];
	$Localizacao = $row['Localizacao'];
	$Observacao = $row['Observacao'];

	$has_dup = check_hist_exist($Idtubulacao , $Setor);
	//print_r('$has_dup '.$has_dup);
	if($has_dup == 0){
		//$db = new db(); 
		$db->query('INSERT INTO tb_tubulacao_hist (IdTubulacao,IdUsuario,Setor,Dataregistro,Localizacao,Observacao) VALUES (:IdTubulacao, :IdUsuario, :Setor, :Dataregistro, :Localizacao, :Observacao)'); 
		$db->bind(':IdTubulacao', $Idtubulacao); 
		$db->bind(':IdUsuario', $IdUsuario); 
		$db->bind(':Setor', $Setor); 
		$db->bind(':Dataregistro', $Dataregistro); 
		$db->bind(':Localizacao', $Localizacao); 
		$db->bind(':Observacao', $Observacao); 
		if($db->execute()){ 
			$Idtubhist = $db->lastInsertId(); 
			//$arr['status'] = 'SUCCESS'; 
			//$arr['status_txt'] = 'Atualizado com Sucesso'; 
			//echo json_encode($array_hist);
		}
		else { 
			$arr['status'] = 'ERROR'; 
			$arr['status_txt'] = 'Erro ao salvar'; 
			echo json_encode($arr);
	 } 

	} else {
		$arr['status'] = 'ERROR'; 
		$arr['status_txt'] = 'Achou um no BD ja'; 

		
	}

		
}
$arr['status'] = 'SUCCESS'; 
$arr['status_txt'] = 'Atualizado com Sucesso'; 
echo json_encode($arr);

function check_hist_exist($Idtubulacao , $Setor){
	$db = new db(); 
	$db->query("SELECT Idtubhist FROM tb_tubulacao_hist WHERE IdTubulacao =$Idtubulacao AND Setor LIKE '%".$Setor."%' "); 
	$db->execute();
	$result = $db->resultset(); 
	if($result){ 
		return 1;
	} else {
		return 0;
	}
	
}
exit();
	

 ?>