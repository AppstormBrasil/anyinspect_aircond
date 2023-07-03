<?php
 include('../common/util.php');
	
 $IdFormulario = $_GET['form_id'];
 $IdEmpresa = get_id_empresa();



 $db = new db();
 $db->query('SELECT * FROM formulario WHERE IdFormulario = :IdFormulario AND IdEmpresa = :IdEmpresa  ');
 $db->bind(':IdFormulario', $IdFormulario);
 $db->bind(':IdEmpresa', $IdEmpresa);
 $row = $db->single();
 if($row != ''){
     echo $row['conteudo_formulario'];
 }


//The demo string is below. Normally, you would just grab the saved json string from your db and echo it out here.
//echo '[{"type":"text","label":"Name","req":1},{"type":"textarea","label":"Describe yourself in 3rd person","req":0},{"type":"select","label":"Are you a...","req":1,"choices":[{"label":"","sel":1},{"label":"Early Riser","sel":0},{"label":"Night Owl","sel":0},{"label":"I Don\'t Sleep","sel":0}]},{"type":"radio","label":"Favorite gaming platform:","req":1,"choices":[{"label":"PC","sel":0},{"label":"XBOX","sel":0},{"label":"PlayStation","sel":0},{"label":"Wii","sel":0}]},{"type":"checkbox","label":"What do you do for fun? Check all that apply:","req":0,"choices":[{"label":"Hiking","sel":0},{"label":"Running","sel":0},{"label":"Gym","sel":0},{"label":"Movies","sel":0},{"label":"Music","sel":0}]},{"type":"agree","label":"I agree that I\'ve been somewhat truthful. Maybe.","req":0}]';