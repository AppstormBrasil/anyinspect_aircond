<?php


function get_id_empresa(){
	return $_COOKIE['_x75a554c545'];
  }
  
 // DB table to use
$table = 'formulario';

// Table's primary key
$primaryKey = 'IdFormulario';

$id =  get_id_empresa();

function usa_to_br_date_time($date){
      $date = explode(" ",$date);
      $only_date = explode("-",$date[0]);
      $br_date = $only_date[2].'/'.$only_date[1].'/'.$only_date[0];
      return $br_date.' '.$date[1];

      //return substr($date[2],0,4).'/'.$date[1].'/'.$date[0].' '.substr($date[2],5,9);
  
}

$columns = array(
	
	array( 'db' => '`f`.`IdFormulario`', 'dt' => "IdFormulario", 'field' => 'IdFormulario' ),
	array( 'db' => '`f`.`titulo_formulario`', 'dt' => "titulo_formulario", 'field' => 'titulo_formulario', 'formatter' => function( $d, $row ) {
		return $d ;
	}),
	array( 'db' => '`f`.`tipo_formulario`', 'dt' => "tipo_formulario", 'field' => 'tipo_formulario', 'formatter' => function( $d, $row ) {
		return $d ;
	}),
	
	array( 'db' => '`f`.`data_atualizacao`', 'dt' => "data_atualizacao", 'field' => 'data_atualizacao' , 'formatter' => function( $d, $row ) {

		if($d == "0000-00-00"){
			return '-';
		} else {
			return usa_to_br_date_time($d);
		}
	}),

	
	array( 'db' => '`f`.`status_formulario`',  'dt' => "status_formulario", 'field' => 'status_formulario' ),
	array( 'db' => '`f`.`imagem`', 'dt' => "imagem", 'field' => 'imagem', 'formatter' => function( $d, $row ) {
		if($d != ""){
			$img_user = "images/form/".$row[0]."/".$d ;
		} else {
			$img_user = "assets/images/no_image.png" ;
		} 
		
		return $img_user;
	})

);

// SQL server connection information
/*require('../data_table/config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
); 

// SQL server connection information
$sql_details = array(
	'user' => 'appst650',
	'pass' => 'Mudotodahora2015',
	'db'   => 'appst650_filtratech',
	'host' => 'localhost'
); */


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('../data_table/ssp.customized.class.php' );

$joinQuery = "FROM `formulario` AS `f` ";

//$extraWhere = "f.IdEmpresa = $id";
$groupBy = "";
$having = "";

$sql_details = array(
    'user' => 'appst650',
    'pass' => 'Mudotodahora2015',
    'db'   => 'appst650_filtratech',
    'host' => 'localhost'
);


echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);