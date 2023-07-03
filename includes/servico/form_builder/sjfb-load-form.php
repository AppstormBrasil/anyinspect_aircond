<?php
 include('../common/util.php');
	
 $IdFormulario = $_GET['form_id'];


 $db = new db();
 $db->query('SELECT * FROM formulario WHERE IdFormulario = :IdFormulario  ');
 $db->bind(':IdFormulario', $IdFormulario);
 $row = $db->single();

 if($row != ''){

    $id = $row["IdFormulario"];
    $arr['titulo_formulario'] = $row['titulo_formulario']; 
    $arr['tipo_formulario'] = $row['tipo_formulario']; 
    $arr['conteudo_formulario'] = $row['conteudo_formulario'];

    $imagem = $row['imagem'];

    if ($imagem != ""){
		$img = "images/form/".$id."/".$imagem ;
	}else{
		$img = "assets/images/nouser.png" ;
	}
    $arr['imagem'] = $img;
    
    //echo json_encode($arr);
    echo json_encode($arr);

     //echo $row['conteudo_formulario'];
 } else {

 }

