<?php
    date_default_timezone_set('America/Sao_Paulo');
    include('connection.php');
      $current_date = date('Y-m-d');
      $current_date_time = date('Y-m-d  H:i:s');
      $prod_path = 'https://tecnoair.appstorm.online/';
      
if (isset($_COOKIE['_x19a01m31da'])) {
    function get_current_id(){
        return $_COOKIE['_x19a01m31da'];
    }
    function get_id_empresa(){
      return $_COOKIE['_x19a01m31db'];
    }

    function get_user_type2(){
      return $_COOKIE['_x19a01m31dh'];
    }
}else{
    //echo "<script>window.location.href = 'login';</script>";
    //exit(0);
}
      
	  
$IdUsuario = get_current_id();
$IdEmpresa = get_id_empresa();
      
function hourMinute2Minutes($strHourMinute) {
  $from = date('Y-m-d 00:00:00');
  $to = date('Y-m-d '.$strHourMinute);
  $diff = strtotime($to) - strtotime($from);
  $minutes = $diff / 60;
  return (int) $minutes;
}

function get_nome_mes($mes_dummy){
    switch ($mes_dummy) {
        case "01":    $mes_dummy = "Jan";     break;
        case "02":    $mes_dummy = "Fev";   break;
        case "03":    $mes_dummy = "Mar";       break;
        case "04":    $mes_dummy = "Abr";       break;
        case "05":    $mes_dummy = "Mai";        break;
        case "06":    $mes_dummy = "Jun";       break;
        case "07":    $mes_dummy = "Jul";       break;
        case "08":    $mes_dummy = "Ago";      break;
        case "09":    $mes_dummy = "Set";    break;
        case "10":    $mes_dummy = "Out";     break;
        case "11":    $mes_dummy = "Nov";    break;
        case "12":    $mes_dummy = "Dez";    break; 
 }
 return $mes_dummy;

}

function get_nome_mes_completo($mes_dummy){
  switch ($mes_dummy) {
      case "01":    $mes_dummy = "Janeiro";     break;
      case "02":    $mes_dummy = "Fevereiro";   break;
      case "03":    $mes_dummy = "Março";       break;
      case "04":    $mes_dummy = "Abril";       break;
      case "05":    $mes_dummy = "Maio";        break;
      case "06":    $mes_dummy = "Junho";       break;
      case "07":    $mes_dummy = "Julho";       break;
      case "08":    $mes_dummy = "Agosto";      break;
      case "09":    $mes_dummy = "Setembro";    break;
      case "10":    $mes_dummy = "Outubro";     break;
      case "11":    $mes_dummy = "Novembro";    break;
      case "12":    $mes_dummy = "Dezembro";    break; 
}
return $mes_dummy;

}


function left($str, $length) {
  return substr($str, 0, $length);
}

function right($str, $length) {
      return substr($str, -$length);
}

function br_to_usa($date){
    $date = explode("/",$date);
    return substr($date[2],0,4).'-'.$date[1].'-'.$date[0].' '.substr($date[2],5,9);
}

function usa_to_br_date_time($date){
      $date = explode(" ",$date);
      $only_date = explode("-",$date[0]);
      $br_date = $only_date[2].'/'.$only_date[1].'/'.$only_date[0];
      return $br_date.' '.$date[1];

      //return substr($date[2],0,4).'/'.$date[1].'/'.$date[0].' '.substr($date[2],5,9);
  
}

function usa_to_br_date_ti($date){
  $date = explode(" ",$date);
  $only_date = explode("-",$date[0]);
  $br_date = $only_date[2].'-'.$only_date[1].'-'.$only_date[0];
  return $br_date.' '.$date[1];
}

function usa_to_br_date_time2($date){
  $date = explode(" ",$date);
  $only_date = explode("/",$date[0]);
  $br_date = $only_date[2].'-'.$only_date[1].'-'.$only_date[0];
  return $br_date.' '.$date[1];
}

function br_to_usa_date_time2($date){
  $date = explode(" ",$date);
  $only_date = explode("/",$date[0]);
  $br_date = $only_date[2].'-'.$only_date[1].'-'.$only_date[0];
  return $br_date.' '.$date[1];

  //return substr($date[2],0,4).'/'.$date[1].'/'.$date[0].' '.substr($date[2],5,9);

}

function usa_to_br($date){
      $date = explode("-",$date);
      return substr($date[2],0,4).'/'.$date[1].'/'.$date[0].' '.substr($date[2],5,9);
  
}

  function br_to_usa_month($date){
      $date = explode("/",$date);
      return $date[2].'-'.$date[1].'-'.$date[0];
  }

  function get_date_br_usa($date){
    $date = explode("-",$date);
    return $date[2].'-'.$date[1].'-'.$date[0];
}
    
    function date_only($date){
      $dum_da_y = substr($date,0,4);
      $dum_da_m = substr($date,5,2);
      $dum_da_d = substr($date,8,2);
      $final_date = $dum_da_d.'-'.$dum_da_m.'-'.$dum_da_y;
      return $final_date;
    }

    

    function get_only_date($date){
  	 $date = explode("-",$date);
  	 return substr($date[2],0,2);
    }

     function get_day_month($date){
  	$date = explode("-",$date);
  	return substr($date[2],0,2).'/'.substr($date[1],0,2);
  	}

  	 function get_only_year($date){
  	    $date = explode("-",$date);
  	     return substr($date[1],0,2);

     }

    function br_month($date){
      $date = explode("-",$date);
      return substr($date[2],0,2).'-'.$date[1].'-'.$date[0];
    }

    function br_month2($date){
      $date = explode("/",$date);
      return substr($date[2],0,2).'/'.$date[1].'/'.$date[0];

   }

   function usa_month($date){
     $date = explode("/",$date);

     $string =  trim($date[2].'-'.$date[1].'-'.$date[0]);
     return  str_replace(' ', '', $string);

  }

    function br_month3($date){
      $date = explode("-",$date);
      return substr($date[2],0,2).'/'.$date[1].'/'.$date[0];
    }

   function minutes($time){
		$time = explode(':', $time);
		return ($time[0]*60) + ($time[1]) + ($time[2]/60);
	}

     function get_only_day_br($date){
   	 $date = explode("-",$date);
   	 return substr($date[0],0,2);
     }

    function get_only_time($date){
   	    $date = explode(" ",$date);
   	 return $date[1];
     }

    function Valor($valor) {
       $verificaPonto = ".";
       if(strpos("[".$valor."]", "$verificaPonto")):
           $valor = str_replace('.','', $valor);
           $valor = str_replace(',','.', $valor);
           else:
             $valor = str_replace(',','.', $valor);
       endif;

       return $valor;
    }

function h2m($hours) {
            $t = explode(".", $hours);
            $h = $t[0];
            if (isset($t[1])) {
                $m = $t[1];
            } else {
                $m = "00";
            }
            $mm = ($h * 60);
            return $mm;
    }

    function gerarCod() {
      //$all = "ABCDEFGHIJKLMNOPQRSTUVYWZ0123456789";
      $all = "abcdefghijklimnopqrstuvxz0123456789";
      $key = "";
      for($i = 0; $i < 20; $i++) {
      $key .= $all[rand(0, 34)];
      }
      return $key;
    }




?>
