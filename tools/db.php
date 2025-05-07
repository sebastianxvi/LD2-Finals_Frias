<?php
function getDBConnection(){

$host = 'ballast.proxy.rlwy.net';
$port = 38579;
$user = 'root';
$password = 'xWSBZBiCMFASyziCSVarZyeGAkAiiQpJ';
$dbname = 'railway';

// Create connection
$connection = new mysqli($host, $user, $password, $dbname, $port);

if($connection->connect_error){
    die("Error: Failed to connect to MySQL. ".$connection->connect_error);
}

return $connection;
}

?>
