<?php
 include('../../common/util.php');
	
 $IdFormulario = $_GET['form_id'];

 $db = new db();
 $db->query('SELECT * FROM tb_services WHERE id = :IdFormulario ');
 $db->bind(':IdFormulario', $IdFormulario);

 $row = $db->single();
 
 
 if($row != ''){



    $arr['IdFormulario'] = $row['id'];
    $arr['IdUsuario'] = $row['id'];
    $arr['titulo_formulario'] = $row['short_dec'];
    $arr['tipo_formulario'] = 'Check-list';
    $arr['conteudo_formulario'] = $row['conteudo_formulario'];
    $imagem = '';
    $IdFormulario = $arr['IdFormulario'];

    $arr['imagem'] = $imagem;

    $arr['status'] = 'SUCCESS';
   
    echo json_encode($arr);

 }

