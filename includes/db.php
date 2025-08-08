<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "nsbm_shop";
$port = 3309;  

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
