<?php
function getDBConnection(){
    $servername = "switchyard.proxy.rlwy.net";
    $username = "root";
    $password = "TzYfrdBKhmUefTAVqmjeatqGWnNqGuwa";
    $database = "railway";
    $port = 17607;


$connection = new mysqli($servername, $username, $password, $database);
if($connection->connect_error){
    die("Error: Failed to connect to MySQL. ".$connection->connect_error);
}

return $connection;
}

?>
