<?php 

include('../common/util.php'); 


$db = new db(); 

$db->query("SELECT * FROM formulario  ");

$result = $db->resultset(); 
if($result){
	 $i = 0; 
	 foreach($result as $row) {
	 	$IdFormulario = $row["IdFormulario"];
	 	$titulo_formulario = $row["titulo_formulario"];
	 	$tipo_formulario = $row["tipo_formulario"];
	 	$data_cadastro = usa_to_br_date_time($row['data_cadastro']);

		$response['data'][] = array(
			"IdFormulario"=>$row['IdFormulario'],
			"titulo_formulario"=>$row['titulo_formulario'],
			"tipo_formulario"=>$row['tipo_formulario'],
			"numero_identficacao"=>$data_cadastro,
			"botao"=>'<a onclick="EditaFunc('.$row['IdFormulario'].')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Editar"><i class="la la-edit"></i></a><spam>&nbsp;</spam>
                <a onclick="RemoveItem('.$row['IdFormulario'].',\''.$row['titulo_formulario'].'\')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Excluir"><i class="la la-trash"></i></a>'
		);
	  }

		  
	 
	 $arr['status'] = 'SUCCESS';
		echo json_encode($response);
	 	 exit(0);
	 	 
	} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 



?>