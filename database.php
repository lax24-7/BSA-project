<!-- database.php -->

<?php

// Database configuration
$host = "localhost";
$database = "attendance_db";
$username = "root";
$password = "";

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

?>
