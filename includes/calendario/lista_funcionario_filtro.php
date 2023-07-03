<?php

include('../common/util.php'); 

$db = new db(); 



$id_service = $_POST["id_service"];
$time_inicial =  $_POST["time_inicial"];


$db = new db(); 
$db->query("SELECT tts.id_team FROM tb_team_service tts
		WHERE tts.id_service =: id_service  ");




?>