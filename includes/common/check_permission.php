<?php
	if (isset($_COOKIE['_x19a01m31da'])) {
  function get_current_id(){
    return $_COOKIE['_x19a01m31da'];
   }

    function get_id_empresa(){
    return $_COOKIE['_x19a01m31db'];
    }

		function get_user_type(){
			return $_COOKIE['_x19a01m31dc']; 
    }
    
    function get_user_level(){
			return $_COOKIE['_x19a01m31de']; 
		}
		
		

}else{
    echo "<script>window.location.href = 'login';</script>";
    exit(0);
}

$user_level = get_user_level();
				



function get_nome_mes($mes_dummy){
  switch ($mes_dummy) {
      case "01":    $mes = "Jan";     break;
      case "02":    $mes = "Fev";   break;
      case "03":    $mes = "Mar";       break;
      case "04":    $mes = "Abr";       break;
      case "05":    $mes = "Mai";        break;
      case "06":    $mes = "Jun";       break;
      case "07":    $mes = "Jul";       break;
      case "08":    $mes = "Ago";      break;
      case "09":    $mes = "Set";    break;
      case "10":    $mes = "Out";     break;
      case "11":    $mes = "Nov";    break;
      case "12":    $mes = "Dez";    break; 
}
return $mes;

}

$IdUsuario = get_current_id();
$IdEmpresa = get_id_empresa();

?>