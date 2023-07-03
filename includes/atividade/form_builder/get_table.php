<?php
function get_id_empresa(){
	return $_COOKIE['_x75a554c545'];
  }

// DB table to use
$table = 'formulario';

// Table's primary key
$primaryKey = 'IdFormulario';


function usa_to_br_date_time($date){
      $date = explode(" ",$date);
      $only_date = explode("-",$date[0]);
      $br_date = $only_date[2].'/'.$only_date[1].'/'.$only_date[0];
      return $br_date.' '.$date[1];
}


$columns = array(
	array( 'db' => 'IdFormulario', 'dt' => 0 ),
	array(
		'db'        => 'titulo_formulario',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return $d;
	}
	),
	
	
	array( 'db' => 'tipo_formulario',  'dt' => 2 ),
	array(
		'db'        => 'data_atualizacao',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d == "0000-00-00"){
			return '-';
				} else {
					return usa_to_br_date_time($d);
			}
			}
	),
	array( 'db' => 'status_formulario',     'dt' => 4 ),
	
	array(
		'db'        => 'imagem',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			if($d != ""){
			$img_user = "images/form/".$row[0]."/".$d ;
			} else {
				$img_user = "assets/images/no_image.png" ;
			} 
			
			return $img_user;
			}
	),
	/*array(
		'db'        => 'salary',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return '$'.number_format($d);
		}
	) */
);

// SQL server connection information
/*$sql_details = array(
	'user' => 'appst650',
	'pass' => 'Mudotodahora2015',
	'db'   => 'appst650_filtratech',
	'host' => 'localhost'
);*/

$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'appst650_filtratech',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );
//$extraWhere = "f.IdEmpresa = $id";
$extraWhere = "";
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $extraWhere )
);

