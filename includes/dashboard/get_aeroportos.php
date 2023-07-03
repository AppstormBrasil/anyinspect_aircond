<?php 
include('../common/util.php'); 
$db = new db(); 
if(!isset($_GET['searchTerm'])){
	$db->query("SELECT ta.* 
			FROM tb_aeroportos ta
			ORDER by ta.id "); 
}
else{
	$search = $_GET['searchTerm'];

	$db->query("SELECT ta.* 
			FROM tb_aeroportos ta 
			WHERE (ta.iata like '%".$search."%' OR ta.aeroporto like '%".$search."%' OR ta.cidade like '%".$search."%') 
		ORDER by ta.id "); 
}
		
$db->execute();
$response = array();
$result = $db->resultset(); 
if($result){
	 $i = 0;
	 foreach($result as $row) {
		
	 }
	 
	echo json_encode($result);
	 	 exit(0);
} else { 
	$response[] = array(
		"id"=>'none'
	);
	echo json_encode($response);
} 

?>