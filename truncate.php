<?php

include('includes/common/util.php'); 

$database = new db(); 


$database->query("TRUNCATE tb_book_detail"); 
$database->execute();

$database->query("TRUNCATE tb_book_evidence"); 
$database->execute();

$database->query("TRUNCATE tb_book_func"); 
$database->execute();

$database->query("TRUNCATE tb_book_group"); 
$database->execute();

$database->query("TRUNCATE tb_booking"); 
$database->execute();

echo 'FINISH';


?>