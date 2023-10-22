<?php
$servername = "localhost";
$username = 'root';
$password = 'wp120646';
$dbname = 'fooddb';

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
