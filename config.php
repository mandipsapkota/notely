<?php

$DB_SERVER = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_DATABASE = 'notely';


$conn = mysqli_connect($DB_SERVER, $DB_USER ,$DB_PASS , $DB_DATABASE);

if(!$conn){
    echo ("Error");
}

?>