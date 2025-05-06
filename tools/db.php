<?php
$host = 'switchyard.proxy.rlwy.net';
$port = 17607;
$user = 'root';
$password = 'TzYfrdBKhmUefTAVqmjeatqGWnNqGuwa';
$dbname = 'railway';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
